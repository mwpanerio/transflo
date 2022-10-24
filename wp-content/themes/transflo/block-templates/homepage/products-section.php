<section class="products section-padding">
    <div class="container">
        <div class="products__top-content">
            <div class="products__heading">
                <?php if($subheading = get_field('subheading')): ?>
                <h5><?php echo $subheading; ?></h5>
                <?php endif; ?>
                <?php if($main_title = get_field('main_title')): ?>
                <h2><?php echo $main_title; ?></h2>
                <?php endif; ?>
            </div>
            <?php if($button = get_field('button')): ?>
            <div class="products__btns hidden-md-down">
                <a href="<?php echo $button['url']; ?>" class="btn btn-primary"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>
                    <?php echo $button['title']; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="products__listings">
            <div class="js-products-slider fx-slider">
                <?php while(have_rows('product_slider')): the_row(); ?>
                <div class="products-items fx-slide">
                    <a href="<?php echo get_sub_field('button')['url']; ?>" class="products__link"<?php echo get_sub_field('button')['target'] ? ' target="' . get_sub_field('button')['target'] . '"': ''; ?>>
                        <div class="products__info-top">
                            <div class="products__image">
                                <?php if($image = get_sub_field('image')): ?>
                                    <?php echo fx_get_image_tag($image, 'object-fit'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="products__descrition">
                                <?php if($title = get_sub_field('title')): ?>
                                <h3><?php echo $title; ?></h3>
                                <?php endif; ?>
                                <?php if($description = get_sub_field('description')): ?>
                                <p><?php echo $description; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="products__info-bottom">
                            <span class="btn btn-secondary">Learn More</span>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="progress-products-item" role="progressbar" aria-valuemin="0" aria-valuemax="100" ></div>
        </div>
        <?php if($button = get_field('button')): ?>
        <div class="products__btns hidden-lg">
            <a href="<?php echo $button['url']; ?>" class="btn btn-primary"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>
                <?php echo $button['title']; ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>