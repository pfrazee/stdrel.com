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
    <?= partials\bootstrapjs() ?>
  </head>

  <body>
    <div id="footer-wrapper-helper">
      <?= host\partials\header('rel') ?>
      <?= host\partials\reltypes_nav('rel') ?>

      <div id="reltype" class="stdpage">
        <div class="content">
          <h2>stdrel.com/rel <small>Relation Type</small></h2>
          <p>The resource is a relation type.</p>
          <p><b class="glyphicon glyphicon-flag text-danger"></b> Resources which export this type <strong>SHOULD</strong>:</p>
          <ul>
            <li>Support the <code>GET</code> method with Accept of <code>text/plain</code> and/or <code>text/html</code>, responding with documentation for the reltype's semantics and behaviors.</li>
          </ul>
          <br><br>
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Reference implementation</h3></div>
            <div class="panel-body">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#express" data-toggle="tab">Node + Express</a></li>
                <li><a href="#local" data-toggle="tab">Local</a></li>
                <li><a href="#servware" data-toggle="tab">Local + Servware</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="express">
                  <p>Written with <a href="http://nodejs.org/">Node.js</a> and <a href="http://expressjs.com/">Express</a></p>
                  <pre><code class="language-javascript">var express = require('express');

var app = express();
app.all('/', function(req, res, next) {
    // Set headers
    res.set('Link', '&lt;/&gt;; rel="self stdrel.com/rel"; title="My Reltype"');
    res.set('Content-Type', 'text/html');
    next();
});
app.head('/', function(req, res) {
    // Respond with headers only
    res.send(204);
});
app.get('/', function(req, res){
    // Respond with HTML
    res.html('&lt;h1&gt;My Reltype Spec&lt;/h1&gt;');
});
app.listen(3000);</code></pre>
                </div>
                <div class="tab-pane" id="local">
                  <p>Written with <a href="http://httplocal.com">Local.js</a></p>
                  <pre><code class="language-javascript">importScripts('/local.js');

function main(req, res) {
    // Set headers
    res.header('Link', [{ href: '/', rel: 'self stdrel.com/rel', title: 'My Reltype' }]);
    res.header('Content-Type', 'text/html');

    if (req.method == 'HEAD') {
        // Respond with headers only
        res.writeHead(204, 'OK, no content').end();
        return;
    }

    if (req.method == 'GET') {
        // Respond with HTML
        res.writeHead(200, 'OK').end('&lt;h1&gt;My Reltype Spec&lt;/h1&gt;')
        return;
    }

    // Invalid method
    res.writeHead(405, 'Bad Method').end();
}</code></pre>
                </div>
                <div class="tab-pane" id="servware">
                  <p>Written with <a href="https://github.com/pfraze/servware">Servware</a>, full definition</p>
                  <pre><code class="language-javascript">importScripts('/local.js');
importScripts('/servware.js');

var main = servware();
main.route('/')
    .link({ href: '/', rel: 'self stdrel.com/rel', title: 'My Reltype' })
    .method('GET', function(req) {
        req.assert({ accept: 'text/html' });
        return [200, '&lt;h1&gt;My Reltype Spec&lt;/h1&gt;', {'Content-Type': 'text/html'}];
    });</code></pre>
                  <p>Using protocols</p>
                  <pre><code class="language-javascript">importScripts('/local.js');
importScripts('/servware.js');

var main = servware();
main.route('/')
    .link({ href: '/', rel: 'self', title: 'My Reltype' })
    .protocol('stdrel.com/rel', {
        html: '&lt;h1&gt;My Reltype Spec&lt;/h1&gt;'
    });</code></pre>
            </div>
          </div>
        </div>
      </div>
      <div id="footer-wrapper-push"></div>
    </div>
    <?= host\partials\footer() ?>
  </body>
</html>