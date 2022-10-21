        <?php
            // gets contact information set in Theme Settings
            $address    = fx_get_client_address();
            $email      = fx_get_client_email( true );
            $phone      = fx_get_client_phone_number();
            $phone_link = fx_get_client_phone_number( true );
            $logo_id    = fx_get_client_logo_image_id(); 
            $home_url   = get_home_url();
        ?>
        <!-- <footer id="page-footer" class="page-footer">

            <div class="footer-contact-info">

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
        </footer> -->

        <footer class="page-footer">
            <div class="footer-top">
                <div class="container">
                    <div class="footer-wrap">
                        <div class="footer-logo-column">
                            <div class="footer-logo">
                                <a href="<?php echo esc_url( $home_url ); ?>">
                                    <?php echo fx_get_image_tag( $logo_id, '' ); ?>
                                </a>
                            </div>
                            <div class="footer-social-media">
                                <ul>
                                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                                    <li><a href="#"><i class="icon-youtube"></i></a></li>
                                    <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-contact-column">
                            <h4>Get in touch</h4>
                            <p><i class="icon-location"></i> 201 N Franklin St. Suite 1700,<br>
                                Tampa, FL 33602</p>
                            <p><i class=" icon-directions"></i> <a href="#">Get Directions</a></p>
                        </div>
                        <div class="footer-quick-links">
                            <h4>Quick Links</h4>
                            <ul>
                                <li><a href="#">Solutions</a></li>
                                <li><a href="#">Products</a></li>
                                <li><a href="#">Resources</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Customer Support</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom__wrap">
                        <div class="footer-secondary-menu">
                            <ul>
                                <li><a href="#">Site Credits</a></li>
                                <li><a href="#">Sitemap</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li>Copyright © <?php echo the_date('Y')?>. All Rights Reserved.</li>
                            </ul>
                        </div>
                        <div class="back-top-btn">
                            <a href="#top">Back to Top <i class="icon-button-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed-item hidden-md-down"><img src="/wp-content/themes/transflo/assets/img/fixed-item.png" alt="" class="img-responsive"></div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
