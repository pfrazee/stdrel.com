<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('transformer');
?>

<!doctype html>
<html>
	<head>
		<title>/transformer - Stream Transformer</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<div id="footer-wrapper-helper">
			<?= host\partials\header('transformer') ?>
			<?= host\partials\reltypes_nav('transformer') ?>

			<div id="reltype" class="stdpage">
				<div class="content">
					<h2>stdrel.com/transformer <small>Stream Transformer</small></h2>
					<p>A resource for applying transformations for streams of text. Similar in nature to Unix's STDIO interface.</p>
					<p><b class="glyphicon glyphicon-flag text-danger"></b> Resources which export this type <strong>MUST</strong>:</p>
					<ul>
						<li>Support the <code>POST</code> method with Content-Type of <code>text/plain</code> and an Accept of <code>text/plain</code>.</li>
					</ul>
					<p><b class="glyphicon glyphicon-flag text-warning"></b> Resources which export this type <strong>SHOULD</strong>:</p>
					<ul>
						<li>Stream response chunks as soon as they are delivered by the request stream, when supported by the protocol (HTTPL).</li>
					</ul>
					<br><br>
					<div class="panel panel-default">
						<div class="panel-heading"><h3 class="panel-title">Reference implementation</h3></div>
						<div class="panel-body">
							<p>Written in <a href="http://httplocal.com">Local.js</a></p>
							<pre><code class="language-javascript">importScripts('/local.min.js');
function main(req, res) {
  // Set headers
  res.header('Link', [{ href: '/', rel: 'self stdrel.com/transformer', title: 'To Uppercase' }]);
  res.header('Content-Type', 'text/plain');

  if (req.method == 'HEAD') {
	// Respond with headers only
	res.writeHead(204, 'OK, no content').end();
	return;
  }

  if (req.method == 'POST') {
	// Apply transformation
	res.writeHead(200, 'OK'); // because HTTPL is full-duplex, we can respond while the request is streaming
	req.on('data', function(chunk) { res.write(chunk.toUpperCase()); });
	req.on('end',  function()      { res.end(); });
	return;
  }

  // Invalid method
  res.writeHead(405, 'Bad Method').end();
}</code></pre>
						</div>
					</div>
				</div>
			</div>
			<div id="footer-wrapper-push"></div>
		</div>
		<?= host\partials\footer() ?>
	</body>
</html>