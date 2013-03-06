<?php
/**
 * Returns true if it's one of the applications and false if not
 * 
 * @return boolean
 */
function is_application () {
	return ( isset($_SERVER["HTTP_USER_AGENT"]) && ($_SERVER["HTTP_USER_AGENT"] == "CI/Windows" || $_SERVER["HTTP_USER_AGENT"] == "CI/Android"));
}

function is_ajax () {
	return (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}

/**
 * Returns true if it's the windows application that request or sends data
 * 
 * @return boolean
 */
function is_windows () {
	return ( isset($_SERVER["HTTP_USER_AGENT"]) && $_SERVER["HTTP_USER_AGENT"] == "CI/Windows");
}
?>