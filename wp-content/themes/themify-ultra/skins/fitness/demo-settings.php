<?php
$widgets = get_option( "widget_woocommerce_product_categories" );
$widgets[1002] = array (
  'title' => 'Product Categories',
  'orderby' => 'name',
  'dropdown' => 0,
  'count' => 0,
  'hierarchical' => 1,
  'show_children_only' => 0,
  'hide_empty' => 0,
);
update_option( "widget_woocommerce_product_categories", $widgets );

$widgets = get_option( "widget_woocommerce_products" );
$widgets[1003] = array (
  'title' => 'Products',
  'number' => 5,
  'show' => '',
  'orderby' => 'date',
  'order' => 'desc',
  'hide_free' => 0,
  'show_hidden' => 0,
);
update_option( "widget_woocommerce_products", $widgets );

$widgets = get_option( "widget_themify-social-links" );
$widgets[1004] = array (
  'title' => '',
  'show_link_name' => NULL,
  'open_new_window' => NULL,
  'icon_size' => 'icon-large',
  'orientation' => 'horizontal',
);
update_option( "widget_themify-social-links", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1005] = array (
  'title' => 'YORKDALE',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1006] = array (
  'title' => 'MAIN STATION',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1007] = array (
  'title' => 'YONGE/KING',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1008] = array (
  'title' => 'UNION',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1009] = array (
  'title' => 'DOWNTOWN',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1010] = array (
  'title' => 'QUEEN',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1011] = array (
  'title' => 'UPTOWN',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );

$widgets = get_option( "widget_text" );
$widgets[1012] = array (
  'title' => 'FINCH',
  'text' => 'No: 58 A, East Madison St<br>
Baltimore, MD, USA<br>
+1 200 258 2145',
  'filter' => false,
);
update_option( "widget_text", $widgets );



$sidebars_widgets = array (
  'sidebar-main' => 
  array (
    0 => 'woocommerce_product_categories-1002',
    1 => 'woocommerce_products-1003',
  ),
  'footer-social-widget' => 
  array (
    0 => 'themify-social-links-1004',
  ),
  'footer-widget-1' => 
  array (
    0 => 'text-1005',
    1 => 'text-1006',
  ),
  'footer-widget-2' => 
  array (
    0 => 'text-1007',
    1 => 'text-1008',
  ),
  'footer-widget-3' => 
  array (
    0 => 'text-1009',
    1 => 'text-1010',
  ),
  'footer-widget-4' => 
  array (
    0 => 'text-1011',
    1 => 'text-1012',
  ),
); 
update_option( "sidebars_widgets", $sidebars_widgets );

$menu_locations = array();
$menu = get_terms( "nav_menu", array( "slug" => "main-navigation" ) );
if( is_array( $menu ) && ! empty( $menu ) ) $menu_locations["main-nav"] = $menu[0]->term_id;
$menu = get_terms( "nav_menu", array( "slug" => "main-navigation" ) );
if( is_array( $menu ) && ! empty( $menu ) ) $menu_locations["footer-nav"] = $menu[0]->term_id;
set_theme_mod( "nav_menu_locations", $menu_locations );


$homepage = get_posts( array( 'name' => 'home', 'post_type' => 'page' ) );
			if( is_array( $homepage ) && ! empty( $homepage ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $homepage[0]->ID );
			}
			
	ob_start(); ?>a:184:{s:15:"setting-favicon";s:0:"";s:23:"setting-custom_feed_url";s:0:"";s:19:"setting-header_html";s:0:"";s:19:"setting-footer_html";s:0:"";s:23:"setting-search_settings";s:0:"";s:16:"setting-page_404";s:1:"0";s:21:"setting-feed_settings";s:0:"";s:21:"setting-webfonts_list";s:11:"recommended";s:24:"setting-webfonts_subsets";s:0:"";s:22:"setting-default_layout";s:8:"sidebar1";s:27:"setting-default_post_layout";s:9:"list-post";s:27:"setting-post_content_layout";s:0:"";s:23:"setting-disable_masonry";s:3:"yes";s:19:"setting-post_gutter";s:6:"gutter";s:30:"setting-default_layout_display";s:7:"content";s:25:"setting-default_more_text";s:4:"More";s:21:"setting-index_orderby";s:4:"date";s:19:"setting-index_order";s:4:"DESC";s:26:"setting-default_post_title";s:0:"";s:33:"setting-default_unlink_post_title";s:0:"";s:25:"setting-default_post_meta";s:0:"";s:32:"setting-default_post_meta_author";s:0:"";s:34:"setting-default_post_meta_category";s:0:"";s:33:"setting-default_post_meta_comment";s:0:"";s:29:"setting-default_post_meta_tag";s:0:"";s:25:"setting-default_post_date";s:0:"";s:30:"setting-default_media_position";s:5:"above";s:26:"setting-default_post_image";s:0:"";s:33:"setting-default_unlink_post_image";s:0:"";s:31:"setting-image_post_feature_size";s:5:"blank";s:24:"setting-image_post_width";s:0:"";s:25:"setting-image_post_height";s:0:"";s:32:"setting-default_page_post_layout";s:8:"sidebar1";s:37:"setting-default_page_post_layout_type";s:7:"classic";s:31:"setting-default_page_post_title";s:0:"";s:38:"setting-default_page_unlink_post_title";s:0:"";s:30:"setting-default_page_post_meta";s:0:"";s:37:"setting-default_page_post_meta_author";s:0:"";s:39:"setting-default_page_post_meta_category";s:0:"";s:38:"setting-default_page_post_meta_comment";s:0:"";s:34:"setting-default_page_post_meta_tag";s:0:"";s:30:"setting-default_page_post_date";s:0:"";s:31:"setting-default_page_post_image";s:0:"";s:38:"setting-default_page_unlink_post_image";s:0:"";s:38:"setting-image_post_single_feature_size";s:5:"blank";s:31:"setting-image_post_single_width";s:0:"";s:32:"setting-image_post_single_height";s:0:"";s:27:"setting-default_page_layout";s:8:"sidebar1";s:23:"setting-hide_page_title";s:0:"";s:23:"setting-hide_page_image";s:0:"";s:38:"setting-default_portfolio_index_layout";s:12:"sidebar-none";s:43:"setting-default_portfolio_index_post_layout";s:5:"grid3";s:33:"setting-portfolio_disable_masonry";s:3:"yes";s:39:"setting-default_portfolio_index_display";s:4:"none";s:37:"setting-default_portfolio_index_title";s:0:"";s:49:"setting-default_portfolio_index_unlink_post_title";s:0:"";s:50:"setting-default_portfolio_index_post_meta_category";s:3:"yes";s:49:"setting-default_portfolio_index_unlink_post_image";s:3:"yes";s:48:"setting-default_portfolio_index_image_post_width";s:0:"";s:49:"setting-default_portfolio_index_image_post_height";s:0:"";s:54:"setting-default_portfolio_single_portfolio_layout_type";s:9:"fullwidth";s:38:"setting-default_portfolio_single_title";s:0:"";s:50:"setting-default_portfolio_single_unlink_post_title";s:0:"";s:51:"setting-default_portfolio_single_post_meta_category";s:0:"";s:50:"setting-default_portfolio_single_unlink_post_image";s:3:"yes";s:49:"setting-default_portfolio_single_image_post_width";s:0:"";s:50:"setting-default_portfolio_single_image_post_height";s:0:"";s:22:"themify_portfolio_slug";s:7:"project";s:53:"setting-customizer_responsive_design_tablet_landscape";s:4:"1024";s:43:"setting-customizer_responsive_design_tablet";s:3:"768";s:43:"setting-customizer_responsive_design_mobile";s:3:"480";s:24:"setting-gallery_lightbox";s:8:"lightbox";s:20:"setting-color_design";s:7:"default";s:19:"setting-font_design";s:7:"default";s:21:"setting-header_design";s:17:"header-horizontal";s:28:"setting-exclude_site_tagline";s:2:"on";s:27:"setting-exclude_search_form";s:2:"on";s:19:"setting-exclude_rss";s:2:"on";s:30:"setting-exclude_header_widgets";s:2:"on";s:22:"setting-header_widgets";s:4:"none";s:21:"setting-footer_design";s:12:"footer-block";s:32:"setting-exclude_footer_site_logo";s:2:"on";s:27:"setting-exclude_footer_back";s:2:"on";s:22:"setting-footer_widgets";s:17:"footerwidget-4col";s:30:"setting-footer_widget_position";s:3:"top";s:27:"setting-imagefilter_options";s:0:"";s:33:"setting-imagefilter_options_hover";s:0:"";s:27:"setting-imagefilter_applyto";s:12:"featuredonly";s:25:"setting-page_loader_color";s:0:"";s:24:"setting-page_loader_icon";s:0:"";s:29:"setting-color_animation_speed";s:1:"5";s:20:"setting-color_stop_1";s:0:"";s:20:"setting-color_stop_2";s:0:"";s:20:"setting-color_stop_3";s:0:"";s:20:"setting-color_stop_4";s:0:"";s:20:"setting-color_stop_5";s:0:"";s:20:"setting-color_stop_6";s:0:"";s:20:"setting-color_stop_7";s:0:"";s:29:"setting-relationship_taxonomy";s:8:"category";s:37:"setting-relationship_taxonomy_entries";s:1:"3";s:45:"setting-relationship_taxonomy_display_content";s:4:"none";s:30:"setting-single_slider_autoplay";s:3:"off";s:27:"setting-single_slider_speed";s:6:"normal";s:28:"setting-single_slider_effect";s:5:"slide";s:28:"setting-single_slider_height";s:4:"auto";s:18:"setting-more_posts";s:8:"infinite";s:19:"setting-entries_nav";s:8:"numbered";s:24:"setting-footer_text_left";s:0:"";s:25:"setting-footer_text_right";s:0:"";s:27:"setting-global_feature_size";s:5:"blank";s:22:"setting-link_icon_type";s:9:"font-icon";s:32:"setting-link_type_themify-link-0";s:10:"image-icon";s:33:"setting-link_title_themify-link-0";s:7:"Twitter";s:32:"setting-link_link_themify-link-0";s:0:"";s:31:"setting-link_img_themify-link-0";s:107:"https://themify.me/demo/themes/ultra-fitness/wp-content/themes/themify-ultra/themify/img/social/twitter.png";s:32:"setting-link_type_themify-link-1";s:10:"image-icon";s:33:"setting-link_title_themify-link-1";s:8:"Facebook";s:32:"setting-link_link_themify-link-1";s:0:"";s:31:"setting-link_img_themify-link-1";s:108:"https://themify.me/demo/themes/ultra-fitness/wp-content/themes/themify-ultra/themify/img/social/facebook.png";s:32:"setting-link_type_themify-link-2";s:10:"image-icon";s:33:"setting-link_title_themify-link-2";s:7:"Google+";s:32:"setting-link_link_themify-link-2";s:0:"";s:31:"setting-link_img_themify-link-2";s:111:"https://themify.me/demo/themes/ultra-fitness/wp-content/themes/themify-ultra/themify/img/social/google-plus.png";s:32:"setting-link_type_themify-link-3";s:10:"image-icon";s:33:"setting-link_title_themify-link-3";s:7:"YouTube";s:32:"setting-link_link_themify-link-3";s:0:"";s:31:"setting-link_img_themify-link-3";s:107:"https://themify.me/demo/themes/ultra-fitness/wp-content/themes/themify-ultra/themify/img/social/youtube.png";s:32:"setting-link_type_themify-link-4";s:10:"image-icon";s:33:"setting-link_title_themify-link-4";s:9:"Pinterest";s:32:"setting-link_link_themify-link-4";s:0:"";s:31:"setting-link_img_themify-link-4";s:109:"https://themify.me/demo/themes/ultra-fitness/wp-content/themes/themify-ultra/themify/img/social/pinterest.png";s:32:"setting-link_type_themify-link-5";s:9:"font-icon";s:33:"setting-link_title_themify-link-5";s:7:"Twitter";s:32:"setting-link_link_themify-link-5";s:27:"https://twitter.com/themify";s:33:"setting-link_ficon_themify-link-5";s:10:"fa-twitter";s:35:"setting-link_ficolor_themify-link-5";s:0:"";s:37:"setting-link_fibgcolor_themify-link-5";s:0:"";s:32:"setting-link_type_themify-link-6";s:9:"font-icon";s:33:"setting-link_title_themify-link-6";s:8:"Facebook";s:32:"setting-link_link_themify-link-6";s:28:"https://facebook.com/themify";s:33:"setting-link_ficon_themify-link-6";s:11:"fa-facebook";s:35:"setting-link_ficolor_themify-link-6";s:0:"";s:37:"setting-link_fibgcolor_themify-link-6";s:0:"";s:32:"setting-link_type_themify-link-7";s:9:"font-icon";s:33:"setting-link_title_themify-link-7";s:7:"Google+";s:32:"setting-link_link_themify-link-7";s:0:"";s:33:"setting-link_ficon_themify-link-7";s:14:"fa-google-plus";s:35:"setting-link_ficolor_themify-link-7";s:0:"";s:37:"setting-link_fibgcolor_themify-link-7";s:0:"";s:32:"setting-link_type_themify-link-8";s:9:"font-icon";s:33:"setting-link_title_themify-link-8";s:7:"YouTube";s:32:"setting-link_link_themify-link-8";s:32:"https://youtube.com/user/themify";s:33:"setting-link_ficon_themify-link-8";s:10:"fa-youtube";s:35:"setting-link_ficolor_themify-link-8";s:0:"";s:37:"setting-link_fibgcolor_themify-link-8";s:0:"";s:32:"setting-link_type_themify-link-9";s:9:"font-icon";s:33:"setting-link_title_themify-link-9";s:9:"Pinterest";s:32:"setting-link_link_themify-link-9";s:0:"";s:33:"setting-link_ficon_themify-link-9";s:12:"fa-pinterest";s:35:"setting-link_ficolor_themify-link-9";s:0:"";s:37:"setting-link_fibgcolor_themify-link-9";s:0:"";s:22:"setting-link_field_ids";s:341:"{"themify-link-0":"themify-link-0","themify-link-1":"themify-link-1","themify-link-2":"themify-link-2","themify-link-3":"themify-link-3","themify-link-4":"themify-link-4","themify-link-5":"themify-link-5","themify-link-6":"themify-link-6","themify-link-7":"themify-link-7","themify-link-8":"themify-link-8","themify-link-9":"themify-link-9"}";s:23:"setting-link_field_hash";s:2:"10";s:30:"setting-page_builder_is_active";s:6:"enable";s:26:"setting-page_builder_cache";s:7:"disable";s:27:"setting-page_builder_expiry";s:1:"2";s:55:"setting-page_builder_responsive_design_tablet_landscape";s:4:"1024";s:45:"setting-page_builder_responsive_design_tablet";s:3:"768";s:45:"setting-page_builder_responsive_design_mobile";s:3:"680";s:22:"setting-google_map_key";s:0:"";s:23:"setting-hooks_field_ids";s:2:"[]";s:27:"setting-custom_panel-editor";s:7:"default";s:27:"setting-custom_panel-author";s:7:"default";s:32:"setting-custom_panel-contributor";s:7:"default";s:25:"setting-customizer-editor";s:7:"default";s:25:"setting-customizer-author";s:7:"default";s:30:"setting-customizer-contributor";s:7:"default";s:22:"setting-backend-editor";s:7:"default";s:22:"setting-backend-author";s:7:"default";s:27:"setting-backend-contributor";s:7:"default";s:23:"setting-frontend-editor";s:7:"default";s:23:"setting-frontend-author";s:7:"default";s:28:"setting-frontend-contributor";s:7:"default";s:4:"skin";s:100:"https://themify.me/demo/themes/ultra-fitness/wp-content/themes/themify-ultra/skins/fitness/style.css";}<?php $themify_data = unserialize( ob_get_clean() );

	// fix the weird way "skin" is saved
	if( isset( $themify_data['skin'] ) ) {
		$parsed_skin = parse_url( $themify_data['skin'], PHP_URL_PATH );
		$basedir_skin = basename( dirname( $parsed_skin ) );
		$themify_data['skin'] = trailingslashit( get_template_directory_uri() ) . 'skins/' . $basedir_skin . '/style.css';
	}

	themify_set_data( $themify_data );
	?>