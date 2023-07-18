<?php
/**
 * Jobs Template Functions
 *
 * Functions used in the template files to output content - in most cases hooked in via the template actions. All functions are pluggable.
 *
 * @author WolfThemes
 * @category Core
 * @package WolfJobs/Templates
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output generator tag to aid debugging.
 */
function wolf_jobs_generator_tag( $gen, $type ) {
	switch ( $type ) {
		case 'html':
			$gen .= "\n" . '<meta name="generator" content="WolfJobs ' . esc_attr( WOLF_JOBS_VERSION ) . '">';
			break;
		case 'xhtml':
			$gen .= "\n" . '<meta name="generator" content="WolfJobs ' . esc_attr( WOLF_JOBS_VERSION ) . '" />';
			break;
	}
	return $gen;
}

/**
 * Add specific class to the body when we're on the jobs pages
 *
 * @since 1.0.0
 * @param array $classes
 * @return array $classes
 */
function wolf_jobs_body_class( $classes ) {

	if (
		! is_singular( 'job' )
		&& ( 'job' == get_post_type() || ( function_exists( 'wolf_jobs_get_page_id' ) && is_page( wolf_jobs_get_page_id() ) ) )
		&& ! is_search()
	) {
		$classes[] = 'wolf-jobs';
	}

	return $classes;
}