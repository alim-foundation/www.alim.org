/*
========================================
 Scrolling for Overlong Menus v1.0.3
 Add-on for SmartMenus v6.0+
========================================
 (c)2008 ET VADIKOM-VASIL DINKOV
========================================
*/


c_scrolling=[
'[http://www.alim.org/sites/all/themes/alim/scroll_menu/scroll_top.gif]',	// TopScrollingImageSource ('[image_source]')
'[http://www.alim.org/sites/all/themes/alim/scroll_menu/scroll_bottom.gif]',	// BottomScrollingImageSource
'Scroll up',		// TopScrollingImageAlt
'Scroll down',		// BottomScrollingImageAlt
28,			// ScrollingImagesWidth
18,			// ScrollingImagesHeight
3,			// ScrollingImagesOffset (pixels) - offset from window's top and bottom edges
24,			// ScrollingStep (pixels)
50			// ScrollingInterval (1000==1 second)
];


// ===
c_adS={};if(c_nS){c_adS.t="marginTop";c_adS.l="marginLeft"}else{c_adS.t="top";c_adS.l="left"};c_adS.k=(!c_iEM&&(!c_gC||c_pS>=20020530));c_adS.i=[""];c_cI(c_scrolling[0]);c_cI(c_scrolling[1]);c_adS.C=function(e){if(!e)e=event;if(e.stopPropagation)e.stopPropagation();else e.cancelBubble=true;if(e.preventDefault)e.preventDefault();return false};c_adS.P=function(e){while(c_nN(e)!="UL")e=e.parentNode;return e};c_adS.MV=function(e){if(!e)e=event;var t,x;t=e.target||e.srcElement;x=/SM6S[TBH]/;if(x.test(t.className))return;if(c_adS.P(t)==this)c_adS.A(this.ADS)};c_adS.MU=function(e){if(!e)e=event;var t,r,x;t=e.target||e.srcElement;r=e.relatedTarget||e.toElement||"";x=/SM6S[TB]/;if(x.test(t.className)||x.test(r.className))return;if(!c_cT(this,r)||c_adS.P(r)!=this)c_adS.A(this.ADS,1)};c_adS.A=function(i,h){var a=c_adS.i[i],v=h?"hidden":"visible";if(a){a[1].style.visibility=v;a[2].style.visibility=v}};c_adS.w=function(e){if(!e)e=event;var t=e.target||e.srcElement;while(c_nN(t)!="UL")t=t.parentNode;if(t!=this){if(e.preventDefault)e.preventDefault();return false}var d,i;d=e.detail?-e.detail:e.wheelDelta;i=this.ADS;c_adS.i[i][d>0?2:1].style.display="block";c_adS.S(i,d>0);if(e.preventDefault)e.preventDefault();return false};c_adS.S=function(i,u){var a=c_adS.i[i],c=parseInt(a[0][a[8]]),m=a[3]+(u?0:a[5]-a[4]);a[0][a[8]]=Math.abs(m-c)>c_scrolling[7]?c+(u?c_scrolling[7]:-c_scrolling[7])+"px":m+"px";if(a[0][a[8]]==m+"px"){a[u?1:2].style.display="none";clearInterval(a[6])}};c_adS.B=function(e){c_mV();var i=this.ADS,a=c_adS.i[i],u=/SM6ST/.test(this.className);a[6]=setInterval("c_adS.S("+i+","+u+")",c_scrolling[8]);c_adS.S(i,u);a[u?2:1].style.display="block"};c_adS.E=function(e){clearInterval(c_adS.i[this.ADS][6]);c_mU()};c_adS.sH=c_sH;c_sH=function(u){c_adS.sH(u);if(!c_adS.k)return;var h,c;h=u.offsetHeight;c=c_gW();if(h>c.h){var i,w,l,t,b,C,a,x,y;if(!u.ADS){if(!u.FX){var U,US=c_gT(u,"ul");for(i=0;i<US.length;){U=US[i++];U.style.display="none";U.FX=1}u.FX=1}c_aE(u,"onmouseover",c_adS.MV);c_aE(u,"onmouseout",c_adS.MU);if(c_gC&&u.addEventListener)u.addEventListener("DOMMouseScroll",c_adS.w,0);u.onmousewheel=c_adS.w;u.ADS=c_adS.i.length}i=u.ADS;w=u.offsetWidth;l=u.parentNode;C="display:none;width:"+c_scrolling[4]+"px;height:"+c_scrolling[5]+"px;z-index:11112;position:absolute;top:auto;left:auto;visibility:hidden;";c_adS.i[i]=[];a=c_adS.i[i];a[0]=u.style;a[1]=c_cE("img",l);t=a[1];c_iE||c_gCo?t.style.cssText=C:t.setAttribute("style",C);a[2]=t.cloneNode(true);b=a[2];t.src=c_imagesPath+c_scrolling[0].substring(1,c_scrolling[0].length-1);b.src=c_imagesPath+c_scrolling[1].substring(1,c_scrolling[1].length-1);t.setAttribute("alt",c_scrolling[2]);b.setAttribute("alt",c_scrolling[3]);t.setAttribute("title","");b.setAttribute("title","");t.className="SM6ST";b.className="SM6SB";if(u.PP&&u.LV==1){a[7]="left";a[8]="top"}else{a[7]=c_adS.l;a[8]=c_adS.t}x=parseInt(u.style[a[7]])+parseInt((w-c_scrolling[4])/2);y=parseInt(u.style[a[8]]);t.style[a[7]]=x+"px";b.style[a[7]]=x+"px";t.style[a[8]]=y+c_scrolling[6]+"px";b.style[a[8]]=y+c.h-c_scrolling[5]-c_scrolling[6]+"px";b.style.display="block";t.onmouseover=c_adS.B;b.onmouseover=c_adS.B;t.onmouseout=c_adS.E;b.onmouseout=c_adS.E;if(c_gC&&t.addEventListener)t.addEventListener("DOMMouseScroll",c_adS.C,0);t.onmousewheel=c_adS.C;if(c_gC&&b.addEventListener)b.addEventListener("DOMMouseScroll",c_adS.C,0);b.onmousewheel=c_adS.C;t.ADS=i;b.ADS=i;a[3]=y;a[4]=h;a[5]=c.h;l.insertBefore(t,u.nextSibling);l.insertBefore(b,t.nextSibling)}};c_adS.hM=c_hM;c_hM=function(o,f){if(c_adS.i[o.ADS]){var i=o.ADS,l=o.parentNode;try{l.removeChild(c_adS.i[i][1]);l.removeChild(c_adS.i[i][2])}catch(e){};delete c_adS.i[i]}c_adS.hM(o,f)}