<?php if(have_rows('statistics_item')): ?>
<div class="counter-block counter-block--<?php echo get_field('background_type'); ?> bg-white section-padding">
    <div class="container">           
        <div class="counter-block__upper">
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
        <div class="counter-bar text-center number-counter-section">
            <ul class="counter-item">
                <?php while(have_rows('statistics_item')): the_row(); ?>
                <li>
                    <div class="counter-bttn">
                        <h2>
                        <?php if(get_sub_field('statistic_type') !== 'rating'): ?>
                            <?php while(have_rows('revenue')): the_row(); ?>
                                <?php echo get_sub_field('prefix'); ?>
                                <span class="odometer" data-count="<?php echo get_sub_field('value'); ?>">0</span>
                                <?php echo get_sub_field('suffix'); ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <span class="odometer" data-count="<?php echo get_sub_field('rating_1_out_of_10'); ?>">0</span>/10
                        <?php endif; ?>
                        </h2>
                        <p><?php echo get_sub_field('description'); ?></p>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>