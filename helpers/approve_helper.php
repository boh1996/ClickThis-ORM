<?php

/**
 * This function decides if a translation should be approved first,
 * before a translation is accepted for export
 * 
 * @param  object<Project> $Project The project that is opened
 * @param  object<File> $File    The opened file
 * @param  object<Key> $Key     The opened key
 * @return bool
 */
function approve_first_key_object ( &$Project, &$File, &$Key ) {

	if ( (bool)$Project->approve_first === true ) return true;

	if ( (bool)$File->approve_first === true ) return true;

	if ( (bool)$Key->approve_first === true ) return true;

	return false;
}

/**
 * This function decides if a translation should be approved first,
 * before a translation is accepted for export
 * 
 * @param  object<Project> $Project The project that is opened
 * @param  object<File> $File    The opened file
 * @return boolean
 */
function approve_first_file_object ( &$Project, &$File ) {
	if ( (bool)$Project->approve_first === true ) return true;

	if ( (bool)$File->approve_first === true ) return true;

	return false;
}

/**
 * This function decides if a translation should be approved first,
 * before a translation is accepted for export
 * 
 * @param  boolean $project The project that is opened
 * @param  boolean $file    The opened file
 * @param  boolean $key     The opened key
 * @return bool
 */
function approve_first_key_bool ( $project, $file, $key ) {
	if ( (bool)$project === true ) return true;

	if ( (bool)$file === true ) return true;

	if ( (bool)$key === true ) return true;

	return false;
}

/**
 * This function decides if a translation should be approved first,
 * before a translation is accepted for export
 * 
 * @param  boolean $project The project that is opened
 * @param  boolean $file    The opened file
 * @return boolean
 */
function approve_first_file_bool ( $project, $file ) {
	if ( (bool)$project === true ) return true;

	if ( (bool)$file === true ) return true;

	return false;
}
?>