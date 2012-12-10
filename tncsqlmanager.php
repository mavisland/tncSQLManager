<?php

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
 * @version 0.7
 * @date 03:39 10.12.2012
 */

class tncSQLManager {
	
	// Connection Variables
	private $dbHost = 'localhost';
	private $dbUser = 'root';
	private $dbPass = '12345678';
	private $dbName = 'kaletekcan';
	
	// General Variables
	private $debug = true;
	public $connection;
	
	/**
	 * tncSQLManager::__construct()
	 * @access public
	 * @return
	 */
	public function __construct() {
		try {
 			$this->connection = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
 			mysql_select_db($this->dbName, $this->connection);
 			if (! $this->connection) {
 				throw new Exception('MySQL Connection Database Error: ' . mysql_error());
 			} else {
 				return true;
 			}
 		} catch (Exception $e) {
 			printf('ERROR: %s', $e->getMessage());
 			exit();
 		}
	}
	
	/**
	 * tncSQLManager::__destruct()
	 * @access public
	 * @return
	 */
	public function __destruct() {
		return mysql_close($this->connection);
	}
	
	/**
	 * tncSQLManager::query()
	 * @access public
	 * @param mixed $sql 
	 * @return
	 */
	public function query($sql) {
		if ($this->debug === false) {
			try {
				$result = mysql_query($sql);
				if ($result === false) {
					throw new Exception('MySQL Query Error: ' . mysql_error());
				}
				return $result;
			} catch (Exception $e) {
				printf('ERROR: %s', $e->getMessage());
				exit();
			}
		} else {
			printf('<pre>%s</pre>', $sql);
		}
	}
	
	/**
	 * tncSQLManager::fetchArray()
	 * @access public
	 * @param mixed $result
	 * @return array $row
	 */
	public function fetchArray($result) {
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return $row;
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
	
	/**
	 * tncSQLManager::implodeArray()
	 * @access private
	 * @param array $data, $seperated
	 * @return string $string
	 */
	private function implodeArray($data = array(), $seperated) {
		$fields = array_keys($data);
		$values = array_values(array_map('mysql_real_escape_string', $data));
		$i = 0;
		while($fields[$i]) {
			if ($i > 0) {
				$string .= $seperated;
			}
			$string .= sprintf("%s = '%s'", $fields[$i], $values[$i]);
			$i++;
		}
		return $string;
	}
	
	/**
	 * tncSQLManager::queryInsert()
	 * @access public
	 * @param $table, array $data
	 * @return
	 */
	public function queryInsert($table, $data = array()) {
		$fields = implode(', ', array_keys($data));
		$values = implode('", "', array_map('mysql_real_escape_string', $data));
		$query  = sprintf('INSERT INTO %s (%s) VALUES ("%s")', $table, $fields, $values);
		return $this->query($query);
	}
	
	/**
	 * tncSQLManager::queryUpdate()
	 * @access public
	 * @param $table, array $data, array $where
	 * $return 
	 */
	public function queryUpdate($table, $data = array(), $where = array()) {
		$fields    = $this->implodeArray($data, ', ');
		$condition = $this->implodeArray($where, ' AND ');
		$query     = sprintf('UPDATE %s SET %s WHERE %s', $table, $fields, $condition);
		return $this->query($query);
	}
	
	/**
	 * tncSQLManager::queryDelete()
	 * @access public
	 * @param $table, array $where
	 * $return
	 */
	public function queryDelete($table, $where = array()) {
		$condition = $this->implodeArray($where, ' AND ');
		$query     = sprintf('DELETE FROM %s WHERE %s', $table, $condition);
		return $this->query($query);
	}
	
} // end of class
?>