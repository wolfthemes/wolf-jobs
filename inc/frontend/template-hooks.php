<?php
/**
 * Jobs Hooks
 *
 * Action/filter hooks used for WolfJobs functions/templates
 *
 * @author WolfThemes
 * @category Core
 * @package WolfJobs/Templates
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Body class
 *
 * @see  wolf_jobs_body_class()
 */
add_filter( 'body_class', 'wolf_jobs_body_class' );

/**
 * WP Header
 *
 * @see  wolf_jobs_generator_tag()
 */
add_action( 'get_the_generator_html', 'wolf_jobs_generator_tag', 10, 2 );
add_action( 'get_the_generator_xhtml', 'wolf_jobs_generator_tag', 10, 2 );

/**
 * Content wrappers
 *
 * @see wolf_jobs_output_content_wrapper()
 * @see wolf_jobs_output_content_wrapper_end()
 */
add_action( 'wolf_jobs_before_main_content', 'wolf_jobs_output_content_wrapper', 10 );
add_action( 'wolf_jobs_after_main_content', 'wolf_jobs_output_content_wrapper_end', 10 );
add_action( 'template_redirect', 'wolf_jobs_template_redirect', 40 );