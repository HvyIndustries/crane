<?php

// Start of gnupg v.1.3.3-dev

class gnupg  {
	const SIG_MODE_NORMAL = 0;
	const SIG_MODE_DETACH = 1;
	const SIG_MODE_CLEAR = 2;
	const VALIDITY_UNKNOWN = 0;
	const VALIDITY_UNDEFINED = 1;
	const VALIDITY_NEVER = 2;
	const VALIDITY_MARGINAL = 3;
	const VALIDITY_FULL = 4;
	const VALIDITY_ULTIMATE = 5;
	const PROTOCOL_OpenPGP = 0;
	const PROTOCOL_CMS = 1;
	const SIGSUM_VALID = 1;
	const SIGSUM_GREEN = 2;
	const SIGSUM_RED = 4;
	const SIGSUM_KEY_REVOKED = 16;
	const SIGSUM_KEY_EXPIRED = 32;
	const SIGSUM_SIG_EXPIRED = 64;
	const SIGSUM_KEY_MISSING = 128;
	const SIGSUM_CRL_MISSING = 256;
	const SIGSUM_CRL_TOO_OLD = 512;
	const SIGSUM_BAD_POLICY = 1024;
	const SIGSUM_SYS_ERROR = 2048;
	const ERROR_WARNING = 1;
	const ERROR_EXCEPTION = 2;
	const ERROR_SILENT = 3;


	public function keyinfo () {}

	public function verify () {}

	public function geterror () {}

	public function clearsignkeys () {}

	public function clearencryptkeys () {}

	public function cleardecryptkeys () {}

	public function setarmor () {}

	public function encrypt () {}

	public function decrypt () {}

	public function export () {}

	public function import () {}

	public function getprotocol () {}

	public function setsignmode () {}

	public function sign () {}

	public function encryptsign () {}

	public function decryptverify () {}

	public function addsignkey () {}

	public function addencryptkey () {}

	public function adddecryptkey () {}

	public function deletekey () {}

	public function gettrustlist () {}

	public function listsignatures () {}

	public function seterrormode () {}

}

class gnupg_keylistiterator implements Iterator, Traversable {

	public function __construct () {}

	public function current () {}

	public function key () {}

	public function next () {}

	public function rewind () {}

	public function valid () {}

}

/**
 * (PECL gnupg &gt;= 0.4)<br/>
 * Initialize a connection
 * @link http://php.net/manual/en/function.gnupg-init.php
 * @return resource A GnuPG resource connection used by other GnuPG functions.
 */
function gnupg_init () {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Returns an array with information about all keys that matches the given pattern
 * @link http://php.net/manual/en/function.gnupg-keyinfo.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $pattern <p>
 * The pattern being checked against the keys.
 * </p>
 * @return array an array with information about all keys that matches the given
 * pattern or <b>FALSE</b>, if an error has occurred.
 */
function gnupg_keyinfo ($identifier, $pattern) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Signs a given text
 * @link http://php.net/manual/en/function.gnupg-sign.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $plaintext <p>
 * The plain text being signed.
 * </p>
 * @return string On success, this function returns the signed text or the signature.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_sign ($identifier, $plaintext) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Verifies a signed text
 * @link http://php.net/manual/en/function.gnupg-verify.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $signed_text <p>
 * The signed text.
 * </p>
 * @param string $signature <p>
 * The signature.
 * To verify a clearsigned text, set signature to <b>FALSE</b>.
 * </p>
 * @param string $plaintext [optional] <p>
 * The plain text.
 * If this optional parameter is passed, it is
 * filled with the plain text.
 * </p>
 * @return array On success, this function returns information about the signature.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_verify ($identifier, $signed_text, $signature, &$plaintext = null) {}

/**
 * (PECL gnupg &gt;= 0.5)<br/>
 * Removes all keys which were set for signing before
 * @link http://php.net/manual/en/function.gnupg-clearsignkeys.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_clearsignkeys ($identifier) {}

/**
 * (PECL gnupg &gt;= 0.5)<br/>
 * Removes all keys which were set for encryption before
 * @link http://php.net/manual/en/function.gnupg-clearencryptkeys.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_clearencryptkeys ($identifier) {}

/**
 * (PECL gnupg &gt;= 0.5)<br/>
 * Removes all keys which were set for decryption before
 * @link http://php.net/manual/en/function.gnupg-cleardecryptkeys.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_cleardecryptkeys ($identifier) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Toggle armored output
 * @link http://php.net/manual/en/function.gnupg-setarmor.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param int $armor <p>
 * Pass a non-zero integer-value to this function to enable armored-output
 * (default).
 * Pass 0 to disable armored output.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_setarmor ($identifier, $armor) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Encrypts a given text
 * @link http://php.net/manual/en/function.gnupg-encrypt.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $plaintext <p>
 * The text being encrypted.
 * </p>
 * @return string On success, this function returns the encrypted text.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_encrypt ($identifier, $plaintext) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Decrypts a given text
 * @link http://php.net/manual/en/function.gnupg-decrypt.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $text <p>
 * The text being decrypted.
 * </p>
 * @return string On success, this function returns the decrypted text.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_decrypt ($identifier, $text) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Exports a key
 * @link http://php.net/manual/en/function.gnupg-export.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $fingerprint The fingerprint key.</p>
 * @return string On success, this function returns the keydata.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_export ($identifier, $fingerprint) {}

/**
 * (PECL gnupg &gt;= 0.3)<br/>
 * Imports a key
 * @link http://php.net/manual/en/function.gnupg-import.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $keydata <p>
 * The data key that is being imported.
 * </p>
 * @return array On success, this function returns and info-array about the importprocess.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_import ($identifier, $keydata) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Returns the currently active protocol for all operations
 * @link http://php.net/manual/en/function.gnupg-getprotocol.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @return int the currently active protocol, which can be one of
 * <b>GNUPG_PROTOCOL_OpenPGP</b> or
 * <b>GNUPG_PROTOCOL_CMS</b>.
 */
function gnupg_getprotocol ($identifier) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Sets the mode for signing
 * @link http://php.net/manual/en/function.gnupg-setsignmode.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param int $signmode
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_setsignmode ($identifier, $signmode) {}

/**
 * (PECL gnupg &gt;= 0.2)<br/>
 * Encrypts and signs a given text
 * @link http://php.net/manual/en/function.gnupg-encryptsign.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $plaintext <p>
 * The text being encrypted.
 * </p>
 * @return string On success, this function returns the encrypted and signed text.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_encryptsign ($identifier, $plaintext) {}

/**
 * (PECL gnupg &gt;= 0.2)<br/>
 * Decrypts and verifies a given text
 * @link http://php.net/manual/en/function.gnupg-decryptverify.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $text <p>
 * The text being decrypted.
 * </p>
 * @param string $plaintext <p>
 * The parameter <i>plaintext</i> gets filled with the decrypted
 * text.
 * </p>
 * @return array On success, this function returns information about the signature and
 * fills the <i>plaintext</i> parameter with the decrypted text.
 * On failure, this function returns <b>FALSE</b>.
 */
function gnupg_decryptverify ($identifier, $text, &$plaintext) {}

/**
 * (PECL gnupg &gt;= 0.1)<br/>
 * Returns the errortext, if a function fails
 * @link http://php.net/manual/en/function.gnupg-geterror.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @return string an errortext, if an error has occurred, otherwise <b>FALSE</b>.
 */
function gnupg_geterror ($identifier) {}

/**
 * (PECL gnupg &gt;= 0.5)<br/>
 * Add a key for signing
 * @link http://php.net/manual/en/function.gnupg-addsignkey.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $fingerprint The fingerprint key.</p>
 * @param string $passphrase [optional] <p>
 * The pass phrase.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_addsignkey ($identifier, $fingerprint, $passphrase = null) {}

/**
 * (PECL gnupg &gt;= 0.5)<br/>
 * Add a key for encryption
 * @link http://php.net/manual/en/function.gnupg-addencryptkey.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $fingerprint The fingerprint key.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_addencryptkey ($identifier, $fingerprint) {}

/**
 * (PECL gnupg &gt;= 0.5)<br/>
 * Add a key for decryption
 * @link http://php.net/manual/en/function.gnupg-adddecryptkey.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param string $fingerprint The fingerprint key.</p>
 * @param string $passphrase <p>
 * The pass phrase.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function gnupg_adddecryptkey ($identifier, $fingerprint, $passphrase) {}

function gnupg_deletekey () {}

function gnupg_gettrustlist () {}

function gnupg_listsignatures () {}

/**
 * (PECL gnupg &gt;= 0.6)<br/>
 * Sets the mode for error_reporting
 * @link http://php.net/manual/en/function.gnupg-seterrormode.php
 * @param resource $identifier The gnupg identifier, from a call to
 * <b>gnupg_init</b> or <b>gnupg</b>.</p>
 * @param int $errormode <p>
 * The error mode.
 * </p>
 * <p>
 * <i>errormode</i> takes a constant indicating what type of
 * error_reporting should be used. The possible values are
 * <b>GNUPG_ERROR_WARNING</b>,
 * <b>GNUPG_ERROR_EXCEPTION</b> and
 * <b>GNUPG_ERROR_SILENT</b>.
 * By default <b>GNUPG_ERROR_SILENT</b> is used.
 * </p>
 * @return void No value is returned.
 */
function gnupg_seterrormode ($identifier, $errormode) {}

define ('GNUPG_SIG_MODE_NORMAL', 0);
define ('GNUPG_SIG_MODE_DETACH', 1);
define ('GNUPG_SIG_MODE_CLEAR', 2);
define ('GNUPG_VALIDITY_UNKNOWN', 0);
define ('GNUPG_VALIDITY_UNDEFINED', 1);
define ('GNUPG_VALIDITY_NEVER', 2);
define ('GNUPG_VALIDITY_MARGINAL', 3);
define ('GNUPG_VALIDITY_FULL', 4);
define ('GNUPG_VALIDITY_ULTIMATE', 5);
define ('GNUPG_PROTOCOL_OpenPGP', 0);
define ('GNUPG_PROTOCOL_CMS', 1);
define ('GNUPG_SIGSUM_VALID', 1);
define ('GNUPG_SIGSUM_GREEN', 2);
define ('GNUPG_SIGSUM_RED', 4);
define ('GNUPG_SIGSUM_KEY_REVOKED', 16);
define ('GNUPG_SIGSUM_KEY_EXPIRED', 32);
define ('GNUPG_SIGSUM_SIG_EXPIRED', 64);
define ('GNUPG_SIGSUM_KEY_MISSING', 128);
define ('GNUPG_SIGSUM_CRL_MISSING', 256);
define ('GNUPG_SIGSUM_CRL_TOO_OLD', 512);
define ('GNUPG_SIGSUM_BAD_POLICY', 1024);
define ('GNUPG_SIGSUM_SYS_ERROR', 2048);
define ('GNUPG_ERROR_WARNING', 1);
define ('GNUPG_ERROR_EXCEPTION', 2);
define ('GNUPG_ERROR_SILENT', 3);

// End of gnupg v.1.3.3-dev
?>
