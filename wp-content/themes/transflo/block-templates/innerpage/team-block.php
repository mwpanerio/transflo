<section class="team-block section-padding <?php echo get_field('background_type'); ?>">
    <div class="container">
        <?php if(get_field('subheading') || get_field('title') || get_field('description')):?>
        <div class="team-block__upper js-animated-text animated-text">
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
        <?php endif; ?>
        <ul class="team-block__list">
            <?php $count = 0; while(have_rows('teams')): the_row(); ?>
            <li class="team-block__item">
                <article class="team-block__card js-team-card" data-modal-target="#js-team-modal-<?php echo $count; ?>">
                    <div class="team-block__card__inner">
                        <div class="team-block__card__image">
                            <?php echo fx_get_image_tag(get_sub_field('image')); ?>
                        </div>
                        <div class="team-block__card__content">
                            <h3 class="h4"><?php echo get_sub_field('name'); ?></h3>
                            <strong><?php echo get_sub_field('job_title'); ?></strong>
                        </div>
                    </div>
                </article>
            </li>
            <?php $count++; endwhile; ?>
        </ul>
    </div>

    <?php $modal_count = 0; while(have_rows('teams')): the_row(); ?>
    <div class="team-block__modal js-team-modal" id="js-team-modal-<?php echo $modal_count; ?>">
        <div class="container">
            <div class="team-block__modal__inner">
                <div class="team-block__modal__close js-team-modal-close">
                    <span></span>
                </div>
                <div class="team-block__modal__image">
                    <?php echo fx_get_image_tag(get_sub_field('image')); ?>
                </div>
                <div class="team-block__modal__content">
                    <div class="team-block__modal__content__inner">
                        <h3 class="h4"><?php echo get_sub_field('name'); ?></h3>
                        <strong><?php echo get_sub_field('job_title'); ?></strong>
                        <?php if($description = get_sub_field('description')): ?>
                        <div class="team-block__modal__description">
                            <?php echo $description; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $modal_count++; endwhile; ?>
</section>