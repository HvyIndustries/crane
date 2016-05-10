<?php

// Start of memcache v.3.0.8

class MemcachePool  {

	public function connect () {}

	public function addserver () {}

	public function setserverparams () {}

	public function setfailurecallback () {}

	public function getserverstatus () {}

	public function findserver () {}

	public function getversion () {}

	public function add () {}

	public function set () {}

	public function replace () {}

	public function cas () {}

	public function append () {}

	public function prepend () {}

	public function get () {}

	public function delete () {}

	public function getstats () {}

	public function getextendedstats () {}

	public function setcompressthreshold () {}

	public function increment () {}

	public function decrement () {}

	public function close () {}

	public function flush () {}

}

/**
 * Represents a connection to a set of memcache servers.
 * @link http://php.net/manual/en/class.memcache.php
 */
class Memcache extends MemcachePool  {

	/**
	 * (PECL memcache &gt;= 0.2.0)<br/>
	 * Open memcached server connection
	 * @link http://php.net/manual/en/memcache.connect.php
	 * @param string $host <p>
	 * Point to the host where memcached is listening for connections. This parameter
	 * may also specify other transports like unix:///path/to/memcached.sock
	 * to use UNIX domain sockets, in this case <i>port</i> must also
	 * be set to 0.
	 * </p>
	 * @param int $port [optional] <p>
	 * Point to the port where memcached is listening for connections. Set this
	 * parameter to 0 when using UNIX domain sockets.
	 * </p>
	 * <p>
	 * Please note: <i>port</i> defaults to
	 * memcache.default_port
	 * if not specified. For this reason it is wise to specify the port
	 * explicitly in this method call.
	 * </p>
	 * @param int $timeout [optional] <p>
	 * Value in seconds which will be used for connecting to the daemon. Think
	 * twice before changing the default value of 1 second - you can lose all
	 * the advantages of caching if your connection is too slow.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function connect ($host, $port = null, $timeout = null) {}

	/**
	 * (PECL memcache &gt;= 0.4.0)<br/>
	 * Open memcached server persistent connection
	 * @link http://php.net/manual/en/memcache.pconnect.php
	 * @param string $host <p>
	 * Point to the host where memcached is listening for connections. This parameter
	 * may also specify other transports like unix:///path/to/memcached.sock
	 * to use UNIX domain sockets, in this case <i>port</i> must also
	 * be set to 0.
	 * </p>
	 * @param int $port [optional] <p>
	 * Point to the port where memcached is listening for connections. Set this
	 * parameter to 0 when using UNIX domain sockets.
	 * </p>
	 * @param int $timeout [optional] <p>
	 * Value in seconds which will be used for connecting to the daemon. Think
	 * twice before changing the default value of 1 second - you can lose all
	 * the advantages of caching if your connection is too slow.
	 * </p>
	 * @return mixed a Memcache object or <b>FALSE</b> on failure.
	 */
	public function pconnect ($host, $port = null, $timeout = null) {}

	/**
	 * (PECL memcache &gt;= 2.0.0)<br/>
	 * Add a memcached server to connection pool
	 * @link http://php.net/manual/en/memcache.addserver.php
	 * @param string $host <p>
	 * Point to the host where memcached is listening for connections. This parameter
	 * may also specify other transports like unix:///path/to/memcached.sock
	 * to use UNIX domain sockets, in this case <i>port</i> must also
	 * be set to 0.
	 * </p>
	 * @param int $port [optional] <p>
	 * Point to the port where memcached is listening for connections.
	 * Set this
	 * parameter to 0 when using UNIX domain sockets.
	 * </p>
	 * <p>
	 * Please note: <i>port</i> defaults to
	 * memcache.default_port
	 * if not specified. For this reason it is wise to specify the port
	 * explicitly in this method call.
	 * </p>
	 * @param bool $persistent [optional] <p>
	 * Controls the use of a persistent connection. Default to <b>TRUE</b>.
	 * </p>
	 * @param int $weight [optional] <p>
	 * Number of buckets to create for this server which in turn control its
	 * probability of it being selected. The probability is relative to the
	 * total weight of all servers.
	 * </p>
	 * @param int $timeout [optional] <p>
	 * Value in seconds which will be used for connecting to the daemon. Think
	 * twice before changing the default value of 1 second - you can lose all
	 * the advantages of caching if your connection is too slow.
	 * </p>
	 * @param int $retry_interval [optional] <p>
	 * Controls how often a failed server will be retried, the default value
	 * is 15 seconds. Setting this parameter to -1 disables automatic retry.
	 * Neither this nor the <i>persistent</i> parameter has any
	 * effect when the extension is loaded dynamically via <b>dl</b>.
	 * </p>
	 * <p>
	 * Each failed connection struct has its own timeout and before it has expired
	 * the struct will be skipped when selecting backends to serve a request. Once
	 * expired the connection will be successfully reconnected or marked as failed
	 * for another <i>retry_interval</i> seconds. The typical
	 * effect is that each web server child will retry the connection about every
	 * <i>retry_interval</i> seconds when serving a page.
	 * </p>
	 * @param bool $status [optional] <p>
	 * Controls if the server should be flagged as online. Setting this parameter
	 * to <b>FALSE</b> and <i>retry_interval</i> to -1 allows a failed
	 * server to be kept in the pool so as not to affect the key distribution
	 * algorithm. Requests for this server will then failover or fail immediately
	 * depending on the <i>memcache.allow_failover</i> setting.
	 * Default to <b>TRUE</b>, meaning the server should be considered online.
	 * </p>
	 * @param callable $failure_callback [optional] <p>
	 * Allows the user to specify a callback function to run upon encountering an
	 * error. The callback is run before failover is attempted. The function takes
	 * two parameters, the hostname and port of the failed server.
	 * </p>
	 * @param int $timeoutms [optional] <p>
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function addserver ($host, $port = 11211, $persistent = null, $weight = null, $timeout = null, $retry_interval = null, $status = null, callable $failure_callback = null, $timeoutms = null) {}

	public function setserverparams () {}

	public function setfailurecallback () {}

	public function getserverstatus () {}

	public function findserver () {}

	public function getversion () {}

	public function add () {}

	public function set () {}

	public function replace () {}

	public function cas () {}

	public function append () {}

	public function prepend () {}

	public function get () {}

	public function delete () {}

	public function getstats () {}

	public function getextendedstats () {}

	public function setcompressthreshold () {}

	public function increment () {}

	public function decrement () {}

	public function close () {}

	public function flush () {}

}

function memcache_connect () {}

function memcache_pconnect () {}

function memcache_add_server () {}

function memcache_set_server_params () {}

function memcache_set_failure_callback () {}

function memcache_get_server_status () {}

function memcache_get_version () {}

function memcache_add () {}

function memcache_set () {}

function memcache_replace () {}

function memcache_cas () {}

function memcache_append () {}

function memcache_prepend () {}

function memcache_get () {}

function memcache_delete () {}

/**
 * (PECL memcache &gt;= 0.2.0)<br/>
 * Turn debug output on/off
 * @link http://php.net/manual/en/function.memcache-debug.php
 * @param bool $on_off <p>
 * Turns debug output on if equals to <b>TRUE</b>.
 * Turns debug output off if equals to <b>FALSE</b>.
 * </p>
 * @return bool <b>TRUE</b> if PHP was built with --enable-debug option, otherwise
 * returns <b>FALSE</b>.
 */
function memcache_debug ($on_off) {}

function memcache_get_stats () {}

function memcache_get_extended_stats () {}

function memcache_set_compress_threshold () {}

function memcache_increment () {}

function memcache_decrement () {}

function memcache_close () {}

function memcache_flush () {}

define ('MEMCACHE_COMPRESSED', 2);
define ('MEMCACHE_USER1', 65536);
define ('MEMCACHE_USER2', 131072);
define ('MEMCACHE_USER3', 262144);
define ('MEMCACHE_USER4', 524288);
define ('MEMCACHE_HAVE_SESSION', 1);

// End of memcache v.3.0.8
?>
