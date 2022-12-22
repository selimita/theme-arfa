<?php
// Attachments Plugin Default Setup OFF
define( 'ATTACHMENTS_SETTINGS_SCREEN', false );
add_filter( 'attachments_default_instance', '__return_false' );

// CREATE Attachments Fields & Args FOR Slider
function arfa_attachments($attachments){
    $fields = array(
        array(
            'name'  => 'title',
            'type'  => 'text',
            'label' => __('Title','arfa'),
        ),
    );

    $args = array(
        'label'     => 'Arfa Attachments',
        'post_type' => array('post'),
        'filetype'  => array('image'),
        'note'      => 'Add Slider Image',
        'button_text' => __('Attach Files','arfa'),
        'fields'    => $fields,

    );

    $attachments->register('slider',$args);
}
add_action("attachments_register","arfa_attachments");

// CREATE Attachments Fields & Args FOR Testimonials
function arfa_attachments_testimonials($attachments){
    $fields = array(
        array(
            'name'  => 'name',
            'type'  => 'text',
            'label' => __('Name','arfa'),
        ),
        array(
            'name'  => 'designation',
            'type'  => 'text',
            'label' => __('Designation','arfa'),
        ),
        array(
            'name'  => 'company',
            'type'  => 'text',
            'label' => __('Company','arfa'),
        ),
        array(
            'name'  => 'testimonial',
            'type'  => 'textarea',
            'label' => __('Testimonial','arfa'),
        ),
    );

    $args = array(
        'label'     => 'Arfa Testimonials',
        'post_type' => array('page'),
        'filetype'  => array('image'),
        'note'      => 'Add Photo',
        'button_text' => __('Attach Photo','arfa'),
        'fields'    => $fields,

    );

    $attachments->register('testimonials',$args);
}
add_action("attachments_register","arfa_attachments_testimonials");