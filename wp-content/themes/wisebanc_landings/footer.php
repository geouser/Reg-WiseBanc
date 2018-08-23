        <footer class="footer">
            <div class="footer-icons">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon03.png" alt="">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon02.png" alt="">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon01.png" alt="">
            </div>
            <div class="container">

                <?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
                    <div class="footer-top">

                            <?php dynamic_sidebar( 'footer-sidebar' ); ?>   
    
                    </div> <!-- end footer-top -->
                <?php endif;  ?>


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
                        <p><?php pll_e('© 2011 – 2018 Orion Service EOOD. All Rights Reserved.'); ?></p>
                    </div>
                </div>
            </div>
        </footer>

        <div id="modal-popup" class="fncb-hide zoom-anim-dialog popup">
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
                        <button class="btn btn-primary" type="submit"><?php echo get_field('form_cta') ? get_field('form_cta') : pll__('GIIVE ME MY BONUS!'); ?></button>
                    </div>
                    

                </form><!-- end form -->
            </div>
        </div>

        <div id="modal-popup-error" class="fncb-hide zoom-anim-dialog popup">
            <p>Error</p>
        </div>

        <div id="modal-popup-error-ajax" class="fncb-hide zoom-anim-dialog popup">
            <p>Ajax Error</p>
        </div>

        <?php wp_footer(); ?>
        
    </body>
</html>