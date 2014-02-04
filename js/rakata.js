/**
 * rakata.js
 * @package Rakata Lite
 * @since Rakata Lite 0.0.4
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Copyright: (c) 2013 habibimustafa, http://habibimustafa.com/
 */

jQuery(document).ready(function(){
	jQuery('.rk_options').slideUp();
	
	jQuery('.rk_section h3').click(function(){		
		if(jQuery(this).parent().next('.rk_options').css('display')=='none')
			{	jQuery(this).removeClass('inactive');
				jQuery(this).addClass('active');
				jQuery(this).children('img').removeClass('inactive');
				jQuery(this).children('img').addClass('active');
				
			}
		else
			{	jQuery(this).removeClass('active');
				jQuery(this).addClass('inactive');		
				jQuery(this).children('img').removeClass('active');			
				jQuery(this).children('img').addClass('inactive');
			}
			
		jQuery(this).parent().next('.rk_options').slideToggle('slow');	
	});
});