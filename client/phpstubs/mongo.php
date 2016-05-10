<?php

// Start of mongo v.1.6.11

/**
 * A connection manager for PHP and MongoDB.
 * @link http://php.net/manual/en/class.mongoclient.php
 */
class MongoClient  {
	const DEFAULT_HOST = "localhost";
	const DEFAULT_PORT = 27017;
	const VERSION = "1.6.11";
	const RP_PRIMARY = "primary";
	const RP_PRIMARY_PREFERRED = "primaryPreferred";
	const RP_SECONDARY = "secondary";
	const RP_SECONDARY_PREFERRED = "secondaryPreferred";
	const RP_NEAREST = "nearest";

	/**
	 * @var boolean
	 */
	public $connected;
	/**
	 * @var string
	 */
	public $status;
	/**
	 * @var string
	 */
	protected $server;
	/**
	 * @var boolean
	 */
	protected $persistent;


	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Creates a new database connection object
	 * @link http://php.net/manual/en/mongoclient.construct.php
	 * @param string $server [optional]
	 * @param array $options [optional]
	 * @param array $driver_options [optional]
	 */
	public function __construct ($server = "mongodb://localhost:27017", array $options = 'array("connect" => true)', array $driver_options = null) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Return info about all open connections
	 * @link http://php.net/manual/en/mongoclient.getconnections.php
	 * @return array An array of open connections.
	 */
	public static function getConnections () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Connects to a database server
	 * @link http://php.net/manual/en/mongoclient.connect.php
	 * @return bool If the connection was successful.
	 */
	public function connect () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * String representation of this connection
	 * @link http://php.net/manual/en/mongoclient.tostring.php
	 * @return string hostname and port for this connection.
	 */
	public function __toString () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Gets a database
	 * @link http://php.net/manual/en/mongoclient.get.php
	 * @param string $dbname <p>
	 * The database name.
	 * </p>
	 * @return MongoDB a new db object.
	 */
	public function __get ($dbname) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Gets a database
	 * @link http://php.net/manual/en/mongoclient.selectdb.php
	 * @param string $name <p>
	 * The database name.
	 * </p>
	 * @return MongoDB a new database object.
	 */
	public function selectDB ($name) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Gets a database collection
	 * @link http://php.net/manual/en/mongoclient.selectcollection.php
	 * @param string $db <p>
	 * The database name.
	 * </p>
	 * @param string $collection <p>
	 * The collection name.
	 * </p>
	 * @return MongoCollection a new collection object.
	 */
	public function selectCollection ($db, $collection) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Get the read preference for this connection
	 * @link http://php.net/manual/en/mongoclient.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Set the read preference for this connection
	 * @link http://php.net/manual/en/mongoclient.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return bool
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Get the write concern for this connection
	 * @link http://php.net/manual/en/mongoclient.getwriteconcern.php
	 * @return array
	 */
	public function getWriteConcern () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Set the write concern for this connection
	 * @link http://php.net/manual/en/mongoclient.setwriteconcern.php
	 * @param mixed $w
	 * @param int $wtimeout [optional]
	 * @return bool
	 */
	public function setWriteConcern ($w, $wtimeout = null) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Drops a database [deprecated]
	 * @link http://php.net/manual/en/mongoclient.dropdb.php
	 * @param mixed $db <p>
	 * The database to drop. Can be a MongoDB object or the name of the database.
	 * </p>
	 * @return array the database response.
	 */
	public function dropDB ($db) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Lists all of the databases available.
	 * @link http://php.net/manual/en/mongoclient.listdbs.php
	 * @return array an associative array containing three fields. The first field is
	 * databases, which in turn contains an array. Each element
	 * of the array is an associative array corresponding to a database, giving th
	 * database's name, size, and if it's empty. The other two fields are
	 * totalSize (in bytes) and ok, which is 1
	 * if this method ran successfully.
	 */
	public function listDBs () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Updates status for all associated hosts
	 * @link http://php.net/manual/en/mongoclient.gethosts.php
	 * @return array an array of information about the hosts in the set. Includes each
	 * host's hostname, its health (1 is healthy), its state (1 is primary, 2 is
	 * secondary, 0 is anything else), the amount of time it took to ping the
	 * server, and when the last ping occurred. For example, on a three-member
	 * replica set, it might look something like:
	 */
	public function getHosts () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Closes this connection
	 * @link http://php.net/manual/en/mongoclient.close.php
	 * @param boolean|string $connection [optional] <p>
	 * If connection is not given, or <b>FALSE</b> then connection that would be
	 * selected for writes would be closed. In a single-node configuration,
	 * that is then the whole connection, but if you are connected to a
	 * replica set, close() will only close the
	 * connection to the primary server.
	 * </p>
	 * <p>
	 * If connection is <b>TRUE</b> then all connections as known by the connection
	 * manager will be closed. This can include connections that are not
	 * referenced in the connection string used to create the object that
	 * you are calling close on.
	 * </p>
	 * <p>
	 * If connection is a string argument, then it will only close the
	 * connection identified by this hash. Hashes are identifiers for a
	 * connection and can be obtained by calling
	 * <b>MongoClient::getConnections</b>.
	 * </p>
	 * @return bool if the connection was successfully closed.
	 */
	public function close ($connection = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Kills a specific cursor on the server
	 * @link http://php.net/manual/en/mongoclient.killcursor.php
	 * @param string $server_hash <p>
	 * The server hash that has the cursor. This can be obtained through
	 * <b>MongoCursor::info</b>.
	 * </p>
	 * @param int|MongoInt64 $id <p>
	 * The ID of the cursor to kill. You can either supply an int
	 * containing the 64 bit cursor ID, or an object of the
	 * <b>MongoInt64</b> class. The latter is necessary on 32
	 * bit platforms (and Windows).
	 * </p>
	 * @return bool <b>TRUE</b> if the method attempted to kill a cursor, and <b>FALSE</b> if
	 * there was something wrong with the arguments (such as a wrong
	 * <i>server_hash</i>). The return status does not
	 * reflect where the cursor was actually killed as the server does
	 * not provide that information.
	 */
	public static function killCursor ($server_hash, $id) {}

}

/**
 * A connection between PHP and MongoDB.
 * @link http://php.net/manual/en/class.mongo.php
 */
class Mongo extends MongoClient  {
	const DEFAULT_HOST = "localhost";
	const DEFAULT_PORT = 27017;
	const VERSION = "1.6.11";
	const RP_PRIMARY = "primary";
	const RP_PRIMARY_PREFERRED = "primaryPreferred";
	const RP_SECONDARY = "secondary";
	const RP_SECONDARY_PREFERRED = "secondaryPreferred";
	const RP_NEAREST = "nearest";

	/**
	 * @var boolean
	 */
	public $connected;
	/**
	 * @var string
	 */
	public $status;
	/**
	 * @var string
	 */
	protected $server;
	/**
	 * @var boolean
	 */
	protected $persistent;


	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * The __construct purpose
	 * @link http://php.net/manual/en/mongo.construct.php
	 * @param string $server [optional]
	 * @param array $options [optional]
	 */
	public function __construct ($server = null, array $options = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Connects with a database server
	 * @link http://php.net/manual/en/mongo.connectutil.php
	 * @return bool If the connection was successful.
	 */
	protected function connectUtil () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Get slaveOkay setting for this connection
	 * @link http://php.net/manual/en/mongo.getslaveokay.php
	 * @return bool the value of slaveOkay for this instance.
	 */
	public function getSlaveOkay () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Change slaveOkay setting for this connection
	 * @link http://php.net/manual/en/mongo.setslaveokay.php
	 * @param bool $ok [optional] <p>
	 * If reads should be sent to secondary members of a replica set for all
	 * possible queries using this <b>MongoClient</b> instance.
	 * </p>
	 * @return bool the former value of slaveOkay for this instance.
	 */
	public function setSlaveOkay ($ok = true) {}

	public function lastError () {}

	public function prevError () {}

	public function resetError () {}

	public function forceError () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Returns the address being used by this for slaveOkay reads
	 * @link http://php.net/manual/en/mongo.getslave.php
	 * @return string The address of the secondary this connection is using for reads.
	 * </p>
	 * <p>
	 * This returns <b>NULL</b> if this is not connected to a replica set or not yet
	 * initialized.
	 */
	public function getSlave () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Choose a new secondary for slaveOkay reads
	 * @link http://php.net/manual/en/mongo.switchslave.php
	 * @return string The address of the secondary this connection is using for reads. This may be
	 * the same as the previous address as addresses are randomly chosen. It may
	 * return only one address if only one secondary (or only the primary) is
	 * available.
	 * </p>
	 * <p>
	 * For example, if we had a three member replica set with a primary, secondary,
	 * and arbiter this method would always return the address of the secondary.
	 * If the secondary became unavailable, this method would always return the
	 * address of the primary. If the primary also became unavailable, this method
	 * would throw an exception, as an arbiter cannot handle reads.
	 */
	public function switchSlave () {}

	/**
	 * (PECL mongo &gt;=1.2.0)<br/>
	 * Set the size for future connection pools.
	 * @link http://php.net/manual/en/mongo.setpoolsize.php
	 * @param int $size <p>
	 * The max number of connections future pools will be able to create.
	 * Negative numbers mean that the pool will spawn an infinite number of
	 * connections.
	 * </p>
	 * @return bool the former value of pool size.
	 */
	public static function setPoolSize ($size) {}

	/**
	 * (PECL mongo &gt;=1.2.0)<br/>
	 * Get pool size for connection pools
	 * @link http://php.net/manual/en/mongo.getpoolsize.php
	 * @return int the current pool size.
	 */
	public static function getPoolSize () {}

	/**
	 * (PECL mongo &gt;=1.2.0)<br/>
	 * Returns information about all connection pools.
	 * @link http://php.net/manual/en/mongo.pooldebug.php
	 * @return array Each connection pool has an identifier, which starts with the host. For each
	 * pool, this function shows the following fields:
	 * <i>in use</i>
	 * <p>
	 * The number of connections currently being used by
	 * <b>MongoClient</b> instances.
	 * </p>
	 * <i>in pool</i>
	 * <p>
	 * The number of connections currently in the pool (not being used).
	 * </p>
	 * <i>remaining</i>
	 * <p>
	 * The number of connections that could be created by this pool. For
	 * example, suppose a pool had 5 connections remaining and 3 connections in
	 * the pool. We could create 8 new instances of
	 * <b>MongoClient</b> before we exhausted this pool
	 * (assuming no instances of <b>MongoClient</b> went out of
	 * scope, returning their connections to the pool).
	 * </p>
	 * <p>
	 * A negative number means that this pool will spawn unlimited connections.
	 * </p>
	 * <p>
	 * Before a pool is created, you can change the max number of connections by
	 * calling <b>Mongo::setPoolSize</b>. Once a pool is showing
	 * up in the output of this function, its size cannot be changed.
	 * </p>
	 * <i>timeout</i>
	 * <p>
	 * The socket timeout for connections in this pool. This is how long
	 * connections in this pool will attempt to connect to a server before
	 * giving up.
	 * </p>
	 */
	public static function poolDebug () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Return info about all open connections
	 * @link http://php.net/manual/en/mongoclient.getconnections.php
	 * @return array An array of open connections.
	 */
	public static function getConnections () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Connects to a database server
	 * @link http://php.net/manual/en/mongoclient.connect.php
	 * @return bool If the connection was successful.
	 */
	public function connect () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * String representation of this connection
	 * @link http://php.net/manual/en/mongoclient.tostring.php
	 * @return string hostname and port for this connection.
	 */
	public function __toString () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Gets a database
	 * @link http://php.net/manual/en/mongoclient.get.php
	 * @param string $dbname <p>
	 * The database name.
	 * </p>
	 * @return MongoDB a new db object.
	 */
	public function __get ($dbname) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Gets a database
	 * @link http://php.net/manual/en/mongoclient.selectdb.php
	 * @param string $name <p>
	 * The database name.
	 * </p>
	 * @return MongoDB a new database object.
	 */
	public function selectDB ($name) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Gets a database collection
	 * @link http://php.net/manual/en/mongoclient.selectcollection.php
	 * @param string $db <p>
	 * The database name.
	 * </p>
	 * @param string $collection <p>
	 * The collection name.
	 * </p>
	 * @return MongoCollection a new collection object.
	 */
	public function selectCollection ($db, $collection) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Get the read preference for this connection
	 * @link http://php.net/manual/en/mongoclient.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Set the read preference for this connection
	 * @link http://php.net/manual/en/mongoclient.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return bool
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Get the write concern for this connection
	 * @link http://php.net/manual/en/mongoclient.getwriteconcern.php
	 * @return array
	 */
	public function getWriteConcern () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Set the write concern for this connection
	 * @link http://php.net/manual/en/mongoclient.setwriteconcern.php
	 * @param mixed $w
	 * @param int $wtimeout [optional]
	 * @return bool
	 */
	public function setWriteConcern ($w, $wtimeout = null) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Drops a database [deprecated]
	 * @link http://php.net/manual/en/mongoclient.dropdb.php
	 * @param mixed $db <p>
	 * The database to drop. Can be a MongoDB object or the name of the database.
	 * </p>
	 * @return array the database response.
	 */
	public function dropDB ($db) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Lists all of the databases available.
	 * @link http://php.net/manual/en/mongoclient.listdbs.php
	 * @return array an associative array containing three fields. The first field is
	 * databases, which in turn contains an array. Each element
	 * of the array is an associative array corresponding to a database, giving th
	 * database's name, size, and if it's empty. The other two fields are
	 * totalSize (in bytes) and ok, which is 1
	 * if this method ran successfully.
	 */
	public function listDBs () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Updates status for all associated hosts
	 * @link http://php.net/manual/en/mongoclient.gethosts.php
	 * @return array an array of information about the hosts in the set. Includes each
	 * host's hostname, its health (1 is healthy), its state (1 is primary, 2 is
	 * secondary, 0 is anything else), the amount of time it took to ping the
	 * server, and when the last ping occurred. For example, on a three-member
	 * replica set, it might look something like:
	 */
	public function getHosts () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Closes this connection
	 * @link http://php.net/manual/en/mongoclient.close.php
	 * @param boolean|string $connection [optional] <p>
	 * If connection is not given, or <b>FALSE</b> then connection that would be
	 * selected for writes would be closed. In a single-node configuration,
	 * that is then the whole connection, but if you are connected to a
	 * replica set, close() will only close the
	 * connection to the primary server.
	 * </p>
	 * <p>
	 * If connection is <b>TRUE</b> then all connections as known by the connection
	 * manager will be closed. This can include connections that are not
	 * referenced in the connection string used to create the object that
	 * you are calling close on.
	 * </p>
	 * <p>
	 * If connection is a string argument, then it will only close the
	 * connection identified by this hash. Hashes are identifiers for a
	 * connection and can be obtained by calling
	 * <b>MongoClient::getConnections</b>.
	 * </p>
	 * @return bool if the connection was successfully closed.
	 */
	public function close ($connection = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Kills a specific cursor on the server
	 * @link http://php.net/manual/en/mongoclient.killcursor.php
	 * @param string $server_hash <p>
	 * The server hash that has the cursor. This can be obtained through
	 * <b>MongoCursor::info</b>.
	 * </p>
	 * @param int|MongoInt64 $id <p>
	 * The ID of the cursor to kill. You can either supply an int
	 * containing the 64 bit cursor ID, or an object of the
	 * <b>MongoInt64</b> class. The latter is necessary on 32
	 * bit platforms (and Windows).
	 * </p>
	 * @return bool <b>TRUE</b> if the method attempted to kill a cursor, and <b>FALSE</b> if
	 * there was something wrong with the arguments (such as a wrong
	 * <i>server_hash</i>). The return status does not
	 * reflect where the cursor was actually killed as the server does
	 * not provide that information.
	 */
	public static function killCursor ($server_hash, $id) {}

}

/**
 * Instances of this class are used to interact with a database. To get a
 * database:
 * Selecting a database
 * <code>
 * $m = new MongoClient(); // connect
 * $db = $m->selectDB("example");
 * </code>
 * Database names can use almost any character in the ASCII range. However,
 * they cannot contain &#x00022; &#x00022;, &#x00022;.&#x00022; or be the empty string.
 * The name "system" is also reserved.
 * @link http://php.net/manual/en/class.mongodb.php
 */
class MongoDB  {
	const PROFILING_OFF = 0;
	const PROFILING_SLOW = 1;
	const PROFILING_ON = 2;

	/**
	 * @var integer
	 */
	public $w;
	/**
	 * @var integer
	 */
	public $wtimeout;


	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates a new database
	 * @link http://php.net/manual/en/mongodb.construct.php
	 * @param MongoClient $conn <p>
	 * Database connection.
	 * </p>
	 * @param string $name <p>
	 * Database name.
	 * </p>
	 */
	public function __construct (MongoClient $conn, $name) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * The name of this database
	 * @link http://php.net/manual/en/mongodb.--tostring.php
	 * @return string this database&#x00027;s name.
	 */
	public function __toString () {}

	/**
	 * (PECL mongo &gt;=1.0.2)<br/>
	 * Gets a collection
	 * @link http://php.net/manual/en/mongodb.get.php
	 * @param string $name <p>
	 * The name of the collection.
	 * </p>
	 * @return MongoCollection the collection.
	 */
	public function __get ($name) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Fetches toolkit for dealing with files stored in this database
	 * @link http://php.net/manual/en/mongodb.getgridfs.php
	 * @param string $prefix [optional] <p>
	 * The prefix for the files and chunks collections.
	 * </p>
	 * @return MongoGridFS a new gridfs object for this database.
	 */
	public function getGridFS ($prefix = 'fs') {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Get slaveOkay setting for this database
	 * @link http://php.net/manual/en/mongodb.getslaveokay.php
	 * @return bool the value of slaveOkay for this instance.
	 */
	public function getSlaveOkay () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Change slaveOkay setting for this database
	 * @link http://php.net/manual/en/mongodb.setslaveokay.php
	 * @param bool $ok [optional] <p>
	 * If reads should be sent to secondary members of a replica set for all
	 * possible queries using this <b>MongoDB</b> instance.
	 * </p>
	 * @return bool the former value of slaveOkay for this instance.
	 */
	public function setSlaveOkay ($ok = true) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Get the read preference for this database
	 * @link http://php.net/manual/en/mongodb.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Set the read preference for this database
	 * @link http://php.net/manual/en/mongodb.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return bool
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Get the write concern for this database
	 * @link http://php.net/manual/en/mongodb.getwriteconcern.php
	 * @return array
	 */
	public function getWriteConcern () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Set the write concern for this database
	 * @link http://php.net/manual/en/mongodb.setwriteconcern.php
	 * @param mixed $w
	 * @param int $wtimeout [optional]
	 * @return bool
	 */
	public function setWriteConcern ($w, $wtimeout = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Gets this database&#x00027;s profiling level
	 * @link http://php.net/manual/en/mongodb.getprofilinglevel.php
	 * @return int the profiling level.
	 */
	public function getProfilingLevel () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Sets this database&#x00027;s profiling level
	 * @link http://php.net/manual/en/mongodb.setprofilinglevel.php
	 * @param int $level <p>
	 * Profiling level.
	 * </p>
	 * @return int the previous profiling level.
	 */
	public function setProfilingLevel ($level) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Drops this database
	 * @link http://php.net/manual/en/mongodb.drop.php
	 * @return array the database response.
	 */
	public function drop () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Repairs and compacts this database
	 * @link http://php.net/manual/en/mongodb.repair.php
	 * @param bool $preserve_cloned_files [optional] <p>
	 * If cloned files should be kept if the repair fails.
	 * </p>
	 * @param bool $backup_original_files [optional] <p>
	 * If original files should be backed up.
	 * </p>
	 * @return array db response.
	 */
	public function repair ($preserve_cloned_files = false, $backup_original_files = false) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Gets a collection
	 * @link http://php.net/manual/en/mongodb.selectcollection.php
	 * @param string $name <p>
	 * The collection name.
	 * </p>
	 * @return MongoCollection a new collection object.
	 */
	public function selectCollection ($name) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates a collection
	 * @link http://php.net/manual/en/mongodb.createcollection.php
	 * @param string $name <p>
	 * The name of the collection.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array containing options for the collections. Each option is its own
	 * element in the options array, with the option name listed below being
	 * the key of the element. The supported options depend on the MongoDB
	 * server version and storage engine, and the driver passes any option
	 * that you give it straight to the server. A few of the supported options
	 * are, but you can find a full list in the MongoDB core docs on createCollection:
	 * </p>
	 * <p>
	 * <i>capped</i>
	 * <p>
	 * If the collection should be a fixed size.
	 * </p>
	 * @return MongoCollection a collection object representing the new collection.
	 */
	public function createCollection ($name, array $options = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Drops a collection [deprecated]
	 * @link http://php.net/manual/en/mongodb.dropcollection.php
	 * @param mixed $coll <p>
	 * MongoCollection or name of collection to drop.
	 * </p>
	 * @return array the database response.
	 */
	public function dropCollection ($coll) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Gets an array of MongoCollection objects for all collections in this database
	 * @link http://php.net/manual/en/mongodb.listcollections.php
	 * @param array $options [optional] <p>
	 * An array of options for listing the collections. Currently available
	 * options include:
	 * <p>"filter"</p><p>Optional query criteria. If provided, this criteria will be used to filter the collections included in the result.</p><p>Relevant fields that may be queried include "name" (collection name as a string, without the database name prefix) and "options" (object containing options used to create the collection)..</p>MongoDB 2.6 and earlier versions require the "name" criteria, if specified, to be a string value (i.e. equality match). This is because the driver must prefix the value with the database name in order to query the system.namespaces collection. Later versions of MongoDB do not have this limitation, as the driver will use the listCollections command.
	 * <p>"includeSystemCollections"</p><p>Boolean, defaults to <b>FALSE</b>. Determines whether system collections should be included in the result.</p>
	 * </p>
	 * <p>
	 * The following option may be used with MongoDB 2.8+:
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * </p>
	 * @return array an array of MongoCollection objects.
	 */
	public function listCollections (array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Gets an array of names for all collections in this database
	 * @link http://php.net/manual/en/mongodb.getcollectionnames.php
	 * @param array $options [optional] <p>
	 * An array of options for listing the collections. Currently available
	 * options include:
	 * <p>"filter"</p><p>Optional query criteria. If provided, this criteria will be used to filter the collections included in the result.</p><p>Relevant fields that may be queried include "name" (collection name as a string, without the database name prefix) and "options" (object containing options used to create the collection)..</p>MongoDB 2.6 and earlier versions require the "name" criteria, if specified, to be a string value (i.e. equality match). This is because the driver must prefix the value with the database name in order to query the system.namespaces collection. Later versions of MongoDB do not have this limitation, as the driver will use the listCollections command.
	 * <p>"includeSystemCollections"</p><p>Boolean, defaults to <b>FALSE</b>. Determines whether system collections should be included in the result.</p>
	 * </p>
	 * <p>
	 * The following option may be used with MongoDB 2.8+:
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * </p>
	 * @return array the collection names as an array of strings.
	 */
	public function getCollectionNames (array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=1.6.0)<br/>
	 * Returns information about collections in this database
	 * @link http://php.net/manual/en/mongodb.getcollectioninfo.php
	 * @param array $options [optional] <p>
	 * An array of options for listing the collections. Currently available
	 * options include:
	 * <p>"filter"</p><p>Optional query criteria. If provided, this criteria will be used to filter the collections included in the result.</p><p>Relevant fields that may be queried include "name" (collection name as a string, without the database name prefix) and "options" (object containing options used to create the collection)..</p>MongoDB 2.6 and earlier versions require the "name" criteria, if specified, to be a string value (i.e. equality match). This is because the driver must prefix the value with the database name in order to query the system.namespaces collection. Later versions of MongoDB do not have this limitation, as the driver will use the listCollections command.
	 * <p>"includeSystemCollections"</p><p>Boolean, defaults to <b>FALSE</b>. Determines whether system collections should be included in the result.</p>
	 * </p>
	 * <p>
	 * The following option may be used with MongoDB 2.8+:
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * </p>
	 * @return array This function returns an array where each element is an array describing a
	 * collection. Elements will contain a name key denoting the
	 * name of the collection, and optionally contain an options
	 * key denoting an array of objects used to create the collection. For example,
	 * capped collections will include capped and
	 * size options.
	 */
	public function getCollectionInfo (array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates a database reference
	 * @link http://php.net/manual/en/mongodb.createdbref.php
	 * @param string $collection <p>
	 * The collection to which the database reference will point.
	 * </p>
	 * @param mixed $document_or_id <p>
	 * If an array or object is given, its _id field will be
	 * used as the reference ID. If a <b>MongoId</b> or scalar
	 * is given, it will be used as the reference ID.
	 * </p>
	 * @return array a database reference array.
	 * </p>
	 * <p>
	 * If an array without an _id field was provided as the
	 * document_or_id parameter, <b>NULL</b> will be returned.
	 */
	public function createDBRef ($collection, $document_or_id) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Fetches the document pointed to by a database reference
	 * @link http://php.net/manual/en/mongodb.getdbref.php
	 * @param array $ref <p>
	 * A database reference.
	 * </p>
	 * @return array the document pointed to by the reference.
	 */
	public function getDBRef (array $ref) {}

	/**
	 * (PECL mongo &gt;=0.9.3)<br/>
	 * Runs JavaScript code on the database server.
	 * @link http://php.net/manual/en/mongodb.execute.php
	 * @param mixed $code <p>
	 * <b>MongoCode</b> or string to execute.
	 * </p>
	 * @param array $args [optional] <p>
	 * Arguments to be passed to code.
	 * </p>
	 * @return array the result of the evaluation.
	 */
	public function execute ($code, array $args = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Execute a database command
	 * @link http://php.net/manual/en/mongodb.command.php
	 * @param array $command <p>
	 * The query to send.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the index creation. Currently available options
	 * include:
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * </p>
	 * <p>
	 * The following options are deprecated and should no longer be used:
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * </p>
	 * @param string $hash [optional] <p>
	 * Set to the connection hash of the server that executed the command. When
	 * the command result is suitable for creating a
	 * <b>MongoCommandCursor</b>, the hash is intended to be
	 * passed to <b>MongoCommandCursor::createFromDocument</b>.
	 * </p>
	 * <p>
	 * The hash will also correspond to a connection returned from
	 * <b>MongoClient::getConnections</b>.
	 * </p>
	 * @return array database response. Every database response is always maximum one
	 * document, which means that the result of a database command can never
	 * exceed 16MB. The resulting document's structure depends on the command, but
	 * most results will have the ok field to indicate success
	 * or failure and results containing an array of each of
	 * the resulting documents.
	 */
	public function command (array $command, array $options = 'array()', &$hash = null) {}

	/**
	 * (PECL mongo &gt;=0.9.5)<br/>
	 * Check if there was an error on the most recent db operation performed
	 * @link http://php.net/manual/en/mongodb.lasterror.php
	 * @return array the error, if there was one.
	 */
	public function lastError () {}

	/**
	 * (PECL mongo &gt;=0.9.5)<br/>
	 * Checks for the last error thrown during a database operation
	 * @link http://php.net/manual/en/mongodb.preverror.php
	 * @return array the error and the number of operations ago it occurred.
	 */
	public function prevError () {}

	/**
	 * (PECL mongo &gt;=0.9.5)<br/>
	 * Clears any flagged errors on the database
	 * @link http://php.net/manual/en/mongodb.reseterror.php
	 * @return array the database response.
	 */
	public function resetError () {}

	/**
	 * (PECL mongo &gt;=0.9.5)<br/>
	 * Creates a database error
	 * @link http://php.net/manual/en/mongodb.forceerror.php
	 * @return bool the database response.
	 */
	public function forceError () {}

	/**
	 * (PECL mongo &gt;=1.0.1)<br/>
	 * Log in to this database
	 * @link http://php.net/manual/en/mongodb.authenticate.php
	 * @param string $username <p>
	 * The username.
	 * </p>
	 * @param string $password <p>
	 * The password (in plaintext).
	 * </p>
	 * @return array database response. If the login was successful, it will return
	 * <code>
	 * array("ok" => 1);
	 * </code>
	 * If something went wrong, it will return
	 * <code>
	 * array("ok" => 0, "errmsg" => "auth fails");
	 * </code>
	 * ("auth fails" could be another message, depending on database version and what
	 * when wrong).
	 */
	public function authenticate ($username, $password) {}

}

/**
 * Represents a MongoDB collection.
 * @link http://php.net/manual/en/class.mongocollection.php
 */
class MongoCollection  {
	const ASCENDING = 1;
	const DESCENDING = -1;

	/**
	 * @var integer
	 */
	public $w;
	/**
	 * @var integer
	 */
	public $wtimeout;


	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates a new collection
	 * @link http://php.net/manual/en/mongocollection.construct.php
	 * @param MongoDB $db <p>
	 * Parent database.
	 * </p>
	 * @param string $name <p>
	 * Name for this collection.
	 * </p>
	 */
	public function __construct (MongoDB $db, $name) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * String representation of this collection
	 * @link http://php.net/manual/en/mongocollection.--tostring.php
	 * @return string the full name of this collection.
	 */
	public function __toString () {}

	/**
	 * (PECL mongo &gt;=1.0.2)<br/>
	 * Gets a collection
	 * @link http://php.net/manual/en/mongocollection.get.php
	 * @param string $name <p>
	 * The next string in the collection name.
	 * </p>
	 * @return MongoCollection the collection.
	 */
	public function __get ($name) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns this collection&#x00027;s name
	 * @link http://php.net/manual/en/mongocollection.getname.php
	 * @return string the name of this collection.
	 */
	public function getName () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Get slaveOkay setting for this collection
	 * @link http://php.net/manual/en/mongocollection.getslaveokay.php
	 * @return bool the value of slaveOkay for this instance.
	 */
	public function getSlaveOkay () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Change slaveOkay setting for this collection
	 * @link http://php.net/manual/en/mongocollection.setslaveokay.php
	 * @param bool $ok [optional] <p>
	 * If reads should be sent to secondary members of a replica set for all
	 * possible queries using this <b>MongoCollection</b>
	 * instance.
	 * </p>
	 * @return bool the former value of slaveOkay for this instance.
	 */
	public function setSlaveOkay ($ok = true) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Get the read preference for this collection
	 * @link http://php.net/manual/en/mongocollection.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Set the read preference for this collection
	 * @link http://php.net/manual/en/mongocollection.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return bool
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Get the write concern for this collection
	 * @link http://php.net/manual/en/mongocollection.getwriteconcern.php
	 * @return array
	 */
	public function getWriteConcern () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Set the write concern for this database
	 * @link http://php.net/manual/en/mongocollection.setwriteconcern.php
	 * @param mixed $w
	 * @param int $wtimeout [optional]
	 * @return bool
	 */
	public function setWriteConcern ($w, $wtimeout = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Drops this collection
	 * @link http://php.net/manual/en/mongocollection.drop.php
	 * @return array the database response.
	 */
	public function drop () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Validates this collection
	 * @link http://php.net/manual/en/mongocollection.validate.php
	 * @param bool $scan_data [optional] <p>
	 * Only validate indices, not the base collection.
	 * </p>
	 * @return array the database&#x00027;s evaluation of this object.
	 */
	public function validate ($scan_data = false) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Inserts a document into the collection
	 * @link http://php.net/manual/en/mongocollection.insert.php
	 * @param array|object $document <p>
	 * An array or object. If an object is used, it may not have protected or
	 * private properties.
	 * </p>
	 * <p>
	 * If the parameter does not have an _id key or
	 * property, a new <b>MongoId</b> instance will be created
	 * and assigned to it. This special behavior does not mean that the
	 * parameter is passed by reference.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the insert operation. Currently available options
	 * include:
	 * <p>"fsync"</p><p>Boolean, defaults to <b>FALSE</b>. If journaling is enabled, it works exactly like "j". If journaling is not enabled, the write operation blocks until it is synced to database files on disk. If <b>TRUE</b>, an acknowledged insert is implied and this option will override setting "w" to 0.</p>If journaling is enabled, users are strongly encouraged to use the "j" option instead of "fsync". Do not use "fsync" and "j" simultaneously, as that will result in an error.
	 * <p>"j"</p><p>Boolean, defaults to <b>FALSE</b>. Forces the write operation to block until it is synced to the journal on disk. If <b>TRUE</b>, an acknowledged write is implied and this option will override setting "w" to 0.</p>If this option is used and journaling is disabled, MongoDB 2.6+ will raise an error and the write will fail; older server versions will simply ignore the option.
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * </p>
	 * <p>
	 * The following options are deprecated and should no longer be used:
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * </p>
	 * @return bool|array an array containing the status of the insertion if the
	 * "w" option is set. Otherwise, returns <b>TRUE</b> if the
	 * inserted array is not empty (a <b>MongoException</b> will be
	 * thrown if the inserted array is empty).
	 * </p>
	 * <p>
	 * If an array is returned, the following keys may be present:
	 * <i>ok</i>
	 * <p>
	 * This should almost always be 1 (unless last_error itself failed).
	 * </p>
	 * <i>err</i>
	 * <p>
	 * If this field is non-null, an error occurred on the previous operation.
	 * If this field is set, it will be a string describing the error that
	 * occurred.
	 * </p>
	 * <i>code</i>
	 * <p>
	 * If a database error occurred, the relevant error code will be passed
	 * back to the client.
	 * </p>
	 * <i>errmsg</i>
	 * <p>
	 * This field is set if something goes wrong with a database command. It
	 * is coupled with ok being 0. For example, if
	 * w is set and times out, errmsg will be set to "timed
	 * out waiting for slaves" and ok will be 0. If this
	 * field is set, it will be a string describing the error that occurred.
	 * </p>
	 * <i>n</i>
	 * <p>
	 * If the last operation was an update, upsert, or a remove, the number
	 * of documents affected will be returned. For insert operations, this value
	 * is always 0.
	 * </p>
	 * <i>wtimeout</i>
	 * <p>
	 * If the previous option timed out waiting for replication.
	 * </p>
	 * <i>waited</i>
	 * <p>
	 * How long the operation waited before timing out.
	 * </p>
	 * <i>wtime</i>
	 * <p>
	 * If w was set and the operation succeeded, how long it took to
	 * replicate to w servers.
	 * </p>
	 * <i>upserted</i>
	 * <p>
	 * If an upsert occurred, this field will contain the new record's
	 * _id field. For upserts, either this field or
	 * updatedExisting will be present (unless an error
	 * occurred).
	 * </p>
	 * <i>updatedExisting</i>
	 * <p>
	 * If an upsert updated an existing element, this field will be true. For
	 * upserts, either this field or upserted will be present (unless an error
	 * occurred).
	 * </p>
	 */
	public function insert ($document, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Inserts multiple documents into this collection
	 * @link http://php.net/manual/en/mongocollection.batchinsert.php
	 * @param array $a <p>
	 * An array of arrays or objects. If any objects are used, they may not have
	 * protected or private properties.
	 * </p>
	 * <p>
	 * If the documents to insert do not have an _id key or
	 * property, a new <b>MongoId</b> instance will be created
	 * and assigned to it. See <b>MongoCollection::insert</b> for
	 * additional information on this behavior.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the batch of insert operations. Currently
	 * available options include:
	 * <p>
	 * "continueOnError"
	 * </p>
	 * <p>
	 * Boolean, defaults to <b>FALSE</b>. If set, the database will not stop
	 * processing a bulk insert if one fails (eg due to duplicate IDs).
	 * This makes bulk insert behave similarly to a series of single
	 * inserts, except that calling <b>MongoDB::lastError</b>
	 * will have an error set if any insert fails, not just the last one.
	 * If multiple errors occur, only the most recent will be reported by
	 * <b>MongoDB::lastError</b>.
	 * </p>
	 * <p>
	 * Please note that continueOnError affects errors
	 * on the database side only. If you try to insert a document that has
	 * errors (for example it contains a key with an empty name), then the
	 * document is not even transferred to the database as the driver
	 * detects this error and bails out.
	 * continueOnError has no effect on errors detected
	 * in the documents by the driver.
	 * </p>
	 * @return mixed If the w parameter is set to acknowledge the write,
	 * returns an associative array with the status of the inserts ("ok") and any
	 * error that may have occurred ("err"). Otherwise, returns <b>TRUE</b> if the
	 * batch insert was successfully sent, <b>FALSE</b> otherwise.
	 */
	public function batchInsert (array $a, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Update records based on a given criteria
	 * @link http://php.net/manual/en/mongocollection.update.php
	 * @param array $criteria <p>
	 * Query criteria for the documents to update.
	 * </p>
	 * @param array $new_object <p>
	 * The object used to update the matched documents. This may either contain
	 * update operators (for modifying specific fields) or be a replacement
	 * document.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the update operation. Currently available options
	 * include:
	 * <p>
	 * "upsert"
	 * </p>
	 * <p>
	 * If no document matches <i>$criteria</i>, a new
	 * document will be inserted.
	 * </p>
	 * <p>
	 * If a new document would be inserted and
	 * <i>$new_object</i> contains atomic modifiers
	 * (i.e. $ operators), those operations will be
	 * applied to the <i>$criteria</i> parameter to create
	 * the new document. If <i>$new_object</i> does not
	 * contain atomic modifiers, it will be used as-is for the inserted
	 * document. See the upsert examples below for more information.
	 * </p>
	 * @return bool|array an array containing the status of the update if the
	 * "w" option is set. Otherwise, returns <b>TRUE</b>.
	 * </p>
	 * <p>
	 * Fields in the status array are described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function update (array $criteria, array $new_object, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Remove records from this collection
	 * @link http://php.net/manual/en/mongocollection.remove.php
	 * @param array $criteria [optional] <p>
	 * Query criteria for the documents to delete.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the remove operation. Currently available options
	 * include:
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>
	 * "justOne"
	 * </p>
	 * <p>
	 * Specify <b>TRUE</b> to limit deletion to just one document. If <b>FALSE</b> or
	 * omitted, all documents matching the criteria will be deleted.
	 * </p>
	 * @return bool|array an array containing the status of the removal if the
	 * "w" option is set. Otherwise, returns <b>TRUE</b>.
	 * </p>
	 * <p>
	 * Fields in the status array are described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function remove (array $criteria = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Queries this collection, returning a <b>MongoCursor</b>
for the result set
	 * @link http://php.net/manual/en/mongocollection.find.php
	 * @param array $query [optional] <p>
	 * The fields for which to search. MongoDB's query language is quite
	 * extensive. The PHP driver will in almost all cases pass the query
	 * straight through to the server, so reading the MongoDB core docs on
	 * find is a good idea.
	 * </p>
	 * <p>
	 * Please make sure that for all special query operators (starting with
	 * $) you use single quotes so that PHP doesn't try to
	 * replace "$exists" with the value of the variable
	 * $exists.
	 * </p>
	 * @param array $fields [optional] <p>
	 * Fields of the results to return. The array is in the format
	 * array('fieldname' => true, 'fieldname2' => true).
	 * The _id field is always returned.
	 * </p>
	 * @return MongoCursor a cursor for the search results.
	 */
	public function find (array $query = 'array()', array $fields = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Queries this collection, returning a single element
	 * @link http://php.net/manual/en/mongocollection.findone.php
	 * @param array $query [optional] <p>
	 * The fields for which to search. MongoDB's query language is quite
	 * extensive. The PHP driver will in almost all cases pass the query
	 * straight through to the server, so reading the MongoDB core docs on
	 * find is a good idea.
	 * </p>
	 * <p>
	 * Please make sure that for all special query operaters (starting with
	 * $) you use single quotes so that PHP doesn't try to
	 * replace "$exists" with the value of the variable
	 * $exists.
	 * </p>
	 * @param array $fields [optional] <p>
	 * Fields of the results to return. The array is in the format
	 * array('fieldname' => true, 'fieldname2' => true).
	 * The _id field is always returned.
	 * </p>
	 * @param array $options [optional] <p>
	 * This parameter is an associative array of the form
	 * array("name" => &lt;value&gt;, ...). Currently
	 * supported options are:
	 * </p>
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * @return array record matching the search or <b>NULL</b>.
	 */
	public function findOne (array $query = 'array()', array $fields = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Update a document and return it
	 * @link http://php.net/manual/en/mongocollection.findandmodify.php
	 * @param array $query <p>
	 * The query criteria to search for.
	 * </p>
	 * @param array $update [optional] <p>
	 * The update criteria.
	 * </p>
	 * @param array $fields [optional] <p>
	 * Optionally only return these fields.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options to apply, such as remove the match document from the
	 * DB and return it.
	 * <tr valign="top">
	 * <td>Option</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>sort array</td>
	 * <td>
	 * Determines which document the operation will modify if the
	 * query selects multiple documents. findAndModify will modify the
	 * first document in the sort order specified by this argument.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>remove boolean</td>
	 * <td>
	 * Optional if update field exists. When <b>TRUE</b>, removes the selected
	 * document. The default is <b>FALSE</b>.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>update array</td>
	 * <td>
	 * Optional if remove field exists.
	 * Performs an update of the selected document.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>new boolean</td>
	 * <td>
	 * Optional. When <b>TRUE</b>, returns the modified document rather than the
	 * original. The findAndModify method ignores the new option for
	 * remove operations. The default is <b>FALSE</b>.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>upsert boolean</td>
	 * <td>
	 * Optional. Used in conjunction with the update field. When <b>TRUE</b>, the
	 * findAndModify command creates a new document if the query returns
	 * no documents. The default is false. In MongoDB 2.2, the
	 * findAndModify command returns <b>NULL</b> when upsert is <b>TRUE</b>.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td></td>
	 * <td>
	 * </td>
	 * </tr>
	 * </p>
	 * @return array the original document, or the modified document when
	 * new is set.
	 */
	public function findAndModify (array $query, array $update = null, array $fields = null, array $options = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Creates an index on the specified field(s) if it does not already exist.
	 * @link http://php.net/manual/en/mongocollection.createindex.php
	 * @param array $keys <p>
	 * An array specifying the index's fields as its keys. For each field, the
	 * value is either the index direction or
	 * index type.
	 * If specifying direction, specify 1 for ascending or
	 * -1 for descending.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the index creation. We pass all given options
	 * straight to the server, but a non-exhaustive list of currently
	 * available options include:
	 * <p>"unique"</p><p>Specify <b>TRUE</b> to create a unique index. The default value is <b>FALSE</b>. This option applies only to ascending/descending indexes.</p><p>When MongoDB indexes a field, if a document does not have a value for the field, a <b>NULL</b> value is indexed. If multiple documents do not contain a field, a unique index will reject all but the first of those documents. The "sparse" option may be used to overcome this, since it will prevent documents without the field from being indexed.</p>
	 * <p>"sparse"</p><p>Specify <b>TRUE</b> to create a sparse index, which only indexes documents containing a specified field. The default value is <b>FALSE</b>.</p>
	 * <p>"expireAfterSeconds"</p><p>The value of this option should specify the number of seconds after which a document should be considered expired and automatically removed from the collection. This option is only compatible with single-field indexes where the field will contain <b>MongoDate</b> values.</p><p>This feature is available in MongoDB 2.2+. See Expire Data from Collections by Setting TTL for more information.</p>
	 * <p>"name"</p><p>A optional name that uniquely identifies the index.</p><p>By default, the driver will generate an index name based on the index&#x00027;s field(s) and ordering or type. For example, a compound index array("x" => 1, "y" => -1) would be named "x_1_y_-1" and a geospatial index array("loc" => "2dsphere") would be named "loc_2dsphere". For indexes with many fields, it is possible that the generated name might exceed MongoDB&#x00027;s limit for index names. The "name" option may be used in that case to supply a shorter name.</p>
	 * <p>"background"</p><p>Builds the index in the background so that building an index does not block other database activities. Specify <b>TRUE</b> to build in the background. The default value is <b>FALSE</b>.</p><p>Prior to MongoDB 2.6.0, index builds on secondaries were executed as foreground operations, irrespective of this option. See Building Indexes with Replica Sets for more information.</p>
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * </p>
	 * <p>
	 * The following option may be used with MongoDB 2.6+:
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.8:
	 * <p>"dropDups"</p><p>Specify <b>TRUE</b> to force creation of a unique index where the collection may contain duplicate values for a key. MongoDB will index the first occurrence of a key and delete all subsequent documents from the collection that contain a duplicate value for that key. The default value is <b>FALSE</b>.</p><p>"dropDups" may delete data from your database. Use with extreme caution.</p><p>This option is not supported on MongoDB 2.8+. Index creation will fail if the collection contains duplicate values.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.6:
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * </p>
	 * <p>
	 * The following options are deprecated and should no longer be used:
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * </p>
	 * @return bool an array containing the status of the index creation. The array
	 * contains whether the operation succeeded ("ok"), the
	 * number of indexes before and after the operation
	 * ("numIndexesBefore" and
	 * "numIndexesAfter"), and whether the collection that the
	 * index belongs to has been created
	 * ("createdCollectionAutomatically"). If the index already
	 * existed and did not need to be created, a "note" field may
	 * be present in lieu of "numIndexesAfter".
	 * </p>
	 * <p>
	 * With MongoDB 2.4 and earlier, a status document is only returned if the
	 * write concern is at least
	 * 1. Otherwise, <b>TRUE</b> is returned. The fields in the status
	 * document are different, except for the "ok" field, which
	 * signals whether the index creation was successful. Additional fields are
	 * described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function createIndex (array $keys, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates an index on the specified field(s) if it does not already exist.
	 * @link http://php.net/manual/en/mongocollection.ensureindex.php
	 * @param string|array $key_keys
	 * @param array $options [optional] <p>
	 * An array of options for the index creation. Currently available options
	 * include:
	 * <p>"unique"</p><p>Specify <b>TRUE</b> to create a unique index. The default value is <b>FALSE</b>. This option applies only to ascending/descending indexes.</p><p>When MongoDB indexes a field, if a document does not have a value for the field, a <b>NULL</b> value is indexed. If multiple documents do not contain a field, a unique index will reject all but the first of those documents. The "sparse" option may be used to overcome this, since it will prevent documents without the field from being indexed.</p>
	 * <p>"sparse"</p><p>Specify <b>TRUE</b> to create a sparse index, which only indexes documents containing a specified field. The default value is <b>FALSE</b>.</p>
	 * <p>"expireAfterSeconds"</p><p>The value of this option should specify the number of seconds after which a document should be considered expired and automatically removed from the collection. This option is only compatible with single-field indexes where the field will contain <b>MongoDate</b> values.</p><p>This feature is available in MongoDB 2.2+. See Expire Data from Collections by Setting TTL for more information.</p>
	 * <p>"name"</p><p>A optional name that uniquely identifies the index.</p><p>By default, the driver will generate an index name based on the index&#x00027;s field(s) and ordering or type. For example, a compound index array("x" => 1, "y" => -1) would be named "x_1_y_-1" and a geospatial index array("loc" => "2dsphere") would be named "loc_2dsphere". For indexes with many fields, it is possible that the generated name might exceed MongoDB&#x00027;s limit for index names. The "name" option may be used in that case to supply a shorter name.</p>
	 * <p>"background"</p><p>Builds the index in the background so that building an index does not block other database activities. Specify <b>TRUE</b> to build in the background. The default value is <b>FALSE</b>.</p><p>Prior to MongoDB 2.6.0, index builds on secondaries were executed as foreground operations, irrespective of this option. See Building Indexes with Replica Sets for more information.</p>
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * </p>
	 * <p>
	 * The following option may be used with MongoDB 2.6+:
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.8:
	 * <p>"dropDups"</p><p>Specify <b>TRUE</b> to force creation of a unique index where the collection may contain duplicate values for a key. MongoDB will index the first occurrence of a key and delete all subsequent documents from the collection that contain a duplicate value for that key. The default value is <b>FALSE</b>.</p><p>"dropDups" may delete data from your database. Use with extreme caution.</p><p>This option is not supported on MongoDB 2.8+. Index creation will fail if the collection contains duplicate values.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.6:
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * </p>
	 * <p>
	 * The following options are deprecated and should no longer be used:
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * </p>
	 * @return bool an array containing the status of the index creation. The array
	 * contains whether the operation succeeded ("ok"), the
	 * number of indexes before and after the operation
	 * ("numIndexesBefore" and
	 * "numIndexesAfter"), and whether the collection that the
	 * index belongs to has been created
	 * ("createdCollectionAutomatically"). If the index already
	 * existed and did not need to be created, a "note" field may
	 * be present in lieu of "numIndexesAfter".
	 * </p>
	 * <p>
	 * With MongoDB 2.4 and earlier, a status document is only returned if the
	 * write concern is at least
	 * 1. Otherwise, <b>TRUE</b> is returned. The fields in the status
	 * document are different, except for the "ok" field, which
	 * signals whether the index creation was successful. Additional fields are
	 * described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function ensureIndex ($key_keys, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Deletes an index from this collection
	 * @link http://php.net/manual/en/mongocollection.deleteindex.php
	 * @param string|array $keys <p>
	 * An array specifying the index's fields as its keys. For each field, the
	 * value is either the index direction or
	 * index type.
	 * If specifying direction, specify 1 for ascending or
	 * -1 for descending.
	 * </p>
	 * <p>
	 * If a string is provided, it is assumed to be the single field name in an
	 * ascending index.
	 * </p>
	 * @return array the database response.
	 */
	public function deleteIndex ($keys) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Delete all indices for this collection
	 * @link http://php.net/manual/en/mongocollection.deleteindexes.php
	 * @return array the database response.
	 */
	public function deleteIndexes () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns information about indexes on this collection
	 * @link http://php.net/manual/en/mongocollection.getindexinfo.php
	 * @return array This function returns an array in which each element describes an index.
	 * Elements will contain the values name for the name of
	 * the index, ns for the namespace (a combination of the
	 * database and collection name), and key for a list of all
	 * fields in the index and their ordering. Additional values may be present for
	 * special indexes, such as unique or
	 * sparse.
	 */
	public function getIndexInfo () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Counts the number of documents in this collection
	 * @link http://php.net/manual/en/mongocollection.count.php
	 * @param array $query [optional] <p>
	 * Associative array or object with fields to match.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the index creation. Currently available options
	 * include:
	 * <tr valign="top">
	 * <td>Name</td>
	 * <td>Type</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>hint</td>
	 * <td>mixed</td>
	 * <td>
	 * <p>
	 * Index to use for the query. If a string is passed, it should
	 * correspond to an index name. If an array or object is passed, it
	 * should correspond to the specification used to create the index
	 * (i.e. the first argument to
	 * <b>MongoCollection::createIndex</b>).
	 * </p>
	 * This option is only supported in MongoDB 2.6+.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>limit</td>
	 * <td>integer</td>
	 * <td>The maximum number of matching documents to return.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>maxTimeMS</td>
	 * <td>integer</td>
	 * <td>
	 * <p>
	 * Specifies a cumulative time limit in milliseconds for processing
	 * the operation (does not include idle time). If the operation is not
	 * completed within the timeout period, a
	 * <b>MongoExecutionTimeoutException</b> will be
	 * thrown.
	 * </p>
	 * This option is only supported in MongoDB 2.6+.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>skip</td>
	 * <td>integer</td>
	 * <td>The number of matching documents to skip before returning results.</td>
	 * </tr>
	 * </p>
	 * @return int the number of documents matching the query.
	 */
	public function count (array $query = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Saves a document to this collection
	 * @link http://php.net/manual/en/mongocollection.save.php
	 * @param array|object $document <p>
	 * Array or object to save. If an object is used, it may not have protected
	 * or private properties.
	 * </p>
	 * <p>
	 * If the parameter does not have an _id key or
	 * property, a new <b>MongoId</b> instance will be created
	 * and assigned to it. See <b>MongoCollection::insert</b> for
	 * additional information on this behavior.
	 * </p>
	 * @param array $options [optional] <p>
	 * Options for the save.
	 * <p>"fsync"</p><p>Boolean, defaults to <b>FALSE</b>. If journaling is enabled, it works exactly like "j". If journaling is not enabled, the write operation blocks until it is synced to database files on disk. If <b>TRUE</b>, an acknowledged insert is implied and this option will override setting "w" to 0.</p>If journaling is enabled, users are strongly encouraged to use the "j" option instead of "fsync". Do not use "fsync" and "j" simultaneously, as that will result in an error.
	 * <p>"j"</p><p>Boolean, defaults to <b>FALSE</b>. Forces the write operation to block until it is synced to the journal on disk. If <b>TRUE</b>, an acknowledged write is implied and this option will override setting "w" to 0.</p>If this option is used and journaling is disabled, MongoDB 2.6+ will raise an error and the write will fail; older server versions will simply ignore the option.
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * </p>
	 * @return mixed If <i>w</i> was set, returns an array containing the status of the save.
	 * Otherwise, returns a boolean representing if the array was not empty (an empty array will not
	 * be inserted).
	 */
	public function save ($document, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates a database reference
	 * @link http://php.net/manual/en/mongocollection.createdbref.php
	 * @param mixed $document_or_id <p>
	 * If an array or object is given, its _id field will be
	 * used as the reference ID. If a <b>MongoId</b> or scalar
	 * is given, it will be used as the reference ID.
	 * </p>
	 * @return array a database reference array.
	 * </p>
	 * <p>
	 * If an array without an _id field was provided as the
	 * document_or_id parameter, <b>NULL</b> will be returned.
	 */
	public function createDBRef ($document_or_id) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Fetches the document pointed to by a database reference
	 * @link http://php.net/manual/en/mongocollection.getdbref.php
	 * @param array $ref <p>
	 * A database reference.
	 * </p>
	 * @return array the database document pointed to by the reference.
	 */
	public function getDBRef (array $ref) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Converts keys specifying an index to its identifying string
	 * @link http://php.net/manual/en/mongocollection.toindexstring.php
	 * @param mixed $keys <p>
	 * Field or fields to convert to the identifying string
	 * </p>
	 * @return string a string that describes the index.
	 */
	protected static function toIndexString ($keys) {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Performs an operation similar to SQL's GROUP BY command
	 * @link http://php.net/manual/en/mongocollection.group.php
	 * @param mixed $keys <p>
	 * Fields to group by. If an array or non-code object is passed, it will be
	 * the key used to group results.
	 * </p>
	 * <p>1.0.4+: If <i>keys</i> is an instance of
	 * <b>MongoCode</b>, <i>keys</i> will be treated as
	 * a function that returns the key to group by (see the "Passing a
	 * <i>keys</i> function" example below).
	 * </p>
	 * @param array $initial <p>
	 * Initial value of the aggregation counter object.
	 * </p>
	 * @param MongoCode $reduce <p>
	 * A function that takes two arguments (the current document and the
	 * aggregation to this point) and does the aggregation.
	 * </p>
	 * @param array $options [optional] <p>
	 * Optional parameters to the group command. Valid options include:
	 * </p>
	 * <p>
	 * "condition"
	 * </p>
	 * <p>
	 * Criteria for including a document in the aggregation.
	 * </p>
	 * @return array an array containing the result.
	 */
	public function group ($keys, array $initial, MongoCode $reduce, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=1.2.11)<br/>
	 * Retrieve a list of distinct values for the given key across a collection.
	 * @link http://php.net/manual/en/mongocollection.distinct.php
	 * @param string $key <p>
	 * The key to use.
	 * </p>
	 * @param array $query [optional] <p>
	 * An optional query parameters
	 * </p>
	 * @return array an array of distinct values, or <b>FALSE</b> on failure
	 */
	public function distinct ($key, array $query = null) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Perform an aggregation using the aggregation framework
	 * @link http://php.net/manual/en/mongocollection.aggregate.php
	 * @param array $pipeline <p>
	 * An array of pipeline operators.
	 * </p>
	 * @param array $options [optional] <p>Options for the aggregation command. Valid options include:</p>
	 * <p>"allowDiskUse"</p>
	 * <p>Allow aggregation stages to write to temporary files</p>
	 * @return array The result of the aggregation as an array. The ok will
	 * be set to 1 on success, 0 on failure.
	 */
	public function aggregate (array $pipeline, array $options = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Execute an aggregation pipeline command and retrieve results through a cursor
	 * @link http://php.net/manual/en/mongocollection.aggregatecursor.php
	 * @param array $command
	 * @param array $options [optional] <p>Options for the aggregation command. Valid options include:</p>
	 * <p>"allowDiskUse"</p>
	 * <p>Allow aggregation stages to write to temporary files</p>
	 * @return MongoCommandCursor a <b>MongoCommandCursor</b> object. Because this
	 * implements the <b>Iterator</b> interface you can
	 * iterate over each of the results as returned by the command query. The
	 * <b>MongoCommandCursor</b> also implements the
	 * <b>MongoCursorInterface</b> interface which adds the
	 * <b>MongoCommandCursor::batchSize</b>,
	 * <b>MongoCommandCursor::dead</b>,
	 * <b>MongoCommandCursor::info</b> methods.
	 */
	public function aggregateCursor (array $command, array $options = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Returns an array of cursors to iterator over a full collection in parallel
	 * @link http://php.net/manual/en/mongocollection.parallelcollectionscan.php
	 * @param int $num_cursors <p>
	 * The number of cursors to request from the server. Please note, that the
	 * server can return less cursors than you requested.
	 * </p>
	 * @return array[MongoCommandCursor] an array of <b>MongoCommandCursor</b> objects.
	 */
	public function parallelCollectionScan ($num_cursors) {}

}

/**
 * Interface for cursors, which can be used to iterate through results of a
 * database query or command. This interface is implemented by the
 * <b>MongoCursor</b> and
 * <b>MongoCommandCursor</b> classes.
 * @link http://php.net/manual/en/class.mongocursorinterface.php
 */
interface MongoCursorInterface extends Iterator, Traversable {

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Limits the number of elements returned in one batch.
	 * @link http://php.net/manual/en/mongocursorinterface.batchsize.php
	 * @param int $batchSize <p>
	 * The number of results to return per batch.
	 * </p>
	 * @return MongoCursorInterface this cursor.
	 */
	abstract public function batchSize ($batchSize);

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Gets information about the cursor's creation and iteration
	 * @link http://php.net/manual/en/mongocursorinterface.info.php
	 * @return array the namespace, batch size, limit, skip, flags, query, and projected
	 * fields for this cursor. If the cursor has started iterating, additional
	 * information about iteration and the connection will be included.
	 */
	abstract public function info ();

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Checks if there are results that have not yet been sent from the database
	 * @link http://php.net/manual/en/mongocursorinterface.dead.php
	 * @return bool <b>TRUE</b> if there are more results that have not yet been sent to the
	 * client, and <b>FALSE</b> otherwise.
	 */
	abstract public function dead ();

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Sets a client-side timeout for this query
	 * @link http://php.net/manual/en/mongocursorinterface.timeout.php
	 * @param int $ms <p>
	 * The number of milliseconds for the cursor to wait for a response. Use
	 * -1 to wait forever. By default, the cursor will wait
	 * 30000 milliseconds (30 seconds).
	 * </p>
	 * @return MongoCursorInterface this cursor.
	 */
	abstract public function timeout ($ms);

	/**
	 * (PECL mongo &gt;=1.6.0)<br/>
	 * Get the read preference for this query
	 * @link http://php.net/manual/en/mongocursorinterface.getreadpreference.php
	 * @return array
	 */
	abstract public function getReadPreference ();

	/**
	 * (PECL mongo &gt;=1.6.0)<br/>
	 * Set the read preference for this query
	 * @link http://php.net/manual/en/mongocursorinterface.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return MongoCursorInterface this cursor.
	 */
	abstract public function setReadPreference ($read_preference, array $tags = null);

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Return the current element
	 * @link http://php.net/manual/en/iterator.current.php
	 * @return mixed Can return any type.
	 */
	abstract public function current ();

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Move forward to next element
	 * @link http://php.net/manual/en/iterator.next.php
	 * @return void Any returned value is ignored.
	 */
	abstract public function next ();

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Return the key of the current element
	 * @link http://php.net/manual/en/iterator.key.php
	 * @return scalar scalar on success, or <b>NULL</b> on failure.
	 */
	abstract public function key ();

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Checks if current position is valid
	 * @link http://php.net/manual/en/iterator.valid.php
	 * @return boolean The return value will be casted to boolean and then evaluated.
	 * Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	abstract public function valid ();

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Rewind the Iterator to the first element
	 * @link http://php.net/manual/en/iterator.rewind.php
	 * @return void Any returned value is ignored.
	 */
	abstract public function rewind ();

}

/**
 * A cursor is used to iterate through the results of a database query. For
 * example, to query the database and see all results, you could do:
 * <b>MongoCursor</b> basic usage
 * <code>
 * $cursor = $collection->find();
 * var_dump(iterator_to_array($cursor));
 * </code>
 * @link http://php.net/manual/en/class.mongocursor.php
 */
class MongoCursor implements MongoCursorInterface, Traversable, Iterator {
	/**
	 * @var boolean
	 */
	public static $slaveOkay;
	/**
	 * @var integer
	 */
	public static $timeout;


	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Create a new cursor
	 * @link http://php.net/manual/en/mongocursor.construct.php
	 * @param MongoClient $connection <p>
	 * Database connection.
	 * </p>
	 * @param string $ns <p>
	 * Full name of database and collection.
	 * </p>
	 * @param array $query [optional] <p>
	 * Database query.
	 * </p>
	 * @param array $fields [optional] <p>
	 * Fields to return.
	 * </p>
	 */
	public function __construct (MongoClient $connection, $ns, array $query = 'array()', array $fields = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Checks if there are any more elements in this cursor
	 * @link http://php.net/manual/en/mongocursor.hasnext.php
	 * @return bool if there is another element.
	 */
	public function hasNext () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Advances the cursor to the next result, and returns that result
	 * @link http://php.net/manual/en/mongocursor.getnext.php
	 * @return array
	 */
	public function getNext () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Limits the number of results returned
	 * @link http://php.net/manual/en/mongocursor.limit.php
	 * @param int $num <p>
	 * The number of results to return.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function limit ($num) {}

	/**
	 * (PECL mongo &gt;=1.0.11)<br/>
	 * Limits the number of elements returned in one batch.
	 * @link http://php.net/manual/en/mongocursor.batchsize.php
	 * @param int $batchSize <p>
	 * The number of results to return per batch. Each batch requires a
	 * round-trip to the server.
	 * </p>
	 * <p>
	 * If <i>batchSize</i> is 2 or
	 * more, it represents the size of each batch of objects retrieved.
	 * It can be adjusted to optimize performance and limit data transfer.
	 * </p>
	 * <p>
	 * If <i>batchSize</i> is 1 or negative, it
	 * will limit of number returned documents to the absolute value of batchSize,
	 * and the cursor will be closed. For example if
	 * batchSize is -10, then the server will return a maximum
	 * of 10 documents and as many as can fit in 4MB, then close the cursor.
	 * </p>
	 * <p>
	 * A <i>batchSize</i> of 1 is special, and
	 * means the same as -1, i.e. a value of
	 * 1 makes the cursor only capable of returning
	 * one document.
	 * </p>
	 * <p>
	 * Note that this feature is different from
	 * <b>MongoCursor::limit</b> in that documents must fit within a
	 * maximum size, and it removes the need to send a request to close the cursor
	 * server-side. The batch size can be changed even after a cursor is iterated,
	 * in which case the setting will apply on the next batch retrieval.
	 * </p>
	 * <p>
	 * This cannot override MongoDB's limit on the amount of data it will return to
	 * the client (i.e., if you set batch size to 1,000,000,000, MongoDB will still
	 * only return 4-16MB of results per batch).
	 * </p>
	 * <p>
	 * To ensure consistent behavior, the rules of
	 * <b>MongoCursor::batchSize</b> and
	 * <b>MongoCursor::limit</b> behave a
	 * little complex but work "as expected". The rules are: hard limits override
	 * soft limits with preference given to <b>MongoCursor::limit</b>
	 * over <b>MongoCursor::batchSize</b>. After that, whichever is
	 * set and lower than the other will take precedence. See below.
	 * section for some examples.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function batchSize ($batchSize) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Skips a number of results
	 * @link http://php.net/manual/en/mongocursor.skip.php
	 * @param int $num <p>
	 * The number of results to skip.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function skip ($num) {}

	/**
	 * (PECL mongo &gt;=1.0.6)<br/>
	 * Sets the fields for a query
	 * @link http://php.net/manual/en/mongocursor.fields.php
	 * @param array $f <p>
	 * Fields to return (or not return).
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function fields (array $f) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Sets a server-side timeout for this query
	 * @link http://php.net/manual/en/mongocursor.maxtimems.php
	 * @param int $ms <p>
	 * Specifies a cumulative time limit in milliseconds to be allowed by the
	 * server for processing operations on the cursor.
	 * </p>
	 * @return MongoCursor This cursor.
	 */
	public function maxTimeMS ($ms) {}

	/**
	 * (PECL mongo &gt;=1.0.4)<br/>
	 * Adds a top-level key/value pair to a query
	 * @link http://php.net/manual/en/mongocursor.addoption.php
	 * @param string $key <p>
	 * Fieldname to add.
	 * </p>
	 * @param mixed $value <p>
	 * Value to add.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function addOption ($key, $value) {}

	/**
	 * (PECL mongo &gt;=0.9.4)<br/>
	 * Use snapshot mode for the query
	 * @link http://php.net/manual/en/mongocursor.snapshot.php
	 * @return MongoCursor this cursor.
	 */
	public function snapshot () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Sorts the results by given fields
	 * @link http://php.net/manual/en/mongocursor.sort.php
	 * @param array $fields <p>
	 * An array of fields by which to sort. Each element in the array has as
	 * key the field name, and as value either 1 for
	 * ascending sort, or -1 for descending sort.
	 * </p>
	 * <p>
	 * Each result is first sorted on the first field in the array, then (if
	 * it exists) on the second field in the array, etc. This means that the
	 * order of the fields in the <i>fields</i> array is
	 * important. See also the examples section.
	 * </p>
	 * @return MongoCursor the same cursor that this method was called on.
	 */
	public function sort (array $fields) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Gives the database a hint about the query
	 * @link http://php.net/manual/en/mongocursor.hint.php
	 * @param mixed $index <p>
	 * Index to use for the query. If a string is passed, it should correspond
	 * to an index name. If an array or object is passed, it should correspond
	 * to the specification used to create the index (i.e. the first argument
	 * to <b>MongoCollection::ensureIndex</b>).
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function hint ($index) {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Return an explanation of the query, often useful for optimization and debugging
	 * @link http://php.net/manual/en/mongocursor.explain.php
	 * @return array an explanation of the query.
	 */
	public function explain () {}

	/**
	 * (PECL mongo &gt;=1.2.11)<br/>
	 * Sets arbitrary flags in case there is no method available the specific flag
	 * @link http://php.net/manual/en/mongocursor.setflag.php
	 * @param int $flag <p>
	 * Which flag to set. You can not set flag 6 (EXHAUST) as the driver does
	 * not know how to handle them. You will get a warning if you try to use
	 * this flag. For available flags, please refer to the wire protocol
	 * documentation.
	 * </p>
	 * @param bool $set [optional] <p>
	 * Whether the flag should be set (<b>TRUE</b>) or unset (<b>FALSE</b>).
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function setFlag ($flag, $set = true) {}

	/**
	 * (PECL mongo &gt;=0.9.4)<br/>
	 * Sets whether this query can be done on a secondary [deprecated]
	 * @link http://php.net/manual/en/mongocursor.slaveokay.php
	 * @param bool $okay [optional] <p>
	 * If it is okay to query the secondary.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function slaveOkay ($okay = true) {}

	/**
	 * (PECL mongo &gt;=0.9.4)<br/>
	 * Sets whether this cursor will be left open after fetching the last results
	 * @link http://php.net/manual/en/mongocursor.tailable.php
	 * @param bool $tail [optional] <p>
	 * If the cursor should be tailable.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function tailable ($tail = true) {}

	/**
	 * (PECL mongo &gt;=1.0.1)<br/>
	 * Sets whether this cursor will timeout
	 * @link http://php.net/manual/en/mongocursor.immortal.php
	 * @param bool $liveForever [optional] <p>
	 * If the cursor should be immortal.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function immortal ($liveForever = true) {}

	/**
	 * (PECL mongo &gt;=1.2.11)<br/>
	 * Sets whether this cursor will wait for a while for a tailable cursor to return more data
	 * @link http://php.net/manual/en/mongocursor.awaitdata.php
	 * @param bool $wait [optional] <p>
	 * If the cursor should wait for more data to become available.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function awaitData ($wait = true) {}

	/**
	 * (PECL mongo &gt;=1.2.0)<br/>
	 * If this query should fetch partial results from mongos if a shard is down
	 * @link http://php.net/manual/en/mongocursor.partial.php
	 * @param bool $okay [optional] <p>
	 * If receiving partial results is okay.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function partial ($okay = true) {}

	/**
	 * (PECL mongo &gt;=1.3.3)<br/>
	 * Get the read preference for this query
	 * @link http://php.net/manual/en/mongocursor.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.3.3)<br/>
	 * Set the read preference for this query
	 * @link http://php.net/manual/en/mongocursor.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return MongoCursor this cursor.
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0 &lt;1.6.0)<br/>
	 * Execute the query.
	 * @link http://php.net/manual/en/mongocursor.doquery.php
	 * @return void <b>NULL</b>.
	 */
	final protected function doQuery () {}

	/**
	 * (PECL mongo &gt;=1.0.3)<br/>
	 * Sets a client-side timeout for this query
	 * @link http://php.net/manual/en/mongocursor.timeout.php
	 * @param int $ms <p>
	 * The number of milliseconds for the cursor to wait for a response. Use
	 * -1 to wait forever. By default, the cursor will wait
	 * 30000 milliseconds (30 seconds).
	 * </p>
	 * @return MongoCursor This cursor.
	 */
	public function timeout ($ms) {}

	/**
	 * (PECL mongo &gt;=1.0.5)<br/>
	 * Gets information about the cursor's creation and iteration
	 * @link http://php.net/manual/en/mongocursor.info.php
	 * @return array the namespace, batch size, limit, skip, flags, query, and projected
	 * fields for this cursor. If the cursor has started iterating, additional
	 * information about iteration and the connection will be included.
	 */
	public function info () {}

	/**
	 * (PECL mongo &gt;=0.9.6)<br/>
	 * Checks if there are results that have not yet been sent from the database
	 * @link http://php.net/manual/en/mongocursor.dead.php
	 * @return bool <b>TRUE</b> if there are more results that have not yet been sent to the
	 * client, and <b>FALSE</b> otherwise.
	 */
	public function dead () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns the current element
	 * @link http://php.net/manual/en/mongocursor.current.php
	 * @return array The current result document as an associative array. <b>NULL</b> will be returned
	 * if there is no result.
	 */
	public function current () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns the current result&#x00027;s _id, or its index within the result set
	 * @link http://php.net/manual/en/mongocursor.key.php
	 * @return string|int The current result&#x00027;s _id as a string. If the result
	 * has no _id, its numeric index within the result set will
	 * be returned as an integer.
	 */
	public function key () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Advances the cursor to the next result, and returns that result
	 * @link http://php.net/manual/en/mongocursor.next.php
	 * @return array the next document.
	 */
	public function next () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns the cursor to the beginning of the result set
	 * @link http://php.net/manual/en/mongocursor.rewind.php
	 * @return void <b>NULL</b>.
	 */
	public function rewind () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Checks if the cursor is reading a valid result.
	 * @link http://php.net/manual/en/mongocursor.valid.php
	 * @return bool <b>TRUE</b> if the current result is not null, and <b>FALSE</b> otherwise.
	 */
	public function valid () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Clears the cursor
	 * @link http://php.net/manual/en/mongocursor.reset.php
	 * @return void <b>NULL</b>.
	 */
	public function reset () {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Counts the number of results for this query
	 * @link http://php.net/manual/en/mongocursor.count.php
	 * @param bool $foundOnly [optional] <p>
	 * Send cursor limit and skip information to the count function, if applicable.
	 * </p>
	 * @return int The number of documents returned by this cursor's query.
	 */
	public function count ($foundOnly = false) {}

}

/**
 * A command cursor is similar to a <b>MongoCursor</b> except
 * that you use it for iterating through the results of a database command
 * instead of a normal query. Command cursors are useful for iterating over
 * large result sets that might exceed the document size limit (currently 16MB)
 * of a single <b>MongoDB::command</b> response.
 * @link http://php.net/manual/en/class.mongocommandcursor.php
 */
class MongoCommandCursor implements MongoCursorInterface, Traversable, Iterator {

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Create a new command cursor
	 * @link http://php.net/manual/en/mongocommandcursor.construct.php
	 * @param MongoClient $connection <p>
	 * Database connection.
	 * </p>
	 * @param string $ns <p>
	 * Full name of the database and collection (e.g.
	 * "test.foo")
	 * </p>
	 * @param array $command [optional] <p>
	 * Database command.
	 * </p>
	 */
	public function __construct (MongoClient $connection, $ns, array $command = 'array()') {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Limits the number of elements returned in one batch.
	 * @link http://php.net/manual/en/mongocommandcursor.batchsize.php
	 * @param int $batchSize <p>
	 * The number of results to return per batch. Each batch requires a
	 * round-trip to the server.
	 * </p>
	 * <p>
	 * This cannot override MongoDB's limit on the amount of data it will return to
	 * the client (i.e., if you set batch size to 1,000,000,000, MongoDB will still
	 * only return 4-16MB of results per batch).
	 * </p>
	 * @return MongoCommandCursor this cursor.
	 */
	public function batchSize ($batchSize) {}

	/**
	 * (PECL mongo &gt;=1.6.0)<br/>
	 * Sets a client-side timeout for this command
	 * @link http://php.net/manual/en/mongocommandcursor.timeout.php
	 * @param int $ms <p>
	 * The number of milliseconds for the cursor to wait for a response. Use
	 * -1 to wait forever. By default, the cursor will wait
	 * 30000 milliseconds (30 seconds).
	 * </p>
	 * @return MongoCommandCursor This cursor.
	 */
	public function timeout ($ms) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Gets information about the cursor's creation and iteration
	 * @link http://php.net/manual/en/mongocommandcursor.info.php
	 * @return array the namespace, batch size, limit, skip, flags, query, and projected
	 * fields for this cursor. If the cursor has started iterating, additional
	 * information about iteration and the connection will be included.
	 */
	public function info () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Checks if there are results that have not yet been sent from the database
	 * @link http://php.net/manual/en/mongocommandcursor.dead.php
	 * @return bool <b>TRUE</b> if there are more results that have not yet been sent to the
	 * client, and <b>FALSE</b> otherwise.
	 */
	public function dead () {}

	/**
	 * (PECL mongo &gt;=1.6.0)<br/>
	 * Get the read preference for this command
	 * @link http://php.net/manual/en/mongocommandcursor.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.6.0)<br/>
	 * Set the read preference for this command
	 * @link http://php.net/manual/en/mongocommandcursor.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return MongoCommandCursor this cursor.
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Returns the current element
	 * @link http://php.net/manual/en/mongocommandcursor.current.php
	 * @return array The current result document as an associative array. <b>NULL</b> will be returned
	 * if there is no result.
	 */
	public function current () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Returns the current result&#x00027;s index within the result set
	 * @link http://php.net/manual/en/mongocommandcursor.key.php
	 * @return int The current result&#x00027;s index within the result set.
	 */
	public function key () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Advances the cursor to the next result
	 * @link http://php.net/manual/en/mongocommandcursor.next.php
	 * @return void <b>NULL</b>.
	 */
	public function next () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Executes the command and resets the cursor to the start of the result set
	 * @link http://php.net/manual/en/mongocommandcursor.rewind.php
	 * @return array The raw server result document.
	 */
	public function rewind () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Checks if the cursor is reading a valid result.
	 * @link http://php.net/manual/en/mongocommandcursor.valid.php
	 * @return bool <b>TRUE</b> if the current result is not null, and <b>FALSE</b> otherwise.
	 */
	public function valid () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Create a new command cursor from an existing command response document
	 * @link http://php.net/manual/en/mongocommandcursor.createfromdocument.php
	 * @param MongoClient $connection <p>
	 * Database connection.
	 * </p>
	 * @param string $hash <p>
	 * The connection hash, as obtained through the third by-reference argument
	 * to <b>MongoDB::command</b>.
	 * </p>
	 * @param array $document <p>
	 * Document with cursor information in it. This document needs to contain
	 * the id, ns and
	 * firstBatch fields. Such a document is obtained by
	 * calling the <b>MongoDB::command</b> with appropriate
	 * arguments to return a cursor, and not just an inline result. See the
	 * example below.
	 * </p>
	 * @return MongoCommandCursor the new cursor.
	 */
	public static function createFromDocument (MongoClient $connection, $hash, array $document) {}

}

/**
 * Utilities for storing and retrieving files from the database.
 * @link http://php.net/manual/en/class.mongogridfs.php
 */
class MongoGridFS extends MongoCollection  {
	const ASCENDING = 1;
	const DESCENDING = -1;

	/**
	 * @var integer
	 */
	public $w;
	/**
	 * @var integer
	 */
	public $wtimeout;
	public $chunks;
	protected $filesName;
	protected $chunksName;


	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates new file collections
	 * @link http://php.net/manual/en/mongogridfs.construct.php
	 * @param MongoDB $db <p>
	 * Database.
	 * </p>
	 * @param string $prefix [optional]
	 * @param mixed $chunks [optional]
	 */
	public function __construct (MongoDB $db, $prefix = 'fs', $chunks = 'fs') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Drops the files and chunks collections
	 * @link http://php.net/manual/en/mongogridfs.drop.php
	 * @return array The database response.
	 */
	public function drop () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Queries for files
	 * @link http://php.net/manual/en/mongogridfs.find.php
	 * @param array $query [optional] <p>
	 * The query.
	 * </p>
	 * @param array $fields [optional] <p>
	 * Fields to return.
	 * </p>
	 * @return MongoGridFSCursor A <b>MongoGridFSCursor</b>.
	 */
	public function find (array $query = 'array()', array $fields = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Stores a file in the database
	 * @link http://php.net/manual/en/mongogridfs.storefile.php
	 * @param string|resource $filename <p>
	 * Name of the file or a readable stream to store.
	 * </p>
	 * @param array $metadata [optional] <p>
	 * Other metadata fields to include in the file document.
	 * </p>
	 * <p>These fields may also overwrite those that would be created automatically by the driver, as described in the MongoDB core documentation for the files collection. Some practical use cases for this behavior would be to specify a custom chunkSize or _id for the file.</p>
	 * @param array $options [optional] <p>
	 * An array of options for the insert operations executed against the
	 * chunks and files collections. See
	 * <b>MongoCollection::insert</b> for documentation on these
	 * these options.
	 * </p>
	 * @return mixed
	 */
	public function storeFile ($filename, array $metadata = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Stores a string of bytes in the database
	 * @link http://php.net/manual/en/mongogridfs.storebytes.php
	 * @param string $bytes <p>
	 * String of bytes to store.
	 * </p>
	 * @param array $metadata [optional] <p>
	 * Other metadata fields to include in the file document.
	 * </p>
	 * <p>These fields may also overwrite those that would be created automatically by the driver, as described in the MongoDB core documentation for the files collection. Some practical use cases for this behavior would be to specify a custom chunkSize or _id for the file.</p>
	 * @param array $options [optional] <p>
	 * An array of options for the insert operations executed against the
	 * chunks and files collections. See
	 * <b>MongoCollection::insert</b> for documentation on these
	 * these options.
	 * </p>
	 * @return mixed
	 */
	public function storeBytes ($bytes, array $metadata = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns a single file matching the criteria
	 * @link http://php.net/manual/en/mongogridfs.findone.php
	 * @param mixed $query [optional] <p>
	 * The filename or criteria for which to search.
	 * </p>
	 * @param mixed $fields [optional]
	 * @return MongoGridFSFile a <b>MongoGridFSFile</b> or <b>NULL</b>.
	 */
	public function findOne ($query = 'array()', $fields = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Remove files and their chunks from the database
	 * @link http://php.net/manual/en/mongogridfs.remove.php
	 * @param array $criteria [optional] <p>
	 * The filename or criteria for which to search.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the remove operations executed against the
	 * chunks and files collections. See
	 * <b>MongoCollection::remove</b> for documentation on these
	 * options.
	 * </p>
	 * @return bool|array an array containing the status of the removal (with respect to the
	 * files collection) if the "w" option is
	 * set. Otherwise, returns <b>TRUE</b>.
	 * </p>
	 * <p>
	 * Fields in the status array are described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function remove (array $criteria = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Stores an uploaded file in the database
	 * @link http://php.net/manual/en/mongogridfs.storeupload.php
	 * @param string $name <p>
	 * The name of the uploaded file(s) to store. This should correspond to the
	 * file field's name attribute in the HTML form.
	 * </p>
	 * @param array $metadata [optional] <p>
	 * Other metadata fields to include in the file document.
	 * </p>
	 * <p>These fields may also overwrite those that would be created automatically by the driver, as described in the MongoDB core documentation for the files collection. Some practical use cases for this behavior would be to specify a custom chunkSize or _id for the file.</p>
	 * <p>
	 * The filename field will be populated with the
	 * client's filename (e.g. $_FILES['foo']['name']).
	 * </p>
	 * @return mixed If multiple files are uploaded
	 * using the same field name, this method will not return anything;
	 * however, the files themselves will still be processed.
	 */
	public function storeUpload ($name, array $metadata = null) {}

	/**
	 * (PECL mongo &gt;=1.0.8)<br/>
	 * Remove a file and its chunks from the database
	 * @link http://php.net/manual/en/mongogridfs.delete.php
	 * @param mixed $id <p>
	 * _id of the file to remove.
	 * </p>
	 * @return bool|array an array containing the status of the removal (with respect to the
	 * files collection) if a
	 * write concern is applied.
	 * Otherwise, returns <b>TRUE</b>.
	 * </p>
	 * <p>
	 * Fields in the status array are described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function delete ($id) {}

	/**
	 * (PECL mongo &gt;=1.0.8)<br/>
	 * Retrieve a file from the database
	 * @link http://php.net/manual/en/mongogridfs.get.php
	 * @param mixed $id <p>
	 * _id of the file to find.
	 * </p>
	 * @return MongoGridFSFile the file, if found, or <b>NULL</b>.
	 */
	public function get ($id) {}

	/**
	 * (PECL mongo &gt;=1.0.8)<br/>
	 * Stores a file in the database
	 * @link http://php.net/manual/en/mongogridfs.put.php
	 * @param string $filename <p>
	 * Name of the file to store.
	 * </p>
	 * @param array $metadata [optional] <p>
	 * Other metadata fields to include in the file document.
	 * </p>
	 * <p>These fields may also overwrite those that would be created automatically by the driver, as described in the MongoDB core documentation for the files collection. Some practical use cases for this behavior would be to specify a custom chunkSize or _id for the file.</p>
	 * @param array $options [optional] <p>
	 * An array of options for the insert operations executed against the
	 * chunks and files collections. See
	 * <b>MongoCollection::insert</b> for documentation on these
	 * these options.
	 * </p>
	 * @return mixed
	 */
	public function put ($filename, array $metadata = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * String representation of this collection
	 * @link http://php.net/manual/en/mongocollection.--tostring.php
	 * @return string the full name of this collection.
	 */
	public function __toString () {}

	/**
	 * (PECL mongo &gt;=1.0.2)<br/>
	 * Gets a collection
	 * @link http://php.net/manual/en/mongocollection.get.php
	 * @param string $name <p>
	 * The next string in the collection name.
	 * </p>
	 * @return MongoCollection the collection.
	 */
	public function __get ($name) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns this collection&#x00027;s name
	 * @link http://php.net/manual/en/mongocollection.getname.php
	 * @return string the name of this collection.
	 */
	public function getName () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Get slaveOkay setting for this collection
	 * @link http://php.net/manual/en/mongocollection.getslaveokay.php
	 * @return bool the value of slaveOkay for this instance.
	 */
	public function getSlaveOkay () {}

	/**
	 * (PECL mongo &gt;=1.1.0)<br/>
	 * Change slaveOkay setting for this collection
	 * @link http://php.net/manual/en/mongocollection.setslaveokay.php
	 * @param bool $ok [optional] <p>
	 * If reads should be sent to secondary members of a replica set for all
	 * possible queries using this <b>MongoCollection</b>
	 * instance.
	 * </p>
	 * @return bool the former value of slaveOkay for this instance.
	 */
	public function setSlaveOkay ($ok = true) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Get the read preference for this collection
	 * @link http://php.net/manual/en/mongocollection.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Set the read preference for this collection
	 * @link http://php.net/manual/en/mongocollection.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return bool
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Get the write concern for this collection
	 * @link http://php.net/manual/en/mongocollection.getwriteconcern.php
	 * @return array
	 */
	public function getWriteConcern () {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Set the write concern for this database
	 * @link http://php.net/manual/en/mongocollection.setwriteconcern.php
	 * @param mixed $w
	 * @param int $wtimeout [optional]
	 * @return bool
	 */
	public function setWriteConcern ($w, $wtimeout = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Validates this collection
	 * @link http://php.net/manual/en/mongocollection.validate.php
	 * @param bool $scan_data [optional] <p>
	 * Only validate indices, not the base collection.
	 * </p>
	 * @return array the database&#x00027;s evaluation of this object.
	 */
	public function validate ($scan_data = false) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Inserts a document into the collection
	 * @link http://php.net/manual/en/mongocollection.insert.php
	 * @param array|object $document <p>
	 * An array or object. If an object is used, it may not have protected or
	 * private properties.
	 * </p>
	 * <p>
	 * If the parameter does not have an _id key or
	 * property, a new <b>MongoId</b> instance will be created
	 * and assigned to it. This special behavior does not mean that the
	 * parameter is passed by reference.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the insert operation. Currently available options
	 * include:
	 * <p>"fsync"</p><p>Boolean, defaults to <b>FALSE</b>. If journaling is enabled, it works exactly like "j". If journaling is not enabled, the write operation blocks until it is synced to database files on disk. If <b>TRUE</b>, an acknowledged insert is implied and this option will override setting "w" to 0.</p>If journaling is enabled, users are strongly encouraged to use the "j" option instead of "fsync". Do not use "fsync" and "j" simultaneously, as that will result in an error.
	 * <p>"j"</p><p>Boolean, defaults to <b>FALSE</b>. Forces the write operation to block until it is synced to the journal on disk. If <b>TRUE</b>, an acknowledged write is implied and this option will override setting "w" to 0.</p>If this option is used and journaling is disabled, MongoDB 2.6+ will raise an error and the write will fail; older server versions will simply ignore the option.
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * </p>
	 * <p>
	 * The following options are deprecated and should no longer be used:
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * </p>
	 * @return bool|array an array containing the status of the insertion if the
	 * "w" option is set. Otherwise, returns <b>TRUE</b> if the
	 * inserted array is not empty (a <b>MongoException</b> will be
	 * thrown if the inserted array is empty).
	 * </p>
	 * <p>
	 * If an array is returned, the following keys may be present:
	 * <i>ok</i>
	 * <p>
	 * This should almost always be 1 (unless last_error itself failed).
	 * </p>
	 * <i>err</i>
	 * <p>
	 * If this field is non-null, an error occurred on the previous operation.
	 * If this field is set, it will be a string describing the error that
	 * occurred.
	 * </p>
	 * <i>code</i>
	 * <p>
	 * If a database error occurred, the relevant error code will be passed
	 * back to the client.
	 * </p>
	 * <i>errmsg</i>
	 * <p>
	 * This field is set if something goes wrong with a database command. It
	 * is coupled with ok being 0. For example, if
	 * w is set and times out, errmsg will be set to "timed
	 * out waiting for slaves" and ok will be 0. If this
	 * field is set, it will be a string describing the error that occurred.
	 * </p>
	 * <i>n</i>
	 * <p>
	 * If the last operation was an update, upsert, or a remove, the number
	 * of documents affected will be returned. For insert operations, this value
	 * is always 0.
	 * </p>
	 * <i>wtimeout</i>
	 * <p>
	 * If the previous option timed out waiting for replication.
	 * </p>
	 * <i>waited</i>
	 * <p>
	 * How long the operation waited before timing out.
	 * </p>
	 * <i>wtime</i>
	 * <p>
	 * If w was set and the operation succeeded, how long it took to
	 * replicate to w servers.
	 * </p>
	 * <i>upserted</i>
	 * <p>
	 * If an upsert occurred, this field will contain the new record's
	 * _id field. For upserts, either this field or
	 * updatedExisting will be present (unless an error
	 * occurred).
	 * </p>
	 * <i>updatedExisting</i>
	 * <p>
	 * If an upsert updated an existing element, this field will be true. For
	 * upserts, either this field or upserted will be present (unless an error
	 * occurred).
	 * </p>
	 */
	public function insert ($document, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Inserts multiple documents into this collection
	 * @link http://php.net/manual/en/mongocollection.batchinsert.php
	 * @param array $a <p>
	 * An array of arrays or objects. If any objects are used, they may not have
	 * protected or private properties.
	 * </p>
	 * <p>
	 * If the documents to insert do not have an _id key or
	 * property, a new <b>MongoId</b> instance will be created
	 * and assigned to it. See <b>MongoCollection::insert</b> for
	 * additional information on this behavior.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the batch of insert operations. Currently
	 * available options include:
	 * <p>
	 * "continueOnError"
	 * </p>
	 * <p>
	 * Boolean, defaults to <b>FALSE</b>. If set, the database will not stop
	 * processing a bulk insert if one fails (eg due to duplicate IDs).
	 * This makes bulk insert behave similarly to a series of single
	 * inserts, except that calling <b>MongoDB::lastError</b>
	 * will have an error set if any insert fails, not just the last one.
	 * If multiple errors occur, only the most recent will be reported by
	 * <b>MongoDB::lastError</b>.
	 * </p>
	 * <p>
	 * Please note that continueOnError affects errors
	 * on the database side only. If you try to insert a document that has
	 * errors (for example it contains a key with an empty name), then the
	 * document is not even transferred to the database as the driver
	 * detects this error and bails out.
	 * continueOnError has no effect on errors detected
	 * in the documents by the driver.
	 * </p>
	 * @return mixed If the w parameter is set to acknowledge the write,
	 * returns an associative array with the status of the inserts ("ok") and any
	 * error that may have occurred ("err"). Otherwise, returns <b>TRUE</b> if the
	 * batch insert was successfully sent, <b>FALSE</b> otherwise.
	 */
	public function batchInsert (array $a, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Update records based on a given criteria
	 * @link http://php.net/manual/en/mongocollection.update.php
	 * @param array $criteria <p>
	 * Query criteria for the documents to update.
	 * </p>
	 * @param array $new_object <p>
	 * The object used to update the matched documents. This may either contain
	 * update operators (for modifying specific fields) or be a replacement
	 * document.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the update operation. Currently available options
	 * include:
	 * <p>
	 * "upsert"
	 * </p>
	 * <p>
	 * If no document matches <i>$criteria</i>, a new
	 * document will be inserted.
	 * </p>
	 * <p>
	 * If a new document would be inserted and
	 * <i>$new_object</i> contains atomic modifiers
	 * (i.e. $ operators), those operations will be
	 * applied to the <i>$criteria</i> parameter to create
	 * the new document. If <i>$new_object</i> does not
	 * contain atomic modifiers, it will be used as-is for the inserted
	 * document. See the upsert examples below for more information.
	 * </p>
	 * @return bool|array an array containing the status of the update if the
	 * "w" option is set. Otherwise, returns <b>TRUE</b>.
	 * </p>
	 * <p>
	 * Fields in the status array are described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function update (array $criteria, array $new_object, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Update a document and return it
	 * @link http://php.net/manual/en/mongocollection.findandmodify.php
	 * @param array $query <p>
	 * The query criteria to search for.
	 * </p>
	 * @param array $update [optional] <p>
	 * The update criteria.
	 * </p>
	 * @param array $fields [optional] <p>
	 * Optionally only return these fields.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options to apply, such as remove the match document from the
	 * DB and return it.
	 * <tr valign="top">
	 * <td>Option</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>sort array</td>
	 * <td>
	 * Determines which document the operation will modify if the
	 * query selects multiple documents. findAndModify will modify the
	 * first document in the sort order specified by this argument.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>remove boolean</td>
	 * <td>
	 * Optional if update field exists. When <b>TRUE</b>, removes the selected
	 * document. The default is <b>FALSE</b>.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>update array</td>
	 * <td>
	 * Optional if remove field exists.
	 * Performs an update of the selected document.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>new boolean</td>
	 * <td>
	 * Optional. When <b>TRUE</b>, returns the modified document rather than the
	 * original. The findAndModify method ignores the new option for
	 * remove operations. The default is <b>FALSE</b>.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>upsert boolean</td>
	 * <td>
	 * Optional. Used in conjunction with the update field. When <b>TRUE</b>, the
	 * findAndModify command creates a new document if the query returns
	 * no documents. The default is false. In MongoDB 2.2, the
	 * findAndModify command returns <b>NULL</b> when upsert is <b>TRUE</b>.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td></td>
	 * <td>
	 * </td>
	 * </tr>
	 * </p>
	 * @return array the original document, or the modified document when
	 * new is set.
	 */
	public function findAndModify (array $query, array $update = null, array $fields = null, array $options = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Creates an index on the specified field(s) if it does not already exist.
	 * @link http://php.net/manual/en/mongocollection.createindex.php
	 * @param array $keys <p>
	 * An array specifying the index's fields as its keys. For each field, the
	 * value is either the index direction or
	 * index type.
	 * If specifying direction, specify 1 for ascending or
	 * -1 for descending.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the index creation. We pass all given options
	 * straight to the server, but a non-exhaustive list of currently
	 * available options include:
	 * <p>"unique"</p><p>Specify <b>TRUE</b> to create a unique index. The default value is <b>FALSE</b>. This option applies only to ascending/descending indexes.</p><p>When MongoDB indexes a field, if a document does not have a value for the field, a <b>NULL</b> value is indexed. If multiple documents do not contain a field, a unique index will reject all but the first of those documents. The "sparse" option may be used to overcome this, since it will prevent documents without the field from being indexed.</p>
	 * <p>"sparse"</p><p>Specify <b>TRUE</b> to create a sparse index, which only indexes documents containing a specified field. The default value is <b>FALSE</b>.</p>
	 * <p>"expireAfterSeconds"</p><p>The value of this option should specify the number of seconds after which a document should be considered expired and automatically removed from the collection. This option is only compatible with single-field indexes where the field will contain <b>MongoDate</b> values.</p><p>This feature is available in MongoDB 2.2+. See Expire Data from Collections by Setting TTL for more information.</p>
	 * <p>"name"</p><p>A optional name that uniquely identifies the index.</p><p>By default, the driver will generate an index name based on the index&#x00027;s field(s) and ordering or type. For example, a compound index array("x" => 1, "y" => -1) would be named "x_1_y_-1" and a geospatial index array("loc" => "2dsphere") would be named "loc_2dsphere". For indexes with many fields, it is possible that the generated name might exceed MongoDB&#x00027;s limit for index names. The "name" option may be used in that case to supply a shorter name.</p>
	 * <p>"background"</p><p>Builds the index in the background so that building an index does not block other database activities. Specify <b>TRUE</b> to build in the background. The default value is <b>FALSE</b>.</p><p>Prior to MongoDB 2.6.0, index builds on secondaries were executed as foreground operations, irrespective of this option. See Building Indexes with Replica Sets for more information.</p>
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * </p>
	 * <p>
	 * The following option may be used with MongoDB 2.6+:
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.8:
	 * <p>"dropDups"</p><p>Specify <b>TRUE</b> to force creation of a unique index where the collection may contain duplicate values for a key. MongoDB will index the first occurrence of a key and delete all subsequent documents from the collection that contain a duplicate value for that key. The default value is <b>FALSE</b>.</p><p>"dropDups" may delete data from your database. Use with extreme caution.</p><p>This option is not supported on MongoDB 2.8+. Index creation will fail if the collection contains duplicate values.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.6:
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * </p>
	 * <p>
	 * The following options are deprecated and should no longer be used:
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * </p>
	 * @return bool an array containing the status of the index creation. The array
	 * contains whether the operation succeeded ("ok"), the
	 * number of indexes before and after the operation
	 * ("numIndexesBefore" and
	 * "numIndexesAfter"), and whether the collection that the
	 * index belongs to has been created
	 * ("createdCollectionAutomatically"). If the index already
	 * existed and did not need to be created, a "note" field may
	 * be present in lieu of "numIndexesAfter".
	 * </p>
	 * <p>
	 * With MongoDB 2.4 and earlier, a status document is only returned if the
	 * write concern is at least
	 * 1. Otherwise, <b>TRUE</b> is returned. The fields in the status
	 * document are different, except for the "ok" field, which
	 * signals whether the index creation was successful. Additional fields are
	 * described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function createIndex (array $keys, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates an index on the specified field(s) if it does not already exist.
	 * @link http://php.net/manual/en/mongocollection.ensureindex.php
	 * @param string|array $key_keys
	 * @param array $options [optional] <p>
	 * An array of options for the index creation. Currently available options
	 * include:
	 * <p>"unique"</p><p>Specify <b>TRUE</b> to create a unique index. The default value is <b>FALSE</b>. This option applies only to ascending/descending indexes.</p><p>When MongoDB indexes a field, if a document does not have a value for the field, a <b>NULL</b> value is indexed. If multiple documents do not contain a field, a unique index will reject all but the first of those documents. The "sparse" option may be used to overcome this, since it will prevent documents without the field from being indexed.</p>
	 * <p>"sparse"</p><p>Specify <b>TRUE</b> to create a sparse index, which only indexes documents containing a specified field. The default value is <b>FALSE</b>.</p>
	 * <p>"expireAfterSeconds"</p><p>The value of this option should specify the number of seconds after which a document should be considered expired and automatically removed from the collection. This option is only compatible with single-field indexes where the field will contain <b>MongoDate</b> values.</p><p>This feature is available in MongoDB 2.2+. See Expire Data from Collections by Setting TTL for more information.</p>
	 * <p>"name"</p><p>A optional name that uniquely identifies the index.</p><p>By default, the driver will generate an index name based on the index&#x00027;s field(s) and ordering or type. For example, a compound index array("x" => 1, "y" => -1) would be named "x_1_y_-1" and a geospatial index array("loc" => "2dsphere") would be named "loc_2dsphere". For indexes with many fields, it is possible that the generated name might exceed MongoDB&#x00027;s limit for index names. The "name" option may be used in that case to supply a shorter name.</p>
	 * <p>"background"</p><p>Builds the index in the background so that building an index does not block other database activities. Specify <b>TRUE</b> to build in the background. The default value is <b>FALSE</b>.</p><p>Prior to MongoDB 2.6.0, index builds on secondaries were executed as foreground operations, irrespective of this option. See Building Indexes with Replica Sets for more information.</p>
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * </p>
	 * <p>
	 * The following option may be used with MongoDB 2.6+:
	 * <p>"maxTimeMS"</p><p>Specifies a cumulative time limit in milliseconds for processing the operation (does not include idle time). If the operation is not completed within the timeout period, a <b>MongoExecutionTimeoutException</b> will be thrown.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.8:
	 * <p>"dropDups"</p><p>Specify <b>TRUE</b> to force creation of a unique index where the collection may contain duplicate values for a key. MongoDB will index the first occurrence of a key and delete all subsequent documents from the collection that contain a duplicate value for that key. The default value is <b>FALSE</b>.</p><p>"dropDups" may delete data from your database. Use with extreme caution.</p><p>This option is not supported on MongoDB 2.8+. Index creation will fail if the collection contains duplicate values.</p>
	 * </p>
	 * <p>
	 * The following options may be used with MongoDB versions before 2.6:
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * </p>
	 * <p>
	 * The following options are deprecated and should no longer be used:
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * </p>
	 * @return bool an array containing the status of the index creation. The array
	 * contains whether the operation succeeded ("ok"), the
	 * number of indexes before and after the operation
	 * ("numIndexesBefore" and
	 * "numIndexesAfter"), and whether the collection that the
	 * index belongs to has been created
	 * ("createdCollectionAutomatically"). If the index already
	 * existed and did not need to be created, a "note" field may
	 * be present in lieu of "numIndexesAfter".
	 * </p>
	 * <p>
	 * With MongoDB 2.4 and earlier, a status document is only returned if the
	 * write concern is at least
	 * 1. Otherwise, <b>TRUE</b> is returned. The fields in the status
	 * document are different, except for the "ok" field, which
	 * signals whether the index creation was successful. Additional fields are
	 * described in the documentation for
	 * <b>MongoCollection::insert</b>.
	 */
	public function ensureIndex ($key_keys, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Deletes an index from this collection
	 * @link http://php.net/manual/en/mongocollection.deleteindex.php
	 * @param string|array $keys <p>
	 * An array specifying the index's fields as its keys. For each field, the
	 * value is either the index direction or
	 * index type.
	 * If specifying direction, specify 1 for ascending or
	 * -1 for descending.
	 * </p>
	 * <p>
	 * If a string is provided, it is assumed to be the single field name in an
	 * ascending index.
	 * </p>
	 * @return array the database response.
	 */
	public function deleteIndex ($keys) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Delete all indices for this collection
	 * @link http://php.net/manual/en/mongocollection.deleteindexes.php
	 * @return array the database response.
	 */
	public function deleteIndexes () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns information about indexes on this collection
	 * @link http://php.net/manual/en/mongocollection.getindexinfo.php
	 * @return array This function returns an array in which each element describes an index.
	 * Elements will contain the values name for the name of
	 * the index, ns for the namespace (a combination of the
	 * database and collection name), and key for a list of all
	 * fields in the index and their ordering. Additional values may be present for
	 * special indexes, such as unique or
	 * sparse.
	 */
	public function getIndexInfo () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Counts the number of documents in this collection
	 * @link http://php.net/manual/en/mongocollection.count.php
	 * @param array $query [optional] <p>
	 * Associative array or object with fields to match.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options for the index creation. Currently available options
	 * include:
	 * <tr valign="top">
	 * <td>Name</td>
	 * <td>Type</td>
	 * <td>Description</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>hint</td>
	 * <td>mixed</td>
	 * <td>
	 * <p>
	 * Index to use for the query. If a string is passed, it should
	 * correspond to an index name. If an array or object is passed, it
	 * should correspond to the specification used to create the index
	 * (i.e. the first argument to
	 * <b>MongoCollection::createIndex</b>).
	 * </p>
	 * This option is only supported in MongoDB 2.6+.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>limit</td>
	 * <td>integer</td>
	 * <td>The maximum number of matching documents to return.</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>maxTimeMS</td>
	 * <td>integer</td>
	 * <td>
	 * <p>
	 * Specifies a cumulative time limit in milliseconds for processing
	 * the operation (does not include idle time). If the operation is not
	 * completed within the timeout period, a
	 * <b>MongoExecutionTimeoutException</b> will be
	 * thrown.
	 * </p>
	 * This option is only supported in MongoDB 2.6+.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>skip</td>
	 * <td>integer</td>
	 * <td>The number of matching documents to skip before returning results.</td>
	 * </tr>
	 * </p>
	 * @return int the number of documents matching the query.
	 */
	public function count (array $query = 'array()', array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Saves a document to this collection
	 * @link http://php.net/manual/en/mongocollection.save.php
	 * @param array|object $document <p>
	 * Array or object to save. If an object is used, it may not have protected
	 * or private properties.
	 * </p>
	 * <p>
	 * If the parameter does not have an _id key or
	 * property, a new <b>MongoId</b> instance will be created
	 * and assigned to it. See <b>MongoCollection::insert</b> for
	 * additional information on this behavior.
	 * </p>
	 * @param array $options [optional] <p>
	 * Options for the save.
	 * <p>"fsync"</p><p>Boolean, defaults to <b>FALSE</b>. If journaling is enabled, it works exactly like "j". If journaling is not enabled, the write operation blocks until it is synced to database files on disk. If <b>TRUE</b>, an acknowledged insert is implied and this option will override setting "w" to 0.</p>If journaling is enabled, users are strongly encouraged to use the "j" option instead of "fsync". Do not use "fsync" and "j" simultaneously, as that will result in an error.
	 * <p>"j"</p><p>Boolean, defaults to <b>FALSE</b>. Forces the write operation to block until it is synced to the journal on disk. If <b>TRUE</b>, an acknowledged write is implied and this option will override setting "w" to 0.</p>If this option is used and journaling is disabled, MongoDB 2.6+ will raise an error and the write will fail; older server versions will simply ignore the option.
	 * <p>"socketTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for socket communication. If the server does not respond within the timeout period, a <b>MongoCursorTimeoutException</b> will be thrown and there will be no way to determine if the server actually handled the write or not. A value of -1 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 30000 (30 seconds).</p>
	 * <p>"w"</p><p>See Write Concerns. The default value for <b>MongoClient</b> is 1.</p>
	 * <p>"wtimeout"</p><p>Deprecated alias for "wTimeoutMS".</p>
	 * <p>"wTimeoutMS"</p><p>This option specifies the time limit, in milliseconds, for write concern acknowledgement. It is only applicable when "w" is greater than 1, as the timeout pertains to replication. If the write concern is not satisfied within the time limit, a <b>MongoCursorException</b> will be thrown. A value of 0 may be specified to block indefinitely. The default value for <b>MongoClient</b> is 10000 (ten seconds).</p>
	 * <p>"safe"</p><p>Deprecated. Please use the write concern "w" option.</p>
	 * <p>"timeout"</p><p>Deprecated alias for "socketTimeoutMS".</p>
	 * </p>
	 * @return mixed If <i>w</i> was set, returns an array containing the status of the save.
	 * Otherwise, returns a boolean representing if the array was not empty (an empty array will not
	 * be inserted).
	 */
	public function save ($document, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Creates a database reference
	 * @link http://php.net/manual/en/mongocollection.createdbref.php
	 * @param mixed $document_or_id <p>
	 * If an array or object is given, its _id field will be
	 * used as the reference ID. If a <b>MongoId</b> or scalar
	 * is given, it will be used as the reference ID.
	 * </p>
	 * @return array a database reference array.
	 * </p>
	 * <p>
	 * If an array without an _id field was provided as the
	 * document_or_id parameter, <b>NULL</b> will be returned.
	 */
	public function createDBRef ($document_or_id) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Fetches the document pointed to by a database reference
	 * @link http://php.net/manual/en/mongocollection.getdbref.php
	 * @param array $ref <p>
	 * A database reference.
	 * </p>
	 * @return array the database document pointed to by the reference.
	 */
	public function getDBRef (array $ref) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Converts keys specifying an index to its identifying string
	 * @link http://php.net/manual/en/mongocollection.toindexstring.php
	 * @param mixed $keys <p>
	 * Field or fields to convert to the identifying string
	 * </p>
	 * @return string a string that describes the index.
	 */
	protected static function toIndexString ($keys) {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Performs an operation similar to SQL's GROUP BY command
	 * @link http://php.net/manual/en/mongocollection.group.php
	 * @param mixed $keys <p>
	 * Fields to group by. If an array or non-code object is passed, it will be
	 * the key used to group results.
	 * </p>
	 * <p>1.0.4+: If <i>keys</i> is an instance of
	 * <b>MongoCode</b>, <i>keys</i> will be treated as
	 * a function that returns the key to group by (see the "Passing a
	 * <i>keys</i> function" example below).
	 * </p>
	 * @param array $initial <p>
	 * Initial value of the aggregation counter object.
	 * </p>
	 * @param MongoCode $reduce <p>
	 * A function that takes two arguments (the current document and the
	 * aggregation to this point) and does the aggregation.
	 * </p>
	 * @param array $options [optional] <p>
	 * Optional parameters to the group command. Valid options include:
	 * </p>
	 * <p>
	 * "condition"
	 * </p>
	 * <p>
	 * Criteria for including a document in the aggregation.
	 * </p>
	 * @return array an array containing the result.
	 */
	public function group ($keys, array $initial, MongoCode $reduce, array $options = 'array()') {}

	/**
	 * (PECL mongo &gt;=1.2.11)<br/>
	 * Retrieve a list of distinct values for the given key across a collection.
	 * @link http://php.net/manual/en/mongocollection.distinct.php
	 * @param string $key <p>
	 * The key to use.
	 * </p>
	 * @param array $query [optional] <p>
	 * An optional query parameters
	 * </p>
	 * @return array an array of distinct values, or <b>FALSE</b> on failure
	 */
	public function distinct ($key, array $query = null) {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Perform an aggregation using the aggregation framework
	 * @link http://php.net/manual/en/mongocollection.aggregate.php
	 * @param array $pipeline <p>
	 * An array of pipeline operators.
	 * </p>
	 * @param array $options [optional] <p>Options for the aggregation command. Valid options include:</p>
	 * <p>"allowDiskUse"</p>
	 * <p>Allow aggregation stages to write to temporary files</p>
	 * @return array The result of the aggregation as an array. The ok will
	 * be set to 1 on success, 0 on failure.
	 */
	public function aggregate (array $pipeline, array $options = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Execute an aggregation pipeline command and retrieve results through a cursor
	 * @link http://php.net/manual/en/mongocollection.aggregatecursor.php
	 * @param array $command
	 * @param array $options [optional] <p>Options for the aggregation command. Valid options include:</p>
	 * <p>"allowDiskUse"</p>
	 * <p>Allow aggregation stages to write to temporary files</p>
	 * @return MongoCommandCursor a <b>MongoCommandCursor</b> object. Because this
	 * implements the <b>Iterator</b> interface you can
	 * iterate over each of the results as returned by the command query. The
	 * <b>MongoCommandCursor</b> also implements the
	 * <b>MongoCursorInterface</b> interface which adds the
	 * <b>MongoCommandCursor::batchSize</b>,
	 * <b>MongoCommandCursor::dead</b>,
	 * <b>MongoCommandCursor::info</b> methods.
	 */
	public function aggregateCursor (array $command, array $options = null) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Returns an array of cursors to iterator over a full collection in parallel
	 * @link http://php.net/manual/en/mongocollection.parallelcollectionscan.php
	 * @param int $num_cursors <p>
	 * The number of cursors to request from the server. Please note, that the
	 * server can return less cursors than you requested.
	 * </p>
	 * @return array[MongoCommandCursor] an array of <b>MongoCommandCursor</b> objects.
	 */
	public function parallelCollectionScan ($num_cursors) {}

}

/**
 * A database file object.
 * @link http://php.net/manual/en/class.mongogridfsfile.php
 */
class MongoGridFSFile  {
	/**
	 * @var array
	 */
	public $file;
	/**
	 * @var MongoGridFS
	 */
	protected $gridfs;


	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Create a new GridFS file
	 * @link http://php.net/manual/en/mongogridfsfile.construct.php
	 * @param MongoGridFS $gridfs <p>
	 * The parent MongoGridFS instance.
	 * </p>
	 * @param array $file <p>
	 * A file from the database.
	 * </p>
	 */
	public function __construct (MongoGridFS $gridfs, array $file) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns this file&#x00027;s filename
	 * @link http://php.net/manual/en/mongogridfsfile.getfilename.php
	 * @return string the filename.
	 */
	public function getFilename () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns this file&#x00027;s size
	 * @link http://php.net/manual/en/mongogridfsfile.getsize.php
	 * @return int this file's size
	 */
	public function getSize () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Writes this file to the filesystem
	 * @link http://php.net/manual/en/mongogridfsfile.write.php
	 * @param string $filename [optional] <p>
	 * The location to which to write the file. If none is given,
	 * the stored filename will be used.
	 * </p>
	 * @return int the number of bytes written.
	 */
	public function write ($filename = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns this file&#x00027;s contents as a string of bytes
	 * @link http://php.net/manual/en/mongogridfsfile.getbytes.php
	 * @return string a string of the bytes in the file.
	 */
	public function getBytes () {}

	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Returns a resource that can be used to read the stored file
	 * @link http://php.net/manual/en/mongogridfsfile.getresource.php
	 * @return resource a resource that can be used to read the file with
	 */
	public function getResource () {}

}

/**
 * Cursor for database file results.
 * @link http://php.net/manual/en/class.mongogridfscursor.php
 */
class MongoGridFSCursor extends MongoCursor implements Iterator, Traversable, MongoCursorInterface {
	/**
	 * @var boolean
	 */
	public static $slaveOkay;
	/**
	 * @var integer
	 */
	public static $timeout;
	protected $gridfs;


	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Create a new cursor
	 * @link http://php.net/manual/en/mongogridfscursor.construct.php
	 * @param MongoGridFS $gridfs <p>
	 * Related GridFS collection.
	 * </p>
	 * @param resource $connection <p>
	 * Database connection.
	 * </p>
	 * @param string $ns <p>
	 * Full name of database and collection.
	 * </p>
	 * @param array $query <p>
	 * Database query.
	 * </p>
	 * @param array $fields <p>
	 * Fields to return.
	 * </p>
	 */
	public function __construct (MongoGridFS $gridfs, $connection, $ns, array $query, array $fields) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Return the next file to which this cursor points, and advance the cursor
	 * @link http://php.net/manual/en/mongogridfscursor.getnext.php
	 * @return MongoGridFSFile the next file.
	 */
	public function getNext () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns the current file
	 * @link http://php.net/manual/en/mongogridfscursor.current.php
	 * @return MongoGridFSFile The current file.
	 */
	public function current () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Checks if there are any more elements in this cursor
	 * @link http://php.net/manual/en/mongocursor.hasnext.php
	 * @return bool if there is another element.
	 */
	public function hasNext () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Limits the number of results returned
	 * @link http://php.net/manual/en/mongocursor.limit.php
	 * @param int $num <p>
	 * The number of results to return.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function limit ($num) {}

	/**
	 * (PECL mongo &gt;=1.0.11)<br/>
	 * Limits the number of elements returned in one batch.
	 * @link http://php.net/manual/en/mongocursor.batchsize.php
	 * @param int $batchSize <p>
	 * The number of results to return per batch. Each batch requires a
	 * round-trip to the server.
	 * </p>
	 * <p>
	 * If <i>batchSize</i> is 2 or
	 * more, it represents the size of each batch of objects retrieved.
	 * It can be adjusted to optimize performance and limit data transfer.
	 * </p>
	 * <p>
	 * If <i>batchSize</i> is 1 or negative, it
	 * will limit of number returned documents to the absolute value of batchSize,
	 * and the cursor will be closed. For example if
	 * batchSize is -10, then the server will return a maximum
	 * of 10 documents and as many as can fit in 4MB, then close the cursor.
	 * </p>
	 * <p>
	 * A <i>batchSize</i> of 1 is special, and
	 * means the same as -1, i.e. a value of
	 * 1 makes the cursor only capable of returning
	 * one document.
	 * </p>
	 * <p>
	 * Note that this feature is different from
	 * <b>MongoCursor::limit</b> in that documents must fit within a
	 * maximum size, and it removes the need to send a request to close the cursor
	 * server-side. The batch size can be changed even after a cursor is iterated,
	 * in which case the setting will apply on the next batch retrieval.
	 * </p>
	 * <p>
	 * This cannot override MongoDB's limit on the amount of data it will return to
	 * the client (i.e., if you set batch size to 1,000,000,000, MongoDB will still
	 * only return 4-16MB of results per batch).
	 * </p>
	 * <p>
	 * To ensure consistent behavior, the rules of
	 * <b>MongoCursor::batchSize</b> and
	 * <b>MongoCursor::limit</b> behave a
	 * little complex but work "as expected". The rules are: hard limits override
	 * soft limits with preference given to <b>MongoCursor::limit</b>
	 * over <b>MongoCursor::batchSize</b>. After that, whichever is
	 * set and lower than the other will take precedence. See below.
	 * section for some examples.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function batchSize ($batchSize) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Skips a number of results
	 * @link http://php.net/manual/en/mongocursor.skip.php
	 * @param int $num <p>
	 * The number of results to skip.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function skip ($num) {}

	/**
	 * (PECL mongo &gt;=1.0.6)<br/>
	 * Sets the fields for a query
	 * @link http://php.net/manual/en/mongocursor.fields.php
	 * @param array $f <p>
	 * Fields to return (or not return).
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function fields (array $f) {}

	/**
	 * (PECL mongo &gt;=1.5.0)<br/>
	 * Sets a server-side timeout for this query
	 * @link http://php.net/manual/en/mongocursor.maxtimems.php
	 * @param int $ms <p>
	 * Specifies a cumulative time limit in milliseconds to be allowed by the
	 * server for processing operations on the cursor.
	 * </p>
	 * @return MongoCursor This cursor.
	 */
	public function maxTimeMS ($ms) {}

	/**
	 * (PECL mongo &gt;=1.0.4)<br/>
	 * Adds a top-level key/value pair to a query
	 * @link http://php.net/manual/en/mongocursor.addoption.php
	 * @param string $key <p>
	 * Fieldname to add.
	 * </p>
	 * @param mixed $value <p>
	 * Value to add.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function addOption ($key, $value) {}

	/**
	 * (PECL mongo &gt;=0.9.4)<br/>
	 * Use snapshot mode for the query
	 * @link http://php.net/manual/en/mongocursor.snapshot.php
	 * @return MongoCursor this cursor.
	 */
	public function snapshot () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Sorts the results by given fields
	 * @link http://php.net/manual/en/mongocursor.sort.php
	 * @param array $fields <p>
	 * An array of fields by which to sort. Each element in the array has as
	 * key the field name, and as value either 1 for
	 * ascending sort, or -1 for descending sort.
	 * </p>
	 * <p>
	 * Each result is first sorted on the first field in the array, then (if
	 * it exists) on the second field in the array, etc. This means that the
	 * order of the fields in the <i>fields</i> array is
	 * important. See also the examples section.
	 * </p>
	 * @return MongoCursor the same cursor that this method was called on.
	 */
	public function sort (array $fields) {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Gives the database a hint about the query
	 * @link http://php.net/manual/en/mongocursor.hint.php
	 * @param mixed $index <p>
	 * Index to use for the query. If a string is passed, it should correspond
	 * to an index name. If an array or object is passed, it should correspond
	 * to the specification used to create the index (i.e. the first argument
	 * to <b>MongoCollection::ensureIndex</b>).
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function hint ($index) {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Return an explanation of the query, often useful for optimization and debugging
	 * @link http://php.net/manual/en/mongocursor.explain.php
	 * @return array an explanation of the query.
	 */
	public function explain () {}

	/**
	 * (PECL mongo &gt;=1.2.11)<br/>
	 * Sets arbitrary flags in case there is no method available the specific flag
	 * @link http://php.net/manual/en/mongocursor.setflag.php
	 * @param int $flag <p>
	 * Which flag to set. You can not set flag 6 (EXHAUST) as the driver does
	 * not know how to handle them. You will get a warning if you try to use
	 * this flag. For available flags, please refer to the wire protocol
	 * documentation.
	 * </p>
	 * @param bool $set [optional] <p>
	 * Whether the flag should be set (<b>TRUE</b>) or unset (<b>FALSE</b>).
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function setFlag ($flag, $set = true) {}

	/**
	 * (PECL mongo &gt;=0.9.4)<br/>
	 * Sets whether this query can be done on a secondary [deprecated]
	 * @link http://php.net/manual/en/mongocursor.slaveokay.php
	 * @param bool $okay [optional] <p>
	 * If it is okay to query the secondary.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function slaveOkay ($okay = true) {}

	/**
	 * (PECL mongo &gt;=0.9.4)<br/>
	 * Sets whether this cursor will be left open after fetching the last results
	 * @link http://php.net/manual/en/mongocursor.tailable.php
	 * @param bool $tail [optional] <p>
	 * If the cursor should be tailable.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function tailable ($tail = true) {}

	/**
	 * (PECL mongo &gt;=1.0.1)<br/>
	 * Sets whether this cursor will timeout
	 * @link http://php.net/manual/en/mongocursor.immortal.php
	 * @param bool $liveForever [optional] <p>
	 * If the cursor should be immortal.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function immortal ($liveForever = true) {}

	/**
	 * (PECL mongo &gt;=1.2.11)<br/>
	 * Sets whether this cursor will wait for a while for a tailable cursor to return more data
	 * @link http://php.net/manual/en/mongocursor.awaitdata.php
	 * @param bool $wait [optional] <p>
	 * If the cursor should wait for more data to become available.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function awaitData ($wait = true) {}

	/**
	 * (PECL mongo &gt;=1.2.0)<br/>
	 * If this query should fetch partial results from mongos if a shard is down
	 * @link http://php.net/manual/en/mongocursor.partial.php
	 * @param bool $okay [optional] <p>
	 * If receiving partial results is okay.
	 * </p>
	 * @return MongoCursor this cursor.
	 */
	public function partial ($okay = true) {}

	/**
	 * (PECL mongo &gt;=1.3.3)<br/>
	 * Get the read preference for this query
	 * @link http://php.net/manual/en/mongocursor.getreadpreference.php
	 * @return array
	 */
	public function getReadPreference () {}

	/**
	 * (PECL mongo &gt;=1.3.3)<br/>
	 * Set the read preference for this query
	 * @link http://php.net/manual/en/mongocursor.setreadpreference.php
	 * @param string $read_preference
	 * @param array $tags [optional]
	 * @return MongoCursor this cursor.
	 */
	public function setReadPreference ($read_preference, array $tags = null) {}

	/**
	 * (PECL mongo &gt;=0.9.0 &lt;1.6.0)<br/>
	 * Execute the query.
	 * @link http://php.net/manual/en/mongocursor.doquery.php
	 * @return void <b>NULL</b>.
	 */
	final protected function doQuery () {}

	/**
	 * (PECL mongo &gt;=1.0.3)<br/>
	 * Sets a client-side timeout for this query
	 * @link http://php.net/manual/en/mongocursor.timeout.php
	 * @param int $ms <p>
	 * The number of milliseconds for the cursor to wait for a response. Use
	 * -1 to wait forever. By default, the cursor will wait
	 * 30000 milliseconds (30 seconds).
	 * </p>
	 * @return MongoCursor This cursor.
	 */
	public function timeout ($ms) {}

	/**
	 * (PECL mongo &gt;=1.0.5)<br/>
	 * Gets information about the cursor's creation and iteration
	 * @link http://php.net/manual/en/mongocursor.info.php
	 * @return array the namespace, batch size, limit, skip, flags, query, and projected
	 * fields for this cursor. If the cursor has started iterating, additional
	 * information about iteration and the connection will be included.
	 */
	public function info () {}

	/**
	 * (PECL mongo &gt;=0.9.6)<br/>
	 * Checks if there are results that have not yet been sent from the database
	 * @link http://php.net/manual/en/mongocursor.dead.php
	 * @return bool <b>TRUE</b> if there are more results that have not yet been sent to the
	 * client, and <b>FALSE</b> otherwise.
	 */
	public function dead () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns the current result&#x00027;s _id, or its index within the result set
	 * @link http://php.net/manual/en/mongocursor.key.php
	 * @return string|int The current result&#x00027;s _id as a string. If the result
	 * has no _id, its numeric index within the result set will
	 * be returned as an integer.
	 */
	public function key () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Advances the cursor to the next result, and returns that result
	 * @link http://php.net/manual/en/mongocursor.next.php
	 * @return array the next document.
	 */
	public function next () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Returns the cursor to the beginning of the result set
	 * @link http://php.net/manual/en/mongocursor.rewind.php
	 * @return void <b>NULL</b>.
	 */
	public function rewind () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Checks if the cursor is reading a valid result.
	 * @link http://php.net/manual/en/mongocursor.valid.php
	 * @return bool <b>TRUE</b> if the current result is not null, and <b>FALSE</b> otherwise.
	 */
	public function valid () {}

	/**
	 * (PECL mongo &gt;=0.9.0)<br/>
	 * Clears the cursor
	 * @link http://php.net/manual/en/mongocursor.reset.php
	 * @return void <b>NULL</b>.
	 */
	public function reset () {}

	/**
	 * (PECL mongo &gt;=0.9.2)<br/>
	 * Counts the number of results for this query
	 * @link http://php.net/manual/en/mongocursor.count.php
	 * @param bool $foundOnly [optional] <p>
	 * Send cursor limit and skip information to the count function, if applicable.
	 * </p>
	 * @return int The number of documents returned by this cursor's query.
	 */
	public function count ($foundOnly = false) {}

}

/**
 * MongoWriteBatch is the base class for the <b>MongoInsertBatch</b>,
 * <b>MongoUpdateBatch</b> and <b>MongoDeleteBatch</b> classes.
 * @link http://php.net/manual/en/class.mongowritebatch.php
 */
class MongoWriteBatch  {
	const COMMAND_INSERT = 1;
	const COMMAND_UPDATE = 2;
	const COMMAND_DELETE = 3;


	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Creates a new batch of write operations
	 * @link http://php.net/manual/en/mongowritebatch.construct.php
	 * @param MongoCollection $collection <p>
	 * One of:
	 * 0 - make an MongoWriteBatch::COMMAND_INSERT batch
	 * 1 - make an MongoWriteBatch::COMMAND_UPDATE batch
	 * 2 - make a MongoWriteBatch::COMMAND_DELETE batch
	 * </p>
	 * @param string $batch_type [optional]
	 * @param array $write_options [optional]
	 */
	protected function __construct (MongoCollection $collection, $batch_type = null, array $write_options = null) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Adds a write operation to a batch
	 * @link http://php.net/manual/en/mongowritebatch.add.php
	 * @param array $item <p>
	 * An array that describes a write operation. The structure of this value
	 * depends on the batch's operation type.
	 * <tr valign="top">
	 * <td>Batch type</td>
	 * <td>Argument expectation</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_INSERT</b></td>
	 * <td>
	 * The document to add.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_UPDATE</b></td>
	 * <td>
	 * <p>Raw update operation.</p>
	 * <p>Required keys are "q" and "u", which correspond to the <i>$criteria</i> and <i>$new_object</i> parameters of <b>MongoCollection::update</b>, respectively.</p>
	 * <p>Optional keys are "multi" and "upsert", which correspond to the "multiple" and "upsert" options for <b>MongoCollection::update</b>, respectively. If unspecified, both options default to <b>FALSE</b>.</p>
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_DELETE</b></td>
	 * <td>
	 * <p>Raw delete operation.</p>
	 * <p>Required keys are: "q" and "limit", which correspond to the <i>$criteria</i> parameter and "justOne" option of <b>MongoCollection::remove</b>, respectively.</p>
	 * <p>The "limit" option is an integer; however, MongoDB only supports 0 (i.e. remove all matching documents) and 1 (i.e. remove at most one matching document) at this time.</p>
	 * </td>
	 * </tr>
	 * </p>
	 * @return bool <b>TRUE</b> on success and throws an exception on failure.
	 */
	public function add (array $item) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Executes a batch of write operations
	 * @link http://php.net/manual/en/mongowritebatch.execute.php
	 * @param array $write_options <p>
	 * See MongoWriteBatch::__construct.
	 * </p>
	 * @return array an array containing statistical information for the full batch.
	 * If the batch had to be split into multiple batches, the return value will aggregate
	 * the values from individual batches and return only the totals.
	 * </p>
	 * <p>
	 * If the batch was empty, an array containing only the 'ok' field is returned (as <b>TRUE</b>) although
	 * nothing will be shipped over the wire (NOOP).
	 * </p>
	 * <p>
	 * <tr valign="top">
	 * <td>Array key</td>
	 * <td>Value meaning</td>
	 * <td>Returned for batch type</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nInserted</td>
	 * <td>Number of inserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_INSERT batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nMatched</td>
	 * <td>Number of documents matching the query criteria</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nModified</td>
	 * <td>Number of documents actually needed to be modied</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nUpserted</td>
	 * <td>Number of upserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nRemoved</td>
	 * <td>Number of documents removed</td>
	 * <td>MongoWriteBatch::COMMAND_DELETE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>ok</td>
	 * <td>Command success indicator</td>
	 * <td>All</td>
	 * </tr>
	 */
	final public function execute (array $write_options) {}

	public function getItemCount () {}

	public function getBatchInfo () {}

}

/**
 * Constructs a batch of INSERT operations. See <b>MongoWriteBatch</b>.
 * @link http://php.net/manual/en/class.mongoinsertbatch.php
 */
class MongoInsertBatch extends MongoWriteBatch  {
	const COMMAND_INSERT = 1;
	const COMMAND_UPDATE = 2;
	const COMMAND_DELETE = 3;


	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Description
	 * @link http://php.net/manual/en/mongoinsertbatch.construct.php
	 * @param MongoCollection $collection
	 * @param array $write_options [optional]
	 */
	public function __construct (MongoCollection $collection, array $write_options = null) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Adds a write operation to a batch
	 * @link http://php.net/manual/en/mongowritebatch.add.php
	 * @param array $item <p>
	 * An array that describes a write operation. The structure of this value
	 * depends on the batch's operation type.
	 * <tr valign="top">
	 * <td>Batch type</td>
	 * <td>Argument expectation</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_INSERT</b></td>
	 * <td>
	 * The document to add.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_UPDATE</b></td>
	 * <td>
	 * <p>Raw update operation.</p>
	 * <p>Required keys are "q" and "u", which correspond to the <i>$criteria</i> and <i>$new_object</i> parameters of <b>MongoCollection::update</b>, respectively.</p>
	 * <p>Optional keys are "multi" and "upsert", which correspond to the "multiple" and "upsert" options for <b>MongoCollection::update</b>, respectively. If unspecified, both options default to <b>FALSE</b>.</p>
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_DELETE</b></td>
	 * <td>
	 * <p>Raw delete operation.</p>
	 * <p>Required keys are: "q" and "limit", which correspond to the <i>$criteria</i> parameter and "justOne" option of <b>MongoCollection::remove</b>, respectively.</p>
	 * <p>The "limit" option is an integer; however, MongoDB only supports 0 (i.e. remove all matching documents) and 1 (i.e. remove at most one matching document) at this time.</p>
	 * </td>
	 * </tr>
	 * </p>
	 * @return bool <b>TRUE</b> on success and throws an exception on failure.
	 */
	public function add (array $item) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Executes a batch of write operations
	 * @link http://php.net/manual/en/mongowritebatch.execute.php
	 * @param array $write_options <p>
	 * See MongoWriteBatch::__construct.
	 * </p>
	 * @return array an array containing statistical information for the full batch.
	 * If the batch had to be split into multiple batches, the return value will aggregate
	 * the values from individual batches and return only the totals.
	 * </p>
	 * <p>
	 * If the batch was empty, an array containing only the 'ok' field is returned (as <b>TRUE</b>) although
	 * nothing will be shipped over the wire (NOOP).
	 * </p>
	 * <p>
	 * <tr valign="top">
	 * <td>Array key</td>
	 * <td>Value meaning</td>
	 * <td>Returned for batch type</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nInserted</td>
	 * <td>Number of inserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_INSERT batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nMatched</td>
	 * <td>Number of documents matching the query criteria</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nModified</td>
	 * <td>Number of documents actually needed to be modied</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nUpserted</td>
	 * <td>Number of upserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nRemoved</td>
	 * <td>Number of documents removed</td>
	 * <td>MongoWriteBatch::COMMAND_DELETE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>ok</td>
	 * <td>Command success indicator</td>
	 * <td>All</td>
	 * </tr>
	 */
	final public function execute (array $write_options) {}

	public function getItemCount () {}

	public function getBatchInfo () {}

}

/**
 * Constructs a batch of UPDATE operations. See <b>MongoWriteBatch</b>.
 * @link http://php.net/manual/en/class.mongoupdatebatch.php
 */
class MongoUpdateBatch extends MongoWriteBatch  {
	const COMMAND_INSERT = 1;
	const COMMAND_UPDATE = 2;
	const COMMAND_DELETE = 3;


	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Description
	 * @link http://php.net/manual/en/mongoupdatebatch.construct.php
	 * @param MongoCollection $collection
	 * @param array $write_options [optional]
	 */
	public function __construct (MongoCollection $collection, array $write_options = null) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Adds a write operation to a batch
	 * @link http://php.net/manual/en/mongowritebatch.add.php
	 * @param array $item <p>
	 * An array that describes a write operation. The structure of this value
	 * depends on the batch's operation type.
	 * <tr valign="top">
	 * <td>Batch type</td>
	 * <td>Argument expectation</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_INSERT</b></td>
	 * <td>
	 * The document to add.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_UPDATE</b></td>
	 * <td>
	 * <p>Raw update operation.</p>
	 * <p>Required keys are "q" and "u", which correspond to the <i>$criteria</i> and <i>$new_object</i> parameters of <b>MongoCollection::update</b>, respectively.</p>
	 * <p>Optional keys are "multi" and "upsert", which correspond to the "multiple" and "upsert" options for <b>MongoCollection::update</b>, respectively. If unspecified, both options default to <b>FALSE</b>.</p>
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_DELETE</b></td>
	 * <td>
	 * <p>Raw delete operation.</p>
	 * <p>Required keys are: "q" and "limit", which correspond to the <i>$criteria</i> parameter and "justOne" option of <b>MongoCollection::remove</b>, respectively.</p>
	 * <p>The "limit" option is an integer; however, MongoDB only supports 0 (i.e. remove all matching documents) and 1 (i.e. remove at most one matching document) at this time.</p>
	 * </td>
	 * </tr>
	 * </p>
	 * @return bool <b>TRUE</b> on success and throws an exception on failure.
	 */
	public function add (array $item) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Executes a batch of write operations
	 * @link http://php.net/manual/en/mongowritebatch.execute.php
	 * @param array $write_options <p>
	 * See MongoWriteBatch::__construct.
	 * </p>
	 * @return array an array containing statistical information for the full batch.
	 * If the batch had to be split into multiple batches, the return value will aggregate
	 * the values from individual batches and return only the totals.
	 * </p>
	 * <p>
	 * If the batch was empty, an array containing only the 'ok' field is returned (as <b>TRUE</b>) although
	 * nothing will be shipped over the wire (NOOP).
	 * </p>
	 * <p>
	 * <tr valign="top">
	 * <td>Array key</td>
	 * <td>Value meaning</td>
	 * <td>Returned for batch type</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nInserted</td>
	 * <td>Number of inserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_INSERT batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nMatched</td>
	 * <td>Number of documents matching the query criteria</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nModified</td>
	 * <td>Number of documents actually needed to be modied</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nUpserted</td>
	 * <td>Number of upserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nRemoved</td>
	 * <td>Number of documents removed</td>
	 * <td>MongoWriteBatch::COMMAND_DELETE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>ok</td>
	 * <td>Command success indicator</td>
	 * <td>All</td>
	 * </tr>
	 */
	final public function execute (array $write_options) {}

	public function getItemCount () {}

	public function getBatchInfo () {}

}

/**
 * Constructs a batch of DELETE operations. See <b>MongoWriteBatch</b>.
 * @link http://php.net/manual/en/class.mongodeletebatch.php
 */
class MongoDeleteBatch extends MongoWriteBatch  {
	const COMMAND_INSERT = 1;
	const COMMAND_UPDATE = 2;
	const COMMAND_DELETE = 3;


	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Description
	 * @link http://php.net/manual/en/mongodeletebatch.construct.php
	 * @param MongoCollection $collection
	 * @param array $write_options [optional]
	 */
	public function __construct (MongoCollection $collection, array $write_options = null) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Adds a write operation to a batch
	 * @link http://php.net/manual/en/mongowritebatch.add.php
	 * @param array $item <p>
	 * An array that describes a write operation. The structure of this value
	 * depends on the batch's operation type.
	 * <tr valign="top">
	 * <td>Batch type</td>
	 * <td>Argument expectation</td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_INSERT</b></td>
	 * <td>
	 * The document to add.
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_UPDATE</b></td>
	 * <td>
	 * <p>Raw update operation.</p>
	 * <p>Required keys are "q" and "u", which correspond to the <i>$criteria</i> and <i>$new_object</i> parameters of <b>MongoCollection::update</b>, respectively.</p>
	 * <p>Optional keys are "multi" and "upsert", which correspond to the "multiple" and "upsert" options for <b>MongoCollection::update</b>, respectively. If unspecified, both options default to <b>FALSE</b>.</p>
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td><b>MongoWriteBatch::COMMAND_DELETE</b></td>
	 * <td>
	 * <p>Raw delete operation.</p>
	 * <p>Required keys are: "q" and "limit", which correspond to the <i>$criteria</i> parameter and "justOne" option of <b>MongoCollection::remove</b>, respectively.</p>
	 * <p>The "limit" option is an integer; however, MongoDB only supports 0 (i.e. remove all matching documents) and 1 (i.e. remove at most one matching document) at this time.</p>
	 * </td>
	 * </tr>
	 * </p>
	 * @return bool <b>TRUE</b> on success and throws an exception on failure.
	 */
	public function add (array $item) {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Executes a batch of write operations
	 * @link http://php.net/manual/en/mongowritebatch.execute.php
	 * @param array $write_options <p>
	 * See MongoWriteBatch::__construct.
	 * </p>
	 * @return array an array containing statistical information for the full batch.
	 * If the batch had to be split into multiple batches, the return value will aggregate
	 * the values from individual batches and return only the totals.
	 * </p>
	 * <p>
	 * If the batch was empty, an array containing only the 'ok' field is returned (as <b>TRUE</b>) although
	 * nothing will be shipped over the wire (NOOP).
	 * </p>
	 * <p>
	 * <tr valign="top">
	 * <td>Array key</td>
	 * <td>Value meaning</td>
	 * <td>Returned for batch type</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nInserted</td>
	 * <td>Number of inserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_INSERT batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nMatched</td>
	 * <td>Number of documents matching the query criteria</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nModified</td>
	 * <td>Number of documents actually needed to be modied</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nUpserted</td>
	 * <td>Number of upserted documents</td>
	 * <td>MongoWriteBatch::COMMAND_UPDATE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>nRemoved</td>
	 * <td>Number of documents removed</td>
	 * <td>MongoWriteBatch::COMMAND_DELETE batch</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>ok</td>
	 * <td>Command success indicator</td>
	 * <td>All</td>
	 * </tr>
	 */
	final public function execute (array $write_options) {}

	public function getItemCount () {}

	public function getBatchInfo () {}

}

/**
 * A unique identifier created for database objects. If an object is inserted
 * into the database without an _id field, an _id field will be added to it
 * with a <b>MongoId</b> instance as its value. If the data
 * has a naturally occuring unique field (e.g. username or timestamp) it is
 * fine to use this as the _id field instead, and it will not be replaced with
 * a <b>MongoId</b>.
 * @link http://php.net/manual/en/class.mongoid.php
 */
class MongoId  {
	/**
	 * @var string
	 */
	public $id;


	/**
	 * (PECL mongo &gt;= 0.8.0)<br/>
	 * Creates a new id
	 * @link http://php.net/manual/en/mongoid.construct.php
	 * @param string|MongoId $id [optional] <p>
	 * A string (must be 24 hexadecimal characters) or a
	 * <b>MongoId</b> instance.
	 * </p>
	 */
	public function __construct ($id = null) {}

	/**
	 * (PECL mongo &gt;= 0.8.0)<br/>
	 * Returns a hexidecimal representation of this id
	 * @link http://php.net/manual/en/mongoid.tostring.php
	 * @return string This id.
	 */
	public function __toString () {}

	/**
	 * (PECL mongo &gt;= 1.0.8)<br/>
	 * Create a dummy MongoId
	 * @link http://php.net/manual/en/mongoid.set-state.php
	 * @param array $props <p>
	 * Theoretically, an array of properties used to create the new id.
	 * However, as MongoId instances have no properties, this is not used.
	 * </p>
	 * @return MongoId A new id with the value "000000000000000000000000".
	 */
	public static function __set_state (array $props) {}

	/**
	 * (PECL mongo &gt;= 1.0.1)<br/>
	 * Gets the number of seconds since the epoch that this id was created
	 * @link http://php.net/manual/en/mongoid.gettimestamp.php
	 * @return int the number of seconds since the epoch that this id was created. There are only
	 * four bytes of timestamp stored, so <b>MongoDate</b> is a better choice
	 * for storing exact or wide-ranging times.
	 */
	public function getTimestamp () {}

	/**
	 * (PECL mongo &gt;= 1.0.8)<br/>
	 * Gets the hostname being used for this machine's ids
	 * @link http://php.net/manual/en/mongoid.gethostname.php
	 * @return string the hostname.
	 */
	public static function getHostname () {}

	/**
	 * (PECL mongo &gt;= 1.0.11)<br/>
	 * Gets the process ID
	 * @link http://php.net/manual/en/mongoid.getpid.php
	 * @return int the PID of the <b>MongoId</b>.
	 */
	public function getPID () {}

	/**
	 * (PECL mongo &gt;= 1.0.11)<br/>
	 * Gets the incremented value to create this id
	 * @link http://php.net/manual/en/mongoid.getinc.php
	 * @return int the incremented value used to create this <b>MongoId</b>.
	 */
	public function getInc () {}

	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Check if a value is a valid ObjectId
	 * @link http://php.net/manual/en/mongoid.isvalid.php
	 * @param mixed $value <p>
	 * The value to check for validity.
	 * </p>
	 * @return bool <b>TRUE</b> if <i>value</i> is a
	 * <b>MongoId</b> instance or a string consisting of exactly 24
	 * hexadecimal characters; otherwise, <b>FALSE</b> is returned.
	 */
	public static function isValid ($value) {}

}

/**
 * Represents JavaScript code for the database.
 * @link http://php.net/manual/en/class.mongocode.php
 */
class MongoCode  {
	public $code;
	public $scope;


	/**
	 * (PECL mongo &gt;= 0.8.3)<br/>
	 * Creates a new code object
	 * @link http://php.net/manual/en/mongocode.construct.php
	 * @param string $code <p>
	 * A string of code.
	 * </p>
	 * @param array $scope [optional] <p>
	 * The scope to use for the code.
	 * </p>
	 */
	public function __construct ($code, array $scope = 'array()') {}

	/**
	 * (PECL mongo &gt;= 0.8.3)<br/>
	 * Returns this code as a string
	 * @link http://php.net/manual/en/mongocode.tostring.php
	 * @return string This code, the scope is not returned.
	 */
	public function __toString () {}

}

/**
 * This class can be used to create regular expressions. Typically, these
 * expressions will be used to query the database and find matching strings.
 * More unusually, they can be saved to the database and retrieved.
 * @link http://php.net/manual/en/class.mongoregex.php
 */
class MongoRegex  {
	/**
	 * @var string
	 */
	public $regex;
	/**
	 * @var string
	 */
	public $flags;


	/**
	 * (PECL mongo &gt;= 0.8.1)<br/>
	 * Creates a new regular expression
	 * @link http://php.net/manual/en/mongoregex.construct.php
	 * @param string $regex <p>
	 * Regular expression string of the form /expr/flags.
	 * </p>
	 */
	public function __construct ($regex) {}

	/**
	 * (PECL mongo &gt;= 0.8.1)<br/>
	 * A string representation of this regular expression
	 * @link http://php.net/manual/en/mongoregex.tostring.php
	 * @return string This regular expression in the form "/expr/flags".
	 */
	public function __toString () {}

}

/**
 * Represent date objects for the database. This class should be used to save
 * dates to the database and to query for dates. For example:
 * @link http://php.net/manual/en/class.mongodate.php
 */
class MongoDate  {
	/**
	 * @var int
	 */
	public $sec;
	/**
	 * @var int
	 */
	public $usec;


	/**
	 * (PECL mongo &gt;= 0.8.1)<br/>
	 * Creates a new date.
	 * @link http://php.net/manual/en/mongodate.construct.php
	 * @param int $sec [optional] <p>
	 * Number of seconds since the epoch (i.e. 1 Jan 1970 00:00:00.000 UTC).
	 * </p>
	 * @param int $usec [optional] <p>
	 * Microseconds. Please be aware though that MongoDB's resolution is
	 * milliseconds and not microseconds, which means this
	 * value will be truncated to millisecond resolution.
	 * </p>
	 */
	public function __construct ($sec = 'time()', $usec = 0) {}

	/**
	 * (PECL mongo &gt;= 0.8.1)<br/>
	 * Returns a string representation of this date
	 * @link http://php.net/manual/en/mongodate.tostring.php
	 * @return string This date.
	 */
	public function __toString () {}

	public static function __set_state () {}

	/**
	 * (PECL mongo &gt;= 1.6.0; PHP &gt; 5.3.4)<br/>
	 * Returns a DateTime object representing this date
	 * @link http://php.net/manual/en/mongodate.todatetime.php
	 * @return DateTime This date as a <b>DateTime</b> object.
	 */
	public function toDateTime () {}

}

/**
 * An object that can be used to store or retrieve binary data from the database.
 * @link http://php.net/manual/en/class.mongobindata.php
 */
class MongoBinData  {
	const GENERIC = 0;
	const FUNC = 1;
	const BYTE_ARRAY = 2;
	const UUID = 3;
	const UUID_RFC4122 = 4;
	const MD5 = 5;
	const CUSTOM = 128;

	/**
	 * @var string
	 */
	public $bin;
	/**
	 * @var int
	 */
	public $type;


	/**
	 * (PECL mongo &gt;= 0.8.1)<br/>
	 * Creates a new binary data object.
	 * @link http://php.net/manual/en/mongobindata.construct.php
	 * @param string $data <p>
	 * Binary data.
	 * </p>
	 * @param int $type [optional] <p>
	 * Data type.
	 * </p>
	 */
	public function __construct ($data, $type = 0) {}

	/**
	 * (PECL mongo &gt;= 0.8.1)<br/>
	 * The string representation of this binary data object.
	 * @link http://php.net/manual/en/mongobindata.tostring.php
	 * @return string the string "&lt;Mongo Binary Data&gt;". To access the contents of a
	 * <b>MongoBinData</b>, use the bin field.
	 */
	public function __toString () {}

}

/**
 * This class can be used to create lightweight links between objects in
 * different collections.
 * @link http://php.net/manual/en/class.mongodbref.php
 */
class MongoDBRef  {

	/**
	 * (PECL mongo &gt;= 0.9.0)<br/>
	 * Creates a new database reference
	 * @link http://php.net/manual/en/mongodbref.create.php
	 * @param string $collection <p>
	 * Collection name (without the database name).
	 * </p>
	 * @param mixed $id <p>
	 * The _id field of the object to which to link.
	 * </p>
	 * @param string $database [optional] <p>
	 * Database name.
	 * </p>
	 * @return array the reference.
	 */
	public static function create ($collection, $id, $database = null) {}

	/**
	 * (PECL mongo &gt;= 0.9.0)<br/>
	 * Checks if an array is a database reference
	 * @link http://php.net/manual/en/mongodbref.isref.php
	 * @param mixed $ref <p>
	 * Array or object to check.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public static function isRef ($ref) {}

	/**
	 * (PECL mongo &gt;= 0.9.0)<br/>
	 * Fetches the object pointed to by a reference
	 * @link http://php.net/manual/en/mongodbref.get.php
	 * @param MongoDB $db <p>
	 * Database to use.
	 * </p>
	 * @param array $ref <p>
	 * Reference to fetch.
	 * </p>
	 * @return array the document to which the reference refers or <b>NULL</b> if the document
	 * does not exist (the reference is broken).
	 */
	public static function get (MongoDB $db, array $ref) {}

}

/**
 * Default Mongo exception.
 * @link http://php.net/manual/en/class.mongoexception.php
 */
class MongoException extends Exception  {
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

/**
 * Thrown when the driver fails to connect to the database.
 * @link http://php.net/manual/en/class.mongoconnectionexception.php
 */
class MongoConnectionException extends MongoException  {
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

/**
 * Caused by accessing a cursor incorrectly or a error receiving a reply. Note
 * that this can be thrown by any database request that receives a reply, not
 * just queries. Writes, commands, and any other operation that sends
 * information to the database and waits for a response can throw a
 * <b>MongoCursorException</b>. The only exception is
 * new MongoClient() (creating a new connection), which will
 * only throw <b>MongoConnectionException</b>s.
 * @link http://php.net/manual/en/class.mongocursorexception.php
 */
class MongoCursorException extends MongoException  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;
	private $host;


	/**
	 * (PECL mongo &gt;= 1.0.0)<br/>
	 * The hostname of the server that encountered the error
	 * @link http://php.net/manual/en/mongocursorexception.gethost.php
	 * @return string the hostname, or NULL if the hostname is unknown.
	 */
	public function getHost () {}

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
 * Caused by a query timing out. You can set the length of time to wait before
 * this exception is thrown by calling
 * <b>MongoCursor::timeout</b> on the cursor or setting
 * MongoCursor::$timeout. The static variable is useful for
 * queries such as database commands and
 * <b>MongoCollection::findOne</b>, both of which implicitly use
 * cursors.
 * @link http://php.net/manual/en/class.mongocursortimeoutexception.php
 */
class MongoCursorTimeoutException extends MongoCursorException  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PECL mongo &gt;= 1.0.0)<br/>
	 * The hostname of the server that encountered the error
	 * @link http://php.net/manual/en/mongocursorexception.gethost.php
	 * @return string the hostname, or NULL if the hostname is unknown.
	 */
	public function getHost () {}

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
 * Thrown when there are errors reading or writing files
 * to or from the database.
 * @link http://php.net/manual/en/class.mongogridfsexception.php
 */
class MongoGridFSException extends MongoException  {
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

/**
 * The MongoResultException is thrown by several command helpers (such as
 * <b>MongoCollection::findAndModify</b>) in the event of
 * failure. The original result document is available through
 * <b>MongoResultException::getDocument</b>.
 * @link http://php.net/manual/en/class.mongoresultexception.php
 */
class MongoResultException extends MongoException  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;
	public $document;
	private $host;


	/**
	 * (PECL mongo &gt;=1.3.0)<br/>
	 * Retrieve the full result document
	 * @link http://php.net/manual/en/mongoresultexception.getdocument.php
	 * @return array The full result document as an array, including partial data if available and
	 * additional keys.
	 */
	public function getDocument () {}

	public function getHost () {}

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
 * MongoWriteConcernException is thrown when a write fails. See for how to set failure thresholds.
 * @link http://php.net/manual/en/class.mongowriteconcernexception.php
 */
class MongoWriteConcernException extends MongoCursorException  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;
	private $document;


	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Get the error document
	 * @link http://php.net/manual/en/mongowriteconcernexception.getdocument.php
	 * @return array A MongoDB document, if available, as an array.
	 */
	public function getDocument () {}

	/**
	 * (PECL mongo &gt;= 1.0.0)<br/>
	 * The hostname of the server that encountered the error
	 * @link http://php.net/manual/en/mongocursorexception.gethost.php
	 * @return string the hostname, or NULL if the hostname is unknown.
	 */
	public function getHost () {}

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
 * Thrown when attempting to insert a document into a collection which already contains the same values for the unique keys.
 * @link http://php.net/manual/en/class.mongoduplicatekeyexception.php
 */
class MongoDuplicateKeyException extends MongoWriteConcernException  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PECL mongo &gt;= 1.5.0)<br/>
	 * Get the error document
	 * @link http://php.net/manual/en/mongowriteconcernexception.getdocument.php
	 * @return array A MongoDB document, if available, as an array.
	 */
	public function getDocument () {}

	/**
	 * (PECL mongo &gt;= 1.0.0)<br/>
	 * The hostname of the server that encountered the error
	 * @link http://php.net/manual/en/mongocursorexception.gethost.php
	 * @return string the hostname, or NULL if the hostname is unknown.
	 */
	public function getHost () {}

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
 * Thrown when a operation times out server side (i.e. in MongoDB).
 * @link http://php.net/manual/en/class.mongoexecutiontimeoutexception.php
 */
class MongoExecutionTimeoutException extends MongoException  {
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

/**
 * When talking to MongoDB 2.6.0, and later, certain operations (such as writes) may throw MongoProtocolException when the response
 * from the server did not make sense - for example during network failure (we could read the entire response) or data corruption.
 * @link http://php.net/manual/en/class.mongoprotocolexception.php
 */
class MongoProtocolException extends MongoException  {
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

/**
 * <b>MongoTimestamp</b> is an internal type used by MongoDB
 * for replication and sharding. It consists of a 4-byte timestamp (i.e.
 * seconds since the epoch) and a 4-byte increment. This type is not intended
 * for storing time or date values (e.g. a "createdAt" field on a document).
 * @link http://php.net/manual/en/class.mongotimestamp.php
 */
class MongoTimestamp  {
	/**
	 * @var int
	 */
	public $sec;
	/**
	 * @var int
	 */
	public $inc;


	/**
	 * (PECL mongo &gt;= 1.0.1)<br/>
	 * Creates a new timestamp.
	 * @link http://php.net/manual/en/mongotimestamp.construct.php
	 * @param int $sec [optional] <p>
	 * Number of seconds since the epoch (i.e. 1 Jan 1970 00:00:00.000 UTC).
	 * </p>
	 * @param int $inc [optional] <p>
	 * Increment.
	 * </p>
	 */
	public function __construct ($sec = 'time()', $inc = null) {}

	/**
	 * (PECL mongo &gt;= 1.0.1)<br/>
	 * Returns a string representation of this timestamp
	 * @link http://php.net/manual/en/mongotimestamp.tostring.php
	 * @return string The seconds since epoch represented by this timestamp.
	 */
	public function __toString () {}

}

/**
 * The class can be used to save 32-bit integers to the database on a 64-bit
 * system.
 * @link http://php.net/manual/en/class.mongoint32.php
 */
class MongoInt32  {
	/**
	 * @var string
	 */
	public $value;


	/**
	 * (PECL mongo &gt;= 1.0.9)<br/>
	 * Creates a new 32-bit integer.
	 * @link http://php.net/manual/en/mongoint32.construct.php
	 * @param string $value <p>
	 * A number.
	 * </p>
	 */
	public function __construct ($value) {}

	/**
	 * (PECL mongo &gt;= 1.0.9)<br/>
	 * Returns the string representation of this 32-bit integer.
	 * @link http://php.net/manual/en/mongoint32.tostring.php
	 * @return string the string representation of this integer.
	 */
	public function __toString () {}

}

/**
 * The class can be used to save 64-bit integers to the database on a 32-bit
 * system.
 * @link http://php.net/manual/en/class.mongoint64.php
 */
class MongoInt64  {
	/**
	 * @var string
	 */
	public $value;


	/**
	 * (PECL mongo &gt;= 1.0.9)<br/>
	 * Creates a new 64-bit integer.
	 * @link http://php.net/manual/en/mongoint64.construct.php
	 * @param string $value <p>
	 * A number.
	 * </p>
	 */
	public function __construct ($value) {}

	/**
	 * (PECL mongo &gt;= 1.0.9)<br/>
	 * Returns the string representation of this 64-bit integer.
	 * @link http://php.net/manual/en/mongoint64.tostring.php
	 * @return string the string representation of this integer.
	 */
	public function __toString () {}

}

/**
 * Logging can be used to get detailed information about what the driver is
 * doing. Logging is disabled by default, but this class allows you to activate
 * specific levels of logging for various parts of the driver. Some examples:
 * @link http://php.net/manual/en/class.mongolog.php
 */
class MongoLog  {
	const NONE = 0;
	const WARNING = 1;
	const INFO = 2;
	const FINE = 4;
	const RS = 1;
	const POOL = 1;
	const PARSE = 16;
	const CON = 2;
	const IO = 4;
	const SERVER = 8;
	const ALL = 31;

	/**
	 * @var int
	 */
	private static $level;
	/**
	 * @var int
	 */
	private static $module;
	/**
	 * @var int
	 */
	private static $callback;


	/**
	 * (PECL mongo &gt;= 1.2.3)<br/>
	 * Sets the level(s) to be logged
	 * @link http://php.net/manual/en/mongolog.setlevel.php
	 * @param int $level <p>
	 * The level(s) you would like to log.
	 * </p>
	 * @return void
	 */
	public static function setLevel ($level) {}

	/**
	 * (PECL mongo &gt;= 1.2.3)<br/>
	 * Gets the level(s) currently being logged
	 * @link http://php.net/manual/en/mongolog.getlevel.php
	 * @return int the level(s) currently being logged.
	 */
	public static function getLevel () {}

	/**
	 * (PECL mongo &gt;= 1.2.3)<br/>
	 * Sets the module(s) to be logged
	 * @link http://php.net/manual/en/mongolog.setmodule.php
	 * @param int $module <p>
	 * The module(s) you would like to log.
	 * </p>
	 * @return void
	 */
	public static function setModule ($module) {}

	/**
	 * (PECL mongo &gt;= 1.2.3)<br/>
	 * Gets the module(s) currently being logged
	 * @link http://php.net/manual/en/mongolog.getmodule.php
	 * @return int the module(s) currently being logged.
	 */
	public static function getModule () {}

	/**
	 * (PECL mongo &gt;= 1.3.0)<br/>
	 * Sets a callback function to be invoked for events
	 * @link http://php.net/manual/en/mongolog.setcallback.php
	 * @param callable $log_function <p>
	 * The callback function to be invoked on events. It should have the following prototype:
	 * </p>
	 * <p>
	 * <b>log_function</b>
	 * <b>int<i>module</i></b>
	 * <b>int<i>level</i></b>
	 * <b>string<i>message</i></b>
	 * <i>module</i>
	 * One of the MongoLog
	 * module constants.
	 * @return void <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public static function setCallback (callable $log_function) {}

	/**
	 * (PECL mongo &gt;= 1.3.0)<br/>
	 * Gets the previously set callback function
	 * @link http://php.net/manual/en/mongolog.getcallback.php
	 * @return callable the callback function, or <b>FALSE</b> if not set yet.
	 */
	public static function getCallback () {}

}

/**
 * The current (1.3.0+) releases of the driver no longer implements pooling.
 * This class and its methods are therefore deprecated and should not be
 * used.
 * @link http://php.net/manual/en/class.mongopool.php
 */
class MongoPool  {

	/**
	 * (PECL mongo &gt;= 1.2.3)<br/>
	 * Returns information about all connection pools.
	 * @link http://php.net/manual/en/mongopool.info.php
	 * @return array Each connection pool has an identifier, which starts with the host. For each
	 * pool, this function shows the following fields:
	 * <i>in use</i>
	 * <p>
	 * The number of connections currently being used by
	 * <b>Mongo</b> instances.
	 * </p>
	 * <i>in pool</i>
	 * <p>
	 * The number of connections currently in the pool (not being used).
	 * </p>
	 * <i>remaining</i>
	 * <p>
	 * The number of connections that could be created by this pool. For
	 * example, suppose a pool had 5 connections remaining and 3 connections in
	 * the pool. We could create 8 new instances of
	 * <b>MongoClient</b> before we exhausted this pool
	 * (assuming no instances of <b>MongoClient</b> went out of
	 * scope, returning their connections to the pool).
	 * </p>
	 * <p>
	 * A negative number means that this pool will spawn unlimited connections.
	 * </p>
	 * <p>
	 * Before a pool is created, you can change the max number of connections by
	 * calling <b>Mongo::setPoolSize</b>. Once a pool is showing
	 * up in the output of this function, its size cannot be changed.
	 * </p>
	 * <i>total</i>
	 * <p>
	 * The total number of connections allowed for this pool. This should be
	 * greater than or equal to "in use" + "in pool" (or -1).
	 * </p>
	 * <i>timeout</i>
	 * <p>
	 * The socket timeout for connections in this pool. This is how long
	 * connections in this pool will attempt to connect to a server before
	 * giving up.
	 * </p>
	 * <i>waiting</i>
	 * <p>
	 * If you have capped the pool size, workers requesting connections from
	 * the pool may block until other workers return their connections. This
	 * field shows how many milliseconds workers have blocked for connections to
	 * be released. If this number keeps increasing, you may want to use
	 * <b>MongoPool::setSize</b> to add more connections to your
	 * pool.
	 * </p>
	 */
	public static function info () {}

	/**
	 * (PECL mongo &gt;= 1.2.3)<br/>
	 * Set the size for future connection pools.
	 * @link http://php.net/manual/en/mongopool.setsize.php
	 * @param int $size <p>
	 * The max number of connections future pools will be able to create.
	 * Negative numbers mean that the pool will spawn an infinite number of
	 * connections.
	 * </p>
	 * @return bool the former value of pool size.
	 */
	public static function setSize ($size) {}

	/**
	 * (PECL mongo &gt;= 1.2.3)<br/>
	 * Get pool size for connection pools
	 * @link http://php.net/manual/en/mongopool.getsize.php
	 * @return int the current pool size.
	 */
	public static function getSize () {}

}

/**
 * <b>MongoMaxKey</b> is an special type used by the database
 * that compares greater than all other possible BSON values. Thus, if a query
 * is sorted by a given field in ascending order, any document with a
 * <b>MongoMaxKey</b> as its value will be returned last.
 * @link http://php.net/manual/en/class.mongomaxkey.php
 */
class MongoMaxKey  {
}

/**
 * <b>MongoMinKey</b> is an special type used by the database
 * that compares less than all other possible BSON values. Thus, if a query is
 * sorted by a given field in ascending order, any document with a
 * <b>MongoMinKey</b> as its value will be returned first.
 * @link http://php.net/manual/en/class.mongominkey.php
 */
class MongoMinKey  {
}

/**
 * (PECL mongo &gt;=1.0.1)<br/>
 * Serializes a PHP variable into a BSON string
 * @link http://php.net/manual/en/function.bson-encode.php
 * @param mixed $anything <p>
 * The variable to be serialized.
 * </p>
 * @return string the serialized string.
 */
function bson_encode ($anything) {}

/**
 * (PECL mongo &gt;=1.0.1)<br/>
 * Deserializes a BSON object into a PHP array
 * @link http://php.net/manual/en/function.bson-decode.php
 * @param string $bson <p>
 * The BSON to be deserialized.
 * </p>
 * @return array the deserialized BSON object.
 */
function bson_decode ($bson) {}


/**
 * Alias of <b>MONGO_SUPPORTS_STREAMS</b>
 * @link http://php.net/manual/en/mongo.constants.php
 */
define ('MONGO_STREAMS', 1);

/**
 * 1 when compiled against PHP Streams (default since 1.4.0).
 * @link http://php.net/manual/en/mongo.constants.php
 */
define ('MONGO_SUPPORTS_STREAMS', 1);

/**
 * 1 when is enabled and available.
 * @link http://php.net/manual/en/mongo.constants.php
 */
define ('MONGO_SUPPORTS_SSL', 1);

/**
 * 1 when MongoDB-Challenge/Reponse authentication is compiled in.
 * @link http://php.net/manual/en/mongo.constants.php
 */
define ('MONGO_SUPPORTS_AUTH_MECHANISM_MONGODB_CR', 1);

/**
 * 1 when x.509 authentication is compiled in.
 * @link http://php.net/manual/en/mongo.constants.php
 */
define ('MONGO_SUPPORTS_AUTH_MECHANISM_MONGODB_X509', 1);
define ('MONGO_SUPPORTS_AUTH_MECHANISM_SCRAM_SHA1', 1);

/**
 * 1 when GSSAPI authentication is compiled in.
 * @link http://php.net/manual/en/mongo.constants.php
 */
define ('MONGO_SUPPORTS_AUTH_MECHANISM_GSSAPI', 0);

/**
 * 1 when PLAIN authentication is compiled in.
 * @link http://php.net/manual/en/mongo.constants.php
 */
define ('MONGO_SUPPORTS_AUTH_MECHANISM_PLAIN', 0);
define ('MONGO_STREAM_NOTIFY_TYPE_IO_INIT', 100);
define ('MONGO_STREAM_NOTIFY_TYPE_LOG', 200);
define ('MONGO_STREAM_NOTIFY_IO_READ', 111);
define ('MONGO_STREAM_NOTIFY_IO_WRITE', 112);
define ('MONGO_STREAM_NOTIFY_IO_PROGRESS', 7);
define ('MONGO_STREAM_NOTIFY_IO_COMPLETED', 8);
define ('MONGO_STREAM_NOTIFY_LOG_INSERT', 211);
define ('MONGO_STREAM_NOTIFY_LOG_QUERY', 212);
define ('MONGO_STREAM_NOTIFY_LOG_UPDATE', 213);
define ('MONGO_STREAM_NOTIFY_LOG_DELETE', 214);
define ('MONGO_STREAM_NOTIFY_LOG_GETMORE', 215);
define ('MONGO_STREAM_NOTIFY_LOG_KILLCURSOR', 216);
define ('MONGO_STREAM_NOTIFY_LOG_BATCHINSERT', 217);
define ('MONGO_STREAM_NOTIFY_LOG_RESPONSE_HEADER', 218);
define ('MONGO_STREAM_NOTIFY_LOG_WRITE_REPLY', 219);
define ('MONGO_STREAM_NOTIFY_LOG_CMD_INSERT', 220);
define ('MONGO_STREAM_NOTIFY_LOG_CMD_UPDATE', 221);
define ('MONGO_STREAM_NOTIFY_LOG_CMD_DELETE', 222);
define ('MONGO_STREAM_NOTIFY_LOG_WRITE_BATCH', 223);

// End of mongo v.1.6.11
?>
