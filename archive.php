<?php
/**
 * archive.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.1
 */
get_header(); ?>
	<div id="inner">
		<?php //get_sidebar('topside'); ?>
		<div id="main">
        	<?php if(have_posts()) : ?>
        	
        	  <hgroup>
				<?php if (function_exists('rk_breadcrumbs')) rk_breadcrumbs(); ?>
				
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() wogps. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1 class="page-title"><?php printf("Category Archives '%s'", single_cat_title('',false)); ?></h1>
				<?php /* If this is a tag archive */ } elseif( is_tag('',false) ) { ?>
				<h1 class="page-title"><?php printf("Tags Archives '%s'", single_tag_title()); ?></h1>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1 class="page-title">Arsip Hari <?php get_the_date(); ?></h1>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="page-title">Arsip Bulan <?php get_the_date( _x( 'F Y', 'monthly archives date format', 'rakata' ) ); ?></h1>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="page-title">Arsip Tahun <?php get_the_date( _x( 'Y', 'yearly archives date format', 'rakata' ) ); ?></h1>
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="page-title">Arsip Penulis</h1>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="page-title">Arsip Blog</h1>
				<?php } ?>
			  </hgroup>
			  
			  <div class="page">
              <?php while (have_posts()) : the_post() ?>
              <div class="loop">
            	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="post-title"><a href="<?php echo get_permalink (); ?>" title="Permanent link to <?php the_title_attribute(); ?>" ><?php the_title() ;?></a></h2>
					<div class="post entry entry-content">
						<?php rk_post_image_thumb(); ?>
						<?php the_excerpt(); ?>
					</div> <!--end .entry-->
					<div class="post-meta">
						<span class="author">Posted by <?php the_author(); ?></span>
						<span class="timeStamp">on <?php the_time('l, j F Y'); ?></span>
					</div>
				</article> <!--end #post-->
			  </div>
              <?php endwhile; ?>
              </div>
	
			  <div id="nav-below" class="navigation">
				  <?php posts_nav_link(); ?>
			  </div><!-- #nav-below -->
            	
            <?php else :
            
			if ( is_category() ) { // If this is a category archive
				printf("<p>Sorry, but there aren't any posts in the %s category yet.</p>", single_cat_title('',false));
			} else if ( is_date() ) { // If this is a date archive
				echo("<p>Sorry, but there aren't any posts with this date.</p>");
			} else if ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf("<p>Sorry, but there aren't any posts by %s yet.</p>", $userdata->display_name);
			} else {
				echo("<p>No posts found.</p>");
			}
			
            endif; ?>		
		</div>
		<?php get_sidebar('botside'); ?>
	</div>
<?php get_footer(); ?>
