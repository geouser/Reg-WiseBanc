<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php get_field('display_title') ? the_field('display_title') : wp_title(); ?></title>
		<meta name="description" content="<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>">
		<meta name="viewport"  content="width=device-width, initial-scale=1">
		
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

		<div class="language-switcher">
			<?php wb_lang_switcher(); ?>
		</div>