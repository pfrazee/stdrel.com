<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('reltypes');
?>

<!doctype html>
<html>
	<head>
		<title>Grimwire Relation Types</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<?= host\partials\header('reltypes') ?>

		<div id="reltypes" class="twocolumnpage">
			<?= host\partials\sidebar('reltypes') ?>
			<div class="content">
				<h1>Grimwire Protocols</h1>
				<p>This is a registry of reltypes used by <a href="//grimwire.com">Grimwire</a>.</p>
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
				<p>Grimwire uses relation types to identify services. The directory protocol sends HEAD requests to known hosts and searches the Link response
					headers for endpoints. By using relation types, strong assumptions can be made about behavior.</p>
				<pre><code class="language-javascript">// Example 1
local.agent('http://knownhost.com')
  .follow({ rel: 'gwr.io/user', id: 'bob' })
  .PATCH({ avatar: 'cowboy' });</code></pre>
<pre>Traffic with knownhost.com:
<span style="color: #045AC7">&rarr; HEAD / HTTP/1.1</span>
<span style="color: #905">&larr; HTTP/1.1 200 Ok</span>
<span style="color: #905">&larr; Link: &lt;http://knownhost.com&gt;; rel="self service gwr.io", &lt;http://knownhost.com/users/{id}&gt;; rel="item gwr.io/user"</span>
<span style="color: #045AC7">&rarr; PATCH /users/bob HTTP/1.1 ...</span></pre>
  				<p>We know the PATCH will succeed because the destination's link exported the <a href="/user">gwr.io/user</a> relation type, which
  					defines a PATCH method with the semantics used in the example. This allows use to generalize clients away from specific hosts.</p>
				<pre><code class="language-javascript">// Example 2
function setUserAvatar(host, user, avatar) {
  local.agent(host)
    .follow({ rel: 'gwr.io/user', id: user })
    .patch({ avatar: avatar });
}
setUserAvatar('http://knownhost.com', 'bob', 'cowboy');
setUserAvatar('http://anotherhost.com', 'alice', 'astronaut');</code></pre>
				<p>If the given host does not provide a <a href="/user">rel="gwr.io/user"</a> link, the client will fail before sending the PATCH request with a
					status 1 Link Not Found.</p>
				<?/*<p>Notice also in <em>Example 1</em> that a template token <code>{id}</code> is used in the user link. Local.js uses
					<a href="http://tools.ietf.org/html/rfc6570">URI Templates</a> to reduce the number of links in the header; rather than link to every available
					user, the link provides a template for creating their URIs. The link queries in Local.js the template tokens similarly to link attributes,
					so <code>&lt;http://knownhost.com/users/bob&gt;; rel="item gwr.io/user"; id="bob"</code> would match the query in <em>Example 1</em> in the
					same fashion.</p>*/?>
				<p>In Grimwire relays, a registry of links is populated by the active applications. To discover a peer, pages send HEAD requests to the
					<a href="/relays">gwr.io/relays</a> resource and query the Link response header.</p><?/* This is available with the <code>agent()</code>
					function of <code>local.Relay</code>, which provides an agent that points at the relay's index:
<pre><code class="language-javascript">// Example 3
myrelay.agent()
  .follow({ rel: 'chat.grimwire.com/room', host_user: 'bob', host_relay: 'myrelay.com', id: 'bobs-chat-room' })
  .subscribe()
  .then(function(roomEvents) {
    // ...
  });</code></pre>
  				<p>Links to relay peers automatically have the <code>host_user</code>, <code>host_relay</code>, <code>host_app</code>, and <code>host_sid</code> attributes populated when
  					the Link header is parsed by Local.js. Similarly, all links have their <code>host_domain</code> attribute set to the domain of the destination URI. As in
  					<em>Example 3</em>, they can be used to enforce guarantees on host identity, as the attributes are extracted from the URI itself, and URIs are guaranteed by the
  					signalling process wherein the relay acts as a trusted third-party.</p>*/?>
				<br><br>
			</div>
		</div>
	</body>
</html>