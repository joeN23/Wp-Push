<?php
/**
 * Portfolio Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_portfolio_meta_box( $args = array() ) {
	extract( $args );
	return array(
		// Layout
		array(
			'name' 		=> 'layout',
			'title' 		=> __('Sidebar Option', 'themify'),
			'description' => '',
			'type' 		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array('value' => 'default', 'img' => 'images/layout-icons/default.png', 'selected' => true, 'title' => __('Default', 'themify')),
				array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
				array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
				array('value' => 'sidebar2', 'img' => 'images/layout-icons/sidebar2.png', 'title' => __('Left and Right', 'themify')),
				array('value' => 'sidebar2 content-left', 	'img' => 'images/layout-icons/sidebar2-content-left.png', 'title' => __('2 Right Sidebars', 'themify')),
				array('value' => 'sidebar2 content-right', 	'img' => 'images/layout-icons/sidebar2-content-right.png', 'title' => __('2 Left Sidebars', 'themify')),
				array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar ', 'themify'))
			),
			'default' => 'default',
		),
	    //Post Layout
        array(
            'name' => 'post_layout',
            'title' => __('Portfolio Layout', 'themify'),
            'description' => '',
            'type' => 'layout',
            'show_title' => true,
            'enable_toggle' => true,
            'class' => 'hide-if none',
            'meta' => array(
                array('value' => '', 'img' => 'images/layout-icons/default.png', 'selected' => true, 'title' => __('Default', 'themify')),
				array('value' => 'fullwidth', 'img' => 'images/layout-icons/post-fullwidth.png', 'title' => __('Fullwidth', 'themify')),
                array('value' => 'slider', 'img' => 'images/layout-icons/post-slider.png', 'title' => __('Slider', 'themify')),
                array('value' => 'gallery', 'img' => 'images/layout-icons/post-gallery.png', 'title' => __('Gallery', 'themify')),
                array('value' => 'split', 'img' => 'images/layout-icons/post-split.png', 'title' => __('Split', 'themify'))
            ),
        ),
		 // Gallery Layout shortcode
        array(
            'name' => 'post_layout_gallery',
            'title' => '',
            'description' => '',
            'type' => 'gallery_shortcode',
            'toggle' => 'gallery-toggle',
            'class' => 'hide-if none',
        ),
        // Slider Layout shortcode
        array(
            'name' => 'post_layout_slider',
            'title' => '',
            'description' => '',
            'type' => 'gallery_shortcode',
            'toggle' => 'slider-toggle',
            'class' => 'hide-if none',
        ),
		// Content Width
		array(
			'name'=> 'content_width',
			'title' => __('Content Width', 'themify'),
			'description' => '',
			'type' => 'layout',
			'show_title' => true,
			'meta' => array(
				array(
					'value' => 'default_width',
					'img' => 'themify/img/default.png',
					'selected' => true,
					'title' => __( 'Default', 'themify' )
				),
				array(
					'value' => 'full_width',
					'img' => 'themify/img/fullwidth.png',
					'title' => __( 'Fullwidth', 'themify' )
				)
			),
			'default' => 'default_width',
		),
		// Post Image
		array(
			'name' 		=> 'post_image',
			'title' 		=> __('Featured Image', 'themify'),
			'description' => '',
			'type' 		=> 'image',
			'meta'		=> array()
		),
		// Featured Image Size
		array(
			'name'	=>	'feature_size',
			'title'	=>	__('Image Size', 'themify'),
			'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s" target="_blank">Regenerated</a>', 'themify'), 'options-media.php', 'https://wordpress.org/plugins/regenerate-thumbnails/'),
			'type'		 =>	'featimgdropdown',
			'display_callback' => 'themify_is_image_script_disabled'
		),
		// Multi field: Image Dimension
		themify_image_dimensions_field(),		
		// Hide Title
		array(
			'name' 		=> 'hide_post_title',
			'title'		=> __('Hide Post Title', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default',
		),
		// Unlink Post Title
		array(
			'name' 		=> 'unlink_post_title',
			'title' 		=> __('Unlink Post Title', 'themify'),
			'description' => __('Unlink post title (it will display the post title without link)', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default',
		),
		// Hide Post Meta
		array(
			'name' 		=> 'hide_post_meta',
			'title'		=> __('Hide Post Meta', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default',
		),
		// Hide Post Image
		array(
			'name' 		=> 'hide_post_image',
			'title' 		=> __('Hide Featured Image', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default',
		),
		// Unlink Post Image
		array(
			'name' 		=> 'unlink_post_image',
			'title' 		=> __('Unlink Featured Image', 'themify'),
			'description' => __('Display the Featured Image without link', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default',
		),
		// External Link
		array(
			'name' 		=> 'external_link',
			'title' 		=> __('External Link', 'themify'),
			'description' => __('Link Featured Image and Post Title to external URL', 'themify'),
			'type' 		=> 'textbox',
			'meta'		=> array()
		),
		// Lightbox Link
		themify_lightbox_link_field(),
	    // Custom menu
		array(
			'name'        => 'custom_menu',
			'title'       => __( 'Custom Menu', 'themify' ),
			'description' => '',
			'type'        => 'dropdown',
			// extracted from $args
			'meta'        => $args['nav_menus'],
		),
		// Separator - Project Information
		array(
			'name'        => '_separator_project_info',
			'title'       => '',
			'description' => '',
			'type'        => 'separator',
			'meta'        => array(
				'html' => '<h4>' . __( 'Project Info', 'themify' ) . '</h4><hr class="meta_fields_separator"/>'
			),
		),
		// Project Date
		array(
			'name'        => 'project_date',
			'title'       => __( 'Date', 'themify' ),
			'description' => '',
			'type'        => 'textbox',
			'meta'        => array()
		),
		// Project Client
		array(
			'name'        => 'project_client',
			'title'       => __( 'Client', 'themify' ),
			'description' => '',
			'type'        => 'textbox',
			'meta'        => array()
		),
		// Project Services
		array(
			'name'        => 'project_services',
			'title'       => __( 'Services', 'themify' ),
			'description' => '',
			'type'        => 'textbox',
			'meta'        => array()
		),
		// Project Launch
		array(
			'name'        => 'project_launch',
			'title'       => __( 'Link to Launch', 'themify' ),
			'description' => '',
			'type'        => 'textbox',
			'meta'        => array()
		),
	);
}

/**
 * Theme Appearance Tab for Themify Custom Panel
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function themify_theme_portfolio_theme_design_meta_box( $args = array() ) {
	return array(
		// Notice
		array(
			'name' => '_theme_appearance_notice',
			'title' => '',
			'description' => '',
			'type' => 'separator',
			'meta' => array(
				'html' => '<div class="themify-info-link">' . __( 'The settings here apply on this portfolio only. Leave everything as default will use the site-wide Theme Appearance from the Themify panel > Settings > Theme Settings.', 'themify' ) . '</div>'
			),
		),
		// Background Color
		array(
			'name'        => 'body_background_color',
			'title'       => __( 'Body Background', 'themify' ),
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
		),
		// Background image
		array(
			'name'        => 'body_background_image',
			'title'       => '',
			'type'        => 'image',
			'description' => '',
			'meta'        => array(),
			'before'      => '',
			'after'       => '',
		),
		// Background repeat
		array(
			'name'        => 'body_background_repeat',
			'title'       => '',
			'description' => __( 'Background Repeat', 'themify' ),
			'type'        => 'dropdown',
			'meta'        => array(
				array(
					'value' => '',
					'name'  => ''
				),
				array(
					'value' => 'fullcover',
					'name'  => __( 'Fullcover', 'themify' )
				),
				array(
					'value' => 'repeat',
					'name'  => __( 'Repeat', 'themify' )
				),
				array(
					'value' => 'no-repeat',
					'name'  => __( 'No Repeat', 'themify' )
				),
				array(
					'value' => 'repeat-x',
					'name'  => __( 'Repeat horizontally', 'themify' )
				),
				array(
					'value' => 'repeat-y',
					'name'  => __( 'Repeat vertically', 'themify' )
				),
			),
		),
		// Accent Color Mode, Presets or Custom
		array(
			'name'          => 'color_scheme_mode',
			'title'         => __( 'Accent Color', 'themify' ),
			'description'   => '',
			'type'          => 'radio',
			'show_title'    => true,
			'meta'          => array(
				array(
					'value'    => 'color-presets',
					'name'     => __( 'Presets', 'themify' ),
					'selected' => true
				),
				array(
					'value' => 'color-custom',
					'name' => __( 'Custom', 'themify' ),
				),
			),
			'default' => 'color-presets',
			'enable_toggle' => true,
		),
		// Theme Color
		array(
			'name'        => 'color_design',
			'title'       => '',
			'description' => '',
			'type'        => 'layout',
			'show_title'  => true,
			'meta'        => $args['color_design_options'],
			'toggle'	=> 'color-presets-toggle',
			'default' => 'default',
		),
		// Accent Color
		array(
			'name'        => 'scheme_color',
			'title'       => '',
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'after'		  => __( 'Accent Font Color', 'themify' ),
			'toggle'	=> 'color-custom-toggle',
		),
		array(
			'name'        => 'scheme_link',
			'title'       => '',
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'after'		  => __( 'Accent Link Color', 'themify' ),
			'toggle'	=> 'color-custom-toggle',
		),
		array(
			'name'        => 'scheme_background',
			'title'       => '',
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'after'		  => __( 'Accent Background Color', 'themify' ),
			'toggle'	=> 'color-custom-toggle',
		),

		// Typography Mode, Presets or Custom
		array(
			'name'          => 'typography_mode',
			'title'         => __( 'Typography', 'themify' ),
			'description'   => '',
			'type'          => 'radio',
			'show_title'    => true,
			'meta'          => array(
				array(
					'value'    => 'typography-presets',
					'name'     => __( 'Presets', 'themify' ),
					'selected' => true
				),
				array(
					'value' => 'typography-custom',
					'name' => __( 'Custom', 'themify' ),
				),
			),
			'default' => 'typography-presets',
			'enable_toggle' => true,
		),
		// Typography
		array(
			'name'        => 'font_design',
			'title'       => '',
			'description' => '',
			'type'        => 'layout',
			'show_title'  => true,
			'meta'        => $args['font_design_options'],
			'toggle'	  => 'typography-presets-toggle',
			'default' => 'default',
		),
		// Body font
		array(
			'name'        => 'body_font',
			'title'       => '',
			'description' => '',
			'type'        => 'dropdown',
			'meta'        => array_merge( themify_get_web_safe_font_list(), themify_get_google_web_fonts_list() ),
			'after'		  => ' ' . __( 'Body Font', 'themify' ),
			'toggle'	  => 'typography-custom-toggle',
			'default' => 'default',
		),
		// Body wrap text color
		array(
			'name'        => 'body_text_color',
			'title'       => '',
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'after'		  => __( 'Body Font Color', 'themify' ),
			'toggle'	  => 'typography-custom-toggle',
		),
		// Body wrap link color
		array(
			'name'        => 'body_link_color',
			'title'       => '',
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'after'		  => __( 'Body Link Color', 'themify' ),
			'toggle'	  => 'typography-custom-toggle',
		),
		// Heading font
		array(
			'name'        => 'heading_font',
			'title'       => '',
			'description' => '',
			'type'        => 'dropdown',
			'meta'        => array_merge( themify_get_web_safe_font_list(), themify_get_google_web_fonts_list() ),
			'after'		  => ' ' . __( 'Heading (h1 to h6)', 'themify' ),
			'toggle'	  => 'typography-custom-toggle',
			'default' => 'default',
		),
		// Heading color
		array(
			'name'        => 'heading_color',
			'title'       => '',
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'after'		  => __( 'Heading Font Color', 'themify' ),
			'toggle'	  => 'typography-custom-toggle',
		),

		// Header Separator
		array(
			'name' => 'header_separator',
			'type' => 'separator',
			'meta' => array('html'=>'<hr />')
		),
		// Header Design
		array(
			'name'        => 'header_design',
			'title'       => __( 'Header Design', 'themify' ),
			'description' => '',
			'type'        => 'layout',
			'show_title'  => true,
			'meta'        => $args['header_design_options'],
			'hide'		  => 'none header-leftpane header-minbar boxed-content header-rightpane',
			'default' => 'default',
		),
		// Sticky Header
		array(
			'name'        => 'fixed_header',
			'title'       => __( 'Sticky Header', 'themify' ),
			'description' => '',
			'type'		  => 'radio',
			'meta'		  => themify_ternary_options(),
			'class'		  => 'hide-if none header-leftpane header-minbar boxed-content header-rightpane',
			'default' => 'default',
		),
		// Full Height Header
		array(
			'name'        => 'full_height_header',
			'title'       => __( 'Full Height Header', 'themify' ),
			'description' => __( 'Full height will display the container in 100% viewport height', 'themify' ),
			'type'		  => 'radio',
			'meta'		  => themify_ternary_options(),
			'class'		  => 'hide-if default none header-horizontal header-leftpane header-minbar boxed-content header-top-bar header-slide-out boxed-layout boxed-compact header-rightpane header-stripe header-menu-split header-overlay',
			'default' => 'default',
		),
		// Header Elements
		array(
			'name' 	=> '_multi_header_elements',	
			'title' => __('Header Elements', 'themify'), 	
			'description' => '',	
			'type' 	=> 'multi',
			'class' => 'hide-if none',		
			'meta'	=> array(
				'fields' => array(
					// Show Site Logo
					array(
						'name' 	=> 'exclude_site_logo',
						'description' => '',
						'title' => __( 'Site Logo', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none header-menu-split',
						'after' => '<div class="clear"></div>',
					),
					// Show Site Tagline
					array(
						'name' 	=> 'exclude_site_tagline',
						'description' => '',
						'title' => __( 'Site Tagline', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Search Form
					array(
						'name' 	=> 'exclude_search_form',
						'description' => '',
						'title' => __( 'Search Form', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show RSS Link
					array(
						'name' 	=> 'exclude_rss',
						'description' => '',
						'title' => __( 'RSS Link', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Header Widgets
					array(
						'name' 	=> 'exclude_header_widgets',
						'description' => '',
						'title' => __( 'Header Widgets', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Social Widget
					array(
						'name' 	=> 'exclude_social_widget',
						'description' => '',
						'title' => __( 'Social Widget', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Menu Navigation
					array(
						'name' 	=> 'exclude_menu_navigation',
						'description' => '',
						'title' => __( 'Menu Navigation', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none header-menu-split',
						'after' => '<div class="clear"></div>',
					),
					array(
						'name' 	=> 'exclude_cart_icon',
						'description' => '',
						'title' => __( 'Cart Icon', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => '',
						'after' => '<div class="clear"></div>',
						'display_callback' => 'themify_is_woocommerce_active'
					),
				),
				'description' => '',
				'before' => '',
				'after' => '<div class="clear"></div>',
				'separator' => ''
			)
		),
		// Header Wrap
		array(
			'name'          => 'header_wrap',
			'title'         => __( 'Header Background Type', 'themify' ),
			'description'   => '',
			'type'          => 'radio',
			'show_title'    => true,
			'meta'          => array(
				array(
					'value'    => 'solid',
					'name'     => __( 'Image Background', 'themify' ),
					'selected' => true
				),
				array(
					'value' => 'transparent',
					'name'  => __( 'Transparent Header', 'themify' ),
				),
				array(
					'value' => 'slider',
					'name' => __( 'Image Slider', 'themify' ),
				),
				array(
					'value' => 'video',
					'name' => __( 'Video Background', 'themify' ),
				),
				array(
					'value' => 'colors',
					'name' => __( 'Animating Colors', 'themify' ),
				),
			),
			'default' => 'solid',
			'enable_toggle' => true,
			'class'     => 'hide-if none clear',
		),
		// Animated Colors
		array(
			'name' 		=> '_animated_colors',
			'title'		=> __('Animating Colors', 'themify'),
			'description' => sprintf( __('Animating Colors can be configured at <a href="%s">Themify > Settings > Theme Settings</a>', 'themify'), esc_url( add_query_arg( 'page', 'themify', admin_url( 'admin.php' ) ) ) ),
			'type' 		=> 'post_id_info',
			'toggle'	=> 'colors-toggle',
		),
		// Select Background Gallery
		array(
			'name' 		=> 'background_gallery',
			'title'		=> __('Header Slider', 'themify'),
			'description' => '',
			'type' 		=> 'gallery_shortcode',
			'toggle'	=> 'slider-toggle',
		),
		// Background Mode
		array(
			'name'		=> 'background_mode',
			'title'		=> __('Slider Mode', 'themify'),
			'type'		=> 'radio',
			'meta'		=> array(
				array('value' => 'fullcover', 'selected' => $args['background_mode']=='fullcover', 'name' => __('Full Cover', 'themify')),
				array('value' => 'best-fit', 'selected' => $args['background_mode']=='best-fit', 'name' => __('Best Fit', 'themify'))
			),
			'enable_toggle'	=> true,
			'toggle'	=> 'enable_toggle_child slider-toggle',
			'class'     => 'hide-if none',
			'default' => 'fullcover',
		),
		// Background Position
		array(
			'name'		=> 'background_position',
			'title'		=> __('Slider Image Position', 'themify'),
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('value' => '', 'name' => '', 'selected' => true),
				array('value' => 'left-top', 'name' => __('Left Top', 'themify')),
				array('value' => 'left-center', 'name' => __('Left Center', 'themify')),
				array('value' => 'left-bottom', 'name' => __('Left Bottom', 'themify')),
				array('value' => 'right-top', 'name' => __('Right Top', 'themify')),
				array('value' => 'right-center', 'name' => __('Right Center', 'themify')),
				array('value' => 'right-bottom', 'name' => __('Right Bottom', 'themify')),
				array('value' => 'center-top', 'name' => __('Center Top', 'themify')),
				array('value' => 'center-center', 'name' => __('Center Center', 'themify')),
				array('value' => 'center-bottom', 'name' => __('Center Bottom', 'themify'))
			),
			'toggle'	=> 'slider-toggle',
			'class'     => 'hide-if none',
		),
		array(
			'type' => 'multi',
			'name' => '_video_select',
			'title' => __('Header Video', 'themify'),
			'meta' => array(
				'fields' => array(
					// Video File
					array(
						'name' 		=> 'video_file',
						'title' 	=> __('Video File', 'themify'),
						'description' => '',
						'type' 		=> 'video',
						'meta'		=> array(),
					),
				),
				'description' => __('Video format: mp4. Note: video background does not play on mobile, background image will be used as fallback.', 'themify'),
				'before' => '',
				'after' => '',
				'separator' => ''
			),
			'toggle'	=> 'video-toggle'
		),
		// Background Color
		array(
			'name'        => 'background_color',
			'title'       => __( 'Header Background', 'themify' ),
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'toggle'      => array( 'solid-toggle', 'slider-toggle', 'video-toggle' ),
			'class'     => 'hide-if none',
		),
		// Background image
		array(
			'name'        => 'background_image',
			'title'       => '',
			'type'        => 'image',
			'description' => '',
			'meta'        => array(),
			'before'      => '',
			'after'       => '',
			'toggle'      => array( 'solid-toggle', 'video-toggle' ),
			'class'     => 'hide-if none',
		),
		// Background repeat
		array(
			'name'        => 'background_repeat',
			'title'       => '',
			'description' => __( 'Background Image Mode', 'themify' ),
			'type'        => 'dropdown',
			'meta'        => array(
				array(
					'value' => '',
					'name'  => ''
				),
				array(
					'value' => 'fullcover',
					'name'  => __( 'Fullcover', 'themify' )
				),
				array(
					'value' => 'repeat',
					'name'  => __( 'Repeat all', 'themify' )
				),
				array(
					'value' => 'no-repeat',
					'name'  => __( 'No repeat', 'themify' )
				),
				array(
					'value' => 'repeat-x',
					'name'  => __( 'Repeat horizontally', 'themify' )
				),
				array(
					'value' => 'repeat-y',
					'name'  => __( 'Repeat vertically', 'themify' )
				),
			),
			'toggle'      => array( 'solid-toggle', 'video-toggle' ),
			'class'     => 'hide-if none',
		),
		// Header wrap text color
		array(
			'name'        => 'headerwrap_text_color',
			'title'       => __( 'Header Text Color', 'themify' ),
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'class'     => 'hide-if none',
		),
		// Header wrap link color
		array(
			'name'        => 'headerwrap_link_color',
			'title'       => __( 'Header Link Color', 'themify' ),
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'class'     => 'hide-if none',
		),
		// Footer Separator
		array(
			'name' => 'footer_separator',
			'type' => 'separator',
			'meta' => array('html'=>'<hr />')
		),
		// Footer Design
		array(
			'name'        => 'footer_design',
			'title'       => __( 'Footer Design', 'themify' ),
			'description' => '',
			'type'        => 'layout',
			'show_title'  => true,
			'meta'        => $args['footer_design_options'],
			'hide'		  => 'none',
			'default' => 'default',
		),
		// Footer Elements
		array(
			'name' 	=> '_multi_footer_elements',	
			'title' => __('Footer Elements', 'themify'), 	
			'description' => '',	
			'type' 	=> 'multi',
			'class' => 'hide-if none',		
			'meta'	=> array(
				'fields' => array(
					// Show Site Logo
					array(
						'name' 	=> 'exclude_footer_site_logo',
						'description' => '',
						'title' => __( 'Site Logo', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Footer Widgets
					array(
						'name' 	=> 'exclude_footer_widgets',
						'description' => '',
						'title' => __( 'Footer Widgets', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Menu Navigation
					array(
						'name' 	=> 'exclude_footer_menu_navigation',
						'description' => '',
						'title' => __( 'Menu Navigation', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Texts
					array(
						'name' 	=> 'exclude_footer_texts',
						'description' => '',
						'title' => __( 'Footer Text', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Back to Top
					array(
						'name' 	=> 'exclude_footer_back',
						'description' => '',
						'title' => __( 'Back to Top Arrow', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png', 
							) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
				),
				'description' => '',
				'before' => '',
				'after' => '<div class="clear"></div>',
				'separator' => ''
			)
		),
				 // Footer widget position
		array(
			'name'        => 'footer_widget_position',
			'title'       => __( 'Footer Widgets Position', 'themify' ),
			'description' => '',
			'class' => 'hide-if none',
			'type'        => 'dropdown',
			'meta'        => array(
				array(
					'value' => '',
					'name'  => __( 'Default', 'themify' )
				),
				array(
					'value' => 'bottom',
					'name'  => __( 'After Footer Text', 'themify' )
				),
				array(
					'value' => 'top',
					'name'  => __( 'Before Footer Text', 'themify' )
				)
			),
		),
                // Image Filter Separator
		array(
			'name' => 'image_filter_separator',
			'type' => 'separator',
			'meta' => array('html'=>'<hr />')
		),
                // Image Filter
		array(
			'name'        => 'imagefilter_options',
			'title'       => __( 'Image Filter', 'themify' ),
			'description' => '',
			'type'        => 'dropdown',
			'meta'        => array(
				array( 'name' => '', 'value' => 'initial' ),
				array( 'name' => __( 'None', 'themify' ), 'value' => 'none' ),
				array( 'name' => __( 'Grayscale', 'themify' ), 'value' => 'grayscale' ),
				array( 'name' => __( 'Sepia', 'themify' ), 'value' => 'sepia' ),
				array( 'name' => __( 'Blur', 'themify' ), 'value' => 'blur' ),
			),
			'default' => 'initial',
		),
		// Image Hover Filter
		array(
			'name'        => 'imagefilter_options_hover',
			'title'       => __( 'Image Hover Filter', 'themify' ),
			'description' => '',
			'type'        => 'dropdown',
			'meta'        => array(
				array( 'name' => '', 'value' => 'initial' ),
				array( 'name' => __( 'None', 'themify' ), 'value' => 'none' ),
				array( 'name' => __( 'Grayscale', 'themify' ), 'value' => 'grayscale' ),
				array( 'name' => __( 'Sepia', 'themify' ), 'value' => 'sepia' ),
				array( 'name' => __( 'Blur', 'themify' ), 'value' => 'blur' ),
			),
			'default' => 'initial',
		),
		// Image Filter Apply To
		array(
			'name'        => 'imagefilter_applyto',
			'title'       => __( 'Apply Filter To', 'themify' ),
			'description' => sprintf( __( 'Theme Default = can be set in <a href="%s" target="_blank">Themify > Settings > Theme Settings</a>', 'themify' ), admin_url( 'admin.php?page=themify#setting-theme_settings' ) ),
			'type'        => 'radio',
			'meta'        => array(
				#array( 'value' => 'initial', 'name' => __( 'Theme Default', 'themify' )),
				array( 'value' => 'all', 'name' => __( 'All Images', 'themify' ), 'selected' => true ),
				array( 'value' => 'featured-only', 'name' => __( 'Featured Images Only', 'themify' ), )
			),
			'default' => 'all',
		),
	);
}

/**************************************************************************************************
 * Portfolio Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Portfolio' ) ) {

	class Themify_Portfolio {

		var $instance = 0;
		var $atts = array();
		var $post_type = 'portfolio';
		var $tax = 'portfolio-category';
		var $taxonomies;

		function __construct( $args = array() ) {
			add_action( 'save_post', array($this, 'set_default_term'), 100, 2 );
			add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );

			add_shortcode( $this->post_type, array( $this, 'init_shortcode' ) );
			add_shortcode( 'themify_' . $this->post_type . '_posts', array( $this, 'init_shortcode' ) );

			add_filter('themify_default_post_layout_condition', array( $this, 'post_layout_condition' ), 12);
			add_filter('themify_default_post_layout', array( $this, 'post_layout' ), 12);
			add_filter('themify_default_layout_condition', array( $this, 'layout_condition' ), 12);
			add_filter('themify_default_layout', array( $this, 'layout' ), 12);
		}

		/**
		 * Customize post type updated messages.
		 *
		 * @param $messages
		 *
		 * @return mixed
		 */
		function updated_messages( $messages ) {
			global $post;
						if(!$post){
							$post         = get_post();
						}
						$post_type        = $post->post_type;
			$post_type_object = get_post_type_object( $post_type );
			
			$view = get_permalink( $post->ID );

			$messages[ $this->post_type ] = array(
				0 => '',
				1 => sprintf( __('%s updated. <a href="%s">View %s</a>.', 'themify'), $post_type_object->labels->name, esc_url( $view ), $post_type_object->labels->name ),
				2 => __( 'Custom field updated.', 'themify' ),
				3 => __( 'Custom field deleted.', 'themify' ),
				4 => sprintf( __('%s updated.', 'themify'), $post_type_object->labels->name ),
				5 => isset( $_GET['revision'] ) ? sprintf( __( '%s restored to revision from %s', 'themify' ), $post_type_object->labels->name, wp_post_revision_title( ( int ) $_GET['revision'], false ) ) : false,
				6 => sprintf( __('%s published.', 'themify'), $post_type_object->labels->name ),
				7 => sprintf( __('%s saved.', 'themify'), $post_type_object->labels->name ),
				8 => sprintf( __('%s submitted.', 'themify'), $post_type_object->labels->name ),
				9 => sprintf( __( '%s scheduled for: <strong>%s</strong>.', 'themify' ),
					$post_type_object->labels->name, date_i18n( __( 'M j, Y @ G:i', 'themify' ), strtotime( $post->post_date ) ) ),
				10 => sprintf( __( '%s draft updated.', 'themify' ), $post_type_object->labels->name )
			);
			return $messages;
		}

		/**
		 * Set default term for custom taxonomy and assign to post
		 * @param number
		 * @param object
		 */
		function set_default_term( $post_id, $post ) {
			if ( 'publish' === $post->post_status ) {
				$terms = wp_get_post_terms( $post_id, $this->tax );
				if ( empty( $terms ) ) {
					wp_set_object_terms( $post_id, __( 'Uncategorized', 'themify' ), $this->tax );
				}
			}
		}

		/**
		 * Includes new post types registered in theme to array of post types managed by Themify
		 * @param array
		 * @return array
		 */
		function extend_post_types( $types ) {
			return array_merge( $types, array( $this->post_type ) );
		}

		/**
		 * Checks if the string begins with - like "-excluded"
		 *
		 * @param string $string String to check
		 *
		 * @return bool
		 */
		function is_negative_string( $string ) {
			return '-' === $string[0];
		}

		/**
		 * Checks if the string does not being with - like "included"
		 *
		 * @param string $string String to check
		 *
		 * @return bool
		 */
		function is_positive_string( $string ) {
			return '-' !== $string[0];
		}

		/**
		 * Parses the arguments given as category to see if they are category IDs or slugs and returns a proper tax_query
		 * @param $category
		 * @param $post_type
		 * @return array
		 */
		function parse_category_args( $category, $post_type ) {
			$tax_query = array();
			if ( 'all' != $category ) {
				$terms = explode(',', $category);
				if( preg_match( '#[a-z]#', $category ) ) {
					$include = array_filter( $terms, array( $this, 'is_positive_string' ) );
					$exclude = array_filter( $terms, array( $this, 'is_negative_string' ) );
					$field = 'slug';
				} else {
					$include = array_filter( $terms, 'themify_is_positive_number' );
					$exclude = array_map( 'themify_make_absolute_number', array_filter( $terms, 'themify_is_negative_number' ) );
					$field = 'id';
				}

				if ( !empty( $include ) && !empty( $exclude ) ) {
					$tax_query = array(
						'relation' => 'AND'
					);
				}
				if ( !empty( $include ) ) {
					$tax_query[] = array(
						'taxonomy' => $post_type . '-category',
						'field'    => $field,
						'terms'    => $include,
					);
				}
				if ( !empty( $exclude ) ) {
					$tax_query[] = array(
						'taxonomy' => $post_type . '-category',
						'field'    => $field,
						'terms'    => $exclude,
						'operator' => 'NOT IN',
					);
				}
			}
			return $tax_query;
		}

		/**
		 * Returns link wrapped in paragraph either to the post type archive page or a custom location
		 * @param bool|string $more_link False does nothing, true goes to archive page, custom string sets custom location
		 * @param string $more_text
		 * @param string $post_type
		 * @return string
		 */
		function section_link( $more_link = false, $more_text, $post_type ) {
			if ( $more_link ) {
				if ( 'true' == $more_link ) {
					$more_link = get_post_type_archive_link( $post_type );
				}
				return '<p class="more-link-wrap"><a href="' . esc_url( $more_link ) . '" class="more-link">' . $more_text . '</a></p>';
			}
			return '';
		}

		/**
		 * Returns class to add in columns when querying multiple entries
		 * @param string $style Entries layout
		 * @return string $col_class CSS class for column
		 */
		function column_class( $style ) {
			switch ( $style ) {
				case 'grid4':
					$col_class = 'col4-1';
					break;
				case 'grid3':
					$col_class = 'col3-1';
					break;
				case 'grid2':
					$col_class = 'col2-1';
					break;
				default:
					$col_class = '';
					break;
			}
			return $col_class;
		}

		/**
		 * Add shortcode to WP
		 * @param $atts Array shortcode attributes
		 * @return String
		 * @since 1.0.0
		 */
		function init_shortcode( $atts ) {
			$this->instance++;
			$this->atts = array(
				'id' => '',
				'title' => '',
				'unlink_title' => '',
				'image' => 'yes', // no
				'image_w' => 290,
				'image_h' => 290,
				'display' => 'none', // excerpt, content
				'post_meta' => '', // yes
				'post_date' => '', // yes
				'more_link' => false, // true goes to post type archive, and admits custom link
				'more_text' => __('More &rarr;', 'themify'),
				'limit' => 4,
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand
				'style' => 'grid4', // grid4, grid3, grid2
				'sorting' => 'no', // yes
				'paged' => '0', // internal use for pagination, dev: previously was 1
				'use_original_dimensions' => 'no', // yes
				'filter' => 'yes', // entry filter
				'visible' => '3',
				'scroll' => '1',
				'speed' => '1000', // integer, slow, normal, fast
				'autoplay' => 'off',
			);
			if ( ! isset( $atts['image_w'] ) || '' == $atts['image_w'] ) {
				if ( ! isset( $atts['style'] ) ) {
					$atts['style'] = 'grid3';
				}
				
				switch ( $atts['style'] ) {
					case 'list-post':
						$this->atts['image_w'] = 1160;
						$this->atts['image_h'] = 665;
						break;
					case 'grid4':
					case '':
						$this->atts['image_w'] = 260;
						$this->atts['image_h'] = 150;
						break;
					case 'grid3':
						$this->atts['image_w'] = 360;
						$this->atts['image_h'] = 205;
						break;
					case 'grid2':
						$this->atts['image_w'] = 561;
						$this->atts['image_h'] = 321;
						break;
					case 'list-large-image':
						$this->atts['image_w'] = 800;
						$this->atts['image_h'] = 460;
						break;
					case 'list-thumb-image':
						$this->atts['image_w'] = 260;
						$this->atts['image_h'] = 150;
						break;
					case 'grid2-thumb':
						$this->atts['image_w'] = 160;
						$this->atts['image_h'] = 95;
						break;
					case 'slider':
						$this->atts['image_w'] = 1280;
						$this->atts['image_h'] = 500;
						break;
				}
			}
			$shortcode_atts = shortcode_atts( $this->atts, $atts );
			return do_shortcode( $this->shortcode( $shortcode_atts, $this->post_type ) );
		}

		/**
		 * Main shortcode rendering
		 * @param array $atts
		 * @param $post_type
		 * @return string|void
		 */
		function shortcode($atts = array(), $post_type){
			extract($atts);
			// Pagination
			global $paged;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			// Parameters to get posts
			$args = array(
				'post_type' => $post_type,
				'posts_per_page' => $limit,
				'order' => $order,
				'orderby' => $orderby,
				'suppress_filters' => false,
				'paged' => $paged
			);
			// Category parameters
			$args['tax_query'] = $this->parse_category_args($category, $post_type);

			// Defines layout type
			$cpt_layout_class = $this->post_type.'-multiple clearfix type-multiple';
			$multiple = true;

			// Single post type or many single post types
			if( '' != $id ){
				if(strpos($id, ',')){
					$ids = explode(',', str_replace(' ', '', $id));
					foreach ($ids as $string_id) {
						$int_ids[] = intval($string_id);
					}
					$args['post__in'] = $int_ids;
					$args['orderby'] = 'post__in';
				} else {
					$args['p'] = intval($id);
					$cpt_layout_class = $this->post_type.'-single';
					$multiple = false;
				}
			}

			// Get posts according to parameters
			$portfolio_query = new WP_Query();
			$posts = $portfolio_query->query(apply_filters('themify_'.$post_type.'_shortcode_args', $args));

			// Grid Style
			if( '' == $style ){
				$style = themify_check('setting-default_portfolio_index_post_layout')?
							 themify_get('setting-default_portfolio_index_post_layout'):
							 'grid4';
			}

			if( is_singular('portfolio') ){
				if( '' == $image_w ){
					$image_w = themify_check('setting-default_portfolio_single_image_post_width')?
							themify_get('setting-default_portfolio_single_image_post_width'):
							'670';
				}
				if( '' == $image_h ){
					$image_h = themify_check('setting-default_portfolio_single_image_post_height')?
							themify_get('setting-default_portfolio_single_image_post_height'):
							'0';
				}
				if( '' == $post_date ){
					$post_date = themify_check('setting-default_portfolio_single_post_date')?
							themify_get('setting-default_portfolio_index_post_date'):
							'yes';
				}
				if( '' == $title ){
					$title = themify_check('setting-default_portfolio_single_title')?
							themify_get('setting-default_portfolio_single_title'):
							'yes';
				}
				if( '' == $unlink_title ){
					$unlink_title = themify_check('setting-default_portfolio_single_unlink_post_title')?
							themify_get('setting-default_portfolio_single_unlink_post_title'):
							'no';
				}
				if( '' == $post_meta ){
					$post_meta = themify_check('setting-default_portfolio_single_meta')?
							themify_get('setting-default_portfolio_single_meta'):
							'yes';
				}
			} else {
				if( '' == $image_w ){
					$image_w = themify_check('setting-default_portfolio_index_image_post_width')?
							themify_get('setting-default_portfolio_index_image_post_width'):
							'221';
				}
				if( '' == $image_h ){
					$image_h = themify_check('setting-default_portfolio_index_image_post_height')?
							themify_get('setting-default_portfolio_index_image_post_height'):
							'221';
				}
				if( '' == $title ){
					$title = themify_check('setting-default_portfolio_index_title')?
							themify_get('setting-default_portfolio_index_title'):
							'yes';
				}
				if( '' == $unlink_title ){
					$unlink_title = themify_check('setting-default_portfolio_index_unlink_post_title')?
							themify_get('setting-default_portfolio_index_unlink_post_title'):
							'no';
				}
				// Reverse logic
				if( '' == $post_date ){
					$post_date = themify_check('setting-default_portfolio_index_post_date')?
							'no' == themify_get('setting-default_portfolio_index_post_date')?
								'yes' : 'no':
							'no';
				}
				if( '' == $post_meta ){
					$post_meta = themify_check('setting-default_portfolio_index_post_meta_category')?
							'no' == themify_get('setting-default_portfolio_index_post_meta_category')? 'yes' : 'no' :
							'no';
				}
			}

			// Collect markup to be returned
			$out = '';

			if( $posts ) {
				global $themify;
				$themify_save = clone $themify; // save a copy

				// override $themify object
				$themify->hide_title = 'yes' == $title? 'no': 'yes';
				$themify->unlink_title =  ( '' == $unlink_title || 'no' == $unlink_title )? 'no' : 'yes';
				$themify->hide_image = 'yes' == $image? 'no': 'yes';
				$themify->hide_meta = 'yes' == $post_meta? 'no': 'yes';
				$themify->hide_date = 'yes' == $post_date? 'no': 'yes';
				if(!$multiple) {
					if( '' == $image_w || get_post_meta($args['p'], 'image_width', true ) ){
						$themify->width = get_post_meta($args['p'], 'image_width', true );
					}
					if( '' == $image_h || get_post_meta($args['p'], 'image_height', true ) ){
						$themify->height = get_post_meta($args['p'], 'image_height', true );
					}
				} else {
					$themify->width = $image_w;
					$themify->height = $image_h;
				}
				$themify->use_original_dimensions = 'yes' == $use_original_dimensions? 'yes': 'no';
				$themify->display_content = $display;
				$themify->more_link = $more_link;
				$themify->more_text = $more_text;
				$themify->post_layout = $style;
				$themify->portfolio_instance = $this->instance;
				$themify->is_shortcode = true;

				// Output entry filter
				if ( 'yes' == $filter && false === stripos( $style, 'slider' ) ) {
					$themify->shortcode_query_category = $category;
					$themify->shortcode_query_taxonomy = $this->tax;
					ob_start();
					get_template_part( 'includes/filter', $this->post_type );
					$out .= ob_get_contents();
					ob_end_clean();
				}

				$out .= '<div class="loops-wrapper shortcode ' . $post_type  . ' ' . $style . ' '. $cpt_layout_class .'">';

					// Slider wrapper
					if ( 'slider' === $style ) {
						switch ( $speed ) {
							case 'fast':
								$speed = '500';
							break;
							case 'normal':
								$speed = '1000';
							break;
							case 'slow':
								$speed = '4000';
							break;
						}
						$out .= '<div class="slideshow" data-id="loops-wrapper" data-autoplay="' . $autoplay . '" data-speed="' . $speed . '" data-scroll="' . $scroll . '" data-visible="' . $visible . '">';
							$out .= themify_get_shortcode_template($posts, 'includes/loop-portfolio', 'index');
						$out .= '</div>';
					} else {
						$out .= themify_get_shortcode_template($posts, 'includes/loop-portfolio', 'index');
					}

					$out .= $this->section_link($more_link, $more_text, $post_type);

				$out .= '</div>';

				$themify = clone $themify_save; // revert to original $themify state
				$themify->is_shortcode = false;
			}
						wp_reset_postdata();
			return $out;
		}

		/**************************************************************************************************
		 * Body Classes for Portfolio index and single
		 **************************************************************************************************/

		/**
		 * Changes condition to filter post layout class
		 * @param $condition
		 * @return bool
		 */
		function post_layout_condition($condition) {
			return $condition || is_tax('portfolio-category');
		}
		/**
		 * Returns modified post layout class
		 * @return string
		 */
		function post_layout() {
			global $themify;
			// get default layout
			$class = $themify->post_layout;
			if('portfolio' == $themify->query_post_type) {
				$class = themify_check('portfolio_layout') ? themify_get('portfolio_layout') : themify_get('setting-default_post_layout');
			} elseif (is_tax('portfolio-category')) {
				$class = themify_check('setting-default_portfolio_index_post_layout')? themify_get('setting-default_portfolio_index_post_layout') : 'list-post';
			}
			return $class;
		}

		/**
		 * Changes condition to filter sidebar layout class
		 *
		 * @param bool $condition
		 * @return bool
		 */
		function layout_condition( $condition ) {
			global $themify;
			// if layout is not set or is the home page and front page displays is set to latest posts
			return $condition || ( is_home() && 'posts' == get_option( 'show_on_front' ) ) || '' != $themify->query_category || is_tax( 'portfolio-category' ) || is_singular( 'portfolio' );
		}

		/**
		 * Returns modified sidebar layout class
		 *
		 * @param string $class Original body class
		 * @return string
		 */
		function layout( $class ) {
			global $themify;
			// get default layout
			$class = $themify->layout;
			if ( is_tax( 'portfolio-category' ) ) {
				$class = themify_check( 'setting-default_portfolio_index_layout' ) ? themify_get( 'setting-default_portfolio_index_layout' ) : 'sidebar-none';
			}
			return $class;
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
$GLOBALS['themify_portfolio'] = new Themify_Portfolio();

/**************************************************************************************************
 * Themify Theme Settings Module
 **************************************************************************************************/

if ( ! function_exists( 'themify_default_portfolio_single_layout' ) ) {
	/**
	 * Default Single Portfolio Layout
	 * @param array $data
	 * @return string
	 */
	function themify_default_portfolio_single_layout( $data=array() ) {
		/**
		 * Associative array containing theme settings
		 * @var array
		 */
		$data = themify_get_data();

		/**
		 * Variable prefix key
		 * @var string
		 */
		$prefix = 'setting-default_portfolio_single_';

		/**
		 * Basic default options '', 'yes', 'no'
		 * @var array
		 */
		$default_options = array(
			array('name'=>'','value'=>''),
			array('name'=>__('Yes', 'themify'),'value'=>'yes'),
			array('name'=>__('No', 'themify'),'value'=>'no')
		);
		
		/**
		 * Post Layout options
		 * @var array
		 */
		$post_layout = array(
			array('selected' => true, 'value' => 'fullwidth', 'img' => 'images/layout-icons/post-fullwidth.png', 'title' => __('Fullwidth', 'themify')),
			array('value' => 'slider', 'img' => 'images/layout-icons/post-slider.png', 'title' => __('Slider', 'themify')),
			array('value' => 'gallery', 'img' => 'images/layout-icons/post-gallery.png', 'title' => __('Gallery', 'themify')),
			array('value' => 'split', 'img' => 'images/layout-icons/post-split.png', 'title' => __('Split', 'themify'))
		);
		/**
         * Post Layout placement
         */
        $output = '<p>
						<span class="label">' . __('Portfolio Layout', 'themify') . '</span>';
        $val = themify_get($prefix . 'portfolio_layout_type');
        foreach ($post_layout as $option) {
            if (( $val == '' || !$val || !isset($val) ) && ( isset($option['selected']) && $option['selected'] )) {
                $val = $option['value'];
            }
            if ($val == $option['value']) {
                $class = 'selected';
            } else {
                $class = '';
            }
            $output .= '<a href="#" class="preview-icon ' . $class . '" title="' . $option['title'] . '"><img src="' . THEME_URI . '/' . $option['img'] . '" alt="' . $option['value'] . '"  /></a>';
        }
        $output .= '	<input type="hidden" name="' . $prefix . 'portfolio_layout_type" class="val" value="' . $val . '" />
					</p>';
		/**
		 * HTML for settings panel
		 * @var string
		 */
		$output.= '<p>
						<span class="label">' . __('Hide Portfolio Title', 'themify') . '</span>
						<select name="'.$prefix.'title">' .
							themify_options_module($default_options, $prefix.'title') . '
						</select>
					</p>';

		$output .=	'<p>
						<span class="label">' . __('Unlink Portfolio Title', 'themify') . '</span>
						<select name="'.$prefix.'unlink_post_title">' .
							themify_options_module($default_options, $prefix.'unlink_post_title') . '
						</select>
					</p>';

		// Hide Post Meta /////////////////////////////////////////
		$output .=	'<p>
						<span class="label">' . __('Hide Portfolio Meta', 'themify') . '</span>
						<select name="'.$prefix.'post_meta_category">' .
							themify_options_module($default_options, $prefix.'post_meta_category') . '
						</select>
					</p>';

		$output .= '<p>
						<span class="label">' . __( 'Unlink Portfolio Image', 'themify' ) . '</span>
						<select name="' . esc_attr( $prefix . 'unlink_post_image' ) . '">' . themify_options_module( $default_options, $prefix . 'unlink_post_image', true, 'yes' ) . '
						</select>
					</p>';
		/**
		 * Image Dimensions
		 */
		$output .= '
			<p>
				<span class="label">' . __('Image Size', 'themify') . '</span>
				<input type="text" class="width2" name="'.$prefix.'image_post_width" value="'.themify_get( $prefix.'image_post_width' ).'" /> ' . __('width', 'themify') . ' <small>(px)</small>
				<input type="text" class="width2 show_if_enabled_img_php" name="'.$prefix.'image_post_height" value="'.themify_get( $prefix.'image_post_height' ).'" /> <span class="show_if_enabled_img_php">' . __('height', 'themify') . ' <small>(px)</small></span>
			</p>';

		// Portfolio Navigation
		$prefix = 'setting-portfolio_nav_';
		$output .= '
			<p>
				<span class="label">' . __('Portfolio Navigation', 'themify') . '</span>
				<label for="'. $prefix .'disable">
					<input type="checkbox" id="'. $prefix .'disable" name="'. $prefix .'disable" '. checked( themify_get( $prefix.'disable' ), 'on', false ) .'/> ' . __('Remove portfolio navigation', 'themify') . '
				</label>
				<span class="pushlabel vertical-grouped">
				<label for="'. $prefix .'same_cat">
					<input type="checkbox" id="'. $prefix .'same_cat" name="'. $prefix .'same_cat" '. checked( themify_get( $prefix. 'same_cat' ), 'on', false ) .'/> ' . __('Show only portfolios in the same category', 'themify') . '
				</label>
				</span>
			</p>';

		return $output;
	}
}

if ( ! function_exists( 'themify_default_portfolio_index_layout' ) ) {
	/**
	 * Default Archive Portfolio Layout
	 * @param array $data
	 * @return string
	 */
	function themify_default_portfolio_index_layout( $data=array() ) {
		/**
		 * Associative array containing theme settings
		 * @var array
		 */
		$data = themify_get_data();
		/**
		 * Variable prefix key
		 * @var string
		 */
		$prefix = 'setting-default_portfolio_index_';
		/**
		 * Basic default options '', 'yes', 'no'
		 * @var array
		 */
		$default_options = array(
			array('name'=>'','value'=>''),
			array('name'=>__('Yes', 'themify'),'value'=>'yes'),
			array('name'=>__('No', 'themify'),'value'=>'no')
		);
		/**
		 * Default options 'yes', 'no'
		 * @var array
		 */
		$binary_options = array(
			array('name'=>__('Yes', 'themify'),'value'=>'yes'),
			array('name'=>__('No', 'themify'),'value'=>'no')
		);
		/**
		 * Sidebar Layout
		 * @var string
		 */
		$layout = isset( $data[$prefix.'layout'] ) ? $data[$prefix.'layout'] : '';
		/**
		 * Sidebar Layout Options
		 * @var array
		 */
		$sidebar_options = array(
			array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
			array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
			array('value' => 'sidebar2', 'img' => 'images/layout-icons/sidebar2.png', 'title' => __('Left and Right', 'themify')),
			array('value' => 'sidebar2 content-left', 	'img' => 'images/layout-icons/sidebar2-content-left.png', 'title' => __('2 Right Sidebars', 'themify')),
			array('value' => 'sidebar2 content-right', 	'img' => 'images/layout-icons/sidebar2-content-right.png', 'title' => __('2 Left Sidebars', 'themify')),
			array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'selected' => true, 'title' => __('No Sidebar', 'themify')),
		);
		/**
		 * Post Layout Options
		 * @var array
		 */
		$post_layout_options = array(
			array('value' => 'list-post', 'img' => 'images/layout-icons/list-post.png', 'title' => __( 'List Post', 'themify') ),
			array('value' => 'grid4', 'img' => 'images/layout-icons/grid4.png', 'title' => __( 'Grid 4', 'themify' )),
			array('value' => 'grid3', 'img' => 'images/layout-icons/grid3.png', 'title' => __( 'Grid 3', 'themify' ), 'selected' => true ),
			array('value' => 'grid2', 'img' => 'images/layout-icons/grid2.png', 'title' => __( 'Grid 2', 'themify') )
		);
		/**
		 * HTML for settings panel
		 * @var string
		 */
		$output = '<p>
						<span class="label">' . __('Portfolio Sidebar Option', 'themify') . '</span>';
						foreach($sidebar_options as $option){
							if ( ( '' == $layout || !$layout || ! isset( $layout ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) {
								$layout = $option['value'];
							}
							if($layout == $option['value']){
								$class = 'selected';
							} else {
								$class = '';
							}
							$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';
						}
						$output .= '<input type="hidden" name="'.$prefix.'layout" class="val" value="'.$layout.'" />';
		$output .= '</p>';
		/**
		 * Post Layout
		 */
		$output .= '<p>
						<span class="label">' . __('Portfolio Layout', 'themify') . '</span>';

						$val = isset( $data[$prefix.'post_layout'] ) ? $data[$prefix.'post_layout'] : '';

						foreach($post_layout_options as $option){
							if ( ( '' == $val || ! $val || ! isset( $val ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) {
								$val = $option['value'];
							}
							if ( $val == $option['value'] ) {
								$class = "selected";
							} else {
								$class = "";
							}
							$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';
						}

		$output .= '	<input type="hidden" name="'.$prefix.'post_layout" class="val" value="'.$val.'" />
					</p>';

		/**
		 * Enable Masonry
		 */
		$output .=	'<p>
						<span class="label">' . __('Post Masonry', 'themify') . '</span>
						<select name="setting-portfolio_disable_masonry">' .
							themify_options_module($binary_options, 'setting-portfolio_disable_masonry') . '
						</select>
					</p>';
					
		/**
		 * Display Content
		 */
		$output .= '<p>
						<span class="label">' . __('Display Content', 'themify') . '</span>
						<select name="'.$prefix.'display">'.
							themify_options_module(array(
								array('name' => __('None', 'themify'),'value'=>'none'),
								array('name' => __('Full Content', 'themify'),'value'=>'content'),
								array('name' => __('Excerpt', 'themify'),'value'=>'excerpt')
							), $prefix.'display').'
						</select>
					</p>';

		$output .= '<p>
						<span class="label">' . __('Hide Portfolio Title', 'themify') . '</span>
						<select name="'.$prefix.'title">' .
							themify_options_module($default_options, $prefix.'title') . '
						</select>
					</p>';

		$output .=	'<p>
						<span class="label">' . __('Unlink Portfolio Title', 'themify') . '</span>
						<select name="'.$prefix.'unlink_post_title">' .
							themify_options_module($default_options, $prefix.'unlink_post_title') . '
						</select>
					</p>';

		// Hide Post Meta /////////////////////////////////////////
		$output .=	'<p>
						<span class="label">' . __('Hide Portfolio Meta', 'themify') . '</span>
						<select name="'.$prefix.'post_meta_category">' .
							themify_options_module($default_options, $prefix.'post_meta_category', true, 'yes') . '
						</select>
					</p>';

		$output .= '<p>
						<span class="label">' . __( 'Unlink Portfolio Image', 'themify' ) . '</span>
						<select name="' . esc_attr( $prefix . 'unlink_post_image' ) . '">' . themify_options_module( $default_options, $prefix . 'unlink_post_image', true, 'yes' ) . '
						</select>
					</p>';
		/**
		 * Image Dimensions
		 */
		$output .= '<p>
						<span class="label">' . __('Image Size', 'themify') . '</span>
						<input type="text" class="width2" name="'.$prefix.'image_post_width" value="'.themify_get( $prefix.'image_post_width' ).'" /> ' . __('width', 'themify') . ' <small>(px)</small>
						<input type="text" class="width2 show_if_enabled_img_php" name="'.$prefix.'image_post_height" value="'.themify_get( $prefix.'image_post_height' ).'" /> <span class="show_if_enabled_img_php">' . __('height', 'themify') . ' <small>(px)</small></span>
					</p>';
		return $output;
	}
}

if ( ! function_exists( 'themify_portfolio_slug' ) ) {
	/**
	 * Portfolio Slug
	 * @param array $data
	 * @return string
	 */
	function themify_portfolio_slug($data=array()){
		$data = themify_get_data();
		$portfolio_slug = isset($data['themify_portfolio_slug'])? $data['themify_portfolio_slug']: apply_filters('themify_portfolio_rewrite', 'project');
		return '
			<p>
				<span class="label">' . __('Portfolio Base Slug', 'themify') . '</span>
				<input type="text" name="themify_portfolio_slug" value="'.$portfolio_slug.'" class="slug-rewrite">
				<br />
				<span class="pushlabel"><small>' . __('Use only lowercase letters, numbers, underscores and dashes.', 'themify') . '</small></span>
				<br />
				<span class="pushlabel"><small>' . sprintf(__('After changing this, go to <a href="%s">permalinks</a> and click "Save changes" to refresh them.', 'themify'), admin_url('options-permalink.php')) . '</small></span><br />
			</p>';
	}
}

/**
 * Creates portfolio slider module
 * @return string
 */
function themify_portfolio_slider() {
	return themify_generic_slider_controls('setting-portfolio_slider_');
}