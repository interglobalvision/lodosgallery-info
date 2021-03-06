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
  		'name'      	=> __( 'Exhibition or Fair', 'cmb2' ),
  		'id'        	=> $prefix . 'home_post',
  		'type'      	=> 'post_search_ajax',
  		'desc'			=> __( '(Start typing title)', 'cmb2' ),
  		// Optional :
  		'limit'      	=> 1, 		// Limit selection to X items only (default 1)
  		'sortable' 	 	=> false, 	// Allow selected items to be sortable (default false)
  		'query_args'	=> array(
  			'post_type'			=> array( 'exhibition', 'fair' ),
  			'post_status'		=> array( 'publish' ),
  			'posts_per_page'	=> -1
  		)
  	) );

    $home_metabox->add_field( array(
      'name' => esc_html__( 'Default image', 'cmb2' ),
      'id'   => $prefix . 'home_image',
      'type' => 'file',
    ) );

    $home_metabox->add_field( array(
      'name' => esc_html__( 'Default text', 'cmb2' ),
      'id'   => $prefix . 'home_text',
      'type' => 'textarea',
    ) );

    $home_metabox->add_field( array(
      'name' => esc_html__( 'Image overlay color', 'cmb2' ),
      'id'   => $prefix . 'home_overlay_color',
      'type' => 'colorpicker',
      'default' => '#ffffff',
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

  // ARTIST

  $artist_metabox = new_cmb2_box( array(
 		'id'            => $prefix . 'artist_metabox',
 		'title'         => esc_html__( 'Details', 'cmb2' ),
 		'object_types'  => array( 'artist' ), // Post type
 	) );

  $artist_metabox->add_field( array(
		'name' => esc_html__( 'CV PDF English', 'cmb2' ),
		'id'   => $prefix . 'cv_pdf_en',
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

  $artist_metabox->add_field( array(
		'name' => esc_html__( 'CV PDF Español', 'cmb2' ),
		'id'   => $prefix . 'cv_pdf_es',
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

  $artist_metabox->add_field( array(
		'name' => esc_html__( 'Press PDF English', 'cmb2' ),
		'id'   => $prefix . 'press_pdf_en',
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

  $artist_metabox->add_field( array(
		'name' => esc_html__( 'Press PDF Español', 'cmb2' ),
		'id'   => $prefix . 'press_pdf_es',
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

  // DOCUMENTATION

  $documentation_metabox = new_cmb2_box( array(
 		'id'            => $prefix . 'documentation_metabox',
 		'title'         => esc_html__( 'Documentation', 'cmb2' ),
 		'object_types'  => array( 'exhibition', 'fair', 'publication', 'artist' ), // Post type
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
		'name' => esc_html__( 'Caption (English)', 'cmb2' ),
		'id'   => 'caption',
		'type' => 'wysiwyg',
    'options' => array(
	    'wpautop' => false, // use wpautop?
	    'media_buttons' => false, // show insert/upload button(s)
	    'textarea_rows' => 1, // rows="..."
  	),
	) );

  $documentation_metabox->add_group_field( $documentation_images_group, array(
		'name' => esc_html__( 'Caption (Español)', 'cmb2' ),
		'id'   => 'caption_es',
		'type' => 'wysiwyg',
    'options' => array(
	    'wpautop' => false, // use wpautop?
	    'media_buttons' => false, // show insert/upload button(s)
	    'textarea_rows' => 1, // rows="..."
  	),
	) );

  // ABOUT

  $about_page = get_page_by_path('about');

  if (!empty($about_page) ) {
    $about_metabox = new_cmb2_box( array(
      'id'            => $prefix . 'about_metabox',
      'title'         => esc_html__( 'Details', 'cmb2' ),
      'object_types'  => array( 'page' ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => array($about_page->ID) ),
    ) );

    $about_metabox->add_field( array(
      'name' => esc_html__( 'Email', 'cmb2' ),
      'id'   => $prefix . 'about_email',
      'type' => 'text_email',
    ) );

    $about_metabox->add_field( array(
      'name' => esc_html__( 'Phone', 'cmb2' ),
      'id'   => $prefix . 'about_phone',
      'type' => 'text',
    ) );

    $about_metabox->add_field( array(
      'name' => esc_html__( 'Hours', 'cmb2' ),
      'id'   => $prefix . 'about_hours',
      'type' => 'textarea_small',
      'attributes' => array(
        'data-cmb2-qtranslate' => true,
      ),
    ) );

    $about_metabox->add_field( array(
      'name' => esc_html__( 'Address', 'cmb2' ),
      'id'   => $prefix . 'about_address',
      'type' => 'textarea_small',
      'attributes' => array(
        'data-cmb2-qtranslate' => true,
      ),
    ) );

    $about_metabox->add_field( array(
      'name' => esc_html__( 'Google map link', 'cmb2' ),
      'id'   => $prefix . 'about_map_link',
      'type' => 'text_url',
    ) );

    $about_metabox->add_field( array(
      'name' => esc_html__( 'Google map embed', 'cmb2' ),
      'id'   => $prefix . 'about_map_embed',
      'type' => 'textarea_code',
    ) );

    $about_metabox->add_field( array(
  		'name' => esc_html__( 'Additional', 'cmb2' ),
  		'id'   => $prefix . 'about_etc',
  		'type' => 'wysiwyg',
      'options' => array(
  	    'wpautop' => false, // use wpautop?
  	    'media_buttons' => false, // show insert/upload button(s)
  	    'textarea_rows' => 5, // rows="..."
        'editor_class' => 'cmb2-qtranslate',
    	),
  	) );
  }

}
?>
