<?php
/**
 * sidebar-topside.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.3
 */
?>
				<aside id="sidebar" class="topside">
					<div class="sidebar_wrapper">
						<?php if ( is_active_sidebar( 'topside' ) ) dynamic_sidebar( 'topside'); ?>
					</div>
				</aside>
