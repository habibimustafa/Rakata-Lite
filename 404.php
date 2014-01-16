<?php get_header(); ?>
	<div id="inner">
		<?php //get_sidebar('topside'); ?>
		<div id="main">
            	<article id="post-0" class="post error404 not-found">
					<hgroup>
						<?php if (function_exists('rk_breadcrumbs')) rk_breadcrumbs(); ?>
						<h1 class="page-title"><?php _e( 'Not Found', 'rakata' ); ?></h1>
					</hgroup>
					<div class="page entry entry-content">
						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'rakata' ); ?></p>
						<?php get_search_form(); ?>
					</div> <!--end .entry-->
				</article> <!--end #post-->
            	<?php //endwhile; ?> 	
		</div>
		<?php get_sidebar('botside'); ?>
	</div>
<?php get_footer(); ?>
