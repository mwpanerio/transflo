<?php
    $broker_states = get_terms(
        [
            'hide_empty'    => true,
            'post_type'     => 'brokers_list',
            'taxonomy'      => 'brokers_list_category',
        ]
    );

    $brokers_list_args = [
        'post_type'      => 'brokers_list',
        'posts_per_page' => -1,
        'orderby'        => 'post_title',
        'order'          => 'ASC'
    ];

    $brokers_list_posts = new WP_Query($brokers_list_args);
    $brokers_list_posts_count = $brokers_list_posts->found_posts;

?>
<section class="brokers-list section-padding hard-top">
    <div class="container">
        <div class="brokers-list__upper">
            <div class="brokers-list__upper__title">
                <h2 class="h1">Search for a Broker</h2>
            </div>
            <form class="brokers-list__upper__form">
                <div class="brokers-list__upper__form__item">
                    <p>Search by Name</p>
                    <div class="form-col">
                        <input type="text" placeholder="&nbsp;" id="search-by-name" name="search-by-name">
                        <label for="search-by-name">Search...</label>
                    </div>
                </div>
                <div class="brokers-list__upper__form__item">
                    <p>Filter by State</p>
                    <div class="form-col">
                        <select name="filter-by-state" id="filter-by-state">
                            <option value="*">Select One</option>
                            <?php foreach($broker_states as $broker_state): ?>
                            <option value=".<?php echo esc_attr( $broker_state->slug ); ?>"><?php echo esc_attr( $broker_state->name ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="brokers-list__upper__form__item">
                    <button class="btn btn-primary" type="submit" id="js-search-broker">Go</button>
                </div>
            </form>
        </div>
        <div class="brokers-list__container">
            <div class="brokers-list__modal">
                <?php while($brokers_list_posts->have_posts()): $brokers_list_posts->the_post(); setup_postdata($brokers_list_posts); ?>
                <div class="brokers-list__modal__container" id="js-broker-list-modal-<?php echo get_the_ID(); ?>">
                    <div class="brokers-list__modal__wrapper">
                        <button class="brokers-list__modal__close">
                            <span></span>
                        </button>
                        <div class="brokers-list__modal__upper">
                            <div class="brokers-list__modal__upper__inner">
                                <?php foreach( get_the_terms(get_the_ID(), 'brokers_list_category') as $state ): ?>
                                <span class="brokers-list__modal__location hidden-xs-down">
                                    <i class="icon-location"></i>
                                    <span><?php echo $state->name; ?></span>
                                </span>
                                <?php endforeach; ?>
                                <h2 class="brokers-list__modal__title hidden-xs-down"><?php echo get_the_title(); ?></h2>
                                <a href="" class="btn btn-tertiary hidden-sm-up">Visit More</a>
                                <?php if($button = get_field('site_link', get_the_ID())): ?>
                                    <a href="<?php echo $button['url']; ?>" class="btn btn-tertiary hidden-sm-up"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>Visit Site</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="brokers-list__modal__left">
                            <div class="brokers-list__modal__image">
                                <?php 
                                    if($logo_image = get_field('logo', get_the_ID())) {
                                        echo fx_get_image_tag($logo_image);
                                    } else {
                                        echo fx_get_image_tag(get_field('brokers_list_placeholder_image', 'option'));
                                    }
                                ?>
                            </div>
                            <?php if($button = get_field('site_link', get_the_ID())): ?>
                                <a href="<?php echo $button['url']; ?>" class="btn btn-tertiary hidden-xs-down"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>Visit Site</a>
                            <?php endif; ?>
                        </div>
                        <div class="brokers-list__modal__right">
                            <div class="brokers-list__modal__upper__inner hidden-sm-up">
                                <?php foreach( get_the_terms(get_the_ID(), 'brokers_list_category') as $state ): ?>
                                <span class="brokers-list__modal__location">
                                    <i class="icon-location"></i>
                                    <span><?php echo $state->name; ?></span>
                                </span>
                                <?php endforeach; ?>
                                <h2 class="brokers-list__modal__title"><?php echo get_the_title(); ?></h2>
                            </div>
                            <div class="brokers-list__modal__description">
                                <?php echo get_field('broker_description', get_the_ID()); ?>
                            </div>
                            <dl class="brokers-list__modal__info">
                                <div>
                                    <dt>State</dt>
                                    <?php foreach( get_the_terms(get_the_ID(), 'brokers_list_category') as $state ): ?>
                                    <dd><?php echo $state->name; ?></dd>
                                    <?php endforeach; ?>
                                </div>
                                <?php while(have_rows('specs_information', get_the_ID())): the_row(); ?>
                                <div>
                                    <dt>MC NUMBER</dt>
                                    <dd><?php echo get_sub_field('mc_number') ? get_sub_field('mc_number') : '-'; ?></dd>
                                </div>
                                <div>
                                    <dt>Broker ID</dt>
                                    <dd><?php echo get_sub_field('broker_id') ? get_sub_field('broker_id') : '-'; ?></dd>
                                </div>
                                <div>
                                    <dt>Scan Fee</dt>
                                    <dd><?php echo get_sub_field('scan_fee') ? get_sub_field('scan_fee') : '-'; ?></dd>
                                </div>
                                <div>
                                    <dt>Mobile Enabled</dt>
                                    <dd><?php echo get_sub_field('mobile_enabled') ? get_sub_field('mobile_enabled') : '-'; ?></dd>
                                </div>
                                <?php endwhile; ?>
                            </dl>
                        </div>
                    </div>
                </div>
                <?php wp_reset_postdata(); endwhile; ?>
            </div>
            <div class="brokers-list__list">
                <?php while($brokers_list_posts->have_posts()): $brokers_list_posts->the_post(); setup_postdata($brokers_list_posts); ?>
                <?php
                    $state_name = '';

                    foreach( get_the_terms(get_the_ID(), 'brokers_list_category') as $state ) {
                        $state_name = $state->slug;
                    }
                ?>
                <div class="brokers-list__item <?php echo $state_name; ?>">
                    <article class="brokers-list__card js-broker-list-button" data-modal-target="#js-broker-list-modal-<?php echo get_the_ID(); ?>">
                        <div class="brokers-list__logo">
                            <?php 
                                if($logo_image = get_field('logo', get_the_ID())) {
                                    echo fx_get_image_tag($logo_image);
                                } else {
                                    echo fx_get_image_tag(get_field('brokers_list_placeholder_image', 'option'));
                                }
                            ?>
                        </div>
                        <div class="brokers-list__content">
                            <?php foreach( get_the_terms(get_the_ID(), 'brokers_list_category') as $state ): ?>
                            <span>
                                <i class="icon-location"></i>
                                <span><?php echo $state->name; ?></span>
                            </span>
                            <?php endforeach; ?>
                            <h3><?php echo get_the_title(); ?></h3>
                        </div>
                        <div class="brokers-list__arrow">
                            <span>Learn More</span>
                            <i class="icon-button-right"></i>
                        </div>
                    </article>
                </div>
                <?php wp_reset_postdata(); endwhile; ?>
            </div>
            <div class="brokers-list__pagination">
                <div class="brokers-list__pagination__text">
                    <p>Showing <span class="showing-result"><?php echo $brokers_list_posts_count >= 9 ? '9' : $brokers_list_posts_count; ?></span> of <span class="total-result"><?php echo $brokers_list_posts_count; ?></span> Results</p>
                </div>
                <div class="brokers-list__pagination__wrapper">
                    <div class="brokers-list__pagination__bar"></div>
                </div>
                <div class="brokers-list__pagination__button">
                    <a id="load-more" class="btn btn-primary">Load More</a>
                </div>
            </div>
        </div>
    </div>
</section>