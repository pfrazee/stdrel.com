<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('crud-coll');
?>

<!doctype html>
<html>
	<head>
		<title>/crud-coll - CRUD Collection</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<div id="footer-wrapper-helper">
			<?= host\partials\header('crud-coll') ?>
			<?= host\partials\reltypes_nav('crud-coll') ?>

			<div id="reltype" class="stdpage">
				<div class="content">
					<h2>stdrel.com/crud-coll <small>CRUD Collection <strong>draft status - may change without notice</strong></small></h2>
					<p>The resource is a collection of sub-resources of type <a href="/crud-item">stdrel.com/crud-item</a>.</p>
					<p><b class="glyphicon glyphicon-flag text-danger"></b> Resources which export this type <strong>MUST</strong>:</p>
					<ul>
						<li>In the <code>Link</code> response header, list individual links, or a templated link, of type <a href="/crud-item">stdrel.com/crud-item</a>
							to refer to the collection's sub-resources.</li>
						<li>Support the <code>POST</code> method as follows:<ul>
							<li>If the request is valid, creates a sub-resource within the collection. Responds <code>201 Created</code> with the <code>Location</code>
								header set to the URI of the newly-created item.</li>
							<li>If the request body contains invalid values, responds <code>422 Unprocessable Entity</code>.
						</ul></li>
					</ul>
					<p><b class="glyphicon glyphicon-flag text-warning"></b> Resources which export this type <strong>SHOULD</strong>:</p>
					<ul>
						<li>In a <code>422 Unprocessable Entity</code> response, include a <code>Bad Entity Document</code> in the response body.</li>
					</ul>
					<br><br>
					<div class="panel panel-default">
						<div class="panel-heading"><h3 class="panel-title">Bad Entity Document</h3></div>
						<div class="panel-body">
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
						<pre><code class="language-javascript">{
  "errors": {
    "username": "Required.",
    "password": "Must contain 1 letter and 1 number.",
    "dob": {
      "day": "Must be an integer between 1 and 31.",
      "month": "Must be an integer between 1 (January) and 12 (December).",
      "year": "Must be an integer between 1900 and 2100."
    }
  }
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