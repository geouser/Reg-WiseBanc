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


?>
