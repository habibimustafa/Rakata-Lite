<?php get_header(); ?>
	<div id="inner">
		<?php //get_sidebar('topside'); ?>
		<div id="main">
        	<?php if(have_posts()) : ?>
        	
        	  <hgroup>
				<?php if (function_exists('gp_breadcrumbs')) gp_breadcrumbs(); ?>
				<h1 class="page-title"><?php _e('Latest News', 'rakata');?></h1>
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
				echo("<p>Sorry, but there aren't any posts yet.</p>");
            endif; ?>	
		</div>
		<?php get_sidebar('botside'); ?>
	</div>
<?php get_footer(); ?>
