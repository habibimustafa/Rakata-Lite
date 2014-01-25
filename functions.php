<?php
/**
 * functions.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.1
 */

/**
 * Enqueue scripts and styles
 * @since Rakata Lite 0.0.3
 */
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

// Head
function rk_head(){
	//Favicon
	?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/favicon.ico" /><?php
}

// Foot
function rk_foot(){
	?><p><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php _e( 'Copyright &copy;', 'rakata' ); ?> <?php echo date('Y');?></p>
	<p><?php printf( __('Powered by <a href="http://wordpress.org/" title="%1$s">%2$s</a> | <a href="http://habibimustafa.com/" title="%3$s">%4$s Themes</a>', 'rakata'), esc_attr( 'A Semantic Personal Publishing Platform'), 'WordPress', esc_attr( 'Rakata Lite Themes by Habibi Mustafa'),'rakata');?></p><?php
}