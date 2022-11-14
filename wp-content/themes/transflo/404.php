<?php get_header(); ?>

<?php get_template_part('partials/masthead'); ?>

<div class="section-padding">
    <div class="container">

    <!-- Use https://blendedwaxes.com/404 as an example -->

    <!-- Add image buttons below for top ~4 pages - one should be the homepage, PM to specify the others in specs -->
    <div class="image-buttons__top-content">
        <div class="image-buttons__heading">
            <h2><?php the_field('404_intro_text', 'option'); ?></h2>
        </div>
    </div>
    <div class="image-buttons">
        <div class="row">
        <?php if( have_rows('404_links', 'option') ): while( have_rows('404_links', 'option') ) : the_row(); $page = get_sub_field('page_link', false, false); ?>
            <div class="col-lg-4 col-sm-6 image-button-item">
                <a class="image-button image-button--link" href="<?php echo get_the_permalink( $page ); ?>">
                    <?php 
                        $link_image = get_sub_field('404_link_page_image');

                        if ($link_image) {
                            $link_image = get_sub_field('404_link_page_image');
                            $url = wp_get_attachment_image_src( $link_image , 'full')[0];
                        } else if (get_the_post_thumbnail( $page, 'full' )) {
                            $url = get_the_post_thumbnail_url( $page, 'full' );
                        } else if (get_field('placeholder_image', 'option')) {
                            $link_image = get_field('placeholder_image', 'option');
                            $url = wp_get_attachment_image_src( $link_image , 'full')[0];
                        } else {
                            $link_image = get_field('logo', 'option');
                            $url = wp_get_attachment_image_src( $link_image , 'full')[0];
                        }
                    ?>
                    <img src="<?php echo $url; ?>" class="image-button__img">
                    <div class="image-button__info">
                        <h3 class="image-button__title"><?php echo get_the_title($page); ?></h3>
                        <span class="image-button__arrow"><i class="icon-button-right"></i></span>
                    </div>
                </a>
            </div>
            <?php endwhile; endif; ?>
        </div>
    </div>

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
                    <a href="<?php echo get_the_permalink(23); ?>" class="btn"><?php echo $contact_form['text_in_contact_button']; ?></a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    </div>
</div>

<?php get_footer(); 