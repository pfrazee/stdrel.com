<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('media');
?>

<!doctype html>
<html>
	<head>
		<title>stdrel.com/media - Media</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<div id="footer-wrapper-helper">
			<?= host\partials\header('media') ?>
			<?= host\partials\reltypes_nav('media') ?>

			<div id="reltype" class="twocolumnpage">
				<div class="sidebar">
				</div>
				<div class="content">
					<h2>stdrel.com/media <small>Media</small></h2>
					<p>The resource is an image, video, audio, or text document.</p>
					<p>Links which export this type <strong>MUST</strong>:</p>
					<ul>
						<li>Include a `type` attribute labeling the mimetype of the content.</li>
					</ul>
					<p>Resources which export this type <strong>MUST</strong>:</p>
					<ul>
						<li>Support the <code>GET</code> method with Accept of the type given by the link <code>type</code>, responding with the media document.</li>
					</ul>
					<p>If the resource supports multiple types, it's recommended to use multiple links which each label the supported type.</p>
				</div>
			</div>
			<div id="footer-wrapper-push"></div>
		</div>
		<?= host\partials\footer() ?>
	</body>
</html>