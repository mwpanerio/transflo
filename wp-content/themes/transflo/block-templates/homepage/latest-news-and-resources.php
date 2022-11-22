<section class="cards bg-gray section-padding">
    <div class="container">
        <div class="cards__top-content text-center js-animated-text animated-text">
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
        <div class="row cards-flex js-cards-slider fx-slider js-slider-animation-row">
            <?php
                $posts_to_display = get_field('posts_to_display');

                foreach($posts_to_display as $posts_to_display_item):
            ?>
            <div class="col-sm-6 col-lg-4 card-item fx-slide js-slider-animation-row-item">
                <a class="card card--link" href="<?php echo get_the_permalink($posts_to_display_item); ?>">
                    <div class="card__top">
                        <div class="card__img-wrap">
                            <?php if($featured_image = get_field('featured_image', $posts_to_display_item)): ?>
                                <?php echo fx_get_image_tag($featured_image, 'card__img object-fit'); ?>
                            <?php else: ?>
                                <?php echo fx_get_image_tag(get_field('placeholder_image', 'option'), 'card__img object-fit'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="card__details">
                            <div class="card__icon"> <span>Read More</span><i class="icon-button-right"></i></div>
                            <div class="card__date"><?php echo get_the_date('F j, Y', $posts_to_display_item); ?></div>
                            <h4 class="card__title"><?php echo get_the_title($posts_to_display_item); ?></h4>
                        </div>
                        <div class="card__bottom">
                            <?php
                                $post = get_post($posts_to_display_item);
                                $blocks = parse_blocks( $post->post_content );

                                foreach ( $blocks as $block ) {
                                if ( 'acf/wysiwyg' === $block['blockName'] ) {
                                        if(isset($block["attrs"]["data"]["content"])) {
                                            $excerpt = strip_tags(trim($block["attrs"]["data"]["content"]));
                                        }
                                        break;
                                    }
                                }

                                echo $excerpt;
                            ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if($button = get_field('button')): ?>
            <div class="card-btn text-center">
                <a href="<?php echo $button['url']; ?>" class="btn btn-secondary"<?php echo $button['target'] ? ' target="' . $button['target'] . '"' : ''; ?>><?php echo $button['title']; ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>