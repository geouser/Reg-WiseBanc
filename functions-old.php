<?php 
	 add_action( 'wp_enqueue_scripts', 'wisebanc_enqueue_styles' );
	 function wisebanc_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
          wp_enqueue_style( '', get_stylesheet_directory_uri() . '/custom.css' );
		 wp_enqueue_script('jquery');
		 wp_enqueue_script('tooltip-js', get_stylesheet_directory_uri() . '/js/tooltip.js');
     }
/*
function register_my_menu() {
	register_nav_menu('footer-menu-1',__( 'Footer Menu 1' ));
}
add_action( 'init', 'footer-menu-1' );*/

function wpb_custom_new_menu() {
	register_nav_menus(
		array(
			'footer-menu-1' => __( 'Footer Menu 1' ),
			'footer-menu-2' => __( 'Footer Menu 2' ),
			'footer-menu-3' => __( 'Footer Menu 3' ),
			'footer-menu-4' => __( 'Footer Menu 4' )

		)
	);
}
add_action( 'init', 'wpb_custom_new_menu' );


add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 5 );
function your_custom_menu_item ( $items, $args ) {
	$link = do_shortcode('[ts_is_guest]') ?
		do_shortcode( '[ts_get_page_link key="TS-REGISTRATION"]' ) : do_shortcode( '[ts_platform_url]' );
	$title = do_shortcode('[ts_is_guest]') ?
		__( 'Open Account' ) : __( 'Get Started Now' );
	if ($args->theme_location == 'primary') {
		$items .= "<li style='order: -1;' class='nav-item menu-item menu-item-type-custom menu-item-object-custom'><a href='$link' class=\"nav-link first-item \">$title</a></li>";
	}
	return $items;
}

function boot(){
	wp_enqueue_style( 'traderstrip', get_stylesheet_directory_uri() . '/traderstrip.css' );
	wp_enqueue_script('simply-scroll', get_stylesheet_directory_uri() . '/js/jquery.simplyscroll.min.js');
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js');

}

add_action('wp_footer','boot');

function languages_list_switcher(){
	$languages = icl_get_languages('skip_missing=0&orderby=code');
	if(!empty($languages)){
		echo '<ul class="language__list">';
		foreach($languages as $item){
			if( !$item['active'] ){
				echo '<li class="language__item">';
				echo '<a class="language__itemLink" href="'.$item['url'].'">';
				echo '<img src="'.$item['country_flag_url'].'" alt="'.$item['language_code'].'"/>';
				echo icl_disp_language($item['native_name']);
				echo '</a>';
				echo '</li>';
			}
		}
		echo '</ul>';
	}
}

function wb_posted_on_news() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}


}


 ?>