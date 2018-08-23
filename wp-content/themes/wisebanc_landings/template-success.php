<?php 
    
    /* Template name: Success Landing page */

?>


<?php get_header(); ?>
		
	<?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : ?>

            <?php the_post(); ?>
			
			<script>
                var debug = '<?php echo get_field('debug') ? 'true' : 'false'; ?>';

                function getCookie(cname) {
                    var name = cname + "=";
                    var ca = document.cookie.split(';');
                    for (var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

                if (!getCookie("user_name") && debug != 'true' ) {
                    window.location = '/';
                }
            </script>

            <div class="onescreen-page-header">
                <div class="logo">
                    <?php 
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    ?>

                    <?php if ( $image[0] ) : ?>
                        <img src="<?php echo $image[0]; ?>" alt="">
                    <?php else: ?>
                        <img src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <?php endif; ?>
                </div>
            </div>


			<?php 

			    $section_classes = array( 'offer', 'offer-success' );

			    if ( get_field('minimized_header') ) {
			        $section_classes[] = 'offer--fill';
			    }
			    if ( get_field('small_first_section') ) {
			        $section_classes[] = 'offer--small';
			    }

			    $offer_cover = get_the_post_thumbnail_url(get_the_ID(),'full');

			?>
			<section  class="<?php echo join( ' ', $section_classes ); ?>" id="success-offer" style="background-image: url(<?php echo $offer_cover; ?>); ">
			    <div class="container">
			        <div class="offer__info offer__info--center">

			            <div class="offer__info__text">

			                <?php the_content(); ?>
							
			            </div>

			        </div>
			    </div><!-- end container -->
			</section><!-- end section -->


			<section class="section section-actions">
				<div class="container">
					
					<div class="section-heading text-left-xl">
						<h2><?php the_field('help_title'); ?></h2>
						
						<?php if ( get_field('help_subtitle') ) : ?>
							<div class="subtitle">
								<?php the_field('help_subtitle'); ?>
							</div>
						<?php endif; ?>
					</div>

					
					<div class="actions">
						<div class="row justify-content-center">
							<div class="col-6 col-sm-4 col-md-4">
								<div class="action action-1">
									<div class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/telephone.svg" alt=""></div>
									<div class="content">
										<h3><?php pll_e('Call'); ?></h3>
										<p><?php pll_e('Call us now'); ?></p>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-md-4">
								<div class="action action-2">
									<div class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chat.svg" alt=""></div>
									<div class="content">
										<h3><?php pll_e('Chat'); ?></h3>
										<p><?php pll_e('Speak with us'); ?></p>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-md-4">
								<div class="action action-3">
									<div class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/envelope.svg" alt=""></div>
									<div class="content">
										<h3><?php pll_e('E-mail'); ?></h3>
										<p>support@wisebanc.com</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					

				</div>
			</section>




			<section class="section">
				<div class="container">
					
					<div class="section-heading">
						<h2><?php the_field('contact_title'); ?></h2>
						
						<?php if ( get_field('contact_subtitle') ) : ?>
							<div class="subtitle">
								<?php the_field('contact_subtitle'); ?>
							</div>
						<?php endif; ?>
					</div>

				
					<?php if ( have_rows('widgets') ) : ?>
						<div class="contact-widgets">
							<div class="row">

								<?php while ( have_rows('widgets') ) : ?>

									<?php the_row(); ?>

									<div class="col-6 col-sm-6 col-md-3">
										<div class="contact-widget">
											<?php $icon = get_sub_field('icon'); ?>
											<div class="icon"><img src="<?php echo $icon['url']; ?>" alt=""></div>
											<div class="content"><?php the_sub_field('content'); ?></div>
										</div>
									</div>

								<?php endwhile; ?>

							</div>
						</div>
					<?php endif; ?>

					<?php if ( get_field('content') ) : ?>
						<article style="margin-bottom: 3em;">
							<?php the_field('content');  ?>
						</article>
					<?php endif; ?>

					<div class="text-center">
						<a class="btn btn-info" href="https://wisebanc.com/authorization/" target="_blank"><?php pll_e('Start trading'); ?></a>
					</div>

				</div>
			</section>



		<?php endwhile; ?>

    <?php endif; ?> 


<?php get_footer(); ?>