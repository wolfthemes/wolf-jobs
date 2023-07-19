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

/* Jobs Taxonomy */
$labels = array(
	'name' => esc_html__( 'Job Categories', 'wolf-jobs' ),
	'singular_name' => esc_html__( 'Job Category', 'wolf-jobs' ),
	'search_items' => esc_html__( 'Search Job Categories', 'wolf-jobs' ),
	'popular_items' => esc_html__( 'Popular Job Categories', 'wolf-jobs' ),
	'all_items' => esc_html__( 'All Job Categories', 'wolf-jobs' ),
	'parent_item' => esc_html__( 'Parent Job Category', 'wolf-jobs' ),
	'parent_item_colon' => esc_html__( 'Parent Job Category:', 'wolf-jobs' ),
	'edit_item' => esc_html__( 'Edit Job Category', 'wolf-jobs' ),
	'update_item' => esc_html__( 'Update Job Category', 'wolf-jobs' ),
	'add_new_item' => esc_html__( 'Add New Job Category', 'wolf-jobs' ),
	'new_item_name' => esc_html__( 'New Job Category', 'wolf-jobs' ),
	'separate_items_with_commas' => esc_html__( 'Separate job categories with commas', 'wolf-jobs' ),
	'add_or_remove_items' => esc_html__( 'Add or remove job categories', 'wolf-jobs' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used job categories', 'wolf-jobs' ),
	'not_found' => esc_html__( 'No categories found', 'wolf-jobs' ),
	'menu_name' => esc_html__( 'Categories', 'wolf-jobs' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => true,
	'public' => true,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'job-category', 'with_front' => false ),
);

register_taxonomy( 'job_category', array( 'job' ), $args );

/* Jobs Taxonomy */
$labels = array(
	'name' => esc_html__( 'Job Types', 'wolf-jobs' ),
	'singular_name' => esc_html__( 'Job Type', 'wolf-jobs' ),
	'search_items' => esc_html__( 'Search Job Types', 'wolf-jobs' ),
	'popular_items' => esc_html__( 'Popular Job Types', 'wolf-jobs' ),
	'all_items' => esc_html__( 'All Job Types', 'wolf-jobs' ),
	'parent_item' => esc_html__( 'Parent Job Type', 'wolf-jobs' ),
	'parent_item_colon' => esc_html__( 'Parent Job Type:', 'wolf-jobs' ),
	'edit_item' => esc_html__( 'Edit Job Type', 'wolf-jobs' ),
	'update_item' => esc_html__( 'Update Job Type', 'wolf-jobs' ),
	'add_new_item' => esc_html__( 'Add New Job Type', 'wolf-jobs' ),
	'new_item_name' => esc_html__( 'New Job Type', 'wolf-jobs' ),
	'separate_items_with_commas' => esc_html__( 'Separate job Types with commas', 'wolf-jobs' ),
	'add_or_remove_items' => esc_html__( 'Add or remove job Types', 'wolf-jobs' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used job Types', 'wolf-jobs' ),
	'not_found' => esc_html__( 'No Types found', 'wolf-jobs' ),
	'menu_name' => esc_html__( 'Types', 'wolf-jobs' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => true,
	'public' => true,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'job-type', 'with_front' => false ),
);

register_taxonomy( 'job_type', array( 'job' ), $args );

$labels = array(
	'name' => esc_html__( 'Job Locations', 'wolf-jobs' ),
	'singular_name' => esc_html__( 'Job Location', 'wolf-jobs' ),
	'search_items' => esc_html__( 'Search Job Locations', 'wolf-jobs' ),
	'popular_items' => esc_html__( 'Popular Job Locations', 'wolf-jobs' ),
	'all_items' => esc_html__( 'All Job Locations', 'wolf-jobs' ),
	'parent_item' => esc_html__( 'Parent Job Location', 'wolf-jobs' ),
	'parent_item_colon' => esc_html__( 'Parent Job Location:', 'wolf-jobs' ),
	'edit_item' => esc_html__( 'Edit Job Location', 'wolf-jobs' ),
	'update_item' => esc_html__( 'Update Job Location', 'wolf-jobs' ),
	'add_new_item' => esc_html__( 'Add New Job Location', 'wolf-jobs' ),
	'new_item_name' => esc_html__( 'New Job Location', 'wolf-jobs' ),
	'separate_items_with_commas' => esc_html__( 'Separate job Locations with commas', 'wolf-jobs' ),
	'add_or_remove_items' => esc_html__( 'Add or remove job Locations', 'wolf-jobs' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used job Locations', 'wolf-jobs' ),
	'not_found' => esc_html__( 'No Locations found', 'wolf-jobs' ),
	'menu_name' => esc_html__( 'Locations', 'wolf-jobs' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,
	'public' => true,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'job-location', 'with_front' => false ),
);

register_taxonomy( 'job_location', array( 'job' ), $args );