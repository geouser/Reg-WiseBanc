<?php 
	
	/* Template name: Registration Landing page */

?>


<?php get_header(); ?>

		
	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php
				$color_style = get_field('page_colors');
				$page_style = get_field('page_style');

				$offer_styles = array('offer', $color_style, $page_style);

				$font_size = get_field('font_size');

				$logo = get_field('logo_' . $color_style, 'options');

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

							<?php if ( $font_size ) : ?>
								@media (min-width: 992px) {
									.offer .bonus-offer h1 {
										font-size: <?php echo $font_size; ?>px;
									}
								}
							<?php endif; ?>
						</style>
						
						<div class="bonus-offer">

							<?php if ( $logo ) : ?>

								<div class="logo">
									<img src="<?php echo $logo['url']; ?>" alt="">
								</div>

							<?php endif; ?>

							<?php the_content(); ?>
							
							
							<div class="text-center">
								<button class="btn btn-primary js-toggle-signup-form"><?php echo get_field('cta_label') ? get_field('cta_label') : pll__('GET YOUR BONUS NOW!'); ?></button>
							</div>
							
						</div>

						<div class="signup-form">
							<div class="text-center">
								<h3><?php pll_e('JOIN WISE BANC TODAY'); ?></h3>
							</div>
							
							<form method="post" class="register-form" data-redirect="">

								
								<div class="row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<input id="firstName" class="form-control" autocomplete="firstName" name="firstName" required="" type="text" placeholder="<?php pll_e('First Name'); ?>" />
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<input id="lastName" class="form-control" autocomplete="lastName" name="lastName" required="" type="text" placeholder="<?php pll_e('Last Name'); ?>" />
										</div>
									</div>
								</div>
								<!-- end NAME form group -->
			  

								<!-- end EMAIL form group -->
								<div class="form-group">
									<input id="phone" class="form-control" autocomplete="tel" name="phone" required="" type="tel" placeholder="" />
								</div>

								<!-- end PHONE form group -->
								<div class="form-group">
									<input id="email" class="form-control" autocomplete="email" name="email" required="" type="email" placeholder="<?php pll_e('Email'); ?>" />
								</div>
								
								<div class="form-group form-group--checkbox">
									<input id="termsAndConditions" class="form-control" name="termsAndConditions" required="" type="checkbox" />
									<label for="termsAndConditions">
										<i></i><?php pll_e('I am over 18 years of age and I accept the'); ?> <a href="https://wisebanc.com/policies/terms-and-conditions/" target="_blank"><?php pll_e('Terms & Conditions'); ?></a>
									</label>
								</div>

								<div class="text-center">

									<?php if ( isset($_GET['aff']) ) : ?>
										<input type="hidden" name="affiliateId" value="<?php echo htmlspecialchars( $_GET['aff'] ); ?>">
									<?php endif; ?>

									<?php if ( isset( $_GET['str']) ) : ?>
										<input type="hidden" name="subtracking" value="<?php echo htmlspecialchars($_GET['str']); ?>">
									<?php endif; ?>

									<?php if ( isset( $_GET['tr']) ) : ?>
										<input type="hidden" name="tracking" value="<?php echo htmlspecialchars($_GET['tr']); ?>">
									<?php endif; ?>

									<button class="btn btn-primary btn-sm" type="submit"><?php echo get_field('form_cta') ? get_field('form_cta') : pll__('GIIVE ME MY BONUS!'); ?></button>
								</div>
								

							</form><!-- end form -->
						</div>

					</div>

				</div><!-- end container -->
			</section><!-- end section --> 

			<div class="mobile-cta">
				<button class="btn btn-primary js-toggle-signup-form"><?php echo get_field('cta_label') ? get_field('cta_label') : pll__('GET YOUR BONUS NOW!'); ?></button>
			</div>

		<?php endwhile; ?>

		<?php endif; ?>



<?php get_footer(); ?>