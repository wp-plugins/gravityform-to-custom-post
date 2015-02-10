<?php
/*
Plugin Name: GravityForm to Post 
Plugin URI: http://codeholic.in/
Description: Shows "GravityForm to Custom Post"
Version: 0.9
Author: Pramod Jodhani
Author URI: http://codeholic.in/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.htmls
*/

include_once "on_submit.php";


//--------------- code starts here --------------- //

add_filter('gform_form_settings', 'gfcp_settings_page', 10, 2);
function gfcp_settings_page($settings, $form) {

	$postypes 		= get_post_types();
	$gfcp_options 	= "";

	$gfpc_settings = rgar($form , "gfpc_settings");
	$gfpc_settings_post_type = rgar($form , "gfpc_settings_post_type");

	foreach($postypes as $pt ) {
		//echo $pt." ";
		$gfcp_options .= "<option value='".$pt."'  ".selected($gfpc_settings_post_type, $pt, false).">".$pt."</option>";
	}

    $settings['Save Post']['gfpc_settings'] = '
        <tr>
            <td cellspan=2>
				<input type="checkbox" name="gfpc_settings" id="gfpc_settings" '.checked($gfpc_settings,"on", false).'>	
	            <label for="gfpc_settings">Enable Post saving for this form</label>
            </td>

        </tr>
		<tr>
            <th>
	            <label for="gfpc_settings_post_type">Enable Post saving for this form</label>
            </th>
            <td>
				<select name="gfpc_settings_post_type" id="gfpc_settings_post_type">
				'.$gfcp_options.'
				</select>
            </td>
        </tr>
        ';

    return $settings;
}

// save your custom form setting
add_filter('gform_pre_form_settings_save', 'save_my_custom_form_setting');
function save_my_custom_form_setting($form) {
    $form['gfpc_settings'] = rgpost('gfpc_settings');
    $form['gfpc_settings_post_type'] = rgpost('gfpc_settings_post_type');
    return $form;
}