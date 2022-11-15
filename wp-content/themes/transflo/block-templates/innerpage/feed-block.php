<section class="products section-padding bg-gray">
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
            <div class="products__btns">
                <ul class="product__feed">
                    <li><a href="<?php echo get_field('facebook', 'option'); ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                    <li><a href="<?php echo get_field('twitter', 'option'); ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                    <li><a href="<?php echo get_field('youtube', 'option'); ?>" target="_blank"><i class="icon-youtube"></i></a></li>
                    <li><a href="<?php echo get_field('linkedin', 'option'); ?>" target="_blank"><i class="icon-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="products__listings">
            <!-- <div class="js-products-slider fx-slider">
                <?php while(have_rows('product_slider')): the_row(); ?>
                <div class="products-items fx-slide">
                    <a href="<?php echo get_sub_field('button')['url']; ?>" class="products__link"<?php echo get_sub_field('button')['target'] ? ' target="' . get_sub_field('button')['target'] . '"': ''; ?>>
                        <div class="products__info-top">
                            <div class="products__image">
                                <?php if($image = get_sub_field('image')): ?>
                                    <?php echo fx_get_image_tag($image, 'object-fit'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="products__description">
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
            <div class="progress-products-item" role="progressbar" aria-valuemin="0" aria-valuemax="100" ></div> -->
        </div>
    </div>
</section>