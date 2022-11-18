<section class="benefits-section benefits-section--version-1 benefits-section--not-slider section-padding <?php echo get_field('background_type'); ?>">
    <div class="container">
        <div class="benefits-section__header">
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
        <div class="benefits-section__row">
            <div class="row flex-row">
                <?php while(have_rows('image_button')): the_row(); ?>
                <div class="benefits-section__item col-xxs-12 col-sm-6 col-lg-4">
                    <article class="benefits-section__card">
                        <div class="benefits-section__image">
                            <?php echo fx_get_image_tag(get_sub_field('image')); ?>
                        </div>
                        <div class="benefits-section__content">
                            <?php echo get_sub_field('description'); ?>
                        </div>
                    </article>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>