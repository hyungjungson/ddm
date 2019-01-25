<?php
# 세션의 유지시간 0 : 브라우저 닫기 전까지

ini_set('display_errors', '1');     # don't show any errors...
//error_reporting(E_ALL | E_STRICT);  # ...but do log them

error_reporting(E_ERROR | E_STRICT | E_ALL  ^ E_NOTICE ^ E_DEPRECATED);
//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_STRICT);

//ini_set("display_errors", 0);
@session_set_cookie_params(0,"/");


//@ini_set("session.cookie_lifetime", 10); // 초
//@ini_set("session.cache_expire", 10); // 분
//@ini_set("session.gc_maxlifetime", 10); // 초
session_start();
ob_start();

?>
