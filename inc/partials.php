<?
namespace partials {
	function styles() { ?>
		<link rel="stylesheet" href="/assets/css/bootstrap.css" />
		<link rel="stylesheet" href="/assets/css/sitewide.css" />
		<link rel="stylesheet" href="/assets/css/pages.css" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="/assets/favicon.png" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<? }
	function syntaxhighlighter() { ?>
		<link rel="stylesheet" href="/assets/prism/prism.css" />
		<script src="/assets/prism/prism.js"></script>
	<? }
	function bootstrapjs() { ?>
		<script src="/assets/js/jquery-2.1.0.min.js"></script>
		<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
	<? }
	function isactive($show) { if ($show): ?>class="active"<? endif; }
}
namespace com\stdrel\partials {
	function header($current) { ?>
		<div id="header">
			<img src="/assets/img/icon-network.png">
			<h1><a href="http://stdrel.com">stdrel</a> <small>web reltypes library</small></h1>
		</div>
	<? }
	function reltypes_nav($current) { ?>
		<div id="reltypes-nav">
			<ul class="list-inline">
				<li <?=\partials\isactive($current=='rel')?>><a href="http://stdrel.com/rel">stdrel.com/rel</a><br><small>Relation Type</small>
				<li <?=\partials\isactive($current=='media')?>><a href="http://stdrel.com/media">stdrel.com/media</a><br><small>Media</small>
				<li <?=\partials\isactive($current=='transformer')?>><a href="http://stdrel.com/transformer">stdrel.com/transformer</a><br><small>Stream Transformer</small>
				<li <?=\partials\isactive($current=='crud-coll')?>><a href="http://stdrel.com/crud-coll">stdrel.com/crud-coll</a><br><small>CRUD Collection <strong>draft</strong></small>
				<li <?=\partials\isactive($current=='crud-item')?>><a href="http://stdrel.com/crud-item">stdrel.com/crud-item</a><br><small>CRUD Item <strong>draft</strong></small>
			</ul>
		</div>
	<? }
	function footer() { ?>
		<div id="footer">
			<hr>
			<ul class="list-inline">
				<li>Maintained by <a href="https://twitter.com/pfrazee">@pfrazee</a></li>
				<li>&middot;</li>
				<li><a href="http://httplocal.com">HTTPLocal.com</a></li>
				<li>&middot;</li>
				<li>Pull requests are welcome at <a href="https://github.com/pfraze/stdrel.com">GitHub</a></li>
			</ul>
		</div>
	<? }
} ?>