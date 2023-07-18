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
 * wolf_jobs page ID
 *
 * retrieve page id - used for the main jobs page
 *
 *
 * @return int
 */
function wolf_jobs_get_page_id() {

	$page_id = -1;

	if ( -1 != get_option( '_wolf_jobs_page_id' ) && get_option( '_wolf_jobs_page_id' ) ) {

		$page_id = get_option( '_wolf_jobs_page_id' );
	}

	if ( -1 != $page_id ) {
		$page_id = apply_filters( 'wpml_object_id', absint( $page_id ), 'page', true ); // filter for WPML
	}

	return $page_id;
}

if ( ! function_exists( 'wolf_get_jobs_url' ) ) {
	/**
	 * Returns the URL of the jobs page
	 */
	function wolf_get_jobs_url() {

		$page_id = wolf_jobs_get_page_id();

		if ( -1 != $page_id ) {
			return get_permalink( $page_id );
		}
	}
}

/**
 * Get template part (for templates like the jobs-loop).
 *
 * @param mixed $slug
 * @param string $name (default: '')
 * @return void
 */
function wolf_jobs_get_template_part( $slug, $name = '' ) {

	$template = '';

	$wolf_jobs = WOLF_JOBS();

	// Look in yourtheme/slug-name.php and yourtheme/wolf-jobs/slug-name.php
	if ( $name )
		$template = locate_template( array( "{$slug}-{$name}.php", "{$wolf_jobs->template_url}{$slug}-{$name}.php" ) );

	// Get default slug-name.php
	if ( ! $template && $name && file_exists( $wolf_jobs->plugin_path() . "/templates/{$slug}-{$name}.php" ) )
		$template = $wolf_jobs->plugin_path() . "/templates/{$slug}-{$name}.php";

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/wolf-jobs/slug.php
	if ( ! $template )
		$template = locate_template( array( "{$slug}.php", "{$wolf_jobs->template_url}{$slug}.php" ) );

	if ( $template )
		load_template( $template, false );
}

/**
 * Get other templates (e.g. ticket attributes) passing attributes and including the file.
 *
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function wolf_jobs_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

	if ( $args && is_array($args) )
		extract( $args );

	$located = wolf_jobs_locate_template( $template_name, $template_path, $default_path );

	do_action( 'wolf_jobs_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'wolf_jobs_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme/$template_path/$template_name
 * yourtheme/$template_name
 * $default_path/$template_name
 *
 * @param mixed $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function wolf_jobs_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	if ( ! $template_path ) $template_path = WOLF_JOBS()->template_url;
	if ( ! $default_path ) $default_path = WOLF_JOBS()->plugin_path() . '/templates/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template )
		$template = $default_path . $template_name;

	// Return what we found
	return apply_filters( 'wolf_jobs_locate_template', $template, $template_name, $template_path );
}