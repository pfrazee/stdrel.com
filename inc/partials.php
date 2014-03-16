<?
namespace partials {
	function styles() { ?>
		<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/assets/css/grimwire.css" />
		<link rel="stylesheet" href="/assets/css/pages.css" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="/assets/favicon.png" />
	<? }
	function syntaxhighlighter() { ?>
		<link rel="stylesheet" href="/assets/prism/prism.css" />
		<script src="/assets/prism/prism.js"></script>
	<? }
	function isactive($show) { if ($show): ?>class="active"<? endif; }
}
namespace com\grimwire\partials {
	function header($current) { ?>
		<div id="header">
			<a href="https:////grimwire.com"><img src="/assets/logo.png"></a>
			<span><a <?=\partials\isactive($current=='home')?> href="https://grimwire.com">Home</a></span>
			<span><a <?=\partials\isactive($current=='download')?> href="https://grimwire.com/download">Download</a></span>
			<span><a <?=\partials\isactive($current=='local')?> href="https://grimwire.com/local">Local.js</a></span>
			<span><a <?=\partials\isactive($current=='blog')?> href="http://blog.grimwire.com">Blog</a></span>
			<span class="right"><a href="http://gwr.io">gwr.io</a></span>
		</div>
	<? }
}
namespace com\grimwire\blog\partials {
	use \com\grimwire\blog\posts;
	function sidebar($current) { ?>
		<div id="blog-sidebar" class="sidebar">
			<ul>
			<? foreach (posts\get_names() as $postname): ?>
				<? if (!posts\get_is_published($postname)) { continue; } ?>
				<li <?=\partials\isactive($current==$postname)?>>
					<a href="/posts/<?= $postname ?>"><?= posts\get_title($postname) ?></a><br>
					<small><?= posts\get_tagline($postname) ?></small>
				</li>
			<? endforeach; ?>
			</ul>
		</div>
	<? }
	function viewpage($postname) { ?>
		<h1><?= posts\get_title($postname) ?> <small><?= posts\get_tagline($postname) ?></small></h1>
		<p><a href="http://twitter.com/pfrazee">@pfrazee</a> on <?= posts\get_date($postname) ?></p>
		<?= posts\get_content($postname) ?>
	<? }
}
namespace io\gwr\partials {
	function header($current) { ?>
		<div id="header">
			<a href="http://gwr.io"><img src="/assets/logo.png"></a>
			<span><a <?=\partials\isactive($current=='reltypes')?> href="http://gwr.io">Relation Types</a></span>
			<span class="right"><a href="https://grimwire.com">grimwire.com</a></span>
		</div>
	<? }
	function sidebar($current) { ?>
		<div id="reltype-sidebar" class="sidebar">
			<ul>
				<li <?=\partials\isactive($current=='grimwire')?>><a href="http://gwr.io/grimwire">gwr.io/grimwire</a><br><small>Grimwire Service</small>
				<li <?=\partials\isactive($current=='relays')?>><a href="http://gwr.io/relays">gwr.io/relays</a><br><small>Relay Collection</small>
				<li <?=\partials\isactive($current=='relay')?>><a href="http://gwr.io/relay">gwr.io/relay</a><br><small>Relay Item</small>
				<li <?=\partials\isactive($current=='users')?>><a href="http://gwr.io/users">gwr.io/users</a><br><small>User Account Collection</small>
				<li <?=\partials\isactive($current=='user')?>><a href="http://gwr.io/user">gwr.io/user</a><br><small>User Account Item</small>
				<li <?=\partials\isactive($current=='app')?>><a href="http://gwr.io/app">gwr.io/app</a><br><small>3rd-party Application</small>
				<li <?=\partials\isactive($current=='session')?>><a href="http://gwr.io/session">gwr.io/session</a><br><small>Session</small>
				<li <?=\partials\isactive($current=='page')?>><a href="http://gwr.io/page">gwr.io/page</a><br><small>Web Page</small>
				<li <?=\partials\isactive($current=='ping')?>><a href="http://gwr.io/ping">gwr.io/ping</a><br><small>Test Ping</small>
				<li <?=\partials\isactive($current=='rel')?>><a href="http://gwr.io/rel">gwr.io/rel</a><br><small>Relation Type</small>
			</ul>
		</div>
	<? }
} ?>