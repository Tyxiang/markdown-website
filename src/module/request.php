<?php
// 起始 http://di.fimik.com/sm/
// 访问 http://di.fimik.com/sm/abc/123?a=1&b=2
$request_uri = $_SERVER['REQUEST_URI']; // /sm/abc/123?a=1&b=2
//var_dump($request_uri);
$request_uri_array = explode("?", $request_uri); // ['/sm/abc/123','a=1&b=2']
//var_dump($request_uri_array);
$path = trim($request_uri_array[0], "/"); // sm/abc/123
//var_dump($path);
$query = $request_uri_array[1]; // a=1&b=2
//var_dump($query);
$sub_path = substr($path, strlen($GLOBALS['start_dir'])); // abc/123
//var_dump($sub_path);
$parameters = explode("/", $sub_path); // ['abc', '123']
//var_dump($parameters);
$method = $_SERVER['REQUEST_METHOD'];