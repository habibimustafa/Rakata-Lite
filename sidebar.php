<?php
/**
 * sidebar.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.3
 */
?>
			<aside id="sidebar" class="leftside">
				<div class="sidebar_wrapper">			
					<?php if ( is_active_sidebar( 'leftside' ) ) dynamic_sidebar( 'leftside'); ?>
				</div>
			</aside>
