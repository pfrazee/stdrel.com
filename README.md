# Web Types System

To construct the page, Web browsers require multiple interactions with services. This often includes downloading images, stylesheets, and scripts. The requests can be triggered with tags like `<script>`, but, in the case of stylesheets, it is driven by a typed link:

```html
<link rel="stylesheet" href="bootstrap.css">
```

In addition to being a trigger for browser behavior, the `stylesheet` rel tells clients, "this URL serves CSS." It is a contract for behaviors on both sides of the transaction, and it's one of a <a href="http://www.iana.org/assignments/link-relations/link-relations.xhtml#link-relations-1">standard registry</a> which includes:

```html
<link rel="icon" href="favicon.png" type="image/png">
<link rel="next" href="/article?page=2" title="Reltypes Are Awesome! (page 2)">
<link rel="prefetch" href="/img/bob.jpg">
```
These `rel` attributes are called "reltypes." By adopting the browser's model of exchanging and searching through reltyped links, Web applications can achieve portability across services &ndash; a key requirement for the <a href="http://httplocal.com">HTTPLocal architecture</a>.

**Features of reltypes**

 - They can be listed in groups to combine their behaviors.
 - Developers can publish custom reltype specs, then use the published URL as the reltype name.
 - Links are just key-value bags with `href`, `rel`, and any additional attributes set by the reltypes used. They're used most often in HTML `<link>` elements, but they also work in `Link` response headers and <a href="http://stateless.co/hal_specification.html">JSON-HAL</a> documents.


## What is stdrel?

<a href="http://stdrel.com">stdrel.com</a> is a library of common reltypes for developers to use in their APIs. It is currently in development, but will include detailed specs, examples, and libraries to get developers started. Pull requests are submitted and discussed at <a href="https://github.com/pfraze/stdrel.com">GitHub</a>.


### How are the reltypes used?

Reltypes can be used in any link, but they are often used in HTML <code>&lt;link&gt;</code> elements, <a href="http://stateless.co/hal_specification.html">JSON-HAL</a>, and in the <a href="http://tools.ietf.org/html/rfc5988">Link response header</a>. Here's a link to a user record that, using <code>GET</code>, <code>PUT</code>, and <code>DELETE</code>, can be fetched, updated, and deleted:</p>

**HTML**
```html
<link rel="schema.org/Person stdrel.com/crud-item" href="/users/bob" id="bob">
```

**JSON-HAL**
```javascript
{"_links": {"schema.org/Person stdrel.com/crud-item": {"href": "/users/bob", "id": "bob"} } }
```

**Link header**
```html
Link: </users/bob>; rel="schema.org/Person stdrel.com/crud-item"; id="bob"
```

We know the schema of `/users/bob` because of <a href="http://schema.org/Person">schema.org/Person</a>, and we know the supported methods because of <a href="http://stdrel.com/crud-item">stdrel.com/crud-item</a>. Local.js includes a <a href="http://httplocal.com/docs.html#docs/en/0.6.2/api/querylinks.md">queryLinks</a> method for searching lists of links, and a <a href="http://httplocal.com/docs.html#docs/en/0.6.2/api/agent.md">User Agent</a> which navigates by querying service Link headers.
