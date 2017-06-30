<?php
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Template Fancy Heading
 * 
 * Access original fields: $mod_settings
 * @author Themify
 */
$fields_default = array(
	'heading' => '',
	'heading_tag' => 'h1',
	'sub_heading' => '',
	'animation_effect' => ''
);

$fields_args = wp_parse_args( $mod_settings, $fields_default );
extract( $fields_args, EXTR_SKIP );
$animation_effect = $this->parse_animation_effect( $animation_effect, $fields_args );

$container_class = implode(' ', apply_filters('themify_builder_module_classes', array(
	'module', 'module-' . $mod_name, $module_ID, $animation_effect
	), $mod_name, $module_ID, $fields_args)
);
$container_props = apply_filters( 'themify_builder_module_container_props', array(
        'id' => $module_ID,
        'class' => $container_class
    ), $fields_args, $mod_name, $module_ID );
?>
<!-- module fancy heading -->
<div<?php echo $this->get_element_attributes( $container_props ); ?>>

	<?php if( $heading_tag == 'h1' ) : ?>
		<h1 class="fancy-heading">
			<span class="maketable">
				<span class="addBorder"></span>
				<span class="fork-icon"></span>
				<span class="addBorder"></span>
			</span>
			<em class="sub-head"><?php echo $sub_heading; ?></em>
			<span class="heading main-head"><?php echo $heading; ?></span>
			<span class="bottomBorder"></span>
		</h1>
	<?php else : ?>
		<h2 class="fancy-heading">
			<span class="maketable">
				<span class="addBorder"></span>
				<em class="sub-head"><?php echo $sub_heading; ?></em>
				<span class="addBorder"></span>
			</span>
			<span class="heading main-head"><?php echo $heading; ?></span>
			<span class="maketable">
				<span class="addBorder"></span>
				<span class="fork-icon"></span>
				<span class="addBorder"></span>
			</span>
		</h2>
	<?php endif; ?>
</div>
<!-- /module fancy heading -->