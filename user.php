<?
require('inc/index.php');
use io\gwr as host;
host\links\setheader('user');
?>

<!doctype html>
<html>
	<head>
		<title>gwr.io/user: User Account Item</title>
		<?= partials\styles() ?>
		<?= partials\syntaxhighlighter() ?>
	</head>

	<body>
		<?= host\partials\header('user') ?>

		<div id="reltype" class="twocolumnpage">
			<?= host\partials\sidebar('user') ?>
			<div class="content">
				<h1>gwr.io/user <small>User Account Item</small></h1>
				<p>A user account profile. Links to <a href="/grimwire">gwr.io/grimwire</a> and <a href="/users">gwr.io/users</a>.</p>

				<h3>Behaviors <small>rel="item gwr.io/user" id=</small></h3>
				<ul>
					<li>Links to 1 <code>rel="gwr.io/grimwire"</code> resource.
					<li>Links to 1 <code>rel="gwr.io/users"</code> resource.
					<li>Parameters:<ul>
						<li><code>id</code> the username of the account.
					</ul>
					<li>GET: provides <code>Content-Type=application/json</code> which conforms to the <em>User Item Schema</em>.<ul>
						<li>200: requested user data.
						<li>401: must authorize using Cookies or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
						<li>404: account does not exist.
					</ul>
					<li>PATCH: handles <code>Content-Type=application/json</code> which conforms to the <em>User Item Schema</em>.<ul>
						<li>204: user profile updated.
						<li>401: must authorize using Cookies or Bearer Auth provided by <a href="/session">gwr.io/session</a>.
						<li>403: must be the owner of the account to make updates.
						<li>404: account does not exist.
						<li>422: the request body did not conform to the <em>User Item Schema</em>.
					</ul>
				</ul>


				<h3>User Item Schema <small>{id:,online:,avatar:,created_at:}</small></h3>
				<p>In GET responses:</p>
				<div class="schema">
					<code>{</code>
					<ul>
						<li><code>id</code> required string, the account's username.
						<li><code>online</code> required boolean, does the user have any applications on the network?
						<li><code>avatar</code> required string, the user's avatar filename.
						<li><code>created_at</code> required date, when the user account was created.
					</ul>
					<code>}</code>
				</div>
				<p>In PATCH requests:</p>
				<div class="schema">
					<code>{</code>
					<ul>
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

