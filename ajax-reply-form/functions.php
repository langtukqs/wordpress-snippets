<?php
//enqueue the necessary scripts
function enqueue_custom_scripts() {
		// Enqueue jQuery. Remove this if your theme already enqueued jQuery
		wp_enqueue_script('jquery');

		// Enqueue SweetAlert
		wp_enqueue_script('sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', [], null, true);

		// Enqueue custom script for handling AJAX
		wp_enqueue_script('custom-ajax-script', get_template_directory_uri() . '/js/custom-ajax.js', ['jquery'], null, true);

		// Localize script to pass AJAX URL
		wp_localize_script('custom-ajax-script', 'ajax_object', [
		 'ajax_url' => admin_url('admin-ajax.php'),
		 'nonce' => wp_create_nonce('comment_nonce')
		]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Handle the AJAX submission from the reply form
function handle_ajax_comment() {
		// Check nonce for security
		check_ajax_referer('comment_nonce', 'nonce');

		// Get the comment data
		$comment_post_ID = intval($_POST['post_id']);
		$comment_content = sanitize_text_field($_POST['comment_content']);
		$parent_comment_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;

		// Prepare the comment data
		$comment_data = [
		 'comment_post_ID' => $comment_post_ID,
		 'comment_content' => $comment_content,
		 'comment_type' => '',
		 'comment_parent' => $parent_comment_id,
		 'user_id' => get_current_user_id(),
		 'comment_approved' => 1, // Automatically approve the comment
		];

		// Insert the comment
		$comment_id = wp_insert_comment($comment_data);

		if ($comment_id) {
				// Send a success response
				wp_send_json_success(['message' => 'Comment added successfully!']);
		} else {
				// Send an error response
				wp_send_json_error(['message' => 'Failed to add comment.']);
		}

		wp_die(); // Required to terminate immediately and return a proper response
}
add_action('wp_ajax_add_comment', 'handle_ajax_comment');
add_action('wp_ajax_nopriv_add_comment', 'handle_ajax_comment'); // For non-logged in users
