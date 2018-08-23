<?php 
	show_admin_bar(false);

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
		add_theme_support( 'custom-logo' );

        register_nav_menu( 'footer_menu', 'Footer menu' );

		//add_image_size( 'name_thumbnail', 370, 370, true ); // name, width, height, crop
	}
	add_action( 'init', 'template_settings' ); // after_theme_setup





	/**
	 *
	 * Initialization of scripts and stylesheets
	 *
	*/
	function custom_links() {
		$theme = wp_get_theme();

		wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css', array(), $theme->get( 'Version' ), 'all'  );

		if ( is_rtl() ) {
			wp_enqueue_style( 'rtl-css', get_template_directory_uri() . '/css/rtl.css', array(), $theme->get( 'Version' ), 'all'  );
		}


		wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-3.2.1.min.js', array(), $theme->get( 'Version' ), true  );
		wp_enqueue_script( 'plugins-js', get_template_directory_uri() . '/js/plugins.js', array(), $theme->get( 'Version' ), true  );
		wp_enqueue_script( 'swal-js', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js', array(), $theme->get( 'Version' ), true  );
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array(), $theme->get( 'Version' ), true  );

		wp_localize_script('main-js', 'theme', 
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'url' => get_template_directory_uri(),
			)
		); 

	}
	add_action( 'wp_enqueue_scripts', 'custom_links' );


	function create_lead() {
		register_post_type('lead', array(
		  'labels' => array(
			'name'			=> __( 'Leads', 'theme-domain' ),
			'singular_name'   => __( 'Lead', 'theme-domain'  ),
			'add_new'		 => __( 'Add Lead', 'theme-domain'  ),
			'add_new_item'	=> __( 'Add Lead', 'theme-domain'  ),
			'edit'			=> __( 'Edit Lead', 'theme-domain'  ),
			'edit_item'	   => __( 'Edit Lead', 'theme-domain'  ),
			'new_item'		=> __( 'New Lead', 'theme-domain'  ),
			'all_items'	   => __( 'All Leads', 'theme-domain'  ),
			'view'			=> __( 'View Lead', 'theme-domain'  ),
			'view_item'	   => __( 'View Lead', 'theme-domain'  ),
			'search_items'	=> __( 'Search Lead', 'theme-domain'  ),
			'not_found'	   => __( 'Lead not found', 'theme-domain'  ),
		),
		'public' => true, // show in admin panel?
		'menu_position' => 20,
		'supports' => array( 'title'),
		'taxonomies' => array( 'category' ),
		'has_archive' => true,
		'capability_type' => 'post',
		'menu_icon'   => 'dashicons-archive',
		'rewrite' => array('slug' => 'lead'),
		));
	}
	add_action( 'init', 'create_lead' );



	/**
	 *
	 * Shortcode function 
	 *
	*/
	function currency_widgets( $atts ) {

		$html = '';


		if ( have_rows( 'widgets' ) ) {

			$html .= '<script>' . 
						'var pairs = [];' . 
					'</script>';

			$html .= '<div class="price-widgets">';

			while ( have_rows( 'widgets', get_the_ID() ) ) :

				the_row();
					
				$fromsymbol = get_sub_field('from_symbol');
				$tosymbol = get_sub_field('to_symbol');

				$html .= '<script>' . 
							'pairs.push({from:"'.$fromsymbol.'",to:"'.$tosymbol.'"});' . 
						 '</script>';

				$html .= '<div class="widget '.$fromsymbol.$tosymbol.'">' .
							'<h3>'.$fromsymbol.'/'.$tosymbol.'</h3>' .
							'<div class="widget-column">' .
								'<span class="label">'.pll__('Price').'</span>' .
								'<span class="value price">-</span>' .
							'</div>' .
							'<div class="widget-column">' .
								'<span class="label">'.pll__('Daily Change').'</span>' .
								'<span class="value change-price">-</span>' .
							'</div>' .
							'<div class="widget-column">' .
								'<span class="label">'.pll__('Daily Percentage').'</span>' .
								'<span class="value cahnge-percent">-</span>' .
							'</div>' .
						'</div>';
			endwhile;

			$html .= '</div>';

			$html .= '<p><small>'.pll__('Updated every 15 seconds').'</small></p>';

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

				case 4:
					$class = 'col-3';

					break;
				
				default:
					$class = 'col-12';
					break;
			}


			$html .= '<div class="text-center"><div class="steps"><div class="row" style="margin-bottom: 15px">';

			foreach ( $columns as $column ) {
				$html .= '<div class="'.$class.'">' .
							'<div class="image" style="margin-bottom: 10px;"><img src="'.$column['icon']['url'].'" alt=""></div>' .
							'<div><small>'.$column['text'].'</small></div>' .
						 '</div>';
			}

			$html .= '</div></div></div>';
							

		}

	    return $html;
	}
	add_shortcode( 'offer_columns', 'offer_columns' );




	register_sidebar( array(
		'name'          => __( 'Footer area', 'ezinvest' ),
		'id'            => 'footer-sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="hidden">',
		'after_title'   => '</div>'
	) );
	







	// random password
	function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	// register lead
	function register_handler(){

		$operatorName = 'OlehRusyiOperator';
		$partnerId = 'L6jiCt8jzeh7hq7iJKdD2R8Zk5';
		$apiURL = 'https://api-crm.wisebanc.com/v1/leads';
		$email = $_POST['email'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$phone= $_POST['phone'];
		$countryCode = $_POST['countryCode'];
		$languageCode = $_POST['languageCode'];
		$password = $_POST['password'];
		$timestamp = date('c');
		// $campaign = 'SomeCampaign';
		// $subcampaign = 'SomeSubCampaign';
		// $marker = 'TsTechPro-TestLead - https://tstechpro.com';

		$dataToSend = [
			'operatorName' => $operatorName,
			'email' => $email,
			'firstName' => $firstName,
			'lastName' => $lastName,
			'phone' => $phone,
			'countryCode' => $countryCode,
			'languageCode' => $languageCode,
			'password' => $password,
			'timestamp' => $timestamp,
			//'campaignId' => '3'
		];

		if ( isset( $_POST['affiliateId']) ) {
			$dataToSend['affiliateId'] = $_POST['affiliateId'];
		}
		if ( isset( $_POST['subtracking']) ) {
			$dataToSend['subtracking'] = $_POST['subtracking'];
		}
		if ( isset( $_POST['tracking']) ) {
			$dataToSend['tracking'] = $_POST['tracking'];
		}

		$checksum = strtoupper(hash('SHA512', $partnerId . http_build_query($dataToSend)));
		$dataToSend['checksum'] = $checksum;

		$apiRequest = $apiURL.'?' . http_build_query($dataToSend);

		$curl= curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($dataToSend));
		curl_setopt($curl, CURLOPT_URL, $apiRequest);

		$result = curl_exec($curl);
		curl_close($curl);
		
		wp_send_json( $result );

		// header('Content-Type: application/json');
		// $result = json_encode(json_decode($result), JSON_PRETTY_PRINT);

		// echo $result;

	}

	add_action('wp_ajax_register', 'register_handler'); // wp_ajax_{action}
	add_action('wp_ajax_nopriv_register', 'register_handler'); // wp_ajax_nopriv_{action}


	// save lead
	function save_handler(){

		$leadId = $_POST['leadId'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$url = $_POST['url'];

		$c_id = wp_create_category($url);

		if($c_id == 0) {
			$id = $c_id;
			$c_id = get_category_by_slug( $id );
		}

		// save lead to database
		$new_lead = array(
			'post_title' => '#' . $leadId . ' ' . $name,
			'post_status' => 'private',
			'post_type' => 'lead',
			'post_category' => array($c_id)
		);
		
		$new_id = wp_insert_post( $new_lead, true );

		update_field('lead_email', $email, $new_id);
		update_field('lead_name', $name, $new_id);

	}

	add_action('wp_ajax_save_lead', 'save_handler'); // wp_ajax_{action}
	add_action('wp_ajax_nopriv_save_lead', 'save_handler'); // wp_ajax_nopriv_{action}

	// countries lead
	function countries_handler(){

		$operatorName = 'OlehRusyiOperator';
		$partnerId = 'L6jiCt8jzeh7hq7iJKdD2R8Zk5';
		$apiURL = 'https://api-crm.wisebanc.com/v1/countries';
		$timestamp = date('c');
		$dataToSend = [
		 'operatorName' => $operatorName,
		 'timestamp' => $timestamp
		];

		$checksum = strtoupper(hash('SHA512', $partnerId . http_build_query($dataToSend)));
		$dataToSend['checksum'] = $checksum;

		$apiRequest = $apiURL.'?' . http_build_query($dataToSend);

		$curl= curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dataToSend));
		curl_setopt($curl, CURLOPT_URL, $apiRequest);

		$result = curl_exec($curl);
		curl_close($curl);
		wp_send_json( $result );

	}
	add_action('wp_ajax_countries', 'countries_handler'); // wp_ajax_{action}
	add_action('wp_ajax_nopriv_countries', 'countries_handler'); // wp_ajax_nopriv_{action}

	// add comment lead
	function add_comment_handler(){

		$operatorName = 'OlehRusyiOperator';
		$partnerId = 'L6jiCt8jzeh7hq7iJKdD2R8Zk5';
		$comment= $_POST['comment'];
		$id= $_POST['id'];
		$apiURL = 'https://api-crm.wisebanc.com/v1/leads/' . $id . '/comments';
		$timestamp = date('c');
		$dataToSend = [
			'message' => $comment,
			'operatorName' => $operatorName,
			'timestamp' => $timestamp
		];

		$checksum = strtoupper(hash('SHA512', $partnerId . http_build_query($dataToSend)));
		$dataToSend['checksum'] = $checksum;

		$apiRequest = $apiURL.'?' . http_build_query($dataToSend);

		$curl= curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dataToSend));
		curl_setopt($curl, CURLOPT_URL, $apiRequest);

		$result = curl_exec($curl);
		curl_close($curl);
		header('Content-Type: application/json');
		$result = json_encode(json_decode($result), JSON_PRETTY_PRINT);

		echo $result;

	}

	add_action('wp_ajax_add_comment', 'add_comment_handler'); // wp_ajax_{action}
	add_action('wp_ajax_nopriv_add_comment', 'add_comment_handler'); // wp_ajax_nopriv_{action}
	
	// send pin
	function send_otp_handler(){

		$phone = $_POST['phone'];
		$message = urlencode($_POST['message']);
		$key = "214839A69xSR53bDw5af45b67";

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?authkey=". $key ."&message=". $message ."&sender=OTPSMS&mobile=". $phone ."",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}

	}

	add_action('wp_ajax_send_otp', 'send_otp_handler'); // wp_ajax_{action}
	add_action('wp_ajax_nopriv_send_otp', 'send_otp_handler'); // wp_ajax_nopriv_{action}
		
	// verify pin
	function verify_otp_handler(){
 
		$pin = $_POST['pin'];
		$phone = $_POST['phone'];
		$key = "214839A69xSR53bDw5af45b67";

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://control.msg91.com/api/verifyRequestOTP.php?authkey=". $key . "&mobile=" . $phone . "&otp=" . $pin . "",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}

	}

	add_action('wp_ajax_verify_otp', 'verify_otp_handler'); // wp_ajax_{action}
	add_action('wp_ajax_nopriv_verify_otp', 'verify_otp_handler'); // wp_ajax_nopriv_{action}





	function wb_lang_switcher() {

		$html = '';

		if ( function_exists( 'pll_the_languages' ) ) {
			$languages = pll_the_languages(array(
				'raw'=> 1,
				'hide_if_empty' => true
			));
		} else {
			$languages = array();
		}
		

		if ( !empty( $languages ) ) {
			$html .= '<div class="nh-language-switcher">';
				$html .= '<div class="js-lang-select">';

					$html .= '<span class="js-lang-select-holder lang-item">';
						foreach ($languages as $key => $lang) {
							if ( $lang['current_lang'] ) {
								$html .= '<span class="flag"><img src="'. get_template_directory_uri() . '/images/flags/' . $lang['slug'] . '-l.svg' . '"></span>';
								$html .= '<span class="name">'.$lang['name'].'</span>';
							}
						}
					$html .= '</span>';

					$html .= '<ul class="js-lang-select-dropdown">';
						foreach ($languages as $key => $lang) {

							if ( !$lang['no_translation']){
								$html .= '<li class="'.join(' ', $lang['classes']).'">';
									$html .= '<a href="'.$lang['url'].'">';
										$html .= '<span class="flag"><img src="'. get_template_directory_uri() . '/images/flags/' . $lang['slug'] . '-l.svg' .'"></span>';
										$html .= '<span class="name">'.$lang['name'].'</span>';
									$html .= '</a>';
								$html .= '</li>';	
							}
							
						}
					$html .= '</ul>';


				$html .= '</div>';
			$html .= '</div>';
		}

		echo $html;
	}

 ?>