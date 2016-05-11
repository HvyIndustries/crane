<?php

// Start of fileinfo v.1.0.5

/**
 * This class provides an object oriented interface into the fileinfo
 * functions.
 * @link http://php.net/manual/en/class.finfo.php
 */
class finfo  {

	/**
	 * @param $options [optional]
	 * @param $arg [optional]
	 */
	public function finfo ($options, $arg) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
	 * Set libmagic configuration options
	 * @link http://php.net/manual/en/function.finfo-set-flags.php
	 * @param int $options <p>
	 * One or disjunction of more Fileinfo
	 * constants.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function set_flags ($options) {}

	/**
	 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
	 * Return information about a file
	 * @link http://php.net/manual/en/function.finfo-file.php
	 * @param string $file_name [optional] <p>
	 * Name of a file to be checked.
	 * </p>
	 * @param int $options [optional] <p>
	 * One or disjunction of more Fileinfo
	 * constants.
	 * </p>
	 * @param resource $context [optional] <p>
	 * For a description of contexts, refer to .
	 * </p>
	 * @return string a textual description of the contents of the
	 * <i>file_name</i> argument, or <b>FALSE</b> if an error occurred.
	 */
	public function file ($file_name = null, $options = 'FILEINFO_NONE', $context = null) {}

	/**
	 * (PHP 5 &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
	 * Return information about a string buffer
	 * @link http://php.net/manual/en/function.finfo-buffer.php
	 * @param string $string [optional] <p>
	 * Content of a file to be checked.
	 * </p>
	 * @param int $options [optional] <p>
	 * One or disjunction of more Fileinfo
	 * constants.
	 * </p>
	 * @param resource $context [optional]
	 * @return string a textual description of the <i>string</i>
	 * argument, or <b>FALSE</b> if an error occurred.
	 */
	public function buffer ($string = null, $options = 'FILEINFO_NONE', $context = null) {}

}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Create a new fileinfo resource
 * @link http://php.net/manual/en/function.finfo-open.php
 * @param int $options [optional] <p>
 * One or disjunction of more Fileinfo
 * constants.
 * </p>
 * @param string $magic_file [optional] <p>
 * Name of a magic database file, usually something like
 * /path/to/magic.mime. If not specified, the
 * MAGIC environment variable is used. If the
 * environment variable isn't set, then PHP's bundled magic database will
 * be used.
 * </p>
 * <p>
 * Passing <b>NULL</b> or an empty string will be equivalent to the default
 * value.
 * </p>
 * @return mixed (Procedural style only)
 * Returns a magic database resource on success or <b>FALSE</b> on failure.
 */
function finfo_open ($options = 'FILEINFO_NONE', $magic_file = null) {}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Close fileinfo resource
 * @link http://php.net/manual/en/function.finfo-close.php
 * @param $finfo
 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function finfo_close ($finfo) {}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Set libmagic configuration options
 * @link http://php.net/manual/en/function.finfo-set-flags.php
 * @param $finfo
 * @param $options
 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function finfo_set_flags ($finfo, $options) {}

/**
 * (PHP &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Return information about a file
 * @link http://php.net/manual/en/function.finfo-file.php
 * @param $finfo
 * @param $filename
 * @param $options [optional]
 * @param $context [optional]
 * @return mixed a textual description of the contents of the
 * <i>file_name</i> argument, or <b>FALSE</b> if an error occurred.
 */
function finfo_file ($finfo, $filename, $options, $context) {}

/**
 * (PHP 5 &gt;= 5.3.0, PECL fileinfo &gt;= 0.1.0)<br/>
 * Return information about a string buffer
 * @link http://php.net/manual/en/function.finfo-buffer.php
 * @param $finfo
 * @param $string
 * @param $options [optional]
 * @param $context [optional]
 * @return mixed a textual description of the <i>string</i>
 * argument, or <b>FALSE</b> if an error occurred.
 */
function finfo_buffer ($finfo, $string, $options, $context) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Detect MIME Content-type for a file (deprecated)
 * @link http://php.net/manual/en/function.mime-content-type.php
 * @param string $filename <p>
 * Path to the tested file.
 * </p>
 * @return string the content type in MIME format, like
 * text/plain or application/octet-stream.
 */
function mime_content_type ($filename) {}


/**
 * No special handling.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_NONE', 0);

/**
 * Follow symlinks.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_SYMLINK', 2);

/**
 * Return the mime type and mime encoding as defined by RFC 2045.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_MIME', 1040);

/**
 * Return the mime type.
 * Available since PHP 5.3.0.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_MIME_TYPE', 16);

/**
 * Return the mime encoding of the file.
 * Available since PHP 5.3.0.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_MIME_ENCODING', 1024);

/**
 * Look at the contents of blocks or character special devices.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_DEVICES', 8);

/**
 * Return all matches, not just the first.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_CONTINUE', 32);

/**
 * If possible preserve the original access time.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_PRESERVE_ATIME', 128);

/**
 * Don't translate unprintable characters to a \ooo octal
 * representation.
 * @link http://php.net/manual/en/fileinfo.constants.php
 */
define ('FILEINFO_RAW', 256);

// End of fileinfo v.1.0.5
?>
