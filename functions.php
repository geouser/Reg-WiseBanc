<?php 

	// 1. customize ACF path
	add_filter('acf/settings/path', 'my_acf_settings_path');
	 
	function my_acf_settings_path( $path ) {
	 
	    // update path
	    $path = get_stylesheet_directory() . '/acf/';
	    
	    // return
	    return $path;
	    
	}
	 

	// 2. customize ACF dir
	add_filter('acf/settings/dir', 'my_acf_settings_dir');
	 
	function my_acf_settings_dir( $dir ) {
	 
	    // update path
	    $dir = get_stylesheet_directory_uri() . '/acf/';
	    
	    // return
	    return $dir;
	    
	}
	 

	// 3. Hide ACF field group menu item
	//add_filter('acf/settings/show_admin', '__return_false');


	// 4. Include ACF
	include_once( get_stylesheet_directory() . '/acf/acf.php' );

	/**
	 *
	 * Add theme support
	 *
	*/
	function template_settings() {
		add_theme_support( 'post-thumbnails' ); 
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		add_theme_support( 'title-tag' );

        register_nav_menu( 'footer_menu', 'Footer menu' );

		//add_image_size( 'name_thumbnail', 370, 370, true ); // name, width, height, crop
	}
	add_action( 'init', 'template_settings' ); // after_theme_setup



	/**
	 *
	 * Shortcode function 
	 *
	*/
	function currency_widgets( $atts ) {

		$widgets = get_field( 'widgets', get_the_ID() );

		$html = '';


		if ( $widgets ) {

			$html .= '<script>' . 
						'var pairs = [];' . 
					'</script>';

			$html .= '<div class="price-widgets">';
			
			foreach ( $widgets as $widget ) {
				
				$fromsymbol = $widget['from_symbol'];
				$tosymbol = $widget['to_symbol'];

				$html .= '<script>' . 
							'pairs.push({from:"'.$fromsymbol.'",to:"'.$tosymbol.'"});' . 
						 '</script>';

				$html .= '<div class="widget '.$fromsymbol.$tosymbol.'">' .
							'<h3>'.$fromsymbol.'/'.$tosymbol.'</h3>' .
							'<div class="widget-column">' .
								'<span class="label">Price</span>' .
								'<span class="value price">-</span>' .
							'</div>' .
							'<div class="widget-column">' .
								'<span class="label">Daily Change</span>' .
								'<span class="value change-price">-</span>' .
							'</div>' .
							'<div class="widget-column">' .
								'<span class="label">Daily Percentage</span>' .
								'<span class="value cahnge-percent">-</span>' .
							'</div>' .
						'</div>';
			}

			$html .= '</div>';

			$html .= '<p><small>Updated every 5 seconds</small></p>';

		}

	    return $html;
	}
	add_shortcode( 'currency_widgets', 'currency_widgets' );



	/**
	 *
	 * Shortcode function 
	 *
	*/
	function offer_columns( $atts ) {

		$columns = get_field( 'columns', get_the_ID() );

		$html = '';


		if ( $columns ) {

			$count = count( $columns );
			$class = 'col-12';

			switch ($count) {
				case 1:
					$class = 'col-12';

					break;

				case 2:
					$class = 'col-6';

					break;

				case 3:
					$class = 'col-4';

					break;
				
				default:
					$class = 'col-12';
					break;
			}


			$html .= '<div class="text-center"><div class="row" style="margin-bottom: 15px">';

			foreach ( $columns as $column ) {
				$html .= '<div class="'.$class.'">' .
							'<img src="'.$column['icon']['url'].'" alt="" style="margin-bottom: 10px;">' .
							'<div><small>'.$column['text'].'</small></div>' .
						 '</div>';
			}

			$html .= '</div></div>';
							

		}

	    return $html;
	}
	add_shortcode( 'offer_columns', 'offer_columns' );



	





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