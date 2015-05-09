function cb_updateFBCommentsBox() { 
    setTimeout(function(){
        var cb_username = $(document).find(".cb_username").html();
        $(".contest_fb_comments_box", top.document).each(function(i, cbox) {
            $(cbox).attr("u", cb_username);
            $(cbox).load(
                contestburner_ajax_url,
                {
                    action: "contest_ajax_fb_comments_box", 
                    contest: $(cbox).attr("c"),
                    width: $(cbox).attr("w"),
                    numposts: $(cbox).attr("n")
                } 
            ); 
        });
    }, 1);
};
function cb_pinImage(pinUrl){
    var $images = $("img", top.window.document);
    var html = "";
    for (x=0; x<$images.length; x++) {
        if ($images[x].src.indexOf("ContestBurner/images") == -1 && $images[x].src.indexOf("privacy_8pt") == -1) {
            html += '<div class="fb_photo">'
                        +'<span class="frame thumb">'
                            +'<span style="background-image: url(\'' + $images[x].src + '\'); background-size: contain;" data-pinurl="' + pinUrl + '&media=' + encodeURIComponent($images[x].src) + '" /></span>'
                        +'</span>'
                    +'</div>';
        }
    }
    $cbPinDialog.html(html).dialog({
        title: '<img src="'+contestburner_url+'/ContestBurner/images/pinterest-logo_99x26.png" style="float:left;margin-right:12px;" /><span style="float:left;">Pin an Image</span>',
        draggable: false,
        resizable: false,
        modal: true,
        position: "right",
        width: 610,
        height: 320
    });
}
$(".fb_photo", top.window.document).live("click", function() {
    $thumb = $(".thumb", this);
    if ( $thumb.hasClass("highlighted") ) {
        $cbPinButton.detach();
        $thumb.removeClass("highlighted");
    } else {
        $(".fb_photo .thumb.highlighted", top.window.document).removeClass("highlighted");
        $thumb.addClass("highlighted");
        $thumb.children("span").append($cbPinButton);
    }
});
var $cbPinDialog = $('<div id="cb_pin_dialog"></div>').appendTo(top.window.document);
var $cbPinButton = $('<img src="'+contestburner_url+'/ContestBurner/images/pinit.png" />', top.window.document).click(function(){
    var pageUrl = $(this).closest('span').attr('data-pinurl');
    window.open(pageUrl, "cb_popup", "scrollbars=no,location=no,address=no,menubar=no,status=no,toolbar=no,width=680,height=600");
    $("#cb_pin_dialog", top.window.document).dialog("close");
});
(function(){
    var $firstScript = $("script:first", top.window.document);
    $('<link rel="stylesheet" type="text/css" href="'+contestburner_url+'/ContestBurner/css/jquery-ui-1.8.21.custom.css">').insertBefore($firstScript);
    $('<link rel="stylesheet" type="text/css" href="'+contestburner_url+'/ContestBurner/css/contest.css">').insertBefore($firstScript);
})();
