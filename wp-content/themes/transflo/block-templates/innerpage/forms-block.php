<section class="forms-block section-padding">
    <div class="container">
        <div class="row forms-block__row">
            <div class="forms-block__row__item col-xxs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="form-blocks__inner">
                    <div class="forms-block__locations">
                        <?php echo fx_get_image_tag(get_field('location_image')); ?>
                    </div>
                    <p class="form-block__text-with-icon">
                        <i class="icon-location"></i> 
                        Address: <br>
                        <?php echo get_field('location_address'); ?> <br>
                        <a href="https://maps.google.com/maps?q=<?php echo strip_tags(get_field('location_address'))?>">Get Directions</a>
                    </p>
                    <p class="form-block__text-with-icon">
                        <i class="icon-email"></i>
                        For media inquiries, contact: <br>
                        <a href="mailto:<?php echo get_field('location_email_address'); ?>"><?php echo get_field('location_email_address'); ?></a>
                    </p>
                </div>
            </div>
            <div class="forms-block__row__item col-xxs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="form-blocks__inner">
                    <h4 class="h4"><?php echo get_field('support_title'); ?></h4>
                    <?php echo get_field('support_description'); ?>
                    <p class="form-block__text-with-icon">
                        <i class="icon-phone">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <path id="Icon_awesome-phone-alt" data-name="Icon awesome-phone-alt" d="M15.544,11.307l-3.5-1.5a.75.75,0,0,0-.875.216l-1.55,1.894A11.583,11.583,0,0,1,4.081,6.379l1.894-1.55a.748.748,0,0,0,.216-.875l-1.5-3.5A.755.755,0,0,0,3.831.019L.581.769A.75.75,0,0,0,0,1.5,14.5,14.5,0,0,0,14.5,16a.75.75,0,0,0,.731-.581l.75-3.25a.759.759,0,0,0-.438-.863Z" transform="translate(0 0)" fill="#8d99ae"/>
                        </svg>
                        </i> 
                        Call: <br>
                        <a href="tel:<?php echo strip_tags(get_field('support_phone_number'))?>"><?php echo get_field('support_phone_number'); ?></a>
                    </p>
                    <p class="form-block__text-with-icon">
                        <i class="icon-email"></i>
                        Email: <br>
                        <a href="mailto:<?php echo get_field('support_email_address'); ?>"><?php echo get_field('support_email_address'); ?></a>
                    </p>
                    <?php while(have_rows('support_button_list')): the_row(); ?>
                        <p>
                            <a class="btn <?php echo get_sub_field('button_type'); ?>" href="<?php echo get_sub_field('button')['url']; ?>"<?php echo get_sub_field('button')['target'] ? ' target="' . get_sub_field('button')['target'] . '"': ''; ?>>
                                <?php echo get_sub_field('button')['title']; ?>
                            </a>
                        </p>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="forms-block__row__item col-xxs-12 col-md-12 col-lg-6">
                <div class="form-blocks__inner">
                    <h4 class="h4"><?php echo get_field('demo_title'); ?></h4>
                    <p><?php echo get_field('demo_description'); ?></p>
                    <div class="form-block__demo">
                        <?php $form_count = 0; while(have_rows('demo_list')): the_row(); ?>
                        <div class="form-block__demo__item">
                            <a href="#js-form-demo-<?php echo $form_count; ?>" class="form-block__demo__card js-form-demo">
                                <div class="form-block__demo__image">
                                    <?php echo fx_get_image_tag(get_sub_field('image')); ?>
                                </div>
                                <div class="form-block__demo__title">
                                    <p>
                                        <?php echo get_sub_field('title')?>
                                        <i class="icon-button-right"></i>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <?php $form_count++; endwhile; ?>
                    </div>
                    <p><?php echo get_field('demo_note'); ?></p>
                </div>
            </div>
        </div>
        <?php ?>
        <div class="form-block__cta bg-gray">
            <i class="icon-logomark"></i>
            <?php while(have_rows('contact_cta')): the_row(); ?>
                <div class="form-block__cta__title">
                    <h3><?php echo get_sub_field('text'); ?></h3>
                </div>
                <?php if($button = get_sub_field('button')): ?>
                    <a class="btn btn-primary" href="<?php echo $button['url']; ?>"<?php echo $button['target'] ? ' target="' . $button['target'] . '"': ''; ?>>
                        <?php echo $button['title']; ?>
                    </a>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </div>

    <?php $form_modal_count = 0; while(have_rows('demo_list')): the_row(); ?>
    <div class="form-block__demo__modal" id="js-form-demo-<?php echo $form_modal_count; ?>">
        <div class="form-block__demo__modal__container">
            <div class="form-block__demo__modal__inner">
                <div class="form-block__demo__modal__close">
                    <span></span>
                </div>
                <h3 class="form-block__demo__modal__title"><?php echo get_sub_field('title')?></h3>
                <?php echo apply_shortcodes(get_sub_field('form_shortcode')); ?>
            </div>
        </div>
    </div>
    <?php $form_modal_count++; endwhile; ?>
</section>