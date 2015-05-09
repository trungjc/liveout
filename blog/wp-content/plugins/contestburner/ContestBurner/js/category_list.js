/* Copyright 2009-2011 McIntosh Marketing, All rights reserved. */
				jQuery(document).ready(function($) {
					$("#category_list :checkbox").click(function(){
						var optClass = "."+$(this).attr("id");
						var parentID = $(this).attr("class");
						if($(this).attr("checked")) {
							$(optClass).attr("checked", "1");
						} else {
							$(optClass).removeAttr("checked");
						}
				        if ( $("."+parentID).length == $("."+parentID+":checked").length ) {
				            $("#"+parentID).attr("checked", "1");
				        } else {
				            $("#"+parentID).removeAttr("checked");
				        }
					});

					$("#save_cats").live("click", function(){
						var td = $(this).closest("td");
						var prizeCatDiv = $("#prize_categories", td);
						var prizeCatEdit = $("#prize_categories_edit", td);
						var catLoadingAni = $("#prize_loading_cats_ani", td);
						var prizeCats = $("input:first", td);
						var selectedCats = $("#selected_prize_cats", td);
						
						prizeCatEdit.hide();
						catLoadingAni.show();
	
						var cats = $("#category_form", td).serializeArray();
						
						if(jQuery.isArray(cats)) {
							prizeCats.val("");
							selectedCats.empty();
							jQuery.each(cats, function(i, cat){
								id = cat.name.match(/\[(.*?)\]/);
								var curVal = prizeCats.val();
								if (curVal.length > 0) {
									curVal += ",";
								}
								prizeCats.val(curVal + id[1]);
							});
							
							$.ajax({
								url: CB_ajax_url,
								type: "POST",
								data: ({
									action: "contest_display_selected_categories",
									selected: prizeCats.val()
								}),
								success: function(html) {
									selectedCats.html(html);
									prizeCatEdit.hide();
									prizeCatEdit.empty();
								}
							});
							cbSaveContest();
						}
						
	
						prizeCatDiv.show();
						catLoadingAni.hide();
						
						return false;
					});
				});
