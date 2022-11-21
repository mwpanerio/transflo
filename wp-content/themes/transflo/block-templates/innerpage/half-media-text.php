<section class="image-text image-text--<?php echo get_field('media_position'); ?> image-text--<?php echo get_field('section_type'); ?> <?php echo get_field('background_type'); ?> section-padding">
    <div class="container">
        <div class="row flex-row<?php echo get_field('media_position') == 'right' ? ' flex-opposite' : ''; ?>">
            <div class="col-lg-6 col-xxs-12 image-text__half image-text__img">
                <?php if(get_field('media_type') == 'image'): ?>
                    <?php echo fx_get_image_tag(get_field('media')['image'], 'object-fit'); ?>
                <?php else: ?>
                    <a class="external js-text-video-cover-link" data-fancybox="" href="<?php echo get_field('media')['video_url']; ?>" target="_blank" rel="noopener">
                        <?php echo fx_get_image_tag(get_field('media')['image_thumbnail'], 'object-fit'); ?>
                        <div class="image-video-text__link">
                            <div class="image-video-text__link__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 96 96">
                                    <g id="Group_21" data-name="Group 21" transform="translate(-6 -6.063)">
                                    <circle id="Ellipse_3" data-name="Ellipse 3" cx="40" cy="40" r="40" transform="translate(14 14.063)" fill="#fff"/>
                                    <path id="Polygon_10" data-name="Polygon 10" d="M17.345,2.439a2,2,0,0,1,3.31,0L35.881,24.877A2,2,0,0,1,34.226,28H3.774a2,2,0,0,1-1.655-3.123Z" transform="translate(71.53 35.063) rotate(90)" fill="#da1f2c"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-xxs-12 image-text__half image-text__text">
                <?php echo get_field('content'); ?>
            </div>
        </div>
    </div>
</section>