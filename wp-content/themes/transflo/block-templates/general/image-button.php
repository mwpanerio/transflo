<section class="image-buttons<?php echo is_front_page() ? ' push-lg-top': ' section-padding'; ?>">
    <div class="container">
        <div class="image-buttons__top-content">
            <div class="image-buttons__heading">
                <?php if($subheading = get_field('subheading')): ?>
                <h5><?php echo $subheading; ?></h5>
                <?php endif; ?>
                <?php if($title = get_field('title')): ?>
                <h2><?php echo $title; ?></h2>
                <?php endif; ?>
            </div>
            <?php if($button = get_field('button')): ?>
            <div class="image-buttons__all-btn hidden-md-down">
                <a href="<?php echo $button['url']; ?>" class="btn btn-secondary"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>
                    <?php echo $button['title']; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="image-buttons">
            <div class="row">
                <?php while(have_rows('image_button_item')): the_row(); ?>
                <div class="col-lg-4 col-sm-6 image-button-item">
                    <a class="image-button image-button--link" href="<?php echo get_sub_field('link')['url']; ?>"<?php echo get_sub_field('link')['target'] ? ' target="' . get_sub_field('link')['target'] . '"': ''; ?>>
                        <?php if($image = get_sub_field('image')): ?>
                            <?php echo fx_get_image_tag($image, 'image-button__img'); ?>
                        <?php endif; ?>
                        <div class="image-button__info">
                            <?php if($title = get_sub_field('title')): ?>
                            <h3 class="image-button__title"><?php echo $title; ?></h3>
                            <?php endif; ?>
                            <span class="image-button__arrow"><i class="icon-button-right"></i></span>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <?php if($button = get_field('button')): ?>
        <div class="image-buttons__all-btn hidden-lg">
            <a href="<?php echo $button['url']; ?>" class="btn btn-secondary"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>
                <?php echo $button['title']; ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>