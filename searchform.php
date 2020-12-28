<?php
/**
 * Template for displaying search forms in Fancy Lab
 * @package Fancy Lab
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentyseventeen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentyseventeen' ); ?></span></button>

	<?php if( class_exists( 'WooCommerce' ) ): ?>
		<input type="hidden" name="post_type" id="post_type" value="product">
	<?php endif; ?>
</form>
