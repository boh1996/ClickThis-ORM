<?php
/**
 * Use this function to fetch a GLOBALS key, set a GLOBALS key or return the GLOBALS array
 *
 * @since 1.0
 * @param  string $key   The key to fetch or set "value" to.
 * @param  string|array|object|int|boolean $value The value to set to "key"
 * @return string|boolean|array
 */
function globals ( $key = null, $value = null ) {
	if ( is_null($key) ) {
		return $GLOBALS;
	}

	if ( is_null($value) ) {
		return ( array_key_exists($key, $GLOBALS) ) ? $GLOBALS[$key] : false;
	}

	$GLOBALS[$key] = $value;
}

/**
 * Use this function to retrieve all cookies, set a cookie and get a specific cookie key
 *
 * @since 1.1
 * @param  string  $key      The cookie name to retrive or set
 * @param  string  $value    The value to set for the cookie "key"
 * @param  integer $expires  Use 0 if the cookie shall never expire, else set a ttl
 * @param  string  $domain   The domain, the cookie is for
 * @param  boolean $secure   If the cookie is HTTPS only
 * @param  boolean $httponly If the cookie is HTTP only
 * @return string|boolean|array
 */
function request_cookie ( $key = null, $value = null, $expires = 0, $domain = "/", $secure = false, $httponly = false ) {
	if ( is_null($key) ) return $_COOKIE;

	if ( is_null($value) ) {
		return ( array_key_exists($key, $_COOKIE) ) ? $_COOKIE[$key] : false;
	}

	setcookie($key, $value, $expires, $domain, $secure, $httponly);
}

/**
 * Use this to retrieve a single file key or the whole $_FILES array
 *
 * @since 1.1
 * @param  string $key The files key to retrieve
 * @return array|string|boolean
 */
function request_file ( $key = null ) {
	if ( is_null($key) ) return $_FILES;

	return ( array_key_exists($key, $_FILES) ) ? $_FILES[$key] : false;
}

/**
 * This function can return a key or the whole server array
 *
 * @since 1.1
 * @access public
 * @param  string $key The key to fetch
 * @return boolean|array|string
 */
function server ( $key = null ) {
	if ( is_null($key) ) {
		return $_SERVER;
	}

	return ( array_key_exists($key, $_SERVER) ) ? $_SERVER[$key] : false;
}

/**
 * Use this to retrieve the whole $_SESSION array, to retrieve a single key or to set a value
 *
 * @since 1.1
 * @access public
 * @param  string $key   The key to set or fetch
 * @param  string|array|boolean $value The value to set to "key"
 * @return array|string|boolean
 */
function session ( $key = null, $value = null ) {
	if ( is_null($key) ) return $_SESSION;

	if ( is_null($value) ) {
		return ( array_key_exists($key, $_SESSION) ) ? $_SESSION[$key] : false;
	}

	$_SESSION[$key] = $value;
}

/**
 * Use this function to get all request header, get one request header or set a response header
 *
 * @since 1.1
 * @access public
 * @param  string $key   The key to set or fetch
 * @param  string $value The value to set to "key"
 * @return string|array|boolean
 */
function header_helper ( $key = null, $value = null ) {
	if ( function_exists("apache_request_headers") ) {
		$headers = apache_request_headers();
	} else {
		$headers = _parseRequestHeaders();
	}

	if ( is_null($key) ) {
		return $headers;
	}

	if ( is_null($value) ) {
		return ( array_key_exists($key, $headers) ) ? $headers[$key] : false;
	}

	header($key.": ".$value);
}

/**
 * This function return all request headers
 *
 * @since 1.1
 * @access public
 * @return array
 */
function headers () {
	return _parseRequestHeaders();
}

/**
 * This function returns all the request headers
 *
 * @since 1.1
 * @access private
 * @return array
 */
function _parseRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}

/**
 * If no key is specified then thew whole request array is returned,
 * if the key is found the value is returned and if the key isn't false is returned
 *
 * @since 1.1
 * @param  string $key The key to search for
 * @return array|boolean|string
 */
function request ( $key = null ) {
	if ( is_null($key) ) {
		return $_REQUEST;
	}

	if ( array_key_exists($key, $_REQUEST) ) {
		return $_REQUEST[$key];
	}

	return false;
}

/**
 * This function checks if the env key is set
 *
 * @since 1.1
 * @param  string $key The key to fetch
 * @return string|array|boolean
 */
function env( $key = null ) {
	if ( is_null($key) ) {
		return $_ENV;
	}

	if ( array_key_exists($key, $_ENV) ) {
		return $_ENV[$key];
	}

	return false;
}
?>