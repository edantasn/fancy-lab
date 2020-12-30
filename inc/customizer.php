<?php 
/**
 * Fancy Lab Theme Customizer
 *
 * @package Fancy Lab
 */

function fancy_lab_customizer( $wp_customize ) {
	//Campo personalizado para o Copyright do rodapé
	$wp_customize->add_section(
		'sec_copyright', array(
			'title'       => 'Copyright Settings',
			'description' => 'Copyright Section'
		)
	);

	//Campo 1 - Texto
	$wp_customize->add_setting(
		'set_copyright', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	//Campo de ligação entre o controle e a setting
	$wp_customize->add_control(
		'set_copyright', array(
			'label'       => 'Copyright',
			'description' => 'Digite seu copyright',
			'section'     => 'sec_copyright',
			'type'		  => 'text'
		)
	);

	/********************************************/
	//Slider Section
	$wp_customize->add_section(
		'sec_slider', array(
			'title'       => 'Slider Settings',
			'description' => 'Slider Section'
		)
	);


	//laço para criar os campos customizados dos sliders (máximo 3 slides)
	for($slide=1; $slide<4; $slide++) {

		//Página do slider
		$wp_customize->add_setting(
			'set_slider_page'.$slide, array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'set_slider_page'.$slide, array(
				'label'       => 'Página do Slide ' . $slide,
				'description' => 'Selecione a página do slide ' . $slide,
				'section'     => 'sec_slider',
				'type'		  => 'dropdown-pages'
			)
		);

		//Texto do botão do slider
		$wp_customize->add_setting(
			'set_slider_button_text'.$slide, array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'set_slider_button_text'.$slide, array(
				'label'       => 'Texto do botão slide ' . $slide,
				'description' => 'Digite o texto do botão slide ' . $slide,
				'section'     => 'sec_slider',
				'type'		  => 'text'
			)
		);

		//URL Botão do slider
		$wp_customize->add_setting(
			'set_slider_button_url'.$slide, array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			'set_slider_button_url'.$slide, array(
				'label'       => 'Link do botão slide ' . $slide,
				'description' => 'Digite o link do botão do slide ' . $slide,
				'section'     => 'sec_slider',
				'type'		  => 'url'
			)
		);
	}

	/********************************************/
	// Tornando as opções de produtos da PÁGINA INICIAL customizáveis pelo usuário
	$wp_customize->add_section(
		'sec_home_page', array(
			'title'       => 'Produtos Página Inicial',
			'description' => 'Seção Página Inicial'
		)
	);

	$wp_customize->add_setting(
		'set_popular_max_num', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'set_popular_max_num', array(
			'label'       => 'Qtd Produtos Populares',
			'description' => 'Quantidade máxima de Produtos',
			'section'     => 'sec_home_page',
			'type'		  => 'number'
		)
	);

	//Colunas
	$wp_customize->add_setting(
		'set_popular_max_col', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'set_popular_max_col', array(
			'label'       => 'Produtos Populares - Colunas',
			'description' => 'Quantidade máxima de colunas',
			'section'     => 'sec_home_page',
			'type'		  => 'number'
		)
	);

	// Lançamentos
	$wp_customize->add_setting(
		'set_lanc_max_num', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'set_lanc_max_num', array(
			'label'       => 'Qtd Produtos Novos',
			'description' => 'Quantidade máxima de produtos',
			'section'     => 'sec_home_page',
			'type'		  => 'number'
		)
	);

	$wp_customize->add_setting(
		'set_lanc_max_col', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'set_lanc_max_col', array(
			'label'       => 'Produtos Novos - Colunas',
			'description' => 'Quantidade máxima de colunas',
			'section'     => 'sec_home_page',
			'type'		  => 'number'
		)
	);


	
	//Visibilidade Produto em Destaque
	$wp_customize->add_setting(
		'set_deal_show', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'fancy_lab_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'set_deal_show', array(
			'label'       => 'Mostra Produto em Destaque?',
			'section'     => 'sec_home_page',
			'type'		  => 'checkbox'
		)
	);

	//Produto em Destaque
	$wp_customize->add_setting(
		'set_deal', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'set_deal', array(
			'label'       => 'Produto em Destaque',
			'description' => 'Informe o ID',
			'section'     => 'sec_home_page',
			'type'		  => 'number'
		)
	);
}

add_action( 'customize_register', 'fancy_lab_customizer' );

function fancy_lab_sanitize_checkbox( $checked ) {
	return ( (isset($checked) && true == $checked) ? true : false );
}