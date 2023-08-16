<?php
/**
 * Jobs core functions
 *
 * General core functions available on admin and frontend
 *
 * @author WolfThemes
 * @category Core
 * @package WolfJobs/Core
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Display archive page state
 *
 * @param array $states
 * @param object $post
 * @return array $states
 */
function wolf_jobs_custom_post_states( $states, $post ) {

	if ( 'page' == get_post_type( $post->ID ) && absint( $post->ID ) === wolf_jobs_get_page_id() ) {

		$states[] = esc_html__( 'Jobs Page' );
	}

	return $states;
}
add_filter( 'display_post_states', 'wolf_jobs_custom_post_states', 10, 2 );