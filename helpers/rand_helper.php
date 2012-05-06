<?php
/**
 * This function generates a random char
 * @param  integer $length The length of the random char
 * @return string
 * @since 1.0
 * @author John Johnson <stjohnjohnson.com>
 */
function rand_char($length = 16) {
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= chr(mt_rand(33, 126));
  }
  return $random;
}

/**
 * This function generates a random string using SHA-1
 * @param  integer $length The length of the random string
 * @return string
 * @since 1.0
 * @author John Johnson <stjohnjohnson.com>
 */
function rand_sha1($length = 16) {
  $max = ceil($length / 40);
  $random = '';
  for ($i = 0; $i < $max; $i ++) {
    $random .= sha1(microtime(true).mt_rand(10000,90000));
  }
  return substr($random, 0, $length);
}

/**
 * This function generates a random integer
 * @param  integer $length The length of the integer
 * @param  integer $min    The minimum number to use
 * @param  [type]  $max    The maximum number to use
 * @return integer
 * @since 1.0
 */
function rand_number($length = 16,$min = 0,$max = NULL){
	if(is_null($max)){
		$max = mt_getrandmax();
	}
	srand ((double) microtime( )*1000000);
	$random_number = mt_rand($min,$max);
	if(strlen($random_number) < $length){
		for ($i = 0; strlen($random_number) < $length; $i++) { 
			$random_number .= mt_rand($min,$max);
		}
	}
	$output = substr($random_number, 0, $length-1);
	return $output;
}

/**
 * This function generates a random string using md5
 * @param  integer $length The length of the random string
 * @return string
 * @since 1.0
 * @author John Johnson <stjohnjohnson.com>
 */
function rand_md5($length = 16) {
  $max = ceil($length / 32);
  $random = '';
  for ($i = 0; $i < $max; $i ++) {
    $random .= md5(microtime(true).mt_rand(10000,90000));
  }
  return substr($random, 0, $length);
}

/**
 * This function generates a random string
 * @param  integer $Length The length of the random string
 * @param  string  $Chars  The Charset to use
 * @return string
 * @author Kyle Florence <kyle.florence@gmail.com>
 */
function Rand_Str($Length = 32, $Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
{
    $Chars_Length = (strlen($Chars) - 1);
    $String = $Chars{rand(0, $Chars_Length)};
    for ($I = 1; $I < $Length; $I = strlen($String))
    {
        $R = $Chars{rand(0, $Chars_Length)};
        if ($R != $String{$I - 1}) $String .=  $R;
    }
    return $String;
}
?>