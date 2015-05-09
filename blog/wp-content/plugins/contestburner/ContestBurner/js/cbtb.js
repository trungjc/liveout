/*
 * Thickbox 3.1 - One Box To Rule Them All.
 * By Cody Lindley (http://www.codylindley.com)
 * Copyright (c) 2007 cody lindley
 * Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
*/
		  
var cbtb_pathToImage = "";

/*!!!!!!!!!!!!!!!!! edit below this line at your own risk !!!!!!!!!!!!!!!!!!!!!!!*/

//on page load call tb_init
jQuery(document).ready(function(){   
	cbtb_init('a.cbtb, area.cbtb, input.cbtb');//pass where to apply thickbox
	cbtb_imgLoader = new Image();// preload image
	cbtb_imgLoader.src = cbtb_pathToImage;
});

//add thickbox to href & area elements that have a class of .thickbox
function cbtb_init(domChunk){
	jQuery(domChunk).live("click", cbtb_click);
}

function cbtb_click(){
		var t = this.title || this.name || null;
		var a = this.href || this.alt;
		var g = this.rel || false;
		cbtb_show(t,a,g);
		this.blur();
		return false;
}

function cbtb_show(caption, url, imageGroup) {//function called when the user clicks on a thickbox link

	try {
		if (typeof document.body.style.maxHeight === "undefined") {//if IE 6
			jQuery("body","html").css({height: "100%", width: "100%"});
			jQuery("html").css("overflow","hidden");
			if (document.getElementById("CBTB_HideSelect") === null) {//iframe to hide select elements in ie6
				jQuery("body").append("<iframe id='CBTB_HideSelect'></iframe><div id='CBTB_overlay'></div><div id='CBTB_window'></div>");
				jQuery("#CBTB_overlay").click(cbtb_remove);
			}
		}else{//all others
			if(document.getElementById("CBTB_overlay") === null){
				jQuery("body").append("<div id='CBTB_overlay'></div><div id='CBTB_window'></div>");
				jQuery("#CBTB_overlay").click(cbtb_remove);
			}
		}
		
		if(cbtb_detectMacXFF()){
			jQuery("#CBTB_overlay").addClass("CBTB_overlayMacFFBGHack");//use png overlay so hide flash
		}else{
			jQuery("#CBTB_overlay").addClass("CBTB_overlayBG");//use background and opacity
		}
		
		if(caption===null){caption="";}
		jQuery("body").append("<div id='CBTB_load'><img src='"+cbtb_imgLoader.src+"' /></div>");//add loader to the page
		jQuery('#CBTB_load').show();//show loader

		var baseURL;
	   if(url.indexOf("?")!==-1){ //ff there is a query string involved
			baseURL = url.substr(0, url.indexOf("?"));
	   }else{ 
			baseURL = url;
	   }
	   
	   var urlString = /\.jpg$|\.jpeg$|\.png$|\.gif$|\.bmp$/;
	   var urlType = baseURL.toLowerCase().match(urlString);

		if(urlType == '.jpg' || urlType == '.jpeg' || urlType == '.png' || urlType == '.gif' || urlType == '.bmp'){//code to show images
			CBTB_PrevCaption = "";
			CBTB_PrevURL = "";
			CBTB_PrevHTML = "";
			CBTB_NextCaption = "";
			CBTB_NextURL = "";
			CBTB_NextHTML = "";
			CBTB_imageCount = "";
			CBTB_FoundURL = false;
			if(imageGroup){
				CBTB_TempArray = jQuery("a[rel="+imageGroup+"]").get();
				for (CBTB_Counter = 0; ((CBTB_Counter < CBTB_TempArray.length) && (CBTB_NextHTML === "")); CBTB_Counter++) {
					var urlTypeTemp = CBTB_TempArray[CBTB_Counter].href.toLowerCase().match(urlString);
						if (!(CBTB_TempArray[CBTB_Counter].href == url)) {						
							if (CBTB_FoundURL) {
								CBTB_NextCaption = CBTB_TempArray[CBTB_Counter].title;
								CBTB_NextURL = CBTB_TempArray[CBTB_Counter].href;
								CBTB_NextHTML = "<span id='CBTB_next'>&nbsp;&nbsp;<a href='#'>Next &gt;</a></span>";
							} else {
								CBTB_PrevCaption = CBTB_TempArray[CBTB_Counter].title;
								CBTB_PrevURL = CBTB_TempArray[CBTB_Counter].href;
								CBTB_PrevHTML = "<span id='CBTB_prev'>&nbsp;&nbsp;<a href='#'>&lt; Prev</a></span>";
							}
						} else {
							CBTB_FoundURL = true;
							CBTB_imageCount = "Image " + (CBTB_Counter + 1) +" of "+ (CBTB_TempArray.length);											
						}
				}
			}

			imgPreloader = new Image();
			imgPreloader.onload = function(){		
			imgPreloader.onload = null;
				
			// Resizing large images - orginal by Christian Montoya edited by me.
			var pagesize = cbtb_getPageSize();
			var x = pagesize[0] - 150;
			var y = pagesize[1] - 150;
			var imageWidth = imgPreloader.width;
			var imageHeight = imgPreloader.height;
			if (imageWidth > x) {
				imageHeight = imageHeight * (x / imageWidth); 
				imageWidth = x; 
				if (imageHeight > y) { 
					imageWidth = imageWidth * (y / imageHeight); 
					imageHeight = y; 
				}
			} else if (imageHeight > y) { 
				imageWidth = imageWidth * (y / imageHeight); 
				imageHeight = y; 
				if (imageWidth > x) { 
					imageHeight = imageHeight * (x / imageWidth); 
					imageWidth = x;
				}
			}
			// End Resizing
			
			CBTB_WIDTH = imageWidth + 30;
			CBTB_HEIGHT = imageHeight + 60;
			jQuery("#CBTB_window").append("<a href='' id='CBTB_ImageOff' title='Close'><img id='CBTB_Image' src='"+url+"' width='"+imageWidth+"' height='"+imageHeight+"' alt='"+caption+"'/></a>" + "<div id='CBTB_caption'>"+caption+"<div id='CBTB_secondLine'>" + CBTB_imageCount + CBTB_PrevHTML + CBTB_NextHTML + "</div></div><div id='CBTB_closeWindow'><a href='#' id='CBTB_closeWindowButton' title='Close'>close</a> or Esc Key</div>"); 		
			
			jQuery("#CBTB_closeWindowButton").click(cbtb_remove);
			
			if (!(CBTB_PrevHTML === "")) {
				function goPrev(){
					if(jQuery(document).unbind("click",goPrev)){jQuery(document).unbind("click",goPrev);}
					jQuery("#CBTB_window").remove();
					jQuery("body").append("<div id='CBTB_window'></div>");
					tb_show(CBTB_PrevCaption, CBTB_PrevURL, imageGroup);
					return false;	
				}
				jQuery("#CBTB_prev").click(goPrev);
			}
			
			if (!(CBTB_NextHTML === "")) {		
				function goNext(){
					jQuery("#CBTB_window").remove();
					jQuery("body").append("<div id='CBTB_window'></div>");
					tb_show(CBTB_NextCaption, CBTB_NextURL, imageGroup);				
					return false;	
				}
				jQuery("#CBTB_next").click(goNext);
				
			}

			document.onkeydown = function(e){ 	
				if (e == null) { // ie
					keycode = event.keyCode;
				} else { // mozilla
					keycode = e.which;
				}
				if(keycode == 27){ // close
					cbtb_remove();
				} else if(keycode == 190){ // display previous image
					if(!(CBTB_NextHTML == "")){
						document.onkeydown = "";
						goNext();
					}
				} else if(keycode == 188){ // display next image
					if(!(CBTB_PrevHTML == "")){
						document.onkeydown = "";
						goPrev();
					}
				}	
			};
			
			cbtb_position();
			jQuery("#CBTB_load").remove();
			jQuery("#CBTB_ImageOff").click(cbtb_remove);
			jQuery("#CBTB_window").css({display:"block"}); //for safari using css instead of show
			};
			
			imgPreloader.src = url;
		}else{//code to show html
			var queryString = url.replace(/^[^\?]+\??/,'');
			var params = cbtb_parseQuery( queryString );

			CBTB_WIDTH = (params['width']*1) + 30 || 630; //defaults to 630 if no paramaters were added to URL
			CBTB_HEIGHT = (params['height']*1) + 40 || 440; //defaults to 440 if no paramaters were added to URL
			ajaxContentW = CBTB_WIDTH - 30;
			ajaxContentH = CBTB_HEIGHT - 45;
			
			if(url.indexOf('CBTB_iframe') != -1){// either iframe or ajax window		
					urlNoQuery = url.split('CBTB_');
					jQuery("#CBTB_iframeContent").remove();
					if(params['modal'] != "true"){//iframe no modal
						jQuery("#CBTB_window").append("<div id='CBTB_title'><div id='CBTB_ajaxWindowTitle'>"+caption+"</div><div id='CBTB_closeAjaxWindow'><a href='#' id='CBTB_closeWindowButton' title='Close'>close</a> or Esc Key</div></div><iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='CBTB_iframeContent' name='CBTB_iframeContent"+Math.round(Math.random()*1000)+"' onload='cbtb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;' > </iframe>");
					}else{//iframe modal
						jQuery("#CBTB_overlay").unbind();
						jQuery("#CBTB_window").append("<iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='CBTB_iframeContent' name='CBTB_iframeContent"+Math.round(Math.random()*1000)+"' onload='cbtb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;'> </iframe>");
					}
			}else{// not an iframe, ajax
					if(jQuery("#CBTB_window").css("display") != "block"){
						if(params['modal'] != "true"){//ajax no modal
						jQuery("#CBTB_window").append("<div id='CBTB_title'><div id='CBTB_ajaxWindowTitle'>"+caption+"</div><div id='CBTB_closeAjaxWindow'><a href='#' id='CBTB_closeWindowButton'>close</a> or Esc Key</div></div><div id='CBTB_ajaxContent' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px'></div>");
						}else{//ajax modal
						jQuery("#CBTB_overlay").unbind();
						jQuery("#CBTB_window").append("<div id='CBTB_ajaxContent' class='CBTB_modal' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px;'></div>");	
						}
					}else{//this means the window is already up, we are just loading new content via ajax
						jQuery("#CBTB_ajaxContent")[0].style.width = ajaxContentW +"px";
						jQuery("#CBTB_ajaxContent")[0].style.height = ajaxContentH +"px";
						jQuery("#CBTB_ajaxContent")[0].scrollTop = 0;
						jQuery("#CBTB_ajaxWindowTitle").html(caption);
					}
			}
					
			jQuery("#CBTB_closeWindowButton").click(cbtb_remove);
			
				if(url.indexOf('CBTB_inline') != -1){	
					jQuery("#CBTB_ajaxContent").append(jQuery('#' + params['inlineId']).children());
					jQuery("#CBTB_window").unload(function () {
						jQuery('#' + params['inlineId']).append( jQuery("#CBTB_ajaxContent").children() ); // move elements back when you're finished
					});
					cbtb_position();
					jQuery("#CBTB_load").remove();
					jQuery("#CBTB_window").css({display:"block"}); 
				}else if(url.indexOf('CBTB_iframe') != -1){
					cbtb_position();
					if(jQuery.browser.safari){//safari needs help because it will not fire iframe onload
						jQuery("#CBTB_load").remove();
						jQuery("#CBTB_window").css({display:"block"});
					}
				}else{
					jQuery("#CBTB_ajaxContent").load(url += "&random=" + (new Date().getTime()),function(){//to do a post change this load method
						cbtb_position();
						jQuery("#CBTB_load").remove();
						tb_init("#CBTB_ajaxContent a.cbtb");
						jQuery("#CBTB_window").css({display:"block"});
					});
				}
			
		}

		if(!params['modal']){
			document.onkeyup = function(e){ 	
				if (e == null) { // ie
					keycode = event.keyCode;
				} else { // mozilla
					keycode = e.which;
				}
				if(keycode == 27){ // close
					cbtb_remove();
				}	
			};
		}
		
	} catch(e) {
		//nothing here
	}
}

//helper functions below
function cbtb_showIframe(){
	jQuery("#CBTB_load").remove();
	jQuery("#CBTB_window").css({display:"block"});
}

function cbtb_remove() {
 	jQuery("#CBTB_imageOff").unbind("click");
	jQuery("#CBTB_closeWindowButton").unbind("click");
	jQuery("#CBTB_window").fadeOut("fast",function(){jQuery('#CBTB_window,#CBTB_overlay,#CBTB_HideSelect').trigger("unload").unbind().remove();});
	jQuery("#CBTB_load").remove();
	if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
		jQuery("body","html").css({height: "auto", width: "auto"});
		jQuery("html").css("overflow","");
	}
	document.onkeydown = "";
	document.onkeyup = "";
	return false;
}

function cbtb_position() {
var isIE6 = typeof document.body.style.maxHeight === "undefined";
jQuery("#CBTB_window").css({marginLeft: '-' + parseInt((CBTB_WIDTH / 2),10) + 'px', width: CBTB_WIDTH + 'px'});
	if ( ! isIE6 ) { // take away IE6
		jQuery("#CBTB_window").css({marginTop: '-' + parseInt((CBTB_HEIGHT / 2),10) + 'px'});
	}
}

function cbtb_parseQuery ( query ) {
   var Params = {};
   if ( ! query ) {return Params;}// return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) {continue;}
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function cbtb_getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;
	arrayPageSize = [w,h];
	return arrayPageSize;
}

function cbtb_detectMacXFF() {
  var userAgent = navigator.userAgent.toLowerCase();
  if (userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) {
    return true;
  }
}


