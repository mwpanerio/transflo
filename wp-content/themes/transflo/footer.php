        <?php
            // gets contact information set in Theme Settings
            $address    = fx_get_client_address();
            $email      = fx_get_client_email( true );
            $phone      = fx_get_client_phone_number();
            $phone_link = fx_get_client_phone_number( true );
            $logo_id    = fx_get_client_logo_image_id(); 
            $home_url   = get_home_url();

            if($address_url = get_field('address_url', 'option')) {
                $address_url = $address_url;
            } else {
                $address_url = 'https://maps.google.com/maps?q=' . strip_tags($address);
            }
        ?>

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
                                    <li><a href="<?php echo get_field('facebook', 'option'); ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                                    <li><a href="<?php echo get_field('twitter', 'option'); ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                                    <li><a href="<?php echo get_field('youtube', 'option'); ?>" target="_blank"><i class="icon-youtube"></i></a></li>
                                    <li><a href="<?php echo get_field('linkedin', 'option'); ?>" target="_blank"><i class="icon-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-contact-column">
                            <h4>Get in touch</h4>
                            <?php if( !empty( $address ) ): ?>
                                <p>
                                    <i class="icon-location"></i><?php echo str_replace(['<p>', '</p>'], '', $address); ?>
                                </p>
                            <?php endif; ?>
                            <p><i class=" icon-directions"></i> <a href="<?php echo $address_url; ?>" target="_blank">Get Directions</a></p>
                        </div>
                        <div class="footer-quick-links">
                            <h4>Quick Links</h4>
                            <?php
                                // Output the footer navigation
                                wp_nav_menu(
                                    [
                                        'menu'           => 'Footer Menu',
                                    ]
                                );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom__wrap">
                        <div class="footer-secondary-menu">
                            <ul>
                                <?php while(have_rows('helper_links', 'option')): the_row(); ?>
                                    <?php if($link = get_sub_field('link')): ?>
                                    <li>
                                        <a href="<?php echo $link['url']; ?>"<?php echo $link['target'] ? ' target="' . $link['target'] . '"': '';?>>
                                            <?php echo $link['title']; ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                <li>Copyright © <?php echo the_date('Y')?>. All Rights Reserved.</li>
                            </ul>
                        </div>
                        <div class="back-top-btn">
                            <a href="#top">Back to Top <i class="icon-button-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed-item hidden">
                <?php echo fx_get_image_tag(500); ?>
            </div>
        </footer>

        <!-- Qualified -->
        <script>
            (function(w,q){w['QualifiedObject']=q;w[q]=w[q]||function(){
            (w[q].q=w[q].q||[]).push(arguments)};})(window,'qualified')
        </script>
        <script async src="https://js.qualified.com/qualified.js?token=Piz58Ybm4vu68fPv"></script>
        <!-- End Qualified -->

        <?php wp_footer(); ?>
    </body>
</html>
