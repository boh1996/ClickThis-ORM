<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * This class i used as a parent for all the data classes,
 * the most of the other libraries is inherited from this library.
 * @package Libraries
 * @license http://illution.dk/copyright © Illution 2012
 * @subpackage Std Data Library Template
 * @category Library template
 * @package ClicKThis
 * @version 1.4
 * @author Illution <support@illution.dk>
 */ 
class Std_Library{

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = NULL;

	/**
	 * This property is used to convert class property names,
	 * to database row names
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an internal name convert table
	 * @example
	 * $_INTERNAL_DATABASE_NAME_CONVERT = array("Facebook_Id" =>"Facebook");
	 */
	public $_INTERNAL_DATABASE_NAME_CONVERT = NULL;

	/**
	 * The members of this array will be left out
	 * when saving data but now when loading data
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $_INTERNAL_DATABASE_SAVE_IGNORE = NULL;

	/**
	 * This array contains the properties that contain classes,
	 * that is going to be saved before the parent
	 * @var array
	 * @since 1.0
	 * @access public
	 * @static
	 * @example
	 * $_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("Property Name");
	 */
	public $_INTERNAL_SAVE_THESE_CHILDS_FIRST = NULL;

	/**
	 * This property can contain properties to be ignored when exporting
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an class variable used for ignoring variables in export
	 * @example
	 * $_INTERNAL_EXPORT_INGNORE = array("CI","_CI");
	 */
	public $_INTERNAL_EXPORT_INGNORE = NULL;

	/**
	 * This property can contain properties to be ignored, when the database flag is true in export.
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an internal ignoring list for export with the database flag turned on
	 * @example
	 * $_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
	 */
	public $_INTERNAL_DATABASE_EXPORT_INGNORE = NULL;

	/**
	 * This property contain values for converting databse rows to class properties
	 * @var array
	 * @see $_INTERNAL_DATABASE_NAME_CONVERT
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an internal databse column to class property convert table
	 * @example
	 * $_INTERNAL_ROW_NAME_CONVERT = array("Facebook" => "Facebook_Id");
	 */
	public static $_INTERNAL_ROW_NAME_CONVERT = NULL;

	/**
	 * This property contains the database model to use
	 * @var object
	 * @since 1.0
	 * @access public
	 * @static
	 * @example
	 * $this->_CI->load->model("Model_User","_INTERNAL_DATABASE_MODEL");
	 * @internal This property holds the CodeIgniter database model, 
	 * for importing and saving data for the class
	 * @example
	 * $this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
	 */
	public $_INTERNAL_DATABASE_MODEL = NULL;

	/**
	 * This property is used to define class properties that should be filled with objects,
	 * with the data that the property contains
	 * The data is deffined like this:
	 * $_INTERNAL_LOAD_FROM_CLASS = array("Property Name" => "Class Name To Load From");
	 * @var array
	 * @since 1.0
	 * @access public
	 * @static
	 * @internal This is a class setting variable
	 * @example
	 * $_INTERNAL_LOAD_FROM_CLASS = array("TargetGroup" => "Group");
	 */
	public $_INTERNAL_LOAD_FROM_CLASS = NULL;

	/**
	 * This property is used to declare link's between other databases and a class property in this class
	 * @var array
	 * @since 1.0
	 * @access public
	 * @example
	 * @static
	 * $this->_INTERNAL_LINK_PROPERTIES = array("Questions" => array("Questions",array("SeriesId" => "id"),array("Properties to select data from")));
	 * @see Link
	 */
	public $_INTERNAL_LINK_PROPERTIES = NULL;

	/**
	 * This property is used to determine what properties is going to be ignored,
	 * if the secrure parameter is turned on in the export function
	 * @var array
	 * @since 1.0
	 * @static
	 * @access public
	 * @example
	 * $this->_INTERNAL_LINK_PROPERTIES = array("Email,"Google_Id");
	 */
	public $_INTERNAL_SECURE_EXPORT_IGNORE = NULL;

	/**
	 * This property is used to give a property of each childobject in a property a given value
	 * @var array
	 * @since 1.1
	 * @access public
	 * @static
	 * @internal This is a class settings property
	 * @example
	 * array("Class Property" => array("Property" => "Value or name of property of this class"));
	 */
	public $_INTERNAL_SAVE_LINK = NULL;

	/**
	 * This property is used to force a specific property to be an array
	 * @var array
	 * @static
	 * @access public
	 * @since 1.0
	 * @example
	 * $this->_INTERNAL_FORCE_ARRAY = array("Questions");
	 */
	public $_INTERNAL_FORCE_ARRAY = NULL;

	/**
	 * This parameter is used to control the behavior, of the dublicate check,
	 * when a there is existing rows, what should happen.
	 * The following values are:
	 * "OVERWRITE" : This will reuse the existing id's and create new if needed, 
	 * "DELETE" : This will delete the old one's and create new id's, 
	 * "NONE" : This will create a new instance with the same data,
	 * "ONLY DUBLICATE" : This will let the normal dublicate check perform the action,
	 * "STOP" : This will stop the save function
	 * @var array
	 * @example
	 * array("employees" => "STOP");
	 * @since 1.3
	 * @access public
	 * @static
	 */
	public $_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION = NULL;

	/**
	 * This property is used to deffine properties, in the LOAD_FROM_CLASS
	 * that should only load their children with the simple mode turned on
	 * @var array
	 * @since 1.1
	 * @access public
	 * @static
	 * @example
	 * array("Class Property" => "Boolean");
	 * @internal This is a class setting property
	 */
	public $_INTERNAL_SIMPLE_LOAD = NULL;

	/**
	 * This property is used to deffine a set of rows that is gonna be
	 * unique for this row of data
	 * @var array
	 * @access public
	 * @since 1.1
	 * @static
	 * @internal This is a internal settings variable
	 * @example
	 * array("SeriesId","Title");
	 */
	public $_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = NULL;

	/**
	 * This property is used to abort the Dublicate check if
	 * one of the properties are empty.
	 * @var boolean
	 * @since 1.1
	 * @access public
	 * @static
	 * @internal This is an internal class setting
	 */
	public $_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = NULL;

	/**
	 * This property is used to link data based on data in an array, and
	 * instead of using the id to load then you can specify a row to use to load from.
	 * @var array
	 * @since 1.1
	 * @access public
	 * @static
	 * @internal This is an internal settings var
	 * @example
	 * array("Property Name" => array("Table","Row"))
	 * @example
	 * $this->_INTERNAL_PROPERTY_LINK = array("Options" => array("Values","OptionId"));
	 */
	public $_INTERNAL_PROPERTY_LINK = NULL;

	/**
	 * Use this property to merge all the results from array(array(),array()) into array("",""),
	 * for linked properties. This will only be done if it's only one property from each result that should be grabbed
	 * @example
	 * _INTERNAL_LINKED_MERGER_RESULTS = array("modes" => true);
	 * @var array
	 * @since 1.4
	 * @access public
	 */
	public $_INTERNAL_LINKED_MERGE_RESULTS = null;

	/**
	 * Use this array to set properties that always should be overwritten
	 * @since 1.3
	 * @access public
	 * @var array
	 */
	public $_INTERNAL_IMPORT_OVERWRITE = NULL;

	/**
	 * This function concerts "1" to true and 0 and NULL to false,
	 * in the parameters deffined here.
	 * @var array
	 * @since 1.1
	 * @access public
	 * @static
	 */
	public $_INTERNAL_CONVERT_TO_BOOLEAN = NULL;

	/**
	 * If this property is set to true and a dublicate is found, the dublicate is overwritten
	 * @since 1.0
	 * @access public
	 * @var boolean
	 */
	public $_INTERNAL_OVERWRITE_ON_DUBLICATE = false;

	/**
	 * An array containing the property(ies) that is going to be filled with the timestamp of the last 
	 * save operation
	 * @since 1.21
	 * @access public
	 * @var array|string
	 */
	public $_INTERNAL_LAST_UPDATED_PROPERTY = NULL;

	/**
	 * The property(ies) which is going to be filled with the timestamp of the first save
	 * @var array|string
	 * @since 1.21
	 * @access public
	 */
	public $_INTERNAL_CREATED_TIME_PROPERTY = NULL;

	/**
	 * The property(ies) to fill with the user that has created the data
	 * @since 1.21
	 * @access public
	 * @var array|string
	 */
	public $_INTERNAL_CREATED_USER_PROPERTY = NULL;

	/**
	 * The property(ies) to fill with the user that has last updated the data
	 * @since 1.21
	 * @access public
	 * @var array|string
	 */
	public $_INTERNAL_LAST_UPDATED_USER_PROPERTY = NULL;

	/**
	 * This property can either contain an array of properties to ignore
	 * or the keyword "DATABASE" that uses the DATABASE_EXPORT_IGNORE list as ignoring list or it can be an array
	 * where the first value is "MERGE" and the second is an array containing property names,
	 * this will merges the array with the DATABASE_EXPORT_IGNORE list
	 * @var array|string
	 * @since 1.3
	 * @access public
	 */
	public $_INTERNAL_LINK_SAVE_IGNORE = NULL;

	/**
	 * A property to store the current user
	 * @since 1.21
	 * @access public
	 * @var integer
	 */
	public $_INTERNAL_CURRENT_USER = NULL;

	/**
	 * An array containing the fields to ignore when importing
	 * @since 1.21
	 * @access public
	 * @var array
	 */
	public $_INTERNAL_IMPORT_IGNORE = NULL;

	/**
	 * This array contains the keywords to ignore when exporting
	 * @var array
	 * @since 1.3
	 * @access public
	 */
	public $_INTERNAL_KEYWORD_IGNORE = NULL;

	/**
	 * This function can be used to set the sorting function and options for sorting
	 * the export output
	 * @example
	 * array ("sort_function",array("sort_options"));
	 * @var array
	 * @since 1.3
	 * @access public
	 */
	public $_INTERNAL_EXPORT_SORTING = null;

	/**
	 * The database export array implode delemiter
	 * @since 1.3
	 * @access public
	 * @var string
	 */
	public $_INTERNAL_EXPORT_DELEMITER = ";";

	/**
	 * This array can be used to define what properties that is going to be sorted
	 * and with what
	 * @since 1.3
	 * @access public
	 * @var array
	 * @example
	 * array("property" => array("sort_function", array("sort_options")))
	 */
	public $_INTERNAL_SORT_PROPERTIES = NULL;

	/**
	 * This property is used when exporting,
	 * to set a export formating filter for the outputted data
	 * @since 1.3
	 * @access public
	 * @var array
	 * @example
	 * "property" => array("formating_function", "formating option")
	 * "property" => array("date", "Y-d-m")
	 * "property" => boolean // Because the boolean hasn't got any options
	 */
	public $_INTERNAL_EXPORT_FORMATING = NULL;

	/**
	 * If this is true, then "" or NULL will mean to empty the key
	 * @since 1.3
	 * @access public
	 * @var boolean
	 */
	public $_INTERNAL_IMPORT_EMPTY_NULL = true;

	############################# Private Properties #################################

	/**
	 * This property will contain a local instance of CodeIgniter,
	 * if the children set's it
	 * @var object
	 * @since 1.0
	 * @access private
	 */
	protected $_CI = NULL;

	/**
	 * This array contains the std_library properties which is going to be ignored on export
	 * @var array
	 * @since 1.3
	 * @access private
	 */
	private $_INTERNAL_PROPERTIES = array("Database_Table","_CI","_timezone");

	/**
	 * This array contains the keywords to look for and ignore
	 * @since 1.3
	 * @access private
	 * @var array
	 */
	private $_INTERNAL_PROPERTY_KEYWORD_IGNORE = array("_INTERNAL");

	/**
	 * The timezone identifier to use
	 * @since 1.31
	 * @access private
	 * @see http://php.net/manual/en/timezones.php
	 * @var string
	 */
	private $_timezone = "Europe/Copenhagen";

	/**
	 * This function is the constructor
	 * @access public
	 * @since 1.0
	 * @param integer|array|object $input The id to load the with, the array or the object to use as base dat for the object
	 */
	public function __construct ( $input = NULL ) {
		$this->_CI =& get_instance();
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_DATABASE_MODEL =& $this->_CI->_INTERNAL_DATABASE_MODEL;
		if ( !is_null($input) ) {
			self::_Process_Input($input);
		}
		if (ini_get("date.timezone")) {
			date_default_timezone_set(ini_get("date.timezone"));
		} else if (isset($this->_timezone)) {
			date_default_timezone_set($this->_timezone);
		} else {
			date_default_timezone_set("Europe/Copenhagen");
		}
	}

	/**
	 * The is function is the descrutor
	 * @since 1.21
	 * @access public
	 */
	public function __destruct () {}

	/**
	 * This function is called when accessing properties that doesnt exists,
	 * but it's going to be used more in 2.0
	 * @since 1.21
	 * @access public
	 * @return integer|boolean|string|object|array
	 */
	//public function __get ( $proprety ) {}

	/**
	 * This function is called when trying to set a non existing proprety,
	 * this function will be used more in 2.0
	 * @since 1.21
	 * @access public
	 */
	/*public function __set ( $property, $value) {
		if (property_exists($this, $property)) {
			$this->{$property} = $value;
		}
	}*/

	/**
	 * This function is called when using the isset function on any property in this class that doesnt exists,
	 * this function will be used more in 2.0s
	 * @since 1.21
	 * @access public
	 * @param  string  $property The property to check if is set
	 * @return boolean
	 */
	public function __isset ( $property ) {
		return ( property_exists($this, $property) && isset($this->{$property}) && !is_null($this->{$property}) && $this->{$property} != "" && !empty($this->{$property}) );
	}

	/**
	 * This function is called when trying to unset a property that isn't accesible,
	 * this function will be used more in 2.0
	 * @param string $property The name of the property to unset
	 * @since 1.21
	 * @access public
	 */
	public function __unset ( $property ) {
		if ( property_exists($this, $property) && !self::_Secure_Ignore($Property) ) {
			$this->{$property} = NULL;
		}
	}

	/**
	 * This funciton is called when trying to use this object as a string
	 * @since 1.21
	 * @access public
	 * @return string
	 */
	public function __toString () {
		if ( property_exists($this, "id") ) {
			return (string)$this->id;
		} else if ( property_exists($this, "Id") ) {
			return (string)$this->Id;
		} else {
			return null;
		}
	}

	/**
	 * This function is called when the var_export function is called on this object
	 * @since 1.21
	 * @access public
	 * @param  array  $input The input array
	 * @return object
	 */
	public function __set_state ( array $input ) {
		$object = new self();
		$object->Import($Input);
		return $object;
	}

	/**
	 * This function is called when the object is cloned,
	 * this function can be used more in 2.0
	 * @since 1.21
	 * @access public
	 */
	public function __clone () {}

	/**
	 * This function is called when the object is serialized
	 * @since 1.21
	 * @access public
	 * @return array
	 */
	public function __sleep () {
		return self::Export();
	}

	/**
	 * This function is called when the object is unserialized,
	 * the function can be used more in 2.0
	 * @since 1.21
	 * @access public
	 */
	public function __wakeup () {}

	/**
	 * This function is called when a non accesible function of this object is called
	 * @return boolean|string|object|integer|array
	 * @since 1.21
	 * @access public
	 */
	public function __call ( $function, $arguments ) {}

	/**
	 * This function can be used on 2.0
	 * @since 1.21
	 * @param string $name The name of the function to call
	 * @param integer|string|array $arguments The arguments to pass to the function
	 * @return boolean|string|object|integer|array
	 * @static
	 * @access public
	 */
	public static function __callStatic ( $function, $arguments ) {}

	/**
	 * This function is called when the object is used as a function,
	 * if a integer is passed, then the Load function is called with that id, 
	 * else if it's an array then the import funtion else if it's an object,
	 * then the Add function is used
	 * @since 1.21 
	 * @param  integer|array|object $arguments The data to add/load with
	 * @return integer|boolean
	 */
	public function __invoke ( $arguments ) {
		return self::_Process_Input( $arguments );
	}

	/**
	 * This function is going to be used in 2.0,
	 * to instead of creating classes for each object,
	 * then this function is going to create stdObjects that has the correct functions
	 * @since 1.21
	 * @access public
	 * @return boolean|integer
	 */
	public function __autoload () {}

	/**
	 * A function 
	 * @param integer $User The user id of the current user
	 * @since 1.21
	 * @access public
	 */
	public function Set_Current_User ( $User = NULL ) {
		if (!is_null($User)) {
			$this->_INTERNAL_CURRENT_USER = (int)$User;
		}
	}

	/**
	 * This function refresh the class data from the database
	 * @see self::Load
	 * @since 1.0
	 * @return boolean If success or fail
	 * @access public
	 */
	public function Refresh(){
		if(property_exists($this, "id")){
			if(!is_null($this->id)){
				if(method_exists($this, "Load")){
					return self::Load($this->id);
				}
			}
		}
	}

	/**
	 * This function delete's data local in the class, but if selected it can also delete the data from the database
	 * @param boolean $Database If this flag is set too true, the database data will be deleted too
	 * @since 1.0
	 * @access public
	 * @return object This function returns this object
	 * @todo Add hierrachy delete function
	 */
	public function Delete($Database = true){
		if($Database){
			if(method_exists($this, "_RemoveDatabaseData") && isset($this->id)){
				self::_RemoveDatabaseData($this->id,$this->Database_Table);
			}
			if(method_exists($this, "_RemoveUserData")){
				self::_RemoveUserData(true);
			}
		}
		else{
			if(method_exists($this, "_RemoveUserData")){
				self::_RemoveUserData(false);
			}
		}
		return $this;
	}

	/**
	 * This function takes the data from the $Array parameter and adds it to the local data,
	 * and if the database flag is set the data will be saved too. 
	 * @param array  $Array    The data in Name => Value format
	 * @param boolean $Database If this flag is set too true the data is saved too
	 * @access public
	 * @since 1.0
	 */
	public function Create($Array =  NULL,$Database = false){
		if(!is_null($Array)){
			self::_SetDataArray($Array);
			if($Database && !is_null($this->_CI) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL)){
				$this->id = $this->_CI->_INTERNAL_DATABASE_MODEL->Create($this);
				return $this->id;
			}
		}
	}

	/**
	 * This function uses the database model to convert the input data to a database query
	 * @since 1.3
	 * @access public
	 * @param array $data The data to convert
	 */
	public function Convert ( $data ) {
		return $this->_INTERNAL_DATABASE_MODEL->Convert($data, $this);
	}

	/**
	 * This function adds data, to this class either from a class or from an array,
	 * and if the Database flag is set to true the data will be saved to the database.
	 * @param object  &$Class   This parameter should contain a class that has the data to add deffined,
	 * with the same variable names, as this class. Not all variables need to be deffined only create them you need to.
	 * @param array  $Array    If this parameter is set and $Class is null the data from this parameter is used in Name => Value format
	 * @param boolean $Database If this flag is set to true, then the data will be saved in the database too
	 * @access public
	 * @since 1.0
	 */
	public function Add(&$Class = NULL,$Array = NULL, $Database = false){
		if(!is_null($Class)){
			self::_SetDataClass($Class);
		}
		else{
			if(!is_null($Array)){
				self::_SetDataArray($Array);
			}
			else{
				return 400;	
			}
		}
		if($Database && !is_null($this->id) && !is_null($this->_CI) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL)){
			$this->id = $this->_CI->_INTERNAL_DATABASE_MODEL->Create($this);
			return $this->id;
		}
	}

	/**
	 * This function checks the local settings variable for export,
	 * to see if the $Key exists in one of them or if the Key contains the _INTERNAL keyword
	 * @param string||integer $Key         The key to check
	 * @param array $ExtraIgnore Some extra ignore rules if nessesary
	 * @return boolean if to be ignored true is returned else is false returned
	 * @access public
	 * @since 1.0
	 */
	public function Ignore($Key = NULL,$ExtraIgnore = NULL){
		if(!is_null($Key)){
			if(!strpos($Key, "INTERNAL_") === false){
				return true;
			} else {
				if(property_exists($this, "_INTERNAL_EXPORT_INGNORE") && isset($this->_INTERNAL_EXPORT_INGNORE) && !is_null($this->_INTERNAL_EXPORT_INGNORE)){
					if(in_array($Key,$this->_INTERNAL_EXPORT_INGNORE)){
						return true;
					} else {
						if(!is_null($ExtraIgnore) && in_array($Key, $ExtraIgnore)){
							return true;
						} else {
							return false;
						}
					}
				} else {
					if(!is_null($ExtraIgnore) && in_array($Key, $ExtraIgnore)){
						return true;
					} else {
						return false;
					}
				}
			}
		} else {
			return true;
		}
	}

	/**
	 * This function is used to load based under a query.
	 * The data row names is converted so in the query use the names of the class properties.
	 * @param array $Query The query array
	 * @param array $Field An optional field selector, for selecting wheat fields to load
	 * @since 1.1
	 * @access public
	 * @return boolean If it was a success
	 */
	public function Find($Query = NULL,$Fields = NULL){
		if (!is_null($Query) && is_array($Query)) {
			$Data = $this->_CI->_INTERNAL_DATABASE_MODEL->Find($Query,$this->Database_Table,$this);
			if($Data !== false){
				return self::Load($Data,false,$Fields);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function is called from the model save function when the data is updated
	 * @since 1.21
	 * @access public
	 */
	public function Data_Updated () {
		if (self::_Isset("_INTERNAL_LAST_UPDATED_PROPERTY")) {
			if (is_array($this->_INTERNAL_LAST_UPDATED_PROPERTY)) {
				foreach ($this->_INTERNAL_LAST_UPDATED_PROPERTY as $Property) {
					if (property_exists($this, $Property)) {
						$this->{$Property} = time();
					}
				}
			} else if (is_string($this->_INTERNAL_LAST_UPDATED_PROPERTY)) {
				if (property_exists($this, $this->_INTERNAL_LAST_UPDATED_PROPERTY)) {
					$this->{$this->_INTERNAL_LAST_UPDATED_PROPERTY} = time();
				}
			}
		}

		if (self::_Isset("_INTERNAL_LAST_UPDATED_USER_PROPERTY") && isset($this->_INTERNAL_CURRENT_USER)) {
			if (is_array($this->_INTERNAL_LAST_UPDATED_USER_PROPERTY)) {
				foreach ($this->_INTERNAL_LAST_UPDATED_USER_PROPERTY as $Property) {
					if (property_exists($this, $Property)) {
						$this->{$Property} = $this->_INTERNAL_CURRENT_USER;
					}
				}	
			} else if(is_string($this->_INTERNAL_LAST_UPDATED_USER_PROPERTY)) {
				if (property_exists($this, $this->_INTERNAL_LAST_UPDATED_USER_PROPERTY)) {
					$this->{$this->_INTERNAL_LAST_UPDATED_USER_PROPERTY} = $this->_INTERNAL_CURRENT_USER;
				}
			}
		}
	}

	/**
	 * This function is called from the model save function,
	 * when the data is created
	 * @since 1.21
	 * @access public
	 */
	public function Data_Created () {
		if (self::_Isset("_INTERNAL_LAST_UPDATED_PROPERTY")) {
			if (is_array($this->_INTERNAL_LAST_UPDATED_PROPERTY)) {
				foreach ($this->_INTERNAL_LAST_UPDATED_PROPERTY as $Property) {
					if (property_exists($this, $Property)) {
						$this->{$Property} = time();
					}
				}
			} else if (is_string($this->_INTERNAL_LAST_UPDATED_PROPERTY)) {
				if (property_exists($this, $this->_INTERNAL_LAST_UPDATED_PROPERTY)) {
					$this->{$this->_INTERNAL_LAST_UPDATED_PROPERTY} = time();
				}
			}
		}

		if (self::_Isset("_INTERNAL_CREATED_TIME_PROPERTY")) {
			if (is_array($this->_INTERNAL_CREATED_TIME_PROPERTY)) {
				foreach ($this->_INTERNAL_CREATED_TIME_PROPERTY as $Property) {
					if (property_exists($this, $Property)) {
						$this->{$Property} = time();
					}
				}
			} else if ($this->_INTERNAL_CREATED_TIME_PROPERTY) {
				if (property_exists($this, $this->_INTERNAL_CREATED_TIME_PROPERTY)) {
					$this->{$this->_INTERNAL_CREATED_TIME_PROPERTY} = time();
				}
			}
		}

		if (self::_Isset("_INTERNAL_LAST_UPDATED_USER_PROPERTY") && isset($this->_INTERNAL_CURRENT_USER)) {
			if (is_array($this->_INTERNAL_LAST_UPDATED_USER_PROPERTY)) {
				foreach ($this->_INTERNAL_LAST_UPDATED_USER_PROPERTY as $Property) {
					if (property_exists($this, $Property)) {
						$this->{$Property} = $this->_INTERNAL_CURRENT_USER;
					}
				}	
			} else if(is_string($this->_INTERNAL_LAST_UPDATED_USER_PROPERTY)) {
				if (property_exists($this, $this->_INTERNAL_LAST_UPDATED_USER_PROPERTY)) {
					$this->{$this->_INTERNAL_LAST_UPDATED_USER_PROPERTY} = $this->_INTERNAL_CURRENT_USER;
				}
			}
		}

		if (self::_Isset("_INTERNAL_CREATED_USER_PROPERTY") && isset($this->_INTERNAL_CURRENT_USER)) {
			if (is_array($this->_INTERNAL_CREATED_USER_PROPERTY)) {
				foreach ($this->_INTERNAL_CREATED_USER_PROPERTY as $Property) {
					if (property_exists($this, $Property)) {
						$this->{$Property} = $this->_INTERNAL_CURRENT_USER;
					}
				}	
			} else if (is_string($this->_INTERNAL_CREATED_USER_PROPERTY)) {
				if (property_exists($this, $this->_INTERNAL_CREATED_USER_PROPERTY)) {
					$this->{$this->_INTERNAL_CREATED_USER_PROPERTY} = $this->_INTERNAL_CURRENT_USER;
				}
			}

		}
	}

	/**
	 * This function sets the CodeIgniter isntance
	 * @param object &$CI The instance of CodeIgniter to use
	 * @access public
	 * @since 1.0
	 */
	public function Config(&$CI = NULL){
		if(!is_null($CI)){
			$this->_CI =& $CI;
		}
	}

	/**
	 * This function clears the local class data
	 * @access public
	 * @since 1.0
	 */
	public function Clear(){
		if(method_exists($this,"_RemoveUserData")){
			self::_RemoveUserData(false);
		}
	}

	/**
	 * This function checks if the fields are usable
	 * @since 1.4
	 * @access private
	 * @param object $object The object to check in
	 * @param array $fields The fields array to evaluate
	 * @return array
	 */
	private function _Check_Fields (&$object, $fields) {
		foreach ($fields as $key => $field) {
			if (!property_exists($object, $field)) {
				unset($fields[$key]);
			}
		}
		return $fields;
	}

	/**
	 * This function loads data either by the $Id parameter or by the $Id property
	 * @param integer|array $Params The database id to load data from, this parameter is optional,
	 * if it's not deffined the $Id property value will be used, this can also be an associative array containing
	 * properties and values to seach for
	 * @example
	 * Load(1);
	 * @example
	 * $query = array(
	 * 		"token" => "0f7rLqfJ"
	 * );
	 * Load($query;
	 * @param boolean $Simple If this flag is set to true, then the Load From Class won't be done
	 * @param array $Fields The fields to select, if no fields are chosen, then all fields are selected
	 * @since 1.0
	 * @access public
	 * @return boolean If the load is succes with data is true returned else is false returned
	 */
	public function Load($Params = NULL,$Simple = false,$Fields = NULL) {
		$Arguments = func_get_args();
		$Parameters = array("Id","Simple","Fields");
		if(is_null($Arguments)){
			$Arguments = array();
		}
		$FillFields = false;
		if (is_null($Fields) || !is_array($Fields)) {
			$FillFields = true;
			$Fields = self::_Get_Fields();
		} else {
			$Fields = self::_Check_Fields($this,$Fields);
		}
		foreach ($Parameters as $Index => $Parameter) {
			unset($Arguments[$Index]);
		}
		if(!is_null($Params) && !is_array($Params)){
			$this->id = (int)$Params;
		}
		if (!is_array($Params)) {
			if(isset($this->id)){
				$Params = $this->id;
			} else {
				throw new Exception("Not a valid id specified", 1);
				return false;
			}
		}
		if(!is_null($Params) && isset($this->_CI->_INTERNAL_DATABASE_MODEL) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL)){
			if (!is_array($Params)) {
				if(!$this->_CI->_INTERNAL_DATABASE_MODEL->Load($Params,$this,$Fields)){
					return FALSE;
				}
			} else {
				if(!$this->_CI->_INTERNAL_DATABASE_MODEL->Where($Params,$this,$Fields)){
					return FALSE;
				}
			}
		} else {
			throw new Exception("No model deffined", 1);
			return false;	
		}

		if (property_exists($this, "_INTERNAL_DATABASE_EXPORT_INGNORE") && isset($this->_INTERNAL_DATABASE_EXPORT_INGNORE) && is_array($this->_INTERNAL_DATABASE_EXPORT_INGNORE) && $FillFields == true) {
			$Linked_Properties = self::_List_Of_Linked_And_Property_Linked_Properties();
			if (!is_array($Linked_Properties)) {
				$Linked_Properties = array();
			}
			$Fields = array_merge($this->_INTERNAL_DATABASE_EXPORT_INGNORE,$Fields,$Linked_Properties);
			$Fields = array_unique($Fields);
		}

		self::_Load_Link($Fields);
		self::_Link_Properties($Fields);
		self::_Load_From_Class($Simple, $Arguments);
		self::_Force_Array();
		return TRUE;
	}

	/**
	 * This function returns the current CodeIgniter instance
	 * @since 1.0
	 * @access public
	 */
	public function CodeIgniter () {
		return $this->_CI;
	}

	/**
	 * This function checks if the class exists
	 * @since 1.21
	 * @access public
	 * @param integer $Id The id to search for
	 */
	public function Exists ($Id = NULL) {
		return self::Load($Id,true,array("id"));
	}

	/**
	 * This function is the public export function, it can be used to export
	 * the class data to an API or like.
	 * @param array  $fields       An array of the fields to export
	 * @since 1.3
	 * @access public
	 * @param boolean $ignore_empty If the empty fields should be ignored
	 * @param array  $ignore       An aray of extra fields to ignore
	 * @todo 
	 * Idear could be to remove the secure export,
	 *		and instead add access scopes, and all properties that is not accessible with that scope is ignored,
	 *		and the same system should be used in Import.
	 *		The should be a read scope and a write scope property
	 *		like : _INTERNAL_READ_SCOPES and _INTERNAL_WRITE_SCOPES
	 *		
	 *	Ignore List:
	 *			Internal properties - Done
	 *			Internal keywords - Done
	 *			Export Ignore - Done
	 *			Secure ignore - Done	
	 *		
	 *	Feature list:
	 *			Export formating - Done
	 *			Export sorting - Done
	 *			Property sort - Done
	 *			Field selector - Done	
	 *		
	 * Todo : 
	 *			Export objects - Done
	 *			Scopes
	 *			Export Data types in export formating
	 *			Export or remove property linked data - Done
	 *			Random value
	 */
	public function Export ( $fields = NULL ,$ignore_empty = false, $ignore = null ) {
		$ignore_list = array(
			"_INTERNAL_PROPERTIES",
			"_INTERNAL_EXPORT_INGNORE",
			"_INTERNAL_SECURE_EXPORT_IGNORE"
		);

		$ignored_properties = self::_Merge_Class_Properties_And_Data(null,$ignore_list,$ignore);

		$ignore_keywords_list = array(
			"_INTERNAL_PROPERTY_KEYWORD_IGNORE"
		);

		$ignored_keywords = self::_Merge_Class_Properties_And_Data(null,$ignore_keywords_list);

		$exported =  self::_Export($this,$ignored_properties,$ignored_keywords,$ignore_empty,$fields);

		$exported = self::_Export_Objects_From_Data($exported);

		$exported = self::_Export_Property_Linked_Data ($exported);

		$exported = self::_Export_Formating($exported);

		return $exported;
	}

	/**
	 * This function exports the property linked data in the array
	 * @since 1.3
	 * @access private
	 * @param array $data The data to look trough
	 * @return array The exported data or the input data
	 */
	private function _Export_Property_Linked_Data ( $data ) {
		if (isset($this->_INTERNAL_PROPERTY_LINK) && property_exists($this, "_INTERNAL_PROPERTY_LINK") && !is_null($this->_INTERNAL_PROPERTY_LINK) && is_array($this->_INTERNAL_PROPERTY_LINK)) {
			foreach ($this->_INTERNAL_PROPERTY_LINK as $property => $settings) {
				if (array_key_exists($property, $data)) {
					$data[$property] = self::_Property_Linked_Row_Export($data[$property],$property);
				}
			}
			return $data;
		}
		return $data;
	}

	/**
	 * This function exports the class data to a format the Std_Model understands
	 * @since 1.3
	 * @access public
	 * @param array  $fields       An array of the fields to select, if the variable is null all is selected
	 * @param boolean $ignore_empty If the empty fields should be ignored
	 * @param boolean $save If the current operation is save or load
	 * @return array
	 * @todo 
	 * 
	 * Ignore List:
	 *			Property Link - Done
	 * 			Linked Properties - Done
	 *			Database Ignore - Done
	 *			Internal properties - Done
     *			Internal keywords - Done
	 * 
	 * Features:
	 *			Implode all arrays - Done
	 *			Remove property linked rows - Done
	 *			Random Value
	 */
	public function Database ($fields = null,$ignore_empty = true,$save = true) {
		$ignore_list = array(
			"_INTERNAL_PROPERTIES",
			"_INTERNAL_DATABASE_EXPORT_INGNORE",
		);

		if ($save === true) {
			$ignore_list[] = "_INTERNAL_DATABASE_SAVE_IGNORE";
		}

		$linked_properties = self::_List_Of_Linked_And_Property_Linked_Properties();

		$ignored_properties = self::_Merge_Class_Properties_And_Data(null,$ignore_list,$linked_properties);

		$ignore_keywords_list = array(
			"_INTERNAL_PROPERTY_KEYWORD_IGNORE"
		);

		$ignored_keywords = self::_Merge_Class_Properties_And_Data(null,$ignore_keywords_list,true);

		$exported =  self::_Export($this,$ignored_properties,$ignored_keywords,$ignore_empty,$fields);
			
		$exported = self::_Export_Objects_From_Data($exported, "Database", array() , true);

		$exported = self::_Export_Property_Linked_Data ($exported);

		$exported = self::_Implode_Array($exported);

		return $exported;
	}

	/**
	 * This function returns the fields of the class
	 * @since 1.21
	 * @access private
	 * @todo Add the fields of the child classes too like,
	 * array (
	 *    "property" => array(
	 *        "id",
	 *        "name"
	 *    ),
	 *    "name"
	 * );
	 * @return array
	 */
	private function _Get_Fields () {
		return array_keys(self::Database(null,false,false));
	}

	/**
	 * This function gets a list of all the properties that are linked or property linked
	 * @since 1.3
	 * @access private
	 */
	private function _List_Of_Linked_And_Property_Linked_Properties () {
		$result = null;
		if (isset($this->_INTERNAL_PROPERTY_LINK) && property_exists($this, "_INTERNAL_PROPERTY_LINK") && !is_null($this->_INTERNAL_PROPERTY_LINK) && is_array($this->_INTERNAL_PROPERTY_LINK)) {
			foreach ($this->_INTERNAL_PROPERTY_LINK as $property => $other) {
				$result[] = $property;
			}
		}

		if (isset($this->_INTERNAL_LINK_PROPERTIES) && property_exists($this, "_INTERNAL_LINK_PROPERTIES") && !is_null($this->_INTERNAL_LINK_PROPERTIES) && is_array($this->_INTERNAL_LINK_PROPERTIES)) {
			foreach ($this->_INTERNAL_LINK_PROPERTIES as $property => $other) {
				$result[] = $property;
			}
		}

		return $result;
	}

	/**
	 * This function does export formating
	 * @since 1.3
	 * @access private
	 * @param array $data The data to format
	 */
	private function _Export_Formating ( $data ) {
		if (property_exists($this, "_INTERNAL_EXPORT_FORMATING") && isset($this->_INTERNAL_EXPORT_FORMATING) && is_array($this->_INTERNAL_EXPORT_FORMATING)) {
			foreach ($data as $property => $value) {
				if (array_key_exists($property, $this->_INTERNAL_EXPORT_FORMATING)) {
					if (is_array($value)) {	
						$array = array();
						foreach ($value as $key => $content) {
							if ((is_array($this->_INTERNAL_EXPORT_FORMATING[$property]) && $this->_INTERNAL_EXPORT_FORMATING[$property][0] == "boolean") || $this->_INTERNAL_EXPORT_FORMATING[$property] == "boolean") {
								if (is_string($array[$key])) {
									$array[$key] = ($array[$key] == "true")? true : false;
								} else {
									$array[$key] = (boolean)$content;
								}
							} else {
								$array[$key] = call_user_func_array($this->_INTERNAL_EXPORT_FORMATING[$property][0], array($this->_INTERNAL_EXPORT_FORMATING[$property][1],$content));
							}
							
						}
						$data[$property] = $array;
					} else {
						if ((is_array($this->_INTERNAL_EXPORT_FORMATING[$property]) && $this->_INTERNAL_EXPORT_FORMATING[$property][0] == "boolean") || $this->_INTERNAL_EXPORT_FORMATING[$property] == "boolean") {
							if (is_string($data[$property])) {
								$data[$property] = ($data[$property] == "true")? true : false;
							} else {
								$data[$property] = (boolean)$value;
							}
						} else {
							$data[$property] = call_user_func_array($this->_INTERNAL_EXPORT_FORMATING[$property][0], array($this->_INTERNAL_EXPORT_FORMATING[$property][1],$value));
						}
					}
				}
			}
			return $data;
		} else {
			return $data;
		}
	}

	/**
	 * This function exports a classes proprties to an array
	 * @since 1.3
	 * @access private
	 * @param object  &$class            The class to export from
	 * @param array  $ignore_properties An array containing the properties to ignire
	 * @param array  $ignore_keywords   An array of keywords to ignore if the property name contains that keywords
	 * @param boolean $ignore_empty      If the empty properties is going to be ignored
	 * @param array  $fields            An optional array of fields to select
	 */
	private function _Export ( &$class = null, $ignore_properties = null, $ignore_keywords = null, $ignore_empty = true, $fields = null) {
		if ( !is_null($class) && is_object($class) ) {
			$class_data = get_object_vars($class);

			if (is_array($class_data) && count($class_data) > 0) {

				//Match keywords and ignore list
				$class_data = self::_Check_Property_Names($class_data, $ignore_properties);
				$class_data = self::_Check_Property_Against_Keywords($class_data, $ignore_keywords);

				//Fill wity data and select fields
				$class_data = self::_Export_Fill_With_Data($class_data,$fields);

				//Remove Empty
				$class_data = self::_Remove_Empty_Export($class_data, $ignore_empty);

				//Sort Properties
				$class_data = self::_Property_Sort($class_data);

				//Sort data
				$class_data = self::_Sort($class_data);

				return $class_data;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	/**
	 * This function sorts the input data if there is a setting for it in _INTERNAL_SORT_PROPERTIES
	 * @since 1.3
	 * @access private
	 * @param array $data The data to sort
	 */
	private function _Property_Sort ( $data ) {
		if ( is_array($data) && property_exists($this, "_INTERNAL_SORT_PROPERTIES") && isset($this->_INTERNAL_SORT_PROPERTIES) && is_array($this->_INTERNAL_SORT_PROPERTIES)) {
			foreach ($data as $property => $value) {
				if (array_key_exists($property, $this->_INTERNAL_SORT_PROPERTIES)) {
					$options = $this->_INTERNAL_SORT_PROPERTIES[$property][1];
					$data[$key] = self::_Sort_Data($value,$this->_INTERNAL_SORT_PROPERTIES[$property][0],$options);
				}
			}
		} else {
			return $data;
		}
	}

	/**
	 * This function sortes the input data
	 * @since 1.3
	 * @access private
	 * @param array $data     The data to sort
	 * @param string $function The sort function to use
	 * @param array $options  The sort options
	 */
	private function _Sort_Data ( $data, $function, $options) {
		$options = array_merge(array($data), $options);
		return call_user_func_array($function, $options);
	}

	/**
	 * This function merges class properties and input data
	 * @param object $object The object to get the properties from
	 * @param array $properties A list of class properties that is going to be merged
	 * @since 1.3
	 * @access private
	 * @return array
	 */
	private function _Merge_Class_Properties_And_Data ( $object = null, array $properties ) {
		$arguments = func_get_args();
		if (is_null($object)) {
			$object = $this;
		}
		unset($arguments[0]);
		unset($arguments[1]);

		$return = array();

		if (is_array($arguments) && count($arguments) > 0) {
			foreach ($arguments as $index => $argument) {
				if (!is_null($argument) && is_array($argument)) {
					$return = array_merge($return,$argument);
				}
				
			}
		}

		foreach ($properties as $index => $property) {
			if (isset($property) && (is_string($property) || is_integer($property)) && isset($object->{$property}) && property_exists($object, $property) && !is_null($object->{$property}) && is_array($object->{$property})){
				$return = array_merge($return,$object->{$property});
			} else if (isset($property) && is_array($property)) {
				$return = array_merge($return,$property);
			}
		}

		$return = array_unique($return);

		return $return;
	}

	/**
	 * This function exports all objects in an array or just one ojbect
	 * @since 1.3
	 * @access private
	 * @param array|object $input    The object or the array containing the objects
	 * @param string $function The object function to use
	 * @param array  $params   The object function params to use
	 * @param boolean $idFirst If this flag is true then the object will be exported with the id if it exists
	 */
	private function _Export_Objects_From_Data ( $input,  $function = "Export" ,$params = array(), $idFirst = false) {
		if (is_array($input)) {
			$array = array();
			foreach ($input as $key => $object) {
				if ( self::_Contains_Object($object) ) {
					if (is_object($object) && $idFirst === true and property_exists($object, "id")) {
						 $array[$key] = $object->id;
					} else {
						if (is_array($object)) {
							$array[$key] = self::_Export_Objects_From_Data( $object, $function, $params, $idFirst);
						} else {
							if ( method_exists($object, $function) ) {
								$array[$key] = call_user_func_array(array($object,$function), $params);
							} else {
								if (is_object($object)) {
									return get_class_vars(get_class($object));
								} else {
									return $object;
								}
							}
						}
					}
				} else {
					$array[$key] = $object;
				}
			}
			return $array;
		} else if ( self::_Contains_Object($input) ) {
			if ($idFirst === true and property_exists($object, "id")) {
				return $object->id;
			} else {
				if ( method_exists($input, $function) ) {
					return call_user_func_array(array($input,$function), $params);
				} else {
					if (is_object($input)) {
						return get_class_vars(get_class($input));
					} else {
						return $input;
					}
				}
			}
		} else {
			return $input;
		}
	}

	/**
	 * This function takes the class data and adds it to the array
	 * @since 1.3
	 * @access private
	 * @param array $class_data The data to parse
	 * @param array $fields     An optional field selector
	 */
	private function _Export_Fill_With_Data ( $class_data = null, $fields = null ) {
		if (is_array($class_data)) {
			foreach ($class_data as $property => $value) {
				$class_data[$property] = $this->{$property};
				if (!is_null($fields) && is_array($fields) && !in_array($property, $fields)) {
					unset($class_data[$property]);
				}
			}
			return $class_data;
		} else {
			return array();
		}
	}

	/**
	 * This function removes the empty data if the ignore_empty flag is true
	 * @since 1.3
	 * @access private
	 * @param array  $data         The data to parse
	 * @param boolean $ignore_empty A flag to set if the empty data is ignored or not
	 */
	private function _Remove_Empty_Export ( $data, $ignore_empty = true) {
		if (is_array($data)) {
			foreach ($data as $property => $value) {
				if (is_null($value) && $ignore_empty === true) {
					unset($data[$property]);
				}
			}
			return $data;
		}
	}

	/**
	 * This function implodes an array with the specified delemiter,
	 * if a delemiter isn't set then the _INTERNAL_EXPORT_DELEMITER is used or else is ";" used
	 * @param array $array     The array to implode
	 * @since 1.3
	 * @access private
	 * @param string $delemiter The delemiter to use
	 * @return string
	 */
	private function _Implode ( $array, $delemiter = null ) {
		if (is_null($delemiter)) {
			$delemiter = (property_exists($this, "_INTERNAL_EXPORT_DELEMITER") && !is_null($this->_INTERNAL_EXPORT_DELEMITER))? $this->_INTERNAL_EXPORT_DELEMITER : ";";
		}
		$string = $delemiter;
		$string .= implode($delemiter,$array);
		$string .= $delemiter;
		$string = str_replace($delemiter."NULL", "", $string);
		return $string;
	}

	/**
	 * This function implodes an array using the self::_Implode function
	 * @since 1.3
	 * @access private
	 * @param array|object $data The array or object to implode
	 */
	private function _Implode_Array ( $data ) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					$data[$key] = self::_Implode($value);
				}
			}
			return $data;
		} else if (is_object($data)) {
			return self::_Implode_Array(get_object_vars($data));
		} else {
			return $data;
		}
	}

	/**
	 * This function sorts the exported output using the settings in _INTERNAL_EXPORT_SORTING
	 * @param array $data The data to sort
	 * @since 1.3
	 * @return array
	 * @access private
	 */
	private function _Sort ( $data ) {
		if ( isset($this->_INTERNAL_EXPORT_SORTING) && property_exists($this, "_INTERNAL_EXPORT_SORTING") && !is_null($this->_INTERNAL_EXPORT_SORTING) && is_array($this->_INTERNAL_EXPORT_SORTING)) {
			$options = array();
			$options[] =& $data;
			if (isset($this->_INTERNAL_EXPORT_SORTING[1])) {
				$options = array_merge($options,$this->_INTERNAL_EXPORT_SORTING[1]);
			}
			call_user_func_array($this->_INTERNAL_EXPORT_SORTING[0], $options);
			return $data;
		} else {
			return $data;
		}
	}

	/**
	 * This function checks through an array for precise matches of strings to ignore
	 * @since 1.3
	 * @access private
	 * @return array
	 * @param array $input  The input array to match
	 * @param array $ignore The ignore array to match against
	 */
	private function _Check_Property_Names (  $input = null, $ignore = null ) {
		if (!is_null($input) && is_array($ignore)){
			foreach ($input as $property => $value) {
				if ( in_array($property, $ignore) ) {
					unset($input[$property]);
				}
			}
			return (count($input) > 0)? $input : array();
		} else {
			if (is_array($input)) {
				return $input;
			} else {
				return array();
			}
		}
	}

	/**
	 * This function matches a string or array agains a string or an array
	 * @since 1.3
	 * @access private
	 * @param array|string $input    The string or array to match
	 * @param array|string $keywords The string or array to match against
	 * @return array|string
	 */
	private function _Check_Property_Against_Keywords ( $input = null, $keywords = null ) {
		if (is_array($input)) {
			foreach ($input as $property => $value) {
				if (self::_Check_String($property,$keywords)) {
					unset($input[$property]);
				}
			}
			return (count($input) > 0)? $input : null;
		} else {
			if (!self::_Check_String($input,$keywords)) {
				return $input;
			} else {
				return null;
			}
		}
	}

	/**
	 * This function checks a string agains an array or string
	 * @param string $string The input string to check for
	 * @param string|array $input  The string or array to check against
	 * @since 1.3
	 * @return boolean Tru is returned if the string is in the array or in string
	 * @access private
	 */
	private function _Check_String ( $string = null, $input = null ) {
		if (!is_null($string) && !is_null($input)){
			if (is_string($input)) {
				return (strpos($input, $string) !== false);
			} else if (is_array($input)) {
				return self::_Array_Strpos($string, $input);
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	/**
	 * This function searches throug an array containing the haystacks and perform a strpos function
	 * @since 1.3
	 * @access private
	 * @param string $needle   The string to search for
	 * @param array $haystack The array to look in
	 */
	private function _Array_Strpos ( $needle, $haystack) {
		if (is_array($haystack)) {
			$result = false;
			foreach ($haystack as $key => $value) {
				if (strpos($needle, $value) !== false) {
					$result = true;
				}
			}
			return $result;
		} else {
			return falsE;
		}
	}

	/**
	 * This function returns an array of the database name convert array
	 * @since 1.1
	 * @access public
	 * @return array
	 */
	public function Database_Rows(){
		$Variables = self::Export(null,false);
		$Return = array();
		$Convert = $this->_INTERNAL_DATABASE_MODEL->Get_Names($this);
		foreach ($Variables as $Key => $Value) {
			if((isset($this->_INTERNAL_DATABASE_EXPORT_INGNORE) && (!in_array($Key, $this->_INTERNAL_DATABASE_EXPORT_INGNORE)) || ($Key == "id" || $Key == "id")) || !isset($this->_INTERNAL_DATABASE_EXPORT_INGNORE)){
				if(!is_null($Convert) && is_array($Convert) && array_key_exists($Key, $Convert)){
					$Return[$Convert[$Key]] = $Value;
				} else {
					$Return[$Key] = $Value;
				}
			}
		}
		return $Return;
	}

	/**
	 * This function returns an array of the database convertion table
	 * @since 1.1
	 * @access public
	 * @return array
	 */
	public function Database_Names(){
		return $this->_INTERNAL_DATABASE_MODEL->Get_Names($this);
	}

	/**
	 * This function saves the local class data to the database row of the Id property
	 * @return string This function can return a error string
	 * @param boolean $save_self If the object should save it self or only it's childrens
	 * @since 1.0
	 * @access public
	 */
	public function Save( $save_self = true) {
		if(isset($this->_CI) && !is_null($this->_CI) && isset($this->_CI->_INTERNAL_DATABASE_MODEL) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL) ){
			if(self::_Not_Allowed_Dublicate_Rows() === false || self::_Overwrite_On_Dublicate() === true){
				self::_Save_Childrens_Before();
				if ($save_self == true) {
					$this->_CI->_INTERNAL_DATABASE_MODEL->Save($this);		
				}
				self::_Save_Linked_Properties();
				self::_Save_ChildClasses_Properties();
				return true;
			} else {
				return FALSE;
			}
		} else {
			return false;
		}
	}

	/**
	 * This function can be called from a parent object,
	 * when the object is saved as as a linked object
	 * @param string $state The state in the link save progress
	 * @since 1.3
	 * @access public
	 */
	public function Saved_As_Link ( $state = "before") {
		switch ($sate) {
			case 'after':
				self::_Save_Linked_Properties();
				self::_Save_ChildClasses_Properties();
				break;
			
			default:
				self::_Save_Childrens_Before();
				break;
		}
	}

	/**
	 * This function links a class property to data collected from other databases
	 * @param string||array $Table    The table(s) to search in
	 * @param array $Link     An array in this format array("Row Name" => "Class property or  a value"...) 
	 * with the search queries to search with.
	 * @param string $Property The class property to link
	 * @param boolean $Simple if this flag is set to true, then the load from class isn't executed
	 * @param array $Select The rows to select/use
	 * @since 1.0
	 * @return boolean If success or fail
	 * @access public
	 */
	public function Link ( $Table = NULL, $Link = NULL, $Property = NULL, $Simple = false, $Select = NULL ) {
		if(!is_null($Table) && !is_null($Link) && is_array($Link) && !is_null($Property)){

			//Check if the properties exists else remove them from the list
			$Link = self::_Create_Link_Query($Link);

			//If there is properties left, then start linking
			if(count($Link) > 0){
				if(method_exists($this->_CI->_INTERNAL_DATABASE_MODEL, "Link")){
					$Data = $this->_CI->_INTERNAL_DATABASE_MODEL->Link($Table,$Link,$this,$Select);
					if(property_exists($this, $Property)){
						self::_Link_Set_Data($Data,$Property,$Select);
						if(count($Data) > 0){
							if(!$Simple){
								self::_Load_From_Class();
							}
							return TRUE;
						} else {
							return FALSE;
						}
					}
				}
			}
		}
		return FALSE;
	}

	/**
	 * This function saves a linked object and performs the link query based on the object data
	 * @param object &$object            The object to save
	 * @param string $property           The property where it's located
	 * @param string $duplicate_function The duplicate check function to use
	 * @since 1.3
	 * @access private
	 * @return boolean
	 */
	private function _Save_Linked_Object ( &$object, $property, $duplicate_function = "NONE") {
		if (is_null($duplicate_function)) {
			$duplicate_function = "NONE";
		}
		if (self::_Settings_Check($this, "_INTERNAL_LINK_PROPERTIES","array") && array_key_exists($property, $this->_INTERNAL_LINK_PROPERTIES)) {

			//The the link data for the current linked property
			$link_data = $this->_INTERNAL_LINK_PROPERTIES[$property];

			//Get the table where to save the data too
			$table = $link_data[0];

			//Get the link query
			$query = $link_data[1];

			//The row where the data is taken from
			$row = null;

			//The not allowed dublicate rows for the link query
			$duplicate_check_rows = null;

			//If the row is set, get it
			if (isset($link_data[2]) && !empty($link_data[2])) {
				$row = $link_data[2];
			} else {
				$row = "id";
			}

			//If the dublicate rows is set, get them
			if (isset($link_data[3]) && !empty($link_data[3])) {
				$duplicate_check_rows = $link_data[3];
			}

			//Set the link query, save link data
			//self::_Set_Save_Link_Data($query,$object); //This function call is deprecated, and will be replaced with a better parceing system, that is done when the query is created

			//Set the current user that saves the object, and set the save link data
			self::_Parse_Object_For_Save($object, $property);
				
			//If it's linked object, that doesn't use an extra table for the link
			if (is_object($object) && $object->Database_Table == $table){
				self::_Import_Link_Data($object, $query);
				if (method_exists($object, "Save")) {
					$object->_INTERNAL_IS_LINKED = true;
					$object->Save();
				}
			} else {

				//Save the object
				if (is_object($object) && method_exists($object, "Save")) {
					$object->_INTERNAL_IS_LINKED = true;
					$object->Save();
				}
				if (property_exists($object, "id")) {
					$link_data_to_save = array_merge(array($row => $object->{"id"}),self::_Create_Link_Query($query));
					
					//This should be checked if any problems with Duplicate checks occur
					$exists = $this->_INTERNAL_DATABASE_MODEL->Dublicate_Check($link_data_to_save, $table, $duplicate_check_rows);
					if (($exists && $duplicate_function != "STOP") || !$exists) {
						$this->_INTERNAL_DATABASE_MODEL->Save_Linked($table, $link_data_to_save, $object, $duplicate_check_rows);
					}
				}
			}			
		}
	}

	/**
	 * This function imports an array of data onto an object
	 * @since 1.3
	 * @access private
	 * @param object $object The object to import onto
	 * @param array $query  The array of data to import onto the object
	 */
	private function _Import_Link_Data ( &$object, $query = null) {
		if (!is_null($query)) {
			$object_link_data = self::_Create_Link_Query($query);
		}
		if (!is_null($object_link_data) && is_object($object)) {
			foreach ($object_link_data as $key => $value) {
				$object->{$key} = $value;
			}
		}
	}

	/**
	 * This function creates the query data used to save the object data
	 * @since 1.3
	 * @access private
	 * @param object $object The object to create the save query for
	 * @since 1.3
	 * @access private
	 * @param [type] $query  [description]
	 */
	private function _Merge_Link_Data_For_Save ( $object, $query = null) {
		if (!is_null($query)) {
			$object_link_data = self::_Create_Link_Query($query);
		}
		$object_data = $object->Database();
		return array_unique(array_merge($object_data,$object_link_data));
	}

	/**
	 * This function creates the Link query
	 * @since 1.3
	 * @access private
	 * @param array $data  The array to create the query of
	 * @param object $class The class to use the date from to create the query
	 * @return array
	 */
	private function _Create_Link_Query ( $data = null, $class = null) {
		if (is_null($class)) {
			$class = $this;
		}
		foreach($data as $search => $key){
			if(empty($search) || empty($key)){
				unset($data[$search]);
			} else {
				if(property_exists($class, $key)){
					if(is_null($class->{$key})){
						unset($data[$search]);
					}
					else if(empty($class->{$key})){
						unset($data[$key]);
					} else {
						$data[$search] = $class->{$key};
					}
				}
			}
		}
		return $data;
	}

	/**
	 * This function ensures that the object is ready to be saved
	 * @param object &$object  The object to be parsed and made ready
	 * @param string $property The property where the object is located
	 * @since 1.3
	 * @access private
	 */
	private function _Parse_Object_For_Save ( &$object, $property ) {
		if(self::_Has_Save_Link($property)){
			$Save_Link_Data = self::_Get_Save_Link_Data($property);
			if(!is_null($Save_Link_Data)){
				self::_Set_Save_Link_Data($Save_Link_Data,$object);
			}
		}
		if (isset($this->_INTERNAL_CURRENT_USER) && property_exists($this,"_INTERNAL_CURRENT_USER") && isset($this->_INTERNAL_CURRENT_USER) && !is_null($this->_INTERNAL_CURRENT_USER) && method_exists($object,"Set_Current_User")) {
			$object->Set_Current_User($this->_INTERNAL_CURRENT_USER);
		}
	}

		/**
	 * This function loops through alsl the properties which is linked,
	 * and ensures that all the containing objects, have the right values in the linked fields.
	 * And then is the child objects saved
	 * @param object $parent The parent object of the data to save, normaly this would be $this
	 * @access private
	 * @since 1.0
	 */
	private function _Save_Linked_Properties( $parent = null){

		//If no parent is deffined, then the parent is set to the current class
		if (is_null($parent)) {
			$parent = $this;
		}

		//The fields to ignore
		$ignore_list = array(
			"_INTERNAL_DATABASE_SAVE_IGNORE",
			"_INTERNAL_SAVE_THESE_CHILDS_FIRST"
		);

		//Check if any linked properties are specified
		if(self::_Settings_Check($parent, "_INTERNAL_LINK_PROPERTIES", "array")){
			
			//Get the linked properties and settings
			$properties = $parent->_INTERNAL_LINK_PROPERTIES;

			if (isset($parent->_INTERNAL_LINK_SAVE_IGNORE) && !is_null($parent->_INTERNAL_LINK_SAVE_IGNORE)) {
				if (is_array($parent->_INTERNAL_LINK_SAVE_IGNORE) && isset($parent->_INTERNAL_LINK_SAVE_IGNORE[0]) && $parent->_INTERNAL_LINK_SAVE_IGNORE[0] != "MERGE") {
					$ignore_list[] = "_INTERNAL_LINK_SAVE_IGNORE";
				} else if ($parent->_INTERNAL_LINK_SAVE_IGNORE == "DATABASE") {
					$ignore_list[] = "_INTERNAL_DATABASE_EXPORT_INGNORE";
				} else if (isset($parent->_INTERNAL_LINK_SAVE_IGNORE[0]) && $parent->_INTERNAL_LINK_SAVE_IGNORE[0] == "MERGE") {
					$ignore_list[] = "_INTERNAL_DATABASE_EXPORT_INGNORE";
					if (isset($parent->_INTERNAL_LINK_SAVE_IGNORE[1]) && is_array($parent->_INTERNAL_LINK_SAVE_IGNORE[1])) {
						$ignore_list[] = $parent->_INTERNAL_LINK_SAVE_IGNORE[1];
					}
				}
			}

			//The properties to ignore
			$ignored_properties = array_values(self::_Merge_Class_Properties_And_Data($parent,$ignore_list));

			//The properties to save
			$properties = array_keys(self::_Check_Property_Names($properties, $ignored_properties));
			//Loop through the properties that are marked as linked properties
			foreach ($properties as $property) {

				//Get the duplicate check function
				$duplicate_function = self::_Get_Duplicate_Function($property,$parent);
		
				if (isset($parent->{$property}) && !is_null($parent->{$property}) && !empty($parent->{$property})) {
					self::_Link_Objects_Data_Duplicate($parent, $parent->{$property}, $property);
					if (is_array($parent->{$property})) {
						foreach ($parent->{$property} as $key => $value) {
							if (is_object($value)) {
								$object = $value;
								self::_Save_Linked_Object($object, $property, $duplicate_function);
							} else {
								if (!is_array($parent->{$property})) {
									self::_Save_Linked_Data($parent->{$property}, $property, $parent);
								}
							}
						}
					} else {
						if (is_object($parent->{$property})) {
							$object = $parent->{$property};
							self::_Save_Linked_Object($object, $property, $duplicate_function);
						} else {
							if (!is_array($parent->{$property})) {
							self::_Save_Linked_Data($parent->{$property}, $property, $parent);
							}
						}
					}
				}
			}
		}
	}

	/**
	 * This function gets the duplicate check funtion for linked data
	 * @param string $property The property or key to read for/in
	 * @param object $parent   The object to read in
	 * @since 1.4
	 * @access private
	 * @return string
	 */
	private function _Get_Duplicate_Function ($property, $parent) {
		if (isset($parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION) && is_array($parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION) && array_key_exists($property, $parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION)) {
			return $parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$property];
		} else if (isset($parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION)) {
			return $parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION;
		} else {
			return "NONE";
		}
	}

	/**
	 * Thos function gets the value at a specific position or count
	 * @param  array $array    The array to take the value from
	 * @param  integer $position The position of the value
	 */
	private function _Array_Get_Value_At_Position ( $array, $position) {
		return current(array_slice(array_values($array), $position, $position+1));
	}

	/**
	 * This function perfrorms the Link Duplicate Check
	 * @since 1.3
	 * @access private
	 * @param object $object   The parent object, that are being saved
	 * @param array &$data    The database that is being saved
	 * @param string $property The property where the data is located
	 */
	private function _Link_Objects_Data_Duplicate ( $object, &$data = null, $property = null) {
		//The the link data for the current linked property
		$link_data = $this->_INTERNAL_LINK_PROPERTIES[$property];

		//Get the table where to save the data too
		$table = $link_data[0];

		//Get the link query
		$query = $link_data[1];

		$link_query_data = self::_Create_Link_Query($query, $object);

		//The not allowed dublicate rows for the link query
		$duplicate_check_rows = null;

		//If the dublicate rows is set, get them
		if (isset($link_data[3]) && !empty($link_data[3])) {
			$duplicate_check_rows = $link_data[3];
		}

		if (isset($object->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$property])) {

			if ($object->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$property] == "DELETE") {
				$this->_INTERNAL_DATABASE_MODEL->Delete_Existing($table, $link_query_data);
			} else if ($object->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$property] == "OVERWRITE") {
				$matches = $this->_INTERNAL_DATABASE_MODEL->Get_Matching_Data($table, $link_query_data,$duplicate_check_rows);
				if (!is_null($matches)) {
					foreach ($matches as $key => $match_id) {
						if (is_array($data)) {
							$item = self::_Array_Get_Value_At_Position($data, $key);
						} else {
							$item = $data;
						}
						if (!is_null($item)) {
							if (is_object($item)) {
								$item->id = $match_id;
							} else {
								unset($matches[$key]);
								$this->_INTERNAL_DATABASE_MODEL->Delete_Row($table, $match_id);
							}
						} else {
							unset($matches[$key]);
							$this->_INTERNAL_DATABASE_MODEL->Delete_Row($table, $match_id);
						}
					}
				} else {
					return $data;
				}
			}
		}

		return $data;
	}

	/**
	 * This function save's linked data that is not an array or object
	 * @since 1.3
	 * @access private
	 * @param stirng $data     The data to save
	 * @param string $property The property where the data is located
	 * @param object $object The object where the property exists
	 */
	private function _Save_Linked_Data ( $data, $property, $object = null){

		if (is_null($object)) {
			$object = $this;
		}

		//The the link data for the current linked property
		$link_data = $object->_INTERNAL_LINK_PROPERTIES[$property];

		//Get the table where to save the data too
		$table = $link_data[0];

		//Get the link query
		$query = $link_data[1];

		//The row where the data is taken from
		$row = null;

		//The not allowed dublicate rows for the link query
		$duplicate_check_rows = null;

		//If the row is set, get it
		if (isset($link_data[2]) && !empty($link_data[2])) {
			$row = $link_data[2];
		} else {
			$row = "id";
		}

		//If the dublicate rows is set, get them
		if (isset($link_data[3]) && !empty($link_data[3])) {
			$duplicate_check_rows = $link_data[3];
		}
		
		if (!is_array($data)) {
			$data_to_save = array_merge(array($row => $data),self::_Create_Link_Query($query, $object));
			$duplicate_function = (isset($object->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$property]))? $object->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$property]: null;
			$this->_INTERNAL_DATABASE_MODEL->Save_Linked($table,$data_to_save,$object,$duplicate_check_rows,$duplicate_function);
		}
	}


	/**
	 * This function loops through the settings property _INTERNAL_LINK_PROPERTIES,
	 * and links the deffined properties with data from other database tables
	 * @param array $Fields The field selector array
	 * @see Link
	 * @access private
	 * @since 1.0
	 */
	private function _Link_Properties(array $Fields = NULL){
		if(property_exists($this, "_INTERNAL_LINK_PROPERTIES") && isset($this->_INTERNAL_LINK_PROPERTIES) && !is_null($this->_INTERNAL_LINK_PROPERTIES) && is_array($this->_INTERNAL_LINK_PROPERTIES)){
			foreach ($this->_INTERNAL_LINK_PROPERTIES as $ClassProperty => $LinkData) {
				if(is_array($LinkData) && (is_null($Fields) || (!is_null($Fields) && is_array($Fields) && in_array($ClassProperty, $Fields)))){
					$Table = $LinkData[0];
					$Query = $LinkData[1];
					if(isset($LinkData[2])){
						$Select = $LinkData[2];
					} else {
						$Select = NULL;
					}
					if(method_exists($this, "Link")){
						self::Link($Table,$Query,$ClassProperty,true,$Select);
					}
				}
			}
		}
	}

	/**
	 * This function is used to debug data
	 * @since 1.3
	 * @access public
	 * @param string|integer|booleabn|object|array $data The data to ouput
	 */
	public function Debug () {
		foreach (func_get_args() as $key => $value) {
			if (is_array($value)) {
				echo "<pre>";
				print_r($value);
				echo "</pre>";
			} else if (is_object($value)) {
				echo "<pre>";
				if (method_exists($value, "Export")) {
					print_r($value->Export(null,false));
				} else {
					print_r($value);
				}
				echo "</pre>";
			} else if (is_bool($value)) {
				echo "<pre>";
				var_dump($value);
				echo "</pre>";
			} else {
				echo $value,"<br>";
			}	
		}
	}

	/**
	 * This function imports data from an array with the same key name as the local property to import too.
	 * @param array $Array The data to import in Name => Value format
	 * @param boolean $Override If this flag is set to true, then if the data is an array the clas $s data is overridden
	 * @param boolean $Secure If this parameter is set to true, then the secure ignore check is done
	 * @since 1.0
	 * @access public
	 */
	public function Import($Array = NULL,$Override = false,$Secure = false){
		if(!is_null($Array) && is_array($Array) && count($Array) > 0){
			$Result = false;
			foreach ($Array as $Property => $Value) {
				$Import_Ignore = array();
				if (property_exists($this, "_INTERNAL_IMPORT_IGNORE") && isset($this->_INTERNAL_IMPORT_IGNORE) && is_array($this->_INTERNAL_IMPORT_IGNORE)){
					$Import_Ignore = $this->_INTERNAL_IMPORT_IGNORE;
				}
				if(property_exists($this, $Property) && !self::_Secure_Ignore($Property,$Secure,$Import_Ignore)){
					$Result = true;
					if (isset($this->_INTERNAL_IMPORT_OVERWRITE) && is_array($this->_INTERNAL_IMPORT_OVERWRITE) && (in_array($Property, $this->_INTERNAL_IMPORT_OVERWRITE) || array_key_exists($Property, $this->_INTERNAL_IMPORT_OVERWRITE))) {
						$Overwrite = (array_key_exists($Property, $this->_INTERNAL_IMPORT_OVERWRITE))? $this->_INTERNAL_IMPORT_OVERWRITE[$Property] : true;
					} else {
						$Overwrite = $Override;
					}
					if (!is_null($Value) && !is_null($Property) && $Value != "" && $Value != "null") {
						if(self::_Has_Load_From_Class($Property)){
							$ClassName = self::_Get_Load_From_Class_Data($Property);
							$this->_CI->load->library($ClassName);
							if (is_array($Value)) {
								if(self::_Has_Interger_Keys($Value)){
									if(self::_Has_Sub_Array($Value)){
										$Temp = array();
										foreach ($Value as $Key => $SubContent) {
											if(is_array($SubContent) && self::_Has_Interger_Keys($SubContent)){
												//Not Sure		
											} else if(is_array($SubContent)){
												$Object = new $ClassName();										
												if(method_exists($Object, "Import")){
													$Object->Import($SubContent);
													self::_Parse_Object_For_Import($Property,$Object, $this, $Key);
													$Temp[$Key] = $Object;
												} else {
													$Temp[$Key] = $SubContent;
												}
											} else if(is_integer($SubContent)){
												$Temp[] = $SubContent;
											} else if(!is_null($SubContent)){ // Could be an error
												$Temp[] = $SubContent;
											}
										}
										self::_Merge_Array($Property,$Temp,$Overwrite);
									} else {
										self::_Merge_Array($Property,$Value,$Overwrite);
									}
								} else {
									$Object = new $ClassName();
									if(method_exists($Object, "Import")){
										$Object->Import($Value);
										self::_Parse_Object_For_Import($Property,$Object, $this, 0);
										self::_Merge_Array($Property,$Object,$Overwrite);
									} else {
										self::_Merge_Array($Property,$Value,$Overwrite);
									}
								}
							} else if (is_integer($Value)) {
								$this->{$Property} = $Value;
							} else if(!is_null($Value)){ //Can be an error, build for later use
								$this->{$Property} = $Value;
							}
						} else {
							self::_Merge_Array($Property,$Value,$Overwrite);
						}
					} else {
						if ($Overwrite && $this->_INTERNAL_IMPORT_EMPTY_NULL === true) {
							$this->{$Property} = "";
						}
					}
				}
			}

		} else {
			return FALSE;
		}
		self::_Load_From_Class();
		self::_Force_Array();
		return $Result;
	}

	/**
	 * This function parse an object for import
	 * @since 1.3
	 * @access private
	 * @param string $property The property where to object is going to be imported into later
	 * @param object &$object  The object to be parsed
	 * @param object &$class   The class where the object is going to be imported into
	 * @param integer $number   An optional key in the import array
	 */
	private function _Parse_Object_For_Import ( $property, &$object, &$class, $number) {
		if (property_exists($class,"_INTERNAL_CURRENT_USER") && isset($class->_INTERNAL_CURRENT_USER) && !is_null($class->_INTERNAL_CURRENT_USER) && method_exists($object,"Set_Current_User")) {
			$object->Set_Current_User($class->_INTERNAL_CURRENT_USER);
		}	
	}

	/**
	 * This function merges an array with the incoming data or just assigns the incomming data
	 * @since 1.3
	 * @access private
	 * @param string $property The property to import it to
	 * @param array|string|integer|boolean $data     The data to import
	 * @param object &$class   The class where the property exists in
	 */
	private function _Import_Data ( $property, $data, &$class) {
		if (property_exists($class, $property)) {
			if (is_array($class->{$property})) {
				$data = (array)$data;
				$class->{$property} = array_merge($class->{$property},$data);
			} else {
				$class->{$property} = $data;
			}
		}
	}

	/**
	 * This function processes input and calls the correct input function for it
	 * @since 1.21
	 * @access private
	 * @param integer|object|array $arguments The input to process
	 * @return integer|boolean
	 */
	private function _Process_Input ( $arguments ) {
		if ( !is_null($arguments) ) {
			if ( is_integer($arguments) ) {
			return self::Load( $arguments );
			} else if ( is_array( $arguments ) ) {
				return self::Import( $arguments );
			} else if ( is_object($arguments) ) {
				return self::Add( $arguments );
			} else if ( property_exists($this, "id") && isset($this->id) ) {
				return $this->id;
			}
		}
	}

	/**
	 * This function checks if the specified property is set in the _INTERNAL_SIMPLE_LOAD array
	 * @param string $Property The property to check for
	 * @return boolean If the data exists in the settings properties
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Simple_Load_Key($Property = NULL){
		if(!is_null($Property) && property_exists($this, $Property)){
			if(property_exists($this, "_INTERNAL_SIMPLE_LOAD") && isset($this->_INTERNAL_SIMPLE_LOAD) && !is_null($this->_INTERNAL_SIMPLE_LOAD) && is_array($this->_INTERNAL_SIMPLE_LOAD)){
				if(array_key_exists($Property, $this->_INTERNAL_SIMPLE_LOAD)){
					return TRUE;
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
	 * This function uses the _INTERNAL_LOAD_FROM_CLASS settings property,
	 * to load up data stored in the specified properties as classes
	 * @param boolean $Simple If this flag is set to true, then this function woundn't do a thing
	 * @param array $Arguments Other arguments parsed from the load function
	 * @since 1.0
	 * @access private
	 */
	private function _Load_From_Class($Simple = false,$Arguments = NULL){
		if(property_exists($this, "_INTERNAL_LOAD_FROM_CLASS")  && isset($this->_INTERNAL_LOAD_FROM_CLASS) && !is_null($this->_INTERNAL_LOAD_FROM_CLASS) && is_array($this->_INTERNAL_LOAD_FROM_CLASS) && !$Simple){
			if(!is_null($this->_INTERNAL_LOAD_FROM_CLASS)){
				foreach ($this->_INTERNAL_LOAD_FROM_CLASS as $Key => $ClassName) {
					if(property_exists($this, $Key) && !is_null($this->{$Key})){
						$ChildSimple = $Simple;
						if(self::_Has_Simple_Load_Key($Key)){
							$ChildSimple = $this->_INTERNAL_SIMPLE_LOAD[$Key];
						}
						if(!is_bool($ChildSimple)){
							$ChildSimple = false;
						}

						//If the CodeIgniter instance exists and isn't null, then load the library
						if(property_exists($this, "_CI") && !is_null($this->_CI)){
							$this->_CI->load->library($ClassName);
						}
						if(!is_null($this->{$Key}) && $this->{$Key} != "" && class_exists($ClassName)){

							//If the property is an array and it contains data, then make the output an array of objects
							if(is_array($this->{$Key}) && count($this->{$Key}) > 0){
								$Temp = array();
								foreach ($this->{$Key} as $Name => $Value) {
									if(is_object($Name)){
										$Temp[] = $Name;
									} else if(is_object($Value)){ 
										$Temp[] = $Value;
									} else {
										if(!is_null($Value) && (is_integer($Value) || is_string($Value)) && class_exists($ClassName)){
											$Value = (int) $Value;
											$Pass = array($Value,$ChildSimple);
											if(!is_null($Arguments) && count($Arguments) > 0){
												$Pass = call_user_func_array("self::_Merge_Arguments", array_merge($Pass,$Arguments));
											}
											$Object = new $ClassName();

											if (property_exists($this,"_INTERNAL_CURRENT_USER") && isset($this->_INTERNAL_CURRENT_USER) && !is_null($this->_INTERNAL_CURRENT_USER) && method_exists($Object,"Set_Current_User")) {
												$Object->Set_Current_User($this->_INTERNAL_CURRENT_USER);
											}
											if(call_user_func_array(array($Object,"Load"),$Pass)){
												if(!is_null($Object)){
													$Temp[] = $Object;
												}
											}
										}
									}
								}
								if(count($Temp) > 0){
									$this->{$Key} = $Temp;
								}

							//Else just set the property as a single object
							} else {
								if(!is_null($this->{$Key})){
									if(class_exists($ClassName) && gettype($this->{$Key}) != "object"){
										$Object = new $ClassName();
										if (property_exists($this,"_INTERNAL_CURRENT_USER") && isset($this->_INTERNAL_CURRENT_USER) && !is_null($this->_INTERNAL_CURRENT_USER) && method_exists($Object,"Set_Current_User")) {
											$Object->Set_Current_User($this->_INTERNAL_CURRENT_USER);
										}
										$Pass = array($this->{$Key},$ChildSimple);
										if(!is_null($Arguments) && count($Arguments) > 0){
											$Pass = call_user_func_array("self::_Merge_Arguments", array_merge($Pass,$Arguments));
										}
										if(call_user_func_array(array($Object,"Load"),$Pass)){
											if(!is_null($Object)){
												$this->{$Key} = $Object;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * This function loops through all the properties deffined in _INTERNAL_CONVERT_TO_BOOLEAN
	 * and converts "1" to true and everything else to false
	 * @since 1.1
	 * @access private
	 * @deprecated This function has been replaced with Export Formating
	 */
	private function _Convert_To_Boolean(){
		if(property_exists($this, "_INTERNAL_CONVERT_TO_BOOLEAN") && isset($this->_INTERNAL_CONVERT_TO_BOOLEAN) && is_array($this->_INTERNAL_CONVERT_TO_BOOLEAN)){
			foreach ($this->_INTERNAL_CONVERT_TO_BOOLEAN as $Key => $Property) {
				if(property_exists($this, $Property)){
					if(is_array($this->{$Property})){	
						foreach ($this->{$Property} as $Key => $Value) {
							if(is_integer($Value) || is_string($this->{$Property})){
								if($Value === 1 || $this->{$Property} === "1"){
									$this->{$Property}[$Key] = true;
								} else {
									$this->{$Property}[$Key] = false;
								}
							} else if(is_null($this->{$Property})){
								$this->{$Property} = false;
							}
						}
					} else if(is_integer($this->{$Property}) || is_string($this->{$Property})){
						if($this->{$Property} === 1 || $this->{$Property} === "1"){
							$this->{$Property} = true;
						} else {
							$this->{$Property} = false;
						}
					} else if(is_null($this->{$Property})){
						$this->{$Property} = false;
					}
				}
			}
		}
	}

	/**
	 * This function Links data, based on data from an array.
	 * @param array $Fields The field selector array
	 * @since 1.1
	 * @access private
	 */
	private function _Load_Link(array $Fields = NULL){
		if(property_exists($this, "_INTERNAL_PROPERTY_LINK") && isset($this->_INTERNAL_PROPERTY_LINK) && !is_null($this->_INTERNAL_PROPERTY_LINK) && is_array($this->_INTERNAL_PROPERTY_LINK)){
			foreach ($this->_INTERNAL_PROPERTY_LINK as $Property => $Data) {
				if(property_exists($this, $Property) && !is_null($this->{$Property}) && (is_null($Fields) || (!is_null($Fields) && is_array($Fields) && in_array($Property, $Fields)))){
					$Table = $Data[0];
					$Row = $Data[1];
					if(isset($Data[2])){
						$Select = $Data[2];
					} else {
						$Select = NULL;
					}
					if(is_array($this->{$Property})){
						foreach ($this->{$Property} as $Key => $Value) {
							if(gettype($Value) != "object"){
								self::Link($Table,array($Row => $Value),$Property,true,$Select);
								unset($this->{$Property}[$Key]);
							}
						}
					} else {
						if(gettype($this->{$Property}) != "object"){
							self::Link($Table,array($Row => $this->{$Property}),$Property,true,$Select);
						}
					}
				}
			}
		}
	}

	/**
	 * This function checks if settings property is set
	 * @since 1.3
	 * @access private
	 * @param object $object   The object to check for the settings property
	 * @param string $property The property to check for
	 * @param string $type     The type of the expected value
	 * @return boolean
	 */
	private function _Settings_Check ( $object = null, $property, $type = "array") {
		if (is_null($object)) {
			$object = $this;
		}
		if (isset($object->{$property}) && property_exists($object, $property) && !is_null($object->{$property}) && !empty($object->{$property})) {
			switch ($type) {
				case 'array':
					return is_array($object->{$property});
					break;
				
				case 'boolean':
					return is_bool($object->{$property});
					break;

				case 'string':
					return is_string($object->{$property});
					break;

				case 'integer':
					return is_integer($object->{$property});
					break;

				case 'object':
					return is_object($object->{$property});
					break;
			}
		}
	}

	/**
	 * This function merges as many arguments as you but only until level 2
	 * wish
	 * @since 1.1
	 * @access private
	 * @return array
	 */
	private function _Merge_Arguments(){
		$Arguments = func_get_args();
		$Return = array();
		foreach ($Arguments as $Key => $Value) {
			if(is_array($Value)){
				foreach ($Value as $Val) {
					if(is_array($Val)){
						$Return = array_merge($Return,array_values($Val));
					}
				}
			} else {
				$Return[] = $Value;
			}
		}
		return $Return;
	}

	/**
	 * This function makes an ignore check, with the _INTERNAL_SECURE_EXPORT_IGNORE data,
	 * passed over as ExtraIgnore to the Ignore function
	 * @param string  $Key    The property name to check for
	 * @param boolean $Secure If this flag is set to true, the ignore check is done
	 * @param array $Extra Extra ignore parameters
	 * @see Ignore
	 * @access private
	 * @since 1.1
	 */
	private function _Secure_Ignore($Key = NULL,$Secure = true,$Extra = array()){
		if($Secure && !is_null($Key)){
			if(property_exists($this, "_INTERNAL_SECURE_EXPORT_IGNORE") && isset($this->_INTERNAL_SECURE_EXPORT_IGNORE) && !is_null($this->_INTERNAL_SECURE_EXPORT_IGNORE) && is_array($this->_INTERNAL_SECURE_EXPORT_IGNORE)){
				$Extra = array_merge($Extra,$this->_INTERNAL_SECURE_EXPORT_IGNORE);
			}
			if(self::Ignore($Key,$Extra)){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function merges the internal data with the input data
	 * @param string  $Property The class property to import too
	 * @param array|integer|string  $Input    The input data
	 * @param boolean $Override If the existing data is going to be overwritten
	 * @since 1.2
	 * @access private
	 */
	private function _Merge_Array ($Property, $Input ,$Override = false) {
		$class = $this;
		if(property_exists($class, $Property)){
			if(is_array($Input) && !is_null($Input)){
				if($Override){
					$class->{$Property} = $Input;
				} else {
					if(!is_null($class->{$Property}) && is_array($class->{$Property})){
						$class->{$Property} = array_merge($class->{$Property},$Input);
					} else if(!is_null($class->{$Property})) {
						$class->{$Property} = array_merge(array($class->{$Property}),$Input);
					} else if(!is_null($Input)){
						$class->{$Property} = $Input;
					}
				}
			} else if(!is_null($Input)){
				if(!is_null($class->{$Property}) && !$Override){
					if(is_array($class->{$Property})){
						$class->{$Property} = array_merge($class->{$Property},array($Input));
					} else {
						$class->{$Property} = array_merge(array($class->{$Property}),array($Input));
					}
				} else {
					$class->{$Property} = $Input;
				}
			}
		}
	}

	/**
	 * This function checks if any key are a integer in type
	 * @since 1.0
	 * @access private
	 * @param array|integer|string $Input The input to check
	 * @return boolean
	 */
	private function _Has_Interger_Keys($Input = NULL){
		if(!is_null($Input) && is_array($Input)){
			$HasInteger = FALSE;
			foreach ($Input as $Key => $Value) {
				if(is_integer($Key)){
					$HasInteger = TRUE;
				}
			}
			return $HasInteger;
		} else {
			return is_integer($Input);
		}
	}

	/**
	 * This function checks if a property exists in the force array settings array
	 * @param string $Property The property to search for
	 * @return boolean If the property is in the force array settings array
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Force_Array($Property = NULL){
		if(!is_null($Property) && property_exists($this, $Property)){
			if(property_exists($this, "_INTERNAL_FORCE_ARRAY") && isset($this->_INTERNAL_FORCE_ARRAY) && !is_null($this->_INTERNAL_FORCE_ARRAY) && is_array($this->_INTERNAL_FORCE_ARRAY)){
				if(in_array($Property, $this->_INTERNAL_FORCE_ARRAY)){
					return TRUE;
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
	 * This function checks if the input data contains sub arrays
	 * @param array||string||object $Data The data to check for sub arrays
	 * @return boolean If the input contains an array
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Sub_Array($Data = NULL){
		if(!is_null($Data)){
			if(is_array($Data)){
				$Has_Sub_Array = false;
				foreach ($Data as $Key => $Value) {
					if(is_array($Value) || is_array($Key)){
						$Has_Sub_Array = true;
					}
				}
				return $Has_Sub_Array;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function check's if a load from class key exists, in the _INTERNAL_LOAD_FROM_CLASS settings array
	 * @since 1.1
	 * @access private
	 * @param string $Property The property to search for
	 * @return boolean If the key exists, in the settings array
	 */
	private function _Has_Load_From_Class($Property = NULL){
		if(!is_null($Property)){
			if(property_exists($this, "_INTERNAL_LOAD_FROM_CLASS") && isset($this->_INTERNAL_LOAD_FROM_CLASS) && !is_null($this->_INTERNAL_LOAD_FROM_CLASS) && is_array($this->_INTERNAL_LOAD_FROM_CLASS) && array_key_exists($Property, $this->_INTERNAL_LOAD_FROM_CLASS)){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function gets data from the _INTERNAL_LOAD_FROM_CLASS settings array of a specific property.
	 * @param string $Property The property to get the data for
	 * @since 1.1
	 * @access private
	 * @return string The clas to load from of the specified property
	 */
	private function _Get_Load_From_Class_Data($Property = NULL){
		if(!is_null($Property) && self::_Has_Load_From_Class($Property)){
			return $this->_INTERNAL_LOAD_FROM_CLASS[$Property];
		}
	}

	/**
	 * This function loops through the setttings variable containing the properties to force as array
	 * and make them an array
	 * @since 1.1
	 * @access private
	 */
	private function _Force_Array(){
		if(property_exists($this, "_INTERNAL_FORCE_ARRAY") && isset($this->_INTERNAL_FORCE_ARRAY) && !is_null($this->_INTERNAL_FORCE_ARRAY) && is_array($this->_INTERNAL_FORCE_ARRAY)){
			foreach ($this->_INTERNAL_FORCE_ARRAY as $Force) {
				if(property_exists($this, $Force) && !is_array($this->{$Force})){
					if(!is_null($this->{$Force})){
						$Temp = array($this->{$Force});
						$this->{$Force} = $Temp;
					}
				}
			}
		}
	}

	/**
	 * This function gets the _INTERNAL_ROW_NAME_CONVERT array of an object if data exists for it
	 * or if the _INTERNAL_DATABASE_NAME_CONVERT exists it generates it.
	 * @param object $Object The object to get the data from
	 * @since 1.1
	 * @access private
	 * @return array The _INTERNAL_ROW_NAME_CONVERT data, if it exists
	 */
	private function _Get_Row_Name_Convert($Object = NULL){
		if(!is_null($Object) && gettype($Object) == "object"){
			if(property_exists($Object, "_INTERNAL_ROW_NAME_CONVERT") && isset($Object->_INTERNAL_ROW_NAME_CONVERT) && !is_null($Object->_INTERNAL_ROW_NAME_CONVERT)){
				return $Object->_INTERNAL_ROW_NAME_CONVERT;
			} else {
				if(property_exists($Object, "_INTERNAL_DATABASE_NAME_CONVERT") && isset($Object->_INTERNAL_DATABASE_NAME_CONVERT) && !is_null($Object->_INTERNAL_DATABASE_NAME_CONVERT)){
					$Temp = array();
					foreach ($Object->_INTERNAL_DATABASE_NAME_CONVERT as $Property => $Row) {
						$Temp[$Row] = $Property;
					}
					if(count($Temp) > 0){
						return $Temp;
					}
				}
			}
		}
	}

	/**
	 * This function checks if a property isset
	 * @param string $Property The property to chech
	 * @param object $Object   The object to check in, default is $this
	 * @since 1.2
	 * @access private
	 * @return boolean
	 */
	private function _Isset($Property = NULL,$Object = NULL){
		if(is_null($Object)){
			$Object = $this;
		}
		if(property_exists($Object, $Property) && isset($Object->{$Property}) && !is_null($Object->{$Property}) && !empty($Object->{$Property}) && $Object->{$Property} != ""){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * This function checks if a node in _INTERNAL_SAVE_THESE_CHILDS_FIRST is existing for that property
	 * @param string $Property The property to check for
	 * @since 1.2
	 * @return boolean
	 * @access private
	 */
	private function _Save_Before_Parent($Property = NULL){
		if(!is_null($Property) && property_exists($this, $Property) && self::_Isset("_INTERNAL_SAVE_THESE_CHILDS_FIRST")){
			return in_array($Property, $this->_INTERNAL_SAVE_THESE_CHILDS_FIRST);
		} else {
			return FALSE;
		}
	}

	/**
	 * This function loops through the _INTERNAL_LOAD_FROM_CLASS properties,
	 * if there's some extra information set in _INTERNAL_SAVE_LINK, that needs to be assigned
	 * to the object(s) then it's done, and the Save method is called on the child objects
	 * @since 1.1
	 * @access private
	 */
	private function _Save_ChildClasses_Properties(){
		if(property_exists($this, "_INTERNAL_LOAD_FROM_CLASS") && isset($this->_INTERNAL_LOAD_FROM_CLASS) && !is_null($this->_INTERNAL_LOAD_FROM_CLASS) && is_array($this->_INTERNAL_LOAD_FROM_CLASS)){
			foreach ($this->_INTERNAL_LOAD_FROM_CLASS as $Property => $ClassName) {
				if(!is_null($Property) && !self::_Is_Linked_Property($Property) && property_exists($this, $Property) && !self::_Save_Before_Parent($Property)){
					if(is_array($this->{$Property})){
						foreach ($this->{$Property} as $Key => $Object) {
							self::_Save_Object($Object, $Property);
						}
					} else {
						$Object = $this->{$Property};
						self::_Save_Object($Object, $Property);
					}
				}
			}
		}
	}

	/**
	 * This function performs the required actions on the object,
	 * and saves it
	 * @param object $object   The object to save
	 * @param string $property The property where the object is located
	 * @since 1.3
	 * @access private
	 * @return boolean
	 */
	private function _Save_Object ( $object, $property ) {
		if (is_object($object)) {
			if (!self::_Is_Linked_Property($property, $object)) {
				if(self::_Has_Save_Link($property)){
					$save_link_data = self::_Get_save_link_data($property);
					if(!is_null($save_link_data)){
						self::_Set_save_link_data($save_link_data,$object);
					}
				}
				if (property_exists($this,"_INTERNAL_CURRENT_USER") && isset($this->_INTERNAL_CURRENT_USER) && !is_null($this->_INTERNAL_CURRENT_USER) && method_exists($object,"Set_Current_User")) {
					$object->Set_Current_User($this->_INTERNAL_CURRENT_USER);
				}
				if(!is_null($object) && method_exists($object, "Save")){
					return $object->Save();
				}
			} else {
				self::_Save_Linked_Object($object, $property);
			}
		}
		return FALSE;
	}

	/**
	 * This function checks if the $Property is a linked property
	 * @param string $Property The class property to check for
	 * @since 1.1
	 * @access private
	 * @return boolean if the property is a Linked property
	 */
	private function _Is_Linked_Property($property = NULL, $object = null){
		if (is_null($object)) {
			$object = $this;
		}
		if(!is_null($property)){
			if(property_exists($object, "_INTERNAL_LINK_PROPERTIES") && isset($object->_INTERNAL_LINK_PROPERTIES) && !is_null($object->_INTERNAL_LINK_PROPERTIES) && is_array($object->_INTERNAL_LINK_PROPERTIES)){
				if(array_key_exists($property,$object->_INTERNAL_LINK_PROPERTIES)){
					return TRUE;
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
	 * This function checks if there exists Save link data about a given property
	 * @param string $Property The property to search for
	 * @since 1.1
	 * @access private
	 * @return boolean If the data exists
	 */
	private function _Has_Save_Link($Property = NULL){
		if(property_exists($this, "_INTERNAL_SAVE_LINK") && isset($this->_INTERNAL_SAVE_LINK) && !is_null($this->_INTERNAL_SAVE_LINK) && is_array($this->_INTERNAL_SAVE_LINK)){
			if(array_key_exists($Property, $this->_INTERNAL_SAVE_LINK)){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function returns the Save Link data if it exists
	 * @param string $Property the property to get data for
	 * @return array The save link data if it exists
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Save_Link_Data($Property = NULL){
		if(!is_null($Property) && self::_Has_Save_Link($Property)){
			return (!is_null($this->_INTERNAL_SAVE_LINK[$Property]) && isset($this->_INTERNAL_SAVE_LINK[$Property]))? $this->_INTERNAL_SAVE_LINK[$Property] : NULL;
		}
	}

	/**
	 * This function assigns the Save_Link data to a object
	 * @param array $Data   The data to assign
	 * @param object $Object The object to assign it too
	 * @since 1.1
	 * @access private
	 */
	private function _Set_Save_Link_Data($Data = NULL,$Object = NULL){
		if(!is_null($Data) && !is_null($Object)){
			foreach ($Data as $Property => $Value) {
				if(property_exists($this, $Value)){
					$Value = $this->{$Value};
				}
				if(is_array($Object)){
					foreach ($Object as $TempObject) {
						$TempObject->{$Property} = $Value;
					}
				} else {
					if(property_exists($Object, $Property)){
						$Object->{$Property} = $Value;
					}
				}
			}
		}
	}

	/**
	 * This function get's the data of a classes _INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL,
	 * data
	 * @return boolean The data of the settings property
	 * @since 1.1
	 * @access private
	 */
	private function _Abort_On_Empty(){
		if(!is_null($this)){
			if(property_exists($this, "_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL") && isset($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL) && !is_null($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL) && is_bool($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL)){
				return $this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function returns the value of the _INTERNAL_OVERWRITE_ON_DUBLICATE property
	 * @since 1.0
	 * @access private
	 * @return boolean
	 */
	private function _Overwrite_On_Dublicate () {
		if (property_exists($this, "_INTERNAL_OVERWRITE_ON_DUBLICATE") && isset($this->_INTERNAL_OVERWRITE_ON_DUBLICATE)) {
			return $this->_INTERNAL_OVERWRITE_ON_DUBLICATE;
		} else {
			return FALSE;
		}
	}

	/**
	 * This function creates the query for the _Match_Data in the std_model,
	 * and executes it
	 * @since 1.1
	 * @access private
	 */
	private function _Not_Allowed_Dublicate_Rows(){
		if(property_exists($this, "_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS") && isset($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS) && !is_null($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS) && is_array($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS)){
			$Query = array();
			$Export = self::Database();
			foreach ($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS as $Key) {
				if(isset($Export[$Key]) && !is_null($Export[$Key])){
					$Query[$Key] = $Export[$Key];
				} else {
					if(self::_Abort_On_Empty()){
						return true;
					}
				}
			}
			if(method_exists($this->_CI->_INTERNAL_DATABASE_MODEL, "Match_Data")){
				return $this->_CI->_INTERNAL_DATABASE_MODEL->Match_Data($this,$Query);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function saves the childrens that are supposed to be saved before the parent
	 * @since 1.2
	 * @access private
	 */
	private function _Save_Childrens_Before(){
		if(self::_Isset("_INTERNAL_SAVE_THESE_CHILDS_FIRST")){
			foreach ($this->_INTERNAL_SAVE_THESE_CHILDS_FIRST as $Property) {
				//Get the duplicate check function
				$duplicate_function = (isset($parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$Property]))? $parent->_INTERNAL_LINK_SAVE_DUPLICATE_FUNCTION[$Property] : NULL;

				if(self::_Has_Load_From_Class($Property)){
					$Linked = self::_Is_Linked_Property($Property);
					if(isset($this->{$Property}) && is_array($this->{$Property})){
						foreach ($this->{$Property} as $Object) {
							if ($Linked) {
								self::_Link_Objects_Data_Duplicate($this, $this->{$Property}, $Property); //
								self::_Save_Linked_Object($Object,$Property,$duplicate_function);
							} else {
								self::_Save_Object($Object, $Property);
							}
						}
					} else {
						if (isset($this->{$Property})) {
							if ($Linked) {
								
								self::_Link_Objects_Data_Duplicate($this, $this->{$Property}, $Property);
								self::_Save_Linked_Object($this->{$Property},$Property,$duplicate_function);
							} else {
								self::_Save_Object($this->{$Property}, $Property);
							}
						}
					}
				}
			}
		}
	}

	/**
	 * This function removes the key/keys with the specific value
	 * @param object $Property The property to search in
	 * @param string|boolean|integer $Value    The value to search for
	 * @since 1.1
	 * @access private
	 */
	private function _Remove_Where($Property = NULL,$Value = NULL){
		if(!is_null($Property) && property_exists($this, $Property)){
			if(is_array($this->{$Property})){
				$Keys = array_keys($this->{$Property},$Value);
				if(count($Keys) == 1){
					unset($this->{$Property}[$Keys[0]]);
				} else {
					foreach ($Keys as $Key) {
						unset($this->{$Property}[$Key]);
					}
				}
			}
		}
	}

	/**
	 * This function gets either one property
	 * from and object or more properties
	 * @param object $Object     The object to get the data from
	 * @param string|array $Properties The property/properties to get
	 * @param boolean $Merge If the data should be merged to one array
	 * @return array|string
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Data_From_Object ($Object = NULL,$Properties = NULL, $Merge = false) {
		if(!is_null($Object) && is_object($Object) && !is_null($Properties)){
			if (count($Properties) == 1 && $Merge == true) {
				$Properties = array_shift(array_values($Properties));;
			}
			if(is_array($Properties)){
				$Temp = array();
				foreach ($Properties as $Property) {
					if(property_exists($Object, $Property)){
						$Temp[$Property] = $Object->{$Property};
					}
				}
				return $Temp;
			} else {
				if(property_exists($Object, $Properties)){
					return $Object->{$Properties};
				}
			}
		}
	}

	/**
	 * This function sets the data returned from a link query
	 * @param array $Data     The data to get the objects from
	 * @param string $Property The class property to set the data too
	 * @param string|array $Select   The row/rows to select
	 * @since 1.1
	 * @access private
	 */
	private function _Link_Set_Data($Data = NULL,$Property = NULL,$Select = NULL){
		if(!is_null($Data) && is_array($Data) &&!is_null($Property) && property_exists($this, $Property)){
			if(!is_null($Select)){
				$UseProperty = $Select;
			} else {
				$UseProperty = "id";
			}

			if (isset($this->_INTERNAL_LINKED_MERGE_RESULTS) && is_array($this->_INTERNAL_LINKED_MERGE_RESULTS) && array_key_exists($Property, $this->_INTERNAL_LINKED_MERGE_RESULTS)) {
				$Merge = $this->_INTERNAL_LINKED_MERGE_RESULTS[$Property];
			} else {
				$Merge = false;
			}

			if(count($Data) > 1){
				$Temp = array();
				foreach ($Data as $Object) {
					if(is_array($UseProperty)){
						$Temp[] = self::_Get_Data_From_Object($Object,$UseProperty,$Merge);
					} else {
						if(property_exists($Object, $UseProperty)){
							self:: _Remove_Where($Property,$Object->{$UseProperty});
							$Temp[] = self::_Get_Data_From_Object($Object,$UseProperty,$Merge);
						}	
					}
				}
				if(count($Temp) > 0){
					if(is_null($this->{$Property})){
						$this->{$Property} = $Temp;
					} else {
						if(is_array($this->{$Property})){
							$this->{$Property} = array_merge($this->{$Property},$Temp);
						} else {
							$this->{$Property} = $Temp;
						}
					}
				}
			} else {
				if(isset($Data[0])){
					$Data = $Data[0];
				}
				if(!is_null($Data) && is_object($Data)){
					if(is_array($this->{$Property})){
						$this->{$Property}[] = self::_Get_Data_From_Object($Data,$UseProperty,$Merge);
					} else {
						$this->{$Property} = self::_Get_Data_From_Object($Data,$UseProperty,$Merge);
					}
				}
			}
		}
	}

	/**
	 * This function converts a object to an array if there's more objects in the input or just a string if there's only one
	 * @param object||array $Data The object to convert to a string or array
	 * @param string $function The function to call on the object
	 * @return array||string This output will either be the id of the object or an array with the id's
	 * @access private
	 * @since 1.1
	 */
	private function _Convert_From_Object($Data = NULL , $function = "Export"){
		$Return = NULL;
		if(!is_null($Data)){
			if(is_array($Data) && count($Data) > 0){
				$Temp = array();
				foreach ($Data as $K => $Object) {
					if(!is_null($Object)){
						if(property_exists($Object, "id")){
							$Temp[] = $Object->id;
						} elseif(method_exists($Object, $function)){
							$Temp[] = $Object->$function();
						}
					}
				}
				if(count($Temp) > 0){
					$Return = $Temp;
				}
			} else {
				if(property_exists($Data, "id")){
					$Return = $Data->id;
				} else if (method_exists($Data, $function)) {
					$Return = $Data->$function();
				}
			}
			if(!is_null($Return)){
				return $Return;
			}
		}
	}

	/**
	 * This function checks if the input $Data is containing an object,
	 * either inside an array or just as the value
	 * @param object||array||boolean||string|integer $Data The data to check
	 * @since 1.1
	 * @access private
	 * @return boolean The check result
	 */
	private function _Contains_Object($Data = NULL){
		if(!is_null($Data)){
			if(is_array($Data)){
				foreach ($Data as $Key => $Value) {
					if(is_object($Key) || is_object($Value)){
						return true;
					} else {
						return false;
					}
				}
			} else {
				return (is_object($Data)) ? true : false;
			}
		} else {
			return false;
		}
	}

	/**
	 * This function gets a property of an object, and converts it with a Row Name table,
	 * if it exists
	 * @param array||object $Data The data to use
	 * @param string $Row  The property data to use
	 * @return string|integer The property data if anny
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Property_Linked_Row_Data_From_Object($Data = NULL,$Row = NULL){
		if(!is_null($Data) && !is_null($Row) && is_object($Data)){
			$Object = $Data;
			$Row_Names = self::_Get_Row_Name_Convert($Object);
			if(!is_null($Row_Names) && is_array($Row_Names) && array_key_exists($Row, $Row_Names)){
				$Row = $Row_Names[$Row];
			}
			if(property_exists($Object, $Row)){
				return $Object->{$Row};
			}
		}
	}

	/**
	 * This function is converting the data linked with,
	 * Property Link to a string used in export
	 * @param array|object $Data     The data to convert
	 * @param string $Property The class property where the data is from
	 * @return array|integer|object|string The data of the input converted
	 * @since 1.1
	 * @access private
	 */
	private function _Property_Linked_Row_Export($Data = NULL,$Property = NULL){
		if(!is_null($Data) && !is_null($Property)){
			$Row = self::_Get_Property_Linked_Row_Settings($Property);
			$Row = $Row[1];
			if(!is_null($Data) && !is_null($Row)){
				if(self::_Contains_Object($Data)){
					if(is_array($Data)){
						$Temp = array();
						foreach ($Data as $Key => $Data) {
							 $Return = self::_Get_Property_Linked_Row_Data_From_Object($Data,$Row);
							if(!is_null($Return)){
							 	$Temp[] = $Return;
							}
						}
						if(count($Temp) > 0){
							return $Temp;
						} else {
							return $Data;
						}
					} else {
						return self::_Get_Property_Linked_Row_Data_From_Object($Data,$Row);
					}
				} else {
					return $Data;
				}
			} else {
				return $Data;
			}
		} else {
			return $Data;
		}
	}

	/**
	 * This function extracts setting from the _INTERNAL_PROPERTY_LINK settings array
	 * @param string $Property The property to search for
	 * @return array The settings data
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Property_Linked_Row_Settings($Property = NULL){
		if(!is_null($Property)){
			return (array_key_exists($Property, $this->_INTERNAL_PROPERTY_LINK))? $this->_INTERNAL_PROPERTY_LINK[$Property] : NULL;
		}
	}

	/**
	 * This function checks if a key is in the _INTERNAL_PROPERTY_LINK array
	 * @param string $Property The property to check for
	 * @since 1.1
	 * @access private
	 * @return boolean If it exists in the settings array
	 */
	private function _Is_Property_Linked_Row($Property = NULL){
		if(!is_null($Property)){
			if(property_exists($this, "_INTERNAL_PROPERTY_LINK") && isset($this->_INTERNAL_PROPERTY_LINK) && !is_null($this->_INTERNAL_PROPERTY_LINK) && is_array($this->_INTERNAL_PROPERTY_LINK)){
				if(array_key_exists($Property, $this->_INTERNAL_PROPERTY_LINK)){
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}

	/**
	 * This function removes local data, set the id flag to true to remove the id too.
	 * @param boolean $Id If this is set to true then the id is cleared too
	 * @since 1.0
	 * @access private
	 */
	private function _RemoveUserData($Id = false){
		foreach(get_class_vars(get_class($this)) as $Name => $Value){
			if($Name != "CI" && $Name != "_CI" && $Name != "Database_Table" && strpos($Name, "INTERNAL_") === false){
				if($Name != "id"){
					$this->{$Name} = NULL;
				}
				if($Id == true && $Name == "id"){
					$this->{$Name} = NULL;
				}
			}
		}
	}

	/**
	 * This function takes an array and adds the data to the variable with the right key {Name},
	 * with the corrosponding data {Value}
	 * @param array $Array The data in Name => Value format to set
	 * @since 1.0
	 * @access private
	 */
	private function _SetDataArray($Array = NULL){
		if(!is_null($Array)){
			if(method_exists($this,"Import")){
				self::Import($Array);
			}
		}
	}

	/**
	 * This function removes data from the specified row in the $Id parameter
	 * @param integer $Id The database row id to remove
	 * @since 1.0
	 * @access private
	 */
	private function _RemoveDatabaseData($Id = NULL,$Table = NULL){
		if(!is_null($Id)){
			$this->id = $Id;
		}
		if(!is_null($this->id) && !is_null($Table)){
			if(property_exists($this, "_CI") && property_exists($this, "_CI")){
				$this->_CI->db->delete($Table,array("id" => $this->id));
			}
		}
	}

	/**
	 * This function only sets the output if input exists
	 * @param object|string|number &$Input  The input data to check if exists
	 * @param object|string|number &$Output The output data to set if the input isset
	 * @since 1.0
	 * @access private
	 */
	private function _CheckData(&$Input = NULL,&$Output = NULL){
		if(!is_null($Input) && !is_null($Output)){
			if(isset($Input) && @!is_null($Input)){
				$Output = $Input;
			}
		}
	}

	/**
	 * This function adds data from an class that has the same property names as the data you wish to add
	 * @param object $Class An instance of the object you wish to set
	 * @access private
	 * @since 1.0
	 */
	private function _SetDataClass(&$Class = NULL){
		if(!is_null($Class)){
			foreach (get_object_vars($Class) as $Key => $Value) {
				if(property_exists(get_class($this), $Key)){
					if(!is_null($Class->{$Key}) && $Class->{$Key} != "" && $Key != "CI" && strpos($Key, "INTERNAL_") === false){
						$this->{$Key} = $Class->{$Key};
					}
				}
			}
			
		}
	}
}