<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
  $args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
  ) );
  $posts = get_posts( $args );
  $post_options = array();
  if ( $posts ) {
    foreach ( $posts as $post ) {
      $post_options [ $post->ID ] = $post->post_title;
    }
  }
  return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  /**
   * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
   */


  // HOME

  $home_page = get_page_by_path('home');

  if (!empty($home_page) ) {

    $home_metabox = new_cmb2_box( array(
      'id'            => $prefix . 'home_metabox',
      'title'         => esc_html__( 'Options', 'cmb2' ),
      'object_types'  => array( 'page' ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => array($home_page->ID) ),
    ) );

    $home_metabox->add_field( array(
      'name' => esc_html__( 'Default image', 'cmb2' ),
      'id'   => $prefix . 'home_image',
      'type' => 'file',
    ) );

  }

  // EXHIBITION

  $exhibition_metabox = new_cmb2_box( array(
 		'id'            => $prefix . 'exhibition_metabox',
 		'title'         => esc_html__( 'Details', 'cmb2' ),
 		'object_types'  => array( 'exhibition', 'fair' ), // Post type
 	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Start Date', 'cmb2' ),
		'id'   => $prefix . 'exhibition_start',
		'type' => 'text_date_timestamp',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'End Date', 'cmb2' ),
		'id'   => $prefix . 'exhibition_end',
		'type' => 'text_date_timestamp',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Exhibition title', 'cmb2' ),
		'id'   => $prefix . 'exhibition_title',
		'type' => 'text',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Artist(s)', 'cmb2' ),
		'id'   => $prefix . 'exhibition_artist',
		'type' => 'text',
    'repeatable' => true,
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Group show', 'cmb2' ),
		'id'   => $prefix . 'exhibition_group',
		'type' => 'checkbox',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Dates', 'cmb2' ),
		'id'   => $prefix . 'exhibition_dates',
		'type' => 'text',
    'attributes' => array(
      'data-cmb2-qtranslate' => true,
    ),
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Press Release PDF English', 'cmb2' ),
		'id'   => $prefix . 'exhibition_pdf_en',
		'type' => 'file',
    'options' => array(
  		'url' => false, // Hide the text input for the url
  	),
    'text'    => array(
  		'add_upload_file_text' => 'Add PDF'
  	),
  	// query_args are passed to wp.media's library query.
  	'query_args' => array(
  		'type' => 'application/pdf', // Make library only display PDFs.
  	),
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Press Release PDF Español', 'cmb2' ),
		'id'   => $prefix . 'exhibition_pdf_es',
		'type' => 'file',
    'options' => array(
  		'url' => false, // Hide the text input for the url
  	),
    'text'    => array(
  		'add_upload_file_text' => 'Add PDF'
  	),
  	// query_args are passed to wp.media's library query.
  	'query_args' => array(
  		'type' => 'application/pdf', // Make library only display PDFs.
  	),
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Home image', 'cmb2' ),
		'id'   => $prefix . 'exhibition_home_image',
		'type' => 'file',
    'options' => array(
  		'url' => false, // Hide the text input for the url
  	),
  	// query_args are passed to wp.media's library query.
  	'query_args' => array(
  		'type' => array(
  		 	'image/gif',
  		 	'image/jpeg',
  		 	'image/png',
  		),
  	),
	) );

  // DOCUMENTATION

  $documentation_metabox = new_cmb2_box( array(
 		'id'            => $prefix . 'documentation_metabox',
 		'title'         => esc_html__( 'Documentation', 'cmb2' ),
 		'object_types'  => array( 'exhibition', 'fair', 'publication' ), // Post type
 	) );

  $documentation_images_group = $documentation_metabox->add_field( array(
		'id'          => $prefix . 'documentation_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Image {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Image', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Image', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

  $documentation_metabox->add_group_field( $documentation_images_group, array(
		'name' => esc_html__( 'Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
    'options' => array(
  		'url' => false, // Hide the text input for the url
  	),
    'query_args' => array(
  		'type' => array(
  		 	'image/gif',
  		 	'image/jpeg',
  		 	'image/png',
  		),
  	),
	) );

  $documentation_metabox->add_group_field( $documentation_images_group, array(
		'name' => esc_html__( 'Vimeo ID', 'cmb2' ),
		'id'   => 'vimeo_id',
		'type' => 'text_small',
	) );

  $documentation_metabox->add_group_field( $documentation_images_group, array(
		'name' => esc_html__( 'Caption', 'cmb2' ),
		'id'   => 'caption',
		'type' => 'wysiwyg',
    'options' => array(
	    'wpautop' => false, // use wpautop?
	    'media_buttons' => false, // show insert/upload button(s)
	    'textarea_rows' => 1, // rows="..."
	    'teeny' => true, // output the minimal editor config used in Press This
	    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
  	),
	) );

}
?>
