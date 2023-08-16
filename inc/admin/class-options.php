<?php
/**
 * Jobs Options.
 *
 * @class Wolf_Jobs_Options
 * @author WolfThemes
 * @category Admin
 * @package WolfJobs/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Wolf_Jobs_Options class.
 */
class Wolf_Jobs_Options {
	/**
	 * Constructor
	 */
	public function __construct() {

		// default options
		add_action( 'admin_init', array( $this, 'default_options' ) );

		// register settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// add option sub-menu
		add_action( 'admin_menu', array( $this, 'add_settings_menu' ) );
	}

	/**
	 * Add options menu
	 */
	public function add_settings_menu() {

		add_submenu_page( 'edit.php?post_type=job', esc_html__( 'Settings', 'wolf-jobs' ), esc_html__( 'Settings', 'wolf-jobs' ), 'edit_plugins', 'wolf-jobs-settings', array( $this, 'options_form' ) );
		//add_submenu_page( 'edit.php?post_type=jobs', esc_html__( 'Shortcode', 'wolf-jobs' ), esc_html__( 'Shortcode', 'wolf-jobs' ), 'edit_plugins', 'wolf-jobs-shortcode', array( $this, 'help' ) );
	}

	/**
	 * Set default options
	 */
	public function default_options() {

		global $options;

		if ( false ===  get_option( 'wolf_jobs_settings' )  ) {

			$default = array(

				//'use_band_tax' => 1,
				//'use_label_tax' => 1,
				//'display_format' => 1

			);

			add_option( 'wolf_jobs_settings', $default );
		}
	}

	/**
	 * Register options
	 */
	public function register_settings() {

		register_setting( 'wolf-jobs-settings', 'wolf_jobs_settings', array( $this, 'settings_validate' ) );
		add_settings_section( 'wolf-jobs-settings', '', array( $this, 'section_intro' ), 'wolf-jobs-settings' );
		add_settings_field( 'page_id', esc_html__( 'Jobs Archive Page', 'wolf-jobs' ), array( $this, 'setting_page_id' ), 'wolf-jobs-settings', 'wolf-jobs-settings' );
	}

	/**
	 * Validate options
	 *
	 * @param array $input
	 * @return array $input
	 */
	public function settings_validate( $input ) {

		if ( isset( $input['page_id'] ) ) {
			update_option( '_wolf_jobs_page_id', intval( $input['page_id'] ) );
			unset( $input['page_id'] );
		}
		return $input;
	}

	/**
	 * Debug section
	 *
	 * @return string
	 */
	public function section_intro() {
		// debug
		// global $options;
		//var_dump(get_option('_wolf_jobs_page_id'));
	}

	/**
	 * Page settings
	 *
	 * @access public
	 * @return string
	 */
	public function setting_page_id() {
		$page_option = array( '' => esc_html__( '- Disabled -', 'wolf-jobs' ) );
		$pages = get_pages();

		foreach ( $pages as $page ) {

			if ( get_post_field( 'post_parent', $page->ID ) ) {
				$page_option[ absint( $page->ID ) ] = '&nbsp;&nbsp;&nbsp; ' . sanitize_text_field( $page->post_title );
			} else {
				$page_option[ absint( $page->ID ) ] = sanitize_text_field( $page->post_title );
			}
		}
		?>
		<select name="wolf_jobs_settings[page_id]">
			<option value="-1"><?php esc_html_e( 'Select a page...', 'wolf-jobs' ); ?></option>
			<?php foreach ( $page_option as $k => $v ) : ?>
				<option value="<?php echo absint( $k ); ?>" <?php selected( absint( $k ), get_option( '_wolf_jobs_page_id' ) ); ?>><?php echo sanitize_text_field( $v ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}

	/**
	 * Options form
	 *
	 * @return string
	 */
	public function options_form() {
		?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"></div>
			<h2><?php esc_html_e( 'Jobs Options', 'wolf-jobs' ); ?></h2>
			<?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) { ?>
			<div id="setting-error-settings_updated" class="updated settings-error">
				<p><strong><?php esc_html_e( 'Settings saved.', 'wolf-jobs' ); ?></strong></p>
			</div>
			<?php } ?>
			<form action="options.php" method="post">
				<?php settings_fields( 'wolf-jobs-settings' ); ?>
				<?php do_settings_sections( 'wolf-jobs-settings' ); ?>
				<p class="submit"><input name="save" type="submit" class="button-primary" value="<?php esc_html_e( 'Save Changes', 'wolf-jobs' ); ?>" /></p>
			</form>
		</div>
		<?php
	}
}

return new Wolf_Jobs_Options();