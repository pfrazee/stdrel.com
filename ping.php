<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('ping');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/ping: Test Ping</title>
		<?= partials\styles() ?>
	</head>

	<body>
		<?= host\partials\header('ping') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('ping') ?>
			<div class="content">
				<h1>gwr.io/ping <small>Test Ping</small></h1>
				<p>The resource responds to GET requests with a welcome banner.</p>
				<h3>Page <small>rel="gwr.io/ping"</small></h3>
				<ul>
					<li>GET: provides <code>Content-Type=text/plain</code>
				</ul>
			</div>
		</div>
	</body>
</html>

