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

<?php $pagination = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; ?>
<?php if ( 1 === $pagination && !isset($_GET['search-block'])) : // Only show Featured post on first page of posts ?>
    <?php
        $featured_post_query = new WP_Query(
            [
                'posts_per_page' => 1,
                'meta_key'       => 'post_featured',
                'meta_value'     => '1',
            ] 
        );
    ?>
    <?php if ( $featured_post_query->have_posts() ) : while ( $featured_post_query->have_posts() ) : $featured_post_query->the_post(); ?>
        <div class="blog-featured section-padding hard-bottom">
            <div class="container">
                <article class="blog-featured__card">
                    <div class="blog-featured__image">
                        <?php echo fx_get_image_tag(get_field('featured_image')); ?>
                    </div>
                    <div class="blog-featured__content">
                        <div class="blog-featured__date"><?php echo get_the_date('F j, Y'); ?></div>
                        <h2 class="h3"><?php echo get_the_title(); ?></h2>
                        <?php
                            $blocks = parse_blocks( $post->post_content );

                            foreach ( $blocks as $block ) {
                            if ( 'acf/wysiwyg' === $block['blockName'] ) {
                                    if(isset($block["attrs"]["data"]["content"])) {
                                        $excerpt = strip_tags(trim($block["attrs"]["data"]["content"]));
                                    }
                                    break;
                                }
                            }
                        ?>
                        <p><?php echo $excerpt; ?></p>
                        <a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary">Read More</a>
                    </div>
                </article>
            </div>
        </div>
    <?php endwhile; endif; wp_reset_postdata(); ?>
<?php endif; ?>

<?php if( have_posts() ): ?>
    <?php

        $count = 1;

        if(isset($_GET['search-block'])) {
            $args = array(
                'post_type' => 'post',
                's'         => $_GET['search-block']
            );
            $the_query = new WP_Query( $args );
            $totalpost = $the_query->found_posts;
        }
    ?>
    <section class="blog-listing-container js-load-more-block section-margins"<?php echo $totalpost ? ' data-load-more-total="' . $totalpost . '"' : ''; ?>>
        <div class="container">
            <div class="blog-lising__wrapper">
                <div class="blog-listing row cards-flex js-load-more-posts">
                    <?php while( have_posts() ): the_post(); ?>
                        <?php get_template_part( 'partials/loop-content' ); ?>
                    <?php $count++; endwhile; ?>
                </div>
                <?php if($count > 10): ?>
                <div class="blog-listing__pagination">
                    <div class="col-xxs-12">
                        <?php get_template_part( 'partials/pagination' ); ?> 
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php get_footer(); ?>