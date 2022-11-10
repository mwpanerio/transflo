<section class="cta-block cta-block--<?php echo get_field('cta_type'); ?><?php echo get_field('cta_type') == 'full-width' ? '' : ' section-padding hard-top'; ?>">
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
                <h2>Schedule A Demo</h2>
                <p>Learn more about Transflo solutions.</p>
            </div>
            <div class="cta-block__button">
                <a href="#" class="btn btn-secondary">Schedule a Demo</a>
            </div>
        </div>
    </div>
</section>