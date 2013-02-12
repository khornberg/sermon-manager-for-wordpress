<?php
/*
 * Sermon Manager Upgrade Functions
 */

function wpfc_plugin_get_version() {
	$sermon_plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/sermon-manager-for-wordpress/sermons.php' ); 
	$version = $sermon_plugin_data['Version'];
	return $version;
}

function wpfc_sermon_update() {

	$args = array(
	  'post_type'       => 'wpfc_sermon',
	  'posts_per_page'  => '-0'
	);
	$wpfc_sermon_update_query = new WP_Query($args);
	
	while ($wpfc_sermon_update_query->have_posts()) : $wpfc_sermon_update_query->the_post();
		global $post;
		$postid = get_the_ID();
		$service_type = get_post_meta($post->ID, 'service_type', 'true');
		if(!empty($service_type)){      
			wp_set_object_terms($post->ID, $service_type, 'wpfc_service_type');
		}
	endwhile;
	wp_reset_query();

}

function wpfc_sermon_update_db_check() {
    if ( is_admin() ) {
		if ( wpfc_plugin_get_version() < '1.7' ) {
			wpfc_sermon_update();
		}
	}
}
add_action('admin_menu', 'wpfc_sermon_update_db_check');

function wpfc_sermon_update_warning() {
	if ( wpfc_plugin_get_version() < '1.7' ) {
		function wpfc_sermon_db_warning() {
			?>
			<div id='wpfc-sermon-update-warning' class='updated fade'>
				<?php $wpfc_settings_url = admin_url( 'edit.php?post_type=wpfc_sermon&page=sermon-manager-for-wordpress/includes/options.php'); ?>
				<p><strong><?php _e('Sermon Manager is almost ready.', 'sermon-manager');?></strong> <?php _e('You must', 'sermon-manager');?> <a href="<?php echo $wpfc_settings_url; ?>"><?php _e('refresh your settings', 'sermon-manager');?></a></p>
			</div>
			<?php
		}
		add_action('admin_notices', 'wpfc_sermon_db_warning');
	}
}
add_action('admin_init', 'wpfc_sermon_update_warning');

?>