## AJAX Reply Form ##
This snippet uses ``SweetAlert`` to make a reply popup. 
When you click on the **Reply** button, the popup will appear for you
to fill in the reply. When click **Submit Reply**, it will submit 
via AJAX, so no redirection here. When the form submission is successful,
it will reload the page to show new replies.

The codes are written and tested with the default **Twenty Twenty-Four**
theme. If your theme use a different class for the reply button, 
please update as needed.

### How to Use? ###
1. Copy the code in ``functions.php`` to your theme's ``functions.php``. 
2. Copy the code in ``js/custom-ajax.js`` to your js file, 
or add a new js file in your theme with the given code.
Remember to enqueue the js file if
you haven't already
3. Check if it works. If the SweetAlert doesn't
show, check the class of your ``Reply`` button.

