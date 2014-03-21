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
    <?= partials\bootstrapjs() ?>
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
              <li><code>error</code> <strong>string</strong> A toplevel error message (eg "Body is required").</li>
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
          <br>
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

var myCollection = [];
var app = express();
app.use(express.json());
app.all('/', function(req, res, next) {
    // Set headers
    res.set('Link',
      '&lt;/&gt;; rel="self collection stdrel.com/crud-coll"; title="My Collection", '+
      '&lt;/{id}&gt;; rel="item stdrel.com/crud-item"'
    );
    next();
});
app.head('/', function(req, res) {
    // Respond with headers only
    res.send(204);
});
app.post('/', function(req, res) {
    // Validate
    if (!req.is('json')) {
        return res.send(415);
    }
    if (!req.body || typeof req.body != 'object') {
        return res.send(422, { error: 'Body is required.' });
    }
    var errors = {};
    if (!req.body.title) { errors.title = 'Required.'; }
    if (!req.body.desc) { errors.desc = 'Required.'; }
    if (Object.keys(errors).length > 0) {
        return res.send(422, { errors: errors });
    }

    // Add to collection
    var id = myCollection.length;
    myCollection.push({
        id: id,
        title: req.body.title,
        desc: req.body.desc
    });

    // Respond success
    res.location('/'+id);
    res.send(201);
});
app.listen(3000);</code></pre>
                </div>
                <div class="tab-pane" id="local">
                  <p>Written with <a href="http://httplocal.com">Local.js</a></p>
                  <pre><code class="language-javascript">importScripts('/local.js');

var myCollection = [];
function main(req, res) {
    // Set headers
    res.header('Link', [
        { href: '/', rel: 'self collection stdrel.com/crud-coll', title: 'My Collection' },
        { href: '/{id}', rel: 'item stdrel.com/crud-item' }
    ]);

    if (req.method == 'HEAD') {
        // Respond with headers only
        res.writeHead(204, 'OK, no content').end();
        return;
    }

    if (req.method == 'POST') {
        // Validate
        if (req.header('Content-Type') != 'application/json') {
            return res.writeHead(415, 'Unsupported Media Type').end();
        }
        if (!req.body || typeof req.body != 'object') {
            res.writeHead(422, 'Bad Entity', {'Content-Type': 'application/json'});
            res.end({ error: 'Body is required.' });
            return;
        }
        var errors = {};
        if (!req.body.title) { errors.title = 'Required.'; }
        if (!req.body.desc) { errors.desc = 'Required.'; }
        if (Object.keys(errors).length > 0) {
            res.writeHead(422, 'Bad Entity', {'Content-Type': 'application/json'});
            res.end({ errors: errors });
            return;
        }

        // Add to collection
        var id = myCollection.length;
        myCollection.push({
            id: id,
            title: req.body.title,
            desc: req.body.desc
        });

        // Respond success
        return res.writeHead(201, 'Created', {'Location': '/'+id}).end();
    }

    // Invalid method
    res.writeHead(405, 'Bad Method').end();
}</code></pre>
                </div>
                <div class="tab-pane" id="servware">
                  <p>Written with <a href="https://github.com/pfraze/servware">Servware</a>, full definition</p>
                  <pre><code class="language-javascript">importScripts('/local.js');
importScripts('/servware.js');

var myCollection = [];
var main = servware();
main.route('/')
    .link({ href: '/', rel: 'self collection stdrel.com/crud-coll', title: 'My Collection' })
    .link({ href: '/{id}', rel: 'item stdrel.com/crud-item' })
    .method('POST', function(req, res) {
        // Validate
        req.assert({ type: 'application/json' });
        if (!req.body || typeof req.body != 'object') {
            throw [422, { error: 'Body is required.' }];
        }
        var errors = {};
        if (!req.body.title) { errors.title = 'Required.'; }
        if (!req.body.desc) { errors.desc = 'Required.'; }
        if (Object.keys(errors).length > 0) {
            throw [422, { errors: errors }];
        }

        // Add to collection
        var id = myCollection.length;
        myCollection.push({
            id: id,
            title: req.body.title,
            desc: req.body.desc
        });

        // Respond success
        res.header('Location', '/'+id);
        return 201;
    });</code></pre>
                  <p>Using protocols</p>
                  <pre><code class="language-javascript">importScripts('/local.js');
importScripts('/servware.js');

var myCollection = [];
var main = servware();
main.route('/')
    .link({ href: '/', rel: 'self', title: 'My Collection' })
    .link({ href: '/{id}', rel: 'item' })
    .protocol('stdrel.com/crud-coll', {
        validate: function(values, req, res) {
            var errors = {};
            if (!values.title) errors.title = 'Required.';
            if (!values.desc) errors.desc = 'Required.';
            return errors;
        },
        add: function(values, req, res) {
          var addedItem = {
              id: myCollection.length,
              title: values.title,
              desc: values.desc,
          };
          myCollection.push(addedItem);
          return addedItem;
      }
    });</code></pre>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="footer-wrapper-push"></div>
    </div>
    <?= host\partials\footer() ?>
  </body>
</html>