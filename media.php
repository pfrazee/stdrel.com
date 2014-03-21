<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('media');
?>

<!doctype html>
<html>
  <head>
    <title>/media - Media</title>
    <?= partials\styles() ?>
    <?= partials\syntaxhighlighter() ?>
    <?= partials\bootstrapjs() ?>
  </head>

  <body>
    <div id="footer-wrapper-helper">
      <?= host\partials\header('media') ?>
      <?= host\partials\reltypes_nav('media') ?>

      <div id="reltype" class="stdpage">
        <div class="content">
          <h2>stdrel.com/media <small>Media</small></h2>
          <p>The resource is an image, video, audio, or text document.</p>
          <p><b class="glyphicon glyphicon-flag text-danger"></b> Links which export this type <strong>MUST</strong>:</p>
          <ul>
            <li>Include a `type` attribute labeling the mimetype of the content.</li>
          </ul>
          <p><b class="glyphicon glyphicon-flag text-danger"></b> Resources which export this type <strong>MUST</strong>:</p>
          <ul>
            <li>Support the <code>GET</code> method with Accept of the type given by the link <code>type</code>, responding with the media document.</li>
          </ul>
          <p>If the resource supports multiple types, it's recommended to use multiple links which each label the supported type.</p>
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
    res.set('Link', '&lt;/&gt;; rel="self stdrel.com/media"; type="text/html"; title="Hello, World"');
    res.set('Content-Type', 'text/html');
    next();
});
app.head('/', function(req, res) {
    // Respond with headers only
    res.send(204);
});
app.get('/', function(req, res){
    // Respond with HTML
    res.html('&lt;h1&gt;Hello World&lt;/h1&gt;')
});
app.listen(3000);</code></pre>
                </div>
                <div class="tab-pane" id="local">
                  <p>Written with <a href="http://httplocal.com">Local.js</a></p>
                  <pre><code class="language-javascript">importScripts('/local.js');

function main(req, res) {
    // Set headers
    res.header('Link', [{ href: '/', rel: 'self stdrel.com/media', type: 'text/html', title: 'Hello, World' }]);
    res.header('Content-Type', 'text/html');

    if (req.method == 'HEAD') {
        // Respond with headers only
        res.writeHead(204, 'OK, no content').end();
        return;
    }

    if (req.method == 'GET') {
        // Respond with HTML
        res.writeHead(200, 'OK').end('&lt;h1&gt;Hello World&lt;/h1&gt;');
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
    .link({ href: '/', rel: 'self stdrel.com/media', type: 'text/html', title: 'Hello, World' })
    .method('GET', function(req) {
        req.assert({ accept: 'text/html' });
        return [200, '&lt;h1&gt;Hello World&lt;/h1&gt;', {'Content-Type': 'text/html'}];
    });</code></pre>
                  <p>Using protocols</p>
                  <pre><code class="language-javascript">importScripts('/local.js');
importScripts('/servware.js');

var main = servware();
main.route('/')
    .link({ href: '/', rel: 'self', title: 'Hello, World' })
    .protocol('stdrel.com/media', {
        type: 'text/html',
        content: '&lt;h1&gt;Hello World&lt;/h1&gt;'
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