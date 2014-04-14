<?php
/*
 * Creation of Sermon Post Types and Taxonomies
 * Also all meta boxes
 */
 
// Determine the correct slug name based on options
function generate_wpfc_slug($slug_name = NULL) {
    $sermon_settings = get_option('wpfc_options');
    $archive_slug = $sermon_settings['archive_slug'];
    if(empty($archive_slug)) {
    	$archive_slug = 'sermons';
    }

    if (!isset($slug_name)) {
    	return array ('slug' => $archive_slug, 'with_front' => false);
    }

    if (isset($sermon_settings['common_base_slug']) == '1') {
    	return array ('slug' => $archive_slug."/".$slug_name, 'with_front' => false);
    } else {
    	return array ('slug' => $slug_name, 'with_front' => false);
    }
}

 // Create sermon Custom Post Type
add_action('init', 'create_wpfc_sermon_types');
function create_wpfc_sermon_types() {
  
  $labels = array(
    'name' 					=> __( 'Sermons', 					'sermon-manager' ),
    'singular_name' 		=> __( 'Sermon', 					'sermon-manager' ),
    'add_new' 				=> __( 'Add New', 					'sermon-manager' ),
    'add_new_item' 			=> __( 'Add New Sermon', 			'sermon-manager' ),
    'edit_item' 			=> __( 'Edit Sermon', 				'sermon-manager' ),
    'new_item' 				=> __( 'New Sermon', 				'sermon-manager' ),
    'view_item' 			=> __( 'View Sermon', 				'sermon-manager' ),
    'search_items' 			=> __( 'Search Sermons', 			'sermon-manager' ),
    'not_found' 			=> __( 'No sermons found', 			'sermon-manager' ),
    'not_found_in_trash' 	=> __( 'No sermons found in Trash', 'sermon-manager' ),
    'menu_name' 			=> __( 'Sermons', 					'sermon-manager' ),
  );

  $args = array(
    'labels' 				=> $labels,
    'public' 				=> true,
    'publicly_queryable' 	=> true,
    'show_ui' 				=> true,
    'show_in_menu' 			=> true,
    'query_var' 			=> true,
    'menu_icon' 			=> SM_PLUGIN_URL.'includes/img/book-open-bookmark.png',
	'capability_type' 		=> 'post',
    'has_archive' 			=> true,
    'rewrite' 				=> generate_wpfc_slug(),
    'hierarchical' 			=> false,
    'supports' 				=> array( 'title', 'comments', 'thumbnail', 'entry-views' )
  ); 
  register_post_type('wpfc_sermon',$args);
}

//create new taxonomies: preachers, sermon series, bible books & topics
add_action( 'init', 'create_wpfc_sermon_taxonomies', 0 );
function create_wpfc_sermon_taxonomies() {

//Preachers
$labels = array(	
	'name' 							=> __( 'Preachers', 								'sermon-manager' ),
	'singular_name' 				=> __( 'Preacher', 									'sermon-manager' ),
	'menu_name' 					=> __( 'Preachers', 								'sermon-manager' ),
	'search_items' 					=> __( 'Search preachers', 							'sermon-manager' ),
	'popular_items' 				=> __( 'Most frequent preachers', 					'sermon-manager' ),
	'all_items' 					=> __( 'All preachers', 							'sermon-manager' ),
	'edit_item' 					=> __( 'Edit preachers', 							'sermon-manager' ),
	'update_item' 					=> __( 'Update preachers', 							'sermon-manager' ),
	'add_new_item' 					=> __( 'Add new preacher', 							'sermon-manager' ),
	'new_item_name' 				=> __( 'New preacher name', 						'sermon-manager' ),
	'separate_items_with_commas' 	=> __( 'Separate multiple preachers with commas', 	'sermon-manager' ),
	'add_or_remove_items' 			=> __( 'Add or remove preachers', 					'sermon-manager' ),
	'choose_from_most_used' 		=> __( 'Choose from most frequent preachers', 		'sermon-manager' ),
	'parent_item' 					=> null,
    'parent_item_colon' 			=> null,
);

register_taxonomy('wpfc_preacher','wpfc_sermon', array(
	'hierarchical' 	=> false,
	'labels' 		=> $labels,
	'show_ui' 		=> true,
	'query_var' 	=> true,
    'rewrite' 		=> generate_wpfc_slug('preacher'),
));

//Sermon Series
$labels = array(	
	'name' 							=> __( 'Sermon Series', 						'sermon-manager' ),
	'singular_name' 				=> __( 'Sermon Series', 						'sermon-manager' ),
	'menu_name' 					=> __( 'Sermon Series', 						'sermon-manager' ),
	'search_items' 					=> __( 'Search sermon series', 					'sermon-manager' ),
	'popular_items' 				=> __( 'Most frequent sermon series', 			'sermon-manager' ),
	'all_items' 					=> __( 'All sermon series', 					'sermon-manager' ),
	'edit_item' 					=> __( 'Edit sermon series', 					'sermon-manager' ),
	'update_item' 					=> __( 'Update sermon series', 					'sermon-manager' ),
	'add_new_item' 					=> __( 'Add new sermon series', 				'sermon-manager' ),
	'new_item_name' 				=> __( 'New sermon series name', 				'sermon-manager' ),
	'separate_items_with_commas' 	=> __( 'Separate sermon series with commas', 	'sermon-manager' ),
	'add_or_remove_items' 			=> __( 'Add or remove sermon series', 			'sermon-manager' ),
	'choose_from_most_used' 		=> __( 'Choose from most used sermon series', 	'sermon-manager' ),
	'parent_item' 					=> null,
    'parent_item_colon' 			=> null,
);

register_taxonomy('wpfc_sermon_series','wpfc_sermon', array(
	'hierarchical' 	=> false,
	'labels' 		=> $labels,
	'show_ui' 		=> true,
	'query_var' 	=> true,
    'rewrite' 		=> generate_wpfc_slug('series'),
));

//Sermon Topics
$labels = array(	
	'name' 							=> __( 'Sermon Topics', 						'sermon-manager' ),
	'singular_name' 				=> __( 'Sermon Topics', 						'sermon-manager' ),
	'menu_name' 					=> __( 'Sermon Topics', 						'sermon-manager' ),
	'search_items' 					=> __( 'Search sermon topics', 					'sermon-manager' ),
	'popular_items' 				=> __( 'Most popular sermon topics', 			'sermon-manager' ),
	'all_items' 					=> __( 'All sermon topics', 					'sermon-manager' ),
	'edit_item' 					=> __( 'Edit sermon topic', 					'sermon-manager' ),
	'update_item' 					=> __( 'Update sermon topic', 					'sermon-manager' ),
	'add_new_item' 					=> __( 'Add new sermon topic', 					'sermon-manager' ),
	'new_item_name' 				=> __( 'New sermon topic', 						'sermon-manager' ),
	'separate_items_with_commas' 	=> __( 'Separate sermon topics with commas', 	'sermon-manager' ),
	'add_or_remove_items' 			=> __( 'Add or remove sermon topics', 			'sermon-manager' ),
	'choose_from_most_used' 		=> __( 'Choose from most used sermon topics', 	'sermon-manager' ),
	'parent_item' 					=> null,
    'parent_item_colon' 			=> null,
);

register_taxonomy('wpfc_sermon_topics','wpfc_sermon', array(
	'hierarchical' 	=> false,
	'labels' 		=> $labels,
	'show_ui' 		=> true,
	'query_var' 	=> true,
    'rewrite' 		=> generate_wpfc_slug('topics'),
));

//Books of the Bible
$labels = array(	
	'name' 							=> __( 'Book of the Bible', 						'sermon-manager' ),
	'singular_name' 				=> __( 'Book of the Bible', 						'sermon-manager' ),
	'menu_name' 					=> __( 'Book of the Bible', 						'sermon-manager' ),
	'search_items' 					=> __( 'Search books of the Bible', 				'sermon-manager' ),
	'popular_items' 				=> __( 'Most popular books of the Bible', 			'sermon-manager' ),
	'all_items' 					=> __( 'All books of the Bible', 					'sermon-manager' ),
	'edit_item' 					=> __( 'Edit book of the Bible', 					'sermon-manager' ),
	'update_item' 					=> __( 'Update book of the Bible', 					'sermon-manager' ),
	'add_new_item' 					=> __( 'Add new books of the Bible', 				'sermon-manager' ),
	'new_item_name' 				=> __( 'New book of the Bible', 					'sermon-manager' ),
	'separate_items_with_commas' 	=> __( 'Separate books of the Bible with commas', 	'sermon-manager' ),
	'add_or_remove_items' 			=> __( 'Add or remove books of the Bible', 			'sermon-manager' ),
	'choose_from_most_used' 		=> __( 'Choose from most used books of the Bible', 	'sermon-manager' ),
	'parent_item' 					=> null,
    'parent_item_colon' 			=> null,
);

register_taxonomy('wpfc_bible_book','wpfc_sermon', array(
	'hierarchical' 	=> false,
	'labels' 		=> $labels,
	'show_ui' 		=> true,
	'query_var' 	=> true,
    'rewrite' 		=> generate_wpfc_slug('book'),
));

//Service Type
$labels = array(	
	'name' 							=> __( 'Service Type', 							'sermon-manager' ),
	'singular_name' 				=> __( 'Service Type', 							'sermon-manager' ),
	'menu_name' 					=> __( 'Service Type', 							'sermon-manager' ),
	'search_items' 					=> __( 'Search service types', 					'sermon-manager' ),
	'popular_items' 				=> __( 'Most popular service types', 			'sermon-manager' ),
	'all_items' 					=> __( 'All service types', 					'sermon-manager' ),
	'edit_item'						=> __( 'Edit service type', 					'sermon-manager' ),
	'update_item' 					=> __( 'Update service type', 					'sermon-manager' ),
	'add_new_item' 					=> __( 'Add new service types', 				'sermon-manager' ),
	'new_item_name' 				=> __( 'New Service Type', 						'sermon-manager' ),
	'separate_items_with_commas' 	=> __( 'Separate service types with commas', 	'sermon-manager' ),
	'add_or_remove_items' 			=> __( 'Add or remove service types', 			'sermon-manager' ),
	'choose_from_most_used' 		=> __( 'Choose from most used service types', 	'sermon-manager' ),
	'parent_item' 					=> null,
    'parent_item_colon' 			=> null,
);

register_taxonomy('wpfc_service_type','wpfc_sermon', array(
	'hierarchical' 	=> false,
	'labels' 		=> $labels,
	'show_ui' 		=> true,
	'query_var' 	=> true,
    'rewrite' 		=> generate_wpfc_slug('service-type'),
));
}

// Initialize the metabox class.
add_action( 'init', 'initialize_wpfc_sermon_meta_boxes', 9999 );
function initialize_wpfc_sermon_meta_boxes() {
	require_once plugin_dir_path( __FILE__ ) . '/meta-box/init.php';	
}

add_filter( 'wpfc_meta_boxes', 'wpfc_sermon_metaboxes' );
// Define the metabox and field configurations.
function wpfc_sermon_metaboxes( array $meta_boxes ) {

	$meta_boxes[] = array(
		'id'         => 'wpfc_sermon_details',
		'title'      => __('Sermon Details', 'sermon-manager'),
		'pages'      => array( 'wpfc_sermon', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Date', 'sermon-manager'),
				'desc' => __('Enter the date the sermon was given. <strong>NOTE: Each sermon must have a date!</strong>', 'sermon-manager'),
				'id'   => 'sermon_date',
				'type' => 'text_date_timestamp',
			),
			array(
				'name'    => __('Service Type', 'sermon-manager'),
				'desc'    => __('Select the type of service. Modify service types in Sermons -> Service Types.', 'sermon-manager'),
				'id'      => 'wpfc_service_type_select',
				'type'    => 'taxonomy_select',
				'taxonomy' => 'wpfc_service_type',
			),
			array(
				'name' => __('Main Bible Passage', 'sermon-manager'),
				'desc' => __('Enter the Bible passage with the full book names,e.g. "John 3:16-18".', 'sermon-manager'),
				'id'   => 'bible_passage',
				'type' => 'text',
			),
			array(
				'name' => __('Description', 'sermon-manager'),
				'desc' => __('Type a brief description about this sermon, an outline, or a full manuscript', 'sermon-manager'),
				'id'   => 'sermon_description',
				'type' => 'wysiwyg',
				'options' => array(	'textarea_rows' => 7, 'media_buttons' => false,),
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'wpfc_sermon_files',
		'title'      => __('Sermon Files', 'sermon-manager'),
		'pages'      => array( 'wpfc_sermon', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Location of MP3', 'sermon-manager'),
				'desc' => __('Upload an audio file or enter an URL.', 'sermon-manager'),
				'id'   => 'sermon_audio',
				'type' => 'file',
			),
			// Added the ability to edit the length of the MP3 audio
			array(
				'name' => __('MP3 Duration', 'sermon-manager'),
				'desc' => __('Length in minutes (if left blank, will attempt to calculate automatically when you save)', 'sermon-manager'),
				'id'   => '_wpfc_sermon_duration',
				'type' => 'text',
			),
			/* just testing for file size field _wpfc_sermon_size
			array(
				'name' => __('MP3 File size', 'sermon-manager'),
				'desc' => __('File size in bytes (will be automatically determined by Sermon Manager when you save)', 'sermon-manager'),
				'id'   => '_wpfc_sermon_size',
				'type' => 'text',
			),*/
			array(
				'name' => __('Video Embed Code', 'sermon-manager'),
				'desc' => __('Paste your embed code for Vimeo, Youtube, or other service here', 'sermon-manager'),
				'id'   => 'sermon_video',
				'type' => 'textarea',
			),
			array(
				'name' => __('Sermon Notes', 'sermon-manager'),
				'desc' => __('Upload a pdf file or enter an URL.', 'sermon-manager'),
				'id'   => 'sermon_notes',
				'type' => 'file',
			),
		),
	);
	
	return $meta_boxes;
}

// Custom taxonomy terms dropdown function
function wpfc_get_term_dropdown($taxonomy) {
	$terms = get_terms($taxonomy);
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$current_preacher = get_query_var('wpfc_preacher');
		$current_series = get_query_var('wpfc_sermon_series');
		$current_topic = get_query_var('wpfc_sermon_topics');
		$current_book = get_query_var('wpfc_bible_book');
		if($term_slug == $current_preacher || $term_slug == $current_series || $term_slug == $current_topic || $term_slug == $current_book) {
			echo '<option value="'.$term->slug.'" selected>'.$term->name.'</option>';
		} else {
			echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
		}
	}
} 

?>