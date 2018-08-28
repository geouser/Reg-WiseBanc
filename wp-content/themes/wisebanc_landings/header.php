<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php get_field('display_title') ? the_field('display_title') : wp_title(); ?></title>
		<meta name="description" content="<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>">
		<meta name="viewport"  content="width=device-width, initial-scale=1">



		<!-- Google Tag Manager -->

		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-PJ4C2K2');</script>
		<!-- End Google Tag Manager -->

		<!-- Global site tag (gtag.js) - Google Analytics -->

		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118643232-1"></script>

		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-118643232-1');
		</script>


		
		<?php wp_head(); ?>

		<script>
			<?php
				global $post;

				$slug = $post->post_name;

				if ( $_GET['page'] ) :
					$slug = $_GET['page'];
				endif;

			?>

			var redirects = {
				success: '<?php echo site_url() . "/success/?page=" . $slug; ?>',
				otp:  '<?php echo site_url() . "/otp/?page=" . $slug; ?>',
				otp_redirect: '<?php echo get_field('enable_otp') ? 'true' : 'false'; ?>'
			}


			var swal_strings = {
				phoneChanged: '<?php pll_e('Your phone number is successfully changed'); ?>',
				pinNotVerified: '<?php pll_e('PIN is not verified'); ?>',
				pinIsVerified: '<?php pll_e('PIN is vrified'); ?>',
				errorMessage: '<?php pll_e('Something went wrong'); ?>'
			}
		</script>
	</head>
	<body <?php body_class(); ?> >

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJ4C2K2"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->



		<div class="language-switcher">
			<?php wb_lang_switcher(); ?>
		</div>