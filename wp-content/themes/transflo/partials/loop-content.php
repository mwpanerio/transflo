<?php
	$thumb_id = get_post_thumbnail_id();

	// if no thumb ID, check for placeholder image (from ACF options page)
	if( empty( $thumb_id ) ) {
		$thumb_id = get_field( 'placeholder_image', 'option' );
	}

	$img_tag 	= fx_get_image_tag( $thumb_id, 'blog-post__img', 'medium' );
	$permalink 	= get_permalink();
	$terms 		= wp_get_object_terms( get_the_ID(), 'category' );
	$excerpt 	= wp_trim_words( get_the_excerpt(), 20, ' &hellip;' );
?>

<div class="col-sm-6 col-lg-4 card-item">
	<a class="card card--link" href="<?php echo get_the_permalink(); ?>">
		<div class="card__top">
			<div class="card__img-wrap">
				<?php if($featured_image = get_field('featured_image')): ?>
					<?php echo fx_get_image_tag($featured_image, 'card__img object-fit'); ?>
				<?php else: ?>
					<?php echo fx_get_image_tag(get_field('placeholder_image', 'option'), 'card__img object-fit'); ?>
				<?php endif; ?>
			</div>
			<div class="card__details">
				<div class="card__icon"> <span>Read More</span><i class="icon-button-right"></i></div>
				<div class="card__date"><?php echo get_the_date('F j, Y'); ?></div>
				<h4 class="card__title"><?php echo get_the_title(); ?></h4>
			</div>
		</div>
		<div class="card__bottom">
			<?php
				$blocks = parse_blocks( $post->post_content );

				foreach ( $blocks as $block ) {
				if ( 'acf/wysiwyg' === $block['blockName'] ) {
						if(isset($block["attrs"]["data"]["content"])) {
							$excerpt = strip_tags(trim($block["attrs"]["data"]["content"]));
						}
						break;
					}
				}

				echo $excerpt;
			?>
		</div>
	</a>
</div>