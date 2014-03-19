<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('reltypes');
?>

<!doctype html>
<html>
	<head>
		<title>stdrel - Web Reltypes Library</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<div id="footer-wrapper-helper">
			<?= host\partials\header('reltypes') ?>
			<?= host\partials\reltypes_nav('reltypes') ?>

			<div id="reltypes" class="twocolumnpage">
				<div class="sidebar">
				</div>
				<div class="content">
					<h2>Web Types System</h2>
					<p>To construct the page, Web browsers require multiple interactions with services. This often includes downloading images, stylesheets, and scripts. The requests can be triggered with tags like <code>&lt;script&gt;</code>, but, in the case of stylesheets, it is driven by a typed link:</p>
					<pre><code class="language-markup">&lt;link rel="stylesheet" href="bootstrap.css"&gt;</code></pre>
					<p>In addition to being a trigger for browser behavior, the <code>stylesheet</code> rel tells clients, "this URL serves CSS." It is a contract for behaviors on both sides of the transaction, and it's one of a <a href="http://www.iana.org/assignments/link-relations/link-relations.xhtml#link-relations-1">standard registry</a> which includes:</p>
					<pre><code class="language-markup">&lt;link rel="icon" href="favicon.png" type="image/png"&gt;
&lt;link rel="next" href="/article?page=2" title="Reltypes Are Awesome! (page 2)"&gt;
&lt;link rel="prefetch" href="/img/bob.jpg"&gt;</code></pre>
					<p>These <code>rel</code> attributes are called "reltypes." By adopting the browser's model of exchanging and searching through reltyped links, Web applications can achieve portability across services &ndash; a key requirement for the <a href="http://httplocal.com">HTTPLocal architecture</a>.</p>
					<p><strong>Features of reltypes</strong>:</p>
					<ul>
						<li>They can be listed in groups to combine their behaviors.</li>
						<li>Developers can publish custom reltype specs, then use the published URL as the reltype name.</li>
						<li>Links are just key-value bags with <code>href</code>, <code>rel</code>, and any additional attributes set by the reltypes used. They're used most often in HTML <code>&lt;link&gt;</code> elements, but they also work in <code>Link</code> response headers and <a href="http://stateless.co/hal_specification.html">JSON-HAL</a> documents.</li>
					</ul>
					<h3>What is stdrel?</h3>
					<p><a href="/">stdrel.com</a> is a library of common reltypes for developers to use in their APIs. It is currently in development, but will include detailed specs, examples, and libraries to get developers started. Pull requests are submitted and discussed at <a href="https://github.com/pfraze/stdrel.com">GitHub</a>.</p>
					<br>
					<div class="panel panel-default">
						<div class="panel-heading"><h3 class="panel-title">How are the reltypes used?</h3></div>
						<div class="panel-body">
							<p>Reltypes can be used in any link, but they are often used in HTML <code>&lt;link&gt;</code> elements, <a href="http://stateless.co/hal_specification.html">JSON-HAL</a>, and in the <a href="http://tools.ietf.org/html/rfc5988">Link response header</a>. Here's a link to a user record that, using <code>GET</code>, <code>PUT</code>, and <code>DELETE</code>, can be fetched, updated, and deleted:</p>
							<strong><small>HTML</small></strong><br>
							<pre><code class="language-markup">&lt;link rel="schema.org/Person stdrel.com/crud-item" href="/users/bob" id="bob"&gt;</code></pre>
							<strong><small>JSON-HAL</small></strong><br>
							<pre><code class="language-javascript">{"_links": {"schema.org/Person stdrel.com/crud-item": {"href": "/users/bob", "id": "bob"} } }</code></pre>
							<strong><small>Link header</small></strong><br>
							<pre><code class="language-markup">Link: &lt;/users/bob&gt;; rel="schema.org/Person stdrel.com/crud-item"; id="bob"</code></pre>
							<p>We know the schema of <code>/users/bob</code> because of <a href="http://schema.org/Person">schema.org/Person</a>, and we know the supported methods because of <a href="/crud-item">stdrel.com/crud-item</a>. Local.js includes a <a href="http://httplocal.com/docs.html#docs/en/0.6.2/api/querylinks.md">queryLinks</a> method for searching lists of links, and a <a href="http://httplocal.com/docs.html#docs/en/0.6.2/api/agent.md">User Agent</a> which navigates by querying service Link headers.</p>
						</div>
					</div>
					<br><br>
				</div>
			</div>
			<div id="footer-wrapper-push"></div>
		</div>
		<?= host\partials\footer() ?>
	</body>
</html>