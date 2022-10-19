        <footer id="page-footer" class="page-footer">

            <div class="footer-contact-info">
                <?php
                    // gets contact information set in Theme Settings
                    $address    = fx_get_client_address();
                    $email      = fx_get_client_email( true );
                    $phone      = fx_get_client_phone_number();
                    $phone_link = fx_get_client_phone_number( true );
                ?>

                <h5 class="footer__headline">Contact Us</h5>

                <?php if( !empty( $address ) ): ?>
                    <address class="footer-contact__address">
                        <?php echo $address; ?>
                    </address>
                <?php endif; ?>

                <?php if( !empty( $email ) ): ?>
                    <div class="footer-contact__email">
                        Email: <a href="<?php echo esc_url( sprintf( 'mailto:%s', $email ) ); ?>"><?php echo $email; ?></a>
                    </div>
                <?php endif; ?>

                <?php if( !empty( $phone ) ): ?>
                    <div class="footer-contact__phone">
                        Call: <a href="<?php echo esc_url( sprintf( 'tel:%s', $phone_link ) ); ?>"><?php echo $phone; ?></a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php
                // Output the footer navigation
                wp_nav_menu(
                    [
                        'container'         => 'nav',
                        'container_class'   => 'footer-navigation',
                        'depth'             => 1,
                        'theme_location'    => 'footer_menu',
                    ]
                );
            ?>
        </footer>
		
        <!-- Back To Top Icon area
        <button class="back-to-top js-back-to-top" type="button">
            <span class="back-to-top__label">Back to top</span>
            <i class="icon-arrow-up"></i>
        </button>
        -->

        <?php wp_footer(); ?>
    </body>
</html>
