<?php get_header(); ?>

<?php get_template_part('partials/masthead'); ?>

<section class="subscribes section-padding hard-bottom">
    <div class="container">
        <div class="subscribe">
            <h3 class="text-center">Subscribe to Our Newsletter</h3>
            <?php echo apply_shortcodes('[contact-form-7 id="358" title="Newsletter Form"]'); ?>
        </div>
    </div>
</section>

<?php if( have_posts() ): ?>
    <section class="<?php echo get_post_type(); ?>-listing-container js-load-more-block section-margins" data-load-more-post-type="<?php echo get_post_type(); ?>">
        <div class="container">
            <div class="blog-lising__wrapper">
                <div class="blog-listing row cards-flex js-load-more-posts">
                    <?php while( have_posts() ): the_post(); ?>
                        <?php get_template_part( 'partials/loop-content' ); ?>
                    <?php endwhile; ?>
                </div>
                <div class="blog-listing__pagination">
                    <div class="col-xxs-12">
                        <?php get_template_part( 'partials/pagination' ); ?> 
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="blog-listing-container js-load-more-block section-margins">
        <div class="container">
            <div class="blog-lising__wrapper">
                <div class="blog-listing row cards-flex js-load-more-posts">
                    <h2>Sorry, we couldn't find any posts.</h2>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php get_footer(); ?>