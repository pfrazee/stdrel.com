<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('page');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/page: Web Page</title>
		<?= partials\styles() ?>
	</head>

	<body>
		<?= host\partials\header('page') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('page') ?>
			<div class="content">
				<h1>gwr.io/page <small>Web Page</small></h1>
				<p>The resource is an HTML Web page.</p>
				<h3>Page <small>rel="gwr.io/page"</small></h3>
				<ul>
					<li>GET: provides <code>Content-Type=text/html</code>
				</ul>
			</div>
		</div>
	</body>
</html>

