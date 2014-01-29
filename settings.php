<?php
/**
 * Settings.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.4
 */

// Define Themes
$themename = "Rakata Lite";  
$shortname = "rk_options"; 

//Define Options
@$options = array (
	array( 
		"name" => $themename." Options",
		"type" => "title"
	),
	array( 
		"name" => "General",
		"type" => "section"
	),
	array( 
		"type" => "open"
	),
	array( 
		"name" => __("Logo URL", 'rakata'),
		"desc" => "Enter the link to your logo image",
		"id" => $shortname."_logo",
		"type" => "text",
		"std" => get_stylesheet_directory_uri()."/logo.png"
	),
	array( 
		"name" => __("Custom Favicon", 'rakata'),
		"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
		"id" => $shortname."_favicon",
		"type" => "text",
		"std" => get_stylesheet_directory_uri()."/favicon.ico"
	),
	array( 
		"type" => "close"
	),
);


function rk_add_admin() {
	global $themename, $shortname, $options;
	if ( @$_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == @$_REQUEST['action'] ) {
			foreach ($options as $value) {
			update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} else { delete_option( $value['id'] ); } 
			}
			header("Location: admin.php?page=options.php&saved=true");
			die;
		}else if( 'reset' == @$_REQUEST['action'] ) {
			foreach ($options as $value) { delete_option( $value['id'] ); }
			header("Location: admin.php?page=options.php&reset=true");
			die;
		}
	}
	
	add_theme_page($themename, $themename, 'administrator', basename(__FILE__), 'rk_admin', '');
}


function rk_add_init() {
	$file_dir=get_template_directory_uri();
	wp_enqueue_style("functions", $file_dir."/css/options.css", false, "1.0", "all");
	wp_enqueue_script("rk_script", $file_dir."/js/rakata.js", false, "1.0");
}


function rk_admin() {
	global $themename, $shortname, $options;
	$i=0;
	if ( @$_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( @$_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
	
	?><div class="wrap rk_wrap">
		<h2><?php echo $themename; ?> Settings</h2>
		<div class="rk_opts">
		<form method="post">
		<?php foreach ($options as $value) {
			switch ( $value['type'] ) {
			  case "open":
			  break;
			  
			  case "close": ?>
			  </div>
			  </div>
			  <br />
			  <?php break;
			  
			  case "title": ?>
			  <p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>
			  <?php break;
			  
			  case 'text': ?>
				<div class="rk_input rk_text">
					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
					<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
					<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
				</div>
			  <?php break;
			  
			  case 'textarea': ?>
				<div class="rk_input rk_textarea">
					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
					<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
					<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
				</div>
			  <?php break;
			  
			  case 'select': ?>
				<div class="rk_input rk_select">
					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
					<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
						<?php foreach ($value['options'] as $option) { ?>
						<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
					</select>
					<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
				</div>
			  <?php break;
			  
			  case 'checkbox': ?>
				<div class="rk_input rk_checkbox">
					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
					<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
					<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
					<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
				</div>
			  <?php break;
			  
			  case 'section': $i++; ?>
				<div class="rk_section">
				<div class="rk_title"><h3><img src="<?php get_template_directory_uri()?>/img/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
				</span><div class="clearfix"></div></div>
				<div class="rk_options">
			  <?php break;
			}
		}
		?>
			<input type="hidden" name="action" value="save" />
		</form>
		<form method="post">
			<p class="submit">
			<input name="reset" type="submit" value="Reset" />
			<input type="hidden" name="action" value="reset" />
			</p>
		</form>
	</div>
<?php } ?>
<?php
add_action('admin_init', 'rk_add_init');
add_action('admin_menu', 'rk_add_admin');
