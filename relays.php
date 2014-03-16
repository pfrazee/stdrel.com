<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('relays');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/relays: Relay Collection</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<?= host\partials\header('relays') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('relays') ?>
			<div class="content">
				<h1>gwr.io/relays <small>Relay Collection</small></h1>
				<p>A collection of relay streams. Links to <a href="/grimwire">gwr.io/grimwire</a> and <a href="/relay">gwr.io/relay</a>.</p>

				<h3>Behaviors <small>rel="gwr.io/relays" links=</small></h3>
				<ul>
					<li>Links to 1 <code>rel="gwr.io/grimwire"</code> resource.
					<li>Links to 0 or more <code>rel="gwr.io/relay"</code> resources.
					<li>Parameters:<ul>
						<li><code>links</code>: if 1, will include all links registered by active streams in the Link response header.
					</ul>
				</ul>
			</div>
		</div>
	</body>
</html>

