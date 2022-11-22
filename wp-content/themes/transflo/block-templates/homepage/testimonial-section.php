<section class="testimonials section-padding">
    <div class="container">
        <div class="testimonials__top-content text-center">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 js-animated-text animated-text">
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
            </div>
        </div>
        <div class="testimonials__wrap">
            <div class="js-tab-menu fx-slider">
                <?php
                    $testimonial_to_posts = get_field('testimonial_to_posts');

                    foreach($testimonial_to_posts as $testimonial_to_post):
                ?>
                <div class="tab-menu-item fx-slide">
                    <div class="tab-column">
                        <?php if(get_field('logo', $testimonial_to_post)): ?>
                            <?php echo fx_get_image_tag(get_field('logo', $testimonial_to_post), 'img-responsive'); ?>
                        <?php else: ?>
                            <p><?php echo get_the_title($testimonial_to_post); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="js-tab-for fx-slider">
                <?php foreach($testimonial_to_posts as $testimonial_to_post): ?>
                <div class="tab-content-item fx-slide">
                    <div class="tab-content">
                        <div class="testimonials__info">
                            <div class="stars">
                                <ul>
                                    <li><i class="icon-star"></i></li>
                                    <li><i class="icon-star"></i></li>
                                    <li><i class="icon-star"></i></li>
                                    <li><i class="icon-star"></i></li>
                                    <li><i class="icon-star"></i></li>
                                </ul>
                            </div>
                            <?php echo get_field('testimonial_content', $testimonial_to_post); ?>
                            <span class="testimonials-author"><?php echo get_field('client_name', $testimonial_to_post); ?></span>
                            <span class="testimonials-author-position"><?php echo get_field('location', $testimonial_to_post); ?></span>
                        </div>
                        <div class="testimonials__image testimonials__image--<?php echo get_field('featured_image_type', $testimonial_to_post); ?> hidden-md-down">
                            <?php echo fx_get_image_tag(get_post_thumbnail_id($testimonial_to_post), 'img-responsive'); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php while(have_rows('stats_counter')): the_row(); ?>
    <div class="counter-block counter-block--white" id="counter">
        <div class="container">            
            <div class="counter-bar text-center number-counter-section">
                <ul class="counter-item">
                    <?php while(have_rows('first_stats')): the_row(); ?>
                    <li>
                        <div class="counter-bttn">
                            <h2>><span class="odometer" id="odometer3" data-count="<?php echo get_sub_field('number_of_fleets'); ?>">00000</span></h2>
                            <p><?php echo get_sub_field('label'); ?></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                    <?php while(have_rows('second_stats')): the_row(); ?>
                    <li>
                        <div class="counter-bttn">
                            <h2><span class="odometer" id="odometer4" data-count="<?php echo get_sub_field('percentage'); ?>">00</span>%</h2>
                            <p><?php echo get_sub_field('label'); ?></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                    <?php while(have_rows('third_stats')): the_row(); ?>
                    <li>
                        <div class="counter-bttn">
                            <h2><span class="odometer" id="odometer5" data-count="<?php echo get_sub_field('out_of_ten_score'); ?>">0</span>/10</h2>
                            <p><?php echo get_sub_field('label'); ?></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</section>