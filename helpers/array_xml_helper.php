<?php
/**
 * The main function for converting to an XML document.
 * Pass in a multi dimensional array and this recrusively loops through and builds up an XML document.
 *
 * @param array $data
 * @param string $rootNodeName - what you want the root node to be - defaultsto data.
 * @param SimpleXMLElement $xml - should only be used recursively
 * @return string XML
 */
function array_to_xml($data = NULL, $rootNodeName = 'response', $xml=null)
{
	if(!is_null($data) && is_array($data)){
		// turn off compatibility mode as simple xml throws a wobbly if you don't.
		if (ini_get('zend.ze1_compatibility_mode') == 1)
		{
			ini_set ('zend.ze1_compatibility_mode', 0);
		}

		if ($xml == null)
		{
			$xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
		}

		// loop through the data passed in.
		foreach($data as $key => $value)
		{
			if(is_object($value)){
				$value = get_object_vars($value);
			}
			// no numeric keys in our xml please!
			if (is_numeric($key))
			{
				// make string key...
				$key = "element_". (string) $key;
			}

			// replace anything not alpha numeric
			$key = preg_replace('/[^a-z]/i', '', $key);

			// if there is another array found recrusively call this function
			if (is_array($value))
			{
				$node = $xml->addChild($key);
				// recrusive call.
				array_to_xml($value, $rootNodeName, $node);
			}
			else 
			{
				// add single node.
                            	if(is_bool($value)){
                            		$value = (int) $value;
                            	}
                            	$value = htmlentities($value);

				$xml->addChild($key,$value);
			}

		}
		// pass back as string. or simple xml object if you want!
		$Return = $xml->asXML();
		return str_replace("unknownNode", "element", $Return);
	} else {
		return "";
	}
}

/**
 * This function converts an object to an array
 * @param  object $object The object to convert to array
 * @return array
 */
function object_to_array($object = null){
	$array = array();
	if(!is_null($object)){
		foreach (get_object_vars($object) as $key => $value) {
			if(is_object($value)){
				$array[$key] = object_to_array($value);
			} else {
				$array[$key] = $value;
			}
		}
	}
	return $array;
}
?>