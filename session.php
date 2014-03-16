<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('session');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/session: Session</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<?= host\partials\header('session') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('session') ?>
			<div class="content">
				<h1>gwr.io/session <small>Session</small></h1>
				<p>A service for creating sessions on the host and emitting session tokens. Distinguishes between <code>type=user</code> sessions, which
					require the the account password to authenticate, and <code>type=app</code> sessions, which require an existing <code>type=user</code>
					session to authenticate. It's recommended that <code>type=user</code> tokens are not allowed to leave the relay's domain.</p>
				<h3>User Sessions <small>rel="service gwr.io/session" type=user</small></h3>
				<ul>
					<li>Links to 0 or 1 <code>rel="service gwr.io/session" type=app</code> resource.
					<li>GET: provides a <code>Content-Type=application/json</code> which conforms to the <em>Session Schema</em>.<ul>
						<li>200: requested session data.
						<li>401: must include a valid session token in the Authorization or Cookie header.
					</ul>
					<li>POST: handles a <code>Content-Type=application/json</code> which conforms to the <em>Session Schema</em> and provides a <code>Content-Type=application/json</code> which conforms to the <em>Token Schema</em>.<ul>
						<li>200: session authorized, requsted token data.
						<li>422: invalid username or password.
					</ul>
					<li>DELETE: ends the session.<ul>
						<li>204: session was destroyed or did not exist.
					</ul>
				</ul>
				<h3>Application Sessions <small>rel="service gwr.io/session" type=app app=</small></h3>
				<ul>
					<li>Links to 0 or 1 <code>rel="service gwr.io/session" type=user</code> resource.
					<li>Parameters:<ul>
						<li><code>app</code> the domain of the application.
					</ul>
					<li>GET: provides a <code>Content-Type=text/html</code> interface for generating <code>type=app</code> sessions.<ul>
						<li>200: requested session interface.
						<li>401: must include a valid session token in the Authorization or Cookie header.
						<li>403: included session token must be of the 'user' type.
					</ul>
					<li>POST: rovides a <code>Content-Type=application/json</code> which conforms to the <em>Token Schema</em>.<ul>
						<li>200: session authorized, requsted token data.
						<li>401: must include a valid session token in the Authorization or Cookie header.
						<li>403: included session token must be of the 'user' type.
						<li>422: invalid username or password.
					</ul>
				</ul>
				<h3>Session Schema <small>{user_id:,avatar:}</small></h3>
				<p>In GET requests:</p>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>user_id</code> required string, the session's username.
						<li><code>avatar</code> optional string, the session's avatar filename.
					</ul>
					<code>}</code>
				</div>
				<p>In POST requests:</p>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>id</code> required string, the session's username.
						<li><code>password</code> required string.
					</ul>
					<code>}</code>
				</div>
				<h3>Token Schema <small>{token:}</small></h3>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>token</code> required string.
					</ul>
					<code>}</code>
				</div>

				<h3>Example 1. <small>Creating a session</small></h3>
				<pre><code class="language-javascript">var host = local.agent('http://examplehost.com');
var session = host.follow({ rel: 'gwr.io/session', type: 'user' });

session.post({ id: 'bob', password: 'cheezes' })
  .then(function(res) {
    users.setRequestDefaults({ headers: { authorization: 'Bearer '+res.body.token } });
    return session.get();
  })
  .then(function(res) {
    console.log(res.body);
    /* {
      user_id: 'bob',
      avatar: 'astronaut'
    } */
  });</code></pre>
			</div>
			</div>
		</div>
	</body>
</html>

