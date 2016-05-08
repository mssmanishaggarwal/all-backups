<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/
session_start();
define('BASE_URL', filter_var('http://localhost/social/', FILTER_SANITIZE_URL));
// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
define('CLIENT_ID','830275051239-6ekm19ufmbjka59si42nt0oap5jsf1a1.apps.googleusercontent.com');
define('CLIENT_SECRET','jSbG9RvdeirMIem0ftzr_vbX');
define('REDIRECT_URI','http://localhost/photoshare/log/registration/?google');//example:http://localhost/social/login.php?google,http://example/login.php?google
define('APPROVAL_PROMPT','auto');
define('ACCESS_TYPE','offline');

//For facebook
define('APP_ID','792228807476652');
define('APP_SECRET','53e7aeb90236e808298b5370db292992');

?>