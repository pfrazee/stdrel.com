<?
namespace com {
	// CORS headers
	$headers = apache_request_headers();
	header('Access-Control-Allow-Origin ' . @$headers['Origin'] || '*');
	header('Access-Control-Allow-Credentials true');
	header('Access-Control-Allow-Methods OPTIONS, HEAD, GET, PUT, PATCH, POST, DELETE, NOTIFY, SUBSCRIBE');
	header('Access-Control-Allow-Headers ' . @$headers['Access-Control-Request-Headers'] || 'Accept, Authorization, Connection, Cookie, Content-Type, Content-Length, Host');
	header('Access-Control-Expose-Headers ' . @$headers['Access-Control-Request-Headers'] || 'Content-Type, Content-Length, Date, ETag, Last-Modified, Link, Location');
	header('Access-Control-Max-Age 60*60*24'); // in seconds
}
namespace com\stdrel {
	const DIRECTORY = '/var/www/stdrel.com';
}
namespace imports { // the `imports` name is not used - just lets us make the require_once calls
	require_once('links.php');
	require_once('partials.php');
}
?>