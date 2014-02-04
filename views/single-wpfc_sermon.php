<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

/**
 * Display download link for sermon excerpt
 *
 * @return void
 * @author khornberg
 **/
function sermon_download_media()
{
    $audio = (get_wpfc_sermon_meta('sermon_audio')) ? true : false;
    $video = (get_wpfc_sermon_meta('sermon_video')) ? true : false;

	// Check if the download-shortcode plugin active
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( "download-shortcode/download-shortcode.php" )) {
        if ($audio && $video) {
            echo do_shortcode( '[download label="'.__( 'Download Audio', 'sermon-manager').'"]' . get_wpfc_sermon_meta('sermon_audio') . '[/download]' );
            echo do_shortcode( '[download label="'.__( 'Download Video', 'sermon-manager').'"]' . get_wpfc_sermon_meta('sermon_video') . '[/download]' );
        }
        elseif ($audio) {
            echo do_shortcode( '[download label="'.__( 'Download', 'sermon-manager').'"]' . get_wpfc_sermon_meta('sermon_audio') . '[/download]' );
        }
        elseif ($video) {
            echo do_shortcode( '[download label="'.__( 'Download', 'sermon-manager').'"]' . get_wpfc_sermon_meta('sermon_video') . '[/download]' );
        }
    } else {
        if ($audio && $video) {
            echo '<a target="_blank" href="' . get_wpfc_sermon_meta('sermon_audio') . '">'.__( 'Download Audio', 'sermon-manager').'</a>';
            echo '<a target="_blank" href="' . get_wpfc_sermon_meta('sermon_video') . '">'.__( 'Download Video', 'sermon-manager').'</a>';
        }
        elseif ($audio) {
            echo '<a target="_blank" href="' . get_wpfc_sermon_meta('sermon_audio') . '">'.__( 'Download Audio', 'sermon-manager').'</a>';
        }
        elseif ($video) {
            echo '<a target="_blank" href="' . get_wpfc_sermon_meta('sermon_video') . '">'.__( 'Download', 'sermon-manager').'</a>';
        }
    }
}

get_header(); ?>

	<div id="container">
		<div id="content" role="main">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<h1 class="entry-title"><?php the_title(); ?></h1>		
			
				<?php render_sermon_single(); ?>

				<div class="entry-utility">
					<?php edit_post_link( __( 'Edit', 'sermon-manager' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-utility -->

			</div><!-- #post-## -->

		<div id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'sermon-manager' ) . '</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'sermon-manager' ) . '</span>' ); ?></div>
		</div><!-- #nav-below -->

		<?php comments_template( '', true ); ?>
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php 
function render_sermon_single()
{
    global $post; ?>
    <div class="wpfc_sermon_wrap cf">
        <div class="wpfc_sermon_image">
            <?php render_sermon_image('sermon_small'); ?>
        </div>
        <div class="wpfc_sermon_meta cf">
            <p>
                <?php
                    wpfc_sermon_date(get_option('date_format'), '<span class="sermon_date">', '</span> '); echo the_terms( $post->ID, 'wpfc_service_type',  ' <span class="service_type">(', ' ', ')</span>');
            ?></p><p><?php
                    wpfc_sermon_meta('bible_passage', '<span class="bible_passage">'.__( 'Bible Text: ', 'sermon-manager'), '</span> | ');
                    echo the_terms( $post->ID, 'wpfc_preacher',  '<span class="preacher_name">', ', ', '</span>');
                    echo the_terms( $post->ID, 'wpfc_sermon_series', '<p><span class="sermon_series">'.__( 'Series: ', 'sermon-manager'), ' ', '</span></p>' );
                ?>
            </p>
        </div>
    </div>
    <div class="wpfc_sermon cf">
        <?php 
            wp_enqueue_script('mediaelement');
            wp_enqueue_style('mediaelement');

            // Display video
            if ( get_wpfc_sermon_meta('sermon_video') ) {
                echo '<div class="wpfc_sermon-video cf">';
                    echo do_shortcode( get_wpfc_sermon_meta('sermon_video'));
                echo '</div>';
            } 
            // Display audio player
            if ( get_wpfc_sermon_meta('sermon_audio') ) {
                echo '<div class="wpfc_sermon-audio cf">';?>
                    <script>
                        jQuery.noConflict();
                        jQuery(document).ready(function(){
                            jQuery('audio').mediaelementplayer();
                        });
                    </script> <?php
                    echo '<audio controls="controls">';
                        echo '<source src="' . get_wpfc_sermon_meta('sermon_audio') . '"  type="audio/mp3" />';
                    echo '</audio>';
                echo '</div>';
            }
        ?>
         <?php //wpfc_sermon_description(); ?>

        <?php sermon_download_media(); ?>

        <?php echo the_terms( $post->ID, 'wpfc_sermon_topics', '<p class="sermon_topics">'.__( 'Topics: ', 'sermon-manager'), ',', '', '</p>' ); ?>
    </div>
<?php
}
?>
