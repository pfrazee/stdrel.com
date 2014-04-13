<?
require('inc/index.php');
use com\stdrel as host;
host\links\setheader('reltypes');
?>

<!doctype html>
<html>
  <head>
    <title>stdrel - Web Reltypes Library for the Open Web</title>
    <?= partials\styles() ?>
    <?= partials\syntaxhighlighter() ?>
    <?= partials\bootstrapjs() ?>
  </head>

  <body>
    <div id="footer-wrapper-helper">
      <?= host\partials\header('reltypes') ?>
      <?= host\partials\reltypes_nav('reltypes') ?>

      <div id="reltypes" class="stdpage">
        <div class="content">
          <?/*<h2>Web Types System</h2>
          <p>To construct the page, Web browsers require multiple interactions with services. This often includes downloading images, stylesheets, and scripts. The requests can be triggered with tags like <code>&lt;script&gt;</code>, but, in the case of stylesheets, it is driven by a typed link:</p>
          <pre><code class="language-markup">&lt;link rel="stylesheet" href="bootstrap.css"&gt;</code></pre>
          <p>In addition to being a trigger for browser behavior, the <code>stylesheet</code> rel tells clients, "this URL serves CSS." It is a contract for behaviors on both sides of the transaction, and it's one of a <a href="http://www.iana.org/assignments/link-relations/link-relations.xhtml#link-relations-1">standard registry</a> which includes:</p>
          <pre><code class="language-markup">&lt;link rel="icon" href="favicon.png" type="image/png"&gt;
&lt;link rel="next" href="/article?page=2" title="Reltypes Are Awesome! (page 2)"&gt;
&lt;link rel="prefetch" href="/img/bob.jpg"&gt;</code></pre>
          <p>These <code>rel</code> attributes are called "reltypes." By adopting the browser's model of exchanging and searching through reltyped links, Web applications can achieve portability across services &ndash; a key requirement for the <a href="http://httplocal.com">HTTPLocal architecture</a>.</p>
          <p><strong>Features of reltypes</strong>:</p>
          <ul>
            <li>They can be listed in groups to combine their behaviors.</li>
            <li>Developers can publish custom reltype specs, then use the published URL as the reltype name.</li>
            <li>Links are just key-value bags with <code>href</code>, <code>rel</code>, and any additional attributes set by the reltypes used. They're used most often in HTML <code>&lt;link&gt;</code> elements, but they also work in <code>Link</code> response headers and <a href="http://stateless.co/hal_specification.html">JSON-HAL</a> documents.</li>
          </ul>*/?>
          <p><a href="/">Stdrel.com</a> is a library of link labels (known as "reltypes") to use in APIs. It includes common, reusable Web patterns for use in JSON-HAL, HTML, and other hypermedia formats.</p>
          <p>Stdrel was created to help with the <a href="http://httplocal.com">Local.js</a> library, which relies on these protocols to connect programs together.</p>
          <br>
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">How are the reltypes used?</h3></div>
            <div class="panel-body">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#formats" data-toggle="tab">Link Formats</a></li>
                <li><a href="#templates" data-toggle="tab">URI Templates</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="formats">
                  <p>Reltypes can be used in any link, but they are often used in HTML <code>&lt;link&gt;</code> elements, <a href="http://stateless.co/hal_specification.html">JSON-HAL</a>, and in the <a href="http://tools.ietf.org/html/rfc5988">Link response header</a>. Here's a link to a user record that, using <code>GET</code>, <code>PUT</code>, and <code>DELETE</code>, can be fetched, updated, and deleted:</p>
                  <strong><small>HTML</small></strong><br>
                  <pre><code class="language-markup">&lt;link rel="schema.org/Person stdrel.com/crud-item" href="/users/bob" id="bob"&gt;</code></pre>
                  <strong><small>JSON-HAL</small></strong><br>
                  <pre><code class="language-javascript">{"_links": {"schema.org/Person stdrel.com/crud-item": {"href": "/users/bob", "id": "bob"} } }</code></pre>
                  <strong><small>Link header</small></strong><br>
                  <pre><code class="language-markup">Link: &lt;/users/bob&gt;; rel="schema.org/Person stdrel.com/crud-item"; id="bob"</code></pre>
                  <p>We know the schema of <code>/users/bob</code> because of <a href="http://schema.org/Person">schema.org/Person</a>, and we know the supported methods because of <a href="/crud-item">stdrel.com/crud-item</a>.</p>
                  <p>Links like these will arrive in some list (depending on the delivery format). To use them, parse the links, then scan them sequentially, checking against their attributes for the endpoint you need. In this example, to find Bob's record, you'd scan for the rel of Person and crud-item, and the id of bob.
                </div>
                <div class="tab-pane" id="templates">
                  <p><a href="http://tools.ietf.org/html/rfc6570">URI Templates</a> offer a way to parameterize the URIs in links, reducing the number of links needed overall. Some examples:</p>
                  <pre>http://example.com/~{username}/
http://example.com/dictionary/{term:1}/{term}
http://example.com/search{?q,lang}</pre>
                  <p>At present, there is no definitive standard for using URI Tempaltes in links. In <a href="http://stateless.co/hal_specification.html">JSON-HAL</a>, links with URI Templates include a <code>templated: true</code> attribute. In <a href="http://httplocal.com">Local.js</a>, all links are expected to use templates, and so are parsed and "expanded" into regular URIs before use.</p>
                  <p>The semantics of URI Template tokens are determined by the reltype's definition. Template tokens may stand in for attributes in the link's KV pairs, meaning the following are functionally equivalent:</p>
                  <pre><code class="language-markup">&lt;link rel="schema.org/Person stdrel.com/crud-item" href="/users/bob" id="bob"&gt;
&lt;link rel="schema.org/Person stdrel.com/crud-item" href="/users/{id}"&gt;</code></pre>
                </div>
              </div>
            </div>
          </div>
          <br><br>
        </div>
      </div>
      <div id="footer-wrapper-push"></div>
    </div>
    <?= host\partials\footer() ?>
  </body>
</html>