<?php
/**
 * Jobs Admin.
 *
 * @class Wolf_Jobs_admin
 * @author WolfThemes
 * @category Admin
 * @package Wolfjobs/Admin
 * @version 1.5.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * Wolf_Jobs_admin class.
 */
class Wolf_Jobs_admin {
	/**
	 * Constructor
	 */
	public function __construct() {

		// Includes files
		$this->includes();

		// Set metaboxes
		$this->metaboxes();

		// Admin init hooks
		$this->admin_init_hooks();
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once( 'class-options.php' );
		include_once( 'jobs-admin-functions.php' );
	}

	/**
	 * Admin init
	 */
	public function admin_init_hooks() {

		// Plugin settings link
		add_filter( 'plugin_action_links_' . plugin_basename( WOLF_JOBS_PATH ), array( $this, 'settings_action_links' ) );

		// Plugin update notifications
		//add_action( 'admin_init', array( $this, 'plugin_update' ) );

		// Create page notice
		add_action( 'admin_notices', array( $this, 'check_page' ) );
		add_action( 'admin_notices', array( $this, 'create_page' ) );

		// Hide editors from index page
		add_action( 'edit_form_after_title', array( $this, 'is_index_page' ) );
		add_action( 'admin_init', array( $this, 'hide_editor' ) );
		add_action( 'admin_head', array( $this, 'hide_wpb_editor' ) );
	}

	/**
	 * Add metaboxes
	 */
	public function metaboxes() {
		//include_once( 'wd-metaboxes.php' );
	}

	/**
	 * Check jobs page
	 *
	 * Display a notification if we can't get the jobs page id
	 *
	 */
	public function check_page() {

		$output    = '';
		$theme_dir = get_template_directory();

		// update_option( '_wolf_jobs_needs_page', true );
		// delete_option( '_wolf_jobs_no_needs_page', true );
		// delete_option( '_wolf_jobs_page_id' );

		if ( get_option( '_wolf_jobs_no_needs_page' ) )
			return;

		if ( ! get_option( '_wolf_jobs_needs_page' ) )
			return;

		if ( -1 == wolf_jobs_get_page_id() && ! isset( $_GET['wolf_jobs_create_page'] ) ) {

			if ( isset( $_GET['skip_wolf_jobs_setup'] ) ) {
				delete_option( '_wolf_jobs_needs_page' );
				return;
			}

			update_option( '_wolf_jobs_needs_page', true );

			$message = '<strong>Wolf jobs</strong> ' . sprintf(
					wp_kses(
						__( 'says : <em>Almost done! you need to <a href="%1$s">create a page</a> for your releases or <a href="%2$s">select an existing page</a> in the plugin settings</em>.', 'wolf-jobs' ),
						array(
							'a' => array(
								'href' => array(),
								'class' => array(),
								'title' => array(),
							),
							'br' => array(),
							'em' => array(),
							'strong' => array(),
						)
					),
					esc_url( admin_url( '?wolf_jobs_create_page=true' ) ),
					esc_url( admin_url( 'edit.php?post_type=job&page=wolf-jobs-settings' ) )
			);

			$message .= sprintf(
				wp_kses(
					__( '<br><br>
					<a href="%1$s" class="button button-primary">Create a page</a>
					&nbsp;
					<a href="%2$s" class="button button-primary">Select an existing page</a>
					&nbsp;
					<a href="%3$s" class="button">Skip setup</a>', 'wolf-jobs' ),

					array(
							'a' => array(
								'href' => array(),
								'class' => array(),
								'title' => array(),
							),
							'br' => array(),
							'em' => array(),
							'strong' => array(),
						)
				),
					esc_url( admin_url( '?wolf_jobs_create_page=true' ) ),
					esc_url( admin_url( 'edit.php?post_type=job&page=wolf-jobs-settings' ) ),
					esc_url( admin_url( '?skip_wolf_jobs_setup=true' ) )
			);

			$output = '<div class="updated wolf-admin-notice wolf-plugin-admin-notice"><p>';

				$output .= $message;

			$output .= '</p></div>';

			echo $output;
		} else {

			delete_option( '_wolf_jobs_need_page' );
		}

		return false;
	}

	/**
	 * Create jobs page
	 */
	public function create_page() {

		if ( isset( $_GET['wolf_jobs_create_page'] ) && $_GET['wolf_jobs_create_page'] == 'true' ) {

			$output = '';

			// Create post object
			$post = array(
				'post_title'  => esc_html__( 'Jobs', 'wolf-jobs' ),
				'post_type'   => 'page',
				'post_status' => 'publish',
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $post );

			if ( $post_id ) {

				update_option( '_wolf_jobs_page_id', $post_id );
				update_post_meta( $post_id, '_wpb_status', 'off' ); // disable page builder mode for this page

				$message = esc_html__( 'Your jobs page has been created succesfully', 'wolf-jobs' );

				$output = '<div class="updated"><p>';

				$output .= $message;

				$output .= '</p></div>';

				echo $output;
			}

		}

		return false;
	}

	/**
	 * Display notice on album index page
	 */
	public function is_index_page() {

		if ( isset( $_GET['post'] ) && absint( $_GET['post'] ) == wolf_jobs_get_page_id() ) {
			$message = esc_html__( 'You are currently editing the page that shows the jobs.', 'wolf-jobs' );

			$output = '<div class="notice notice-warning inline"><p>';

			$output .= $message;

			$output .= '</p></div>';

			echo $output;
		}
	}

	/**
	 * Hide the editor if we're on the admin jobs page
	 */
	public function hide_editor() {
		if ( isset( $_GET['post'] ) && absint( $_GET['post'] ) == wolf_jobs_get_page_id() ) {
			remove_post_type_support( 'page', 'editor' );
		}
	}

	/**
	 * Hide the editor if we're on the admin jobs page
	 */
	public function hide_wpb_editor() {
		if ( isset( $_GET['post'] ) && absint( $_GET['post'] ) == wolf_jobs_get_page_id() ) {
			?>
			<style type="text/css">
			.wpb-toggle-editor,
			#wpb-import-export-buttons,
			#wpb_content{
				display:none!important;
			}
			</style>
			<?php
		}
	}

	/**
	 * Add settings link in plugin page
	 */
	public function settings_action_links( $links ) {
		$setting_link = array(
			'<a href="' . admin_url( 'edit.php?post_type=job&page=wolf-jobs-settings' ) . '">' . esc_html__( 'Settings', 'wolf-jobs' ) . '</a>',
		);
		return array_merge( $links, $setting_link );
	}

	/**
	 * Plugin update
	 */
	public function plugin_update() {

		$plugin_name = WOLF_JOBS_SLUG;
		$plugin_slug = WOLF_JOBS_SLUG;
		$plugin_path = WOLF_JOBS_PATH;
		$remote_path = WOLF_JOBS_UPDATE_URL . '/' . $plugin_slug;
		$plugin_data = get_plugin_data( WD_DIR . '/' . WOLF_JOBS_SLUG . '.php' );
		$current_version = $plugin_data['Version'];
		include_once( 'class-wolf-jobs-update.php');
		new Wolf_Jobs_Update( $current_version, $remote_path, $plugin_path );
	}
}

return new Wolf_Jobs_admin();
