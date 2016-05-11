<?php

// Start of mysqli v.0.1

/**
 * The mysqli exception handling class.
 * @link http://php.net/manual/en/class.mysqli-sql-exception.php
 */
class mysqli_sql_exception extends RuntimeException  {
	protected $message;
	protected $file;
	protected $line;
	protected $code;
	protected $sqlstate;


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

/**
 * MySQLi Driver.
 * @link http://php.net/manual/en/class.mysqli-driver.php
 */
final class mysqli_driver  {
	/**
	 * @var string
	 */
	public $client_info;
	/**
	 * @var string
	 */
	public $client_version;
	/**
	 * @var string
	 */
	public $driver_version;
	/**
	 * @var string
	 */
	public $embedded;
	/**
	 * @var bool
	 */
	public $reconnect;
	/**
	 * @var int
	 */
	public $report_mode;

}

/**
 * Represents a connection between PHP and a MySQL database.
 * @link http://php.net/manual/en/class.mysqli.php
 */
class mysqli  {
	/**
	 * @var int
	 */
	public $affected_rows;
	/**
	 * @var string
	 */
	public $client_info;
	/**
	 * @var int
	 */
	public $client_version;
	/**
	 * @var int
	 */
	public $connect_errno;
	/**
	 * @var string
	 */
	public $connect_error;
	/**
	 * @var int
	 */
	public $errno;
	/**
	 * @var array
	 */
	public $error_list;
	/**
	 * @var string
	 */
	public $error;
	/**
	 * @var int
	 */
	public $field_count;
	/**
	 * @var int
	 */
	public $client_version;
	/**
	 * @var string
	 */
	public $host_info;
	/**
	 * @var string
	 */
	public $protocol_version;
	/**
	 * @var string
	 */
	public $server_info;
	/**
	 * @var int
	 */
	public $server_version;
	/**
	 * @var string
	 */
	public $info;
	/**
	 * @var mixed
	 */
	public $insert_id;
	/**
	 * @var string
	 */
	public $sqlstate;
	/**
	 * @var int
	 */
	public $thread_id;
	/**
	 * @var int
	 */
	public $warning_count;


	/**
	 * (PHP 5)<br/>
	 * Turns on or off auto-committing database modifications
	 * @link http://php.net/manual/en/mysqli.autocommit.php
	 * @param bool $mode <p>
	 * Whether to turn on auto-commit or not.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function autocommit ($mode) {}

	/**
	 * (PHP 5 &gt;= 5.5.0)<br/>
	 * Starts a transaction
	 * @link http://php.net/manual/en/mysqli.begin-transaction.php
	 * @param int $flags [optional] <p>
	 * </p>
	 * @param string $name [optional] <p>
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function begin_transaction ($flags = null, $name = null) {}

	/**
	 * (PHP 5)<br/>
	 * Changes the user of the specified database connection
	 * @link http://php.net/manual/en/mysqli.change-user.php
	 * @param string $user <p>
	 * The MySQL user name.
	 * </p>
	 * @param string $password <p>
	 * The MySQL password.
	 * </p>
	 * @param string $database <p>
	 * The database to change to.
	 * </p>
	 * <p>
	 * If desired, the <b>NULL</b> value may be passed resulting in only changing
	 * the user and not selecting a database. To select a database in this
	 * case use the <b>mysqli_select_db</b> function.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function change_user ($user, $password, $database) {}

	/**
	 * (PHP 5)<br/>
	 * Returns the default character set for the database connection
	 * @link http://php.net/manual/en/mysqli.character-set-name.php
	 * @return string The default character set for the current connection
	 */
	public function character_set_name () {}

	/**
	 * (PHP 5)<br/>
	 * Closes a previously opened database connection
	 * @link http://php.net/manual/en/mysqli.close.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function close () {}

	/**
	 * (PHP 5)<br/>
	 * Commits the current transaction
	 * @link http://php.net/manual/en/mysqli.commit.php
	 * @param int $flags [optional] <p>
	 * A bitmask of <b>MYSQLI_TRANS_COR_*</b> constants.
	 * </p>
	 * @param string $name [optional] <p>
	 * If provided then COMMIT/*name* / is executed.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function commit ($flags = null, $name = null) {}

	/**
	 * @param $host [optional]
	 * @param $user [optional]
	 * @param $password [optional]
	 * @param $database [optional]
	 * @param $port [optional]
	 * @param $socket [optional]
	 */
	public function connect ($host, $user, $password, $database, $port, $socket) {}

	/**
	 * (PHP 5)<br/>
	 * Dump debugging information into the log
	 * @link http://php.net/manual/en/mysqli.dump-debug-info.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function dump_debug_info () {}

	/**
	 * (PHP 5)<br/>
	 * Performs debugging operations
	 * @link http://php.net/manual/en/mysqli.debug.php
	 * @param string $message <p>
	 * A string representing the debugging operation to perform
	 * </p>
	 * @return bool <b>TRUE</b>.
	 */
	public function debug ($message) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Returns a character set object
	 * @link http://php.net/manual/en/mysqli.get-charset.php
	 * @return object The function returns a character set object with the following properties:
	 * <i>charset</i>
	 * <p>Character set name</p>
	 * <i>collation</i>
	 * <p>Collation name</p>
	 * <i>dir</i>
	 * <p>Directory the charset description was fetched from (?) or "" for built-in character sets</p>
	 * <i>min_length</i>
	 * <p>Minimum character length in bytes</p>
	 * <i>max_length</i>
	 * <p>Maximum character length in bytes</p>
	 * <i>number</i>
	 * <p>Internal character set number</p>
	 * <i>state</i>
	 * <p>Character set status (?)</p>
	 */
	public function get_charset () {}

	/**
	 * (PHP 5)<br/>
	 * Get MySQL client info
	 * @link http://php.net/manual/en/mysqli.get-client-info.php
	 * @return string A string that represents the MySQL client library version
	 */
	public function get_client_info () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns statistics about the client connection
	 * @link http://php.net/manual/en/mysqli.get-connection-stats.php
	 * @return bool an array with connection stats if success, <b>FALSE</b> otherwise.
	 */
	public function get_connection_stats () {}

	public function get_server_info () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Get result of SHOW WARNINGS
	 * @link http://php.net/manual/en/mysqli.get-warnings.php
	 * @return mysqli_warning
	 */
	public function get_warnings () {}

	/**
	 * (PHP 5)<br/>
	 * Initializes MySQLi and returns a resource for use with mysqli_real_connect()
	 * @link http://php.net/manual/en/mysqli.init.php
	 * @return mysqli an object.
	 */
	public function init () {}

	/**
	 * (PHP 5)<br/>
	 * Asks the server to kill a MySQL thread
	 * @link http://php.net/manual/en/mysqli.kill.php
	 * @param int $processid
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function kill ($processid) {}

	/**
	 * (PHP 5)<br/>
	 * Performs a query on the database
	 * @link http://php.net/manual/en/mysqli.multi-query.php
	 * @param string $query <p>
	 * The query, as a string.
	 * </p>
	 * <p>
	 * Data inside the query should be properly escaped.
	 * </p>
	 * @return bool <b>FALSE</b> if the first statement failed.
	 * To retrieve subsequent errors from other statements you have to call
	 * <b>mysqli_next_result</b> first.
	 */
	public function multi_query ($query) {}

	/**
	 * @param $host [optional]
	 * @param $user [optional]
	 * @param $password [optional]
	 * @param $database [optional]
	 * @param $port [optional]
	 * @param $socket [optional]
	 */
	public function mysqli ($host, $user, $password, $database, $port, $socket) {}

	/**
	 * (PHP 5)<br/>
	 * Check if there are any more query results from a multi query
	 * @link http://php.net/manual/en/mysqli.more-results.php
	 * @return bool <b>TRUE</b> if one or more result sets are available from a previous call to
	 * <b>mysqli_multi_query</b>, otherwise <b>FALSE</b>.
	 */
	public function more_results () {}

	/**
	 * (PHP 5)<br/>
	 * Prepare next result from multi_query
	 * @link http://php.net/manual/en/mysqli.next-result.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function next_result () {}

	/**
	 * (PHP 5)<br/>
	 * Set options
	 * @link http://php.net/manual/en/mysqli.options.php
	 * @param int $option <p>
	 * The option that you want to set. It can be one of the following values:
	 * <table>
	 * Valid options
	 * <tr valign="top">
	 * <td>Name</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_OPT_CONNECT_TIMEOUT</b></td>
	 * <td>connection timeout in seconds (supported on Windows with TCP/IP since PHP 5.3.1)</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_OPT_LOCAL_INFILE</b></td>
	 * <td>enable/disable use of LOAD LOCAL INFILE</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_INIT_COMMAND</b></td>
	 * <td>command to execute after when connecting to MySQL server</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_READ_DEFAULT_FILE</b></td>
	 * <td>
	 * Read options from named option file instead of my.cnf
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_READ_DEFAULT_GROUP</b></td>
	 * <td>
	 * Read options from the named group from my.cnf
	 * or the file specified with <b>MYSQL_READ_DEFAULT_FILE</b>.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_SERVER_PUBLIC_KEY</b></td>
	 * <td>
	 * RSA public key file used with the SHA-256 based authentication.
	 * </td>
	 * </tr>
	 * </table>
	 * </p>
	 * @param mixed $value <p>
	 * The value for the option.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function options ($option, $value) {}

	/**
	 * (PHP 5)<br/>
	 * Pings a server connection, or tries to reconnect if the connection has gone down
	 * @link http://php.net/manual/en/mysqli.ping.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function ping () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Poll connections
	 * @link http://php.net/manual/en/mysqli.poll.php
	 * @param array $read <p>
	 * List of connections to check for outstanding results that can be read.
	 * </p>
	 * @param array $error <p>
	 * List of connections on which an error occured, for example, query
	 * failure or lost connection.
	 * </p>
	 * @param array $reject <p>
	 * List of connections rejected because no asynchronous query
	 * has been run on for which the function could poll results.
	 * </p>
	 * @param int $sec <p>
	 * Number of seconds to wait, must be non-negative.
	 * </p>
	 * @param int $usec [optional] <p>
	 * Number of microseconds to wait, must be non-negative.
	 * </p>
	 * @return int number of ready connections upon success, <b>FALSE</b> otherwise.
	 */
	public static function poll (array &$read, array &$error, array &$reject, $sec, $usec = null) {}

	/**
	 * (PHP 5)<br/>
	 * Prepare an SQL statement for execution
	 * @link http://php.net/manual/en/mysqli.prepare.php
	 * @param string $query <p>
	 * The query, as a string.
	 * </p>
	 * <p>
	 * You should not add a terminating semicolon or \g
	 * to the statement.
	 * </p>
	 * <p>
	 * This parameter can include one or more parameter markers in the SQL
	 * statement by embedding question mark (?) characters
	 * at the appropriate positions.
	 * </p>
	 * <p>
	 * The markers are legal only in certain places in SQL statements.
	 * For example, they are allowed in the VALUES()
	 * list of an INSERT statement (to specify column
	 * values for a row), or in a comparison with a column in a
	 * WHERE clause to specify a comparison value.
	 * </p>
	 * <p>
	 * However, they are not allowed for identifiers (such as table or
	 * column names), in the select list that names the columns to be
	 * returned by a SELECT statement, or to specify both
	 * operands of a binary operator such as the = equal
	 * sign. The latter restriction is necessary because it would be
	 * impossible to determine the parameter type. It's not allowed to
	 * compare marker with NULL by
	 * ? IS NULL too. In general, parameters are legal
	 * only in Data Manipulation Language (DML) statements, and not in Data
	 * Definition Language (DDL) statements.
	 * </p>
	 * @return mysqli_stmt <b>mysqli_prepare</b> returns a statement object or <b>FALSE</b> if an error occurred.
	 */
	public function prepare ($query) {}

	/**
	 * (PHP 5)<br/>
	 * Performs a query on the database
	 * @link http://php.net/manual/en/mysqli.query.php
	 * @param string $query <p>
	 * The query string.
	 * </p>
	 * <p>
	 * Data inside the query should be properly escaped.
	 * </p>
	 * @param int $resultmode [optional] <p>
	 * Either the constant <b>MYSQLI_USE_RESULT</b> or
	 * <b>MYSQLI_STORE_RESULT</b> depending on the desired
	 * behavior. By default, <b>MYSQLI_STORE_RESULT</b> is used.
	 * </p>
	 * <p>
	 * If you use <b>MYSQLI_USE_RESULT</b> all subsequent calls
	 * will return error Commands out of sync unless you
	 * call <b>mysqli_free_result</b>
	 * </p>
	 * <p>
	 * With <b>MYSQLI_ASYNC</b> (available with mysqlnd), it is
	 * possible to perform query asynchronously.
	 * <b>mysqli_poll</b> is then used to get results from such
	 * queries.
	 * </p>
	 * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
	 * EXPLAIN queries <b>mysqli_query</b> will return
	 * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
	 * return <b>TRUE</b>.
	 */
	public function query ($query, $resultmode = 'MYSQLI_STORE_RESULT') {}

	/**
	 * (PHP 5)<br/>
	 * Opens a connection to a mysql server
	 * @link http://php.net/manual/en/mysqli.real-connect.php
	 * @param string $host [optional] <p>
	 * Can be either a host name or an IP address. Passing the <b>NULL</b> value
	 * or the string "localhost" to this parameter, the local host is
	 * assumed. When possible, pipes will be used instead of the TCP/IP
	 * protocol.
	 * </p>
	 * @param string $username [optional] <p>
	 * The MySQL user name.
	 * </p>
	 * @param string $passwd [optional] <p>
	 * If provided or <b>NULL</b>, the MySQL server will attempt to authenticate
	 * the user against those user records which have no password only. This
	 * allows one username to be used with different permissions (depending
	 * on if a password as provided or not).
	 * </p>
	 * @param string $dbname [optional] <p>
	 * If provided will specify the default database to be used when
	 * performing queries.
	 * </p>
	 * @param int $port [optional] <p>
	 * Specifies the port number to attempt to connect to the MySQL server.
	 * </p>
	 * @param string $socket [optional] <p>
	 * Specifies the socket or named pipe that should be used.
	 * </p>
	 * <p>
	 * Specifying the <i>socket</i> parameter will not
	 * explicitly determine the type of connection to be used when
	 * connecting to the MySQL server. How the connection is made to the
	 * MySQL database is determined by the <i>host</i>
	 * parameter.
	 * </p>
	 * @param int $flags [optional] <p>
	 * With the parameter <i>flags</i> you can set different
	 * connection options:
	 * </p>
	 * <table>
	 * Supported flags
	 * <tr valign="top">
	 * <td>Name</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_CLIENT_COMPRESS</b></td>
	 * <td>Use compression protocol</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_CLIENT_FOUND_ROWS</b></td>
	 * <td>return number of matched rows, not the number of affected rows</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_CLIENT_IGNORE_SPACE</b></td>
	 * <td>Allow spaces after function names. Makes all function names reserved words.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_CLIENT_INTERACTIVE</b></td>
	 * <td>
	 * Allow interactive_timeout seconds (instead of
	 * wait_timeout seconds) of inactivity before closing the connection
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_CLIENT_SSL</b></td>
	 * <td>Use SSL (encryption)</td>
	 * </tr>
	 * </table>
	 * <p>
	 * For security reasons the <b>MULTI_STATEMENT</b> flag is
	 * not supported in PHP. If you want to execute multiple queries use the
	 * <b>mysqli_multi_query</b> function.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function real_connect ($host = null, $username = null, $passwd = null, $dbname = null, $port = null, $socket = null, $flags = null) {}

	/**
	 * (PHP 5)<br/>
	 * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
	 * @link http://php.net/manual/en/mysqli.real-escape-string.php
	 * @param string $escapestr <p>
	 * The string to be escaped.
	 * </p>
	 * <p>
	 * Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and
	 * Control-Z.
	 * </p>
	 * @return string an escaped string.
	 */
	public function real_escape_string ($escapestr) {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get result from async query
	 * @link http://php.net/manual/en/mysqli.reap-async-query.php
	 * @return mysqli_result <b>mysqli_result</b> in success, <b>FALSE</b> otherwise.
	 */
	public function reap_async_query () {}

	/**
	 * @param $string_to_escape
	 */
	public function escape_string ($string_to_escape) {}

	/**
	 * (PHP 5)<br/>
	 * Execute an SQL query
	 * @link http://php.net/manual/en/mysqli.real-query.php
	 * @param string $query <p>
	 * The query, as a string.
	 * </p>
	 * <p>
	 * Data inside the query should be properly escaped.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function real_query ($query) {}

	/**
	 * (PHP 5 &gt;= 5.5.0)<br/>
	 * Removes the named savepoint from the set of savepoints of the current transaction
	 * @link http://php.net/manual/en/mysqli.release-savepoint.php
	 * @param string $name <p>
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function release_savepoint ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Rolls back current transaction
	 * @link http://php.net/manual/en/mysqli.rollback.php
	 * @param int $flags [optional] <p>
	 * A bitmask of <b>MYSQLI_TRANS_COR_*</b> constants.
	 * </p>
	 * @param string $name [optional] <p>
	 * If provided then ROLLBACK/*name* / is executed.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function rollback ($flags = null, $name = null) {}

	/**
	 * (PHP 5 &gt;= 5.5.0)<br/>
	 * Set a named transaction savepoint
	 * @link http://php.net/manual/en/mysqli.savepoint.php
	 * @param string $name <p>
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function savepoint ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Selects the default database for database queries
	 * @link http://php.net/manual/en/mysqli.select-db.php
	 * @param string $dbname <p>
	 * The database name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function select_db ($dbname) {}

	/**
	 * (PHP 5 &gt;= 5.0.5)<br/>
	 * Sets the default client character set
	 * @link http://php.net/manual/en/mysqli.set-charset.php
	 * @param string $charset <p>
	 * The charset to be set as default.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function set_charset ($charset) {}

	/**
	 * (PHP 5)<br/>
	 * Alias of <b>mysqli_options</b>
	 * @link http://php.net/manual/en/function.mysqli-set-opt.php
	 * @param $option
	 * @param $value
	 */
	public function set_opt ($option, $value) {}

	/**
	 * (PHP 5)<br/>
	 * Used for establishing secure connections using SSL
	 * @link http://php.net/manual/en/mysqli.ssl-set.php
	 * @param string $key <p>
	 * The path name to the key file.
	 * </p>
	 * @param string $cert <p>
	 * The path name to the certificate file.
	 * </p>
	 * @param string $ca <p>
	 * The path name to the certificate authority file.
	 * </p>
	 * @param string $capath <p>
	 * The pathname to a directory that contains trusted SSL CA certificates
	 * in PEM format.
	 * </p>
	 * @param string $cipher <p>
	 * A list of allowable ciphers to use for SSL encryption.
	 * </p>
	 * @return bool This function always returns <b>TRUE</b> value. If SSL setup is
	 * incorrect <b>mysqli_real_connect</b> will return an error
	 * when you attempt to connect.
	 */
	public function ssl_set ($key, $cert, $ca, $capath, $cipher) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the current system status
	 * @link http://php.net/manual/en/mysqli.stat.php
	 * @return string A string describing the server status. <b>FALSE</b> if an error occurred.
	 */
	public function stat () {}

	/**
	 * (PHP 5)<br/>
	 * Initializes a statement and returns an object for use with mysqli_stmt_prepare
	 * @link http://php.net/manual/en/mysqli.stmt-init.php
	 * @return mysqli_stmt an object.
	 */
	public function stmt_init () {}

	/**
	 * (PHP 5)<br/>
	 * Transfers a result set from the last query
	 * @link http://php.net/manual/en/mysqli.store-result.php
	 * @param int $option [optional] <p>
	 * The option that you want to set. It can be one of the following values:
	 * <table>
	 * Valid options
	 * <tr valign="top">
	 * <td>Name</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MYSQLI_STORE_RESULT_COPY_DATA</b></td>
	 * <td>Copy results from the internal mysqlnd buffer into the PHP variables fetched. By default,
	 * mysqlnd will use a reference logic to avoid copying and duplicating results held in memory.
	 * For certain result sets, for example, result sets with many small rows, the copy approach can
	 * reduce the overall memory usage because PHP variables holding results may be
	 * released earlier (available with mysqlnd only, since PHP 5.6.0)</td>
	 * </tr>
	 * </table>
	 * </p>
	 * @return mysqli_result a buffered result object or <b>FALSE</b> if an error occurred.
	 * </p>
	 * <p>
	 * <b>mysqli_store_result</b> returns <b>FALSE</b> in case the query
	 * didn't return a result set (if the query was, for example an INSERT
	 * statement). This function also returns <b>FALSE</b> if the reading of the
	 * result set failed. You can check if you have got an error by checking
	 * if <b>mysqli_error</b> doesn't return an empty string, if
	 * <b>mysqli_errno</b> returns a non zero value, or if
	 * <b>mysqli_field_count</b> returns a non zero value.
	 * Also possible reason for this function returning <b>FALSE</b> after
	 * successful call to <b>mysqli_query</b> can be too large
	 * result set (memory for it cannot be allocated). If
	 * <b>mysqli_field_count</b> returns a non-zero value, the
	 * statement should have produced a non-empty result set.
	 */
	public function store_result ($option = null) {}

	/**
	 * (PHP 5)<br/>
	 * Returns whether thread safety is given or not
	 * @link http://php.net/manual/en/mysqli.thread-safe.php
	 * @return bool <b>TRUE</b> if the client library is thread-safe, otherwise <b>FALSE</b>.
	 */
	public function thread_safe () {}

	/**
	 * (PHP 5)<br/>
	 * Initiate a result set retrieval
	 * @link http://php.net/manual/en/mysqli.use-result.php
	 * @return mysqli_result an unbuffered result object or <b>FALSE</b> if an error occurred.
	 */
	public function use_result () {}

	/**
	 * (PHP 5 &lt;= 5.3.0)<br/>
	 * Refreshes
	 * @link http://php.net/manual/en/mysqli.refresh.php
	 * @param int $options <p>
	 * The options to refresh, using the MYSQLI_REFRESH_* constants as documented
	 * within the MySQLi constants documentation.
	 * </p>
	 * <p>
	 * See also the official MySQL Refresh
	 * documentation.
	 * </p>
	 * @return bool <b>TRUE</b> if the refresh was a success, otherwise <b>FALSE</b>
	 */
	public function refresh ($options) {}

}

/**
 * Represents a MySQL warning.
 * @link http://php.net/manual/en/class.mysqli-warning.php
 */
final class mysqli_warning  {
	public $message;
	public $sqlstate;
	public $errno;


	/**
	 * (PHP 5)<br/>
	 * The __construct purpose
	 * @link http://php.net/manual/en/mysqli-warning.construct.php
	 */
	protected function __construct () {}

	/**
	 * (PHP 5)<br/>
	 * The next purpose
	 * @link http://php.net/manual/en/mysqli-warning.next.php
	 * @return void
	 */
	public function next () {}

}

/**
 * Represents the result set obtained from a query against the database.
 * @link http://php.net/manual/en/class.mysqli-result.php
 */
class mysqli_result implements Traversable {
	public $current_field;
	public $field_count;
	public $lengths;
	public $num_rows;
	public $type;


	public function __construct () {}

	public function close () {}

	/**
	 * (PHP 5)<br/>
	 * Frees the memory associated with a result
	 * @link http://php.net/manual/en/mysqli-result.free.php
	 * @return void No value is returned.
	 */
	public function free () {}

	/**
	 * (PHP 5)<br/>
	 * Adjusts the result pointer to an arbitrary row in the result
	 * @link http://php.net/manual/en/mysqli-result.data-seek.php
	 * @param int $offset <p>
	 * The field offset. Must be between zero and the total number of rows
	 * minus one (0..<b>mysqli_num_rows</b> - 1).
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function data_seek ($offset) {}

	/**
	 * (PHP 5)<br/>
	 * Returns the next field in the result set
	 * @link http://php.net/manual/en/mysqli-result.fetch-field.php
	 * @return object an object which contains field definition information or <b>FALSE</b>
	 * if no field information is available.
	 * </p>
	 * <p>
	 * <table>
	 * Object properties
	 * <tr valign="top">
	 * <td>Property</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>name</td>
	 * <td>The name of the column</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>orgname</td>
	 * <td>Original column name if an alias was specified</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>table</td>
	 * <td>The name of the table this field belongs to (if not calculated)</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>orgtable</td>
	 * <td>Original table name if an alias was specified</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>def</td>
	 * <td>Reserved for default value, currently always ""</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>db</td>
	 * <td>Database (since PHP 5.3.6)</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>catalog</td>
	 * <td>The catalog name, always "def" (since PHP 5.3.6)</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>max_length</td>
	 * <td>The maximum width of the field for the result set.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>length</td>
	 * <td>The width of the field, as specified in the table definition.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>charsetnr</td>
	 * <td>The character set number for the field.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>flags</td>
	 * <td>An integer representing the bit-flags for the field.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>type</td>
	 * <td>The data type used for this field</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>decimals</td>
	 * <td>The number of decimals used (for integer fields)</td>
	 * </tr>
	 * </table>
	 */
	public function fetch_field () {}

	/**
	 * (PHP 5)<br/>
	 * Returns an array of objects representing the fields in a result set
	 * @link http://php.net/manual/en/mysqli-result.fetch-fields.php
	 * @return array an array of objects which contains field definition information or
	 * <b>FALSE</b> if no field information is available.
	 * </p>
	 * <p>
	 * <table>
	 * Object properties
	 * <tr valign="top">
	 * <td>Property</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>name</td>
	 * <td>The name of the column</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>orgname</td>
	 * <td>Original column name if an alias was specified</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>table</td>
	 * <td>The name of the table this field belongs to (if not calculated)</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>orgtable</td>
	 * <td>Original table name if an alias was specified</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>max_length</td>
	 * <td>The maximum width of the field for the result set.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>length</td>
	 * <td>The width of the field, as specified in the table definition.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>charsetnr</td>
	 * <td>The character set number for the field.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>flags</td>
	 * <td>An integer representing the bit-flags for the field.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>type</td>
	 * <td>The data type used for this field</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>decimals</td>
	 * <td>The number of decimals used (for integer fields)</td>
	 * </tr>
	 * </table>
	 */
	public function fetch_fields () {}

	/**
	 * (PHP 5)<br/>
	 * Fetch meta-data for a single field
	 * @link http://php.net/manual/en/mysqli-result.fetch-field-direct.php
	 * @param int $fieldnr <p>
	 * The field number. This value must be in the range from
	 * 0 to number of fields - 1.
	 * </p>
	 * @return object an object which contains field definition information or <b>FALSE</b>
	 * if no field information for specified fieldnr is
	 * available.
	 * </p>
	 * <p>
	 * <table>
	 * Object attributes
	 * <tr valign="top">
	 * <td>Attribute</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>name</td>
	 * <td>The name of the column</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>orgname</td>
	 * <td>Original column name if an alias was specified</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>table</td>
	 * <td>The name of the table this field belongs to (if not calculated)</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>orgtable</td>
	 * <td>Original table name if an alias was specified</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>def</td>
	 * <td>The default value for this field, represented as a string</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>max_length</td>
	 * <td>The maximum width of the field for the result set.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>length</td>
	 * <td>The width of the field, as specified in the table definition.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>charsetnr</td>
	 * <td>The character set number for the field.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>flags</td>
	 * <td>An integer representing the bit-flags for the field.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>type</td>
	 * <td>The data type used for this field</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>decimals</td>
	 * <td>The number of decimals used (for numeric fields)</td>
	 * </tr>
	 * </table>
	 */
	public function fetch_field_direct ($fieldnr) {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Fetches all result rows as an associative array, a numeric array, or both
	 * @link http://php.net/manual/en/mysqli-result.fetch-all.php
	 * @param int $resulttype [optional] <p>
	 * This optional parameter is a constant indicating what type of array
	 * should be produced from the current row data. The possible values for
	 * this parameter are the constants <b>MYSQLI_ASSOC</b>,
	 * <b>MYSQLI_NUM</b>, or <b>MYSQLI_BOTH</b>.
	 * </p>
	 * @return mixed an array of associative or numeric arrays holding result rows.
	 */
	public function fetch_all ($resulttype = 'MYSQLI_NUM') {}

	/**
	 * (PHP 5)<br/>
	 * Fetch a result row as an associative, a numeric array, or both
	 * @link http://php.net/manual/en/mysqli-result.fetch-array.php
	 * @param int $resulttype [optional] <p>
	 * This optional parameter is a constant indicating what type of array
	 * should be produced from the current row data. The possible values for
	 * this parameter are the constants <b>MYSQLI_ASSOC</b>,
	 * <b>MYSQLI_NUM</b>, or <b>MYSQLI_BOTH</b>.
	 * </p>
	 * <p>
	 * By using the <b>MYSQLI_ASSOC</b> constant this function
	 * will behave identically to the <b>mysqli_fetch_assoc</b>,
	 * while <b>MYSQLI_NUM</b> will behave identically to the
	 * <b>mysqli_fetch_row</b> function. The final option
	 * <b>MYSQLI_BOTH</b> will create a single array with the
	 * attributes of both.
	 * </p>
	 * @return mixed an array of strings that corresponds to the fetched row or <b>NULL</b> if there
	 * are no more rows in resultset.
	 */
	public function fetch_array ($resulttype = 'MYSQLI_BOTH') {}

	/**
	 * (PHP 5)<br/>
	 * Fetch a result row as an associative array
	 * @link http://php.net/manual/en/mysqli-result.fetch-assoc.php
	 * @return array an associative array of strings representing the fetched row in the result
	 * set, where each key in the array represents the name of one of the result
	 * set's columns or <b>NULL</b> if there are no more rows in resultset.
	 * </p>
	 * <p>
	 * If two or more columns of the result have the same field names, the last
	 * column will take precedence. To access the other column(s) of the same
	 * name, you either need to access the result with numeric indices by using
	 * <b>mysqli_fetch_row</b> or add alias names.
	 */
	public function fetch_assoc () {}

	/**
	 * (PHP 5)<br/>
	 * Returns the current row of a result set as an object
	 * @link http://php.net/manual/en/mysqli-result.fetch-object.php
	 * @param string $class_name [optional] <p>
	 * The name of the class to instantiate, set the properties of and return.
	 * If not specified, a <b>stdClass</b> object is returned.
	 * </p>
	 * @param array $params [optional] <p>
	 * An optional array of parameters to pass to the constructor
	 * for <i>class_name</i> objects.
	 * </p>
	 * @return object an object with string properties that corresponds to the fetched
	 * row or <b>NULL</b> if there are no more rows in resultset.
	 */
	public function fetch_object ($class_name = "stdClass", array $params = null) {}

	/**
	 * (PHP 5)<br/>
	 * Get a result row as an enumerated array
	 * @link http://php.net/manual/en/mysqli-result.fetch-row.php
	 * @return mixed <b>mysqli_fetch_row</b> returns an array of strings that corresponds to the fetched row
	 * or <b>NULL</b> if there are no more rows in result set.
	 */
	public function fetch_row () {}

	/**
	 * (PHP 5)<br/>
	 * Set result pointer to a specified field offset
	 * @link http://php.net/manual/en/mysqli-result.field-seek.php
	 * @param int $fieldnr <p>
	 * The field number. This value must be in the range from
	 * 0 to number of fields - 1.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function field_seek ($fieldnr) {}

	public function free_result () {}

}

/**
 * Represents a prepared statement.
 * @link http://php.net/manual/en/class.mysqli-stmt.php
 */
class mysqli_stmt  {
	public $affected_rows;
	public $insert_id;
	public $num_rows;
	public $param_count;
	public $field_count;
	public $errno;
	public $error;
	public $error_list;
	public $sqlstate;
	public $id;


	/**
	 * (PHP 5)<br/>
	 * Constructs a new <b>mysqli_stmt</b> object
	 * @link http://php.net/manual/en/mysqli-stmt.construct.php
	 * @param mysqli $link
	 * @param string $query [optional] <p>
	 * The query, as a string. If this parameter is omitted, then the
	 * constructor behaves identically to
	 * <b>mysqli_stmt_init</b>, if provided, then it behaves as
	 * per <b>mysqli_prepare</b>.
	 * </p>
	 */
	public function __construct (mysqli $link, $query = null) {}

	/**
	 * (PHP 5)<br/>
	 * Used to get the current value of a statement attribute
	 * @link http://php.net/manual/en/mysqli-stmt.attr-get.php
	 * @param int $attr <p>
	 * The attribute that you want to get.
	 * </p>
	 * @return int <b>FALSE</b> if the attribute is not found, otherwise returns the value of the attribute.
	 */
	public function attr_get ($attr) {}

	/**
	 * (PHP 5)<br/>
	 * Used to modify the behavior of a prepared statement
	 * @link http://php.net/manual/en/mysqli-stmt.attr-set.php
	 * @param int $attr <p>
	 * The attribute that you want to set. It can have one of the following values:
	 * <table>
	 * Attribute values
	 * <tr valign="top">
	 * <td>Character</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH</td>
	 * <td>
	 * Setting to <b>TRUE</b> causes <b>mysqli_stmt_store_result</b> to
	 * update the metadata MYSQL_FIELD->max_length value.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>MYSQLI_STMT_ATTR_CURSOR_TYPE</td>
	 * <td>
	 * Type of cursor to open for statement when <b>mysqli_stmt_execute</b>
	 * is invoked. <i>mode</i> can be MYSQLI_CURSOR_TYPE_NO_CURSOR
	 * (the default) or MYSQLI_CURSOR_TYPE_READ_ONLY.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>MYSQLI_STMT_ATTR_PREFETCH_ROWS</td>
	 * <td>
	 * Number of rows to fetch from server at a time when using a cursor.
	 * <i>mode</i> can be in the range from 1 to the maximum
	 * value of unsigned long. The default is 1.
	 * </td>
	 * </tr>
	 * </table>
	 * </p>
	 * <p>
	 * If you use the MYSQLI_STMT_ATTR_CURSOR_TYPE option with
	 * MYSQLI_CURSOR_TYPE_READ_ONLY, a cursor is opened for the
	 * statement when you invoke <b>mysqli_stmt_execute</b>. If there
	 * is already an open cursor from a previous <b>mysqli_stmt_execute</b> call,
	 * it closes the cursor before opening a new one. <b>mysqli_stmt_reset</b>
	 * also closes any open cursor before preparing the statement for re-execution.
	 * <b>mysqli_stmt_free_result</b> closes any open cursor.
	 * </p>
	 * <p>
	 * If you open a cursor for a prepared statement, <b>mysqli_stmt_store_result</b>
	 * is unnecessary.
	 * </p>
	 * @param int $mode <p>The value to assign to the attribute.</p>
	 * @return bool
	 */
	public function attr_set ($attr, $mode) {}

	/**
	 * (PHP 5)<br/>
	 * Binds variables to a prepared statement as parameters
	 * @link http://php.net/manual/en/mysqli-stmt.bind-param.php
	 * @param string $types <p>
	 * A string that contains one or more characters which specify the types
	 * for the corresponding bind variables:
	 * <table>
	 * Type specification chars
	 * <tr valign="top">
	 * <td>Character</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>i</td>
	 * <td>corresponding variable has type integer</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>d</td>
	 * <td>corresponding variable has type double</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>s</td>
	 * <td>corresponding variable has type string</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>b</td>
	 * <td>corresponding variable is a blob and will be sent in packets</td>
	 * </tr>
	 * </table>
	 * </p>
	 * @param mixed $var1 <p>
	 * The number of variables and length of string
	 * <i>types</i> must match the parameters in the statement.
	 * </p>
	 * @param mixed $_ [optional]
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function bind_param ($types, &$var1, &$_ = null) {}

	/**
	 * (PHP 5)<br/>
	 * Binds variables to a prepared statement for result storage
	 * @link http://php.net/manual/en/mysqli-stmt.bind-result.php
	 * @param mixed $var1 <p>
	 * The variable to be bound.
	 * </p>
	 * @param mixed $_ [optional]
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function bind_result (&$var1, &$_ = null) {}

	/**
	 * (PHP 5)<br/>
	 * Closes a prepared statement
	 * @link http://php.net/manual/en/mysqli-stmt.close.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function close () {}

	/**
	 * (PHP 5)<br/>
	 * Seeks to an arbitrary row in statement result set
	 * @link http://php.net/manual/en/mysqli-stmt.data-seek.php
	 * @param int $offset <p>
	 * Must be between zero and the total number of rows minus one (0..
	 * <b>mysqli_stmt_num_rows</b> - 1).
	 * </p>
	 * @return void No value is returned.
	 */
	public function data_seek ($offset) {}

	/**
	 * (PHP 5)<br/>
	 * Executes a prepared Query
	 * @link http://php.net/manual/en/mysqli-stmt.execute.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function execute () {}

	/**
	 * (PHP 5)<br/>
	 * Fetch results from a prepared statement into the bound variables
	 * @link http://php.net/manual/en/mysqli-stmt.fetch.php
	 * @return bool
	 */
	public function fetch () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Get result of SHOW WARNINGS
	 * @link http://php.net/manual/en/mysqli-stmt.get-warnings.php
	 * @param mysqli_stmt $stmt
	 * @return object
	 */
	public function get_warnings (mysqli_stmt $stmt) {}

	/**
	 * (PHP 5)<br/>
	 * Returns result set metadata from a prepared statement
	 * @link http://php.net/manual/en/mysqli-stmt.result-metadata.php
	 * @return mysqli_result a result object or <b>FALSE</b> if an error occurred.
	 */
	public function result_metadata () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Check if there are more query results from a multiple query
	 * @link http://php.net/manual/en/mysqli-stmt.more-results.php
	 * @return bool <b>TRUE</b> if more results exist, otherwise <b>FALSE</b>.
	 */
	public function more_results () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Reads the next result from a multiple query
	 * @link http://php.net/manual/en/mysqli-stmt.next-result.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function next_result () {}

	public function num_rows () {}

	/**
	 * (PHP 5)<br/>
	 * Send data in blocks
	 * @link http://php.net/manual/en/mysqli-stmt.send-long-data.php
	 * @param int $param_nr <p>
	 * Indicates which parameter to associate the data with. Parameters are
	 * numbered beginning with 0.
	 * </p>
	 * @param string $data <p>
	 * A string containing data to be sent.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function send_long_data ($param_nr, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Frees stored result memory for the given statement handle
	 * @link http://php.net/manual/en/mysqli-stmt.free-result.php
	 * @return void No value is returned.
	 */
	public function free_result () {}

	/**
	 * (PHP 5)<br/>
	 * Resets a prepared statement
	 * @link http://php.net/manual/en/mysqli-stmt.reset.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function reset () {}

	/**
	 * (PHP 5)<br/>
	 * Prepare an SQL statement for execution
	 * @link http://php.net/manual/en/mysqli-stmt.prepare.php
	 * @param string $query <p>
	 * The query, as a string. It must consist of a single SQL statement.
	 * </p>
	 * <p>
	 * You can include one or more parameter markers in the SQL statement by
	 * embedding question mark (?) characters at the
	 * appropriate positions.
	 * </p>
	 * <p>
	 * You should not add a terminating semicolon or \g
	 * to the statement.
	 * </p>
	 * <p>
	 * The markers are legal only in certain places in SQL statements.
	 * For example, they are allowed in the VALUES() list of an INSERT statement
	 * (to specify column values for a row), or in a comparison with a column in
	 * a WHERE clause to specify a comparison value.
	 * </p>
	 * <p>
	 * However, they are not allowed for identifiers (such as table or column names),
	 * in the select list that names the columns to be returned by a SELECT statement),
	 * or to specify both operands of a binary operator such as the =
	 * equal sign. The latter restriction is necessary because it would be impossible
	 * to determine the parameter type. In general, parameters are legal only in Data
	 * Manipulation Language (DML) statements, and not in Data Definition Language
	 * (DDL) statements.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function prepare ($query) {}

	/**
	 * (PHP 5)<br/>
	 * Transfers a result set from a prepared statement
	 * @link http://php.net/manual/en/mysqli-stmt.store-result.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function store_result () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Gets a result set from a prepared statement
	 * @link http://php.net/manual/en/mysqli-stmt.get-result.php
	 * @return mysqli_result a resultset or <b>FALSE</b> on failure.
	 */
	public function get_result () {}

}

/**
 * (PHP 5)<br/>
 * Gets the number of affected rows in a previous MySQL operation
 * @link http://php.net/manual/en/mysqli.affected-rows.php
 * @param mysqli $link
 * @return int An integer greater than zero indicates the number of rows affected or
 * retrieved.
 * Zero indicates that no records were updated for an UPDATE statement, no
 * rows matched the WHERE clause in the query or that no
 * query has yet been executed. -1 indicates that the query returned an
 * error.
 * </p>
 * <p>
 * If the number of affected rows is greater than the maximum integer value(<b> PHP_INT_MAX </b>), the
 * number of affected rows will be returned as a string.
 */
function mysqli_affected_rows (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Turns on or off auto-committing database modifications
 * @link http://php.net/manual/en/mysqli.autocommit.php
 * @param mysqli $link
 * @param bool $mode <p>
 * Whether to turn on auto-commit or not.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_autocommit (mysqli $link, $mode) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Starts a transaction
 * @link http://php.net/manual/en/mysqli.begin-transaction.php
 * @param int $flags [optional] <p>
 * </p>
 * @param string $name [optional] <p>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_begin_transaction ($flags = null, $name = null) {}

/**
 * (PHP 5)<br/>
 * Changes the user of the specified database connection
 * @link http://php.net/manual/en/mysqli.change-user.php
 * @param mysqli $link
 * @param string $user <p>
 * The MySQL user name.
 * </p>
 * @param string $password <p>
 * The MySQL password.
 * </p>
 * @param string $database <p>
 * The database to change to.
 * </p>
 * <p>
 * If desired, the <b>NULL</b> value may be passed resulting in only changing
 * the user and not selecting a database. To select a database in this
 * case use the <b>mysqli_select_db</b> function.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_change_user (mysqli $link, $user, $password, $database) {}

/**
 * (PHP 5)<br/>
 * Returns the default character set for the database connection
 * @link http://php.net/manual/en/mysqli.character-set-name.php
 * @param mysqli $link
 * @return string The default character set for the current connection
 */
function mysqli_character_set_name (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Closes a previously opened database connection
 * @link http://php.net/manual/en/mysqli.close.php
 * @param mysqli $link
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_close (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Commits the current transaction
 * @link http://php.net/manual/en/mysqli.commit.php
 * @param mysqli $link
 * @param int $flags [optional] <p>
 * A bitmask of <b>MYSQLI_TRANS_COR_*</b> constants.
 * </p>
 * @param string $name [optional] <p>
 * If provided then COMMIT/*name* / is executed.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_commit (mysqli $link, $flags = null, $name = null) {}

/**
 * (PHP 5)<br/>
 * Alias of <b>mysqli::__construct</b>
 * @link http://php.net/manual/en/function.mysqli-connect.php
 * @param $host [optional]
 * @param $user [optional]
 * @param $password [optional]
 * @param $database [optional]
 * @param $port [optional]
 * @param $socket [optional]
 */
function mysqli_connect ($host, $user, $password, $database, $port, $socket) {}

/**
 * (PHP 5)<br/>
 * Returns the error code from last connect call
 * @link http://php.net/manual/en/mysqli.connect-errno.php
 * @return int An error code value for the last call to <b>mysqli_connect</b>, if it failed.
 * zero means no error occurred.
 */
function mysqli_connect_errno () {}

/**
 * (PHP 5)<br/>
 * Returns a string description of the last connect error
 * @link http://php.net/manual/en/mysqli.connect-error.php
 * @return string A string that describes the error. <b>NULL</b> is returned if no error occurred.
 */
function mysqli_connect_error () {}

/**
 * (PHP 5)<br/>
 * Adjusts the result pointer to an arbitrary row in the result
 * @link http://php.net/manual/en/mysqli-result.data-seek.php
 * @param mysqli_result $result
 * @param int $offset <p>
 * The field offset. Must be between zero and the total number of rows
 * minus one (0..<b>mysqli_num_rows</b> - 1).
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_data_seek (mysqli_result $result, $offset) {}

/**
 * (PHP 5)<br/>
 * Dump debugging information into the log
 * @link http://php.net/manual/en/mysqli.dump-debug-info.php
 * @param mysqli $link
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_dump_debug_info (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Performs debugging operations
 * @link http://php.net/manual/en/mysqli.debug.php
 * @param string $message <p>
 * A string representing the debugging operation to perform
 * </p>
 * @return bool <b>TRUE</b>.
 */
function mysqli_debug ($message) {}

/**
 * (PHP 5)<br/>
 * Returns the error code for the most recent function call
 * @link http://php.net/manual/en/mysqli.errno.php
 * @param mysqli $link
 * @return int An error code value for the last call, if it failed. zero means no error
 * occurred.
 */
function mysqli_errno (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns a string description of the last error
 * @link http://php.net/manual/en/mysqli.error.php
 * @param mysqli $link
 * @return string A string that describes the error. An empty string if no error occurred.
 */
function mysqli_error (mysqli $link) {}

/**
 * (PHP 5 &gt;= 5.4.0)<br/>
 * Returns a list of errors from the last command executed
 * @link http://php.net/manual/en/mysqli.error-list.php
 * @param mysqli $link
 * @return array A list of errors, each as an associative array
 * containing the errno, error, and sqlstate.
 */
function mysqli_error_list (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Executes a prepared Query
 * @link http://php.net/manual/en/mysqli-stmt.execute.php
 * @param mysqli_stmt $stmt
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_execute (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Alias for <b>mysqli_stmt_execute</b>
 * @link http://php.net/manual/en/function.mysqli-execute.php
 * @param $stmt
 */
function mysqli_execute ($stmt) {}

/**
 * (PHP 5)<br/>
 * Returns the next field in the result set
 * @link http://php.net/manual/en/mysqli-result.fetch-field.php
 * @param mysqli_result $result
 * @return object an object which contains field definition information or <b>FALSE</b>
 * if no field information is available.
 * </p>
 * <p>
 * <table>
 * Object properties
 * <tr valign="top">
 * <td>Property</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>name</td>
 * <td>The name of the column</td>
 * </tr>
 * <tr valign="top">
 * <td>orgname</td>
 * <td>Original column name if an alias was specified</td>
 * </tr>
 * <tr valign="top">
 * <td>table</td>
 * <td>The name of the table this field belongs to (if not calculated)</td>
 * </tr>
 * <tr valign="top">
 * <td>orgtable</td>
 * <td>Original table name if an alias was specified</td>
 * </tr>
 * <tr valign="top">
 * <td>def</td>
 * <td>Reserved for default value, currently always ""</td>
 * </tr>
 * <tr valign="top">
 * <td>db</td>
 * <td>Database (since PHP 5.3.6)</td>
 * </tr>
 * <tr valign="top">
 * <td>catalog</td>
 * <td>The catalog name, always "def" (since PHP 5.3.6)</td>
 * </tr>
 * <tr valign="top">
 * <td>max_length</td>
 * <td>The maximum width of the field for the result set.</td>
 * </tr>
 * <tr valign="top">
 * <td>length</td>
 * <td>The width of the field, as specified in the table definition.</td>
 * </tr>
 * <tr valign="top">
 * <td>charsetnr</td>
 * <td>The character set number for the field.</td>
 * </tr>
 * <tr valign="top">
 * <td>flags</td>
 * <td>An integer representing the bit-flags for the field.</td>
 * </tr>
 * <tr valign="top">
 * <td>type</td>
 * <td>The data type used for this field</td>
 * </tr>
 * <tr valign="top">
 * <td>decimals</td>
 * <td>The number of decimals used (for integer fields)</td>
 * </tr>
 * </table>
 */
function mysqli_fetch_field (mysqli_result $result) {}

/**
 * (PHP 5)<br/>
 * Returns an array of objects representing the fields in a result set
 * @link http://php.net/manual/en/mysqli-result.fetch-fields.php
 * @param mysqli_result $result
 * @return array an array of objects which contains field definition information or
 * <b>FALSE</b> if no field information is available.
 * </p>
 * <p>
 * <table>
 * Object properties
 * <tr valign="top">
 * <td>Property</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>name</td>
 * <td>The name of the column</td>
 * </tr>
 * <tr valign="top">
 * <td>orgname</td>
 * <td>Original column name if an alias was specified</td>
 * </tr>
 * <tr valign="top">
 * <td>table</td>
 * <td>The name of the table this field belongs to (if not calculated)</td>
 * </tr>
 * <tr valign="top">
 * <td>orgtable</td>
 * <td>Original table name if an alias was specified</td>
 * </tr>
 * <tr valign="top">
 * <td>max_length</td>
 * <td>The maximum width of the field for the result set.</td>
 * </tr>
 * <tr valign="top">
 * <td>length</td>
 * <td>The width of the field, as specified in the table definition.</td>
 * </tr>
 * <tr valign="top">
 * <td>charsetnr</td>
 * <td>The character set number for the field.</td>
 * </tr>
 * <tr valign="top">
 * <td>flags</td>
 * <td>An integer representing the bit-flags for the field.</td>
 * </tr>
 * <tr valign="top">
 * <td>type</td>
 * <td>The data type used for this field</td>
 * </tr>
 * <tr valign="top">
 * <td>decimals</td>
 * <td>The number of decimals used (for integer fields)</td>
 * </tr>
 * </table>
 */
function mysqli_fetch_fields (mysqli_result $result) {}

/**
 * (PHP 5)<br/>
 * Fetch meta-data for a single field
 * @link http://php.net/manual/en/mysqli-result.fetch-field-direct.php
 * @param mysqli_result $result
 * @param int $fieldnr <p>
 * The field number. This value must be in the range from
 * 0 to number of fields - 1.
 * </p>
 * @return object an object which contains field definition information or <b>FALSE</b>
 * if no field information for specified fieldnr is
 * available.
 * </p>
 * <p>
 * <table>
 * Object attributes
 * <tr valign="top">
 * <td>Attribute</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>name</td>
 * <td>The name of the column</td>
 * </tr>
 * <tr valign="top">
 * <td>orgname</td>
 * <td>Original column name if an alias was specified</td>
 * </tr>
 * <tr valign="top">
 * <td>table</td>
 * <td>The name of the table this field belongs to (if not calculated)</td>
 * </tr>
 * <tr valign="top">
 * <td>orgtable</td>
 * <td>Original table name if an alias was specified</td>
 * </tr>
 * <tr valign="top">
 * <td>def</td>
 * <td>The default value for this field, represented as a string</td>
 * </tr>
 * <tr valign="top">
 * <td>max_length</td>
 * <td>The maximum width of the field for the result set.</td>
 * </tr>
 * <tr valign="top">
 * <td>length</td>
 * <td>The width of the field, as specified in the table definition.</td>
 * </tr>
 * <tr valign="top">
 * <td>charsetnr</td>
 * <td>The character set number for the field.</td>
 * </tr>
 * <tr valign="top">
 * <td>flags</td>
 * <td>An integer representing the bit-flags for the field.</td>
 * </tr>
 * <tr valign="top">
 * <td>type</td>
 * <td>The data type used for this field</td>
 * </tr>
 * <tr valign="top">
 * <td>decimals</td>
 * <td>The number of decimals used (for numeric fields)</td>
 * </tr>
 * </table>
 */
function mysqli_fetch_field_direct (mysqli_result $result, $fieldnr) {}

/**
 * (PHP 5)<br/>
 * Returns the lengths of the columns of the current row in the result set
 * @link http://php.net/manual/en/mysqli-result.lengths.php
 * @param mysqli_result $result
 * @return array An array of integers representing the size of each column (not including
 * any terminating null characters). <b>FALSE</b> if an error occurred.
 * </p>
 * <p>
 * <b>mysqli_fetch_lengths</b> is valid only for the current
 * row of the result set. It returns <b>FALSE</b> if you call it before calling
 * mysqli_fetch_row/array/object or after retrieving all rows in the result.
 */
function mysqli_fetch_lengths (mysqli_result $result) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Fetches all result rows as an associative array, a numeric array, or both
 * @link http://php.net/manual/en/mysqli-result.fetch-all.php
 * @param mysqli_result $result
 * @param int $resulttype [optional] <p>
 * This optional parameter is a constant indicating what type of array
 * should be produced from the current row data. The possible values for
 * this parameter are the constants <b>MYSQLI_ASSOC</b>,
 * <b>MYSQLI_NUM</b>, or <b>MYSQLI_BOTH</b>.
 * </p>
 * @return mixed an array of associative or numeric arrays holding result rows.
 */
function mysqli_fetch_all (mysqli_result $result, $resulttype = 'MYSQLI_NUM') {}

/**
 * (PHP 5)<br/>
 * Fetch a result row as an associative, a numeric array, or both
 * @link http://php.net/manual/en/mysqli-result.fetch-array.php
 * @param mysqli_result $result
 * @param int $resulttype [optional] <p>
 * This optional parameter is a constant indicating what type of array
 * should be produced from the current row data. The possible values for
 * this parameter are the constants <b>MYSQLI_ASSOC</b>,
 * <b>MYSQLI_NUM</b>, or <b>MYSQLI_BOTH</b>.
 * </p>
 * <p>
 * By using the <b>MYSQLI_ASSOC</b> constant this function
 * will behave identically to the <b>mysqli_fetch_assoc</b>,
 * while <b>MYSQLI_NUM</b> will behave identically to the
 * <b>mysqli_fetch_row</b> function. The final option
 * <b>MYSQLI_BOTH</b> will create a single array with the
 * attributes of both.
 * </p>
 * @return mixed an array of strings that corresponds to the fetched row or <b>NULL</b> if there
 * are no more rows in resultset.
 */
function mysqli_fetch_array (mysqli_result $result, $resulttype = 'MYSQLI_BOTH') {}

/**
 * (PHP 5)<br/>
 * Fetch a result row as an associative array
 * @link http://php.net/manual/en/mysqli-result.fetch-assoc.php
 * @param mysqli_result $result
 * @return array an associative array of strings representing the fetched row in the result
 * set, where each key in the array represents the name of one of the result
 * set's columns or <b>NULL</b> if there are no more rows in resultset.
 * </p>
 * <p>
 * If two or more columns of the result have the same field names, the last
 * column will take precedence. To access the other column(s) of the same
 * name, you either need to access the result with numeric indices by using
 * <b>mysqli_fetch_row</b> or add alias names.
 */
function mysqli_fetch_assoc (mysqli_result $result) {}

/**
 * (PHP 5)<br/>
 * Returns the current row of a result set as an object
 * @link http://php.net/manual/en/mysqli-result.fetch-object.php
 * @param mysqli_result $result
 * @param string $class_name [optional] <p>
 * The name of the class to instantiate, set the properties of and return.
 * If not specified, a <b>stdClass</b> object is returned.
 * </p>
 * @param array $params [optional] <p>
 * An optional array of parameters to pass to the constructor
 * for <i>class_name</i> objects.
 * </p>
 * @return object an object with string properties that corresponds to the fetched
 * row or <b>NULL</b> if there are no more rows in resultset.
 */
function mysqli_fetch_object (mysqli_result $result, $class_name = "stdClass", array $params = null) {}

/**
 * (PHP 5)<br/>
 * Get a result row as an enumerated array
 * @link http://php.net/manual/en/mysqli-result.fetch-row.php
 * @param mysqli_result $result
 * @return mixed <b>mysqli_fetch_row</b> returns an array of strings that corresponds to the fetched row
 * or <b>NULL</b> if there are no more rows in result set.
 */
function mysqli_fetch_row (mysqli_result $result) {}

/**
 * (PHP 5)<br/>
 * Returns the number of columns for the most recent query
 * @link http://php.net/manual/en/mysqli.field-count.php
 * @param mysqli $link
 * @return int An integer representing the number of fields in a result set.
 */
function mysqli_field_count (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Set result pointer to a specified field offset
 * @link http://php.net/manual/en/mysqli-result.field-seek.php
 * @param mysqli_result $result
 * @param int $fieldnr <p>
 * The field number. This value must be in the range from
 * 0 to number of fields - 1.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_field_seek (mysqli_result $result, $fieldnr) {}

/**
 * (PHP 5)<br/>
 * Get current field offset of a result pointer
 * @link http://php.net/manual/en/mysqli-result.current-field.php
 * @param mysqli_result $result
 * @return int current offset of field cursor.
 */
function mysqli_field_tell (mysqli_result $result) {}

/**
 * (PHP 5)<br/>
 * Frees the memory associated with a result
 * @link http://php.net/manual/en/mysqli-result.free.php
 * @param $result
 * @return void No value is returned.
 */
function mysqli_free_result ($result) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Returns statistics about the client connection
 * @link http://php.net/manual/en/mysqli.get-connection-stats.php
 * @param mysqli $link
 * @return array an array with connection stats if success, <b>FALSE</b> otherwise.
 */
function mysqli_get_connection_stats (mysqli $link) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Returns client per-process statistics
 * @link http://php.net/manual/en/mysqli.get-client-stats.php
 * @return array an array with client stats if success, <b>FALSE</b> otherwise.
 */
function mysqli_get_client_stats () {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Returns a character set object
 * @link http://php.net/manual/en/mysqli.get-charset.php
 * @param mysqli $link
 * @return object The function returns a character set object with the following properties:
 * <i>charset</i>
 * <p>Character set name</p>
 * <i>collation</i>
 * <p>Collation name</p>
 * <i>dir</i>
 * <p>Directory the charset description was fetched from (?) or "" for built-in character sets</p>
 * <i>min_length</i>
 * <p>Minimum character length in bytes</p>
 * <i>max_length</i>
 * <p>Maximum character length in bytes</p>
 * <i>number</i>
 * <p>Internal character set number</p>
 * <i>state</i>
 * <p>Character set status (?)</p>
 */
function mysqli_get_charset (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Get MySQL client info
 * @link http://php.net/manual/en/mysqli.client-info.php
 * @param mysqli $link
 * @return string A string that represents the MySQL client library version
 */
function mysqli_get_client_info (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns the MySQL client version as a string
 * @link http://php.net/manual/en/mysqli.client-version.php
 * @param mysqli $link
 * @return int A number that represents the MySQL client library version in format:
 * main_version*10000 + minor_version *100 + sub_version.
 * For example, 4.1.0 is returned as 40100.
 * </p>
 * <p>
 * This is useful to quickly determine the version of the client library
 * to know if some capability exists.
 */
function mysqli_get_client_version (mysqli $link) {}

/**
 * (PHP 5 &gt;= 5.6.0)<br/>
 * Return information about open and cached links
 * @link http://php.net/manual/en/function.mysqli-get-links-stats.php
 * @return array <b>mysqli_get_links_stats</b> returns an associative array
 * with three elements, keyed as follows:
 * <i>total</i>
 * <p>
 * An integer indicating the total number of open links in
 * any state.
 * </p>
 * <i>active_plinks</i>
 * <p>
 * An integer representing the number of active persistent
 * connections.
 * </p>
 * <i>cached_plinks</i>
 * <p>
 * An integer representing the number of inactive persistent
 * connections.
 * </p>
 */
function mysqli_get_links_stats () {}

/**
 * (PHP 5)<br/>
 * Returns a string representing the type of connection used
 * @link http://php.net/manual/en/mysqli.get-host-info.php
 * @param mysqli $link
 * @return string A character string representing the server hostname and the connection type.
 */
function mysqli_get_host_info (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns the version of the MySQL protocol used
 * @link http://php.net/manual/en/mysqli.get-proto-info.php
 * @param mysqli $link
 * @return int an integer representing the protocol version.
 */
function mysqli_get_proto_info (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns the version of the MySQL server
 * @link http://php.net/manual/en/mysqli.get-server-info.php
 * @param mysqli $link
 * @return string A character string representing the server version.
 */
function mysqli_get_server_info (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns the version of the MySQL server as an integer
 * @link http://php.net/manual/en/mysqli.get-server-version.php
 * @param mysqli $link
 * @return int An integer representing the server version.
 * </p>
 * <p>
 * The form of this version number is
 * main_version * 10000 + minor_version * 100 + sub_version
 * (i.e. version 4.1.0 is 40100).
 */
function mysqli_get_server_version (mysqli $link) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Get result of SHOW WARNINGS
 * @link http://php.net/manual/en/mysqli.get-warnings.php
 * @param mysqli $link
 * @return mysqli_warning
 */
function mysqli_get_warnings (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Initializes MySQLi and returns a resource for use with mysqli_real_connect()
 * @link http://php.net/manual/en/mysqli.init.php
 * @return mysqli an object.
 */
function mysqli_init () {}

/**
 * (PHP 5)<br/>
 * Retrieves information about the most recently executed query
 * @link http://php.net/manual/en/mysqli.info.php
 * @param mysqli $link
 * @return string A character string representing additional information about the most recently executed query.
 */
function mysqli_info (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns the auto generated id used in the last query
 * @link http://php.net/manual/en/mysqli.insert-id.php
 * @param mysqli $link
 * @return mixed The value of the AUTO_INCREMENT field that was updated
 * by the previous query. Returns zero if there was no previous query on the
 * connection or if the query did not update an AUTO_INCREMENT
 * value.
 * </p>
 * <p>
 * If the number is greater than maximal int value, <b>mysqli_insert_id</b>
 * will return a string.
 */
function mysqli_insert_id (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Asks the server to kill a MySQL thread
 * @link http://php.net/manual/en/mysqli.kill.php
 * @param mysqli $link
 * @param int $processid
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_kill (mysqli $link, $processid) {}

/**
 * (PHP 5)<br/>
 * Check if there are any more query results from a multi query
 * @link http://php.net/manual/en/mysqli.more-results.php
 * @param mysqli $link
 * @return bool <b>TRUE</b> if one or more result sets are available from a previous call to
 * <b>mysqli_multi_query</b>, otherwise <b>FALSE</b>.
 */
function mysqli_more_results (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Performs a query on the database
 * @link http://php.net/manual/en/mysqli.multi-query.php
 * @param mysqli $link
 * @param string $query <p>
 * The query, as a string.
 * </p>
 * <p>
 * Data inside the query should be properly escaped.
 * </p>
 * @return bool <b>FALSE</b> if the first statement failed.
 * To retrieve subsequent errors from other statements you have to call
 * <b>mysqli_next_result</b> first.
 */
function mysqli_multi_query (mysqli $link, $query) {}

/**
 * (PHP 5)<br/>
 * Prepare next result from multi_query
 * @link http://php.net/manual/en/mysqli.next-result.php
 * @param mysqli $link
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_next_result (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Get the number of fields in a result
 * @link http://php.net/manual/en/mysqli-result.field-count.php
 * @param mysqli_result $result
 * @return int The number of fields from a result set.
 */
function mysqli_num_fields (mysqli_result $result) {}

/**
 * (PHP 5)<br/>
 * Gets the number of rows in a result
 * @link http://php.net/manual/en/mysqli-result.num-rows.php
 * @param mysqli_result $result
 * @return int number of rows in the result set.
 * </p>
 * <p>
 * If the number of rows is greater than <b>PHP_INT_MAX</b>, the number
 * will be returned as a string.
 */
function mysqli_num_rows (mysqli_result $result) {}

/**
 * (PHP 5)<br/>
 * Set options
 * @link http://php.net/manual/en/mysqli.options.php
 * @param mysqli $link
 * @param int $option <p>
 * The option that you want to set. It can be one of the following values:
 * <table>
 * Valid options
 * <tr valign="top">
 * <td>Name</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_OPT_CONNECT_TIMEOUT</b></td>
 * <td>connection timeout in seconds (supported on Windows with TCP/IP since PHP 5.3.1)</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_OPT_LOCAL_INFILE</b></td>
 * <td>enable/disable use of LOAD LOCAL INFILE</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_INIT_COMMAND</b></td>
 * <td>command to execute after when connecting to MySQL server</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_READ_DEFAULT_FILE</b></td>
 * <td>
 * Read options from named option file instead of my.cnf
 * </td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_READ_DEFAULT_GROUP</b></td>
 * <td>
 * Read options from the named group from my.cnf
 * or the file specified with <b>MYSQL_READ_DEFAULT_FILE</b>.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_SERVER_PUBLIC_KEY</b></td>
 * <td>
 * RSA public key file used with the SHA-256 based authentication.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param mixed $value <p>
 * The value for the option.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_options (mysqli $link, $option, $value) {}

/**
 * (PHP 5)<br/>
 * Pings a server connection, or tries to reconnect if the connection has gone down
 * @link http://php.net/manual/en/mysqli.ping.php
 * @param mysqli $link
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_ping (mysqli $link) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Poll connections
 * @link http://php.net/manual/en/mysqli.poll.php
 * @param array $read <p>
 * List of connections to check for outstanding results that can be read.
 * </p>
 * @param array $error <p>
 * List of connections on which an error occured, for example, query
 * failure or lost connection.
 * </p>
 * @param array $reject <p>
 * List of connections rejected because no asynchronous query
 * has been run on for which the function could poll results.
 * </p>
 * @param int $sec <p>
 * Number of seconds to wait, must be non-negative.
 * </p>
 * @param int $usec [optional] <p>
 * Number of microseconds to wait, must be non-negative.
 * </p>
 * @return int number of ready connections upon success, <b>FALSE</b> otherwise.
 */
function mysqli_poll (array &$read, array &$error, array &$reject, $sec, $usec = null) {}

/**
 * (PHP 5)<br/>
 * Prepare an SQL statement for execution
 * @link http://php.net/manual/en/mysqli.prepare.php
 * @param mysqli $link
 * @param string $query <p>
 * The query, as a string.
 * </p>
 * <p>
 * You should not add a terminating semicolon or \g
 * to the statement.
 * </p>
 * <p>
 * This parameter can include one or more parameter markers in the SQL
 * statement by embedding question mark (?) characters
 * at the appropriate positions.
 * </p>
 * <p>
 * The markers are legal only in certain places in SQL statements.
 * For example, they are allowed in the VALUES()
 * list of an INSERT statement (to specify column
 * values for a row), or in a comparison with a column in a
 * WHERE clause to specify a comparison value.
 * </p>
 * <p>
 * However, they are not allowed for identifiers (such as table or
 * column names), in the select list that names the columns to be
 * returned by a SELECT statement, or to specify both
 * operands of a binary operator such as the = equal
 * sign. The latter restriction is necessary because it would be
 * impossible to determine the parameter type. It's not allowed to
 * compare marker with NULL by
 * ? IS NULL too. In general, parameters are legal
 * only in Data Manipulation Language (DML) statements, and not in Data
 * Definition Language (DDL) statements.
 * </p>
 * @return mysqli_stmt <b>mysqli_prepare</b> returns a statement object or <b>FALSE</b> if an error occurred.
 */
function mysqli_prepare (mysqli $link, $query) {}

/**
 * (PHP 5)<br/>
 * Alias of mysqli_driver->report_mode
 * @link http://php.net/manual/en/function.mysqli-report.php
 * @param $flags
 */
function mysqli_report ($flags) {}

/**
 * (PHP 5)<br/>
 * Performs a query on the database
 * @link http://php.net/manual/en/mysqli.query.php
 * @param mysqli $link
 * @param string $query <p>
 * The query string.
 * </p>
 * <p>
 * Data inside the query should be properly escaped.
 * </p>
 * @param int $resultmode [optional] <p>
 * Either the constant <b>MYSQLI_USE_RESULT</b> or
 * <b>MYSQLI_STORE_RESULT</b> depending on the desired
 * behavior. By default, <b>MYSQLI_STORE_RESULT</b> is used.
 * </p>
 * <p>
 * If you use <b>MYSQLI_USE_RESULT</b> all subsequent calls
 * will return error Commands out of sync unless you
 * call <b>mysqli_free_result</b>
 * </p>
 * <p>
 * With <b>MYSQLI_ASYNC</b> (available with mysqlnd), it is
 * possible to perform query asynchronously.
 * <b>mysqli_poll</b> is then used to get results from such
 * queries.
 * </p>
 * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
 * EXPLAIN queries <b>mysqli_query</b> will return
 * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
 * return <b>TRUE</b>.
 */
function mysqli_query (mysqli $link, $query, $resultmode = 'MYSQLI_STORE_RESULT') {}

/**
 * (PHP 5)<br/>
 * Opens a connection to a mysql server
 * @link http://php.net/manual/en/mysqli.real-connect.php
 * @param mysqli $link
 * @param string $host [optional] <p>
 * Can be either a host name or an IP address. Passing the <b>NULL</b> value
 * or the string "localhost" to this parameter, the local host is
 * assumed. When possible, pipes will be used instead of the TCP/IP
 * protocol.
 * </p>
 * @param string $username [optional] <p>
 * The MySQL user name.
 * </p>
 * @param string $passwd [optional] <p>
 * If provided or <b>NULL</b>, the MySQL server will attempt to authenticate
 * the user against those user records which have no password only. This
 * allows one username to be used with different permissions (depending
 * on if a password as provided or not).
 * </p>
 * @param string $dbname [optional] <p>
 * If provided will specify the default database to be used when
 * performing queries.
 * </p>
 * @param int $port [optional] <p>
 * Specifies the port number to attempt to connect to the MySQL server.
 * </p>
 * @param string $socket [optional] <p>
 * Specifies the socket or named pipe that should be used.
 * </p>
 * <p>
 * Specifying the <i>socket</i> parameter will not
 * explicitly determine the type of connection to be used when
 * connecting to the MySQL server. How the connection is made to the
 * MySQL database is determined by the <i>host</i>
 * parameter.
 * </p>
 * @param int $flags [optional] <p>
 * With the parameter <i>flags</i> you can set different
 * connection options:
 * </p>
 * <table>
 * Supported flags
 * <tr valign="top">
 * <td>Name</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_CLIENT_COMPRESS</b></td>
 * <td>Use compression protocol</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_CLIENT_FOUND_ROWS</b></td>
 * <td>return number of matched rows, not the number of affected rows</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_CLIENT_IGNORE_SPACE</b></td>
 * <td>Allow spaces after function names. Makes all function names reserved words.</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_CLIENT_INTERACTIVE</b></td>
 * <td>
 * Allow interactive_timeout seconds (instead of
 * wait_timeout seconds) of inactivity before closing the connection
 * </td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_CLIENT_SSL</b></td>
 * <td>Use SSL (encryption)</td>
 * </tr>
 * </table>
 * <p>
 * For security reasons the <b>MULTI_STATEMENT</b> flag is
 * not supported in PHP. If you want to execute multiple queries use the
 * <b>mysqli_multi_query</b> function.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_real_connect (mysqli $link, $host = null, $username = null, $passwd = null, $dbname = null, $port = null, $socket = null, $flags = null) {}

/**
 * (PHP 5)<br/>
 * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
 * @link http://php.net/manual/en/mysqli.real-escape-string.php
 * @param string $escapestr <p>
 * The string to be escaped.
 * </p>
 * <p>
 * Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and
 * Control-Z.
 * </p>
 * @return string an escaped string.
 */
function mysqli_real_escape_string ($escapestr) {}

/**
 * (PHP 5)<br/>
 * Execute an SQL query
 * @link http://php.net/manual/en/mysqli.real-query.php
 * @param mysqli $link
 * @param string $query <p>
 * The query, as a string.
 * </p>
 * <p>
 * Data inside the query should be properly escaped.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_real_query (mysqli $link, $query) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Get result from async query
 * @link http://php.net/manual/en/mysqli.reap-async-query.php
 * @param mysqli $link
 * @return mysqli_result <b>mysqli_result</b> in success, <b>FALSE</b> otherwise.
 */
function mysqli_reap_async_query (mysqli $link) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Removes the named savepoint from the set of savepoints of the current transaction
 * @link http://php.net/manual/en/mysqli.release-savepoint.php
 * @param string $name <p>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_release_savepoint ($name) {}

/**
 * (PHP 5)<br/>
 * Rolls back current transaction
 * @link http://php.net/manual/en/mysqli.rollback.php
 * @param mysqli $link
 * @param int $flags [optional] <p>
 * A bitmask of <b>MYSQLI_TRANS_COR_*</b> constants.
 * </p>
 * @param string $name [optional] <p>
 * If provided then ROLLBACK/*name* / is executed.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_rollback (mysqli $link, $flags = null, $name = null) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Set a named transaction savepoint
 * @link http://php.net/manual/en/mysqli.savepoint.php
 * @param string $name <p>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_savepoint ($name) {}

/**
 * (PHP 5)<br/>
 * Selects the default database for database queries
 * @link http://php.net/manual/en/mysqli.select-db.php
 * @param mysqli $link
 * @param string $dbname <p>
 * The database name.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_select_db (mysqli $link, $dbname) {}

/**
 * (PHP 5 &gt;= 5.0.5)<br/>
 * Sets the default client character set
 * @link http://php.net/manual/en/mysqli.set-charset.php
 * @param mysqli $link
 * @param string $charset <p>
 * The charset to be set as default.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_set_charset (mysqli $link, $charset) {}

/**
 * (PHP 5)<br/>
 * Returns the total number of rows changed, deleted, or
inserted by the last executed statement
 * @link http://php.net/manual/en/mysqli-stmt.affected-rows.php
 * @param mysqli_stmt $stmt
 * @return int An integer greater than zero indicates the number of rows affected or
 * retrieved.
 * Zero indicates that no records where updated for an UPDATE/DELETE
 * statement, no rows matched the WHERE clause in the query or that no query
 * has yet been executed. -1 indicates that the query has returned an error.
 * NULL indicates an invalid argument was supplied to the function.
 * </p>
 * <p>
 * If the number of affected rows is greater than maximal PHP int value, the
 * number of affected rows will be returned as a string value.
 */
function mysqli_stmt_affected_rows (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Used to get the current value of a statement attribute
 * @link http://php.net/manual/en/mysqli-stmt.attr-get.php
 * @param mysqli_stmt $stmt
 * @param int $attr <p>
 * The attribute that you want to get.
 * </p>
 * @return int <b>FALSE</b> if the attribute is not found, otherwise returns the value of the attribute.
 */
function mysqli_stmt_attr_get (mysqli_stmt $stmt, $attr) {}

/**
 * (PHP 5)<br/>
 * Used to modify the behavior of a prepared statement
 * @link http://php.net/manual/en/mysqli-stmt.attr-set.php
 * @param mysqli_stmt $stmt
 * @param int $attr <p>
 * The attribute that you want to set. It can have one of the following values:
 * <table>
 * Attribute values
 * <tr valign="top">
 * <td>Character</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH</td>
 * <td>
 * Setting to <b>TRUE</b> causes <b>mysqli_stmt_store_result</b> to
 * update the metadata MYSQL_FIELD->max_length value.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>MYSQLI_STMT_ATTR_CURSOR_TYPE</td>
 * <td>
 * Type of cursor to open for statement when <b>mysqli_stmt_execute</b>
 * is invoked. <i>mode</i> can be MYSQLI_CURSOR_TYPE_NO_CURSOR
 * (the default) or MYSQLI_CURSOR_TYPE_READ_ONLY.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>MYSQLI_STMT_ATTR_PREFETCH_ROWS</td>
 * <td>
 * Number of rows to fetch from server at a time when using a cursor.
 * <i>mode</i> can be in the range from 1 to the maximum
 * value of unsigned long. The default is 1.
 * </td>
 * </tr>
 * </table>
 * </p>
 * <p>
 * If you use the MYSQLI_STMT_ATTR_CURSOR_TYPE option with
 * MYSQLI_CURSOR_TYPE_READ_ONLY, a cursor is opened for the
 * statement when you invoke <b>mysqli_stmt_execute</b>. If there
 * is already an open cursor from a previous <b>mysqli_stmt_execute</b> call,
 * it closes the cursor before opening a new one. <b>mysqli_stmt_reset</b>
 * also closes any open cursor before preparing the statement for re-execution.
 * <b>mysqli_stmt_free_result</b> closes any open cursor.
 * </p>
 * <p>
 * If you open a cursor for a prepared statement, <b>mysqli_stmt_store_result</b>
 * is unnecessary.
 * </p>
 * @param int $mode <p>The value to assign to the attribute.</p>
 * @return bool
 */
function mysqli_stmt_attr_set (mysqli_stmt $stmt, $attr, $mode) {}

/**
 * (PHP 5)<br/>
 * Binds variables to a prepared statement as parameters
 * @link http://php.net/manual/en/mysqli-stmt.bind-param.php
 * @param mysqli_stmt $stmt
 * @param string $types <p>
 * A string that contains one or more characters which specify the types
 * for the corresponding bind variables:
 * <table>
 * Type specification chars
 * <tr valign="top">
 * <td>Character</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>i</td>
 * <td>corresponding variable has type integer</td>
 * </tr>
 * <tr valign="top">
 * <td>d</td>
 * <td>corresponding variable has type double</td>
 * </tr>
 * <tr valign="top">
 * <td>s</td>
 * <td>corresponding variable has type string</td>
 * </tr>
 * <tr valign="top">
 * <td>b</td>
 * <td>corresponding variable is a blob and will be sent in packets</td>
 * </tr>
 * </table>
 * </p>
 * @param mixed $var1 <p>
 * The number of variables and length of string
 * <i>types</i> must match the parameters in the statement.
 * </p>
 * @param mixed $_ [optional]
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_bind_param (mysqli_stmt $stmt, $types, &$var1, &$_ = null) {}

/**
 * (PHP 5)<br/>
 * Binds variables to a prepared statement for result storage
 * @link http://php.net/manual/en/mysqli-stmt.bind-result.php
 * @param mysqli_stmt $stmt
 * @param mixed $var1 <p>
 * The variable to be bound.
 * </p>
 * @param mixed $_ [optional]
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_bind_result (mysqli_stmt $stmt, &$var1, &$_ = null) {}

/**
 * (PHP 5)<br/>
 * Closes a prepared statement
 * @link http://php.net/manual/en/mysqli-stmt.close.php
 * @param mysqli_stmt $stmt
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_close (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Seeks to an arbitrary row in statement result set
 * @link http://php.net/manual/en/mysqli-stmt.data-seek.php
 * @param mysqli_stmt $stmt
 * @param int $offset <p>
 * Must be between zero and the total number of rows minus one (0..
 * <b>mysqli_stmt_num_rows</b> - 1).
 * </p>
 * @return void No value is returned.
 */
function mysqli_stmt_data_seek (mysqli_stmt $stmt, $offset) {}

/**
 * (PHP 5)<br/>
 * Returns the error code for the most recent statement call
 * @link http://php.net/manual/en/mysqli-stmt.errno.php
 * @param mysqli_stmt $stmt
 * @return int An error code value. Zero means no error occurred.
 */
function mysqli_stmt_errno (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Returns a string description for last statement error
 * @link http://php.net/manual/en/mysqli-stmt.error.php
 * @param mysqli_stmt $stmt
 * @return string A string that describes the error. An empty string if no error occurred.
 */
function mysqli_stmt_error (mysqli_stmt $stmt) {}

/**
 * (PHP 5 &gt;= 5.4.0)<br/>
 * Returns a list of errors from the last statement executed
 * @link http://php.net/manual/en/mysqli-stmt.error-list.php
 * @param mysqli_stmt $stmt
 * @return array A list of errors, each as an associative array
 * containing the errno, error, and sqlstate.
 */
function mysqli_stmt_error_list (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Fetch results from a prepared statement into the bound variables
 * @link http://php.net/manual/en/mysqli-stmt.fetch.php
 * @param mysqli_stmt $stmt
 * @return bool
 */
function mysqli_stmt_fetch (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Returns the number of field in the given statement
 * @link http://php.net/manual/en/mysqli-stmt.field-count.php
 * @param mysqli_stmt $stmt
 * @return int
 */
function mysqli_stmt_field_count (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Frees stored result memory for the given statement handle
 * @link http://php.net/manual/en/mysqli-stmt.free-result.php
 * @param mysqli_stmt $stmt
 * @return void No value is returned.
 */
function mysqli_stmt_free_result (mysqli_stmt $stmt) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Gets a result set from a prepared statement
 * @link http://php.net/manual/en/mysqli-stmt.get-result.php
 * @param mysqli_stmt $stmt
 * @return mysqli_result a resultset or <b>FALSE</b> on failure.
 */
function mysqli_stmt_get_result (mysqli_stmt $stmt) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Get result of SHOW WARNINGS
 * @link http://php.net/manual/en/mysqli-stmt.get-warnings.php
 * @param mysqli_stmt $stmt
 * @return object
 */
function mysqli_stmt_get_warnings (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Initializes a statement and returns an object for use with mysqli_stmt_prepare
 * @link http://php.net/manual/en/mysqli.stmt-init.php
 * @param mysqli $link
 * @return mysqli_stmt an object.
 */
function mysqli_stmt_init (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Get the ID generated from the previous INSERT operation
 * @link http://php.net/manual/en/mysqli-stmt.insert-id.php
 * @param mysqli_stmt $stmt
 * @return mixed
 */
function mysqli_stmt_insert_id (mysqli_stmt $stmt) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Check if there are more query results from a multiple query
 * @link http://php.net/manual/en/mysqli-stmt.more-results.php
 * @param $stmt
 * @return bool <b>TRUE</b> if more results exist, otherwise <b>FALSE</b>.
 */
function mysqli_stmt_more_results ($stmt) {}

/**
 * (PHP 5 &gt;= 5.3.0)<br/>
 * Reads the next result from a multiple query
 * @link http://php.net/manual/en/mysqli-stmt.next-result.php
 * @param $stmt
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_next_result ($stmt) {}

/**
 * (PHP 5)<br/>
 * Return the number of rows in statements result set
 * @link http://php.net/manual/en/mysqli-stmt.num-rows.php
 * @param mysqli_stmt $stmt
 * @return int An integer representing the number of rows in result set.
 */
function mysqli_stmt_num_rows (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Returns the number of parameter for the given statement
 * @link http://php.net/manual/en/mysqli-stmt.param-count.php
 * @param mysqli_stmt $stmt
 * @return int an integer representing the number of parameters.
 */
function mysqli_stmt_param_count (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Prepare an SQL statement for execution
 * @link http://php.net/manual/en/mysqli-stmt.prepare.php
 * @param mysqli_stmt $stmt
 * @param string $query <p>
 * The query, as a string. It must consist of a single SQL statement.
 * </p>
 * <p>
 * You can include one or more parameter markers in the SQL statement by
 * embedding question mark (?) characters at the
 * appropriate positions.
 * </p>
 * <p>
 * You should not add a terminating semicolon or \g
 * to the statement.
 * </p>
 * <p>
 * The markers are legal only in certain places in SQL statements.
 * For example, they are allowed in the VALUES() list of an INSERT statement
 * (to specify column values for a row), or in a comparison with a column in
 * a WHERE clause to specify a comparison value.
 * </p>
 * <p>
 * However, they are not allowed for identifiers (such as table or column names),
 * in the select list that names the columns to be returned by a SELECT statement),
 * or to specify both operands of a binary operator such as the =
 * equal sign. The latter restriction is necessary because it would be impossible
 * to determine the parameter type. In general, parameters are legal only in Data
 * Manipulation Language (DML) statements, and not in Data Definition Language
 * (DDL) statements.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_prepare (mysqli_stmt $stmt, $query) {}

/**
 * (PHP 5)<br/>
 * Resets a prepared statement
 * @link http://php.net/manual/en/mysqli-stmt.reset.php
 * @param mysqli_stmt $stmt
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_reset (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Returns result set metadata from a prepared statement
 * @link http://php.net/manual/en/mysqli-stmt.result-metadata.php
 * @param mysqli_stmt $stmt
 * @return mysqli_result a result object or <b>FALSE</b> if an error occurred.
 */
function mysqli_stmt_result_metadata (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Send data in blocks
 * @link http://php.net/manual/en/mysqli-stmt.send-long-data.php
 * @param mysqli_stmt $stmt
 * @param int $param_nr <p>
 * Indicates which parameter to associate the data with. Parameters are
 * numbered beginning with 0.
 * </p>
 * @param string $data <p>
 * A string containing data to be sent.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_send_long_data (mysqli_stmt $stmt, $param_nr, $data) {}

/**
 * (PHP 5)<br/>
 * Transfers a result set from a prepared statement
 * @link http://php.net/manual/en/mysqli-stmt.store-result.php
 * @param mysqli_stmt $stmt
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function mysqli_stmt_store_result (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Returns SQLSTATE error from previous statement operation
 * @link http://php.net/manual/en/mysqli-stmt.sqlstate.php
 * @param mysqli_stmt $stmt
 * @return string a string containing the SQLSTATE error code for the last error.
 * The error code consists of five characters. '00000' means no error.
 */
function mysqli_stmt_sqlstate (mysqli_stmt $stmt) {}

/**
 * (PHP 5)<br/>
 * Returns the SQLSTATE error from previous MySQL operation
 * @link http://php.net/manual/en/mysqli.sqlstate.php
 * @param mysqli $link
 * @return string a string containing the SQLSTATE error code for the last error.
 * The error code consists of five characters. '00000' means no error.
 */
function mysqli_sqlstate (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Used for establishing secure connections using SSL
 * @link http://php.net/manual/en/mysqli.ssl-set.php
 * @param mysqli $link
 * @param string $key <p>
 * The path name to the key file.
 * </p>
 * @param string $cert <p>
 * The path name to the certificate file.
 * </p>
 * @param string $ca <p>
 * The path name to the certificate authority file.
 * </p>
 * @param string $capath <p>
 * The pathname to a directory that contains trusted SSL CA certificates
 * in PEM format.
 * </p>
 * @param string $cipher <p>
 * A list of allowable ciphers to use for SSL encryption.
 * </p>
 * @return bool This function always returns <b>TRUE</b> value. If SSL setup is
 * incorrect <b>mysqli_real_connect</b> will return an error
 * when you attempt to connect.
 */
function mysqli_ssl_set (mysqli $link, $key, $cert, $ca, $capath, $cipher) {}

/**
 * (PHP 5)<br/>
 * Gets the current system status
 * @link http://php.net/manual/en/mysqli.stat.php
 * @param mysqli $link
 * @return string A string describing the server status. <b>FALSE</b> if an error occurred.
 */
function mysqli_stat (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Transfers a result set from the last query
 * @link http://php.net/manual/en/mysqli.store-result.php
 * @param int $option [optional] <p>
 * The option that you want to set. It can be one of the following values:
 * <table>
 * Valid options
 * <tr valign="top">
 * <td>Name</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td><b>MYSQLI_STORE_RESULT_COPY_DATA</b></td>
 * <td>Copy results from the internal mysqlnd buffer into the PHP variables fetched. By default,
 * mysqlnd will use a reference logic to avoid copying and duplicating results held in memory.
 * For certain result sets, for example, result sets with many small rows, the copy approach can
 * reduce the overall memory usage because PHP variables holding results may be
 * released earlier (available with mysqlnd only, since PHP 5.6.0)</td>
 * </tr>
 * </table>
 * </p>
 * @return mysqli_result a buffered result object or <b>FALSE</b> if an error occurred.
 * </p>
 * <p>
 * <b>mysqli_store_result</b> returns <b>FALSE</b> in case the query
 * didn't return a result set (if the query was, for example an INSERT
 * statement). This function also returns <b>FALSE</b> if the reading of the
 * result set failed. You can check if you have got an error by checking
 * if <b>mysqli_error</b> doesn't return an empty string, if
 * <b>mysqli_errno</b> returns a non zero value, or if
 * <b>mysqli_field_count</b> returns a non zero value.
 * Also possible reason for this function returning <b>FALSE</b> after
 * successful call to <b>mysqli_query</b> can be too large
 * result set (memory for it cannot be allocated). If
 * <b>mysqli_field_count</b> returns a non-zero value, the
 * statement should have produced a non-empty result set.
 */
function mysqli_store_result ($option = null) {}

/**
 * (PHP 5)<br/>
 * Returns the thread ID for the current connection
 * @link http://php.net/manual/en/mysqli.thread-id.php
 * @param mysqli $link
 * @return int the Thread ID for the current connection.
 */
function mysqli_thread_id (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns whether thread safety is given or not
 * @link http://php.net/manual/en/mysqli.thread-safe.php
 * @return bool <b>TRUE</b> if the client library is thread-safe, otherwise <b>FALSE</b>.
 */
function mysqli_thread_safe () {}

/**
 * (PHP 5)<br/>
 * Initiate a result set retrieval
 * @link http://php.net/manual/en/mysqli.use-result.php
 * @param mysqli $link
 * @return mysqli_result an unbuffered result object or <b>FALSE</b> if an error occurred.
 */
function mysqli_use_result (mysqli $link) {}

/**
 * (PHP 5)<br/>
 * Returns the number of warnings from the last query for the given link
 * @link http://php.net/manual/en/mysqli.warning-count.php
 * @param mysqli $link
 * @return int Number of warnings or zero if there are no warnings.
 */
function mysqli_warning_count (mysqli $link) {}

/**
 * (PHP 5 &lt;= 5.3.0)<br/>
 * Refreshes
 * @link http://php.net/manual/en/mysqli.refresh.php
 * @param resource $link
 * @param int $options <p>
 * The options to refresh, using the MYSQLI_REFRESH_* constants as documented
 * within the MySQLi constants documentation.
 * </p>
 * <p>
 * See also the official MySQL Refresh
 * documentation.
 * </p>
 * @return int <b>TRUE</b> if the refresh was a success, otherwise <b>FALSE</b>
 */
function mysqli_refresh ($link, $options) {}

/**
 * (PHP 5)<br/>
 * Alias of <b>mysqli_real_escape_string</b>
 * @link http://php.net/manual/en/function.mysqli-escape-string.php
 * @param $link
 * @param $query
 */
function mysqli_escape_string ($link, $query) {}

/**
 * (PHP 5)<br/>
 * Alias of <b>mysqli_options</b>
 * @link http://php.net/manual/en/function.mysqli-set-opt.php
 */
function mysqli_set_opt () {}


/**
 * <p>
 * Read options from the named group from my.cnf
 * or the file specified with <b>MYSQLI_READ_DEFAULT_FILE</b>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_READ_DEFAULT_GROUP', 5);

/**
 * <p>
 * Read options from the named option file instead of from my.cnf
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_READ_DEFAULT_FILE', 4);

/**
 * <p>
 * Connect timeout in seconds
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_OPT_CONNECT_TIMEOUT', 0);

/**
 * <p>
 * Enables command LOAD LOCAL INFILE
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_OPT_LOCAL_INFILE', 8);

/**
 * <p>
 * Command to execute when connecting to MySQL server. Will automatically be re-executed when reconnecting.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_INIT_COMMAND', 3);
define ('MYSQLI_OPT_NET_CMD_BUFFER_SIZE', 202);
define ('MYSQLI_OPT_NET_READ_BUFFER_SIZE', 203);
define ('MYSQLI_OPT_INT_AND_FLOAT_NATIVE', 201);
define ('MYSQLI_OPT_SSL_VERIFY_SERVER_CERT', 21);
define ('MYSQLI_SERVER_PUBLIC_KEY', 27);

/**
 * <p>
 * Use SSL (encrypted protocol). This option should not be set by application programs;
 * it is set internally in the MySQL client library
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CLIENT_SSL', 2048);

/**
 * <p>
 * Use compression protocol
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CLIENT_COMPRESS', 32);

/**
 * <p>
 * Allow interactive_timeout seconds
 * (instead of wait_timeout seconds) of inactivity before
 * closing the connection. The client's session
 * wait_timeout variable will be set to
 * the value of the session interactive_timeout variable.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CLIENT_INTERACTIVE', 1024);

/**
 * <p>
 * Allow spaces after function names. Makes all functions names reserved words.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CLIENT_IGNORE_SPACE', 256);

/**
 * <p>
 * Don't allow the db_name.tbl_name.col_name syntax.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CLIENT_NO_SCHEMA', 16);
define ('MYSQLI_CLIENT_FOUND_ROWS', 2);
define ('MYSQLI_CLIENT_CAN_HANDLE_EXPIRED_PASSWORDS', 4194304);
define ('MYSQLI_OPT_CAN_HANDLE_EXPIRED_PASSWORDS', 29);

/**
 * <p>
 * For using buffered resultsets
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_STORE_RESULT', 0);

/**
 * <p>
 * For using unbuffered resultsets
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_USE_RESULT', 1);
define ('MYSQLI_ASYNC', 8);
define ('MYSQLI_STORE_RESULT_COPY_DATA', 16);

/**
 * <p>
 * Columns are returned into the array having the fieldname as the array index.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_ASSOC', 1);

/**
 * <p>
 * Columns are returned into the array having an enumerated index.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_NUM', 2);

/**
 * <p>
 * Columns are returned into the array having both a numerical index and the fieldname as the associative index.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_BOTH', 3);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH', 0);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_STMT_ATTR_CURSOR_TYPE', 1);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CURSOR_TYPE_NO_CURSOR', 0);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CURSOR_TYPE_READ_ONLY', 1);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CURSOR_TYPE_FOR_UPDATE', 2);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_CURSOR_TYPE_SCROLLABLE', 4);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_STMT_ATTR_PREFETCH_ROWS', 2);

/**
 * <p>
 * Indicates that a field is defined as NOT NULL
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_NOT_NULL_FLAG', 1);

/**
 * <p>
 * Field is part of a primary index
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_PRI_KEY_FLAG', 2);

/**
 * <p>
 * Field is part of a unique index.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_UNIQUE_KEY_FLAG', 4);

/**
 * <p>
 * Field is part of an index.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_MULTIPLE_KEY_FLAG', 8);

/**
 * <p>
 * Field is defined as BLOB
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_BLOB_FLAG', 16);

/**
 * <p>
 * Field is defined as UNSIGNED
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_UNSIGNED_FLAG', 32);

/**
 * <p>
 * Field is defined as ZEROFILL
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_ZEROFILL_FLAG', 64);

/**
 * <p>
 * Field is defined as AUTO_INCREMENT
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_AUTO_INCREMENT_FLAG', 512);

/**
 * <p>
 * Field is defined as TIMESTAMP
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TIMESTAMP_FLAG', 1024);

/**
 * <p>
 * Field is defined as SET
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_SET_FLAG', 2048);

/**
 * <p>
 * Field is defined as NUMERIC
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_NUM_FLAG', 32768);

/**
 * <p>
 * Field is part of an multi-index
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_PART_KEY_FLAG', 16384);

/**
 * <p>
 * Field is part of GROUP BY
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_GROUP_FLAG', 32768);

/**
 * <p>
 * Field is defined as ENUM. Available since PHP 5.3.0.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_ENUM_FLAG', 256);

/**
 * <p>
 * Field is defined as BINARY. Available since PHP 5.3.0.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_BINARY_FLAG', 128);
define ('MYSQLI_NO_DEFAULT_VALUE_FLAG', 4096);
define ('MYSQLI_ON_UPDATE_NOW_FLAG', 8192);

/**
 * <p>
 * Field is defined as DECIMAL
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_DECIMAL', 0);

/**
 * <p>
 * Field is defined as TINYINT
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_TINY', 1);

/**
 * <p>
 * Field is defined as SMALLINT
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_SHORT', 2);

/**
 * <p>
 * Field is defined as INT
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_LONG', 3);

/**
 * <p>
 * Field is defined as FLOAT
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_FLOAT', 4);

/**
 * <p>
 * Field is defined as DOUBLE
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_DOUBLE', 5);

/**
 * <p>
 * Field is defined as DEFAULT NULL
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_NULL', 6);

/**
 * <p>
 * Field is defined as TIMESTAMP
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_TIMESTAMP', 7);

/**
 * <p>
 * Field is defined as BIGINT
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_LONGLONG', 8);

/**
 * <p>
 * Field is defined as MEDIUMINT
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_INT24', 9);

/**
 * <p>
 * Field is defined as DATE
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_DATE', 10);

/**
 * <p>
 * Field is defined as TIME
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_TIME', 11);

/**
 * <p>
 * Field is defined as DATETIME
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_DATETIME', 12);

/**
 * <p>
 * Field is defined as YEAR
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_YEAR', 13);

/**
 * <p>
 * Field is defined as DATE
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_NEWDATE', 14);

/**
 * <p>
 * Field is defined as ENUM
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_ENUM', 247);

/**
 * <p>
 * Field is defined as SET
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_SET', 248);

/**
 * <p>
 * Field is defined as TINYBLOB
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_TINY_BLOB', 249);

/**
 * <p>
 * Field is defined as MEDIUMBLOB
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_MEDIUM_BLOB', 250);

/**
 * <p>
 * Field is defined as LONGBLOB
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_LONG_BLOB', 251);

/**
 * <p>
 * Field is defined as BLOB
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_BLOB', 252);

/**
 * <p>
 * Field is defined as VARCHAR
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_VAR_STRING', 253);

/**
 * <p>
 * Field is defined as CHAR or BINARY
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_STRING', 254);

/**
 * <p>
 * Field is defined as TINYINT.
 * For CHAR, see MYSQLI_TYPE_STRING
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_CHAR', 1);

/**
 * <p>
 * Field is defined as INTERVAL
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_INTERVAL', 247);

/**
 * <p>
 * Field is defined as GEOMETRY
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_GEOMETRY', 255);

/**
 * <p>
 * Precision math DECIMAL or NUMERIC field (MySQL 5.0.3 and up)
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_NEWDECIMAL', 246);

/**
 * <p>
 * Field is defined as BIT (MySQL 5.0.3 and up)
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TYPE_BIT', 16);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_SET_CHARSET_NAME', 7);
define ('MYSQLI_SET_CHARSET_DIR', 6);

/**
 * <p>
 * No more data available for bind variable
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_NO_DATA', 100);

/**
 * <p>
 * Data truncation occurred. Available since PHP 5.1.0 and MySQL 5.0.5.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_DATA_TRUNCATED', 101);

/**
 * <p>
 * Report if no index or bad index was used in a query.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REPORT_INDEX', 4);

/**
 * <p>
 * Report errors from mysqli function calls.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REPORT_ERROR', 1);

/**
 * <p>
 * Throw a mysqli_sql_exception for errors instead of warnings.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REPORT_STRICT', 2);

/**
 * <p>
 * Set all options on (report all).
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REPORT_ALL', 255);

/**
 * <p>
 * Turns reporting off.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REPORT_OFF', 0);

/**
 * <p>
 * Is set to 1 if <b>mysqli_debug</b> functionality is enabled.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_DEBUG_TRACE_ENABLED', 0);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_SERVER_QUERY_NO_GOOD_INDEX_USED', 16);

/**
 * <p>
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_SERVER_QUERY_NO_INDEX_USED', 32);
define ('MYSQLI_SERVER_QUERY_WAS_SLOW', 2048);
define ('MYSQLI_SERVER_PS_OUT_PARAMS', 4096);

/**
 * <p>
 * Refreshes the grant tables.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_GRANT', 1);

/**
 * <p>
 * Flushes the logs, like executing the
 * FLUSH LOGS SQL statement.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_LOG', 2);

/**
 * <p>
 * Flushes the table cache, like executing the
 * FLUSH TABLES SQL statement.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_TABLES', 4);

/**
 * <p>
 * Flushes the host cache, like executing the
 * FLUSH HOSTS SQL statement.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_HOSTS', 8);

/**
 * <p>
 * Reset the status variables, like executing the
 * FLUSH STATUS SQL statement.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_STATUS', 16);

/**
 * <p>
 * Flushes the thread cache.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_THREADS', 32);

/**
 * <p>
 * On a slave replication server: resets the master server information, and
 * restarts the slave. Like executing the RESET SLAVE
 * SQL statement.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_SLAVE', 64);

/**
 * <p>
 * On a master replication server: removes the binary log files listed in the
 * binary log index, and truncates the index file. Like executing the
 * RESET MASTER SQL statement.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_REFRESH_MASTER', 128);
define ('MYSQLI_REFRESH_BACKUP_LOG', 2097152);
define ('MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT', 1);
define ('MYSQLI_TRANS_START_READ_WRITE', 2);
define ('MYSQLI_TRANS_START_READ_ONLY', 4);

/**
 * <p>
 * Appends "AND CHAIN" to <b>mysqli_commit</b> or
 * <b>mysqli_rollback</b>.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TRANS_COR_AND_CHAIN', 1);

/**
 * <p>
 * Appends "AND NO CHAIN" to <b>mysqli_commit</b> or
 * <b>mysqli_rollback</b>.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TRANS_COR_AND_NO_CHAIN', 2);

/**
 * <p>
 * Appends "RELEASE" to <b>mysqli_commit</b> or
 * <b>mysqli_rollback</b>.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TRANS_COR_RELEASE', 4);

/**
 * <p>
 * Appends "NO RELEASE" to <b>mysqli_commit</b> or
 * <b>mysqli_rollback</b>.
 * </p>
 * @link http://php.net/manual/en/mysqli.constants.php
 */
define ('MYSQLI_TRANS_COR_NO_RELEASE', 8);

// End of mysqli v.0.1
?>
