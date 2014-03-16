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
		);
		$links['reltypes']['rel'] .= 'via service'; // add toplevel rels
		$links[$current]['rel'] .= ' self'; // add positional rels
		if ($current != 'reltypes') { $links['reltypes']['rel'] .= ' up'; } // add positional rels
		header('Link: '.\links\serialize($links));
	}
}
?>