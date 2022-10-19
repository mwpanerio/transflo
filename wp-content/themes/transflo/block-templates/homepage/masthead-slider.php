<?php if( have_rows( 'slides' ) ): ?>
	<section class="masthead masthead--homepage js-masthead-homepage-slider">

		<?php $skip_lazy = true; // skip lazy loading for first image to improve paint times
        while( have_rows( 'slides' ) ): the_row(); ?>
			<article class="masthead-slide">
				<?php echo fx_get_image_tag( get_sub_field( 'background_image' ), 'masthead-slide__img', 'masthead', $skip_lazy ); ?>
				
                    <div class="masthead-slide__content">
                        <h2 class="masthead-slide__title">
                            <?php the_sub_field( 'headline' ); ?>
                        </h2>

                        <?php if( $button = get_sub_field( 'button' )  ): ?>
                            <a
                                class="masthead-slide__btn btn"
                                href="<?php echo esc_url( $button['url'] ); ?>"
                            >
                                <?php echo $button['title']; ?>
                            </a>
                        <?php endif; ?>

                    </div>
						
			</article>
		<?php $skip_lazy = false;
        endwhile; ?>

	</section>
<?php endif; ?>
