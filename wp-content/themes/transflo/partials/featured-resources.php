<?php if($posts_query->have_posts()): ?>
<div class="header-card__row">
    <?php while($posts_query->have_posts()): $posts_query->the_post(); setup_postdata($posts_query); ?>
    <div class="header-card__item">
        <article class="header-card">
            <a href="<?php echo get_the_permalink(); ?>">
                <div class="header-card__image">
                    <?php if($featured_image = get_field('featured_image', get_the_ID())): ?>
                        <?php echo fx_get_image_tag($featured_image); ?>
                    <?php else: ?>
                        <?php echo fx_get_image_tag(get_field('placeholder_image', 'option')); ?>
                    <?php endif; ?>
                </div>
                <div class="header-card__content">
                    <h3><?php echo get_the_title(); ?></h3>
                    <div class="header-card__icon">
                        <i class="icon-button-right"></i>
                    </div>
                </div>
            </a>
        </article>
    </div>
    <?php wp_reset_postdata(); endwhile; ?>
</div>
<?php endif; ?>