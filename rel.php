<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('rel');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/rel: Relation Type</title>
		<?= partials\styles() ?>
	</head>

	<body>
		<?= host\partials\header('rel') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('rel') ?>
			<div class="content">
				<h1>gwr.io/rel <small>Relation Type</small></h1>
				<p>The resource is a relation type.</p>
				<p><em>The resource has no defined behaviors.</em></p>
			</div>
		</div>
	</body>
</html>

