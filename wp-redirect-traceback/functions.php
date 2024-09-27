<?php
function wp_redirect_tracback( $location, $status){
		$backtrace = debug_backtrace();
		// Print the backtrace information to help you troubleshoot the redirect issue.
		foreach ($backtrace as $call) {
				if (isset($call['file'])) {
						echo('Called from: ' . $call['file'] . ' on line ' . $call['line']) . "<br>";
				}
		}

		// Echo the $location and $status for additional details.
		echo "Redirecting Location: " . $location . "<br>";
		echo "Redirecting Status: " . $status;

		// Run die() to stop WordPress from (infinite) redirect
		die();
}
add_filter( 'wp_redirect','stop_redirect', 9999, 2);
