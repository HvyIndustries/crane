<?php

/**
 * Represents a view query to be executed against a Couchbase bucket.
 *
 * @package Couchbase
 */
class CouchbaseViewQuery  {
	const UPDATE_BEFORE = 1;
	const UPDATE_NONE = 2;
	const UPDATE_AFTER = 3;
	const ORDER_ASCENDING = 1;
	const ORDER_DESCENDING = 2;

	/**
     * @var string
     * @internal
     */
	public $ddoc;
	/**
     * @var string
     * @internal
     */
	public $name;
	/**
     * @var array
     * @internal
     */
	public $options;


	/**
     * @internal
     */
	private function __construct () {}

	/**
     * Creates a new Couchbase ViewQuery instance for performing a view query.
     *
     * @param $ddoc The name of the design document to query.
     * @param $name The name of the view to query.
     * @return _CouchbaseDefaultViewQuery
     */
	public static function from ($ddoc = null, $name = null) {}

	/**
     * Creates a new Couchbase ViewQuery instance for performing a spatial query.
     *
     * @param $ddoc The name of the design document to query.
     * @param $name The name of the view to query.
     * @return _CouchbaseSpatialViewQuery
     */
	public static function fromSpatial ($ddoc = null, $name = null) {}

	/**
     * Specifies the mode of updating to perform before and after executing
     * this query.
     *
     * @param $stale
     * @return $this
     * @throws CouchbaseException
     */
	public function stale ($stale = null) {}

	/**
     * Skips a number of records from the beginning of the result set.
     *
     * @param $skip
     * @return $this
     */
	public function skip ($skip = null) {}

	/**
     * Limits the result set to a restricted number of results.
     *
     * @param $limit
     * @return $this
     */
	public function limit ($limit = null) {}

	/**
     * Specifies custom options to pass to the server.  Note that these
     * options are expected to be already encoded.
     *
     * @param $opts
     * @return $this
     */
	public function custom ($opts = null) {}

	/**
     * Generates the view query as it will be passed to the server.
     *
     * @return string
     * @internal
     */
	public function _toString ($type = null) {}

}

/**
 * Represents a regular view query to perform against the server.  Note that
 * this object should never be instantiated directly, but instead through
 * the CouchbaseViewQuery::from method.
 *
 * @package Couchbase
 */
class _CouchbaseDefaultViewQuery extends CouchbaseViewQuery  {
	const UPDATE_BEFORE = 1;
	const UPDATE_NONE = 2;
	const UPDATE_AFTER = 3;
	const ORDER_ASCENDING = 1;
	const ORDER_DESCENDING = 2;

	/**
     * @var string
     * @internal
     */
	public $ddoc;
	/**
     * @var string
     * @internal
     */
	public $name;
	/**
     * @var array
     * @internal
     */
	public $options;


	/**
     * @internal
     */
	public function __construct () {}

	/**
     * Orders the results by key as specified.
     *
     * @param $order
     * @return $this
     * @throws CouchbaseException
     */
	public function order ($order = null) {}

	/**
     * Specifies a reduction function to apply to the index.
     *
     * @param $reduce
     * @return $this
     */
	public function reduce ($reduce = null) {}

	/**
     * Specifies the level of grouping to use on the results.
     *
     * @param $group_level
     * @return $this
     */
	public function group ($group = null) {}

	/**
     * Specifies the level at which to perform view grouping.
     * 
     * @param $group_level
     * @returns $this
     */
	public function group_level ($group_level = null) {}

	/**
     * Specifies a specific key to return from the index.
     *
     * @param $key
     * @return $this
     */
	public function key ($key = null) {}

	/**
     * Specifies a list of keys to return from the index.
     *
     * @param $keys
     * @return $this
     */
	public function keys ($keys = null) {}

	/**
     * Specifies a range of keys to return from the index.
     *
     * @param mixed $start
     * @param mixed $end
     * @param bool $inclusive_end
     * @return $this
     */
	public function range ($start = null, $end = null, $inclusive_end = null) {}

	/**
     * Specifies a range of document ids to return from the index.
     *
     * @param null $start
     * @param null $end
     * @return $this
     */
	public function id_range ($start = null, $end = null) {}

	/**
     * Generates the view query as it will be passed to the server.
     *
     * @return string
     */
	public function toString () {}

	/**
     * Creates a new Couchbase ViewQuery instance for performing a view query.
     *
     * @param $ddoc The name of the design document to query.
     * @param $name The name of the view to query.
     * @return _CouchbaseDefaultViewQuery
     */
	public static function from ($ddoc = null, $name = null) {}

	/**
     * Creates a new Couchbase ViewQuery instance for performing a spatial query.
     *
     * @param $ddoc The name of the design document to query.
     * @param $name The name of the view to query.
     * @return _CouchbaseSpatialViewQuery
     */
	public static function fromSpatial ($ddoc = null, $name = null) {}

	/**
     * Specifies the mode of updating to perform before and after executing
     * this query.
     *
     * @param $stale
     * @return $this
     * @throws CouchbaseException
     */
	public function stale ($stale = null) {}

	/**
     * Skips a number of records from the beginning of the result set.
     *
     * @param $skip
     * @return $this
     */
	public function skip ($skip = null) {}

	/**
     * Limits the result set to a restricted number of results.
     *
     * @param $limit
     * @return $this
     */
	public function limit ($limit = null) {}

	/**
     * Specifies custom options to pass to the server.  Note that these
     * options are expected to be already encoded.
     *
     * @param $opts
     * @return $this
     */
	public function custom ($opts = null) {}

	/**
     * Generates the view query as it will be passed to the server.
     *
     * @return string
     * @internal
     */
	public function _toString ($type = null) {}

}

/**
 * Represents a spatial view query to perform against the server.  Note that
 * this object should never be instantiated directly, but instead through
 * the CouchbaseViewQuery::fromSpatial method.
 *
 * @package Couchbase
 */
class _CouchbaseSpatialViewQuery extends CouchbaseViewQuery  {
	const UPDATE_BEFORE = 1;
	const UPDATE_NONE = 2;
	const UPDATE_AFTER = 3;
	const ORDER_ASCENDING = 1;
	const ORDER_DESCENDING = 2;

	/**
     * @var string
     * @internal
     */
	public $ddoc;
	/**
     * @var string
     * @internal
     */
	public $name;
	/**
     * @var array
     * @internal
     */
	public $options;


	/**
     * @internal
     */
	public function __construct () {}

	/**
     * Specifies the bounding box to search within.
     *
     * @param number[] $bbox
     * @return $this
     */
	public function bbox ($bbox = null) {}

	/**
     * Generates the view query as it will be passed to the server.
     *
     * @return string
     */
	public function toString () {}

	/**
     * Creates a new Couchbase ViewQuery instance for performing a view query.
     *
     * @param $ddoc The name of the design document to query.
     * @param $name The name of the view to query.
     * @return _CouchbaseDefaultViewQuery
     */
	public static function from ($ddoc = null, $name = null) {}

	/**
     * Creates a new Couchbase ViewQuery instance for performing a spatial query.
     *
     * @param $ddoc The name of the design document to query.
     * @param $name The name of the view to query.
     * @return _CouchbaseSpatialViewQuery
     */
	public static function fromSpatial ($ddoc = null, $name = null) {}

	/**
     * Specifies the mode of updating to perform before and after executing
     * this query.
     *
     * @param $stale
     * @return $this
     * @throws CouchbaseException
     */
	public function stale ($stale = null) {}

	/**
     * Skips a number of records from the beginning of the result set.
     *
     * @param $skip
     * @return $this
     */
	public function skip ($skip = null) {}

	/**
     * Limits the result set to a restricted number of results.
     *
     * @param $limit
     * @return $this
     */
	public function limit ($limit = null) {}

	/**
     * Specifies custom options to pass to the server.  Note that these
     * options are expected to be already encoded.
     *
     * @param $opts
     * @return $this
     */
	public function custom ($opts = null) {}

	/**
     * Generates the view query as it will be passed to the server.
     *
     * @return string
     * @internal
     */
	public function _toString ($type = null) {}

}

/**
 * Represents a N1QL query to be executed against a Couchbase bucket.
 *
 * @package Couchbase
 */
class CouchbaseN1qlQuery  {
	const NOT_BOUNDED = 1;
	const REQUEST_PLUS = 2;
	const STATEMENT_PLUS = 3;

	/**
     * @var string
     * @internal
     */
	public $options;


	/**
     * Creates a new N1qlQuery instance directly from a N1QL DML.
     * @param $str
     * @return CouchbaseN1qlQuery
     */
	public static function fromString ($str = null) {}

	/**
     * Specify the consistency level for this query.
     *
     * @param $consistency
     * @return $this
     * @throws CouchbaseException
     */
	public function consistency ($consistency = null) {}

	/**
     * Generates the N1QL object as it will be passed to the server.
     *
     * @return object
     */
	public function toObject () {}

	/**
     * Returns the string representation of this N1ql query (the statement).
     *
     * @return string
     */
	public function toString () {}

}

/**
 * Represents a cluster connection.
 *
 * @package Couchbase
 */
class CouchbaseCluster  {
	/**
     * @var _CouchbaseCluster
     * @ignore
     *
     * Pointer to a manager instance if there is one.
     */
	private $_manager;
	/**
     * @var string
     * @ignore
     *
     * A cluster DSN to connect with.
     */
	private $_dsn;


	/**
     * Creates a connection to a cluster.
     *
     * Creates a CouchbaseCluster object and begins the bootstrapping
     * process necessary for communications with the Couchbase Server.
     *
     * @param string $dsn A cluster DSn to connect with.
     * @param string $username The username for the cluster.
     * @param string $password The password for the cluster.
     *
     * @throws CouchbaseException
     */
	public function __construct ($dsn = null, $username = null, $password = null) {}

	/**
     * Constructs a connection to a bucket.
     *
     * @param string $name The name of the bucket to open.
     * @param string $password The bucket password to authenticate with.
     * @return CouchbaseBucket A bucket object.
     *
     * @throws CouchbaseException
     *
     * @see CouchbaseBucket CouchbaseBucket
     */
	public function openBucket ($name = null, $password = null) {}

	/**
     * Creates a manager allowing the management of a Couchbase cluster.
     *
     * @param $username The administration username.
     * @param $password The administration password.
     * @return CouchbaseClusterManager
     */
	public function manager ($username = null, $password = null) {}

}

/**
 * Class exposing the various available management operations that can be
 * performed on a cluster.
 *
 * @package Couchbase
 */
class CouchbaseClusterManager  {
	/**
     * @var _CouchbaseCluster
     * @ignore
     *
     * Pointer to our C binding backing class.
     */
	private $_me;


	/**
     * Constructs a cluster manager connection.
     *
     * @param string $connstr A connection string to connect with.
     * @param string $username The username to authenticate with.
     * @param string $password The password to authenticate with.
     *
     * @private
     * @ignore
     */
	public function __construct ($connstr = null, $username = null, $password = null) {}

	/**
     * Lists all buckets on this cluster.
     *
     * @return mixed
     */
	public function listBuckets () {}

	/**
     * Creates a new bucket on this cluster.
     *
     * @param string $name The bucket name.
     * @param array $opts The options for this bucket.
     * @return mixed
     */
	public function createBucket ($name = null, $opts = null) {}

	/**
     * Deletes a bucket from the cluster.
     *
     * @param string $name
     * @return mixed
     */
	public function removeBucket ($name = null) {}

	/**
     * Retrieves cluster status information
     *
     * Returns an associative array of status information as seen
     * on the cluster.  The exact structure of the returned data
     * can be seen in the Couchbase Manual by looking at the
     * cluster /info endpoint.
     *
     * @return mixed The status information.
     *
     * @throws CouchbaseException
     */
	public function info () {}

}

/**
 * Represents a bucket connection.
 *
 * Note: This class must be constructed by calling the openBucket
 * method of the CouchbaseCluster class.
 *
 * @property integer $operationTimeout
 * @property integer $viewTimeout
 * @property integer $durabilityInterval
 * @property integer $durabilityTimeout
 * @property integer $httpTimeout
 * @property integer $configTimeout
 * @property integer $configDelay
 * @property integer $configNodeTimeout
 * @property integer $htconfigIdleTimeout
 *
 * @package Couchbase
 *
 * @see CouchbaseCluster::openBucket()
 */
class CouchbaseBucket  {
	/**
     * @var _CouchbaseBucket
     * @ignore
     *
     * Pointer to our C binding backing class.
     */
	private $me;
	/**
     * @var string
     * @ignore
     *
     * The name of the bucket this object represents.
     */
	private $name;
	/**
     * @var _CouchbaseCluster
     * @ignore
     *
     * Pointer to a manager instance if there is one.
     */
	private $_manager;
	/**
     * @var array
     * @ignore
     *
     * A list of N1QL nodes to query.
     */
	private $queryhosts;


	/**
     * Constructs a bucket connection.
     *
     * @private
     * @ignore
     *
     * @param string $dsn A cluster DSN to connect with.
     * @param string $name The name of the bucket to connect to.
     * @param string $password The password to authenticate with.
     *
     * @private
     */
	public function __construct ($dsn = null, $name = null, $password = null) {}

	/**
     * Returns an instance of a CouchbaseBucketManager for performing management
     * operations against a bucket.
     *
     * @return CouchbaseBucketManager
     */
	public function manager () {}

	/**
     * Enables N1QL support on the client.  A cbq-server URI must be passed.
     * This method will be deprecated in the future in favor of automatic
     * configuration through the connected cluster.
     *
     * @param $hosts An array of host/port combinations which are N1QL servers
     * attached to the cluster.
     */
	public function enableN1ql ($hosts = null) {}

	/**
     * Inserts a document.  This operation will fail if
     * the document already exists on the cluster.
     *
     * @param string|array $ids
     * @param mixed $val
     * @param array $options expiry,flags
     * @return mixed
     */
	public function insert ($ids = null, $val = null, $options = null) {}

	/**
     * Inserts or updates a document, depending on whether the
     * document already exists on the cluster.
     *
     * @param string|array $ids
     * @param mixed $val
     * @param array $options expiry,flags
     * @return mixed
     */
	public function upsert ($ids = null, $val = null, $options = null) {}

	/**
     * Replaces a document.
     *
     * @param string|array $ids
     * @param mixed $val
     * @param array $options cas,expiry,flags
     * @return mixed
     */
	public function replace ($ids = null, $val = null, $options = null) {}

	/**
     * Appends content to a document.
     *
     * @param string|array $ids
     * @param mixed $val
     * @param array $options cas
     * @return mixed
     */
	public function append ($ids = null, $val = null, $options = null) {}

	/**
     * Prepends content to a document.
     *
     * @param string|array $ids
     * @param mixed $val
     * @param array $options cas
     * @return mixed
     */
	public function prepend ($ids = null, $val = null, $options = null) {}

	/**
     * Deletes a document.
     *
     * @param string|array $ids
     * @param array $options cas
     * @return mixed
     */
	public function remove ($ids = null, $options = null) {}

	/**
     * Retrieves a document.
     *
     * @param string|array $ids
     * @param array $options lock
     * @return mixed
     */
	public function get ($ids = null, $options = null) {}

	/**
     * Retrieves a document and simultaneously updates its expiry.
     *
     * @param string $id
     * @param integer $expiry
     * @param array $options
     * @return mixed
     */
	public function getAndTouch ($id = null, $expiry = null, $options = null) {}

	/**
     * Retrieves a document and locks it.
     *
     * @param string $id
     * @param integer $lockTime
     * @param array $options
     * @return mixed
     */
	public function getAndLock ($id = null, $lockTime = null, $options = null) {}

	/**
     * Retrieves a document from a replica.
     *
     * @param string $id
     * @param array $options
     * @return mixed
     */
	public function getFromReplica ($id = null, $options = null) {}

	/**
     * Updates a documents expiry.
     *
     * @param string $id
     * @param integer $expiry
     * @param array $options
     * @return mixed
     */
	public function touch ($id = null, $expiry = null, $options = null) {}

	/**
     * Increment or decrements a key (based on $delta).
     *
     * @param string|array $ids
     * @param integer $delta
     * @param array $options initial,expiry
     * @return mixed
     */
	public function counter ($ids = null, $delta = null, $options = null) {}

	/**
     * Unlocks a key previous locked with a call to get().
     * @param string|array $ids
     * @param array $options cas
     * @return mixed
     */
	public function unlock ($ids = null, $options = null) {}

	/**
     * Executes a view query.
     *
     * @param ViewQuery $queryObj
     * @return mixed
     * @throws CouchbaseException
     *
     * @internal
     */
	public function _view ($queryObj = null) {}

	/**
     * Performs a N1QL query.
     *
     * @param $dmlstring
     * @return mixed
     * @throws CouchbaseException
     *
     * @internal
     */
	public function _n1ql ($queryObj = null) {}

	/**
     * Performs a query (either ViewQuery or N1qlQuery).
     *
     * @param CouchbaseQuery $query
     * @return mixed
     * @throws CouchbaseException
     */
	public function query ($query = null) {}

	/**
     * Sets custom encoder and decoder functions for handling serialization.
     *
     * @param string $encoder The encoder function name
     * @param string $decoder The decoder function name
     */
	public function setTranscoder ($encoder = null, $decoder = null) {}

	/**
     * Ensures durability requirements are met for an executed
     *  operation.  Note that this function will automatically
     *  determine the result types and check for any failures.
     *
     * @private
     * @ignore
     *
     * @param $id
     * @param $res
     * @param $options
     * @return mixed
     * @throws Exception
     */
	private function _endure ($id = null, $options = null, $res = null) {}

	/**
     * Magic function to handle the retrieval of various properties.
     *
     * @internal
     */
	public function __get ($name = null) {}

	/**
     * Magic function to handle the setting of various properties.
     *
     * @internal
     */
	public function __set ($name = null, $value = null) {}

}

/**
 * Class exposing the various available management operations that can be
 * performed on a bucket.
 *
 * @package Couchbase
 */
class CouchbaseBucketManager  {
	/**
     * @var _CouchbaseBucket
     * @ignore
     *
     * Pointer to our C binding backing class.
     */
	private $_me;
	/**
     * @var string
     * @ignore
     *
     * Name of the bucket we are managing
     */
	private $_name;


	/**
     * @private
     * @ignore
     *
     * @param $binding
     * @param $name
     */
	public function __construct ($binding = null, $name = null) {}

	/**
     * Returns all the design documents for this bucket.
     *
     * @return mixed
     */
	public function getDesignDocuments () {}

	/**
     * Inserts a design document to this bucket.  Failing if a design
     * document with the same name already exists.
     *
     * @param $name Name of the design document.
     * @param $data The design document data.
     * @throws CouchbaseException
     * @returns true
     */
	public function insertDesignDocument ($name = null, $data = null) {}

	/**
     * Inserts a design document to this bucket.  Overwriting any existing
     * design document with the same name.
     *
     * @param $name Name of the design document.
     * @param $data The design document data.
     * @returns true
     */
	public function upsertDesignDocument ($name = null, $data = null) {}

	/**
     * Retrieves a design documents from the bucket.
     *
     * @param $name Name of the design document.
     * @return mixed
     */
	public function getDesignDocument ($name = null) {}

	/**
     * Deletes a design document from the bucket.
     *
     * @param $name Name of the design document.
     * @return mixed
     */
	public function removeDesignDocument ($name = null) {}

	/**
     * Flushes this bucket (clears all data).
     *
     * @return mixed
     */
	public function flush () {}

	/**
     * Retrieves bucket status information
     *
     * Returns an associative array of status information as seen
     * by the cluster for this bucket.  The exact structure of the
     * returned data can be seen in the Couchbase Manual by looking
     * at the bucket /info endpoint.
     *
     * @return mixed The status information.
     */
	public function info () {}

}


/**
 * The full path and filename of the file with symlinks resolved. If used inside an include,
 * the name of the included file is returned.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__FILE__', null);

/**
 * The current line number of the file.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__LINE__', null);

/**
 * The class name. The class name includes the namespace
 * it was declared in (e.g. Foo\Bar).
 * Note that as of PHP 5.4 __CLASS__ works also in traits. When used
 * in a trait method, __CLASS__ is the name of the class the trait
 * is used in.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__CLASS__', "");

/**
 * The function name.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__FUNCTION__', null);

/**
 * The class method name.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__METHOD__', null);

/**
 * The trait name. The trait name includes the namespace
 * it was declared in (e.g. Foo\Bar).
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__TRAIT__', null);

/**
 * The directory of the file. If used inside an include,
 * the directory of the included file is returned. This is equivalent
 * to dirname(__FILE__). This directory name
 * does not have a trailing slash unless it is the root directory.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__DIR__', null);

/**
 * The name of the current namespace.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__NAMESPACE__', null);
?>
