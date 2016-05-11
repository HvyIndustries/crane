<?php

// Start of apcu v.4.0.7

/**
 * @param $type [optional]
 * @param $limited [optional]
 */
function apcu_cache_info ($type, $limited) {}

/**
 * @param $cache [optional]
 */
function apcu_clear_cache ($cache) {}

/**
 * @param $limited [optional]
 */
function apcu_sma_info ($limited) {}

/**
 * @param $key
 */
function apcu_key_info ($key) {}

function apcu_enabled () {}

/**
 * @param $key
 * @param $var
 * @param $ttl [optional]
 */
function apcu_store ($key, $var, $ttl) {}

/**
 * @param $key
 * @param $success [optional]
 */
function apcu_fetch ($key, &$success) {}

/**
 * @param $keys
 */
function apcu_delete ($keys) {}

/**
 * @param $key
 * @param $var
 * @param $ttl [optional]
 */
function apcu_add ($key, $var, $ttl) {}

/**
 * @param $key
 * @param $step [optional]
 * @param $success [optional]
 */
function apcu_inc ($key, $step, &$success) {}

/**
 * @param $key
 * @param $step [optional]
 * @param $success [optional]
 */
function apcu_dec ($key, $step, &$success) {}

/**
 * @param $key
 * @param $old
 * @param $new
 */
function apcu_cas ($key, $old, $new) {}

/**
 * @param $keys
 */
function apcu_exists ($keys) {}

/**
 * @param $user_vars [optional]
 */
function apcu_bin_dump ($user_vars) {}

/**
 * @param $data
 * @param $flags [optional]
 */
function apcu_bin_load ($data, $flags) {}

/**
 * @param $user_vars
 * @param $filename
 * @param $flags [optional]
 * @param $context [optional]
 */
function apcu_bin_dumpfile ($user_vars, $filename, $flags, $context) {}

/**
 * @param $filename
 * @param $context [optional]
 * @param $flags [optional]
 */
function apcu_bin_loadfile ($filename, $context, $flags) {}

define ('APCU_APC_FULL_BC', true);

// End of apcu v.4.0.7
?>
