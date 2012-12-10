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
 * @version 0.1
 * @date 02:04 10.12.2012
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
	
}

?>