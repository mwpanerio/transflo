<section class="testimonials testimonials--general-tab section-padding">
    <div class="container">
        <div class="testimonials__top-content text-center">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
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
            </div>
        </div>
        <div class="testimonials__wrap">
            <div class="js-tab-menu fx-slider">
                <?php while(have_rows('tab_item')) : the_row(); ?>
                <div class="tab-menu-item fx-slide">
                    <div class="tab-column">
                        <p><?php echo get_sub_field('headline'); ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="js-tab-for fx-slider">
                <?php while(have_rows('tab_item')) : the_row(); ?>
                <div class="tab-content-item fx-slide">
                    <div class="tab-content">
                        <div class="testimonials__info">
                            <?php echo get_sub_field('description'); ?>
                        </div>
                        <?php if($image = get_sub_field('image')): ?>
                        <div class="testimonials__image">
                            <?php echo fx_get_image_tag($image); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>