<?
namespace com\grimwire\blog\posts {
	class Data {
		public static $names = array();
		public static $titles = array();
		public static $taglines = array();
		public static $dates = array();
		public static $contents = array();
		public static $is_publisheds = array();
		public static $order = array();
	}

	function get_names() { return Data::$names; }
	function set_title($k, $v) { Data::$titles[$k] = $v; }
	function get_title($k) { return Data::$titles[$k]; }
	function set_tagline($k, $v) { Data::$taglines[$k] = $v; }
	function get_tagline($k) { return Data::$taglines[$k]; }
	function set_date($k, $v) { Data::$dates[$k] = $v; }
	function get_date($k) { return Data::$dates[$k]; }
	function set_content($k, $v) { Data::$contents[$k] = $v; }
	function get_content($k) { return Data::$contents[$k]; }
	function set_is_published($k, $v) { Data::$is_publisheds[$k] = $v; }
	function get_is_published($k) { return Data::$is_publisheds[$k]; }
	function set_order($k, $v) { Data::$order[$k] = $v; }

	function get_full_title($k) { return get_title($k).': '.get_tagline($k); }

	// Load post names and metadata
	$filenames = array();
	foreach (scandir(\com\grimwire\blog\DIRECTORY.'/posts') as $filename) {
		if ($filename == '.' || $filename == '..' || substr($filename, -4) != '.php') {
			continue;
		}
		$filename = basename($filename, '.php'); // strip the extension
		require_once(\com\grimwire\blog\DIRECTORY.'/posts/'.$filename.'.inc'); // load metadata
		Data::$names[isset(Data::$order[$filename]) ? Data::$order[$filename] : rand(100,1000)] = $filename; // store post by order
	}
	krsort(Data::$names);
}
?>