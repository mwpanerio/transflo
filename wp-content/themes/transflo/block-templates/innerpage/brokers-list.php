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
?>
<section class="brokers-list section-padding hard-top">
    <div class="container">
        <div class="brokers-list__upper">
            <div class="brokers-list__upper__title">
                <h2 class="h1">Search for a Broker</h2>
            </div>
            <div class="brokers-list__upper__form">
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
                            <option value="0">Select One</option>
                            <?php foreach($broker_states as $broker_state): ?>
                            <option value="<?php echo esc_attr( $broker_state->term_id ); ?>"><?php echo esc_attr( $broker_state->name ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="brokers-list__upper__form__item">
                    <button class="btn btn-primary">Go</button>
                </div>
            </div>
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
                                <span class="brokers-list__modal__location">
                                    <i class="icon-location"></i>
                                    <span>NEW YORK</span>
                                </span>
                                <h2 class="brokers-list__modal__title"><?php echo get_the_title(); ?></h2>
                            </div>
                        </div>
                        <div class="brokers-list__modal__left">
                            <div class="brokers-list__modal__image">
                                <img src="/wp-content/uploads/2022/11/download-10.png" alt="">
                            </div>
                            <a href="#" class="btn btn-tertiary">Visit Site</a>
                        </div>
                        <div class="brokers-list__modal__right">
                            <div class="brokers-list__modal__description">
                                <p>A&Z Trucking provides hands-on, timely, customer-focused transportation services to customers located throughout the United States, Canada, and Europe.</p>
                            </div>
                            <dl class="brokers-list__modal__info">
                                <div>
                                    <dt>State</dt>
                                    <dd>New York</dd>
                                </div>
                                <div>
                                    <dt>MC NUMBER</dt>
                                    <dd>510449</dd>
                                </div>
                                <div>
                                    <dt>Broker ID</dt>
                                    <dd>AZTDV</dd>
                                </div>
                                <div>
                                    <dt>Scan Fee</dt>
                                    <dd>Free</dd>
                                </div>
                                <div>
                                    <dt>Mobile Enabled</dt>
                                    <dd>NO</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
                <?php wp_reset_postdata(); endwhile; ?>
            </div>
            <div class="brokers-list__list">
                <?php while($brokers_list_posts->have_posts()): $brokers_list_posts->the_post(); setup_postdata($brokers_list_posts); ?>
                <div class="brokers-list__item">
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
                            <i class="icon-button-right"></i>
                        </div>
                    </article>
                </div>
                <?php wp_reset_postdata(); endwhile; ?>
            </div>
        </div>
    </div>
</section>