<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('users');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/users: User Accounts Collection</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<?= host\partials\header('users') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('users') ?>
			<div class="content">
				<h1>gwr.io/users <small>User Accounts Collection</small></h1>
				<p>A collection of user accounts. Links to <a href="/grimwire">gwr.io/grimwire</a> and <a href="/user">gwr.io/user</a>.</p>

				<h3>Behaviors <small>rel="gwr.io/users" online= link_bodies=</small></h3>
				<ul>
					<li>Links to 1 <code>rel="gwr.io/grimwire"</code> resource.
					<li>Links to 0 or more <code>rel="gwr.io/user"</code> resources.
					<li>Parameters:<ul>
						<li><code>online</code> if 1, filters to users that have links to active streams on the relay.
						<li><code>link_bodies</code> if 1, user records will include the `link` attribute.
					</ul>
					<li>GET: provides <code>Content-Type=application/json</code> which conforms to the <em>Users Collection Schema</em>.<ul>
						<li>200: requested user data.
						<li>401: must authorize using Cookie or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
					</ul>
					<li>POST: handles <code>Content-Type=application/json</code> which conforms to the <em>User Item Schema</em>.<ul>
						<li>204: user created.
						<li>401: must authorize using Cookie or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
						<li>405: the relay has disabled account creation.
						<li>409: username taken.
						<li>422: the request body did not conform to the <em>User Item Schema</em>.
					</ul>
				</ul>

				<h3>Users Collection Schema <small>{rows:[{id:,online:,avatar:,created_at:}]}</small></h3>
				<p>In GET responses:</p>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>rows</code> required Array(object). <code>{</code><ul>
							<li><code>id</code> required string, the account's username.
							<li><code>online</code> required boolean, does the user have any applications on the network?
							<li><code>links</code> optional array, the user's active links.
							<li><code>avatar</code> required string, the user's avatar filename.
							<li><code>created_at</code> required date, when the user account was created.
						</ul><code>}</code>
					</ul>
					<code>}</code>
				</div>

				<h3>User Item Schema <small>{id:,online:,avatar:,created_at:}</small></h3>
				<p>In POST requests:</p>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>id</code> required string, the account's username.
						<li><code>password</code> required string.
						<li><code>email</code> optional string, an email address for the account owner. (Only visible to admins through the userfiles.)
						<li><code>avatar</code> optional string, the user's avatar filename.
					</ul>
					<code>}</code>
				</div>

				<h3>Example 1. <small>Creating a user</small></h3>
				<pre><code class="language-javascript">var host = local.agent('http://examplehost.com');
var users = host.follow({ rel: 'gwr.io/users' });
var bob;

// Create 'bob' user
users.post({ id: 'bob', password: 'cheezes', email: 'bob@home.com', avatar: 'astronaut' })
  .then(function() {
    // Sign in as 'bob'
    return host
      .follow({ rel: 'gwr.io/session', type: 'user' })
      .post({ id: 'bob', password: 'cheezes' });
  })
  .then(function(res) {
    // Get 'bob'
    users.setRequestDefaults({ headers: { authorization: 'Bearer '+res.body.token } });
    bob = users.follow({ rel: 'gwr.io/user', id: 'bob' });
    return bob.get();
  })
  .then(function(res) {
    console.log(res.body);
    /* {
      id: 'bob',
      online: false,
      avatar: 'astronaut',
      created_at: XXX
    } */

    // Update 'bob'
    bob.patch({ avatar: 'cowboy' });
  });</code></pre>
			</div>
		</div>
	</body>
</html>

