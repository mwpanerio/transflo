<section class="benefits-section benefits-section--version-<?php echo get_field('benefits_section_look'); ?> section-padding <?php echo get_field('background_color'); ?>">
    <div class="container">
        <div class="benefits-section__header js-animated-text animated-text">
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
            <?php $column_per_row = (int)get_field('benefits_column_per_row'); ?>
            <div class="row flex-row js-benefits-slider fx-slider<?php echo count(get_field('benefits_item')) > $column_per_row ? '' : ' benefits-section--equal'; ?>" data-benefits-slider="<?php echo $column_per_row; ?>">
                <?php while(have_rows('benefits_item')): the_row(); ?>
                <div class="benefits-section__item col-xxs-12 col-sm-6 col-lg-<?php echo 12 / $column_per_row; ?> fx-slide">
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
            <?php if(count(get_field('benefits_item')) > $column_per_row): ?>
            <div class="benefits-section-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            <?php endif; ?>
        </div>
    </div>
</section>