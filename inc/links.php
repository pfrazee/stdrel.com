<?
namespace links {
	function serialize_item($link) {
		$linkheaderitem = array('<'.$link['href'].'>');
		foreach ($link as $k=>$v) {
			if ($k == 'href') { continue; }
			$linkheaderitem[] = $k.'="'.$v.'"';
		}
		return join('; ', $linkheaderitem);
	}
	function serialize($links) {
		$linkheader = array();
		foreach ($links as &$link) {
			// Add to header
			$linkheader[] = serialize_item($link);
		}
		return join(', ', $linkheader);
	}
}

namespace com\grimwire\links {
	function setheader($current) {
		$links = array(
			// Static pages
			'home'       => array('href'=>'https://grimwire.com',            'rel'=>'collection gwr.io/page', 'id'=>'home',       'title'=>'Grimwire Home'),
			'blog'       => array('href'=>'http://blog.grimwire.com',       'rel'=>'item collection gwr.io/page', 'id'=>'blog',  'title'=>'Grimwire Blog'),
			'reltypes'   => array('href'=>'http://gwr.io',                  'rel'=>'item collection gwr.io/page', 'id'=>'gwr.io', 'title'=>'Grimwire Relation Types'),
			'download'   => array('href'=>'https://grimwire.com/download',   'rel'=>'item gwr.io/page',       'id'=>'download',   'title'=>'Download Grimwire'),
			'local.js'   => array('href'=>'https://grimwire.com/local',      'rel'=>'item gwr.io/page',       'id'=>'local.js',   'title'=>'Local.js Documentation')
		);
		$links['home']['rel'] .= ' via service'; // add toplevel rels
		$links['reltypes']['rel'] .= ' service'; // add toplevel rels
		$links[$current]['rel'] .= ' self'; // add positional rels
		if ($current != 'home') { $links['home']['rel'] .= ' up'; } // add positional rels
		header('Link: '.\links\serialize($links));
	}
}

namespace com\grimwire\blog\links {
	use \com\grimwire\blog\posts;
	function setheader($current) {
		$links = array(
			// Static pages
			'home'     => array('href'=>'https://grimwire.com',          'rel'=>'collection gwr.io/page',      'id'=>'home',     'title'=>'Grimwire Home'),
			'blog'     => array('href'=>'http://blog.grimwire.com',     'rel'=>'item collection gwr.io/page', 'id'=>'blog',     'title'=>'Grimwire Blog'),
			'reltypes' => array('href'=>'http://gwr.io/',         'rel'=>'item collection gwr.io/page', 'id'=>'reltypes', 'title'=>'Grimwire Relation Types')
		);
		// add posts
		foreach (posts\get_names() as $postname) {
			if (!posts\get_is_published($postname)) { continue; }
			$links[$postname] = array(
				'href'  => 'http://blog.grimwire.com/posts/'.$postname,
				'rel'   => 'item gwr.io/page',
				'id'    => $postname,
				'title' => posts\get_title($postname)
			);
		}
		$links['home']['rel'] .= ' via service'; // add toplevel rels
		$links[$current]['rel'] .= ' self'; // add positional rels
		if ($current != 'home' && $current != 'blog') { $links['blog']['rel'] .= ' up'; } // add positional rels
		if ($current == 'blog') { $links['home']['rel'] .= ' up'; } // add positional rels
		header('Link: '.\links\serialize($links));
	}
}

namespace io\gwr\links {
	function setheader($current) {
		$links = array(
			// Static pages
			'home'     => array('href'=>'https://grimwire.com',    'rel'=>'collection gwr.io/page',      'id'=>'home',     'title'=>'Grimwire Home'),
			'blog'       => array('href'=>'http://blog.grimwire.com',       'rel'=>'item collection gwr.io/page', 'id'=>'blog',  'title'=>'Grimwire Blog'),
			'reltypes' => array('href'=>'http://gwr.io/',         'rel'=>'item collection gwr.io/page', 'id'=>'reltypes', 'title'=>'Grimwire Relation Types'),
			'rel'      => array('href'=>'http://gwr.io/rel',      'rel'=>'item gwr.io/page gwr.io/rel', 'id'=>'rel',      'title'=>'Relation Type'),
			'page'     => array('href'=>'http://gwr.io/page',     'rel'=>'item gwr.io/page gwr.io/rel', 'id'=>'page',     'title'=>'Web Page'),
			'grimwire' => array('href'=>'http://gwr.io/grimwire', 'rel'=>'item gwr.io/page gwr.io/rel', 'id'=>'grimwire', 'title'=>'Grimwire Service'),
			'relays'   => array('href'=>'http://gwr.io/relays',   'rel'=>'item gwr.io/page gwr.io/rel', 'id'=>'relays',   'title'=>'Relay Collection'),
			'relay'    => array('href'=>'http://gwr.io/relay',    'rel'=>'item gwr.io/page gwr.io/rel', 'id'=>'relay',    'title'=>'Relay Item'),
			'users'    => array('href'=>'http://gwr.io/users',    'rel'=>'item gwr.io/page gwr.io/rel', 'id'=>'users',    'title'=>'User Account Collection'),
			'user'     => array('href'=>'http://gwr.io/user',     'rel'=>'item gwr.io/page gwr.io/rel', 'id'=>'user',     'title'=>'User Account Item'),
			'app'      => array('href'=>'http://gwr.io/app',      'rel'=>'item gwr.io/doc gwr.io/rel',  'id'=>'app',      'title'=>'3rd-party Application'),
			'session'  => array('href'=>'http://gwr.io/session',  'rel'=>'item gwr.io/doc gwr.io/rel',  'id'=>'session',  'title'=>'Session'),
			'ping'     => array('href'=>'http://gwr.io/ping',     'rel'=>'item gwr.io/doc gwr.io/rel',  'id'=>'ping',     'title'=>'Test Ping')
		);
		$links['home']['rel'] .= ' via service'; // add toplevel rels
		$links['reltypes']['rel'] .= ' service'; // add toplevel rels
		$links[$current]['rel'] .= ' self'; // add positional rels
		if ($current != 'home' && $current != 'reltypes') { $links['reltypes']['rel'] .= ' up'; } // add positional rels
		if ($current == 'reltypes') { $links['home']['rel'] .= ' up'; } // add positional rels
		header('Link: '.\links\serialize($links));
	}
}
?>