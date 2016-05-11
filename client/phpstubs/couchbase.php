<?php

// Start of couchbase v.2.0.7

class CouchbaseException extends Exception  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Clone the exception
	 * @link http://php.net/manual/en/exception.clone.php
	 * @return void No value is returned.
	 */
	final private function __clone () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param string $message [optional] <p>
	 * The Exception message to throw.
	 * </p>
	 * @param int $code [optional] <p>
	 * The Exception code.
	 * </p>
	 * @param Exception $previous [optional] <p>
	 * The previous exception used for the exception chaining.
	 * </p>
	 */
	public function __construct ($message = "", $code = 0, Exception $previous = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception message
	 * @link http://php.net/manual/en/exception.getmessage.php
	 * @return string the Exception message as a string.
	 */
	final public function getMessage () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception code
	 * @link http://php.net/manual/en/exception.getcode.php
	 * @return mixed the exception code as integer in
	 * <b>Exception</b> but possibly as other type in
	 * <b>Exception</b> descendants (for example as
	 * string in <b>PDOException</b>).
	 */
	final public function getCode () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the file in which the exception occurred
	 * @link http://php.net/manual/en/exception.getfile.php
	 * @return string the filename in which the exception was created.
	 */
	final public function getFile () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the line in which the exception occurred
	 * @link http://php.net/manual/en/exception.getline.php
	 * @return int the line number where the exception was created.
	 */
	final public function getLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace
	 * @link http://php.net/manual/en/exception.gettrace.php
	 * @return array the Exception stack trace as an array.
	 */
	final public function getTrace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns previous Exception
	 * @link http://php.net/manual/en/exception.getprevious.php
	 * @return Exception the previous <b>Exception</b> if available
	 * or <b>NULL</b> otherwise.
	 */
	final public function getPrevious () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace as a string
	 * @link http://php.net/manual/en/exception.gettraceasstring.php
	 * @return string the Exception stack trace as a string.
	 */
	final public function getTraceAsString () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString () {}

}

class CouchbaseMetaDoc  {
	public $error;
	public $value;
	public $flags;
	public $cas;

}

class _CouchbaseCluster  {

	public function __construct () {}

	public function connect () {}

	public function http_request () {}

}

class _CouchbaseBucket  {

	public function __construct () {}

	public function insert () {}

	public function upsert () {}

	public function replace () {}

	public function append () {}

	public function prepend () {}

	public function remove () {}

	public function get () {}

	public function getFromReplica () {}

	public function touch () {}

	public function counter () {}

	public function unlock () {}

	public function http_request () {}

	public function durability () {}

	public function setTranscoder () {}

	public function setOption () {}

	public function getOption () {}

}
define ('COUCHBASE_PERSISTTO_MASTER', 1);
define ('COUCHBASE_PERSISTTO_ONE', 1);
define ('COUCHBASE_PERSISTTO_TWO', 2);
define ('COUCHBASE_PERSISTTO_THREE', 4);
define ('COUCHBASE_REPLICATETO_ONE', 16);
define ('COUCHBASE_REPLICATETO_TWO', 32);
define ('COUCHBASE_REPLICATETO_THREE', 64);
define ('COUCHBASE_CNTL_OP_TIMEOUT', 0);
define ('COUCHBASE_CNTL_VIEW_TIMEOUT', 1);
define ('COUCHBASE_CNTL_DURABILITY_INTERVAL', 14);
define ('COUCHBASE_CNTL_DURABILITY_TIMEOUT', 13);
define ('COUCHBASE_CNTL_HTTP_TIMEOUT', 15);
define ('COUCHBASE_CNTL_CONFIGURATION_TIMEOUT', 18);
define ('COUCHBASE_CNTL_CONFDELAY_THRESH', 25);
define ('COUCHBASE_CNTL_CONFIG_NODE_TIMEOUT', 27);
define ('COUCHBASE_CNTL_HTCONFIG_IDLE_TIMEOUT', 28);
define ('COUCHBASE_SUCCESS', 0);
define ('COUCHBASE_AUTH_CONTINUE', 1);
define ('COUCHBASE_AUTH_ERROR', 2);
define ('COUCHBASE_DELTA_BADVAL', 3);
define ('COUCHBASE_E2BIG', 4);
define ('COUCHBASE_EBUSY', 5);
define ('COUCHBASE_ENOMEM', 8);
define ('COUCHBASE_ERANGE', 9);
define ('COUCHBASE_ERROR', 10);
define ('COUCHBASE_ETMPFAIL', 11);
define ('COUCHBASE_EINVAL', 7);
define ('COUCHBASE_CLIENT_ETMPFAIL', 27);
define ('COUCHBASE_KEY_EEXISTS', 12);
define ('COUCHBASE_KEY_ENOENT', 13);
define ('COUCHBASE_DLOPEN_FAILED', 14);
define ('COUCHBASE_DLSYM_FAILED', 15);
define ('COUCHBASE_NETWORK_ERROR', 16);
define ('COUCHBASE_NOT_MY_VBUCKET', 17);
define ('COUCHBASE_NOT_STORED', 18);
define ('COUCHBASE_NOT_SUPPORTED', 19);
define ('COUCHBASE_UNKNOWN_COMMAND', 20);
define ('COUCHBASE_UNKNOWN_HOST', 21);
define ('COUCHBASE_PROTOCOL_ERROR', 22);
define ('COUCHBASE_ETIMEDOUT', 23);
define ('COUCHBASE_BUCKET_ENOENT', 25);
define ('COUCHBASE_CLIENT_ENOMEM', 26);
define ('COUCHBASE_CONNECT_ERROR', 24);
define ('COUCHBASE_EBADHANDLE', 28);
define ('COUCHBASE_SERVER_BUG', 29);
define ('COUCHBASE_PLUGIN_VERSION_MISMATCH', 30);
define ('COUCHBASE_INVALID_HOST_FORMAT', 31);
define ('COUCHBASE_INVALID_CHAR', 32);
define ('COUCHBASE_DURABILITY_ETOOMANY', 33);
define ('COUCHBASE_DUPLICATE_COMMANDS', 34);
define ('COUCHBASE_EINTERNAL', 6);
define ('COUCHBASE_NO_MATCHING_SERVER', 35);
define ('COUCHBASE_BAD_ENVIRONMENT', 36);
define ('COUCHBASE_VALUE_F_JSON', 1);
define ('COUCHBASE_TMPFAIL', 11);
define ('COUCHBASE_KEYALREADYEXISTS', 12);
define ('COUCHBASE_KEYNOTFOUND', 13);

// End of couchbase v.2.0.7
?>
