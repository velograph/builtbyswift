<?php
/**
 * Template Name: Front Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Swift Industries
 */

get_header(); ?>

<script>
	jQuery(document).ready(function(){

		jQuery('.home-page-slider').slick({
			arrows: false,
			dots: false,
			// autoplay: true,
			// autoplaySpeed: 3000,
			// pauseOnHover: true,
			centered: true,
			mobileFirst: true,
		    lazyLoad: 'ondemand',
		});

		jQuery('.product-slider').slick({
			arrows: true,
			dots: false,
			slidesToShow: 4,
			centered: true,
			mobileFirst: true,
		    lazyLoad: 'ondemand',
		});

		function updateImageSize() {
			jQuery(".home-page-slider-container").each(function(){
				var ratio_cont = jQuery(this).width()/jQuery(this).height();
				var $img = jQuery(this).find("img");
				var ratio_img = $img.width()/$img.height();
				if (ratio_cont > ratio_img) {
					$img.css({"width": "100%", "height": "auto"});
				}
				else if (ratio_cont < ratio_img) {
					$img.css({"width": "auto", "height": "100%"});
				}
			});
		};

		if (jQuery(window).width() > 375) {

			var windowHeight = jQuery(window).height();
			var windowWidth = jQuery(window).width();

			jQuery( '.home-page-slider-container' ).css('height', windowHeight);
			jQuery(window).resize(function(){
				jQuery(".home-page-slider-container").width(jQuery(window).width());
			});
			// jQuery(".home-page-slider-container .slide").css('width', windowWidth);

		}

	});

</script>

<section class="front-page">

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- Begin Gallery -->

		<section class="home-page-slider-container">

			<section class="home-page-slider">

				<!-- Repeater -->
				<?php if( have_rows('gallery_images') ) : ?>

				    <?php while ( have_rows('gallery_images') ) : ?>

				        <?php the_row(); ?>

						<div class="slide">

							<?php $mobile_page_banner = wp_get_attachment_image_src(get_sub_field('slider_image'), 'portal-mobile'); ?>
							<?php $tablet_page_banner = wp_get_attachment_image_src(get_sub_field('slider_image'), 'portal-tablet'); ?>
							<?php $desktop_page_banner = wp_get_attachment_image_src(get_sub_field('slider_image'), 'portal-desktop'); ?>
							<?php $retina_page_banner = wp_get_attachment_image_src(get_sub_field('slider_image'), 'portal-retina'); ?>

							<picture class="picture">
								<!--[if IE 9]><video style="display: none"><![endif]-->
								<source
									srcset="<?php echo $mobile_page_banner[0]; ?>"
									media="(max-width: 500px)" />
								<source
									srcset="<?php echo $tablet_page_banner[0]; ?>"
									media="(max-width: 860px)" />
								<source
									srcset="<?php echo $desktop_page_banner[0]; ?>"
									media="(max-width: 1180px)" />
								<source
									srcset="<?php echo $retina_page_banner[0]; ?>"
									media="(min-width: 1181px)" />
								<!--[if IE 9]></video><![endif]-->
								<img srcset="<?php echo $image[0]; ?>">
							</picture>

							<div class="slide-caption <?php if( get_sub_field( 'caption_position' ) == 'Top of image') : ?>top-caption <?php else: ?>bottom-caption <?php endif; ?>">
								<a href="<?php echo the_sub_field('page_link'); ?>">
									<?php the_sub_field('caption'); ?>
								</a>
							</div>

						</div>

				    <?php endwhile; ?>

				<?php endif; ?>

			</section>

		</section>

<!-- End Gallery -->

		<section class="page-content">

			<div class="product-portal-row">
				<?php

				    $args = array(
				        'post_type' => 'product',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => 'hinterland',
							),
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => array(
									'bundled-simple',
									'bundled-variable',
									'add-on'
								),
								'operator' => 'NOT IN'
							)
						)
				    );
				    $query = new WP_Query($args);

				    if($query->have_posts()) : ?>

					<h2 class="product-row-descriptor"><?php the_field('collection_title', 886); ?></h2>
					<h1 class="collection-title"><a href="/product-category/hinterland/">Hinterland</a></h1>

					<section class="product-slider">

					      <?php while($query->have_posts()) : ?>

					        <?php $query->the_post(); ?>

							<div class="slide">

								<div class="product-portal">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('thumbnail'); ?>
										<h3><?php the_title(); ?></h3>
									</a>
								</div>

							</div>

						  <?php endwhile; ?>

					  </section>

				<?php endif; ?>

			</div>

			<div class="product-portal-row">
				<?php

					$args = array(
						'post_type' => 'product',
						'tax_query' => array(
							// array(
							// 	'taxonomy' => 'product_cat',
							// 	'field' => 'slug',
							// 	'terms' => 'hinterland',
							// ),
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => array(
									'bundled-simple',
									'bundled-variable',
									'add-on'
								),
								'operator' => 'NOT IN'
							)
						)
					);
					$query = new WP_Query($args);

					if($query->have_posts()) : ?>

					<h2 class="product-row-descriptor"><?php the_field('design_title', 886); ?></h2>

					<section class="product-slider">

						  <?php while($query->have_posts()) : ?>

							<?php $query->the_post(); ?>

							<div class="slide">

								<div class="product-portal">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('thumbnail'); ?>
										<h3><?php the_title(); ?></h3>
									</a>
								</div>

							</div>

						  <?php endwhile; ?>

					  </section>

				<?php endif; ?>

			</div>

			<div class="product-portal-row">
				<?php

					$args = array(
						'post_type' => 'product',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => 'general-store',
							),
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => array(
									'bundled-simple',
									'bundled-variable',
									'add-on'
								),
								'operator' => 'NOT IN'
							)
						)
					);
					$query = new WP_Query($args);

					if($query->have_posts()) : ?>

					<h2 class="product-row-descriptor"><?php the_field('adventure_title', 886); ?></h2>

					<section class="product-slider">

						  <?php while($query->have_posts()) : ?>

							<?php $query->the_post(); ?>

							<div class="slide">

								<div class="product-portal">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('thumbnail'); ?>
										<h3><?php the_title(); ?></h3>
									</a>
								</div>

							</div>

						  <?php endwhile; ?>

					  </section>

				<?php endif; ?>

			</div>

			<div class="content-portal-row">
				<div class="retail-portal portal">
					<?php $mobile_page_banner = wp_get_attachment_image_src(get_field('retail_portal_image', 886), 'portal-mobile'); ?>
					<?php $tablet_page_banner = wp_get_attachment_image_src(get_field('retail_portal_image', 886), 'portal-tablet'); ?>

					<a href="<?php the_field('retail_link'); ?>">
						<picture class="picture">
							<!--[if IE 9]><video style="display: none"><![endif]-->
							<source
								srcset="<?php echo $mobile_page_banner[0]; ?>"
								media="(max-width: 500px)" />
							<source
								srcset="<?php echo $tablet_page_banner[0]; ?>"
								media="(min-width: 860px)" />
							<!--[if IE 9]></video><![endif]-->
							<img srcset="<?php echo $image[0]; ?>">
						</picture>
						<div class="portal-content">
							<h4><?php the_field('retail_portal_content', 886); ?></h4>
						</div>
					</a>
				</div>

				<div class="blog-portal portal">
					<?php $mobile_page_banner = wp_get_attachment_image_src(get_field('blog_portal_image', 886), 'portal-mobile'); ?>
					<?php $tablet_page_banner = wp_get_attachment_image_src(get_field('blog_portal_image', 886), 'portal-tablet'); ?>

					<a href="<?php the_field('blog_link'); ?>">
						<picture class="picture">
							<!--[if IE 9]><video style="display: none"><![endif]-->
							<source
								srcset="<?php echo $mobile_page_banner[0]; ?>"
								media="(max-width: 500px)" />
							<source
								srcset="<?php echo $tablet_page_banner[0]; ?>"
								media="(min-width: 860px)" />
							<!--[if IE 9]></video><![endif]-->
							<img srcset="<?php echo $image[0]; ?>">
						</picture>
						<div class="portal-content">
							<h4><?php the_field('blog_portal_content', 886); ?></h4>
						</div>
					</a>
				</div>
			</div>

			<div class="content-portal-row story-portal">
				<div class="story-portal portal">
					<?php $mobile_page_banner = wp_get_attachment_image_src(get_field('story_portal_image', 886), 'story-portal-mobile'); ?>
					<?php $tablet_page_banner = wp_get_attachment_image_src(get_field('story_portal_image', 886), 'story-portal-tablet'); ?>
					<?php $desktop_page_banner = wp_get_attachment_image_src(get_field('story_portal_image', 886), 'story-portal-desktop'); ?>

					<a href="<?php the_field('story_link'); ?>">
						<picture class="picture">
							<!--[if IE 9]><video style="display: none"><![endif]-->
							<source
								srcset="<?php echo $mobile_page_banner[0]; ?>"
								media="(max-width: 500px)" />
							<source
								srcset="<?php echo $tablet_page_banner[0]; ?>"
								media="(max-width: 860px)" />
							<source
								srcset="<?php echo $desktop_page_banner[0]; ?>"
								media="(min-width: 1180px)" />
							<!--[if IE 9]></video><![endif]-->
							<img srcset="<?php echo $image[0]; ?>">
						</picture>
						<div class="portal-content">
							<h4><?php the_field('story_portal_content', 886); ?></h4>
						</div>
					</a>
				</div>
			</div>

		</section>

	<?php endwhile; // end of the loop. ?>

</section>

<?php get_footer(); ?>
