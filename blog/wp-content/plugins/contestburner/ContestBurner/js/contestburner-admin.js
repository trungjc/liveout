/*
	ContestBurner Admin js
*/

jQuery(document).ready(function($) {
	$(".submitdelete").click(function(){
		var msg = 'ContestBurner Points are enabled for this item, please remove the check from "Award Contest Points" before deleting the item.';
		/*
		if($(this).closest('div').hasClass('row-actions')) {
			var href = $(this).attr('href');
			var post_id = href.replace(/.*post=(\d+).*./, "$1");
			$.ajax({
				url: ajaxurl,
				type: "POST",
				async: false,
				data: ({
					action: "has_post_points",
					post_id: post_id
				}),
				success: function(html) {
					if(html == '1') {
						var edit_href = href.replace(/action=trash/, "action=edit");
						window.location.href = edit_href;
						$("a").clearQueue();
					}
				}
			});
		} else {
		*/
			if($('#contest_points input[name="award_points"]').attr("checked")) {
				$('#publishing-action #ajax-loading').hide();
				$('input[name="award_points"]').focus();
				$('#contest_points').removeClass('closed');
				$('#contest_points').css("background-color", "lightYellow");
				$('#contest_points').css("border-color", "#E6DB55");
				alert(msg);
				return false;
			}
		/* } */
	});

});
