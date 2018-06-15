<?php 
	
	/* Template name: Registration Landing page */

?>


<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php the_title(); ?></title>
		<meta name="description" content="<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>">
		<meta name="viewport"  content="width=device-width, initial-scale=1">

		<link rel="icon" href="https://wisebanc.com/wp-content/uploads/2018/04/cropped-favicon-32x32.png" sizes="32x32">

		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/main.css">
	</head>
	<body>

		
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : ?>

				<?php the_post(); ?>

				<?php
					$color_style = get_field('page_colors');
					$page_style = get_field('page_style');

					$offer_styles = array('offer', $color_style, $page_style);
				?>
	   
				<!--=================================================================================================-->
															<!-- OFFER SECTION -->
				<section class="<?php echo join(' ', $offer_styles); ?>">
					<div class="container">

						<div class="inner">

							<style>
								.offer,
								.offer .inner:after {
									background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);
								}
							</style>
							
							<div class="bonus-offer">

								<?php if ( $logo = get_field('logo') ) : ?>

									<div class="logo">
										<img src="<?php echo $logo['url']; ?>" alt="">
									</div>

								<?php endif; ?>

								<?php the_content(); ?>
								
								
								<div class="text-center">
									<button class="btn btn-primary js-toggle-signup-form">GET YOUR BONUS NOW!</button>
								</div>
								
							</div>

							<div class="signup-form">
								<div class="text-center">
									<h3>JOIN WISE BANC TODAY</h3>
								</div>
								
								<form method="post" class="form register-form" data-redirect="">

									<div class="form-group">
										<input id="firstName" class="form-control" autocomplete="firstName" name="firstName" required="" type="text" placeholder="Full Name" />
									</div>
									<!-- end NAME form group -->
				  

									<!-- end EMAIL form group -->
									<div class="form-group">
										<input id="phone" class="form-control" autocomplete="tel" name="phone" required="" type="tel" placeholder="Phone Number" />
									</div>

									<!-- end PHONE form group -->
									<div class="form-group">
										<input id="email" class="form-control" autocomplete="email" name="email" required="" type="email" placeholder="Email" />
									</div>
									
									<div class="form-group form-group--checkbox">
										<input id="termsAndConditions" class="form-control" name="termsAndConditions" required="" type="checkbox" />
										<label for="termsAndConditions">
											<i></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</label>
									</div>

									<div class="text-center">
										<button class="btn btn-primary btn-sm" type="submit">GIIVE ME MY BONUS!</button>
									</div>
									

								</form><!-- end form -->
							</div>

						</div>

					</div><!-- end container -->
				</section><!-- end section --> 

			<?php endwhile; ?>

		<?php endif; ?>



		<footer class="footer">
			<div class="footer-icons">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon03.png" alt="">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon02.png" alt="">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon01.png" alt="">
			</div>
			<div class="container">
				<div class="footer-top">
					<p>Wise Banc is a registered brand of Orion Service EOOD.</p>
					<p>Wise Banc doesn’t offer Contracts for Difference (CFDs) to residents of certain jurisdictions including but not limited to the United States of America. Wise Banc provides execution services and enters into principal to principal transactions with its clients at the prices determined by Wise Banc as appearing within the Wise Banc website.</p>
					<p>Risk disclosure: CFD trading involves significant risk and we strongly advise that you check out our Terms & Conditions. Although the risk when trading CFDs is fixed for each individual trade, the trades are live and it is possible to lose your initial investment, particularly if a trader chooses to place his entire investment to a single live trade. It is highly recommended that traders choose a proper money management strategy which limits the total consecutive trades or total outstanding investment. If you want to receive a proper money management strategy, please reach out to our support team.</p>
				</div>

				<div class="footer-bottom">

					<?php 
						if ( has_nav_menu( 'footer_menu' ) ) {
						     wp_nav_menu( array(
						     	'theme_location' => 'footer_menu',
						     	'container' => 'nav',
						     	'container_class' => 'quick-links'
						     ) );
						}
					?>

					<div class="copyright">
						<p>© 2011 – 2018 Orion Service EOOD. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</footer>

		<div id="modal-popup" class="fncb-hide zoom-anim-dialog popup">
			<div class="signup-form">
				<div class="text-center">
					<h3>JOIN WISE BANC TODAY</h3>
				</div>
				
				<form method="post" class="form register-form" data-redirect="">

					<div class="form-group">
						<input id="firstName" class="form-control" autocomplete="firstName" name="firstName" required="" type="text" placeholder="Full Name" />
					</div>
					<!-- end NAME form group -->
  

					<!-- end EMAIL form group -->
					<div class="form-group">
						<input id="phone" class="form-control" autocomplete="tel" name="phone" required="" type="tel" placeholder="Phone Number" />
					</div>

					<!-- end PHONE form group -->
					<div class="form-group">
						<input id="email" class="form-control" autocomplete="email" name="email" required="" type="email" placeholder="Email" />
					</div>
					
					<div class="form-group form-group--checkbox">
						<input id="termsAndConditions" class="form-control" name="termsAndConditions" required="" type="checkbox" />
						<label for="termsAndConditions">
							<i></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</label>
					</div>

					<div class="text-center">
						<button class="btn btn-primary" type="submit">GIIVE ME MY BONUS!</button>
					</div>
					

				</form><!-- end form -->
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/plugins.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/main.js"></script>
	</body>
</html>