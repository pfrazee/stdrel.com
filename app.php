<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('app');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/app: 3rd-party Application</title>
		<?= partials\styles() ?>
	</head>

	<body>
		<?= host\partials\header('app') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('app') ?>
			<div class="content">
				<h1>gwr.io/app <small>3rd-party Application</small></h1>
				<p>The resource is the root URL of an application which is connected to the relay and accepting WebRTC connections.</p>
                <p><em>The resource has no defined behaviors.</em></p>
			</div>
		</div>
	</body>
</html>

