<section class="masthead masthead--innerpage">
    <div class="left-text">
        <div class="left-text-wrapper">
            <div class="back-top-page hidden-lg"><a href="#"><i class="icon-left"></i> Back to About</a></div>
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
            <?php if($masthead_description = get_field('description')): ?>
                <?php echo $masthead_description; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="right-image hidden-md-down">
        <?php if($catch_image = get_field('catch_image')): ?>
        <div class="right-image-wrapper">
            <?php echo fx_get_image_tag($catch_image, 'object-fit'); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
