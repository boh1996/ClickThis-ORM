<?php
/**
 * This is the standard model, for normal datas
 * @package Standard Model
 * @license http://illution.dk/copyright © Illution 2012
 * @subpackage Std_Model
 * @category Models
 * @version 1.21
 * @author Illution <support@illution.dk>
 */ 
class Std_Model extends CI_Model{

	/**
	 * This function is the constructor, it creates a local instance of CodeIgniter
	 * @access public
	 * @since 1.0
	 */
	public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function either returns the Database name convert
     * or the row name convert
     * @param object &$CLass The class to get the information from
     * @param string $Type The array to return DATABASE_NAME_CONVERT
     * or  "ROW_NAME_CONVERT"
     * @return array
     * @since 1.1
     * @access public
     */
    public function Get_Names(&$Class, $Type = "DATABASE_NAME_CONVERT"){
    	switch($Type){
			case "DATABASE_NAME_CONVERT":
				return self::_Create_Conversion_Table($Class,"Database");
			break;

	        case "ROW_NAME_CONVERT":
	        	return self::_Create_Conversion_Table($Class,"Row");
	        break;
        }
    }

    /**
     * This function gets or creates a convertion table if any data is existing
     * @param object $Object The object to create from
     * @param string $Type   The tpye "Database" or "Row"
     * @since 1.0
     * @access private
     * @return array
     */
    private function _Create_Conversion_Table($Object,$Type = "Database"){
    	if(is_object($Object)){
    		if($Type == "Database"){
    			if(isset($Object->_INTERNAL_DATABASE_NAME_CONVERT) && is_array($Object->_INTERNAL_DATABASE_NAME_CONVERT)){
    				return $Object->_INTERNAL_DATABASE_NAME_CONVERT;
    			} else if(isset($Object->_INTERNAL_ROW_NAME_CONVERT) && is_array($Object->_INTERNAL_ROW_NAME_CONVERT)){
    				return array_flip($Object->_INTERNAL_ROW_NAME_CONVERT);
    			} else {
    				return array();
    			}
    		} else {
    			if(isset($Object->_INTERNAL_ROW_NAME_CONVERT) && is_array($Object->_INTERNAL_ROW_NAME_CONVERT)){
    				return $Object->_INTERNAL_ROW_NAME_CONVERT;
    			} else if(isset($Object->_INTERNAL_DATABASE_NAME_CONVERT) && is_array($Object->_INTERNAL_DATABASE_NAME_CONVERT)){
    				return array_flip($Object->_INTERNAL_DATABASE_NAME_CONVERT);
    			} else {
    				return array();
    			}
    		}
    	} else {
    		return array();
    	}
    }

    /**
	 * This function uses the internal _INTERNAL_DATABASE_NAME_CONVERT to convert the property names,
	 * to the database row names
	 * @param array $Data The exported data, from the class
	 * @param object $Class The class to get the conversion table from
	 * @access private
	 * @since 1.0
	 * @see _INTERNAL_DATABASE_NAME_CONVERT
	 * @internal This function is only used inside this model, to convert the exported data to the right format
	 * @return array The data with the right key names
	 */
	private function _Convert_Properties_To_Database_Row($Data = NULL,&$Class = NULL){
		if(!is_null($Data) && !is_null($Class)){
			$Table = self::_Create_Conversion_Table($Class);
			if(count($Table) > 0){
				$Array = array();
				foreach ($Data as $Key => $Value) {
					$Array[self::_Get_Database_Row_Name($Class,$Key,$Table)] = $Value;
				}
				return $Array;
			} else {
				return $Data;
			}	
		} else {
			return $Data;
		}
	}

	/**
	 * This function converts a database row to class property name
	 * @since 1.21
	 * @access private
	 * @param object &$Class The object to find the conversion table in
	 * @param stirng $Key    The database row name
	 */
	private function _Convert_Row_To_Property (&$Class, $Key) {
		$Table = self::_Create_Conversion_Table($Class,"Row");
		if (is_array($Table) && count($Table) > 0) {
			if (array_key_exists($Key, $Table)) {
				return $Table[$Key];
			} else {
				return $Key;
			}
		} else {
			return $Key;
		}
	}

	/**
	 * This function converts the class properties to database row names
	 * @param object $Object The object that is going to be converted
	 * @param string $Key    Thd class property to convert
	 * @param array $Table Conversion table
	 * @since 1.1
	 * @access private
	 * @return string
	 */
	private function _Get_Database_Row_Name($Object = NULL,$Key = NULL,$Table = NULL){
		if(is_null($Table) || !is_array($Table)){
			$Table = self::_Create_Conversion_Table($Class);
		}
		if(is_array($Table) && count($Table) > 0){
			if(array_key_exists($Key, $Table)){
				return $Table[$Key];
			} else {
				return $Key;
			}
		} else {
			return $Key;
		}
	}

	/**
	 * This function loads data from $Table, based on the query in $Link
	 * @param string||array $Table  The table(s) to search in 
	 * @param array $Link   An array with the query
	 * @example
	 * Link("Questions",array("Lmmaa" => "Duck",$this));
	 * @param object &$Class The class where the data is taken from
	 * @param string|array $Select The row/rows to select
	 * @return array An array of the query result data
	 * @since 1.0
	 * @todo  Add a link like, example with, link all the users if their TargetGroup contains this group id
	 * @access public
	 */
	public function Link($Table = NULL,$Link = NULL,&$Class = NULL,$Select = NULL){
		if(!is_null($Table) && !is_null($Link) && !is_null($Class) && is_array($Link)){
			if(is_null($Select)){
				$Select = "id";
			}
			if(is_array($Select)){
				$Select = implode(",", $Select);
			}
			if(!is_array($Table)){
				$this->db->select($Select);
				$Query = $this->db->get_where($Table,$Link);
				$Result = $Query->result();
				return $Query->result();
			} else {
				$Result = array();
				foreach ($Table as $Name) {
					$this->db->select($Select);
					$Query = $this->db->get_where($Name,$Link);
					$Temp = $Query->result();
					$Result[] = $Temp[0];
				}
				if(count($Result) > 0){
					return $Result;
				}

			}
		}
	}

	/**
	 * This function checks if a row Exists in the database
	 * @param integer $Id The database row id for the row to check for
	 * @param string $Table The database table to look up in
	 * @access private
	 * @since 1.0
	 * @return boolean The result, if the user doesn't exist or the input is wrong then FALSE is returned,
	 * else TRUE is returned.
	 */
	private function _Exists($Id = NULL,$Table = NULL){
		if(!is_null($Id) && !is_null($Table) && !is_array($Id)){
			$Query = $this->db->where(array("id" => $Id))->get($Table);
			if(!is_null($Query) && $Query->num_rows() == 0){
				return false;
			}
			else{
				return true;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function converts the fields array names into database column names
	 * @since 1.21
	 * @access private
	 * @param array  $Fields The array to convert
	 * @param object &$Class The class to get the conversion table from
	 */
	private function _Convert_Fields (array $Fields, &$Class) {
		$Table = self::_Create_Conversion_Table($Class,"Database");
		if(count($Table) > 0){
			$Array = array();
			foreach ($Fields as $Index => $Key) {
				$Array[] = self::_Get_Database_Row_Name($Class,$Key,$Table);
			}
			return $Array;
		} else {
			return $Fields;
		}	
	}

	/**
	 * This function loads class data from the database table,
	 * and assign it to the object in $Class
	 * @param integer $Id    An optional database id for the row, if it's not deffined the $Class->id will be used.
	 * @param object &$Class The class to assign the data too
	 * @param array $Fields The fields to select
	 * @return boolean If there's data available and it's loaded true is returned else is false returned
	 * @access public
	 * @since 1.0
	 */
	public function Load($Id = NULL,&$Class = NULL,array $Fields = NULL){
		if(!is_null($Class) && property_exists($Class, "Database_Table")){
			if(!is_null($Id)){
				$Class->id = $Id;
			}
			$Fields = implode(",", self::_Convert_Fields($Fields,$Class));
			if(!is_null($Class->id) && self::_Exists($Class->id,$Class->Database_Table)){
				$ClassQuery = $this->db->limit(1)->select($Fields)->where(array("id" => $Class->id))->get($Class->Database_Table);
				$Row = current($ClassQuery->result());
				foreach ($Row as $Key => $Value) {
					$Key = self::_Convert_Row_To_Property($Class,$Key);
					if(property_exists($Class, $Key)){
						$Value = self::_Explode($Value);
						if($Value !== false && !is_null($Value)){
							$Class->{$Key} = $Value;
						}
					}
				}
				return TRUE;
			} else {
				return FALSE;
			}	
		} else {
			return false;
		}
	}

	/**
	 * This function explodes the input data with the specified Delemiter,
	 * using trim too
	 * @since 1.0
	 * @access private
	 * @param string $Data      The input data
	 * @param string $Delemiter The delemiter
	 * @return array|boolean
	 */
	private function _Explode ( $Data , $Delemiter = ";" ) {
		if (!is_null($Data) && is_string($Delemiter) && !empty($Data) && $Data != "") {
			if (strpos($Data, $Delemiter) !== false) {
				$Data = rtrim($Data,$Delemiter);
				$Data = ltrim($Data,$Delemiter);
				return explode($Delemiter, $Data);
			} else {
				return $Data;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function inserts data into the db and return the insert_id
	 * @param object &$Class The class to get the data from
	 * @since 1.0
	 * @access public
	 * @return integer The new database id
	 */
	public function Create(&$Class){
		if(method_exists($Class, "Export") && property_exists(get_class($Class), "Database_Table")){
			$data = $Class->Export(true);
			$this->CI->db->insert($Class->Database_Table, $data); 
			return $this->CI->db->insert_id();
		}
	}

	/**
	 * This function saves the class data to the server
	 * @param object &$Class The instance of the class, with the data to save
	 * @access public
	 * @since 1.0
	 * @return boolean If the operation was succes
	 */
	public function Save(&$Class = NULL){
		if( property_exists($Class, "Database_Table")){
			self::_Data_Exists($Class);
			if((isset($Class->id) || isset($Class->id)) && self::_Exists($Class->id,$Class->Database_Table)){

				if (method_exists($Class, "Data_Updated")) {
					$Class->Data_Updated();
				}
				
				$Data = $Class->Export(true);
				if(property_exists($Class, "Database_Table") && count($Data) > 0){
					$this->db->where(array('id' => $Class->id))->update($Class->Database_Table, self::_Convert_Properties_To_Database_Row($Data,$Class));
					return true; //Maybe a check for mysql errors
				} else {
					return false;
				}
			} else{
				if(isset($Class->id)){
					$Id = $Class->id;
				} else if($Class->id){
					$Id = $Class->id;
				} else {	
					$Id = NULL;
				}
				if(!self::_Exists($Id)){

					if (method_exists($Class, "Data_Updated")) {
						$Class->Data_Updated();
					}

					if (method_exists($Class, "Data_Created")) {
						$Class->Data_Created();
					}
					
					$Data = $Class->Export(true);
					if(!is_null($Data) && !is_null($Class) && count($Data) > 0){
						$this->db->insert($Class->Database_Table, self::_Convert_Properties_To_Database_Row($Data,$Class));
						if(property_exists($Class, "id")){
							$Class->id = $this->db->insert_id();
						} else {
							$Class->id = $this->db->insert_id();
						}
						return true; //Maybe a check for mysql errors?
					} else {
						return FALSE;
					}
				}
			}
		} else {
			return false;
		}
	}

	/**
	 * This function gets an id of a dublicate, if it _Exists
	 * @param object &$Class The class to get the data from
	 * @return integer If there is an result then the id of the dublicate is returned
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Dublicate_Id(&$Class = NULL){
		if(is_object($Class)){
			$Data = $Class->Export(true);
			$Data = self::_Convert_Properties_To_Database_Row($Data);
			if(is_null($Class->id)){
				$Query = $this->db->limit(1)->get_where($Class->$Database_Table,$Data);
			} else {
				$Query = $this->db->not_like("id",$Class->id)->limit(1)->get_where($Class->$Database_Table,$Data);
			}
			if($Query->num_rows() > 0){
				foreach ($Query->result() as $Row) {
					return $Row->$id;
				}
			}
		}
	}

	/**
	 * This function get's the data of a classes _INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL,
	 * data
	 * @param object &$Class The reference class
	 * @return boolean The data of the settings property
	 * @since 1.1
	 * @access private
	 */
	private function _Check_For_Data_Dublicate(&$Class = NULL){
		if(!is_null($Class)){
			if(property_exists($Class, "_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL") && !is_null($Class->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL) && is_bool($Class->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL)){
				return $Class->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
		}
	}

	/**
	 * This function checks if a class has a full dublicate in the database, if the  true is returned
	 * @param object &$Class The class to get the data from
	 * @return boolean If it has a dublicate
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Duplicate(&$Class = NULL){
		if(!is_null($Class)){
			$Data = $Class->Export(true);
			$Data = self::_Convert_Properties_To_Database_Row($Data);
			if(is_null($Class->id)){
				$Query = $this->db->limit(1)->get_where($Class->$Database_Table,$Data);
			} else {
				if(self::_Check_For_Data_Dublicate($Class)){
					$Query = $this->db->not_like("id",$Class->id)->limit(1)->get_where($Class->$Database_Table,$Data);
				} else {
					$Query = NULL;
				}
			}
			if(!is_null($Query) && $Query->num_rows() > 0){
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	/**
	 * This function sets the id of the $Class to an
	 * id of a dublicate if one _Exists, so the dublicate would be overwritten
	 * @param object &$Class The object to use data for and set data too
	 * @since 1.1
	 * @access private
	 * @return boolean If dublicate data _Exists
	 */
	private function _Data_Exists(&$Class = NULL){
		if(!is_null($Class)){
			if(self::_Has_Duplicate() != false){
				if(property_exists($Class, "id")){
					$Class->id = self::_Get_Duplicate_Id($Class);
					return TRUE;
				}
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function matches, data in the database and if some data _Exists, then the 
	 * id of the $Class is set to the id of the dublicate
	 * @param object &$Class    The object to set the id of
	 * @param array $QueryData The data to check for
	 * @since 1.1
	 * @access public
	 * @return boolean If matched data was found
	 */
	public function Match_Data(&$Class = NULL,$QueryData = NULL){
		if(!is_null($QueryData) && !is_null($Class) && is_array($QueryData)){
			if(isset($Class->id)){
				$QueryData["id"] = "!= ".$Class->id;
			}
			if(isset($Class->id)){
				$QueryData["id"] = "!= ".$Class->id;
			}
			$QueryData = self::_Convert_Properties_To_Database_Row($QueryData,$Class);
			if(property_exists($Class, "Database_Table")){
				$Query = $this->db->limit(1)->get_where($Class->Database_Table,$QueryData);
				if($Query->num_rows() > 0){
					foreach ($Query->result() as $Row) {
						if(property_exists($Class, "id")){
							if(!property_exists($Row, "id")){
								$Class->id = $Row->id;
								return TRUE;
							} else {
								$Class->id = $Row->id;
								return TRUE;
							}
						}
					}
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function creates the LIKE query,
	 * and tries to get the right result if the data is splitted
	 * @param array $Array The search query
	 * @param string $Table The table to search in
	 * @param object &$Class The class the is going to be filled with data
	 * @since 1.1
	 * @access private
	 * @return integer The database id of the data
	 */
	 private function _Get_Query_Data($Array = NULL,$Table = NULL,&$Class){
       if(!is_null($Array) && !is_null($Table)){
            $Like = array();
            $Or_Like = array();
            foreach ($Array as $Key => $Value) {
                if(strpos($Value, "$") !== false){
                    $Like[$Key] = str_replace("$", "", ";".$Value.";");
                    $Or_Like[$Key] = str_replace("$", "", $Value);
                } else {
                    $Like[$Key] = $Value;
                    $Or_Like[$Key] = $Value;
                }
            }
            if(property_exists($Class, "id")){
            	$Select = "id";
            } else {
            	$Select = "id";
            }
           if(count($Like) > 0){
                $this->db->limit(1)->select($Select)->like($Like);
            }
            $Raw = $this->db->get($Table);
            if($Raw->num_rows == 0 && count($Or_Like) > 0){
                $Raw = $this->db->like($Or_Like)->limit(1)->select($Select)->get($Table);
            }
            return $Raw;
        } else {
            return array();
        }
    }

	/**
	 * This function finds a row based on a query, this function always select the first element.
	 * The column names are converted using the Convert_Properties_To_Row function.
	 * @param array $Query The assosiative array containing the search
	 * @param string $Table The table to search in
	 * @param object &$Class The current object
	 * @version 1.1
	 * @access public
	 * @example
	 * @return boolean|integer This function returns FALSE if fail and an id if success.
	 * Find("Name" => "Bo","Users");
	 */
	public function Find($Query = NULL,$Table = NULL,&$Class = NULL){
		if(!is_null($Query) && is_array($Query) && !is_null($Table)){
			$Data = self::_Convert_Properties_To_Database_Row($Query,$Class);
			if(!is_null($Data)){
				$Raw = self::_Get_Query_Data($Data,$Table,$Class);
				if($Raw->num_rows() > 0){
					$Row = current($Raw->result());
					if(isset($Row->id)){
						return $Row->id;
					} else {
						return $Row->id;
					}
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}
?>