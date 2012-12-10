<?php header('Content-Type: text/html; charset=utf-8');

/**
 * tncSQLManager
 * Simple MySQL Query Manager for PHP
 * This class can compose and execute MySQL queries from parameters.
 * It can take parameters that define tables, field names, field values,
 * and conditions to compose INSERT, UPDATE and DELETE queries on a
 * given MySQL database.
 *
 * @author Tanju Yildiz <yildiz.tanju@gmail.com>
 * @file tncsqlmanager.php
 * @version 0.3
 * @date 02:47 10.12.2012
 */

class tncSQLManager {
	
	// Connection Variables
	private $dbHost = '';
	private $dbUser = '';
	private $dbPass = '';
	private $dbName = '';
	
	// General Variables
	private $debug = false;
	public $connection;
	
	/**
	 * tncSQLManager::__construct()
	 * @return
	 */
	function __construct() {
		try {
			$this->connection = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
			mysql_select_db($this->dbName, $this->connection);
			if ( !$this->connection ) {
				throw new Exception('MySQL Database Error: '.mysql_error());
			} else {
				return true;
			}
		} catch(Exception $e) {
			printf('ERROR %s', $e->getMessage());
			exit();
		}
	}

	/**
	 * tncSQLManager::query()
	 * @param mixed $sql
	 * @access public
	 * @return
	 */
	public function query($sql) {
		if ( $this->debug === false) {
			try {
				$result = mysql_query($sql);
				if ( $result === false ) {
					throw new Exception('MySQL Query Error: '.mysql_error());
				}
				return $result;
			} catch(Exception $e) {
				printf('ERROR %s', $e->getMessage());
				exit();
			}
		} else {
			printf('<pre>%s</pre>', $sql);
		}
	}
	
	/**
	 * tncSQLManager::fetchArray()
	 * @param mixed $result
	 * @access public
	 * @return array $array
	 */
	public function fetchArray($result) {
		$$array = mysql_fetch_array($result, MYSQL_ASSOC);
		return $array;
	}
	
	/**
	 * tncSQLManager::numRows()
	 * @param mixed $result
	 * @access public
	 * @return 
	 */
	public function numRows($result) {
		return mysql_num_rows($result);
	}
	
} // end of class
?>