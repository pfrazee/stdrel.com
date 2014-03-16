<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('relay');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/relay: Relay Item</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<?= host\partials\header('relay') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('relay') ?>
			<div class="content">
				<h1>gwr.io/relay <small>Relay Item</small></h1>
				<p>An event-stream which rebroadcast events sent from remote nodes. Labels each event-stream with a <em>Peer URI Schema</em>.
					Events are sent in NOTIFY requests and must be targeted at specific streams. Links to <a href="/grimwire">gwr.io/grimwire</a>
					and <a href="/relays">gwr.io/relays</a>.</p>

				<h3>Behaviors <small>rel="gwr.io/relay" user= app= sid= nc=</small></h3>
				<ul>
					<li>Links to 1 <code>rel="gwr.io/grimwire"</code> resource.
					<li>Links to 1 <code>rel="gwr.io/relays"</code> resource.
					<li>Parameters:<ul>
						<li><code>user</code> the string id of the user using the stream.
						<li><code>app</code> the domain of the application using the stream.
						<li><code>sid</code> the numeric id of the stream.
						<li><code>nc</code> a random value which will force a cache-miss on browsers which cache XHR responses.
					</ul>
					<li>SUBSCRIBE: provides a <code>Content-Type=text/event-stream</code> which sends the <em>Signal Event</em>.<ul>
						<li>200: stream created, keep alive to receive events. NOTIFY requests can now target you at your peer URI.
						<li>401: must authorize using Cookie or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
						<li>403: <code>user</code> or <code>app</code> do not match your session's values.
						<li>423: the peer URI for this stream is in use. Try again with another <code>sid</code> value.
					</ul>
					<li>NOTIFY: handles <code>Content-Type=application/json</code> which conforms to the <em>Broadcast Event Schema</em>.<ul>
						<li>204: event delivered to at least one given destination.
						<li>401: must authorize using Cookie or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
						<li>403: <code>user</code> or <code>app</code> do not match your session's values.
						<li>404: none of the specified destinations were active streams.
						<li>422: the request body did not conform to the <em>Broadcast Event Schema</em>.
					</ul>
					<li>GET: provides <code>Content-Type=application/json</code> which conforms to the <em>Relay Item Schema</em>.<ul>
						<li>200: requested stream data.
						<li>401: must authorize using Cookies or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
						<li>404: stream is not active.
					</ul>
					<li>PATCH: handles <code>Content-Type=application/json</code> which conforms to the <em>Relay Item Schema</em>.<ul>
						<li>204: stream data updated.
						<li>401: must authorize using Cookies or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
						<li>403: must be the owner of the stream to make updates.
						<li>404: stream is not active.
						<li>422: the request body did not conform to the <em>Relay Item Schema</em>.
					</ul>
				</ul>

				<h3>Peer URI Schema <small>user@relay!app:sid</small></h3>
				<p>Structured as <code>user@relay!app:sid</code> where:</p>
				<ul>
					<li><code>user</code> the id of an account on the relay.
					<li><code>relay</code> the domain of the relay host.
					<li><code>app</code> the domain of the page host.
					<li><code>sid</code> a numeric id for the sid.
				</ul>

				<h3>Broadcast Event Schema <small>{src:,dst:,msg:}</small></h3>
				<p>The schema of NOTIFY request bodies and of the "signal" event:</p>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>src</code> required string, the peer URI of the stream which is sending this "signal" event.
						<li><code>dst</code> required string or Array(string), the peer URI(s) of the stream(s) which should receive this "signal" event.
						<li><code>msg</code> required string, the message content.
					</ul>
					<code>}</code>
				</div>

				<h3>Stream Item Schema <small>{links:}</small></h3>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>links</code> required Array(object or string), the links to broadcast at the relay. <code>[</code><ul>
							<li>If a string, must match the <a href="http://tools.ietf.org/html/rfc5988#section-5">RFC 5988</a> schema for link headers.
							<li>If an object:<code>{</code><ul>
								<li><code>href</code> required string, the URL which the link targets.
								<li>Any number of additional attributes are allowed.
							</ul><code>}</code>
						</ul><code>]</code>
					</ul>
					<code>}</code>
				</div>

				<h3>Signal Event <small>"signal"</small></h3>
				<p>The event sent to streams on NOTIFY requests. The event data follows the <em>Broadcast Event Schema</em>.

				<h3>Example 1. <small>Sending a message over the relay</small></h3>
				<pre><code class="language-javascript">var host = local.agent('http://examplehost.com');
var stream = host.follow({ rel: 'gwr.io/relay', user: 'bob', app: 'exampleapp.com', sid: 5, nc: Date.now() });

stream.setRequestDefaults({ headers: { authorization: 'Bearer '+bobsToken } });
stream.subscribe().then(function(es) {
  es.on('signal', function(e) {
    console.log(e);
    /* {
      event: 'signal',
      data: {
        src: 'alice@examplerelayhost.com!exampleapp.com!5',
        dst: 'bob@examplerelayhost.com!exampleapp.com!5',
        msg: 'ping'
      }
    } */

    stream.notify({
      src: 'bob@examplerelayhost.com!exampleapp.com!5',
      dst: e.data.src,
      msg: 'pong'
    });
  });
});</code></pre>
			</div>
		</div>
	</body>
</html>

