<section class="image-overlay-text section-padding">
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
                    <?php while(have_rows('button')): the_row(); ?>
                        <?php if($button = get_sub_field('button_item')): ?>
                        <a href="<?php echo $button['url']; ?>" class="btn <?php echo get_sub_field('button_type'); ?>"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>><?php echo $button['title']; ?></a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>