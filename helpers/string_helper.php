<?php
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

/**
 * This function does a binary 
 * hmac_sha1
 * @param  string $key  The hmac password
 * @param  string $data The data to encrypt
 * @return string
 * @since 1.0
 */
function hmacsha1($key,$data) {
	    $blocksize=64;
	    $hashfunc='sha1';
	    if (strlen($key)>$blocksize)
	        $key=pack('H*', $hashfunc($key));
	    $key=str_pad($key,$blocksize,chr(0x00));
	    $ipad=str_repeat(chr(0x36),$blocksize);
	    $opad=str_repeat(chr(0x5c),$blocksize);
	    $hmac = pack(
	                'H*',$hashfunc(
	                    ($key^$opad).pack(
	                        'H*',$hashfunc(
	                            ($key^$ipad).$data
	                        )
	                    )
	                )
	            );
	    return $hmac;
}
/**
 * This function encodes the url with the right encoding
 * @param  string|array $input The string to encode
 * @return string|array
 */
function urlencode_rfc3986($input) {
    if (is_array($input)) {
        return array_map(array($this, '_urlencode_rfc3986'), $input);
    }
    else if (is_scalar($input)) {
        return str_replace('+',' ',str_replace('%7E', '~', rawurlencode($input)));
    } else{
        return '';
    }
}
?>