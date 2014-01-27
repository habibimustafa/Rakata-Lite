<?php
/**
 * functions.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.1
 */

/**
 * Rakata Lite Theme Options
 * @since Rakata Lite 0.0.4
 */
include('settings.php');

/**
 * Enqueue scripts and styles
 * @since Rakata Lite 0.0.3
 */
define( 'RAKATA_THEME', 'Rakata Lite' );
define( 'RAKATA', '0.0.3' );
add_action( 'wp_enqueue_scripts', 'rakata_enqueue_scripts' );
function rakata_enqueue_scripts() {
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css', array(), RAKATA);
	wp_enqueue_style( 'rakata', get_template_directory_uri() . '/style.css', array(), RAKATA);
    	
    if ( is_singular() && comments_open() && get_option('thread_comments')) {
	wp_enqueue_script('comment-reply');
    }
}

/**
 * Setup function
 * @since Rakata Lite 0.0.3
 */
function rakata_setup() {
	if ( ! isset( $content_width ) ) $content_width = 960;
	load_theme_textdomain( 'rakata', get_template_directory() . '/languages' );
	$defbackground = array( 'default-color' => 'EFEFEF' );
	add_theme_support( 'custom-background', $defbackground );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'full-size',  9999, 9999, false );
	add_image_size( 'post-thumb',  80, 80, true );
	add_image_size( 'post-single',  690, 372, true );
	register_nav_menus( array(
		'rakata-main-nav' => __( 'Primary Menu', 'rakata' ),
	) );
}
add_action( 'after_setup_theme', 'rakata_setup' );

/**
 * Custom Favicon
 * @since Rakata Lite 0.0.4
 */
add_action('wp_head', 'rk_custom_favicon', 1);
function rk_custom_favicon() {
	if (get_option('rk_options_favicon')):
		echo '<link rel="shortcut icon" href="'. esc_url( get_option('rk_options_favicon') ) .'">'."\n";
	else:
		echo '<link rel="shortcut icon" href="'. get_stylesheet_directory_uri() .'/favicon.ico" />'."\n";
	endif;		
}

/**
 * HTML5 js for IE
 * @since Rakata Lite 0.0.4
 */
add_action( 'wp_head', 'rakata_print_ie_scripts');
function rakata_print_ie_scripts() {
  ?><!--[if lt IE 9]> <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script> <![endif]--><?php
}

/**
 * Register Sidebar
 * @since Rakata Lite 0.0.3
 */
function rakata_widgets_init() {
	register_sidebar(array('name'=>__( 'Left Sidebar', 'rakata' ),
	'id' => 'leftside',
	'before_widget' => '<div id="%1$s" class="sideitem %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
	));
	register_sidebar(array('name'=>__( 'Top Sidebar', 'rakata' ),
	'id' => 'topside',
	'before_widget' => '<div id="%1$s" class="sideitem %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
	));
	register_sidebar(array('name'=>__( 'Bottom Sidebar', 'rakata' ),
	'id' => 'botside',
	'before_widget' => '<div id="%1$s" class="sideitem %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'rakata_widgets_init');

/**
 * Customize WP Title
 * @since Rakata Lite 0.0.3
 */
function rk_title( $title ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'rakata' ), max( $paged, $page ) ) : '';

	return $filtered_title;
}
add_filter('wp_title', 'rk_title');

// Logo
function rk_logo(){
	if(get_option('rk_options_logo')) : ?>
		<h1 class="title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" class="site-title"><img src="<?php echo get_option('rk_options_logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a></h1>
	<?php else: ?>
		<h1 class="title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" class="site-title"><?php bloginfo('name'); ?></a></h1>
        <h2 class="desc"><?php bloginfo('description'); ?></h2>
	<?php endif;
}

// Foot
function rk_foot(){
	?><p><a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php bloginfo('name'); ?></a> | <a href="<?php echo esc_url(__('http://habibimustafa.com','rakata')); ?>" title="<?php esc_attr_e('Rakata', 'rakata'); ?>"><?php  echo RAKATA_THEME; ?></a> <?php  _e( 'Proudly powered by', 'rakata' ); ?>  <a href="<?php echo esc_url(__('http://wordpress.org','rakata')); ?>" title="<?php esc_attr_e('WordPress', 'rakata'); ?>"><?php printf('WordPress', 'rakata'); ?></a></p><?php
}

// Menu
function rk_menu() {
    if(has_nav_menu('rakata-main-nav')):
		wp_nav_menu( array( 
			'theme_location' => 'rakata-main-nav', 
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