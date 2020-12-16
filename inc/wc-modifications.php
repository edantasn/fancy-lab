<?php
/**
 * Fancy Labs functions and definitions
 *
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/#section-3
 *
 * @package Fancy Lab
 */

function fancy_lab_wc_modify() {
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


	if(is_shop()) {

		//************************** SIDEBAR **************************//
		
		//Adicionando container da sidebar
		add_action( 'woocommerce_before_main_content', 'fancy_lab_add_sidebar_tags', 6 );
		function fancy_lab_add_sidebar_tags() {
			echo '<div class="sidebar-shop col-lg-3 col-md-4 order-2 order-md-1">';
		}

		//Adicionando sidebar dentro do container
		add_action( 'woocommerce_before_main_content', 'woocommerce_get_sidebar', 7 );

		//Fechando container da sidebar
		add_action( 'woocommerce_before_main_content', 'fancy_lab_close_sidebar_tags', 8 );
		function fancy_lab_close_sidebar_tags() {
			echo '</div>';
		}

		//************************** INFO DO POST **************************//
		add_action( 'woocommerce_after_shop_loop_item_title', 'the_excerpt', 1 );
	}

	//Removendo gancho sidebar do padrão e adicioná-lo dentro do container de fancy_lab_open_container_row
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

	//Adicionando container shop
	add_action( 'woocommerce_before_main_content', 'fancy_lab_add_shop_tags', 9 );
	function fancy_lab_add_shop_tags() {
		if( is_shop() ) {
			echo '<div class="col-lg-9 col-md-8 order-1 order-md-2">';
		} else {
			echo '<div class="col">';
		}
	}

	//Fechando container shop
	add_action( 'woocommerce_after_main_content', 'fancy_lab_close_shop_tags', 4 );
	function fancy_lab_close_shop_tags() {
		echo '</div">';
	}

	// FILTERS

	//Modificando o estado do título para FALSE, escondendo
	/*add_filter ( 'woocommerce_show_page_title', 'fancy_lab_remove_shop_title' );
	function fancy_lab_remove_shop_title($val) {
		$val = false;
		return $val;
	}*/

}

add_action( 'wp', 'fancy_lab_wc_modify' );