<?php

// Start of sasl v.

function sasl_version () {}

function sasl_errstring () {}

function sasl_errdetail () {}

function sasl_encode () {}

function sasl_decode () {}

function sasl_client_init () {}

function sasl_client_new () {}

function sasl_client_start () {}

function sasl_client_step () {}

function sasl_server_init () {}

function sasl_server_new () {}

function sasl_server_start () {}

function sasl_server_step () {}

function sasl_listmech () {}

function sasl_checkpass () {}

define ('SASL_CONTINUE', 1);
define ('SASL_OK', 0);
define ('SASL_FAIL', -1);
define ('SASL_NOMEM', -2);
define ('SASL_BUFOVER', -3);
define ('SASL_NOMECH', -4);
define ('SASL_BADPROT', -5);
define ('SASL_NOTDONE', -6);
define ('SASL_BADPARAM', -7);
define ('SASL_TRYAGAIN', -8);
define ('SASL_BADMAC', -9);
define ('SASL_NOTINIT', -12);
define ('SASL_INTERACT', 2);
define ('SASL_BADSERV', -10);
define ('SASL_WRONGMECH', -11);
define ('SASL_BADAUTH', -13);
define ('SASL_NOAUTHZ', -14);
define ('SASL_TOOWEAK', -15);
define ('SASL_ENCRYPT', -16);
define ('SASL_TRANS', -17);
define ('SASL_EXPIRED', -18);
define ('SASL_DISABLED', -19);
define ('SASL_NOUSER', -20);
define ('SASL_BADVERS', -23);
define ('SASL_UNAVAIL', -24);
define ('SASL_NOVERIFY', -26);
define ('SASL_SUCCESS_DATA', 4);
define ('SASL_NEED_PROXY', 8);
define ('SASL_SEC_NOPLAINTEXT', 1);
define ('SASL_SEC_NOACTIVE', 2);
define ('SASL_SEC_NODICTIONARY', 4);
define ('SASL_SEC_FORWARD_SECRECY', 8);
define ('SASL_SEC_NOANONYMOUS', 16);
define ('SASL_SEC_PASS_CREDENTIALS', 32);
define ('SASL_SEC_MUTUAL_AUTH', 64);
define ('SASL_SEC_MAXIMUM', 255);

// End of sasl v.
?>
