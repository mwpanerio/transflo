<section class="masthead masthead--innerpage">
    <div class="left-text">
        <div class="left-text-wrapper">
            <div class="back-top-page hidden-lg"><a href="#"><i class="icon-left"></i> Back to About</a></div>
            <div class="breadcrumbs hidden-md-down">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li>Flexible Content</li>
                </ul>
            </div>
            <?php
                if( function_exists( 'yoast_breadcrumb' ) ) {
                    yoast_breadcrumb( '<div class="breadcrumbs">', '</div>' );
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
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae ipsum vulputate, pharetra tellus ut, ornare felis. Phasellus ornare, tellus et interdum consequat, dolor nisl tempus mi, ac scelerisque dolor justo non dolor.</p>
            <a href="#" class="btn btn-primary">Primary Button</a>
            <a href="#" class="btn btn-secondary">Secondary Button</a>
        </div>
    </div>
    <div class="right-image hidden-md-down">
        <div class="right-image-wrapper">
            <img src="../wp-content/themes/transflo/assets/img/masthead-image.jpg" alt="" class="object-fit">
        </div>
    </div>
</section>
