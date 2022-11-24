<?php while(have_rows('left_column')): the_row(); ?>
<div class="masthead__left masthead-column-item--1 js-masthead-column-item">
    <?php if(get_sub_field('media_type_to_display') == 'video'): ?>
        <div class="masthead__image">
            <iframe src="<?php echo get_sub_field('video_url'); ?>" frameborder="0"></iframe>
        </div>
    <?php else: ?>
        <div class="masthead__image">
            <?php echo fx_get_image_tag(get_sub_field('catch_image'), 'img-responsive'); ?>
        </div>
    <?php endif; ?>
    <div class="masthead__info">
        <h3><?php echo get_sub_field('title'); ?></h3>
        <p><?php echo get_sub_field('description'); ?></p>
        <?php while(have_rows('button')): the_row(); ?>
            <?php if($link = get_sub_field('link')):?>
                <a href="<?php echo $link['url']; ?>" class="btn <?php echo get_sub_field('button_type'); ?>"<?php echo $link['target'] ? ' target="' . $link['target'] . '"': ''; ?>><?php echo $link['title']; ?></a>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</div>
<?php endwhile; ?>