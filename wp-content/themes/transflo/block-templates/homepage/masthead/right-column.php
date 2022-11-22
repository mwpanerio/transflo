<?php while(have_rows('right_column')): the_row(); ?>
<div class="masthead__right clearfix">
    <?php while(have_rows('step_block')): the_row(); ?>
    <div class="masthead__right__column masthead__right__column1 js-masthead-column-item masthead-column-item--2">
        <div class="image-buttons__popup__wrapper" id="js-masthead-tile-popup">
            <div class="popup-cross">
                <i class="icon-close"></i>
            </div>
            <div class="image-button__popup__inner">
                <div class="image-buttons__popup__image">
                    <span></span>
                    <img src="" alt="">
                </div>
                <div class="image-buttons__popup__info">
                    <h3> <span>Factoring</span> <i class="icon-button-right"></i></h3>
                    <div class="image-buttons__popup__description">
                        <p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="masthead__tiles">
            <?php while(have_rows('step_item')): the_row(); ?>
            <div class="masthead__tiles__col js-masthead-tiles">
                <div class="masthead__tiles__image">
                    <span></span>
                    <?php echo fx_get_image_tag(get_sub_field('image'), 'object-fit'); ?>
                    <div class="masthead__tiles__info">
                        <h4><?php echo get_sub_field('title'); ?></h4>
                    </div>
                </div>
                <div class="image-buttons__popup">
                    <div class="image-buttons__popup__column">
                        <div class="popup-cross">
                            <i class="icon-close"></i>
                        </div>
                        <div class="image-buttons__popup__image">
                            <?php echo fx_get_image_tag(get_sub_field('image'), 'object-fit'); ?>
                        </div>
                        <div class="image-buttons__popup__info">
                            <a href="<?php echo get_sub_field('link')['url']; ?>"<?php echo get_sub_field('link')['target'] ? ' target="' . get_sub_field('link')['target'] . '"': ''; ?>>
                                <h3><?php echo get_sub_field('title'); ?> <i class="icon-button-right"></i></h3>
                            </a>
                            <p><?php echo get_sub_field('description'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endwhile; ?>

    <?php while(have_rows('mini_slider')): the_row(); ?>
    <div class="masthead__right__column masthead__right__column2 js-masthead-column-item masthead-column-item--3">
        <div class="js-masthead__slider2 fx-slider">
            <?php while(have_rows('slider_item')): the_row(); ?>
            <div class="masthead__slider__item fx-slide">
                <a class="masthead__slider-col" href="<?php echo get_sub_field('link')['url']; ?>"<?php echo get_sub_field('link')['target'] ? ' target="' . get_sub_field('link')['target'] . '"': ''; ?>>
                    <div class="masthead__slider-image">
                        <?php echo fx_get_image_tag(get_sub_field('image'), 'object-fit'); ?>
                    </div>
                    <div class="masthead__slider-info">
                        <h3><?php echo get_sub_field('title'); ?></h3>
                        <div class="masthead__slider-link">
                            <i class="icon-button-right"></i>
                        </div>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="slider-nav hidden-md-down">
            <div class="slider-nav__prev">-</div>
            <div class="slider-nav__next">-</div>
        </div>
        <div class="progress-1" role="progressbar" aria-valuemin="0" aria-valuemax="100" ></div>
    </div>
    <?php endwhile; ?>
</div>
<?php endwhile; ?>