<?php get_header(); ?>

<?php get_template_part('partials/masthead'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="blog-single-container section-margins">
    <div class="container">
        <div class="blog-listing__wrapper">

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php the_content(); ?>

                    <div class="post-pagination">
                        <?php
                            $prev_post = get_previous_post();
                            if (!empty( $prev_post )): ?>
                                <a class="btn-post-pagination btn-previous-post" href="<?php echo get_the_permalink($prev_post->ID); ?>"><strong>Previous Article</strong><span class="post-pagination-text"><?php echo $prev_post->post_title ?></span><span class="mobile-arrow"></span></a>
                        <?php endif ?>

                        <?php
                            $next_post = get_next_post();
                            if (!empty( $next_post )): ?>
                            <a class="btn-post-pagination btn-next-post" href="<?php echo get_the_permalink($next_post->ID); ?>"><strong>Next Article</strong><span class="post-pagination-text"><?php echo $next_post->post_title ?></span><span class="mobile-arrow"></span></a>
                        <?php endif ?>
                    </div>

                    <?php get_template_part( 'partials/social-share' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer();