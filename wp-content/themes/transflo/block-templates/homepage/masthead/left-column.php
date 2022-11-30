<?php while(have_rows('left_column')): the_row(); ?>
<div class="masthead__left masthead-column-item--1 js-masthead-column-item">
    <?php if(get_sub_field('media_type_to_display') == 'video'): ?>
        <div class="masthead__image">
            <script src="https://player.vimeo.com/api/player.js"></script>
            <iframe src="<?php echo get_sub_field('video_url'); ?>&autoplay=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            <div class="masthead__image__overlay" id="js-video-play">
                <?php echo fx_get_image_tag(get_sub_field('thumbnail_image'), 'img-responsive'); ?>
                <div class="masthead__image__video">
                    <div class="masthead__image__video__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 96 96">
                            <g id="Group_21" data-name="Group 21" transform="translate(-6 -6.063)">
                            <circle id="Ellipse_3" data-name="Ellipse 3" cx="40" cy="40" r="40" transform="translate(14 14.063)" fill="#fff"/>
                            <path id="Polygon_10" data-name="Polygon 10" d="M17.345,2.439a2,2,0,0,1,3.31,0L35.881,24.877A2,2,0,0,1,34.226,28H3.774a2,2,0,0,1-1.655-3.123Z" transform="translate(71.53 35.063) rotate(90)" fill="#da1f2c"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
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