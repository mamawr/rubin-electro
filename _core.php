<?php

/////////////////////////////////////////////////////////////////////////
/*
function getGoods() {
  require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_data.php');
  return $DATA;
}
*/

/////////////////////////////////////////////////////////////////////////
function getGoods() {
  $json = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'data.json');
  $data = json_decode($json, true);
  if (json_last_error() == JSON_ERROR_NONE)
    return $data;
  else
    response500InternalServerError();
}

/////////////////////////////////////////////////////////////////////////
function getProductById($id) {
  $goods = getGoods();
  foreach ($goods as $item) {
    if ($item['id'] == $id)
      return $item;
  }
  return false;
}

/////////////////////////////////////////////////////////////////////////
function response500InternalServerError() {
	header("HTTP/1.1 500 Internal Server Error");
	print('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">' . PHP_EOL);
	print('<html><head>' . PHP_EOL);
	print('<title>500 Internal Server Error</title>' . PHP_EOL);
	print('</head><body>' . PHP_EOL);
	print('<h1>Internal Server Error</h1>' . PHP_EOL);
	print('<p>The server encountered an internal error and was unable to complete your request.</p>' . PHP_EOL);
	print('</body></html>' . PHP_EOL);
	print(PHP_EOL);
	exit;
}

/////////////////////////////////////////////////////////////////////////
function response404NotFound() {
	header("HTTP/1.1 404 Not Found");
	print('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">' . PHP_EOL);
	print('<html><head>' . PHP_EOL);
	print('<title>404 Not Found</title>' . PHP_EOL);
	print('</head><body>' . PHP_EOL);
	print('<h1>Not Found</h1>' . PHP_EOL);
	print('<p>The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found on this server.</p>' . PHP_EOL);
	print('</body></html>' . PHP_EOL);
	print(PHP_EOL);
	exit;
}
