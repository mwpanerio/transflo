<section class="image-form section-padding">
    <div class="container">
        <div class="half-img-form">
            <div class="half-img-form__image">
                <?php echo fx_get_image_tag(get_field('image'), 'object-fit'); ?>
            </div>
            <div class="half-img-form__text">
                <?php if($subheading = get_field('subheading')): ?>
                    <h5><?php echo $subheading; ?></h5>
                <?php endif; ?>
                <?php if($title = get_field('title')): ?>
                    <h3><?php echo $title; ?></h3>
                <?php endif; ?>
                <?php if($description = get_field('description')): ?>
                    <?php echo $description; ?>
                <?php endif; ?>
                <?php echo apply_shortcodes(get_field('form_shortcode')); ?>
            </div>
        </div>
    </div>
</section>