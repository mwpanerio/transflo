<section class="image-overlay-text section-padding bg-white">
    <div class="container">
        <div class="image-overlay-text__wrap">
            <div class="image-overlay-image">
                <?php 
                    if($image = get_field('image')) {
                        echo fx_get_image_tag($image, 'object-fit');
                    }
                ?>
            </div>
            <div class="image-overlay-text__content">
                <div class="image-overlay-text__column">
                    <?php if($subheading = get_field('subheading')): ?>
                    <h5><?php echo $subheading; ?></h5>
                    <?php endif; ?>
                    <?php if($title = get_field('title')): ?>
                    <h2><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php $button_count = 0; while(have_rows('button')): the_row(); ?>
                        <?php if(get_sub_field('button_popup')): ?>
                            <a href="#js-form-popup-<?php echo $button_count; ?>" class="btn <?php echo get_sub_field('button_type'); ?> js-form-popup-button"><?php echo get_sub_field('button_popup_text') ? get_sub_field('button_popup_text') : 'Learn more'; ?></a>
                        <?php else: ?>
                            <?php if($button = get_sub_field('button_item')): ?>
                            <a href="<?php echo $button['url']; ?>" class="btn <?php echo get_sub_field('button_type'); ?>"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>><?php echo $button['title']; ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php $button_count++; endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $button_count = 0; while(have_rows('button')): the_row(); ?>
        <?php if(get_sub_field('button_popup')): ?>
            <div class="image-overlay__popup js-form-popup" id="js-form-popup-<?php echo $button_count; ?>">
                <div class="image-overlay__popup__container">
                    <div class="image-overlay__popup__inner js-form-popup__inner">
                        <div class="image-overlay__popup__close js-form-popup-close">
                            <span></span>
                        </div>
                        <h3 class="image-overlay__popup__title"><?php echo get_sub_field('form_title')?></h3>
                        <?php echo apply_shortcodes(get_sub_field('form_shortcode')); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php $button_count++; endwhile; ?>
</section>
