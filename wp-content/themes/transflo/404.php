<?php get_header(); ?>

<?php get_template_part('partials/masthead'); ?>

<div class="container">

    <!-- Use https://blendedwaxes.com/404 as an example -->

    <!-- Add image buttons below for top ~4 pages - one should be the homepage, PM to specify the others in specs -->
    <section class="imgbtns-404">
        <div class="row">
            <h2><?php the_field('404_intro_text', 'option'); ?></h2>

            <?php if( have_rows('404_links', 'option') ): while( have_rows('404_links', 'option') ) : the_row(); $page = get_sub_field('page_link', false, false); ?>

            <div class="col-xxs-12 col-sm-6 col-md-4">
                <a href="<?php echo get_the_permalink( $page ); ?>">
                    <div class="link-image">
                        <?php 
                            $link_image = get_sub_field('404_link_page_image');

                            if ($link_image) {
                                $link_image = get_sub_field('404_link_page_image');
                                $url = wp_get_attachment_image_src( $link_image , 'thumbnail')[0];
                            } else if (get_the_post_thumbnail( $page, 'thumbnail' )) {
                                $url = get_the_post_thumbnail_url( $page, 'thumbnail' );
                            } else if (get_field('placeholder_image', 'option')) {
                                $link_image = get_field('placeholder_image', 'option');
                                $url = wp_get_attachment_image_src( $link_image , 'thumbnail')[0];
                            } else {
                                $link_image = get_field('logo', 'option');
                                $url = wp_get_attachment_image_src( $link_image , 'thumbnail')[0];
                            }
                        ?>
                        <img src="<?php echo $url; ?>">
                    </div>

                    <div class="link_title">
                        <h3><?php echo get_the_title($page); ?></h3>
                    </div>
                </a>
            </div>                   
            <?php endwhile; endif; ?>
        </div>
    </section>

    <section class="links-404">
        <div class="row">
            <?php 
            $search = get_field('search', 'option');
            if ($search): ?>
            <div class="col-xxs-12 col-md-6">
                <div class="search-404">
                    <h4><?php echo $search['text_in_search_bar']; ?></h4>
                    <?php get_search_form(); ?>
                </div>
            </div>
            <?php endif; ?>
            <?php  $contact_form = get_field('contact_form', 'option');
            if ($contact_form): ?>
            <div class="col-xxs-12 col-md-6">
                <div class="contact-404">
                    <h4><?php echo $contact_form['text_before_contact_button']; ?></h4>
                    <a href="#" class="btn"><?php echo $contact_form['text_in_contact_button']; ?></a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

</div>

<?php get_footer(); 