<section class="subscribes <?php echo get_field('background_type'); ?> section-padding">
    <div class="container">
        <div class="subscribe">
            <h3 class="text-center"><?php echo get_field('title'); ?></h3>
            <?php echo apply_shortcodes(get_field('form_shortcode')); ?>
        </div>
    </div>
</section>