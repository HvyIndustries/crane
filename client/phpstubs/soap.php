<?php

// Start of soap v.

/**
 * The SoapClient class provides a client for SOAP 1.1, SOAP 1.2 servers. It can be used in WSDL
 * or non-WSDL mode.
 * @link http://php.net/manual/en/class.soapclient.php
 */
class SoapClient  {

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * SoapClient constructor
	 * @link http://php.net/manual/en/soapclient.soapclient.php
	 * @param mixed $wsdl <p>
	 * URI of the WSDL file or <b>NULL</b> if working in
	 * non-WSDL mode.
	 * </p>
	 * <p>
	 * During development, WSDL caching may be disabled by the
	 * use of the soap.wsdl_cache_ttl <i>php.ini</i> setting
	 * otherwise changes made to the WSDL file will have no effect until
	 * soap.wsdl_cache_ttl is expired.
	 * </p>
	 * @param array $options [optional] <p>
	 * An array of options. If working in WSDL mode, this parameter is optional.
	 * If working in non-WSDL mode, the location and
	 * uri options must be set, where location
	 * is the URL of the SOAP server to send the request to, and uri
	 * is the target namespace of the SOAP service.
	 * </p>
	 * <p>
	 * The style and use options only work in
	 * non-WSDL mode. In WSDL mode, they come from the WSDL file.
	 * </p>
	 * <p>
	 * The soap_version option should be one of either
	 * <b>SOAP_1_1</b> or <b>SOAP_1_2</b> to
	 * select SOAP 1.1 or 1.2, respectively. If omitted, 1.1 is used.
	 * </p>
	 * <p>
	 * For HTTP authentication, the login and
	 * password options can be used to supply credentials.
	 * For making an HTTP connection through
	 * a proxy server, the options proxy_host,
	 * proxy_port, proxy_login
	 * and proxy_password are also available.
	 * For HTTPS client certificate authentication use
	 * local_cert and passphrase options. An
	 * authentication may be supplied in the authentication
	 * option. The authentication method may be either
	 * <b>SOAP_AUTHENTICATION_BASIC</b> (default) or
	 * <b>SOAP_AUTHENTICATION_DIGEST</b>.
	 * </p>
	 * <p>
	 * The compression option allows to use compression
	 * of HTTP SOAP requests and responses.
	 * </p>
	 * <p>
	 * The encoding option defines internal character
	 * encoding. This option does not change the encoding of SOAP requests (it is
	 * always utf-8), but converts strings into it.
	 * </p>
	 * <p>
	 * The trace option enables tracing of request so faults
	 * can be backtraced. This defaults to <b>FALSE</b>
	 * </p>
	 * <p>
	 * The classmap option can be used to map some WSDL
	 * types to PHP classes. This option must be an array with WSDL types
	 * as keys and names of PHP classes as values.
	 * </p>
	 * <p>
	 * Setting the boolean trace option enables use of the
	 * methods
	 * SoapClient->__getLastRequest,
	 * SoapClient->__getLastRequestHeaders,
	 * SoapClient->__getLastResponse and
	 * SoapClient->__getLastResponseHeaders.
	 * </p>
	 * <p>
	 * The exceptions option is a boolean value defining whether
	 * soap errors throw exceptions of type
	 * SoapFault.
	 * </p>
	 * <p>
	 * The connection_timeout option defines a timeout in seconds
	 * for the connection to the SOAP service. This option does not define a timeout
	 * for services with slow responses. To limit the time to wait for calls to finish the
	 * default_socket_timeout setting
	 * is available.
	 * </p>
	 * <p>
	 * The typemap option is an array of type mappings.
	 * Type mapping is an array with keys type_name,
	 * type_ns (namespace URI), from_xml
	 * (callback accepting one string parameter) and to_xml
	 * (callback accepting one object parameter).
	 * </p>
	 * <p>
	 * The cache_wsdl option is one of
	 * <b>WSDL_CACHE_NONE</b>,
	 * <b>WSDL_CACHE_DISK</b>,
	 * <b>WSDL_CACHE_MEMORY</b> or
	 * <b>WSDL_CACHE_BOTH</b>.
	 * </p>
	 * <p>
	 * The user_agent option specifies string to use in
	 * User-Agent header.
	 * </p>
	 * <p>
	 * The stream_context option is a resource
	 * for context.
	 * </p>
	 * <p>
	 * The features option is a bitmask of
	 * <b>SOAP_SINGLE_ELEMENT_ARRAYS</b>,
	 * <b>SOAP_USE_XSI_ARRAY_TYPE</b>,
	 * <b>SOAP_WAIT_ONE_WAY_CALLS</b>.
	 * </p>
	 * <p>
	 * The keep_alive option is a boolean value defining whether
	 * to send the Connection: Keep-Alive header or
	 * Connection: close.
	 * </p>
	 * <p>
	 * The ssl_method option is one of
	 * <b>SOAP_SSL_METHOD_TLS</b>,
	 * <b>SOAP_SSL_METHOD_SSLv2</b>,
	 * <b>SOAP_SSL_METHOD_SSLv3</b> or
	 * <b>SOAP_SSL_METHOD_SSLv23</b>.
	 * </p>
	 */
	public function SoapClient ($wsdl, array $options = null) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Calls a SOAP function (deprecated)
	 * @link http://php.net/manual/en/soapclient.call.php
	 * @param string $function_name
	 * @param string $arguments
	 * @return mixed
	 */
	public function __call ($function_name, $arguments) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Calls a SOAP function
	 * @link http://php.net/manual/en/soapclient.soapcall.php
	 * @param string $function_name <p>
	 * The name of the SOAP function to call.
	 * </p>
	 * @param array $arguments <p>
	 * An array of the arguments to pass to the function. This can be either
	 * an ordered or an associative array. Note that most SOAP servers require
	 * parameter names to be provided, in which case this must be an
	 * associative array.
	 * </p>
	 * @param array $options [optional] <p>
	 * An associative array of options to pass to the client.
	 * </p>
	 * <p>
	 * The location option is the URL of the remote Web service.
	 * </p>
	 * <p>
	 * The uri option is the target namespace of the SOAP service.
	 * </p>
	 * <p>
	 * The soapaction option is the action to call.
	 * </p>
	 * @param mixed $input_headers [optional] <p>
	 * An array of headers to be sent along with the SOAP request.
	 * </p>
	 * @param array $output_headers [optional] <p>
	 * If supplied, this array will be filled with the headers from the SOAP response.
	 * </p>
	 * @return mixed SOAP functions may return one, or multiple values. If only one value is returned
	 * by the SOAP function, the return value of __soapCall will be
	 * a simple value (e.g. an integer, a string, etc). If multiple values are
	 * returned, __soapCall will return
	 * an associative array of named output parameters.
	 * </p>
	 * <p>
	 * On error, if the SoapClient object was constructed with the exceptions
	 * option set to <b>FALSE</b>, a SoapFault object will be returned.
	 */
	public function __soapCall ($function_name, array $arguments, array $options = null, $input_headers = null, array &$output_headers = null) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Returns last SOAP request
	 * @link http://php.net/manual/en/soapclient.getlastrequest.php
	 * @return string The last SOAP request, as an XML string.
	 */
	public function __getLastRequest () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Returns last SOAP response
	 * @link http://php.net/manual/en/soapclient.getlastresponse.php
	 * @return string The last SOAP response, as an XML string.
	 */
	public function __getLastResponse () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Returns the SOAP headers from the last request
	 * @link http://php.net/manual/en/soapclient.getlastrequestheaders.php
	 * @return string The last SOAP request headers.
	 */
	public function __getLastRequestHeaders () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Returns the SOAP headers from the last response
	 * @link http://php.net/manual/en/soapclient.getlastresponseheaders.php
	 * @return string The last SOAP response headers.
	 */
	public function __getLastResponseHeaders () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Returns list of available SOAP functions
	 * @link http://php.net/manual/en/soapclient.getfunctions.php
	 * @return array The array of SOAP function prototypes, detailing the return type,
	 * the function name and type-hinted paramaters.
	 */
	public function __getFunctions () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Returns a list of SOAP types
	 * @link http://php.net/manual/en/soapclient.gettypes.php
	 * @return array The array of SOAP types, detailing all structures and types.
	 */
	public function __getTypes () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Performs a SOAP request
	 * @link http://php.net/manual/en/soapclient.dorequest.php
	 * @param string $request <p>
	 * The XML SOAP request.
	 * </p>
	 * @param string $location <p>
	 * The URL to request.
	 * </p>
	 * @param string $action <p>
	 * The SOAP action.
	 * </p>
	 * @param int $version <p>
	 * The SOAP version.
	 * </p>
	 * @param int $one_way [optional] <p>
	 * If one_way is set to 1, this method returns nothing.
	 * Use this where a response is not expected.
	 * </p>
	 * @return string The XML SOAP response.
	 */
	public function __doRequest ($request, $location, $action, $version, $one_way = 0) {}

	/**
	 * (PHP 5 &gt;= 5.0.4)<br/>
	 * The __setCookie purpose
	 * @link http://php.net/manual/en/soapclient.setcookie.php
	 * @param string $name <p>
	 * The name of the cookie.
	 * </p>
	 * @param string $value [optional] <p>
	 * The value of the cookie. If not specified, the cookie will be deleted.
	 * </p>
	 * @return void No value is returned.
	 */
	public function __setCookie ($name, $value = null) {}

	public function __getCookies () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Sets the location of the Web service to use
	 * @link http://php.net/manual/en/soapclient.setlocation.php
	 * @param string $new_location [optional] <p>
	 * The new endpoint URL.
	 * </p>
	 * @return string The old endpoint URL.
	 */
	public function __setLocation ($new_location = null) {}

	/**
	 * (PHP 5 &gt;= 5.0.5)<br/>
	 * Sets SOAP headers for subsequent calls
	 * @link http://php.net/manual/en/soapclient.setsoapheaders.php
	 * @param mixed $soapheaders [optional] <p>
	 * The headers to be set. It could be <b>SoapHeader</b>
	 * object or array of <b>SoapHeader</b> objects.
	 * If not specified or set to <b>NULL</b>, the headers will be deleted.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function __setSoapHeaders ($soapheaders = null) {}

}

/**
 * A class representing a variable or object for use with SOAP services.
 * @link http://php.net/manual/en/class.soapvar.php
 */
class SoapVar  {

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * SoapVar constructor
	 * @link http://php.net/manual/en/soapvar.soapvar.php
	 * @param mixed $data <p>
	 * The data to pass or return.
	 * </p>
	 * @param string $encoding <p>
	 * The encoding ID, one of the XSD_... constants.
	 * </p>
	 * @param string $type_name [optional] <p>
	 * The type name.
	 * </p>
	 * @param string $type_namespace [optional] <p>
	 * The type namespace.
	 * </p>
	 * @param string $node_name [optional] <p>
	 * The XML node name.
	 * </p>
	 * @param string $node_namespace [optional] <p>
	 * The XML node namespace.
	 * </p>
	 */
	public function SoapVar ($data, $encoding, $type_name = null, $type_namespace = null, $node_name = null, $node_namespace = null) {}

}

/**
 * The SoapServer class provides a server for the SOAP 1.1 and SOAP 1.2 protocols. It can be used with or without a WSDL service description.
 * @link http://php.net/manual/en/class.soapserver.php
 */
class SoapServer  {

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * SoapServer constructor
	 * @link http://php.net/manual/en/soapserver.soapserver.php
	 * @param mixed $wsdl <p>
	 * To use the SoapServer in WSDL mode, pass the URI of a WSDL file.
	 * Otherwise, pass <b>NULL</b> and set the uri option to the
	 * target namespace for the server.
	 * </p>
	 * @param array $options [optional] <p>
	 * Allow setting a default SOAP version (soap_version),
	 * internal character encoding (encoding),
	 * and actor URI (actor).
	 * </p>
	 * <p>
	 * The classmap option can be used to map some WSDL
	 * types to PHP classes. This option must be an array with WSDL types
	 * as keys and names of PHP classes as values.
	 * </p>
	 * <p>
	 * The typemap option is an array of type mappings.
	 * Type mapping is an array with keys type_name,
	 * type_ns (namespace URI), from_xml
	 * (callback accepting one string parameter) and to_xml
	 * (callback accepting one object parameter).
	 * </p>
	 * <p>
	 * The cache_wsdl option is one of
	 * <b>WSDL_CACHE_NONE</b>,
	 * <b>WSDL_CACHE_DISK</b>,
	 * <b>WSDL_CACHE_MEMORY</b> or
	 * <b>WSDL_CACHE_BOTH</b>.
	 * </p>
	 * <p>
	 * There is also a features option which can be set to
	 * <b>SOAP_WAIT_ONE_WAY_CALLS</b>,
	 * <b>SOAP_SINGLE_ELEMENT_ARRAYS</b>,
	 * <b>SOAP_USE_XSI_ARRAY_TYPE</b>.
	 * </p>
	 * <p>
	 * The send_errors option can be set to <b>FALSE</b> to sent a
	 * generic error message ("Internal error") instead of the specific error
	 * message sent otherwise.
	 * </p>
	 */
	public function SoapServer ($wsdl, array $options = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2)<br/>
	 * Sets SoapServer persistence mode
	 * @link http://php.net/manual/en/soapserver.setpersistence.php
	 * @param int $mode <p>
	 * One of the SOAP_PERSISTENCE_XXX constants.
	 * </p>
	 * <p>
	 * <b>SOAP_PERSISTENCE_REQUEST</b> - SoapServer data does not persist between
	 * requests. This is the default behavior of any SoapServer
	 * object after setClass is called.
	 * </p>
	 * <p>
	 * <b>SOAP_PERSISTENCE_SESSION</b> - SoapServer data persists between requests.
	 * This is accomplished by serializing the SoapServer class data into
	 * $_SESSION['_bogus_session_name'], because of this
	 * <b>session_start</b> must be called before this persistence mode is set.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setPersistence ($mode) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Sets the class which handles SOAP requests
	 * @link http://php.net/manual/en/soapserver.setclass.php
	 * @param string $class_name <p>
	 * The name of the exported class.
	 * </p>
	 * @param mixed $args [optional] <p>
	 * These optional parameters will be passed to the default class constructor
	 * during object creation.
	 * </p>
	 * @param mixed $_ [optional]
	 * @return void No value is returned.
	 */
	public function setClass ($class_name, $args = null, $_ = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Sets the object which will be used to handle SOAP requests
	 * @link http://php.net/manual/en/soapserver.setobject.php
	 * @param object $object <p>
	 * The object to handle the requests.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setObject ($object) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Adds one or more functions to handle SOAP requests
	 * @link http://php.net/manual/en/soapserver.addfunction.php
	 * @param mixed $functions <p>
	 * To export one function, pass the function name into this parameter as
	 * a string.
	 * </p>
	 * <p>
	 * To export several functions, pass an array of function names.
	 * </p>
	 * <p>
	 * To export all the functions, pass a special constant <b>SOAP_FUNCTIONS_ALL</b>.
	 * </p>
	 * <p>
	 * <i>functions</i> must receive all input arguments in the same
	 * order as defined in the WSDL file (They should not receive any output parameters
	 * as arguments) and return one or more values. To return several values they must
	 * return an array with named output parameters.
	 * </p>
	 * @return void No value is returned.
	 */
	public function addFunction ($functions) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Returns list of defined functions
	 * @link http://php.net/manual/en/soapserver.getfunctions.php
	 * @return array An array of the defined functions.
	 */
	public function getFunctions () {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Handles a SOAP request
	 * @link http://php.net/manual/en/soapserver.handle.php
	 * @param string $soap_request [optional] <p>
	 * The SOAP request. If this argument is omitted, the request is assumed to be
	 * in the raw POST data of the HTTP request.
	 * </p>
	 * @return void No value is returned.
	 */
	public function handle ($soap_request = null) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Issue SoapServer fault indicating an error
	 * @link http://php.net/manual/en/soapserver.fault.php
	 * @param string $code <p>
	 * The error code to return
	 * </p>
	 * @param string $string <p>
	 * A brief description of the error
	 * </p>
	 * @param string $actor [optional] <p>
	 * A string identifying the actor that caused the fault.
	 * </p>
	 * @param string $details [optional] <p>
	 * More details of the fault
	 * </p>
	 * @param string $name [optional] <p>
	 * The name of the fault. This can be used to select a name from a WSDL file.
	 * </p>
	 * @return void No value is returned.
	 */
	public function fault ($code, $string, $actor = null, $details = null, $name = null) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Add a SOAP header to the response
	 * @link http://php.net/manual/en/soapserver.addsoapheader.php
	 * @param SoapHeader $object <p>
	 * The header to be returned.
	 * </p>
	 * @return void No value is returned.
	 */
	public function addSoapHeader (SoapHeader $object) {}

}

/**
 * Represents a SOAP fault.
 * @link http://php.net/manual/en/class.soapfault.php
 */
class SoapFault extends Exception  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * SoapFault constructor
	 * @link http://php.net/manual/en/soapfault.soapfault.php
	 * @param string $faultcode <p>
	 * The error code of the <b>SoapFault</b>.
	 * </p>
	 * @param string $faultstring <p>
	 * The error message of the <b>SoapFault</b>.
	 * </p>
	 * @param string $faultactor [optional] <p>
	 * A string identifying the actor that caused the error.
	 * </p>
	 * @param string $detail [optional] <p>
	 * More details about the cause of the error.
	 * </p>
	 * @param string $faultname [optional] <p>
	 * Can be used to select the proper fault encoding from WSDL.
	 * </p>
	 * @param string $headerfault [optional] <p>
	 * Can be used during SOAP header handling to report an error in the
	 * response header.
	 * </p>
	 */
	public function SoapFault ($faultcode, $faultstring, $faultactor = null, $detail = null, $faultname = null, $headerfault = null) {}

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * Obtain a string representation of a SoapFault
	 * @link http://php.net/manual/en/soapfault.tostring.php
	 * @return string A string describing the SoapFault.
	 */
	public function __toString () {}

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

}

/**
 * Represents parameter to a SOAP call.
 * @link http://php.net/manual/en/class.soapparam.php
 */
class SoapParam  {

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * SoapParam constructor
	 * @link http://php.net/manual/en/soapparam.soapparam.php
	 * @param mixed $data <p>
	 * The data to pass or return. This parameter can be passed directly as PHP
	 * value, but in this case it will be named as paramN and
	 * the SOAP service may not understand it.
	 * </p>
	 * @param string $name <p>
	 * The parameter name.
	 * </p>
	 */
	public function SoapParam ($data, $name) {}

}

/**
 * Represents a SOAP header.
 * @link http://php.net/manual/en/class.soapheader.php
 */
class SoapHeader  {

	/**
	 * (PHP 5 &gt;= 5.0.1)<br/>
	 * SoapHeader constructor
	 * @link http://php.net/manual/en/soapheader.soapheader.php
	 * @param string $namespace <p>
	 * The namespace of the SOAP header element.
	 * </p>
	 * @param string $name <p>
	 * The name of the SoapHeader object.
	 * </p>
	 * @param mixed $data [optional] <p>
	 * A SOAP header's content. It can be a PHP value or a
	 * <b>SoapVar</b> object.
	 * </p>
	 * @param bool $mustunderstand [optional]
	 * @param string $actor [optional] <p>
	 * Value of the actor attribute of the SOAP header
	 * element.
	 * </p>
	 */
	public function SoapHeader ($namespace, $name, $data = null, $mustunderstand = false, $actor = null) {}

}

/**
 * (Unknown)<br/>
 * Set whether to use the SOAP error handler
 * @link http://php.net/manual/en/function.use-soap-error-handler.php
 * @param bool $handler [optional] <p>
 * Set to <b>TRUE</b> to send error details to clients.
 * </p>
 * @return bool the original value.
 */
function use_soap_error_handler ($handler = true) {}

/**
 * (Unknown)<br/>
 * Checks if a SOAP call has failed
 * @link http://php.net/manual/en/function.is-soap-fault.php
 * @param mixed $object <p>
 * The object to test.
 * </p>
 * @return bool This will return <b>TRUE</b> on error, and <b>FALSE</b> otherwise.
 */
function is_soap_fault ($object) {}

define ('SOAP_1_1', 1);
define ('SOAP_1_2', 2);
define ('SOAP_PERSISTENCE_SESSION', 1);
define ('SOAP_PERSISTENCE_REQUEST', 2);
define ('SOAP_FUNCTIONS_ALL', 999);
define ('SOAP_ENCODED', 1);
define ('SOAP_LITERAL', 2);
define ('SOAP_RPC', 1);
define ('SOAP_DOCUMENT', 2);
define ('SOAP_ACTOR_NEXT', 1);
define ('SOAP_ACTOR_NONE', 2);
define ('SOAP_ACTOR_UNLIMATERECEIVER', 3);
define ('SOAP_COMPRESSION_ACCEPT', 32);
define ('SOAP_COMPRESSION_GZIP', 0);
define ('SOAP_COMPRESSION_DEFLATE', 16);
define ('SOAP_AUTHENTICATION_BASIC', 0);
define ('SOAP_AUTHENTICATION_DIGEST', 1);
define ('UNKNOWN_TYPE', 999998);
define ('XSD_STRING', 101);
define ('XSD_BOOLEAN', 102);
define ('XSD_DECIMAL', 103);
define ('XSD_FLOAT', 104);
define ('XSD_DOUBLE', 105);
define ('XSD_DURATION', 106);
define ('XSD_DATETIME', 107);
define ('XSD_TIME', 108);
define ('XSD_DATE', 109);
define ('XSD_GYEARMONTH', 110);
define ('XSD_GYEAR', 111);
define ('XSD_GMONTHDAY', 112);
define ('XSD_GDAY', 113);
define ('XSD_GMONTH', 114);
define ('XSD_HEXBINARY', 115);
define ('XSD_BASE64BINARY', 116);
define ('XSD_ANYURI', 117);
define ('XSD_QNAME', 118);
define ('XSD_NOTATION', 119);
define ('XSD_NORMALIZEDSTRING', 120);
define ('XSD_TOKEN', 121);
define ('XSD_LANGUAGE', 122);
define ('XSD_NMTOKEN', 123);
define ('XSD_NAME', 124);
define ('XSD_NCNAME', 125);
define ('XSD_ID', 126);
define ('XSD_IDREF', 127);
define ('XSD_IDREFS', 128);
define ('XSD_ENTITY', 129);
define ('XSD_ENTITIES', 130);
define ('XSD_INTEGER', 131);
define ('XSD_NONPOSITIVEINTEGER', 132);
define ('XSD_NEGATIVEINTEGER', 133);
define ('XSD_LONG', 134);
define ('XSD_INT', 135);
define ('XSD_SHORT', 136);
define ('XSD_BYTE', 137);
define ('XSD_NONNEGATIVEINTEGER', 138);
define ('XSD_UNSIGNEDLONG', 139);
define ('XSD_UNSIGNEDINT', 140);
define ('XSD_UNSIGNEDSHORT', 141);
define ('XSD_UNSIGNEDBYTE', 142);
define ('XSD_POSITIVEINTEGER', 143);
define ('XSD_NMTOKENS', 144);
define ('XSD_ANYTYPE', 145);
define ('XSD_ANYXML', 147);
define ('APACHE_MAP', 200);
define ('SOAP_ENC_OBJECT', 301);
define ('SOAP_ENC_ARRAY', 300);
define ('XSD_1999_TIMEINSTANT', 401);
define ('XSD_NAMESPACE', "http://www.w3.org/2001/XMLSchema");
define ('XSD_1999_NAMESPACE', "http://www.w3.org/1999/XMLSchema");
define ('SOAP_SINGLE_ELEMENT_ARRAYS', 1);
define ('SOAP_WAIT_ONE_WAY_CALLS', 2);
define ('SOAP_USE_XSI_ARRAY_TYPE', 4);
define ('WSDL_CACHE_NONE', 0);
define ('WSDL_CACHE_DISK', 1);
define ('WSDL_CACHE_MEMORY', 2);
define ('WSDL_CACHE_BOTH', 3);

/**
 * Since PHP 5.5.0.
 * @link http://php.net/manual/en/soap.constants.php
 */
define ('SOAP_SSL_METHOD_TLS', 0);

/**
 * Since PHP 5.5.0.
 * @link http://php.net/manual/en/soap.constants.php
 */
define ('SOAP_SSL_METHOD_SSLv2', 1);

/**
 * Since PHP 5.5.0.
 * @link http://php.net/manual/en/soap.constants.php
 */
define ('SOAP_SSL_METHOD_SSLv3', 2);

/**
 * Since PHP 5.5.0.
 * @link http://php.net/manual/en/soap.constants.php
 */
define ('SOAP_SSL_METHOD_SSLv23', 3);

// End of soap v.
?>
