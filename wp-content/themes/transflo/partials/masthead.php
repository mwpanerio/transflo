<section class="masthead masthead--innerpage" id="js-masthead-innerpage">
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
                <h3 class="h1">Resources</h3><?php /* different heading type for SEO benefit */ ?>
            <?php elseif ( is_404() ) : ?>
                <h1><?php the_field('404_title', 'option'); ?></h1>
            <?php elseif ( is_category() ) : ?>
                <?php
                    $current_slug = '';

                    if(is_category()) {
						$category = get_category( get_query_var( 'cat' ) );
                        $current_slug = $category->slug;
                        $current_category_name = $category->name;
                    }    
                ?>
                <h3 class="h1"><?php echo $current_category_name; ?></h3>
            <?php else : ?>
                <h1><?php the_title(); ?></h1>
            <?php endif; ?>
            <?php if ( !is_search() ): ?>
                <?php if($masthead_description = get_field('description', $post_id)): ?>
                    <?php echo $masthead_description; ?>
                <?php endif; ?>
                <?php if(is_404()): ?>
                    <?php echo get_field('masthead_description', 'option'); ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(is_home() || is_archive()): ?>
                <div class="masthead__category">
                    <div class="row">
                        <div class="col-xxs-12 col-sm-6 col-lg-6">
                            <form action="./" class="form masthead__category__search">
                                <div class="form-col">
                                    <input type="text" placeholder="&nbsp;" name="search-block" id="search-block" value="<?php echo get_search_query( true ); ?>" data-swplive="true">
                                    <?php 
                                        if(is_category()):
                                            $current_category_name = get_the_category()[0]->name;
                                    ?>
                                        <label for="search-block">Search for <?php echo strtolower($current_category_name); ?> posts...</label>
                                    <?php else: ?>
                                        <label for="search-block">Search blog posts...</label>
                                    <?php endif; ?>
                                </div>
                                <button type="submit"><i class="icon-search"></i></button>
                            </form>
                        </div>
                        <div class="col-xxs-12 col-sm-6 col-lg-6">
                            <div class="form-col">
                                <?php 
                                    $categories = get_terms(
                                        [
                                            'hide_empty'    => true,
                                            'post_type'     => 'post',
                                            'taxonomy'      => 'category',
                                        ]
                                    );
                                ?>
                                <select name="blog-category" id="blog-category">
                                    <option value="<?php echo home_url() . '/resources'; ?>">Select a category</option>
                                    <?php foreach($categories as $category): ?>
                                    <option value="<?php echo home_url() . '/' . $category->slug; ?>"<?php echo $current_slug == $category->slug ? ' selected' : ''; ?>><?php echo $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="right-image hidden-md-down">
        <?php if ( !is_search() ): ?>
            <?php if($catch_image = get_field('catch_image', $post_id)): ?>
            <div class="right-image-wrapper">
                <?php echo fx_get_image_tag($catch_image, 'object-fit'); ?>
            </div>
            <?php elseif(is_singular()): ?>
                <div class="right-image-wrapper">
                    <?php echo fx_get_image_tag(get_field('featured_image'), 'object-fit'); ?>
                </div>
            <?php elseif(is_404()): ?>
                <div class="right-image-wrapper">
                    <?php echo fx_get_image_tag(get_field('404_masthead_catch_image', 'option'), 'object-fit'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>


<?php if(is_home() || is_archive()): ?>
    <section class="masthead masthead--sticky masthead--innerpage hidden-xs-down" id="js-masthead-sticky">
        <div class="container">
            <div class="masthead-content">
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
                <?php
                    $current_slug = '';

                    if(is_category()):
						$category = get_category( get_query_var( 'cat' ) );
                        $current_slug = $category->slug;
                        $current_category_name = $category->name;
                ?>
                <h3><?php echo $current_category_name; ?></h3>
                <?php else: ?>
                <h3>Resources</h3>
                <?php endif; ?>
            </div>
            <div class="masthead__category">
                <div class="row">
                    <div class="col-xxs-12 col-sm-6 col-lg-6">
                        <form action="./" class="form masthead__category__search">
                            <div class="form-col">
                                <input type="text" placeholder="&nbsp;" name="search-block" id="search-block" value="<?php echo get_search_query( true ); ?>" data-swplive="true">
                                <?php 
                                    if(is_category()):
                                        $current_category_name = get_the_category()[0]->name;
                                ?>
                                    <label for="search-block">Search for <?php echo strtolower($current_category_name); ?> posts...</label>
                                <?php else: ?>
                                    <label for="search-block">Search blog posts...</label>
                                <?php endif; ?>
                            </div>
                            <button type="submit"><i class="icon-search"></i></button>
                        </form>
                    </div>
                    <div class="col-xxs-12 col-sm-6 col-lg-6">
                        <div class="form-col">
                            <?php 
                                $categories = get_terms(
                                    [
                                        'hide_empty'    => true,
                                        'post_type'     => 'post',
                                        'taxonomy'      => 'category',
                                    ]
                                );
                            ?>
                            <select name="blog-category" id="blog-category">
                                <option value="<?php echo home_url() . '/resources'; ?>">Select a category</option>
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo home_url() . '/' . $category->slug; ?>"<?php echo $current_slug == $category->slug ? ' selected' : ''; ?>><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>