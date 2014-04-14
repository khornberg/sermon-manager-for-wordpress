<?php

// add the itunes namespace to the RSS opening element
function wpfc_podcast_add_namespace() {
	echo 'xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd/"';
}

// add itunes specific info to each item
function wpfc_podcast_add_head(){
	
	remove_filter('the_content', 'add_wpfc_sermon_content');

	$settings = get_option('wpfc_options'); ?>
	<copyright><?php echo esc_html( $settings['copyright'] ) ?></copyright>
	<itunes:subtitle><?php echo esc_html( $settings['itunes_subtitle'] ) ?></itunes:subtitle>
	<itunes:author><?php echo esc_html( $settings['itunes_author'] ) ?></itunes:author>
	<?php $category_description = category_description();
	if ( ! empty( $category_description ) ) { ?>
		<itunes:summary><?php echo wp_filter_nohtml_kses( $category_description ); ?></itunes:summary>
	<?php } else{ ?>
		<itunes:summary><?php echo wp_filter_nohtml_kses( $settings['itunes_summary'] ) ?></itunes:summary>
	<?php } ?>		
	<itunes:owner>
		<itunes:name><?php echo esc_html( $settings['itunes_owner_name'] ) ?></itunes:name>
		<itunes:email><?php echo esc_html( $settings['itunes_owner_email'] ) ?></itunes:email>
	</itunes:owner>
	<itunes:explicit>no</itunes:explicit>
	<?php //Show the taxonomy image if there is one
	$image_url = apply_filters( 'sermon-images-queried-term-image-url', '' ); 
	if ($image_url) { ?>
		<itunes:image href="<?php echo $image_url ?>" />
	<?php } else { //otherwise, show the image from the podcast settings ?>
		<itunes:image href="<?php echo esc_url( $settings['itunes_cover_image'] ) ?>" />
	<?php } ?>
	<itunes:category text="<?php echo esc_attr( $settings['itunes_top_category'] ) ?>">
		<itunes:category text="<?php echo esc_attr( $settings['itunes_sub_category'] ) ?>"/>
	</itunes:category>
	<?php
}

// add itunes specific info to each item
function wpfc_podcast_add_item(){
	
	global $post;
	
    $audio = get_post_meta($post->ID, 'sermon_audio', 'true');
	$speaker = strip_tags( get_the_term_list( $post->ID, 'wpfc_preacher', '', ' &amp; ', '' ) );
	$series = strip_tags( get_the_term_list( $post->ID, 'wpfc_sermon_series', '', ', ', '' ) );
	// Sermon Topics
	$topic_list = wp_get_post_terms( get_the_ID() , 'wpfc_sermon_topics' );
	$topics = false;
	if( $topic_list && count( $topic_list ) > 0 ) {
		$c = 0;
		foreach( $topic_list as $t ) {
			if( $c == 0 ) {
				$topics = esc_html( $t->name );
				++$c;
			} else {
				$topics .= ', ' . esc_html( $t->name );
			}
		}
	}

	$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	$post_image = ( $post_image ) ? $post_image['0'] : null;
	$enclosure = get_post_meta($post->ID, 'enclosure', 'true');
	

	$audio_duration = get_post_meta($post->ID, '_wpfc_sermon_duration', 'true');
	if ($audio_duration == '' ) $audio_duration = '0:00'; //zero if undefined
	?>
	<itunes:author><?php echo $speaker ?></itunes:author>
	<itunes:subtitle><?php echo $series ?></itunes:subtitle>
	<itunes:summary><?php strip_tags( wpfc_sermon_meta('sermon_description') ); ?></itunes:summary>
	<?php if ( $post_image ) : ?>
	<itunes:image href="<?php echo $post_image; ?>" />
	<?php endif; ?>
	<?php if ( $enclosure == '' ) : ?>
		<enclosure url="<?php echo $audio; ?>" length="0" type="audio/mpeg"/>
	<?php endif; ?>
	<itunes:duration><?php echo esc_html( $audio_duration ); ?></itunes:duration>
	<?php if( $topics ) { ?>
		<itunes:keywords><?php echo esc_html( $topics ); ?></itunes:keywords><?php } 
}

//Display the sermon description as the podcast summary
function wpfc_podcast_summary ($content) {
	global $post;
	//$content = '';
	$content = strip_tags( get_wpfc_sermon_meta('sermon_description') ); 
		return $content;
}

//Filter published date for podcast: use sermon date instead of post date
function wpfc_podcast_item_date ($time, $d = 'U', $gmt = false) {
 
	$time = wpfc_sermon_date('D, d M Y H:i:s O');
	return $time;
}

// Filter the date on sermons only
function wpfc_modify_sermon_date( $query ) {
	if ( !is_admin() && $query->is_main_query() && $query->is_feed() ) :
	if( is_post_type_archive('wpfc_sermon') || is_tax( 'wpfc_preacher' ) || is_tax( 'wpfc_sermon_topics' ) || is_tax( 'wpfc_sermon_series' ) || is_tax( 'wpfc_bible_book' ) ) {
		add_filter ( 'get_post_time', 'wpfc_podcast_item_date', 10, 3);
		add_action( 'rss_ns', 'wpfc_podcast_add_namespace' );
		add_action( 'rss2_ns', 'wpfc_podcast_add_namespace' );
		add_action('rss_head', 'wpfc_podcast_add_head');
		add_action('rss2_head', 'wpfc_podcast_add_head');
		add_action('rss_item', 'wpfc_podcast_add_item');
		add_action('rss2_item', 'wpfc_podcast_add_item');
		add_filter( 'the_content_feed', 'wpfc_podcast_summary', 10, 3);
		add_filter( 'the_excerpt_rss', 'wpfc_podcast_summary');
	}
	endif;
}
add_action('pre_get_posts', 'wpfc_modify_sermon_date', 9999);

/**
 * Podcast Settings
 */

// Create custom RSS feed for sermon podcasting
function wpfc_sermon_podcast_feed() {

	load_template( WPFC_SERMONS . 'includes/podcast-feed.php');
}
add_action('do_feed_podcast', 'wpfc_sermon_podcast_feed', 10, 1);


// Custom rewrite for podcast feed
function wpfc_sermon_podcast_feed_rewrite($wp_rewrite) {
	$feed_rules = array(
		'feed/(.+)' => 'index.php?feed=' . $wp_rewrite->preg_index(1),
		'(.+).xml' => 'index.php?feed='. $wp_rewrite->preg_index(1)
	);
	$wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'wpfc_sermon_podcast_feed_rewrite');


// Get the filesize of a remote file, used for Podcast data
function wpfc_get_filesize( $url, $timeout = 10 ) {
	$headers = wp_get_http_headers( $url);
    $duration = isset( $headers['content-length'] ) ? (int) $headers['content-length'] : 0;
	
	if( $duration ) {
			sscanf( $duration , "%d:%d:%d" , $hours , $minutes , $seconds );
			
			$length = isset( $seconds ) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

			if( ! $length ) {
					$length = (int) $duration;
			}

			return $length;
	}

	return 0;	
}

//Returns duration of .mp3 file
function wpfc_mp3_duration($mp3_url) {
	if ( ! class_exists( 'getID3' ) ) {
		require_once WPFC_SERMONS . '/includes/getid3/getid3.php'; 
	}
	$filename = tempnam('/tmp','getid3');
	if (file_put_contents($filename, file_get_contents($mp3_url, false, null, 0, 300000))) {
		  $getID3 = new getID3;
		  $ThisFileInfo = $getID3->analyze($filename);
		  unlink($filename);
	}
	$playtime_string = $ThisFileInfo['playtime_string'];

		return $playtime_string;
	
}

?>