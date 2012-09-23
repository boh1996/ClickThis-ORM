<?php
/**
 * This function implodes a assoc array
 * @param  string $delemiter The delemiter between the key and value
 * @param string $element_delemiter The delemiter the different elements 
 * @param  array $array     The array to implode
 * @return string
 * @since 1.0
 */
function assoc_implode($delemiter = "&",$element_delemiter = "=",$array = NULL){
	if(!is_null($array) && !is_null($delemiter) && !is_null($element_delemiter)){
		$return = "";
		foreach ($array as $key => $value) {
			$return .= $key . $delemiter . $value.$element_delemiter;
		}
		$return = rtrim($return,$element_delemiter);
		return $return;
	} else {
		return "";
	}
}

/**
 * This function mixes two arrays together,
 * taking the keys from one and the values from the other.
 * This can be usefull when doing preq match,
 * so the result can be accessed like this array["key"] => value in a situation like this,
 * Message: My message could be accessed like this $matches["Message"]
 * @param  array $keys   The array containing the keys to use
 * @param  type $values The array containing the values to use
 * @return array
 * @author Bo Thomsen, <bo@illution.dk>
 */
function array_mix ($keys, $values) {
	$output = array();
	foreach (array_values($keys) as $index => $key) {
		$output[$key] = current(array_slice(array_values($values), $index, $index+1));
	}
	return $output;
}
    
/**
 * This function recieves a array value at a position
 * @param  array $array    The array to get the value from
 * @author Bo Thomsen, <bo@illution.dk>
 * @param  integer $position The position of the value to get
 * @return string|integer|boolean|object
 */
function array_position ( $array, $position) {
    return array_slice(array_values($array),$position, $position + 1);
}	

/**
 * This function takes an array, an array of keys and a optional offset,
 * and then return an array of the different values in the keys, 
 * mixed to an array or object
 * @param  array  &$array The array to take from
 * @param  array  $keys   The keys to take
 * @param  integer $offset An optional offset in values
 * @param  boolean $class  If the returned array should contain, array or stdClass values
 * @author Bo Thomsen, <bo@illution.dk>
 * @return array
 */
function array_multi_key_mix ( &$array, $keys, $offset = 0, $class = true) {
    $return = array(); 
    for ($i = $offset; $i <= count($array[$keys[0]]) - $offset ; $i++) { 
        if ($class) {
           $return[$i] = new stdClass;     
        } else {
            $return[$i] = array();
         }
        foreach ($keys as $key) {
            if ($class) {
                $data = array_position($array[$key], $i);
                $return[$i]->{$key} = (is_array($data) && count($data) > 1) ? $data : (is_array($data)) ? current($data) : $data;
            } else {
                $data = array_position($array[$key], $i);
                $return[$i][$key] = (is_array($data) && count($data) > 1) ? $data : (is_array($data)) ? current($data) : $data;;
            }
        }
    }
    return $return;   
}
?>