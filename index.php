<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('reltypes');
?>

<!doctype html>
<html>
	<head>
		<title>stdrel - Web Relation Types Library</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<div id="footer-wrapper-helper">
			<?= host\partials\header('reltypes') ?>
			<?= host\partials\reltypes_nav('reltypes') ?>

			<div id="reltypes" class="twocolumnpage">
				<div class="sidebar">
				</div>
				<div class="content">
					<h3>What are reltypes?</h3>
					<blockquote>
						<p>A link relation type identifies the semantics
							of a link.  For example, a link with the relation type "copyright"
							indicates that the resource identified by the link is a
							statement of the copyright terms applying to the current location.</p>
						<p>Link relation types can also be used to indicate that the target
							resource has particular attributes, or exhibits particular
							behaviours.</p>
						<small><a href="http://tools.ietf.org/html/rfc5988#section-4">RFC 5988</a></small>
					</blockquote>
					<p>Relation types identify what a URL is and what it can do. They are included in links under the <code>rel</code> attribute, and are often used in the Link
						response header. Clients send HEAD requests to hosts and search the Link header entries according to their attirbutes. By testing the relation types,
						the clients determine the semantics of the link and the expected behaviors of the link's reference.</p>
					<pre><code class="language-javascript">// Example 1
local.agent('http://knownhost.com')
  .follow({ rel: 'stdrel.com/user', id: 'bob' })
  .PATCH({ avatar: 'cowboy' });</code></pre>
	<pre>Traffic with knownhost.com:
<span style="color: #045AC7">&rarr; HEAD / HTTP/1.1</span>
<span style="color: #905">&larr; HTTP/1.1 200 Ok</span>
<span style="color: #905">&larr; Link: &lt;http://knownhost.com&gt;; rel="self service", &lt;http://knownhost.com/users/{id}&gt;; rel="item stdrel.com/user"</span>
<span style="color: #045AC7">&rarr; PATCH /users/bob HTTP/1.1 ...</span></pre>
	  				<p>We know the <code>PATCH</code> will succeed because the destination's link exported the <code>stdrel.com/user</code> relation type, which
	  					defines a <code>PATCH</code> method with the semantics used in the example. (It doesn't really exist, but, if it did, it would.) This allows us to generalize
	  					clients away from specific hosts.</p>
					<pre><code class="language-javascript">// Example 2
function setUserAvatar(host, user, avatar) {
  local.agent(host)
    .follow({ rel: 'stdrel.com/user', id: user })
    .patch({ avatar: avatar });
}
setUserAvatar('http://knownhost.com', 'bob', 'cowboy');
setUserAvatar('http://anotherhost.com', 'alice', 'astronaut');</code></pre>
					<p>If the given host does not provide a <code>rel="stdrel.com/user"</code> link, the client will fail before sending the PATCH request with a
						status 1 Link Not Found.</p>
					<br><br>
				</div>
			</div>
			<div id="footer-wrapper-push"></div>
		</div>
		<?= host\partials\footer() ?>
	</body>
</html>