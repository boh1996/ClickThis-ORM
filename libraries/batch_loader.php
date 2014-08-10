<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Batch_Loader {

	/**
	 * An internal refference to CodeIgniter
	 * @since 1.0
	 * @access private
	 * @var object
	 */
	private $_CI = null;

	/**
	 * Data about the last query
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	private $_last = null;

	/**
	 * If the last query was a success or a failure
	 *
	 * @since 1.0
	 * @var boolean
	 */
	public $success = false;

	/**
	 * A reffence to CodeIgniter->db
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $db = null;

	public function __construct () {
		$this->_CI =& get_instance();
		$this->db =& $this->_CI->db;
	}

	/**
	 * This function fetches the results asked for and loads into objects,
	 * use other functions to set thw where, where_in or like query
	 * @since 1.0
	 * @access public
	 * @return array|boolean
	 * @param string $table       The db table to load from
	 * @param string $object_name The name of the object to load
	 * @param integer $limit       Limit used for pagination
	 * @param integer $offset      Offset used for pagination
	 * @param array $fields      The database fields to select
	 */
	protected function _Fetch ( $table, $object_name, $limit = null, $offset = null, $fields = null ) {
		$this->_CI->load->library($object_name);

		$Object = new $object_name();

		$this->db->from($table);

		if ( ! is_null($limit) && ! is_null($offset) ) {
			$this->db->limit($limit, $offset);
		} else if ( is_null($limit) && ! is_null($offset) ) {
			$this->db->limit(0, $offset);
		} else if ( ! is_null($limit) && is_null($offset) ) {
			$this->db->limit($limit);
		}

		if ( ! is_null($fields) ) {
			$db_fields = $fields;
			if ( ! in_array("id", $fields) && property_exists($Object, "id") ) {
				$db_fields[] = "id";
			}
			$this->db->select(implode(",", $Object->Convert_Fields($db_fields)));
		}

		$query = $this->db->get();

		if ( $query->num_rows() == false ) return false;

		$this->last = array();

		$this->last["num_rows"] = $query->num_rows();

		$objects = array();

		foreach ( $query->result_array() as $row ) {

			$Instance = new $object_name();

			$Instance->Import($Instance->Convert_From_Database($row),false,false,array(),false,true);
			$Instance->Import_Load($fields);
			$objects[] = $Instance->Export($fields);
		}

		$this->success = true;

		return $objects;
	}
		
	/**
	 * This function can load a group of objects with the same type
	 * @since 1.0
	 * @access public
	 * @return array|boolean
	 * @param string $table       The db table to load from
	 * @param string $object_name The name of the object to load
	 * @param array $where       The select query
	 * @param integer $limit       Limit used for pagination
	 * @param integer $offset      Offset used for pagination
	 * @param array $fields      The database fields to select
	 * @param array $query 		 Search query
	 */
	public function Load ( $table, $object_name, $where = null,  $limit = null, $offset = null, $fields = null, $query = null ) {
		$this->_CI->load->library($object_name);

		$Object = new $object_name();

		if ( ! is_null($where) && is_array($where) ) {
			$this->db->where($Object->Convert($where));
		}

		if ( ! is_null($query) && is_array($query) ) {
			$this->db->like($Object->Convert($query));
		}

		return self::_Fetch($table, $object_name, $limit, $offset, $fields);
	}

	/**
	 * This function returns data about the last query
	 * @since 1.0
	 * @access public
	 */
	public function Last () {
		if ( is_null($this->last) ) return false;

		return $this->last;
	}
}
?>