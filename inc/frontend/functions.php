<?php
/**
 * Jobs Functions
 *
 * Jobs front-end functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfJobs/Functions
 * @since 1.0.0
 */

/**
 * Handle redirects before content is output - hooked into template_redirect so is_page jobs.
 *
 */
function wolf_jobs_template_redirect() {

	if ( is_page( wolf_jobs_get_page_id() ) && ! post_password_required() ) {
		wolf_jobs_get_template( 'jobs-template.php' );
		exit();
	}
}