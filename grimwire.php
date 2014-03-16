<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('grimwire');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/grimwire: Grimwire Service</title>
		<?= partials\styles() ?>
	</head>

	<body>
		<?= host\partials\header('grimwire') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('grimwire') ?>
			<div class="content">
				<h1>gwr.io/grimwire <small>Grimwire Service</small></h1>
				<p>Toplevel resource of a service that hosts relays and users. Links to <a href="/relays">gwr.io/relays</a>, <a href="/relay">gwr.io/relay</a>, <a href="/users">gwr.io/users</a>, and <a href="/user">gwr.io/user</a>.</p>

				<h3>Behaviors <small>rel="gwr.io/grimwire"</small></h3>
				<ul>
					<li>Links to 0 or more <code>rel="gwr.io/relays"</code> resources.
					<li>Links to 0 or more <code>rel="gwr.io/relay"</code> resources.
					<li>Links to 0 or more <code>rel="gwr.io/users"</code> resources.
					<li>Links to 0 or more <code>rel="gwr.io/user"</code> resources.
				</ul>
			</div>
		</div>
	</body>
</html>

