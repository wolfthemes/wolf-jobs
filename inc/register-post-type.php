<?php
/**
 * Jobs register taxonomy
 *
 * @author WolfThemes
 * @category Core
 * @package WolfJobs
 * @version 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Register Job post type */
$labels = apply_filters( 'wolf_job_post_type_labels', array(
	'name' => esc_html__( 'Jobs', 'wolf-jobs' ),
	'singular_name' => esc_html__( 'Job', 'wolf-jobs' ),
	'add_new' => esc_html__( 'Add New', 'wolf-jobs' ),
	'add_new_item' => esc_html__( 'Add New Job', 'wolf-jobs' ),
	'all_items'  => esc_html__( 'All Jobs', 'wolf-jobs' ),
	'edit_item' => esc_html__( 'Edit Job', 'wolf-jobs' ),
	'new_item' => esc_html__( 'New Job', 'wolf-jobs' ),
	'view_item' => esc_html__( 'View Job', 'wolf-jobs' ),
	'search_items' => esc_html__( 'Search Jobs', 'wolf-jobs' ),
	'not_found' => esc_html__( 'No Jobs found', 'wolf-jobs' ),
	'not_found_in_trash' => esc_html__( 'No jobs found in Trash', 'wolf-jobs' ),
	'parent_item_colon' => '',
	'menu_name' => esc_html__( 'Jobs', 'wolf-jobs' ),
) );

$args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'query_var' => false,
	'rewrite' => array( 'slug' => 'job' ),
	'capability_type' => 'post',
	'has_archive' => false,
	'hierarchical' => false,
	'menu_position' => 5,
	'taxonomies' => array(),
	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'excerpt' ),
	'exclude_from_search' => false,
	'description' => esc_html__( 'Present your job', 'wolf-jobs' ),
	'menu_icon' => 'dashicons-admin-customizer',
);

register_post_type( 'job', $args );