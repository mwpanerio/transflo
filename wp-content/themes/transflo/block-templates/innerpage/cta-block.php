<section class="cta-block cta-block--<?php echo get_field('cta_type'); ?><?php echo get_field('cta_type') == 'full-width' ? '' : ' section-padding bg-white'; ?>">
    <?php if(get_field('background_image') && get_field('cta_type') == 'full-width'): ?>
    <div class="cta-block__image">
        <?php echo fx_get_image_tag(get_field('background_image')); ?>
    </div>
    <?php elseif(get_field('background_type') == 'solid-color' && get_field('cta_type') == 'full-width'):?>
    <div class="cta-block__solid-background<?php echo get_field('background_type') == 'solid-color' ? ' ' . get_field('background_color') : ''; ?>"></div>
    <?php endif; ?>
    <div class="container">
        <div class="cta-block__inner<?php echo get_field('background_type') == 'solid-color' ? ' ' . get_field('background_color') : ''; ?>">
            <?php if(get_field('background_image') && get_field('background_type') != 'solid-color' && get_field('cta_type') != 'full-width'): ?>
            <div class="cta-block__image">
                <?php echo fx_get_image_tag(get_field('background_image')); ?>
            </div>
            <?php endif; ?>
            <div class="cta-block__content">
                <h2><?php echo get_field('title'); ?></h2>
                <?php echo get_field('description');?>
            </div>
            <?php if($button = get_field('button')): ?>
            <div class="cta-block__button">
                <a href="<?php echo $button['url']; ?>" class="btn btn-secondary"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>
                    <?php echo $button['title']; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>