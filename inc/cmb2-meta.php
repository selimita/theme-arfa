<?php 
function arfa_meta_image() {

	$prefix = '_arfa_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'image_information',
		'title'        => __( 'Image Information', 'arfa' ),
		'object_types' => array( 'post' ),
		// 'context'      => 'normal',
		// 'priority'     => 'default',
    	'show_on'      => array( 
			'key' => 'post_format', 
			'value' => 'image' 
		),
    	'show_names'   => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name' => __( 'Camera Model', 'arfa' ),
		'id' => $prefix . 'camera_model',
		'type' => 'text',
		// 'default' => 'Canon',
	) );

	$cmb->add_field( array(
		'name' => __( 'Location', 'arfa' ),
		'id' => $prefix . 'location',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Date', 'arfa' ),
		'id' => $prefix . 'date',
		'type' => 'text_date',
	) );

	$cmb->add_field( array(
		'name' => __( 'Licensed', 'arfa' ),
		'id' => $prefix . 'licensed',
		'type' => 'checkbox',
	) );
	$cmb->add_field( array(
		'name' => __( 'Licensed Info', 'arfa' ),
		'id' => $prefix . 'licensed_info',
		'type' => 'text',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'licensed',
			// Works too: 'data-conditional-value' => 'on'.
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'CMB2 Image', 'arfa' ),
		'id' => $prefix . 'cmb2_image',
		'type' => 'file',
		'options' => array(
			'url' => false,
		),
	) );
	$cmb->add_field( array(
		'name' => __( 'Upload PDF File', 'arfa' ),
		'id' => $prefix . 'resume',
		'type' => 'file',
		'text' => array(
			'add_upload_file_text' => __('Upload','arfa'),
		),
		'query_args' => array(
			'type' => array('application/pdf'),
		),
		'options' => array(
			'url' => false,
		),
	) );

}
add_action( 'cmb2_admin_init', 'arfa_meta_image' );

// Pricing Table by CMB2 Metabox
function arfa_pricing() {

    $prefix = '_arfapt_';
	// CMB2 BOX
    $cmb = new_cmb2_box( array(
        'title'        => __( 'Pricing', 'alpha' ),
        'id'           => $prefix . 'pricing',
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'default',
    ) );
	// Group Field
	$group = $cmb->add_field( array(
		'name' => __( 'Pricing Table', 'alpha' ),
		'id'   => $prefix . 'pricing_table',
		'type' => 'group',
	) );
	// ADD Group Field
    $cmb->add_group_field( $group, array(
        'name'       => __( 'Caption', 'alpha' ),
        'id'         => $prefix . 'pricing_caption',
        'type'       => 'text',
    ) );

    $cmb->add_group_field( $group, array(
        'name'       => __( 'Pricing Option', 'alpha' ),
        'id'         => $prefix . 'pricing_option',
        'type'       => 'text',
        'repeatable' => true
    ) );

    $cmb->add_group_field( $group, array(
        'name'       => __( 'Price', 'alpha' ),
        'id'         => $prefix . 'price',
        'type'       => 'text',
    ) );

}

add_action( 'cmb2_admin_init', 'arfa_pricing' );

/**
 * Services
 */
add_action( 'cmb2_admin_init', 'arfa_services' );
function arfa_services() {
    $prefix = '_arfa_';
    $cmb = new_cmb2_box( array(
        'title'        => __( 'Arfa Services', 'alpha' ),
        'id'           => $prefix . 'arfa_services',
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'default',
    ) );
    $service = $cmb->add_field( array(
        'name' => __( 'Service', 'alpha' ),
        'id' => $prefix . 'service',
        'type' => 'group',
    ) );

    $cmb->add_group_field( $service, array(
        'name' => __( 'icon', 'alpha' ),
        'id' => $prefix . 'icon',
        'type' => 'text',
    ) );

    $cmb->add_group_field($service, array(
        'name' => __( 'title', 'alpha' ),
        'id' => $prefix . 'title',
        'type' => 'text',
    ) );
    $cmb->add_group_field($service, array(
        'name' => __( 'content', 'alpha' ),
        'id' => $prefix . 'content',
        'type' => 'text',
    ) );

}
