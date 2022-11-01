<section class="masthead masthead--innerpage">
    <div class="left-text">
        <div class="left-text-wrapper">
            <?php
                global $post;     // if outside the loop
                global $wp_query;
                $post_id = 0;


                if(is_home() || is_archive()) {
                    $post_id = 17;
                } else {
                    $post_id = $wp_query->post->ID;
                }

                if ( is_page() && $post->post_parent ):
            ?>
                <div class="back-top-page hidden-lg"><a href="<?php echo get_the_permalink($post->post_parent); ?>"><i class="icon-left"></i>Back to <?php echo get_the_title($post->post_parent); ?></a></div>
            <?php else: ?>
                <div class="back-top-page hidden-lg"><a href="<?php echo site_url(); ?>"><i class="icon-left"></i> Back to Homepage</a></div>
            <?php endif; ?>
            <?php
                if( function_exists( 'yoast_breadcrumb' ) ) {
                    yoast_breadcrumb( '<div class="breadcrumbs hidden-md-down">', '</div>' );
                }
            ?>
            <?php if ( is_search() ): ?>
                <h3 class="h1">Search Results</h3><?php /* different heading type for SEO benefit */ ?>
            <?php elseif ( is_home() ): ?>
                <h3 class="h1">Blog</h3><?php /* different heading type for SEO benefit */ ?>
            <?php elseif ( is_404() ) : ?>
                <h1><?php the_field('404_title', 'option'); ?></h1>
            <?php else : ?>
                <h1><?php the_title(); ?></h1>
            <?php endif; ?>
            <?php if($masthead_description = get_field('description', $post_id)): ?>
                <?php echo $masthead_description; ?>
            <?php endif; ?>

            <?php if(is_home() || is_archive()): ?>
                <div class="masthead__category">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-col">
                                <input type="tel" placeholder="&nbsp;">
                                <label>Search blog posts...</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-col">
                                <select name="blog-category" id="blog-category">
                                    <option value="all">Select a category</option>
                                    <option value="knowledge-base">Knowledge Base</option>
                                    <option value="blog">Blog</option>
                                    <option value="guides-and-white-papers">Guides & White-papers</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="right-image hidden-md-down">
        <?php if($catch_image = get_field('catch_image', $post_id)): ?>
        <div class="right-image-wrapper">
            <?php echo fx_get_image_tag($catch_image, 'object-fit'); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
