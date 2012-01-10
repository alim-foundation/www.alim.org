BOOMR.subscribe('before_beacon', function(o) {
	var element = document.getElementById('boomerang-results');
  if (element) {
    var html = "";
    var t_other;
    
    if(o.page_id) { html += "Page ID: " + o.page_id + "<br>"; }
	if(o.ipaddress) { html += "IP Address: " + o.ipaddress + "<br>"; }
    if(o.uid) { html += "User ID: " + o.uid + "<br>"; }
    if(o.uname) { html += "Username: " + o.uname + "<br>"; }

    if(o.t_done) { html += "Total page load: " + o.t_done + "ms<br>"; }
    if(o.t_resp) { html += "Response: " + o.t_resp + "ms<br>"; }
    if(o.t_page) { html += "Page load: " + o.t_page + "ms<br>"; }
    if(o.t_other) {
      t_other = o.t_other.replace(/\|/g, ' = ').split(',');
      html += "Other timers measured: <br>";
      for(var i=0; i<t_other.length; i++) {
        html += "&nbsp;&nbsp;&nbsp;" + t_other[i] + " ms<br>";
      }
    }
    if(o.bw) { html += "Your bandwidth to this server is " + parseInt(o.bw/1024) + "kbps (&#x00b1;" + parseInt(o.bw_err*100/o.bw) + "%)<br>"; }
    if(o.lat) { html += "Your latency to this server is " + parseInt(o.lat) + "&#x00b1;" + o.lat_err + "ms<br>"; }

    element.innerHTML = html;
  }
});

/**
 * Overrides drupal built-in attachBehaviors() JS function so we can measure
 * each behavior with jiffy.
 *
 * @see Drupal.attachBehaviors in drupal.js for documentation about this file
 */
Drupal.attachBehaviors = function(context) {
  BOOMR.plugins.RT.startTimer("b_attachBehaviors");
  context = context || document;
  if (Drupal.jsEnabled) {
    // Execute all of them.
    jQuery.each(Drupal.behaviors, function(i, value) {
      BOOMR.plugins.RT.startTimer("b_" + i);
      this(context);
      BOOMR.plugins.RT.endTimer("b_" + i);
    });
  }
  BOOMR.plugins.RT.endTimer("b_attachBehaviors");
};
