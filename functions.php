<?php

// Setting Content Width
  global $content_width;
  if ( !isset( $content_width ) ) $content_width = 960;

// Add support for custom background
$defbackground = array( 'default-color' => 'FFFFFF' );
add_theme_support( 'custom-background', $defbackground );

// Add support for Automatic Feed Link
add_theme_support( 'automatic-feed-links' );

// Add support for Primary Navigation
if ( function_exists('register_nav_menus') ) {
	register_nav_menus(array(
		'rk-main-nav' => 'Primary Navigation'
	));
}

// Add post thumbnails support
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

// Add image size
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full-size',  9999, 9999, false );
	add_image_size( 'post-thumb',  80, 80, true );
	add_image_size( 'post-single',  690, 372, true );
}

// Add support for Sidebar
if ( function_exists('register_sidebar') ) {
	
	register_sidebar(array('name'=>'Left Sidebar',
	'id' => 'leftside',
	'before_widget' => '<div id="%1$s" class="sideitem %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
	));

	/* 
	register_sidebar(array('name'=>'Top Sidebar',
	'id' => 'topside',
	'before_widget' => '<div id="%1$s" class="sideitem %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
	));
	*/
	
	register_sidebar(array('name'=>'Bottom Sidebar',
	'id' => 'botside',
	'before_widget' => '<div id="%1$s" class="sideitem %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
	));
	
}

function rakata_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'rakata_add_editor_styles' );


// The Functions

// Title
function rk_title(){
	global $page, $paged;
	wp_title( '|', true, 'right' );
	
	// Add the blog name.
	$title = bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Page %s', 'rakata' ), max( $paged, $page ) );
		
	echo $title;
}

// Logo
function rk_logo(){
	if(get_option('rk_options_logo')) : ?>
		<h1 class="title"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>" class="site-title"><img src="<?php echo get_option('rk_options_logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a></h1>
	<?php else: ?>
		<h1 class="title"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>" class="site-title"><?php bloginfo('name'); ?></a></h1>
        <h2 class="desc"><?php bloginfo('description'); ?></h2>
	<?php endif;
}

// Menu
function rk_menu() {
    if(has_nav_menu('rk-main-nav')):
		wp_nav_menu( array( 
			'theme_location' => 'rk-main-nav', 
			'menu_class' => 'menu',
			'container' => ''
		) );
    else:
        ?>
            <ul class="menu">
                <li><a href="<?php echo home_url(); ?>"><?php _e('Home','rakata'); ?></a></li>
                <?php wp_list_pages('title_li='); ?>
			</ul>
        <?php    
    endif;
}

// Image Thumb
function rk_post_image_thumb(){
	$att = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => 1,
		'post_mime_type' => 'image',
		'post_parent' => get_the_ID()
	) );

	echo '<div class="image">';
	if ( $att ) {
		foreach($att as $atts) {
		  $img=wp_get_attachment_image_src($atts->ID, 'post-thumb');
		  printf('<a href="%1s" title="%2s"><img src="%3s" width="%4s" height="%5s" /></a>', 
			get_permalink (), the_title_attribute('echo=0'), $img[0], $img[1], $img[2]);
		}
	}else{
		printf('<a href="%1s" title="%2s"><img src="%3s" width="%4s" height="%5s" /></a>', 
			get_permalink (), the_title_attribute('echo=0'), get_stylesheet_directory_uri().'/img/no-img.png', '80', '80');
	}
	echo '</div>';
}

// Image Thumb
function rk_post_image_single(){
	if ( has_post_thumbnail()) {
		$args = array('class' => 'post-img aligncenter automargin','alt'	=> the_title_attribute('echo=0'));
		the_post_thumbnail('post-single', $args );
	}
}

// Head
function rk_head(){
	//Favicon
	if(get_option('rk_options_favicon')) :
	?><link rel="shortcut icon" href="<?php echo get_option('rk_options_favicon'); ?>" /><?php
	else:
	?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/favicon.ico" /><?php
	endif;
	
	// Google Site Verification
	if(get_option('rk_options_gweb_code')) :
	?><meta name="google-site-verification" content="<?php echo get_option('rk_options_gweb_code'); ?>" /><?php
	endif;
	
	// Bing Site Validation
	if(get_option('rk_options_bing_code')) :
	?><meta name='msvalidate.01' content='<?php echo get_option('rk_options_bing_code'); ?>' /><?php
	endif;
	
	// Pinterest Site Verification
	if(get_option('rk_options_pinterest_code')) :
	?><meta name='p:domain_verify' content='<?php echo get_option('rk_options_pinterest_code'); ?>' /><?php
	endif;
	
	// Google Analytics Code
	if(get_option('rk_options_ga_code')) :
	?><script type="text/javascript"><?php
		echo get_option('rk_options_ga_code');
	?></script><?php
	endif;
}

// Foot
function rk_foot(){
	if(get_option('rk_options_footer_text')) :
		echo "<p>".get_option('rk_options_footer_text')."</p>";
	else:
	?><p><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php _e( 'Copyright &copy;', 'rakata' ); ?> <?php echo date('Y');?></p><?php
	endif;
	
	?><p><?php printf( __('Powered by <a href="http://wordpress.org/" title="%1$s">%2$s</a> | <a href="http://habibimustafa.com/" title="%3$s">%4$s Themes</a>', 'rakata'), esc_attr( 'A Semantic Personal Publishing Platform'), 'WordPress', esc_attr( 'Rakata Lite Themes by Habibi Mustafa'),'rakata');?></p><?php
}
