## WordPress Redirect Traceback ##

This snippet helps trace the exact `php` file that triggers the `wp_redirect()` function, or any other function that has an `action` or `filter` for you to hook your custom function to.

Imagine that you are facing an ongoing issue on your WordPress website. What can you do? Enable `WP_DEBUG`? Unfortunately, `WP_DEBUG` is often ineffective in this case.

What you can do is stop WordPress from performing redirections and trace the exact file that triggers the redirection so you can fix it.

This snippet does EXACTLY that!

### How to Use? ###
1. Copy the code in ``functions.php`` to your theme's ``functions.php``. 
2. Customise the ``filter`` or ``action`` if needed to suit you.
