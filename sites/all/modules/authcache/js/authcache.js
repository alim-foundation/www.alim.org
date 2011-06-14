// $Id: authcache.js,v 1.4 2009/09/12 16:32:52 jonahellison Exp $

var Authcache = {
  'isEnabled' : true,   // Make sure page is really cached
  'isDebug'   : false,  // Debug mode
  'json' : { },         // Holds all responses from ajaxRequest
  'ajax' : { },         // Will be extended with authcacheFooter data
  'info' : { },         // Will be extended with authcacheFooter data
  'timeStart' : new Date().getTime() // JS Benchmark
};

/**
 * Preprocess page and do Ajax request if needed.
 * Called after all other scripts have been loaded.
 */
Authcache.init = function() {

  // Is debug mode enabled?
  if($.cookie('authcache_debug') || Drupal.settings.authcacheDebug != null) {
    Authcache.isDebug = true;
    Authcache.debug(false);
    $.cookie('authcache_debug', 1); // Make sure cookie is set for benchmarks
  }

  Authcache.init.preprocess(); // see below

  // Should Ajax request be sent?  Ignore if only 'q' key exists
  authcacheLength = 0;
  for(i in Authcache.ajax) {
    authcacheLength++;
  }
  // Will also need to send request if Authcache was disabled in mid-render of HTML ("q" key won't exist since there is no authcacheFooter)
  if(authcacheLength > 1 || (!Authcache.isEnabled && authcacheLength > 0)) {
    Authcache.ajaxRequest(Authcache.ajax);
  } else if(Authcache.isDebug) {
    $("#authcachedebug").append("Ajax request not sent.<br>");
    Authcache.debugTimer();
  }
}

/**
 * Look over HTML DOM
 */
Authcache.init.preprocess = function() {

  // Display logged-in username
  $(".authcache-user").html($.cookie("drupal_user"));
  
  // Display username linked to profile
  // Example usage: <a href="" class="authcache-user-link">Welcome, !username</a>
  $("a.authcache-user-link").each(function() {
    $this = $(this);
    $this.html($this.html().replace('!username', $.cookie("drupal_user")))
         .attr("href", Drupal.settings.basePath + 'user');
  });

  // Find forms that need tokens
  $("form input[name='form_token_id']").each(function() {
    if(Authcache.ajax["form_token_id[]"] == null) Authcache.ajax["form_token_id[]"] = new Array();
    Authcache.ajax["form_token_id[]"].push(this.form.form_token_id.value);
  });

  // On form submit, check if token has been set
  $("form").submit(function() {
    if(typeof this.form_token_id != "undefined" && !this.form_token.value) {
      // Send another Ajax request to retrieve form token
      this.form_token.className = "authcache-must-submit";
      Authcache.ajaxRequest( {"form_token_id[]" : this.form_token_id.value} );
      return false;
    }
  });

  // Set Drupal core link to user profile instead of using cached link
  $("a:contains('My account')").attr("href",Drupal.settings.basePath+"user");

  // Hide tabs
  if(Authcache.info.tab_hide != null && Authcache.info.node_author != null && Authcache.info.node_author != $.cookie("drupal_user")) {
    for(i in Authcache.info.tab_hide) {
      $("ul.primary li:contains('" + Authcache.info.tab_hide[i] + "')").remove();
    }
    if($("ul.primary li").length == 1) { // Only the "View" tab remains -- remove
      $("ul.primary").remove();
    }
  }
  
  if(Authcache.isEnabled) {

    // Theme local task tab items for author
    if(Authcache.info.node_author != null && Authcache.info.node_author == $.cookie("drupal_user") && !$("ul.primary").length) {
      ajaxJson = {
        'q' : Authcache.ajax.q,
        'menu_local_tasks' : 1,
        'max_age' : 86400
      };
      Authcache.ajaxRequest(ajaxJson);
    }

    // Forums "new" markers
    if(Authcache.info.cache_uid && Authcache.ajax.q.substring(0,5) == "forum") {

      // Check for new topics
      $(".authcache-topic-new").each(function(i, elSpan) {
        if(Authcache.ajax["forum_topic_new[]"] == null) Authcache.ajax["forum_topic_new[]"] = new Array();
        id = Authcache.getValue("forum-id-", elSpan.className);
        Authcache.ajax["forum_topic_new[]"].push(id);
      });

      // Get number of new comments or if topic node is unread
      $(".authcache-topic-info").each(function(i, elSpan) {
        timestamp = Authcache.getValue("timestamp-", elSpan.className);
        nid = Authcache.getValue("nid-", elSpan.className);

        Authcache.ajax["forum_topic_info["+nid+"]"] = new Array(timestamp);
      });
    }

    // Show "edit" comment links for user
    if(Authcache.info.comment_usertime != null) {
      $(".authcache-comment-edit.comment-uid-" + $.cookie("drupal_uid")).each(function(i, elSpan) {
        cid = Authcache.getValue("comment-id-", elSpan.className);

        $(this).parent().find(".links")
          .find(".first")
          .removeClass("first")
          .parent()
          .prepend('<li class="comment_edit first"><a href="' + Drupal.settings.basePath + 'comment/edit/' + cid + '">' + Authcache.info.t.edit + '</a></li>');
      });
    }
    
  }

  // Get poll results/form
  if($("#block-poll-0").length || $("#poll-view-voting").length) {
    $(".poll").each(function(i, el) {
      elNid = $(el).find(".authcache-poll");
      nid = Authcache.getValue("nid-", elNid.get(0).className);

      ajaxJson = {
        'poll[nid]' : nid,
        'poll[block]' : $(el).parents(".block-inner").length,
        'time' : $.cookie('nid' + nid),
        'max_age' : 600
      };

      Authcache.ajaxRequest(ajaxJson);
    });
  }

};


/**
 * Perform ajax request and callback functions
 */
Authcache.ajaxRequest = function(jsonData) {

  $.ajax({
    url: Drupal.settings.basePath, // index.php
    type: "GET",
    dataType: "json",
    data: jsonData,
    
    // If response is to be cached (max_age), then a syncronous request
    // will lock the browser & prevent jumpiness on HTML DOM updates
    async: (jsonData.max_age != null) ? false : true,
    
    success: function(data) {
      Authcache.json = jQuery.extend(true, Authcache.json, data);

      // Callback functions
      for(key in data) {
        funcName = "_authcache_" + key;
        try {
          eval(funcName + "(data[key])");
        } catch(e) { }
      }

      if(Authcache.isDebug) {
        Authcache.debug({'sent':jsonData,'received':data});
      }
    },

    // Custom header to help prevent cross-site forgery requests
    // and to flag caching bootstrap that Ajax request is being made 
    beforeSend: function(xhr) {
      xhr.setRequestHeader("Authcache","1");
    },

    error: Authcache.ajaxError
  });

}

/**
 * AjaxRequest error callback
 */
Authcache.ajaxError = function(XMLHttpRequest, textStatus, errorThrown) {
  if(Authcache.isDebug) {
    $("#authcachedebug").append(Authcache.debugFieldset("Ajax Response Error ("+textStatus+")", {"ERROR":XMLHttpRequest.responseText.replace(/\n/g,"") }));
  }
}

/**
 * Return value embedded in class string
 */
Authcache.getValue = function(needle, str) {
  matches = str.match(eval("/" + needle + "(.[^\\s]*)/"));
  return (matches == null) ? false : matches[1];
}


// Check if page is really cached
jQuery(function() {

  // Page not cached for whatever reason (such as a late status message)
  if(typeof authcacheFooter == "undefined") {
    Authcache.isEnabled = false;
  }
  // Add "ajax" and "info" keys
  else {
    Authcache = jQuery.extend(true, Authcache, authcacheFooter);
  }
});


//
// Ajax callback functions
//

/**
 * Set form token
 * @see form.inc
 */
function _authcache_form_token_id(vars) {
  for(key in vars) {
    $("form input[name='form_token_id'][value='"+key+"']").each(function() {
      oInputToken = $(this.form).find("input[name='form_token']");
      oInputToken.val(vars[key]);
      // Late retierval of token (user tried to submit but no token)
      if(oInputToken.hasClass("authcache-must-submit")) { 
        this.form.submit();
      }
    });
  }
}

/**
 * Set default contact form values
 * @see contact.module
 */
function _authcache_contact(vars) {
  $("#contact-mail-page input[name='name']").val(vars.name);
  $("#contact-mail-page input[name='mail']").val(vars.mail);
}


/**
 * Display "new" marker next to comment
 * @see comment.module, node.module
 */
function _authcache_node_history(historyTimestamp) {
  if(Authcache.info.comment_usertime != null) {
    $(".authcache-comment-new").each(function(i, elSpan) {
      timestamp = Authcache.getValue("timestamp-", elSpan.className);

      if(
        timestamp >= historyTimestamp ||
        // Also give buffer for user who accesses first cached page request
        (timestamp >= Authcache.info.comment_usertime && Authcache.info.cache_time >= historyTimestamp - 2 && Authcache.info.cache_uid == $.cookie("drupal_uid"))
        ) {
  
        $(elSpan).hide().html(Authcache.info.t["new"]).fadeIn();
      }
    })
  }
}

/**
 * Display "new" marker next to new topics
 * @see forum.module
 */
function _authcache_forum_topic_new(vars) {
  for(id in vars) {
    $(".authcache-topic-new.forum-id-" + id).before("<br />").hide().html("" + vars[id]).fadeIn();
  }
}

/**
 * Display "new" marker next to new replies/comments
 * and update icon if unread or new replies
 * @see forum.module, comment.module
 */
function _authcache_forum_topic_info(vars) {
  for(id in vars) {
    $(".authcache-topic-replies.nid-" + id).before("<br />").hide().html("" + vars[id]).fadeIn();
    oIcon = $(".authcache-topic-icon.nid-" + id);
    oIcon.html(oIcon.html().replace(/default/g, "new"));
    oIcon.html(oIcon.html().replace(/-hot/g, "-hot-new"));
  }
}

/**
 * Show poll results
 * @see poll.module
 */
function _authcache_poll(vars) {
  if(vars.block == 1) {
    $("#block-poll-0 .poll").html(vars.html);
  } else {
    $("#node-" + vars.nid + " .poll").html(vars.html);
  }
}

/**
 * Render local task tab links
 * @see menu.inc
 */
function _authcache_menu_local_tasks(vars) {
  $("#authcache-tabs").html(vars);
}


/**
 * jQuery cookie plugin
 * http://plugins.jquery.com/project/Cookie
 */
jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options.expires=-1;}; var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000));}else{date=options.expires;}; expires='; expires='+date.toUTCString();}; var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('');}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break;}}}; return cookieValue;}};


////////////////////////////////////////////////////////////////
//
// Debug functions
//
// Everything below can be deleted if you don't want debug mode

/**
 * Display debug info, depending on phase
 */
Authcache.debug = function(ajaxData) {
  if(!ajaxData) {

    legend = ($.cookie('drupal_user')) ? " (logged in: "+$.cookie('drupal_user')+')' : '';

    if(Authcache.isEnabled) {
      // Get seconds page was last cached, using Unix Epoch (GMT/UTC timestamp)
      utc = (new Date()).toUTCString(); // Client's time
      utcTimestamp = Date.parse(utc) / 1000; // Convert to seconds

      Authcache.info["(page_age)"] =  Math.round(utcTimestamp - Authcache.info.cache_time) + " seconds";
      $("#authcache-info").html("<strong>This page was cached " + Authcache.info["(page_age)"] + " ago.</strong>");
      if(utcTimestamp - Authcache.info.cache_time < -10) {
        $("#authcache-info").append("<div style=\"font-size:85%\">Your computer's <a href=\"http://tycho.usno.navy.mil/cgi-bin/timer.pl\">time</a> may be off.</div>");
      }

      if(!$.cookie('authcache_debug')) {
        Authcache.info.cache_render = 'This is your first site visit and the debug cookie has just been set.';
      } else if(!isNaN($.cookie("cache_render"))) { // numeric?
        Authcache.info.cache_render = $.cookie("cache_render") + " ms"
        Authcache.info.cache_render += " (" + Math.round((Authcache.info.page_render - $.cookie("cache_render")) / $.cookie("cache_render") * 100).toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2') + "% increase)"
        $.cookie("cache_render",null);
      } else if($.cookie("cache_render")) {
        Authcache.info.cache_render = $.cookie("cache_render");
      } else {
        Authcache.info.cache_render = "n/a (try a different browser?)";
      }
      
      Authcache.info.page_render += " ms";

      debugInfo = Authcache.debugFieldset("Authcache.info"+legend, Authcache.info);

    } else {
      if(JSON.stringify(Authcache.info) == "{}") Authcache.info = "Authcache.info JSON is empty!";
      debugInfo = Authcache.debugFieldset("Authcache prevented caching", {"NO_CACHE" : "Page not cached.", "INFO" : Authcache.info });
    }
    
    debugInfo += '<a href="#" onclick="return Authcache.debugDisable();">Disable caching for this browser session</a>';

    $("body").prepend("<div style='z-index:100;text-align:left;font-size:11px;left:0px;position:absolute;background:#f7f7f7;color:#000;padding:5px;'><b><a href='#' id='authcachehide'>Authcache Debug</a></b><div id='authcachedebug' style='display:none;'>"+debugInfo+"</div></div>");
    $("#authcachehide").click(function() {$("#authcachedebug").toggle(); return false; })

    Authcache.debugTimer();
  } else {
    //ajaxLink = '<a href="'+Drupal.settings.basePath+'ajax_authcache.php?'+$.param(Authcache.ajax)+'">Authcache.ajax (sent)</a>';
    ajaxLink = 'Authcache.ajaxRequest (sent)';
    debugInfo = Authcache.debugFieldset(ajaxLink, ajaxData.sent);
    debugInfo += Authcache.debugFieldset("Authcache.ajaxRequest (received)", ajaxData.received);

    $("#authcachedebug").append(debugInfo);
    Authcache.debugTimer();
  }
}

/**
 * Disable caching by setting cookie
 */
Authcache.debugDisable = function() {
  if(confirm("Are you sure? (You can renable caching by closing and reopening your browser.)")) {
    $.cookie('nocache', 1);
    location.reload(true);
    //setTimeout("location.reload(true)", 1000);
  }
  return false;
}

/**
 * Display total JavaScript execution time for this file (including Ajax)
 */
Authcache.debugTimer = function() {
  timeMs = new Date().getTime() - Authcache.timeStart;
  $("#authcachedebug").append("HTML/JavaScript time: "+timeMs+" ms <hr size=1>");
}

/**
 * Helper function (renders HTML fieldset)
 */
Authcache.debugFieldset = function(title, jsonData) {
  fieldset = '<div style="clear:both;"></div><fieldset style="float:left;min-width:240px;"><legend>'+title+'</legend>';
  for(key in jsonData) {
    fieldset += "<b>"+key+"</b>: "+JSON.stringify(jsonData[key])+'<br>';
  }
  fieldset += '</fieldset><div style="clear:both;">';
  return fieldset;
}

/**
 * JSON to String
 * http://www.JSON.org/js.html
 */
if(!this.JSON){JSON={};}
(function(){function f(n){return n<10?'0'+n:n;}
if(typeof Date.prototype.toJSON!=='function'){Date.prototype.toJSON=function(key){return this.getUTCFullYear()+'-'+
f(this.getUTCMonth()+1)+'-'+
f(this.getUTCDate())+'T'+
f(this.getUTCHours())+':'+
f(this.getUTCMinutes())+':'+
f(this.getUTCSeconds())+'Z';};String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(key){return this.valueOf();};}
var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},rep;function quote(string){escapable.lastIndex=0;return escapable.test(string)?'"'+string.replace(escapable,function(a){var c=meta[a];return typeof c==='string'?c:'\\u'+('0000'+a.charCodeAt(0).toString(16)).slice(-4);})+'"':'"'+string+'"';}
function str(key,holder){var i,k,v,length,mind=gap,partial,value=holder[key];if(value&&typeof value==='object'&&typeof value.toJSON==='function'){value=value.toJSON(key);}
if(typeof rep==='function'){value=rep.call(holder,key,value);}
switch(typeof value){case'string':return quote(value);case'number':return isFinite(value)?String(value):'null';case'boolean':case'null':return String(value);case'object':if(!value){return'null';}
gap+=indent;partial=[];if(Object.prototype.toString.apply(value)==='[object Array]'){length=value.length;for(i=0;i<length;i+=1){partial[i]=str(i,value)||'null';}
v=partial.length===0?'[]':gap?'[\n'+gap+
partial.join(',\n'+gap)+'\n'+
mind+']':'['+partial.join(',')+']';gap=mind;return v;}
if(rep&&typeof rep==='object'){length=rep.length;for(i=0;i<length;i+=1){k=rep[i];if(typeof k==='string'){v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v);}}}}else{for(k in value){if(Object.hasOwnProperty.call(value,k)){v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v);}}}}
v=partial.length===0?'{}':gap?'{\n'+gap+partial.join(',\n'+gap)+'\n'+
mind+'}':'<br>{'+partial.join(',<br>')+'}';gap=mind;return v;}}
if(typeof JSON.stringify!=='function'){JSON.stringify=function(value,replacer,space){var i;gap='';indent='';if(typeof space==='number'){for(i=0;i<space;i+=1){indent+=' ';}}else if(typeof space==='string'){indent=space;}
rep=replacer;if(replacer&&typeof replacer!=='function'&&(typeof replacer!=='object'||typeof replacer.length!=='number')){throw new Error('JSON.stringify');}
return str('',{'':value});};}
if(typeof JSON.parse!=='function'){JSON.parse=function(text,reviver){var j;function walk(holder,key){var k,v,value=holder[key];if(value&&typeof value==='object'){for(k in value){if(Object.hasOwnProperty.call(value,k)){v=walk(value,k);if(v!==undefined){value[k]=v;}else{delete value[k];}}}}
return reviver.call(holder,key,value);}
cx.lastIndex=0;if(cx.test(text)){text=text.replace(cx,function(a){return'\\u'+
('0000'+a.charCodeAt(0).toString(16)).slice(-4);});}
if(/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,''))){j=eval('('+text+')');return typeof reviver==='function'?walk({'':j},''):j;}
throw new SyntaxError('JSON.parse');};}})();