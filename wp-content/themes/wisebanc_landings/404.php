<?php get_header(); ?>


    <div class="onescreen-page page-error">
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
                    
                    <h2 class="error-code">404</h2>

                    <p class="error-text">It seems we can’t find what you’re looking for.</p>

                </div>

            </div>
        </div>
    </div>


<?php get_footer(); ?>