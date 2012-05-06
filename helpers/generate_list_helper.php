<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function generate_list($resource, $options, $template)
{
    if (is_object($resource)) $resource = get_object_vars($resource);
    
    // Check options, and put to default if unset
    if (!isset($options)) $options = array();
    if (!isset($options['level']))                 $options['level'] = 0;
    if (!isset($options['indent']))             $options['indent'] = '';
    if (!isset($options['link']))                 $options['link'] = '';
    if (!isset($options['ignore']))             $options['ignore'] = array();
    if (!isset($options['selected']))            $options['selected'] = array();
    if (!isset($options['template_head']))         $options['template_head'] = '';
    if (!isset($options['template_foot']))         $options['template_foot'] = '';
    if (!isset($options['use_top_wrapper']))    $options['use_top_wrapper'] = true;
    if (!isset($options['alternate']))             $options['alternate'] = array();
    if (!isset($options['current_alternate']))     $options['current_alternate'] = 0;
    if (!isset($options['functions']))             $options['functions'] = array();
    
    // create options for next level
    $next_options = $options;
    $next_options['level']++;
    
    // instantiate output variable
    $output = '';
    
    // add the list header
    if ($options['level'] > 0 or $options['use_top_wrapper']) $output = $options['template_head'];
    
    // count the number of values in resource
    $resource_count = count($resource);
    
    // create the list
    foreach($resource as $item)
    {
        // create a temporary variable for each item
        $item_output = $template;
        
        // if there are methods set, replace their tags
        if (count($options['functions']) > 0)
        {
            foreach($options['functions'] as $function)
            {
                $ci =& get_instance();
                
                if (method_exists($function[1], $function[0]))
                {
                    if (get_class($ci) == $function[1])
                        $replace_value = $ci->$function[0]($options['level'], $options['current_alternate'], $item['id']);
                    else
                        $replace_value = $ci->$function[1]->$function[0]($options['level'], $options['current_alternate'], $item['id']);
                    $item_output = str_replace('{'.strtoupper($function[0]).'}', $replace_value, $item_output);
                }
                elseif (function_exists($function[1]))
                {
                    $replace_value = $function[0]($options['level'], $options['current_alternate'], $item['id']);
                    $item_output = str_replace('{'.strtoupper($function[0]).'}', $replace_value, $item_output);    
                }
            }
        }
        
        // place the values in the item variable
        if (!is_array($item))
        {
            $item_output = str_replace('{CONTENT}', $item, $item_output);
        }
        else
        {
            // check the ignore values
            if (count($options['ignore']) > 0)
            {
                foreach($options['ignore'] as $ignore => $ignore_value)
                {
                    if (is_array($ignore_value))
                    {
                        foreach ($ignore_value as $ignore_val_val)
                        {
                            if ($item[$ignore] == $ignore_val_val)
                            {
                                $item_output = '';
                            }
                        }
                    }
                    else
                    {
                        if ($item[$ignore] == $ignore_value)
                        {
                            $item_output = '';
                        }
                    }
                }
            }
            
            foreach ($item as $key => $value)
            {
                // if the value is an array, replace any instance of SUBS with a sublist
                if (!is_array($value))
                {
                    $item_output = str_replace('{'.strtoupper($key).'}', $value, $item_output);
                }
                else
                {
                    if (empty($value)) $sublist = '';
                    else $sublist = generate_list($value, $next_options, $template);
                    if ($sublist != '') $sublist = $options['link'].$sublist;
                    $item_output = str_replace('{SUBS}', $sublist, $item_output);
                }
            }
        }
        
        // check if any values were replaced, if not assume sublist, generate and continue
        if ($item_output == $template && is_array($item))
        {
            $item_output = generate_list($item, $next_options, $template);
            if ($resource_count > 1 && $item_output != '')
            {
                $item_output .= $options['link'];
                $resource_count--;
            }
            $output .= $item_output;
            continue;
        }
        
        // place the indent
        $item_output = str_replace('{INDENT}', str_repeat($options['indent'], $options['level']), $item_output);
        
        // place the alternation
        if (is_array($options['alternate']) && !empty($options['alternate']))
        {
            $alternate_max = count($options['alternate']);
            $alternate = $alternate_max;
            while($options['current_alternate'] % $alternate != 0 && $alternate > 0) $alternate--;
            $item_output = str_replace('{ALTERNATE}', $options['alternate'][$alternate - 1], $item_output);
        }
        
        // link the items with the link only if it isn't the last item
        if ($resource_count > 1 && $item_output != '')
        {
            $item_output .= $options['link'];
        }
        
        // update the counters before next iteration
        $options['current_alternate']++;
        $resource_count--;
        
        // cleanup and replace any leftover tags
        $item_output = preg_replace('/\{([a-zA-z0-9_]*)\}/', '', $item_output);
        
        // place the new item at the end of the current list
        $output .= $item_output;
        unset($item_output);
    }
    
    // close the list with the list footer
    if ($options['level'] > 0 or $options['use_top_wrapper']) $output .= $options['template_foot'];
    
    // remove any double "link"-s  -- IMPROVE THIS FIX, PREVENT FROM HAPPENING, happens at the end of a sublist when its ignored
    $output = str_replace($options['link'].$options['link'], $options['link'], $output);
    
    // ... and return the output
    return $output;
}

/* End of file generate_list_helper.php */
/* Location: ./system/application/helpers/generate_list_helper.php */ 