<?php
/*
Plugin Name: Single MP3 Player
Plugin URI: http://www.flashdo.com/item/single-mp3-player/67
Description: XML driven dynamic sliding image gallery for product showcase / banner rotators with thumbnails.
Version: 1.0.0
Author: FlashBlue
Author URI: http://www.flashdo.com/user/flashblue
License: GPL2
*/

/* start global parameters */
	$singlemp3player_params = array(
		'count'	=> 0, // number of Single MP3 Player embeds
	);
/* end global parameters */

/* start client side functions */
	function singlemp3player_get_embed_code($singlemp3player_attributes) {
		global $singlemp3player_params;
		$singlemp3player_params['count']++;

		$plugin_dir = get_option('singlemp3player_path');
		if ($plugin_dir === false) {
			$plugin_dir = 'flashdo/flashblue/single-mp3-player';
		}
		$plugin_dir = trim($plugin_dir, '/');

		$xml_file_name = !empty($singlemp3player_attributes[2]) ? $singlemp3player_attributes[2] : 'xml/mp3player.xml';
		$xml_file_path = WP_CONTENT_DIR . "/{$plugin_dir}/{$xml_file_name}";

			
		if ((int)$singlemp3player_attributes[4] > 0 && (int)$singlemp3player_attributes[6] > 0) {
			$width = (int)$singlemp3player_attributes[4];
			$height = (int)$singlemp3player_attributes[6];
		} else {
			$width = 590;
			$height = 300;
		}

		$swf_embed = array(
			'width' => $width,
			'height' => $height,
			'text' => isset($singlemp3player_attributes[7]) ? trim($singlemp3player_attributes[7]) : '',
			'component_path' => WP_CONTENT_URL . "/{$plugin_dir}/",
			'swf_name' => 'mp3player.swf',
		);
		$swf_embed['swf_path'] = $swf_embed['component_path'].$swf_embed['swf_name'];

		if (!is_feed()) {
			$embed_code = '<div id="singlemp3player'.$singlemp3player_params['count'].'">'.$swf_embed['text'].'</div>';
			$embed_code .= '<script type="text/javascript">';
			$embed_code .= "swfobject.embedSWF('{$swf_embed['swf_path']}', 'singlemp3player{$singlemp3player_params['count']}', '{$swf_embed['width']}', '{$swf_embed['height']}', '9.0.0.0', '', {".($xml_file_name != 'xml/mp3player.xml' ? "xmlUrl: '{$xml_file_name}'" : '')."}, {base: '{$swf_embed['component_path']}', scale: 'noscale', salign: 'tl', wmode: 'transparent', allowScriptAccess: 'sameDomain', allowFullScreen: true }, {});";
			$embed_code.= '</script>';
		} else {
			$embed_code = '<object width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'">';
			$embed_code .= '<param name="base" value="'.$swf_embed['component_path'].'"></param>';
			$embed_code .= '<param name="movie" value="'.$swf_embed['swf_path'].'"></param>';
			$embed_code .= '<param name="scale" value="noscale"></param>';
			$embed_code .= '<param name="salign" value="tl"></param>';
			$embed_code .= '<param name="wmode" value="transparent"></param>';
			$embed_code .= '<param name="allowScriptAccess" value="sameDomain"></param>';
			$embed_code .= '<param name="allowFullScreen" value="true"></param>';
			$embed_code .= '<param name="sameDomain" value="true"></param>';
			$embed_code .= '<param name="flashvars" value="'.($xml_file_name != 'xml/mp3player.xml' ? '&xmlUrl='.$xml_file_name : '').'"></param>';
			$embed_code .= '<embed type="application/x-shockwave-flash" width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'" src="'.$swf_embed['swf_path'].'" scale="noscale" salign="tl" wmode="transparent" allowScriptAccess="sameDomain" allowFullScreen="true" flashvars="'.($xml_file_name != 'xml/mp3player.xml' ? '&xmlUrl='.$xml_file_name : '').'"';
			$embed_code .= '></embed>';
			$embed_code .= '</object>';
		}

		return $embed_code;
	}

	function singlemp3player_filter_content($content) {
		return preg_replace_callback('|\[single-mp3-player\s*(xmlUrl="([^"]+)")?\s*(width="([0-9]+)")?\s*(height="([0-9]+)")?\s*\](.*)\[/single-mp3-player\]|i', 'singlemp3player_get_embed_code', $content);
	}

	function singlemp3player_echo_embed_code($settings_xml_path = '', $div_text = '', $width = 0, $height = 0) {
		echo singlemp3player_get_embed_code(array(2 => $settings_xml_path, 7 => $div_text, 4 => $width, 6 => $height));
	}

	function singlemp3player_load_swfobject_lib() {
		wp_enqueue_script('swfobject');
	}
/* end client side functions */

/* start admin section functions */
	function singlemp3player_admin_menu() {
		add_options_page('Single MP3 Player Options', 'Single MP3 Player', 'manage_options', 'singlemp3player', 'singlemp3player_admin_options');
	}

	function singlemp3player_admin_options() {
		  if (!current_user_can('manage_options'))  {
	    wp_die(__('You do not have sufficient permissions to access this page.'));
	  }

	  $singlemp3player_default_path = get_option('singlemp3player_path');
	  if ($singlemp3player_default_path === false) {
	  	$singlemp3player_default_path = 'flashdo/flashblue/single-mp3-player';
	  }
?>

<div class="wrap">
	<h2>Single MP3 Player</h2>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row" style="width: 40em;">SWF and assets path is <?php echo WP_CONTENT_DIR; ?>/</th>
				<td><input type="text" style="width: 25em;" name="singlemp3player_path" value="<?php echo $singlemp3player_default_path; ?>" /></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="singlemp3player_path" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
<?php
	}
/* end admin section functions */

/* start hooks */
	add_filter('the_content', 'singlemp3player_filter_content');
	add_action('init', 'singlemp3player_load_swfobject_lib');
	add_action('admin_menu', 'singlemp3player_admin_menu');
/* end hooks */

?>
