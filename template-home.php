<?php 
/*
	Template Name: Home
*/

get_header(); ?>
			<div class="content-area">
				<main>
					<section class="slider">
						<div class="flexslider">
						  <ul class="slides">
						    <?php
						    	$qtdSlider = 3;
						    	//Guardando ID e demais info de cada slider e guardando em arrays
						    	for ($i=1; $i<=$qtdSlider; $i++) {
						    		$slider_page[$i]     = get_theme_mod( 'set_slider_page'        . $i );
						    		$slider_btn_text[$i] = get_theme_mod( 'set_slider_button_text' . $i );
						    		$slider_btn_url[$i]  = get_theme_mod( 'set_slider_button_url'  . $i );
						    	}

						    	$args = array(
						    		'post_type'     => 'page',
						    		'posts_per_page' => $qtdSlider,
						    		'post__in'		=> $slider_page,
						    		'orderby'		=> 'post__in'
						    	);
						    	
						    	$slider_loop = new WP_Query( $args );
						    	$j           = 1;

						    	if($slider_loop->have_posts()):
						    		while ($slider_loop->have_posts()):
						    			$slider_loop->the_post();

						    ?>
							<li>
						      <?php the_post_thumbnail( 'fancy-lab-slider', array( 'class' => 'img-fluid' ) ); ?>
						      <div class="container">
						      	<div class="slider-details-container">
						      		<div class="slider-title">
						      			<h1><?php the_title(); ?></h1>
						      		</div>
						      		<div class="slider-description">
						      			<div class="subtitle"><?php the_content(); ?></div>
						      			<a href="<?php echo $slider_btn_url[$j]; ?>" class="link"><?php echo $slider_btn_text[$j]; ?></a>
						      		</div>
						      	</div>
						      </div>
						    </li>
						    <?php
						    		$j++;
						    		endwhile;
						    		wp_reset_postdata();
					    		endif;
						    ?>
						  </ul>
						</div>
					</section>
					
					<?php if(class_exists('WooCommerce')): ?>
						<section class="popular-products">
							<?php 
								$limite_pop      = get_theme_mod( 'set_popular_max_num', 4 );
								$limite_col      = get_theme_mod( 'set_popular_max_col', 4 );
								$limite_lanc     = get_theme_mod( 'set_lanc_max_num', 4 );
								$limite_lanc_col = get_theme_mod( 'set_lanc_max_col', 4 );
							?>
							<div class="container">
								<h2>Produtos Populares</h2>
								<?php echo do_shortcode( '[products limit="' . $limite_pop .'" columns="' . $limite_col .'" orderby="popularity"]' ); ?>
							</div>
						</section>
						<section class="new-arrivals">
							<div class="container">
								<h2>Lançamentos</h2>
								<?php echo do_shortcode( '[products limit="' . $limite_lanc .'" columns="' . $limite_lanc_col .'" orderby="date"]' ); ?>
							</div>
						</section>

						<?php 
							$showdeal = get_theme_mod( 'set_deal_show', 0 ); //0 é o valor padrão
							$deal     = get_theme_mod( 'set_deal' );
							$currency = get_woocommerce_currency_symbol();
							$regular  = get_post_meta( $deal, '_regular_price', true );
							$sale     = get_post_meta( $deal, '_sale_price', true );

							if( $showdeal && (!empty($deal)) ):
								$discount_percentage = absint(100 - $sale/$regular*100);
						?>
						<section class="deal-of-the-week">
							<div class="container">
								<h2>Promoção da Semana</h2>
								<div class="row d-flex align-items-center">
									<div class="deal-img col-md-6 ml-auto col-12 text-center">
										<?php echo get_the_post_thumbnail( $deal, 'large', array( 'class' => 'img-fluid' )); ?>
									</div>
									<div class="deal-desc col-md-4 mr-auto col-12 text-center">
										<?php if( !empty($sale) ): ?>
										<span class="discount">
											<?php echo $discount_percentage . '% OFF'; ?>
										</span>
										<?php endif; ?>
										<h3>
											<a href="<?php echo get_permalink( $deal ); ?>"><?php echo get_the_title( $deal ); ?></a>
										</h3>
										<p><?php echo get_the_excerpt( $deal ); ?></p>
										<div class="prices">
											<span class="regular">
												<?php echo $currency . $regular; ?>
											</span>
											<?php if( !empty($sale) ): ?>
												<span class="sale">
													<?php echo $currency . $sale; ?>
												</span>
										<?php endif; ?>
										</div>
									</div>
									<a href="<?php echo esc_url( '?add-to-cart=' . $deal ); ?>" class="add-to-cart">Adicionar ao carrinho</a>
								</div>
							</div>
						</section>
						<?php endif; ?>
					<?php endif; ?>

					<section class="lab-blog">
						<div class="container">
							<div class="row">
								<?php 
									if( have_posts() ) :
										while ( have_posts() ) : the_post();
										?>
											<article>
												<h2><?php the_title(); ?></h2>
												<div><?php the_content(); ?></div>
											</article>
										<?php
										endwhile;
									else:
										?>
										<p>Nada para mostrar.</p>
									<?php 
									endif;
								?>
							</div>
						</div>
					</section>
				</main>
			</div>

<?php get_footer(); ?>