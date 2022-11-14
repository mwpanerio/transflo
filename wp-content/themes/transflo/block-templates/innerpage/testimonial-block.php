<section class="testimonial-block section-padding">
    <div class="container">
        <div class="testimonial-block__upper">
            <?php if($subheading = get_field('subheading')): ?>
            <h5><?php echo $subheading; ?></h5>
            <?php endif; ?>
            <?php if($title = get_field('title')): ?>
            <h2><?php echo $title; ?></h2>
            <?php endif; ?>
            <?php if($description = get_field('description')): ?>
                <?php echo $description; ?>
            <?php endif; ?>
        </div>
        
        <?php
            $post__in = get_field('show_testimonial') == 'choose-manually' ? get_field('testimonial_to_posts') : array(); 
            $args = array(
                'post_type'      => 'testimonial',
                's'              => $_GET['search-block'],
                'posts_per_page' => -1,
                'post__in'       => $post__in
            );
            $testimonial_posts = new WP_Query( $args );
            $totalpost = (int)$testimonial_posts->found_posts;
        ?>

        <div class="testimonial-block__row row cards-flex">
            <?php while( $testimonial_posts->have_posts() ): $testimonial_posts->the_post(); setup_postdata($testimonial_posts); ?>
                <div class="testimonial-block__item js-testimonial-post">
                    <article class="testimonial-block__card">
                        <?php if($logo_image = get_field('logo', get_the_ID())): ?>
                        <div class="testimonial-block__image">
                            <?php echo fx_get_image_tag($logo_image, 'img-responsive'); ?>
                        </div>
                        <?php endif; ?>
                        <div class="testimonial-block__content">
                            <h3 class="testimonial-block__title h4"><?php echo get_the_title(); ?></h3>
                            <div class="testimonial-block__description">
                                <?php echo get_field('testimonial_content', get_the_ID()); ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php wp_reset_postdata(); endwhile; ?>
        </div>
        <div class="testimonial-block__pagination">
            <div class="testimonial-block__pagination-pagination">
                <p>Showing <span class="testimonial-post-result"><?php echo $totalpost >= 9 ? '9' : $totalpost; ?></span> of <span class="testimonial-post-result"><?php echo $totalpost; ?></span> Results</p>
            </div>
            
            <div class="testimonial-block__pagination__wrapper">
                <div class="testimonial-block__pagination__bar"></div>
            </div>

            <div class="testimonial-block__pagination-view-more-button">
                <a id="testimonial-load-more" class="btn btn-primary">Load More</a>
            </div>
        </div>
    </div>
</section>