<?php
/**
 * Fancy Labs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fancy Labs
 */

function fancy_lab_scripts() {
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', array( 'jquery' ), '5.0.0', 'true' );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '5.0.0', 'all' );
	//Theme's mais stylesheet
	wp_enqueue_style( 'fancy-lab-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ), 'all' );
}

add_action( 'wp_enqueue_scripts', 'fancy_lab_scripts' );

function fancy_lab_config() {
	register_nav_menus (
		array(
			'fancy_lab_main_menu'	=> 'Fancy Lab Menu',
			'fancy_lab_footer_menu' => 'Fancy Lab Footer Menu'
		)
	);
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 255,
		'single_image_width'	=> 255,
		'product_grid'			=> array(
			'default_rows'		=> 10,
			'min_rows'			=> 5,
			'max_rows'			=> 10,
			'default_columns'	=> 1,
			'min_columns'		=> 1,
			'max_columns'		=> 1
		)
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	if ( ! isset( $content_width ) ) {
		$content_width = 600;
	}
}
add_action( 'after_setup_theme', 'fancy_lab_config', 0 ); // 0: prioridade de execução > após after_setup_theme

//action hooks para inserir HTML nos templates sem alterar os arquivos padrão do Woocommerce
add_action( 'woocommerce_before_main_content', 'fancy_lab_open_container_row', 5 );
function fancy_lab_open_container_row() {
	echo '<div class="container shop-content"><div class="row">';
}

//Fechando DIVs abertas no gancho fancy_lab_open_container_row, com isso tem conteúdo fora do container
add_action( 'woocommerce_after_main_content', 'fancy_lab_close_container_row', 5 );
function fancy_lab_close_container_row() {
	echo '</div></div>';
}

//Removendo gancho sidebar do padrão e adicioná-lo dentro do container de fancy_lab_open_container_row
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

//Adicionando container da sidebar
add_action( 'woocommerce_before_main_content', 'fancy_lab_add_sidebar_tags', 6 );
function fancy_lab_add_sidebar_tags() {
	echo '<div class="sidebar-shop col-md-6">';
	//echo '<div class="sidebar-shop col-lg-3 col-md-4 order-2 order-md-1">';
}

//Adicionando sidebar dentro do container
add_action( 'woocommerce_before_main_content', 'woocommerce_get_sidebar', 7 );

//Fechando container da sidebar
add_action( 'woocommerce_before_main_content', 'fancy_lab_close_sidebar_tags', 8 );
function fancy_lab_close_sidebar_tags() {
	echo '</div>';
}

//Adicionando container shop
add_action( 'woocommerce_before_main_content', 'fancy_lab_add_shop_tags', 9 );
function fancy_lab_add_shop_tags() {
	echo '<div class="col-md-6">';
	//echo '<div class="col-lg-9 col-md-8 order-1 order-md-2">';
}

//Fechando container shop
add_action( 'woocommerce_after_main_content', 'fancy_lab_close_shop_tags', 4 );
function fancy_lab_close_shop_tags() {
	echo '</div">';
}