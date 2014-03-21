<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('transformer');
?>

<!doctype html>
<html>
  <head>
    <title>/transformer - Stream Transformer</title>
    <?= partials\styles() ?>
    <?= partials\syntaxhighlighter() ?>
    <?= partials\bootstrapjs() ?>
  </head>

  <body>
    <div id="footer-wrapper-helper">
      <?= host\partials\header('transformer') ?>
      <?= host\partials\reltypes_nav('transformer') ?>

      <div id="reltype" class="stdpage">
        <div class="content">
          <h2>stdrel.com/transformer <small>Stream Transformer</small></h2>
          <p>A resource for applying transformations for streams of text. Similar in nature to Unix's STDIO interface.</p>
          <p><b class="glyphicon glyphicon-flag text-danger"></b> Resources which export this type <strong>MUST</strong>:</p>
          <ul>
            <li>Support the <code>POST</code> method with Content-Type of <code>text/plain</code> and an Accept of <code>text/plain</code>.</li>
          </ul>
          <p><b class="glyphicon glyphicon-flag text-warning"></b> Resources which export this type <strong>SHOULD</strong>:</p>
          <ul>
            <li>Stream response chunks as soon as they are delivered by the request stream, when supported by the protocol (HTTPL).</li>
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
    res.set('Link', '&lt;/&gt;; rel="self stdrel.com/transformer"; title="To Uppercase"');
    res.set('Content-Type', 'text/plain');
    next();
});
app.head('/', function(req, res) {
    // Respond with headers only
    res.send(204);
});
app.post('/', function(req, res){
    // Apply transformation
    var buffer = '';
    req.on('data', function(chunk) {
        buffer += chunk.toString('utf8').toUpperCase();
    });
    req.on('end',  function() {
        res.send(200, buffer);
    });
});
app.listen(3000);</code></pre>
                </div>
                <div class="tab-pane" id="local">
                  <p>Written with <a href="http://httplocal.com">Local.js</a></p>
                  <pre><code class="language-javascript">importScripts('/local.js');

function main(req, res) {
    // Set headers
    res.header('Link', [{ href: '/', rel: 'self stdrel.com/transformer', title: 'To Uppercase' }]);
    res.header('Content-Type', 'text/plain');

    if (req.method == 'HEAD') {
        // Respond with headers only
        res.writeHead(204, 'OK, no content').end();
        return;
    }

    if (req.method == 'POST') {
        // Apply transformation
        res.writeHead(200, 'OK'); // because HTTPL is full-duplex, we can respond while the request is streaming
        req.on('data', function(chunk) { res.write(chunk.toUpperCase()); });
        req.on('end',  function()      { res.end(); });
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
    .link({ href: '/', rel: 'self stdrel.com/transformer', title: 'To Uppercase' })
    .method('POST', {stream: true}, function(req, res) {
        req.assert({ type: 'text/plain', accept: 'text/plain' });
        res.writeHead(200, 'OK', {'Content-Type': 'text/plain'});
        req.on('data', function(chunk) { res.write(cfg.transform(chunk)); });
        req.on('end',  function()      { res.end(); });
    });</code></pre>
                  <p>Using protocols</p>
                  <pre><code class="language-javascript">importScripts('/local.js');
importScripts('/servware.js');

var main = servware();
main.route('/')
    .link({ href: '/', rel: 'self', title: 'To Uppercase' })
    .protocol('stdrel.com/transformer', {
        transform: function(chunk) { return chunk.toUpperCase(); }
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