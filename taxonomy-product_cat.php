<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Swift Industries
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php

		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); // get current term
		$parent = get_term($term->parent, get_query_var('taxonomy') ); // get parent term
		$children = get_term_children($term->term_id, get_query_var('taxonomy')); // get children
		if(($parent->term_id!="" && sizeof($children)>0)) : ?>

			<!-- echo 'has parent and child'; -->

		<?php elseif(($parent->term_id!="") && (sizeof($children)==0)) : ?>

			<!-- echo 'has parent, no child'; -->

			<?php $term_slug = $term->slug; ?>
			<div class="taxonomy-banner-image">

				<?php $mobile = wp_get_attachment_image_src( get_field( $term_slug, 3223 ), 'product-banner-mobile' ); ?>
				<?php $tablet = wp_get_attachment_image_src( get_field( $term_slug, 3223 ), 'product-banner-tablet' ); ?>
				<?php $desktop = wp_get_attachment_image_src( get_field( $term_slug, 3223 ), 'product-banner-desktop' ); ?>
				<?php $retina = wp_get_attachment_image_src( get_field( $term_slug, 3223 ), 'product-banner-retina' ); ?>

				<picture class="document-header-image">
					<!--[if IE 9]><video style="display: none;"><![endif]-->
					<source
						srcset="<?php echo $mobile[0]; ?>"
						media="(max-width: 500px)" />
					<source
						srcset="<?php echo $tablet[0]; ?>"
						media="(max-width: 860px)" />
					<source
						srcset="<?php echo $desktop[0]; ?>"
						media="(max-width: 1180px)" />
					<source
						srcset="<?php echo $retina[0]; ?>"
						media="(min-width: 1181px)" />
					<!--[if IE 9]></video><![endif]-->
					<img srcset="<?php echo $image[0]; ?>">
				</picture>

			</div>

			<?php get_template_part('partials/breadcrumbs'); ?>

			<?php do_action( 'woocommerce_before_single_product' ); ?>

			<div class="product-taxonomies">

				<h2 class="taxonomy-title"><?php echo $term->name; ?></h2>

				<?php if( term_exists( 'readymade', 'product_cat') ) : ?>

					<div class="readymade-products">

						<?php

						    $args = array(
						        'post_type' => 'product',
								'posts_per_page' => -1,
								'tax_query' => array(
									array(
										'taxonomy' => 'product_cat',
										'field' => 'slug',
										'terms' => array(
											$term->slug,
											'readymade',
										),
										'operator' => 'AND'
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

							<div class="readymade-description description">
								<h3>ReadyMade Bags</h3>
								<?php the_field('readymade_description', 3223); ?>
							</div>

						    <?php while($query->have_posts()) : ?>

						        <?php $query->the_post(); ?>

								<div class="product-portal">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('portal-mobile'); ?>
										<h3><?php the_title(); ?></h3>
									</a>
								</div>

						    <?php endwhile; ?>

						<?php endif; ?>

					</div>

				<?php endif; ?>

				<?php if( term_exists( 'custom', 'product_cat') ) : ?>

					<div class="custom-products <?php echo $term_slug; ?>">
						<?php

					    $args = array(
					        'post_type' => 'product',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									'terms' => array(
										$term->slug,
										'custom',
									),
									'operator' => 'AND'
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

							<div class="custom-description description">
								<h3>Custom Bags</h3>
								<?php the_field('custom_description', 3223); ?>
							</div>

						    <?php while($query->have_posts()) : ?>

						        <?php $query->the_post(); ?>

								<div class="product-portal">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('portal-mobile'); ?>
										<h3><?php the_title(); ?></h3>
									</a>
								</div>

						    <?php endwhile; ?>

						<?php endif; ?>

					</div>

				<?php endif; ?>

			</div>

		<?php elseif(($parent->term_id=="") && (sizeof($children)>0)) : ?>

			echo 'no parent, has child';

			<div class="taxonomy-banner-image">

				<?php $mobile = wp_get_attachment_image_src( get_field( 'adventure-store', 3223 ), 'product-banner-mobile' ); ?>
				<?php $tablet = wp_get_attachment_image_src( get_field( 'adventure-store', 3223 ), 'product-banner-tablet' ); ?>
				<?php $desktop = wp_get_attachment_image_src( get_field( 'adventure-store', 3223 ), 'product-banner-desktop' ); ?>
				<?php $retina = wp_get_attachment_image_src( get_field( 'adventure-store', 3223 ), 'product-banner-retina' ); ?>

				<picture class="document-header-image">
					<!--[if IE 9]><video style="display: none;"><![endif]-->
					<source
						srcset="<?php echo $mobile[0]; ?>"
						media="(max-width: 500px)" />
					<source
						srcset="<?php echo $tablet[0]; ?>"
						media="(max-width: 860px)" />
					<source
						srcset="<?php echo $desktop[0]; ?>"
						media="(max-width: 1180px)" />
					<source
						srcset="<?php echo $retina[0]; ?>"
						media="(min-width: 1181px)" />
					<!--[if IE 9]></video><![endif]-->
					<img srcset="<?php echo $image[0]; ?>">
				</picture>

			</div>

			<?php get_template_part('partials/breadcrumbs'); ?>

			<?php do_action( 'woocommerce_before_single_product' ); ?>

			<div class="product-taxonomies">

					<?php
		   	 			$prod_categories = get_terms( 'product_cat', array(
		   	 				'orderby' => 'name',
		   	 				'order' => 'ASC',
		   	 				'parent' => $term->term_id,
		   	 				'hide_empty' => 1
		   	 			)); ?>

		   	 			<?php foreach( $prod_categories as $prod_cat ) :
		   	 				$cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
		   	 				$cat_thumb_url = wp_get_attachment_thumb_url( $cat_thumb_id );
		   	 				$term_link = get_term_link( $prod_cat, 'product_cat' );
		   	 			?>

						<div class="taxonomy-product-portal-row">

							<h2><?php echo $prod_cat->name; ?></h2>
							<?php echo do_shortcode('[product_category category="' . $prod_cat->name . '"]'); ?>

						</div>

		   	 		<?php endforeach; wp_reset_query(); ?>

			</div>

		<?php endif; ?>

	</div><!-- #primary -->

<?php get_footer(); ?>
