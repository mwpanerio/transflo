<?php if(have_rows('counter_item')): ?>
<div class="counter-block" id="counter">
    <div class="container">            
        <div class="counter-bar text-center number-counter-section">
            <ul class="counter-item">
                <?php while(have_rows('counter_item')): the_row(); ?>
                <li>
                    <div class="counter-bttn">
                        <h2>
                            <?php echo get_sub_field('prefix'); ?>
                            <span class="odometer" data-count="<?php echo get_sub_field('number'); ?>">0</span>
                            <?php echo get_sub_field('suffix'); ?>
                        </h2>
                        <p><?php echo get_sub_field('counter_label'); ?></p>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>