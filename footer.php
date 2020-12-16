<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fancy Lab
 */

?>
			<footer>
				<section class="footer-widgets">
					<div class="container">
						<div class="row">Widgets do rodapé</div>
					</div>
				</section>
				<section class="copyright">
					<div class="container">
						<div class="row">
							<div class="copyright-text col-12 col-md-6">Copyright</div>
							<div class="footer-menu col-12 col-md-6 text-left text-md-right">
								<?php 
									wp_nav_menu(
										array(
											'theme_location' => 'fancy_lab_footer_menu'
										)
									);
								?>
							</div>
						</div>
					</div>
				</section>
			</footer>

		</div> <!-- .site -->

		<?php wp_footer(); ?>
	</body>
</html>