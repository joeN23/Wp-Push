<?php
/**
 * Configuration for Themify Customizer
 * Created by themify
 * @since 1.0.0
 */

/**
 * Add new section
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function themify_theme_customizer_add_section( $wp_customize ) {
	$wp_customize->add_section( 'themify_skin_styles', array(
		'title'       => __( 'Skin Styles', 'themify' ),
		'description' => '',
	));
}
add_action( 'themify_customizer_before_add_section', 'themify_theme_customizer_add_section' );

/**
 * Add customizer controls
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function themify_theme_customizer_definition( $args ) {
	global $themify_customizer;
	$args = array(
		// Skin Styles
		'body_skin_background' => array(
			'control' => array(
				'type'    => 'Themify_Background_Control',
				'label'   => __( 'Body Background', 'themify' ),
				'show_label' => true,
				'section' => 'themify_skin_styles',
			),
			'selector' => 'body',
			'prop' => 'background',
		),
		
		'scheme_font_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'	  => __( 'Accent Color', 'themify' ),
				'color_label' => __( 'Accent Font Color', 'themify' ),
				'section' => 'themify_skin_styles',
			),
			'selector' => 'body #headerwrap,body .sidemenu,body #footerwrap,#footer .footer-widgets .widgettitle,body.header-leftpane #headerwrap #menu-icon,body.header-slide-out #headerwrap #menu-icon,body.header-horizontal #headerwrap #menu-icon,body.header-minbar #headerwrap #menu-icon,body #site-description,body .header-widget .widgettitle,body input[type=reset],body input[type=submit],body button,body #respond #cancel-comment-reply-link,body .commentlist .comment-reply-link,body .post-title a,body #main-nav > .current_page_item > a,body #main-nav > .current-menu-item > a,body #main-nav > li > a:hover,body.footer-horizontal-left .back-top .arrow-up a,body.footer-horizontal-right .back-top .arrow-up a,body.footer-left-col .back-top .arrow-up a,body.footer-right-col .back-top .arrow-up a,body.woocommerce #content input.button,body.woocommerce #respond input#submit,body.woocommerce a.button,body.woocommerce button.button,body.woocommerce input.button,body.woocommerce-page #content input.button,body.woocommerce-page #respond input#submit,body.woocommerce-page a.button,body.woocommerce-page button.button,body.woocommerce-page input.button,body.woocommerce #content input.button.alt,body.woocommerce #respond input#submit.alt,body.woocommerce a.button.alt,body.woocommerce button.button.alt,body.woocommerce input.button.alt,body.woocommerce-page #content input.button.alt,body.woocommerce-page #respond input#submit.alt,body.woocommerce-page a.button.alt,body.woocommerce-page button.button.alt,body.woocommerce-page input.button.alt,body.woocommerce ul.products li.product .add_to_cart_button,body.woocommerce-page ul.products li.product .add_to_cart_button,body.woocommerce ul.products li.product .button[data-product_id],body.woocommerce-page ul.products li.product .button[data-product_id],body.woocommerce span.onsale,body.woocommerce-page span.onsale,body.woocommerce ul.products li.product .onsale,body.woocommerce-page ul.products li.product .onsale,body.woocommerce-checkout #payment div.payment_box,body.woocommerce #content nav.woocommerce-pagination ul li a:focus,body.woocommerce #content nav.woocommerce-pagination ul li a:hover,body.woocommerce #content nav.woocommerce-pagination ul li span.current,body.woocommerce nav.woocommerce-pagination ul li a:focus,body.woocommerce nav.woocommerce-pagination ul li a:hover,body.woocommerce nav.woocommerce-pagination ul li span.current,body.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,body.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,body.woocommerce-page #content nav.woocommerce-pagination ul li span.current,body.woocommerce-page nav.woocommerce-pagination ul li a:focus,body.woocommerce-page nav.woocommerce-pagination ul li a:hover,body.woocommerce-page nav.woocommerce-pagination ul li span.current,body.woocommerce #content table.cart a.remove:hover,body.woocommerce table.cart a.remove:hover,body.woocommerce-page #content table.cart a.remove:hover,body.woocommerce-page table.cart a.remove:hover',
			'prop' => 'color',
		),

		'scheme_link_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'color_label' => __( 'Accent Link Color', 'themify' ),
				'section' => 'themify_skin_styles',
			),
			'selector' => 'body #headerwrap a, body #footerwrap a, body #main-nav a, body .sidemenu a, body .post-nav .arrow, body .widget .social-links a, body .widget .social-links a:hover, body .footer-nav li a',
			'prop' => 'color',
		),

		'scheme_background' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'color_label' => __( 'Accent Background Color', 'themify' ),
				'section' => 'themify_skin_styles',
			),
			'selector' => 'body #headerwrap,body .sidemenu,body #footerwrap,body.header-leftpane #headerwrap #menu-icon,body.header-slide-out #headerwrap #menu-icon,body.header-horizontal #headerwrap #menu-icon,body.header-minbar #headerwrap #menu-icon,body input[type=reset],body input[type=submit],body button,body #respond #cancel-comment-reply-link,body .commentlist .comment-reply-link,body.footer-horizontal-left .back-top .arrow-up a,body.footer-horizontal-right .back-top .arrow-up a,body.footer-left-col .back-top .arrow-up a,body.footer-right-col .back-top .arrow-up a,body.woocommerce #content input.button,body.woocommerce #respond input#submit,body.woocommerce a.button,body.woocommerce button.button,body.woocommerce input.button,body.woocommerce-page #content input.button,body.woocommerce-page #respond input#submit,body.woocommerce-page a.button,body.woocommerce-page button.button,body.woocommerce-page input.button,body.woocommerce #content input.button.alt,body.woocommerce #respond input#submit.alt,body.woocommerce a.button.alt,body.woocommerce button.button.alt,body.woocommerce input.button.alt,body.woocommerce-page #content input.button.alt,body.woocommerce-page #respond input#submit.alt,body.woocommerce-page a.button.alt,body.woocommerce-page button.button.alt,body.woocommerce-page input.button.alt,body.woocommerce ul.products li.product .add_to_cart_button,body.woocommerce-page ul.products li.product .add_to_cart_button,body.woocommerce ul.products li.product .button[data-product_id],body.woocommerce-page ul.products li.product .button[data-product_id],body.woocommerce span.onsale,body.woocommerce-page span.onsale,body.woocommerce ul.products li.product .onsale,body.woocommerce-page ul.products li.product .onsale,body.woocommerce-checkout #payment div.payment_box,body.woocommerce #content nav.woocommerce-pagination ul li a:focus,body.woocommerce #content nav.woocommerce-pagination ul li a:hover,body.woocommerce #content nav.woocommerce-pagination ul li span.current,body.woocommerce nav.woocommerce-pagination ul li a:focus,body.woocommerce nav.woocommerce-pagination ul li a:hover,body.woocommerce nav.woocommerce-pagination ul li span.current,body.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,body.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,body.woocommerce-page #content nav.woocommerce-pagination ul li span.current,body.woocommerce-page nav.woocommerce-pagination ul li a:focus,body.woocommerce-page nav.woocommerce-pagination ul li a:hover,body.woocommerce-page nav.woocommerce-pagination ul li span.current,body.woocommerce #content table.cart a.remove:hover,body.woocommerce table.cart a.remove:hover,body.woocommerce-page #content table.cart a.remove:hover,body.woocommerce-page table.cart a.remove:hover',
			'prop' => 'background',
		),

		'body_skin_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Typography', 'themify' ),
				'show_label' => true,
				'section' => 'themify_skin_styles',
				'font_options' => array(
					'show_size' => false,
					'show_lineheight' => false,
					'show_decoration' => false,
					'show_transform' => false,
					'show_align' => false,
					'font_family_label' => __( 'Body Font', 'themify' ),
				),
			),
			'selector' => 'body, body .post-meta, body #site-description, body .post-date .year, body .post-date .month, body .post-date .day, .loops-wrapper .entry-content',
			'prop' => 'font',
		),

		'body_skin_font_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'color_label'   => __( 'Body Font Color', 'themify' ),
				'section' => 'themify_skin_styles',
			),
			'selector' => 'body',
			'prop' => 'color',
		),

		'body_skin_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'color_label'   => __( 'Body Link Color', 'themify' ),
				'section' => 'themify_skin_styles',
			),
			'selector' => 'body a, body .post-nav .arrow',
			'prop' => 'color',
		),

		'heading_skin_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'section' => 'themify_skin_styles',
				'font_options' => array(
					'show_size' => false,
					'show_lineheight' => false,
					'show_decoration' => false,
					'show_transform' => false,
					'show_align' => false,
					'font_family_label' => __( 'Heading (h1 to h6)', 'themify' ),
				),
			),
			'selector' => 'body h1, body h2, body h3, body h4, body h5, body h6',
			'prop' => 'font',
		),

		'heading_skin_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'section' => 'themify_skin_styles',
			),
			'selector' => 'body h1, body h2, body h3, body h4, body h5, body h6',
			'prop' => 'color',
		),

		// Accordion Start ---------------------------
		'start_body_acc' => $themify_customizer->accordion_start( __( 'Body', 'themify' ) ),
		
		// Styling key name. Includes any string depicting the styling, for example 'body' and a suffix
		// specifying the type of control, for example '_background'
		'body_background' => array(
			'setting' => array( // Optional. Default setting/value to save.
				'transport' => 'postMessage', // Live update (postMessage) or reload (refresh) the page.
			),
			'control' => array(
				'type'    => 'Themify_Background_Control', // Type of the control to render.
				'label'   => __( 'Body Background', 'themify' ), // Visible name of the control.
				'show_label' => true, // Whether to show the control name or not. Defaults to true.
				'section' => 'themify_options', // Optional section ID where the control will be added.
			),
			'selector' => 'body', // CSS Selector to apply styling.
			'prop' => 'background', // Styling to apply, can be a CSS property or a custom set of properties.
		),

		'body_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Body Font', 'themify' ),
			),
			'selector' => 'body',
			'prop' => 'font',
		),

		'body_text_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
			),
			'selector' => 'body',
			'prop' => 'color',
		),

		'body_link_font' => array(
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
				'label'   => __( 'Body Link', 'themify' ),
			),
			'selector' => 'a',
			'prop' => 'font',
		),

		'body_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
			),
			'selector' => 'a',
			'prop' => 'color',
		),

		'body_link_hover_font' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
				'label'   => __( 'Body Link Hover', 'themify' ),
			),
			'selector' => 'a:hover',
			'prop' => 'font',
		),

		'body_link_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
			),
			'selector' => 'a:hover',
			'prop' => 'color',
		),
		
		'end_body_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_header_acc' => $themify_customizer->accordion_start( __( 'Header', 'themify' ) ),

		'headerwrap_background' => array(
			'control' => array(
				'type'    => 'Themify_Background_Control',
				'label'   => __( 'Header Wrap', 'themify' ),
			),
			'selector' => '#headerwrap',
			'prop' => 'background',
		),

		'headerwrap_border' => array(
			'control' => array(
				'type'    => 'Themify_Border_Control',
				'label'   => __( 'Header Wrap Border', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#headerwrap',
			'prop' => 'border',
		),

		'headerwrap_padding' => array(
			'control' => array(
				'type'    => 'Themify_Padding_Control',
				'label'   => __( 'Header Wrap Padding', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#headerwrap',
			'prop' => 'padding',
		),

		'headerwrap_margin' => array(
			'control' => array(
				'type'    => 'Themify_Margin_Control',
				'label'   => __( 'Header Wrap Margin', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#headerwrap',
			'prop' => 'margin',
		),

		'header_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Header Font', 'themify' ),
			),
			'selector' => '#header',
			'prop' => 'font',
		),

		'header_text_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Header Font Color', 'themify' ),
				'show_label' => false,
			),
		'selector' => '#header',
			'prop' => 'color',
		),

		'header_link_font' => array(
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
				'label'   => __( 'Header Link', 'themify' ),
			),
			'selector' => '#header a',
			'prop' => 'font',
		),

		'header_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Header Link Color', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#header a',
			'prop' => 'color',
		),

		'header_link_hover_font' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
				'label'   => __( 'Header Link Hover', 'themify' ),
			),
			'selector' => '#header a:hover',
			'prop' => 'font',
		),

		'header_link_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
			),
			'selector' => '#header a:hover',
			'prop' => 'color',
		),

		'end_header_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------
		
		// Accordion Start ---------------------------
		'start_sticky_header_acc' => $themify_customizer->accordion_start( __( 'Sticky Header', 'themify' ) ),

		'sticky_headerwrap_background' => array(
			'control' => array(
				'type'    => 'Themify_Background_Control',
				'label'   => __( 'Header Wrap', 'themify' ),
			),
			'selector' => '#headerwrap.fixed-header, .transparent-header #headerwrap.fixed-header',
			'prop' => 'background',
		),

		'sticky_header_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Header Font', 'themify' ),
			),
			'selector' => '.fixed-header #header, .fixed-header #site-description',
			'prop' => 'font',
		),

		'sticky_header_font_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Header Font Color', 'themify' ),
				'show_label' => false,
			),
		'selector' => '.fixed-header #header',
			'prop' => 'color',
		),

		'sticky_header_link_font' => array(
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
				'label'   => __( 'Header Link', 'themify' ),
			),
			'selector' => '.fixed-header #header a',
			'prop' => 'font',
		),

		'sticky_header_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Header Link Color', 'themify' ),
				'show_label' => false,
			),
			'selector' => '.fixed-header #header a',
			'prop' => 'color',
		),

		'sticky_header_link_hover_font' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
				'label'   => __( 'Header Link Hover', 'themify' ),
			),
			'selector' => '.fixed-header #header a:hover',
			'prop' => 'font',
		),

		'sticky_header_link_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
			),
			'selector' => '.fixed-header #header a:hover',
			'prop' => 'color',
		),

		'end_sticky_header_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_titletagline_acc' => $themify_customizer->accordion_start( __( 'Site Logo &amp; Tagline', 'themify' ) ),

		// This element is not CSS, but markup written by site_logo()
		'site-logo_image' => array(
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'type'    => 'Themify_Logo_Control',
				'label'   => __( 'Site Logo', 'themify' ),
			),
			'selector' => '#site-logo, #site-logo a, .header-horizontal #site-logo, .header-minbar #site-logo, .header-leftpane #site-logo, .header-slide-out #site-logo, .boxed-compact #site-logo, .header-top-bar #site-logo',
			'prop' => 'logo',
		),

		// This element is not CSS, but markup written by site_description()
		'site-tagline' => array(
			'control' => array(
				'type'    => 'Themify_Tagline_Control',
				'label'   => __( 'Site Tagline', 'themify' ),
			),
			'selector' => '#site-description',
			'prop' => 'tagline',
		),

		'end_titletagline_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_nav_acc' => $themify_customizer->accordion_start( __( 'Main Navigation', 'themify' ) ),

		'main_nav' => array(
			'control' => array(
				'type'    => 'nav_menu',
				'label'   => __( 'Main Navigation Menu', 'themify' ),
				'location' => 'main-nav',
			),
		),

		'main_nav_link_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Menu Link', 'themify' ),
			),
			'selector' => '#main-nav a',
			'prop' => 'font',
		),

		'main_nav_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Menu Link Color', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#main-nav a, #main-nav > li > a',
			'prop' => 'color',
		),

		'main_nav_link_background' => array(
			'control' => array(
				'type'    => 'Themify_Color_Transparent_Control',
				'label'   => __( 'Menu Link Background', 'themify' ),
				'show_label' => false,
				'color_label' => __( 'Background Color', 'themify' ),
			),
			'selector' => '#main-nav a',
			'prop' => 'background',
		),

		'main_nav_link_border' => array(
			'control' => array(
				'type'    => 'Themify_Border_Control',
				'label'   => __( 'Menu Link Border', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#main-nav a',
			'prop' => 'border',
		),

		'main_nav_link_padding' => array(
			'control' => array(
				'type'    => 'Themify_Padding_Control',
				'label'   => __( 'Menu Link Padding', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#main-nav a',
			'prop' => 'padding',
		),

		'main_nav_link_margin' => array(
			'control' => array(
				'type'    => 'Themify_Margin_Control',
				'label'   => __( 'Menu Link Margin', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#main-nav a',
			'prop' => 'margin',
		),

		'main_nav_link_hover_background' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Transparent_Control',
				'label'   => __( 'Menu Link Hover', 'themify' ),
				'color_label' => __( 'Background Color', 'themify' ),
			),
			'selector' => '#main-nav a:hover',
			'prop' => 'background',
		),

		'main_nav_link_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Menu Link Hover Color', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#main-nav a:hover, #main-nav > li > a:hover',
			'prop' => 'color',
		),

		'main_nav_link_active_background' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Transparent_Control',
				'label'   => __( 'Menu Active Link', 'themify' ),
				'color_label' => __( 'Background Color', 'themify' ),
			),
			'selector' => '#main-nav .current_page_item a, #main-nav .current-menu-item a',
			'prop' => 'background',
		),

		'main_nav_link_active_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Menu Active Link Color', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#main-nav .current_page_item a, #main-nav .current-menu-item a, #main-nav > .current_page_item > a, #main-nav > .current-menu-item > a',
			'prop' => 'color',
		),

		'main_nav_link_active_hover_background' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Transparent_Control',
				'label'   => __( 'Menu Active Link Hover', 'themify' ),
				'color_label' => __( 'Background Color', 'themify' ),
			),
			'selector' => '#main-nav .current_page_item a:hover,  #main-nav .current-menu-item a:hover',
			'prop' => 'background',
		),

		'main_nav_link_active_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Menu Active Link Hover Color', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#main-nav .current_page_item a:hover,  #main-nav .current-menu-item a:hover',
			'prop' => 'color',
		),

		'end_nav_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------
		
		// Mobile Menu Options
		'start_mobile_menu_acc' => $themify_customizer->accordion_start( __( 'Mobile Menu', 'themify' ) ),
		'mobile_menu_panel_background' => array(
			'control' => array(
				'type'    => 'Themify_Background_Control',
				'label'   => __( 'Mobile Menu Panel', 'themify' ),
				'show_label' => true,
			),
			'selector' => '#headerwrap #mobile-menu.sidemenu-on',
			'prop' => 'background',
		),
		'mobile_menu_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Mobile Menu Link', 'themify' )
			),
			'selector' => '#pagewrap #headerwrap #mobile-menu.sidemenu-on nav li a',
			'prop' => 'font',
		),
		'mobile_menu_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'color_label'   => __( 'Link Color', 'themify' )
			),
			'selector' => '#headerwrap #mobile-menu.sidemenu-on nav li',
			'prop' => 'color',
		),
		'mobile_menu_hover_background' => array(
			'control' => array(
				'type'    => 'Themify_Color_Transparent_Control',
				'label'   => __( 'Mobile Menu Link Hover', 'themify' ),
				'color_label' => __( 'Background Color', 'themify' ),
			),
			'selector' => '#headerwrap #mobile-menu.sidemenu-on nav a:hover, #headerwrap #mobile-menu.sidemenu-on nav .current-menu-item > a',
			'prop' => 'background',
		),
		'mobile_menu_hover_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Mobile Menu Link Hover Color', 'themify' ),
				'show_label' => false,
			),
			'selector' => '#headerwrap #mobile-menu.sidemenu-on nav a:hover, #headerwrap #mobile-menu.sidemenu-on nav .current-menu-item > a',
			'prop' => 'color',
		),
		
		'end_mobile_menu_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_post_acc' => $themify_customizer->accordion_start( __( 'Post', 'themify' ) ),

		// Post Title .post-title

		'post_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Post Title', 'themify' ),
			),
			'selector' => '.post-title, .post-title a',
			'prop' => 'font',
		),

		'post_title_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
			),
			'selector' => '.post-title, .post-title a',
			'prop' => 'color',
		),


		'post_title_hover_font' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
				'label'   => __( 'Post Title Hover', 'themify' ),
			),
			'selector' => '.post-title a:hover',
			'prop' => 'font',
		),

		'post_title_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
			),
			'selector' => '.post-title a:hover',
			'prop' => 'color',
		),

		'single_post_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Single Post Title', 'themify' ),
			),
			'selector' => '.single-post .post-title',
			'prop' => 'font',
		),

		'grid4_post_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Grid4 Post Title', 'themify' ),
			),
			'selector' => '.loops-wrapper.grid4 .post-title',
			'prop' => 'font',
		),

		'grid3_post_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Grid3 Post Title', 'themify' ),
			),
			'selector' => '.loops-wrapper.grid3 .post-title',
			'prop' => 'font',
		),

		'grid2_post_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Grid2 Post Title', 'themify' ),
			),
			'selector' => '.loops-wrapper.grid2 .post-title',
			'prop' => 'font',
		),

		'grid2_thumb_post_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'Grid2 Thumb Post Title', 'themify' ),
			),
			'selector' => '.loops-wrapper.grid2-thumb .post-title',
			'prop' => 'font',
		),

		'list_thumb_post_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
				'label'   => __( 'List Thumb Post Title', 'themify' ),
			),
			'selector' => '.loops-wrapper.list-thumb-image .post-title',
			'prop' => 'font',
		),

		'single_post_featured_area' => array(
			'control' => array(
				'type'    => 'Themify_Background_Control',
				'label'   => __( 'Single Post Featured Area', 'themify' ),
			),
			'selector' => '.single.single-post .featured-area',
			'prop' => 'background',
		),

		'end_post_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_page_title_acc' => $themify_customizer->accordion_start( __( 'Page Title', 'themify' ) ),

		// Page Title .page-title

		'page_title_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Page Title', 'themify' ),
			),
			'selector' => '.page-title',
			'prop' => 'color',
		),

		'page_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
			),
			'selector' => '.page-title',
			'prop' => 'font',
		),

		'end_page_title_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_module_title_acc' => $themify_customizer->accordion_start( __( 'Module Title', 'themify' ) ),

		// Module Title .module-title

		'module_title_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Module Title', 'themify' ),
			),
			'selector' => '.module-title',
			'prop' => 'color',
		),

		'module_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
			),
			'selector' => '.module-title',
			'prop' => 'font',
		),

		'end_module_title_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_sidebar_acc' => $themify_customizer->accordion_start( __( 'Sidebar', 'themify' ) ),

		// Sidebar Font #sidebar

		'sidebar_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Sidebar Font', 'themify' ),
			),
			'selector' => '#sidebar',
			'prop' => 'color',
		),

		'sidebar_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
			),
			'selector' => '#sidebar',
			'prop' => 'font',
		),

		// Sidebar Link #sidebar a

		'sidebar_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Sidebar Link', 'themify' ),
			),
			'selector' => '#sidebar a',
			'prop' => 'color',
		),

		'sidebar_link_font' => array(
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
			),
			'selector' => '#sidebar a',
			'prop' => 'font',
		),

		// Sidebar Link Hover #sidebar a:hover

		'sidebar_link_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Sidebar Link Hover', 'themify' ),
			),
			'selector' => '#sidebar a:hover',
			'prop' => 'color',
		),

		'sidebar_link_hover_font' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
			),
			'selector' => '#sidebar a:hover',
			'prop' => 'font',
		),

		// Sidebar Widget Title #sidebar .widgettitle

		'sidebar_widget_title_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Sidebar Widget Title', 'themify' ),
			),
			'selector' => '#sidebar .widgettitle',
			'prop' => 'color',
		),

		'sidebar_widget_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
			),
			'selector' => '#sidebar .widgettitle',
			'prop' => 'font',
		),

		'end_sidebar_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// Accordion Start ---------------------------
		'start_footer_acc' => $themify_customizer->accordion_start( __( 'Footer', 'themify' ) ),

		// Footer Wrap #footerwrap

		'footerwrap_background' => array(
			'control' => array(
				'type'    => 'Themify_Background_Control',
				'label'   => __( 'Footer Wrap', 'themify' ),
			),
			'selector' => '#footerwrap',
			'prop' => 'background',
		),

		'footerwrap_border' => array(
			'control' => array(
				'type'    => 'Themify_Border_Control',
			),
			'selector' => '#footerwrap',
			'prop' => 'border',
		),

		'footerwrap_padding' => array(
			'control' => array(
				'type'  => 'Themify_Padding_Control',
			),
			'selector' => '#footerwrap',
			'prop' => 'padding',
		),

		'footerwrap_margin' => array(
			'control' => array(
				'type'  => 'Themify_Margin_Control',
			),
			'selector' => '#footerwrap',
			'prop' => 'margin',
		),

		'footer-logo_image' => array(
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'type'    => 'Themify_Logo_Control',
				'label'   => __( 'Footer Logo', 'themify' ),
			),
			'selector' => '#footer-logo',
			'prop' => 'logo',
		),

		// Footer Font #footer

		'footer_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Footer Font', 'themify' ),
			),
			'selector' => '#footer',
			'prop' => 'color',
		),

		'footer_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
			),
			'selector' => '#footer, #footer-logo, .footer-nav a, .footer-text',
			'prop' => 'font',
		),

		// Footer Link #footer a

		'footer_link_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Footer Link', 'themify' ),
			),
			'selector' => '#footer a',
			'prop' => 'color',
		),

		'footer_link_font' => array(
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
			),
			'selector' => '#footer a',
			'prop' => 'font',
		),

		// Footer Link #footer a:hover

		'footer_link_hover_color' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Footer Link Hover', 'themify' ),
			),
			'selector' => '#footer a:hover',
			'prop' => 'color',
		),

		'footer_link_hover_font' => array(
			'setting' => array( 'transport' => 'refresh' ),
			'control' => array(
				'type'    => 'Themify_Text_Decoration_Control',
			),
			'selector' => '#footer a:hover',
			'prop' => 'font',
		),
				
		'footer_nav' => array(
			'control' => array(
				'type'    => 'nav_menu',
				'label'   => __( 'Footer Navigation Menu', 'themify' ),
				'location' => '#footer-nav',
			),
		),

		// Footer Widget Font #footer .footer-widgets

		'footer_widget_text_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Footer Widget Font', 'themify' ),
			),
			'selector' => '#footer .footer-widgets',
			'prop' => 'color',
		),

		'footer_widget_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
			),
			'selector' => '#footer .footer-widgets',
			'prop' => 'font',
		),

		// Footer Widget Title #footer .footer-widgets .widgettitle

		'footer_widget_title_color' => array(
			'control' => array(
				'type'    => 'Themify_Color_Control',
				'label'   => __( 'Footer Widget Title', 'themify' ),
			),
			'selector' => '#footer .footer-widgets .widgettitle',
			'prop' => 'color',
		),

		'footer_widget_title_font' => array(
			'control' => array(
				'type'    => 'Themify_Font_Control',
			),
			'selector' => '#footer .footer-widgets .widgettitle',
			'prop' => 'font',
		),

		'end_footer_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------*/

		// Accordion Start ---------------------------
		'start_customcss_acc' => $themify_customizer->accordion_start( __( 'Custom CSS', 'themify' ) ),

		// This element is not CSS, but markup written by themify_custom_css()
		'customcss' => array(
			'control' => array(
				'type'    => 'Themify_CustomCSS_Control',
				'label'   => __( 'Custom CSS', 'themify' ),
				'show_label' => false,
			),
			'selector' => 'customcss',
			'prop' => 'customcss',
		),

		'end_customcss_acc' => $themify_customizer->accordion_end(),
		// Accordion End   ---------------------------

		// This element doesn't have a live preview and it's not styling.
		'clear' => array(
			'control' => array(
				'type'    => 'Themify_Clear_Control',
				'label'   => __( 'Reset All Customization', 'themify' ),
			),
			'selector' => 'clear',
			'prop' => 'clear',
		)
	);
	return $args;
}
add_filter( 'themify_customizer_settings', 'themify_theme_customizer_definition' );