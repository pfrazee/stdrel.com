<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('rel');
?>

<!doctype html>
<html>
	<head>
		<title>stdrel.com/rel - Relation Type</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<div id="footer-wrapper-helper">
			<?= host\partials\header('rel') ?>
			<?= host\partials\reltypes_nav('rel') ?>

			<div id="reltype" class="twocolumnpage">
				<div class="sidebar">
				</div>
				<div class="content">
					<h2>stdrel.com/rel <small>Relation Type</small></h2>
					<p>The resource is a relation type.</p>
					<p>Resources which export this type <strong>SHOULD</strong>:</p>
					<ul>
						<li>Support the <code>GET</code> method with Accept of <code>text/plain</code> and/or <code>text/html</code>, responding with documentation for the reltype's semantics and behaviors.</li>
					</ul>
					<br><br>
				</div>
			</div>
			<div id="footer-wrapper-push"></div>
		</div>
		<?= host\partials\footer() ?>
	</body>
</html>