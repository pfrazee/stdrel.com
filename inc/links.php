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

namespace com\stdrel\links {
	function setheader($current) {
		$links = array(
			// Static pages
			'reltypes'    => array('href'=>'http://stdrel.com/',            'rel'=>'item collection',     'id'=>'reltypes',    'title'=>'stdrel - Web Relation Types'),
			'rel'         => array('href'=>'http://stdrel.com/rel',         'rel'=>'item stdrel.com/rel', 'id'=>'rel',         'title'=>'Relation Type'),
			'media'       => array('href'=>'http://stdrel.com/media',       'rel'=>'item stdrel.com/rel', 'id'=>'media',       'title'=>'Media'),
			'transformer' => array('href'=>'http://stdrel.com/transformer', 'rel'=>'item stdrel.com/rel', 'id'=>'transformer', 'title'=>'Stream Transformer'),
			'crud-coll'   => array('href'=>'http://stdrel.com/crud-coll',   'rel'=>'item stdrel.com/rel', 'id'=>'crud-coll',   'title'=>'CRUD Collection'),
			'crud-item'   => array('href'=>'http://stdrel.com/crud-item',   'rel'=>'item stdrel.com/rel', 'id'=>'crud-item',   'title'=>'CRUD Item'),
		);
		$links['reltypes']['rel'] .= 'via service'; // add toplevel rels
		if (array_key_exists($current, $links)) { $links[$current]['rel'] .= ' self'; } // add positional rels
		if ($current != 'reltypes') { $links['reltypes']['rel'] .= ' up'; } // add positional rels
		header('Link: '.\links\serialize($links));
	}
}
?>