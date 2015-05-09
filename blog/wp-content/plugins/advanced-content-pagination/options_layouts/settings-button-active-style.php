<tr>
    <th colspan="4" scope="col"><h2><?php _e('Pagination Active Button Style','ac_paging');?></h2></th>
</tr>

<tr class="type-post status-publish format-standard hentry category-uncategorized alternate iedit author-self level-0" valign="top">
    <th scope="row">
        <label for="acp_active_button_border_css"><?php _e('Active Button Border CSS','ac_paging');?>:</label>
    </th>
    <td colspan="3">
        <input type="text" class="regular-text" value="<?php echo $this->acp_options_serialized->acp_active_button_border_css; ?>" id="acp_active_button_border_css" name="acp_active_button_border_css" placeholder="<?php _e('Example: 1px solid #ff0000', 'ac_paging'); ?>"/>
    </td>
</tr>

<tr class="type-post status-publish format-standard hentry category-uncategorized alternate iedit author-self level-0" valign="top">
    <th scope="row">
        <label for="acp_active_button_background_css">Active Button Background Color: </label>
    </th>
    <td class="picker_input_cell">
        <input type="text" class="regular-text" value="<?php echo $this->acp_options_serialized->acp_active_button_background_css; ?>" id="acp_active_button_background_css" name="acp_active_button_background_css" placeholder="<?php _e('Example: #0000ff', 'ac_paging'); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#openModal4">
            <img class="colorpicker_img4" src="<?php echo plugins_url('advanced-content-pagination/files/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="openModal4" class="modalDialog">
            <div id="box4" style="border-top-left-radius: 10px; border-bottom-right-radius: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px;">
                <a href="#close" title="Close" class="close">X</a>
                <h2><?php _e('Color Picker','ac_paging');?></h2>
                <p id="colorpickerHolder4"></p>
            </div>
        </div>
    </td>
</tr>

<tr class="type-post status-publish format-standard hentry category-uncategorized alternate iedit author-self level-0" valign="top">
    <th scope="row">
        <label for="acp_active_button_text_color_css"><?php _e('Active Button Text Color','ac_paging');?>: </label>
    </th>
    <td class="picker_input_cell">
        <input type="text" class="regular-text" value="<?php echo $this->acp_options_serialized->acp_active_button_text_color_css; ?>" id="acp_active_button_text_color_css" name="acp_active_button_text_color_css" placeholder="<?php _e('Example: #0000ff', 'ac_paging'); ?>"/>
    </td>

    <td class="picker_img_cell">
        <a href="#openModal5">
            <img class="colorpicker_img5" src="<?php echo plugins_url('advanced-content-pagination/files/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="openModal5" class="modalDialog">
            <div id="box5" style="border-top-left-radius: 10px; border-bottom-right-radius: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px;">
                <a href="#close" title="Close" class="close">X</a>
                <h2><?php _e('Color Picker','ac_paging');?></h2>
                <p id="colorpickerHolder5"></p>
            </div>
        </div>
    </td>
</tr>
<tr class="type-post status-publish format-standard hentry category-uncategorized alternate iedit author-self level-0" valign="top">
    <th scope="row">
        <label for="acp_load_container_css"><?php _e('Loading Background Color','ac_paging');?>: </label>
    </th>
    <td class="picker_input_cell">
        <input type="text" class="regular-text" value="<?php echo $this->acp_options_serialized->acp_load_container_css; ?>" id="acp_load_container_css" name="acp_load_container_css" placeholder="<?php _e('Example: #cccccc', 'ac_paging'); ?>"/>
    </td>
    <td class="picker_img_cell">
        <a href="#openModal7">
            <img class="colorpicker_img7" src="<?php echo plugins_url('advanced-content-pagination/files/img/colorpicker_icon_22.png'); ?>" />
        </a>
    </td>
    <td class="color_picker">
        <div id="openModal7" class="modalDialog">
            <div id="box7" style="border-top-left-radius: 10px; border-bottom-right-radius: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px;">
                <a href="#close" title="Close" class="close">X</a>
                <h2><?php _e('Color Picker','ac_paging');?></h2>
                <p id="colorpickerHolder7"></p>
            </div>
        </div>
    </td>
</tr>