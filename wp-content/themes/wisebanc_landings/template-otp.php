<?php 
    
    /* Template name: OTP Landing page */

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
            <div class="onescreen-page">
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
                <div class="onescreen-page-body">
                    <div class="container">


                        <div class="onescreen-page__info">
                            <div class="otp-section">

                                <div class="otp-section__info">
                                    <div class="pin-tab active"><?php the_field('pin_heading'); ?></div>
                                    <div class="phone-tab"><?php the_field('phone_heading'); ?></div>
                                    <div class="success-tab"><?php the_field('success_heading'); ?></div>
                                </div>
                                
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <form action="" class="otp-form form" data-redirect="https://reg.wisetrader.com/fx/forex-trading/success/">
                                            <div class="row">
                                                <div class="col-sm-8" id="phone-group">
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control" id="phone" name="phone">
                                                    </div>
                                                    <!-- end form group -->
                                                </div>
                                                <div class="col-sm-4" id="send-pin-group">
                                                    <div class="form-group">
                                                        <button class="pin btn btn-info otp-button" id="pinCodeButton" type="button" disabled><?php pll_e('Send PIN'); ?></button>
                                                    </div>
                                                </div>
                                                <div class="col-8" id="enter-pin-group">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="OTP" name="OTP" placeholder="<?php pll_e('Enter PIN here..'); ?>" required>
                                                    </div>
                                                    <!-- end form group -->
                                                </div>
                                                <div class="col-4">
                                                    <button id="submit" type="submit" class="btn btn-info submit-pin-btn"><?php pll_e('GO!'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- end form -->
                                        <a href="#" class="otp-section__reenter"><?php pll_e('Didn’t get a pin? Enter your number again and we’ll send you a new one.'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="onescreen-page__info">
                            <div class="text-center">

                                <?php the_content(); ?>

                            </div>
                            
                        </div>


                    </div>
                </div>
            </div>


        <?php endwhile; ?>

    <?php endif; ?>
        

<?php get_footer(); ?>