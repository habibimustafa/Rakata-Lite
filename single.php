<?php
/**
 * single.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.3
 */
get_header(); ?>
	<div id="inner">
		<?php get_sidebar('topside'); ?>
		<div id="main">
        	<?php if(have_posts()) : ?>
            	<?php while (have_posts()) : the_post() ?>
            	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<hgroup>
						<?php if (function_exists('rk_breadcrumbs')) rk_breadcrumbs(); ?>
						<h1 class="post-title"><a href="<?php echo get_permalink (); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title() ;?></a></h1>
						<span class="meta-category">Categories: <?php the_category(' '); ?></span>
						<span class="meta-tags">Tags: <?php the_tags(' '); ?></span>
					</hgroup>
					
					<div class="post entry entry-content">
						<?php rk_post_image_single(); ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'rakata' ), 'after' => '</div>' ) ); ?>
					</div> <!--end .entry-->
					
					<div class="post-meta">
						<span class="author">Posted by <?php the_author(); ?></span>
						<span class="timeStamp">on <?php the_time('l, j F Y'); ?></span>
					</div>
					
					<div id="nav-below" class="navigation">
						<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'rakata' ) . '</span> %title' ); ?></div>
						<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'rakata' ) . '</span>' ); ?></div>
					</div><!-- #nav-below -->
					
					<?php if ( comments_open() ) : ?>
					<div class="post-reply">
						<div id="defcomm"><?php comments_template(); ?></div>
					</div>
					<?php endif; ?>
				</article> <!--end #post-->
            	<?php endwhile; ?> 
            <?php else : ?>
                	<p>Sorry but we could not find what you were looking for</p>
            <?php endif; ?>		
		</div>
		<?php get_sidebar('botside'); ?>
	</div>
<?php get_footer(); ?>
