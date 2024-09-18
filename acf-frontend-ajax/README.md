# ACF Frontend Ajax
To use this snippet, you will need to have [ACF](https://wordpress.org/plugins/advanced-custom-fields/) or [ACF Pro](https://www.advancedcustomfields.com/pro/).

After install and active ACF or ACF Pro, add the ``acf_form()`` code to the page template you desire. Remember to also add ``acf_form_head()`` to that page to load necessary resources for the ``acf_form()``.

To enable Ajax Loading, add the Javascript code given at the end of ``page_testing.php`` file either directly to the page where you have your ``acf_form()``, or to the JavaScript file of your theme/plugin.