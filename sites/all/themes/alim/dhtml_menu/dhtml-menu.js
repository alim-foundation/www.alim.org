// <script>

// Copyright (C) 2005 Ilya S. Lyubinskiy. All rights reserved.
// Technical support: http://www.php-development.ru/
//
// YOU MAY NOT
// (1) Remove or modify this copyright notice.
// (2) Distribute this code, any part or any modified version of it.
//     Instead, you can link to the homepage of this code:
//     http://www.php-development.ru/javascripts/menu.php.
//
// YOU MAY
// (1) Use this code on your website.
// (2) Use this code as a part of another product provided that
//     its main use is not creating javascript menus.
//
// NO WARRANTY
// This code is provided "as is" without warranty of any kind, either
// expressed or implied, including, but not limited to, the implied warranties
// of merchantability and fitness for a particular purpose. You expressly
// acknowledge and agree that use of this code is at your own risk.


function at_display(x)
{
  var win = window.open();
  for (var i in x) win.document.write(i+' = '+x[i]+'<br>');
}

// ***** DropDown Box **********************************************************

var at_timeout = 50;

// ***** Show Aux *****

function at_show_aux(parent, child)
{
  var p = document.getElementById(parent);
  var c = document.getElementById(child);

  p.className        = "active";

  if (c.offsetWidth <= 0)
  {
    c.style.position   = "absolute";
    c.style.visibility = "visible";
    c.style.display    = "block";
  }

  var direction = undefined;
  if (p.parentNode && p.parentNode["at_position"] == "x")
    direction = p.parentNode["at_direction"];

  var top   = (c["at_position"] == "y") ?  p.offsetHeight : 0;
  var left1 = (c["at_position"] == "x") ?  p.offsetWidth  : 0;
  var left2 = (c["at_position"] == "x") ? -c.offsetWidth  : 0;
  var left3 = (c["at_position"] == "x") ?  p.offsetWidth  : 0;

  for (; p; p = p.offsetParent)
  {
    if (p.style.position != 'absolute')
    {
      left1 += p.offsetLeft;
      left2 += p.offsetLeft;
      top   += p.offsetTop;
    }
    left3 += p.offsetLeft;
  }

  if (direction)
  {
    left = (direction == 'right') ? left1 : left2;
    c['at_direction'] = direction;
  }
  else
  {
    left = (left3+c.offsetWidth < document.body.offsetWidth) ? left1 : left2;
    c['at_direction'] = (left3+c.offsetWidth < document.body.offsetWidth) ? 'right' : 'left';
  }

  c.style.position   = "absolute";
  c.style.visibility = "visible";
  c.style.display    = "block";
  c.style.top        = top +'px';
  c.style.left       = left+'px';
}

// ***** Hide Aux *****

function at_hide_aux(parent, child)
{
  document.getElementById(parent).className        = "parent";
  document.getElementById(child ).style.visibility = "hidden";
  document.getElementById(child ).style.display    = "block";
}

// ***** Show *****

function at_show(e)
{
  var p = document.getElementById(this["at_parent"]);
  var c = document.getElementById(this["at_child" ]);

  at_show_aux(p.id, c.id);

  clearTimeout(c["at_timeout"]);
}

// ***** Hide *****

function at_hide()
{
  var c = document.getElementById(this["at_child"]);

  c["at_timeout"] = setTimeout("at_hide_aux('"+this["at_parent"]+"', '"+this["at_child" ]+"')", at_timeout);
}

// ***** Attach *****

function at_attach(parent, child, position)
{
  p = document.getElementById(parent);
  c = document.getElementById(child );

  p["at_child"]    = c.id;
  c["at_child"]    = c.id;
  p["at_parent"]   = p.id;
  c["at_parent"]   = p.id;
  c["at_position"] = position;

  p.onmouseover = at_show;
  p.onmouseout  = at_hide;
  c.onmouseover = at_show;
  c.onmouseout  = at_hide;
}

// ***** DropDown Menu *********************************************************

// ***** Build Aux *****

function dhtmlmenu_build_aux(parent, child, position)
{
  document.getElementById(parent).className = "parent";

  document.write('<div class="vert_menu" id="'+parent+'_child">');

  var n = 0;
  for (var i in child)
  {
    if (i == '-')
    {
      document.getElementById(parent).href = child[i];
      continue;
    }

    if (typeof child[i] == "object")
    {
      document.write('<a class="parent" id="'+parent+'_'+n+'">'+i+'</a>');
      dhtmlmenu_build_aux(parent+'_'+n, child[i], "x");
    }
    else document.write('<a id="'+parent+'_'+n+'" href="'+child[i]+'">'+i+'</a>');
    n++;
  }

  document.write('</div>');

  at_attach(parent, parent+"_child", position);
}

// ***** Build *****

function dhtmlmenu_build(menu)
{
  for (var i in menu) dhtmlmenu_build_aux(i, menu[i], "y");
}
