jQuery(document).ready(function($) {
    // Attach a click event handler to the reply button
    $('.comment-reply-link').on('click', function(e) {
        e.preventDefault(); // Prevent the default action

        // Get the post ID and parent comment ID
        var postID = $(this).data('postid'); // Assuming the button has a data attribute for post ID
        var parentID = $(this).data('commentid'); // Assuming the button has a data attribute for parent comment ID

        // Create the comment form HTML
        var commentFormHtml = `
            <form id="ajax-comment-form">
                <textarea name="comment_content" required placeholder="Your reply..." rows="4" style="width: 100%;"></textarea>
                <input type="hidden" name="parent_id" value="${parentID}" />
                <input type="hidden" name="post_id" value="${postID}" />
            </form>
        `;

        // Show SweetAlert with the comment form
        Swal.fire({
            title: 'Leave a Reply',
            html: commentFormHtml,
            showCancelButton: true,
            confirmButtonText: 'Submit Reply',
            preConfirm: () => {
                // Get the form data
                const form = document.getElementById('ajax-comment-form');
                const commentContent = form.querySelector('textarea[name="comment_content"]').value;
                const postID = form.querySelector('input[name="post_id"]').value;
                const parentID = form.querySelector('input[name="parent_id"]').value;

                return { comment_content: commentContent, post_id: postID, parent_id: parentID };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with AJAX request
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: {
                        action: 'add_comment',
                        post_id: result.value.post_id,
                        comment_content: result.value.comment_content,
                        parent_id: result.value.parent_id,
                        nonce: ajax_object.nonce // Send the nonce for security
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success!', response.data.message, 'success').then(() => {
                                location.reload(); // Reload the page after successful submission
                            });
                        } else {
                            Swal.fire('Error!', response.data.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'An error occurred while adding the comment.', 'error');
                    }
                });
            }
        });
        return false;
    });
});
