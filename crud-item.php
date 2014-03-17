<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('crud-item');
?>

<!doctype html>
<html>
	<head>
		<title>/crud-item - CRUD Item</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<div id="footer-wrapper-helper">
			<?= host\partials\header('crud-item') ?>
			<?= host\partials\reltypes_nav('crud-item') ?>

			<div id="reltype" class="twocolumnpage">
				<div class="sidebar">
				</div>
				<div class="content">
					<h2>stdrel.com/crud-item <small>CRUD Item <strong>draft status - may change without notice</strong></small></h2>
					<p>The resource is a item within a resource of type <a href="/crud-coll">stdrel.com/crud-coll</a>.</p>
					<p>Resources which export this type <strong>MUST</strong>:</p>
					<ul>
						<li>In the <code>Link</code> response header, include a link of type <a href="/crud-coll">stdrel.com/crud-coll</a> to refer to the item's
							parent-resource.</li>
						<li>Support the <code>PUT</code> method as follows:<ul>
							<li>If the request is valid, replaces the resource data with the request body. Responds <code>204 No Content</code>. If the URL of the item
								has changed, should set the <code>Location</code> header to the new URL.</li>
							<li>If the request body contains invalid values, responds <code>422 Unprocessable Entity</code>.
						</ul></li>
						<li>Support the <code>DELETE</code> method as follows:<ul>
							<li>If the request is valid, removes the resource from the collection. Responds <code>204 No Content</code>.</li>
						</ul></li>
					</ul>
					<p>Resources which export this type <strong>SHOULD</strong>:</p>
					<ul>
						<li>In a <code>422 Unprocessable Entity</code> response, include a <code>Bad Entity Document</code> in the response body.</li>
					</ul>
					<hr>
					<p><strong>Bad Entity Document</strong></p>
					<p>This document describes the invalid values or structure in a POSTed entity. It mimics the structure of the submitted entity, and provides
						error descriptions for the "bad" values in the POST body. It <strong>MAY-</strong> be provided in any mimetype <strong>-IF</strong> its parsed
						structure follows the following schema:</p>
					<ul class="schema">
						<li><code>errors</code> <strong>object</strong> The object containing error descriptions.<ul>
							<li><code>[entity-attr-1]</code> <strong>string</strong> An error description for an attribute in the POSTed entity.</li>
							<li><code>[entity-attr-2]</code> <strong>object</strong> An object containing error descriptions for sub-attributes.</li>
							<li>...</li>
							<li><code>[entity-attr-N]</code> <strong>string</strong></li>
						</ul></li>
					</ul>
					<p>An example of the Bad Entity Document:</p>
					<pre>{
  "errors": {
    "username": "Required.",
    "password": "Must contain 1 letter and 1 number.",
    "dob": {
      "day": "Must be an integer between 1 and 31.",
      "month": "Must be an integer between 1 (January) and 12 (December).",
      "year": "Must be an integer between 1900 and 2100."
    }
  }
}</pre>
				</div>
			</div>
			<div id="footer-wrapper-push"></div>
		</div>
		<?= host\partials\footer() ?>
	</body>
</html>