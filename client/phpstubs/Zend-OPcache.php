<?php

// Start of Zend OPcache v.7.0.4-devFE

/**
 * (PHP 5 &gt;= 5.5.0, PECL ZendOpcache &gt;= 7.0.0)<br/>
 * Resets the contents of the opcode cache
 * @link http://php.net/manual/en/function.opcache-reset.php
 * @return boolean <b>TRUE</b> if the opcode cache was reset, or <b>FALSE</b> if the opcode
 * cache is disabled.
 */
function opcache_reset () {}

/**
 * (PHP 5 &gt;= 5.5.0, PECL ZendOpcache &gt;= 7.0.0)<br/>
 * Invalidates a cached script
 * @link http://php.net/manual/en/function.opcache-invalidate.php
 * @param string $script <p>
 * The path to the script being invalidated.
 * </p>
 * @param boolean $force [optional] <p>
 * If set to <b>TRUE</b>, the script will be invalidated regardless of whether
 * invalidation is necessary.
 * </p>
 * @return boolean <b>TRUE</b> if the opcode cache for <i>script</i> was
 * invalidated or if there was nothing to invalidate, or <b>FALSE</b> if the opcode
 * cache is disabled.
 */
function opcache_invalidate ($script, boolean $force = false) {}

/**
 * (PHP 5 &gt;= 5.5.5, PECL ZendOpcache &gt; 7.0.2)<br/>
 * Compiles and caches a PHP script without executing it
 * @link http://php.net/manual/en/function.opcache-compile-file.php
 * @param string $file <p>
 * The path to the PHP script to be compiled.
 * </p>
 * @return boolean <b>TRUE</b> if <i>file</i> was compiled successfully
 * or <b>FALSE</b> on failure.
 */
function opcache_compile_file ($file) {}

/**
 * (PHP 5 &gt;= 5.6.0, PECL ZendOpcache &gt;= 7.0.4)<br/>
 * Tells whether a script is cached in OPCache
 * @link http://php.net/manual/en/function.opcache-is-script-cached.php
 * @param string $file <p>
 * The path to the PHP script to be checked.
 * </p>
 * @return boolean <b>TRUE</b> if <i>file</i> is cached in OPCache,
 * <b>FALSE</b> otherwise.
 */
function opcache_is_script_cached ($file) {}

/**
 * (PHP 5 &gt;= 5.5.5, PECL ZendOpcache &gt; 7.0.2)<br/>
 * Get configuration information about the cache
 * @link http://php.net/manual/en/function.opcache-get-configuration.php
 * @return array an array of information, including ini, blacklist and version
 */
function opcache_get_configuration () {}

/**
 * (PHP 5 &gt;= 5.5.5, PECL ZendOpcache &gt; 7.0.2)<br/>
 * Get status information about the cache
 * @link http://php.net/manual/en/function.opcache-get-status.php
 * @param boolean $get_scripts [optional] <p>
 * Include script specific state information
 * </p>
 * @return array an array of information, optionally containing script specific state information
 */
function opcache_get_status (boolean $get_scripts = true) {}

// End of Zend OPcache v.7.0.4-devFE
?>
