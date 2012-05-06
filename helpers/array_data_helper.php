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
?>