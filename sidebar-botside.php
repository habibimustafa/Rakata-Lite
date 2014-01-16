<?php
/**
 * sidebar-botside.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.3
 */
?>				<aside id="sidebar" class="botside">
					<div class="sidebar_wrapper">
						<?php if ( is_active_sidebar( 'botside' ) ) dynamic_sidebar( 'botside'); ?>
					</div>
				</aside>
