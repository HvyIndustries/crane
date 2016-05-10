<?php

// Start of OAuth v.1.2.3

/**
 * The OAuth extension provides a simple interface to interact with
 * data providers using the OAuth HTTP specification to protect
 * private resources.
 * @link http://php.net/manual/en/class.oauth.php
 */
class OAuth  {
	public $debug;
	public $sslChecks;
	public $debugInfo;


	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Create a new OAuth object
	 * @link http://php.net/manual/en/oauth.construct.php
	 * @param string $consumer_key <p>
	 * The consumer key provided by the service provider.
	 * </p>
	 * @param string $consumer_secret <p>
	 * The consumer secret provided by the service provider.
	 * </p>
	 * @param string $signature_method [optional] <p>
	 * This optional parameter defines which signature method to use, by default it is <b>OAUTH_SIG_METHOD_HMACSHA1</b> (HMAC-SHA1).
	 * </p>
	 * @param int $auth_type [optional] <p>
	 * This optional parameter defines how to pass the OAuth parameters
	 * to a consumer, by default it is
	 * <b>OAUTH_AUTH_TYPE_AUTHORIZATION</b> (in the
	 * Authorization header).
	 * </p>
	 */
	public function __construct ($consumer_key, $consumer_secret, $signature_method = 'OAUTH_SIG_METHOD_HMACSHA1', $auth_type = 0) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Set the RSA certificate
	 * @link http://php.net/manual/en/oauth.setrsacertificate.php
	 * @param string $cert <p>
	 * The RSA certificate.
	 * </p>
	 * @return mixed <b>TRUE</b> on success, or <b>FALSE</b> on failure (e.g., the RSA certificate
	 * cannot be parsed.)
	 */
	public function setRSACertificate ($cert) {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Fetch a request token
	 * @link http://php.net/manual/en/oauth.getrequesttoken.php
	 * @param string $request_token_url <p>
	 * URL to the request token API.
	 * </p>
	 * @param string $callback_url [optional] <p>
	 * OAuth callback URL. If <i>callback_url</i> is passed and is an empty value, it is set to "oob" to address the OAuth 2009.1 advisory.
	 * </p>
	 * @param string $http_method [optional] <p>
	 * HTTP method to use, e.g. GET or POST.
	 * </p>
	 * @return array an array containing the parsed OAuth response on success or <b>FALSE</b> on failure.
	 */
	public function getRequestToken ($request_token_url, $callback_url = null, $http_method = null) {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Fetch an access token
	 * @link http://php.net/manual/en/oauth.getaccesstoken.php
	 * @param string $access_token_url <p>
	 * URL to the access token API.
	 * </p>
	 * @param string $auth_session_handle [optional] <p>
	 * Authorization session handle, this parameter does not have any
	 * citation in the core OAuth 1.0 specification but may be
	 * implemented by large providers.
	 * See ScalableOAuth
	 * for more information.
	 * </p>
	 * @param string $verifier_token [optional] <p>
	 * For service providers which support 1.0a, a <i>verifier_token</i>
	 * must be passed while exchanging the request token for the access
	 * token. If the <i>verifier_token</i> is present in <i>$_GET</i>
	 * or <i>$_POST</i> it is passed automatically and the caller
	 * does not need to specify a <i>verifier_token</i> (usually if the access token
	 * is exchanged at the oauth_callback URL).
	 * See ScalableOAuth
	 * for more information.
	 * </p>
	 * @param string $http_method [optional] <p>
	 * HTTP method to use, e.g. GET or POST.
	 * </p>
	 * @return array an array containing the parsed OAuth response on success or <b>FALSE</b> on failure.
	 */
	public function getAccessToken ($access_token_url, $auth_session_handle = null, $verifier_token = null, $http_method = null) {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Get the last response
	 * @link http://php.net/manual/en/oauth.getlastresponse.php
	 * @return string a string containing the last response.
	 */
	public function getLastResponse () {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Get HTTP information about the last response
	 * @link http://php.net/manual/en/oauth.getlastresponseinfo.php
	 * @return array an array containing the response information for the last
	 * request. Constants from <b>curl_getinfo</b> may be
	 * used.
	 */
	public function getLastResponseInfo () {}

	/**
	 * (No version information available, might only be in Git)<br/>
	 * Get headers for last response
	 * @link http://php.net/manual/en/oauth.getlastresponseheaders.php
	 * @return string A string containing the last response's headers or <b>FALSE</b> on failure
	 */
	public function getLastResponseHeaders () {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Sets the token and secret
	 * @link http://php.net/manual/en/oauth.settoken.php
	 * @param string $token <p>
	 * The OAuth token.
	 * </p>
	 * @param string $token_secret <p>
	 * The OAuth token secret.
	 * </p>
	 * @return bool <b>TRUE</b>
	 */
	public function setToken ($token, $token_secret) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * The setRequestEngine purpose
	 * @link http://php.net/manual/en/oauth.setrequestengine.php
	 * @param int $reqengine <p>
	 * The desired request engine. Set to <b>OAUTH_REQENGINE_STREAMS</b>
	 * to use PHP Streams, or <b>OAUTH_REQENGINE_CURL</b> to use
	 * Curl.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setRequestEngine ($reqengine) {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Set the OAuth version
	 * @link http://php.net/manual/en/oauth.setversion.php
	 * @param string $version <p>
	 * OAuth version, default value is always "1.0"
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setVersion ($version) {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Set authorization type
	 * @link http://php.net/manual/en/oauth.setauthtype.php
	 * @param int $auth_type <p>
	 * <i>auth_type</i> can be one of the following flags (in order of decreasing preference as per OAuth 1.0 section 5.2):
	 * <b>OAUTH_AUTH_TYPE_AUTHORIZATION</b>
	 * Pass the OAuth parameters in the HTTP Authorization header.
	 * @return mixed <b>TRUE</b> if a parameter is correctly set, otherwise <b>FALSE</b>
	 * (e.g., if an invalid <i>auth_type</i> is passed in.)
	 */
	public function setAuthType ($auth_type) {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Set the nonce for subsequent requests
	 * @link http://php.net/manual/en/oauth.setnonce.php
	 * @param string $nonce <p>
	 * The value for oauth_nonce.
	 * </p>
	 * @return mixed <b>TRUE</b> on success, or <b>FALSE</b> if the
	 * <i>nonce</i> is considered invalid.
	 */
	public function setNonce ($nonce) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Set the timestamp
	 * @link http://php.net/manual/en/oauth.settimestamp.php
	 * @param string $timestamp <p>
	 * The timestamp.
	 * </p>
	 * @return mixed <b>TRUE</b>, unless the <i>timestamp</i> is invalid, in which
	 * case <b>FALSE</b> is returned.
	 */
	public function setTimestamp ($timestamp) {}

	/**
	 * (PECL OAuth &gt;= 0.99.1)<br/>
	 * Fetch an OAuth protected resource
	 * @link http://php.net/manual/en/oauth.fetch.php
	 * @param string $protected_resource_url <p>
	 * URL to the OAuth protected resource.
	 * </p>
	 * @param array $extra_parameters [optional] <p>
	 * Extra parameters to send with the request for the resource.
	 * </p>
	 * @param string $http_method [optional] <p>
	 * One of the <b>OAUTH_HTTP_METHOD_*</b>
	 * OAUTH constants, which includes
	 * GET, POST, PUT, HEAD, or DELETE.
	 * </p>
	 * <p>
	 * HEAD (<b>OAUTH_HTTP_METHOD_HEAD</b>) can be useful for
	 * discovering information prior to the request (if OAuth credentials are
	 * in the Authorization header).
	 * </p>
	 * @param array $http_headers [optional] <p>
	 * HTTP client headers (such as User-Agent, Accept, etc.)
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function fetch ($protected_resource_url, array $extra_parameters = null, $http_method = null, array $http_headers = null) {}

	/**
	 * (PECL OAuth &gt;= 0.99.3)<br/>
	 * Turn on verbose debugging
	 * @link http://php.net/manual/en/oauth.enabledebug.php
	 * @return bool <b>TRUE</b>
	 */
	public function enableDebug () {}

	/**
	 * (PECL OAuth &gt;= 0.99.3)<br/>
	 * Turn off verbose debugging
	 * @link http://php.net/manual/en/oauth.disabledebug.php
	 * @return bool <b>TRUE</b>
	 */
	public function disableDebug () {}

	/**
	 * (PECL OAuth &gt;= 0.99.5)<br/>
	 * Turn on SSL checks
	 * @link http://php.net/manual/en/oauth.enablesslchecks.php
	 * @return bool <b>TRUE</b>
	 */
	public function enableSSLChecks () {}

	/**
	 * (PECL OAuth &gt;= 0.99.5)<br/>
	 * Turn off SSL checks
	 * @link http://php.net/manual/en/oauth.disablesslchecks.php
	 * @return bool <b>TRUE</b>
	 */
	public function disableSSLChecks () {}

	/**
	 * (PECL OAuth &gt;= 0.99.9)<br/>
	 * Turn on redirects
	 * @link http://php.net/manual/en/oauth.enableredirects.php
	 * @return bool <b>TRUE</b>
	 */
	public function enableRedirects () {}

	/**
	 * (PECL OAuth &gt;= 0.99.9)<br/>
	 * Turn off redirects
	 * @link http://php.net/manual/en/oauth.disableredirects.php
	 * @return bool <b>TRUE</b>
	 */
	public function disableRedirects () {}

	/**
	 * (PECL OAuth &gt;= 0.99.8)<br/>
	 * Set CA path and info
	 * @link http://php.net/manual/en/oauth.setcapath.php
	 * @param string $ca_path [optional] <p>
	 * The CA Path being set.
	 * </p>
	 * @param string $ca_info [optional] <p>
	 * The CA Info being set.
	 * </p>
	 * @return mixed <b>TRUE</b> on success, or <b>FALSE</b> if either <i>ca_path</i>
	 * or <i>ca_info</i> are considered invalid.
	 */
	public function setCAPath ($ca_path = null, $ca_info = null) {}

	/**
	 * (PECL OAuth &gt;= 0.99.8)<br/>
	 * Gets CA information
	 * @link http://php.net/manual/en/oauth.getcapath.php
	 * @return array An array of Certificate Authority information, specifically as
	 * ca_path and ca_info keys within the returned
	 * associative array.
	 */
	public function getCAPath () {}

	/**
	 * (No version information available, might only be in Git)<br/>
	 * Generate a signature
	 * @link http://php.net/manual/en/oauth.generatesignature.php
	 * @param string $http_method <p>
	 * HTTP method for request
	 * </p>
	 * @param string $url <p>
	 * URL for request
	 * </p>
	 * @param mixed $extra_parameters [optional] <p>
	 * String or array of additional parameters.
	 * </p>
	 * @return string A string containing the generated signature or <b>FALSE</b> on failure
	 */
	public function generateSignature ($http_method, $url, $extra_parameters = null) {}

	/**
	 * @param $timeout_in_milliseconds
	 */
	public function setTimeout ($timeout_in_milliseconds) {}

	/**
	 * (No version information available, might only be in Git)<br/>
	 * Tweak specific SSL checks for requests.
	 * @link http://php.net/manual/en/oauth.setsslchecks.php
	 * @param int $sslcheck <p>
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setSSLChecks ($sslcheck) {}

	/**
	 * (No version information available, might only be in Git)<br/>
	 * Generate OAuth header string signature
	 * @link http://php.net/manual/en/oauth.getrequestheader.php
	 * @param string $http_method <p>
	 * HTTP method for request.
	 * </p>
	 * @param string $url <p>
	 * URL for request.
	 * </p>
	 * @param mixed $extra_parameters [optional] <p>
	 * String or array of additional parameters.
	 * </p>
	 * @return string A string containing the generated request header or <b>FALSE</b> on failure
	 */
	public function getRequestHeader ($http_method, $url, $extra_parameters = null) {}

	/**
	 * (PECL OAuth &gt;= 0.99.9)<br/>
	 * The destructor
	 * @link http://php.net/manual/en/oauth.destruct.php
	 * @return void No value is returned.
	 */
	public function __destruct () {}

}

/**
 * This exception is thrown when exceptional errors occur while using the OAuth extension and contains useful debugging information.
 * @link http://php.net/manual/en/class.oauthexception.php
 */
class OAuthException extends Exception  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;
	public $lastResponse;
	public $debugInfo;


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
 * Manages an OAuth provider class.
 * @link http://php.net/manual/en/class.oauthprovider.php
 */
class OAuthProvider  {

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Constructs a new OAuthProvider object
	 * @link http://php.net/manual/en/oauthprovider.construct.php
	 * @param array $params_array [optional] <p>
	 * Setting these optional parameters is limited to the
	 * CLI SAPI.
	 * </p>
	 */
	public function __construct (array $params_array = null) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Set the consumerHandler handler callback
	 * @link http://php.net/manual/en/oauthprovider.consumerhandler.php
	 * @param callable $callback_function <p>
	 * The callable functions name.
	 * </p>
	 * @return void No value is returned.
	 */
	public function consumerHandler (callable $callback_function) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Set the tokenHandler handler callback
	 * @link http://php.net/manual/en/oauthprovider.tokenhandler.php
	 * @param callable $callback_function <p>
	 * The callable functions name.
	 * </p>
	 * @return void No value is returned.
	 */
	public function tokenHandler (callable $callback_function) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Set the timestampNonceHandler handler callback
	 * @link http://php.net/manual/en/oauthprovider.timestampnoncehandler.php
	 * @param callable $callback_function <p>
	 * The callable functions name.
	 * </p>
	 * @return void No value is returned.
	 */
	public function timestampNonceHandler (callable $callback_function) {}

	/**
	 * (No version information available, might only be in Git)<br/>
	 * Calls the consumerNonceHandler callback
	 * @link http://php.net/manual/en/oauthprovider.callconsumerhandler.php
	 * @return void No value is returned.
	 */
	public function callconsumerHandler () {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Calls the tokenNonceHandler callback
	 * @link http://php.net/manual/en/oauthprovider.calltokenhandler.php
	 * @return void No value is returned.
	 */
	public function calltokenHandler () {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Calls the timestampNonceHandler callback
	 * @link http://php.net/manual/en/oauthprovider.calltimestampnoncehandler.php
	 * @return void No value is returned.
	 */
	public function callTimestampNonceHandler () {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Check an oauth request
	 * @link http://php.net/manual/en/oauthprovider.checkoauthrequest.php
	 * @param string $uri [optional] <p>
	 * The optional URI, or endpoint.
	 * </p>
	 * @param string $method [optional] <p>
	 * The HTTP method. Optionally pass in one of the
	 * <b>OAUTH_HTTP_METHOD_*</b> OAuth constants.
	 * </p>
	 * @return void No value is returned.
	 */
	public function checkOAuthRequest ($uri = null, $method = null) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Sets isRequestTokenEndpoint
	 * @link http://php.net/manual/en/oauthprovider.isrequesttokenendpoint.php
	 * @param bool $will_issue_request_token <p>
	 * Sets whether or not it will issue a request token, thus determining if
	 * <b>OAuthProvider::tokenHandler</b> needs to be called.
	 * </p>
	 * @return void No value is returned.
	 */
	public function isRequestTokenEndpoint ($will_issue_request_token) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Set request token path
	 * @link http://php.net/manual/en/oauthprovider.setrequesttokenpath.php
	 * @param string $path <p>
	 * The path.
	 * </p>
	 * @return bool <b>TRUE</b>
	 */
	final public function setRequestTokenPath ($path) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Add required parameters
	 * @link http://php.net/manual/en/oauthprovider.addrequiredparameter.php
	 * @param string $req_params <p>
	 * The required parameters.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	final public function addRequiredParameter ($req_params) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Report a problem
	 * @link http://php.net/manual/en/oauthprovider.reportproblem.php
	 * @param string $oauthexception <p>
	 * The <b>OAuthException</b>.
	 * </p>
	 * @param bool $send_headers [optional]
	 * @return string No value is returned.
	 */
	final public static function reportProblem ($oauthexception, $send_headers = true) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Set a parameter
	 * @link http://php.net/manual/en/oauthprovider.setparam.php
	 * @param string $param_key <p>
	 * The parameter key.
	 * </p>
	 * @param mixed $param_val [optional] <p>
	 * The optional parameter value.
	 * </p>
	 * <p>
	 * To exclude a parameter from signature verification, set
	 * its value to <b>NULL</b>.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	final public function setParam ($param_key, $param_val = null) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Remove a required parameter
	 * @link http://php.net/manual/en/oauthprovider.removerequiredparameter.php
	 * @param string $req_params <p>
	 * The required parameter to be removed.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	final public function removeRequiredParameter ($req_params) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * Generate a random token
	 * @link http://php.net/manual/en/oauthprovider.generatetoken.php
	 * @param int $size <p>
	 * The desired token length, in terms of bytes.
	 * </p>
	 * @param bool $strong [optional] <p>
	 * Setting to <b>TRUE</b> means /dev/random will be used for
	 * entropy, as otherwise the non-blocking /dev/urandom is used.
	 * This parameter is ignored on Windows.
	 * </p>
	 * @return string The generated token, as a string of bytes.
	 */
	final public static function generateToken ($size, $strong = false) {}

	/**
	 * (PECL OAuth &gt;= 1.0.0)<br/>
	 * is2LeggedEndpoint
	 * @link http://php.net/manual/en/oauthprovider.is2leggedendpoint.php
	 * @param mixed $params_array <p>
	 * </p>
	 * @return void An <b>OAuthProvider</b> object.
	 */
	public function is2LeggedEndpoint ($params_array) {}

}

/**
 * (PECL OAuth &gt;=0.99.2)<br/>
 * Encode a URI to RFC 3986
 * @link http://php.net/manual/en/function.oauth-urlencode.php
 * @param string $uri <p>
 * URI to encode.
 * </p>
 * @return string an RFC 3986 encoded string.
 */
function oauth_urlencode ($uri) {}

/**
 * (PECL OAuth &gt;=0.99.7)<br/>
 * Generate a Signature Base String
 * @link http://php.net/manual/en/function.oauth-get-sbs.php
 * @param string $http_method <p>
 * The HTTP method.
 * </p>
 * @param string $uri <p>
 * URI to encode.
 * </p>
 * @param array $request_parameters [optional] <p>
 * Array of request parameters.
 * </p>
 * @return string a Signature Base String.
 */
function oauth_get_sbs ($http_method, $uri, array $request_parameters = null) {}


/**
 * <p>
 * OAuth HMAC-SHA1 signature method.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_SIG_METHOD_HMACSHA1', "HMAC-SHA1");

/**
 * OAuth HMAC-SHA256 signature method.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_SIG_METHOD_HMACSHA256', "HMAC-SHA256");

/**
 * OAuth RSA-SHA1 signature method.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_SIG_METHOD_RSASHA1', "RSA-SHA1");
define ('OAUTH_SIG_METHOD_PLAINTEXT', "PLAINTEXT");

/**
 * <p>
 * This constant represents putting OAuth parameters in the
 * Authorization header.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_AUTH_TYPE_AUTHORIZATION', 3);

/**
 * <p>
 * This constant represents putting OAuth parameters in the request
 * URI.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_AUTH_TYPE_URI', 1);

/**
 * <p>
 * This constant represents putting OAuth parameters as part of the
 * HTTP POST body.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_AUTH_TYPE_FORM', 2);

/**
 * <p>
 * This constant indicates a NoAuth OAuth request.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_AUTH_TYPE_NONE', 4);

/**
 * <p>
 * Use the GET method for the OAuth request.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_HTTP_METHOD_GET', "GET");

/**
 * <p>
 * Use the POST method for the OAuth request.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_HTTP_METHOD_POST', "POST");

/**
 * <p>
 * Use the PUT method for the OAuth request.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_HTTP_METHOD_PUT', "PUT");

/**
 * <p>
 * Use the HEAD method for the OAuth request.
 * </p>
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_HTTP_METHOD_HEAD', "HEAD");

/**
 * Use the DELETE method for the OAuth request.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_HTTP_METHOD_DELETE', "DELETE");

/**
 * Used by <b>OAuth::setRequestEngine</b> to set the engine to
 * PHP streams,
 * as opposed to <b>OAUTH_REQENGINE_CURL</b> for
 * Curl.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_REQENGINE_STREAMS', 1);
define ('OAUTH_SSLCHECK_NONE', 0);
define ('OAUTH_SSLCHECK_HOST', 1);
define ('OAUTH_SSLCHECK_PEER', 2);
define ('OAUTH_SSLCHECK_BOTH', 3);

/**
 * Life is good.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_OK', 0);

/**
 * The oauth_nonce value was used in a previous request,
 * therefore it cannot be used now.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_BAD_NONCE', 4);

/**
 * The oauth_timestamp value was not accepted by the service provider. In
 * this case, the response should also contain the oauth_acceptable_timestamps
 * parameter.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_BAD_TIMESTAMP', 8);

/**
 * The oauth_consumer_key is temporarily unacceptable to the service provider.
 * For example, the service provider may be throttling the consumer.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_CONSUMER_KEY_UNKNOWN', 16);

/**
 * The consumer key was refused.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_CONSUMER_KEY_REFUSED', 32);

/**
 * The oauth_signature is invalid, as it does not match the
 * signature computed by the service provider.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_INVALID_SIGNATURE', 64);

/**
 * The oauth_token has been consumed. It can no longer be
 * used because it has already been used in the previous request(s).
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_TOKEN_USED', 128);

/**
 * The oauth_token has expired.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_TOKEN_EXPIRED', 256);

/**
 * The oauth_token has been revoked, and will never be accepted.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_TOKEN_REVOKED', 512);

/**
 * The oauth_token was not accepted by the service provider.
 * The reason is not known, but it might be because the token was never issued,
 * already consumed, expired, and/or forgotten by the service provider.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_TOKEN_REJECTED', 1024);

/**
 * The oauth_verifier is incorrect.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_VERIFIER_INVALID', 2048);

/**
 * A required parameter was not received. In this case, the response should also
 * contain the oauth_parameters_absent parameter.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_PARAMETER_ABSENT', 4096);

/**
 * The oauth_signature_method was not accepted by service provider.
 * @link http://php.net/manual/en/oauth.constants.php
 */
define ('OAUTH_SIGNATURE_METHOD_REJECTED', 8192);

// End of OAuth v.1.2.3
?>
