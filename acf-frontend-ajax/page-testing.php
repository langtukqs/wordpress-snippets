<?php acf_form_head(); //This is required to load ACF necessary resources?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			acf_form(array(
				'id' => 'ajax_acf_form_id', // This ID is used to trigger the
				'post_id' => 'new_post',
				'post_title'    => true,
				'post_content'  => true
			));
			?>
		<?php endwhile; ?>
	</div><!-- #content -->
</div><!-- #primary -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Install Sweetalert to use in success-->
<script>
	// This script is added here for to better demonstrate the code. In real case scenario, you may want to add this
	// into the script file of your theme/plugin.
    jQuery(function ($) {
        acf.add_filter('validation_complete', function (json, form_element, form) {
            if (json.errors) {
                // Return the errors to show in the ACF form
                return json;
            }
            if (form_element.is('#ajax_acf_form_id')){
                // Active AJAX submission for the form with the given ID
                form_element.submit(function (event) {
                    event.preventDefault();
                    let formData = new FormData(this);
                    acf.lockForm($(form_element));
                    $.ajax({
                        type: 'POST',
                        url: window.location.href,
                        data: formData,
                        processData: false,
                        contentType: false,
                        statusCode: {
                            500: function(responseObject, textStatus, errorThrown) {
                                let errorText = "There are some errors in this form. Please check again!"; // Change this if required
                                if(responseObject.responseText){
                                    errorText = $($.parseHTML(responseObject.responseText)).filter("div.wp-die-message").html();
                                }
                                acf.unlockForm(form_element);
                                let notice = acf.newNotice({
                                    type: 'error',
                                    text: errorText,
                                    target: form_element
                                });
                                form.set('notice', notice);
                            }
                        }
                    }).success(function (response) {
                        acf.unlockForm($(form_element));
                        // Actions to take on successful AJAX submission
                        // In this example, we are triggering a Sweetalert message
                        Swal.fire({
                            icon: "success",
                            title: "Your post has been added",
                            text: "Congrats! Your poss has been added successfully."
                        });
                        // Reset the form data
                        $('#ajax_acf_form_id').trigger('reset');
                    });
                    return false;
                });
            }
            return json;
        });
    });
</script>
<?php get_footer(); ?>