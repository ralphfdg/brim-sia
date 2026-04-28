<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.9.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.9.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">
<a href="{{ url('/') }}" style="position: fixed; top: 20px; right: 25px; z-index: 9999; background-color: #059669; color: #ffffff; padding: 10px 18px; border-radius: 8px; font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.2s ease;">
    &larr; Back to B.R.I.M.
</a>

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-webhooks-stripe">
                                <a href="#endpoints-POSTapi-webhooks-stripe">POST api/webhooks/stripe</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-weather">
                                <a href="#endpoints-GETapi-weather">Fetch live weather data for East Calaguiman from an External API</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-resident-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="resident-management">
                    <a href="#resident-management">Resident Management</a>
                </li>
                                    <ul id="tocify-subheader-resident-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="resident-management-GETapi-residents">
                                <a href="#resident-management-GETapi-residents">List all residents</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="resident-management-GETapi-residents--id-">
                                <a href="#resident-management-GETapi-residents--id-">Get a specific resident</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="resident-management-POSTapi-residents">
                                <a href="#resident-management-POSTapi-residents">Register a new resident</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="resident-management-PATCHapi-residents--id-">
                                <a href="#resident-management-PATCHapi-residents--id-">Update a resident</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="resident-management-DELETEapi-residents--id-">
                                <a href="#resident-management-DELETEapi-residents--id-">Delete a resident</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: April 26, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer Paste your Bearer Token here..."</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your API token from the Barangay Administrator.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-webhooks-stripe">POST api/webhooks/stripe</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-webhooks-stripe">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/webhooks/stripe" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/webhooks/stripe"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-webhooks-stripe">
</span>
<span id="execution-results-POSTapi-webhooks-stripe" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-webhooks-stripe"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-webhooks-stripe"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-webhooks-stripe" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-webhooks-stripe">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-webhooks-stripe" data-method="POST"
      data-path="api/webhooks/stripe"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-webhooks-stripe', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-webhooks-stripe"
                    onclick="tryItOut('POSTapi-webhooks-stripe');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-webhooks-stripe"
                    onclick="cancelTryOut('POSTapi-webhooks-stripe');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-webhooks-stripe"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/webhooks/stripe</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-webhooks-stripe"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-webhooks-stripe"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-webhooks-stripe"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: &quot;019dc503-8ba8-7386-96e4-55db5a62fee5&quot;,
    &quot;name&quot;: &quot;Juan Dela Cruz&quot;,
    &quot;email&quot;: &quot;deguzman.ralphethan@student.auf.edu.ph&quot;,
    &quot;email_verified_at&quot;: null,
    &quot;created_at&quot;: &quot;2026-04-25T14:20:37.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2026-04-25T14:20:37.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-weather">Fetch live weather data for East Calaguiman from an External API</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-weather">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/weather" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/weather"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-weather">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IjZsNU1xTUJKbWE2REROZVNMbnZaaWc9PSIsInZhbHVlIjoiUC8vM3pEWnNMc1NMMDd1ZEZzWG9nTnU1TG1EWFY3aEY0U3Zjc1g4eVJyRHl2NSt0MFMzYU9RRDRIcHduRUZ6dkUybCtaKzlSeEg1RVNSZEg3RlAzYzNwc0lBRVNYL1pCSDRyRkJrc0pkbkZOQjYwR1lzV25HZWZDc284ZG84SGUiLCJtYWMiOiIyMjg3MzUyNzY3MjUzOTMyZmYzYjA2MmQwMzZkODlkZDQ4MjVhMTkwMzUzN2MwYjQ0MDgwZTEzOWY2ODdiMDQ0IiwidGFnIjoiIn0%3D; expires=Mon, 27 Apr 2026 00:32:56 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IlFZdzZqeTJPRVVEZEF3enNURlMzRUE9PSIsInZhbHVlIjoiZS9JWFdVZkluTmg1VUx4RTZpWVIzeXJFSHo3bmczYmhyd2tWYTdSSjdqeWU0YkVrWUgxYW9TSkdxeDkyNWl0TlBySm84UTJ1aHlocE1sYnlSclltRDQrQWJTZDE2TVcxKzVKVVZwRHpqaS9reDBCekxvcHFQdytmcDQ1VU0yRmQiLCJtYWMiOiJlZDFmODI4ZjQ0M2NlMzdiOTE3YzA1NDNkNWQwOWRmOTE4OWM1MDg2ZDkwOGVlYjA0MDhmYWFhNjcwMjAzYzllIiwidGFnIjoiIn0%3D; expires=Mon, 27 Apr 2026 00:32:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Weather data fetched successfully from Open-Meteo.&quot;,
    &quot;location&quot;: &quot;East Calaguiman, Bataan&quot;,
    &quot;temperature&quot;: &quot;26&deg;C&quot;,
    &quot;windspeed&quot;: &quot;6.2 km/h&quot;,
    &quot;is_day&quot;: &quot;Yes&quot;,
    &quot;raw_data&quot;: {
        &quot;time&quot;: &quot;2026-04-27T06:30&quot;,
        &quot;interval&quot;: 900,
        &quot;temperature&quot;: 26,
        &quot;windspeed&quot;: 6.2,
        &quot;winddirection&quot;: 334,
        &quot;is_day&quot;: 1,
        &quot;weathercode&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-weather" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-weather"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-weather"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-weather" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-weather">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-weather" data-method="GET"
      data-path="api/weather"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-weather', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-weather"
                    onclick="tryItOut('GETapi-weather');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-weather"
                    onclick="cancelTryOut('GETapi-weather');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-weather"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/weather</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-weather"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-weather"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-weather"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="resident-management">Resident Management</h1>

    <p>APIs for managing the barangay resident database.</p>

                                <h2 id="resident-management-GETapi-residents">List all residents</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns a paginated list of all residents in the barangay.</p>
<ul>
<li>@authenticated</li>
</ul>

<span id="example-requests-GETapi-residents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/residents" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/residents"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-residents">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Residents retrieved successfully.&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: &quot;019dc54c-aa04-704a-bcd2-49b05b982a07&quot;,
                &quot;first_name&quot;: &quot;test&quot;,
                &quot;middle_name&quot;: &quot;t&quot;,
                &quot;last_name&quot;: &quot;test1&quot;,
                &quot;suffix&quot;: null,
                &quot;date_of_birth&quot;: &quot;2019-01-29&quot;,
                &quot;gender&quot;: &quot;Male&quot;,
                &quot;civil_status&quot;: &quot;Single&quot;,
                &quot;purok_or_street&quot;: &quot;FPH 11&quot;,
                &quot;contact_number&quot;: &quot;09288736929&quot;,
                &quot;is_registered_voter&quot;: 0,
                &quot;occupation&quot;: &quot;Worker&quot;,
                &quot;residency_status&quot;: &quot;Active&quot;
            },
            {
                &quot;id&quot;: &quot;019dc6ab-5cc6-7019-b124-e0ae3c50b7a9&quot;,
                &quot;first_name&quot;: &quot;Maria&quot;,
                &quot;middle_name&quot;: null,
                &quot;last_name&quot;: &quot;Dela Cruz&quot;,
                &quot;suffix&quot;: null,
                &quot;date_of_birth&quot;: &quot;1985-10-16&quot;,
                &quot;gender&quot;: &quot;Female&quot;,
                &quot;civil_status&quot;: &quot;Single&quot;,
                &quot;purok_or_street&quot;: &quot;FPH 1 brgy2&quot;,
                &quot;contact_number&quot;: &quot;09288736929&quot;,
                &quot;is_registered_voter&quot;: 0,
                &quot;occupation&quot;: &quot;Housewife&quot;,
                &quot;residency_status&quot;: &quot;Active&quot;
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost:8000/api/residents?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost:8000/api/residents?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/residents?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost:8000/api/residents&quot;,
        &quot;per_page&quot;: 15,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 2,
        &quot;total&quot;: 2
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-residents" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-residents"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-residents"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-residents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-residents">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-residents" data-method="GET"
      data-path="api/residents"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-residents', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-residents"
                    onclick="tryItOut('GETapi-residents');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-residents"
                    onclick="cancelTryOut('GETapi-residents');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-residents"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/residents</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-residents"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-residents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-residents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="resident-management-GETapi-residents--id-">Get a specific resident</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves the complete profile of a single resident using their UUID.</p>
<ul>
<li>@authenticated</li>
</ul>

<span id="example-requests-GETapi-residents--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/residents/019dc54c-aa04-704a-bcd2-49b05b982a07" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/residents/019dc54c-aa04-704a-bcd2-49b05b982a07"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-residents--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Resident details retrieved.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: &quot;019dc54c-aa04-704a-bcd2-49b05b982a07&quot;,
        &quot;first_name&quot;: &quot;test&quot;,
        &quot;middle_name&quot;: &quot;t&quot;,
        &quot;last_name&quot;: &quot;test1&quot;,
        &quot;suffix&quot;: null,
        &quot;date_of_birth&quot;: &quot;2019-01-29&quot;,
        &quot;gender&quot;: &quot;Male&quot;,
        &quot;civil_status&quot;: &quot;Single&quot;,
        &quot;purok_or_street&quot;: &quot;FPH 11&quot;,
        &quot;contact_number&quot;: &quot;09288736929&quot;,
        &quot;is_registered_voter&quot;: 0,
        &quot;occupation&quot;: &quot;Worker&quot;,
        &quot;residency_status&quot;: &quot;Active&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-residents--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-residents--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-residents--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-residents--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-residents--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-residents--id-" data-method="GET"
      data-path="api/residents/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-residents--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-residents--id-"
                    onclick="tryItOut('GETapi-residents--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-residents--id-"
                    onclick="cancelTryOut('GETapi-residents--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-residents--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/residents/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-residents--id-"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-residents--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-residents--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-residents--id-"
               value="019dc54c-aa04-704a-bcd2-49b05b982a07"
               data-component="url">
    <br>
<p>The UUID of the resident. Example: <code>019dc54c-aa04-704a-bcd2-49b05b982a07</code></p>
            </div>
                    </form>

                    <h2 id="resident-management-POSTapi-residents">Register a new resident</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Creates a new resident record in the database.</p>

<span id="example-requests-POSTapi-residents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/residents" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"Juan\",
    \"middle_name\": \"amniihfqcoynlazghdtqt\",
    \"last_name\": \"Dela Cruz\",
    \"suffix\": \"auydlsmsjuryvojcybzvr\",
    \"date_of_birth\": \"1990-05-15\",
    \"gender\": \"Male\",
    \"civil_status\": \"Single\",
    \"purok_or_street\": \"Purok 1\",
    \"contact_number\": \"vazjrcnfbaqywuxhgjjmz\",
    \"is_registered_voter\": false,
    \"occupation\": \"uxjubqouzswiwxtrkimfc\",
    \"residency_status\": \"Active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/residents"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "Juan",
    "middle_name": "amniihfqcoynlazghdtqt",
    "last_name": "Dela Cruz",
    "suffix": "auydlsmsjuryvojcybzvr",
    "date_of_birth": "1990-05-15",
    "gender": "Male",
    "civil_status": "Single",
    "purok_or_street": "Purok 1",
    "contact_number": "vazjrcnfbaqywuxhgjjmz",
    "is_registered_voter": false,
    "occupation": "uxjubqouzswiwxtrkimfc",
    "residency_status": "Active"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-residents">
</span>
<span id="execution-results-POSTapi-residents" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-residents"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-residents"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-residents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-residents">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-residents" data-method="POST"
      data-path="api/residents"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-residents', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-residents"
                    onclick="tryItOut('POSTapi-residents');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-residents"
                    onclick="cancelTryOut('POSTapi-residents');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-residents"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/residents</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-residents"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-residents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-residents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-residents"
               value="Juan"
               data-component="body">
    <br>
<p>The first name of the resident. Example: <code>Juan</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>middle_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="middle_name"                data-endpoint="POSTapi-residents"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-residents"
               value="Dela Cruz"
               data-component="body">
    <br>
<p>The last name. Example: <code>Dela Cruz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>suffix</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="suffix"                data-endpoint="POSTapi-residents"
               value="auydlsmsjuryvojcybzvr"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>auydlsmsjuryvojcybzvr</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_of_birth</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_of_birth"                data-endpoint="POSTapi-residents"
               value="1990-05-15"
               data-component="body">
    <br>
<p>Format: YYYY-MM-DD. Example: <code>1990-05-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-residents"
               value="Male"
               data-component="body">
    <br>
<p>Must be Male, Female, or Other. Example: <code>Male</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>civil_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="civil_status"                data-endpoint="POSTapi-residents"
               value="Single"
               data-component="body">
    <br>
<p>Single, Married, Widowed, or Legally Separated. Example: <code>Single</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>purok_or_street</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="purok_or_street"                data-endpoint="POSTapi-residents"
               value="Purok 1"
               data-component="body">
    <br>
<p>Street address. Example: <code>Purok 1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>contact_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contact_number"                data-endpoint="POSTapi-residents"
               value="vazjrcnfbaqywuxhgjjmz"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vazjrcnfbaqywuxhgjjmz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_registered_voter</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-residents" style="display: none">
            <input type="radio" name="is_registered_voter"
                   value="true"
                   data-endpoint="POSTapi-residents"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-residents" style="display: none">
            <input type="radio" name="is_registered_voter"
                   value="false"
                   data-endpoint="POSTapi-residents"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>occupation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="occupation"                data-endpoint="POSTapi-residents"
               value="uxjubqouzswiwxtrkimfc"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>uxjubqouzswiwxtrkimfc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>residency_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="residency_status"                data-endpoint="POSTapi-residents"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Moved</code></li> <li><code>Deceased</code></li></ul>
        </div>
        </form>

                    <h2 id="resident-management-PATCHapi-residents--id-">Update a resident</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Partially update an existing resident's information. You only need to send the fields you wish to change.</p>

<span id="example-requests-PATCHapi-residents--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost:8000/api/residents/consequatur" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"vmqeopfuudtdsufvyvddq\",
    \"middle_name\": \"amniihfqcoynlazghdtqt\",
    \"last_name\": \"qxbajwbpilpmufinllwlo\",
    \"suffix\": \"auydlsmsjuryvojcybzvr\",
    \"date_of_birth\": \"2026-04-26T22:32:55\",
    \"gender\": \"Female\",
    \"civil_status\": \"Married\",
    \"purok_or_street\": \"byickznkygloigmkwxphl\",
    \"contact_number\": \"09123456789\",
    \"is_registered_voter\": true,
    \"occupation\": \"uxjubqouzswiwxtrkimfc\",
    \"residency_status\": \"Active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/residents/consequatur"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "vmqeopfuudtdsufvyvddq",
    "middle_name": "amniihfqcoynlazghdtqt",
    "last_name": "qxbajwbpilpmufinllwlo",
    "suffix": "auydlsmsjuryvojcybzvr",
    "date_of_birth": "2026-04-26T22:32:55",
    "gender": "Female",
    "civil_status": "Married",
    "purok_or_street": "byickznkygloigmkwxphl",
    "contact_number": "09123456789",
    "is_registered_voter": true,
    "occupation": "uxjubqouzswiwxtrkimfc",
    "residency_status": "Active"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-residents--id-">
</span>
<span id="execution-results-PATCHapi-residents--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-residents--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-residents--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-residents--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-residents--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-residents--id-" data-method="PATCH"
      data-path="api/residents/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-residents--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-residents--id-"
                    onclick="tryItOut('PATCHapi-residents--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-residents--id-"
                    onclick="cancelTryOut('PATCHapi-residents--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-residents--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/residents/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-residents--id-"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-residents--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-residents--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PATCHapi-residents--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The UUID of the resident. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PATCHapi-residents--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>middle_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="middle_name"                data-endpoint="PATCHapi-residents--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="PATCHapi-residents--id-"
               value="qxbajwbpilpmufinllwlo"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>qxbajwbpilpmufinllwlo</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>suffix</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="suffix"                data-endpoint="PATCHapi-residents--id-"
               value="auydlsmsjuryvojcybzvr"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>auydlsmsjuryvojcybzvr</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_of_birth</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_of_birth"                data-endpoint="PATCHapi-residents--id-"
               value="2026-04-26T22:32:55"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-04-26T22:32:55</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="PATCHapi-residents--id-"
               value="Female"
               data-component="body">
    <br>
<p>Example: <code>Female</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Male</code></li> <li><code>Female</code></li> <li><code>Other</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>civil_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="civil_status"                data-endpoint="PATCHapi-residents--id-"
               value="Married"
               data-component="body">
    <br>
<p>Example: <code>Married</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Single</code></li> <li><code>Married</code></li> <li><code>Widowed</code></li> <li><code>Legally Separated</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>purok_or_street</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="purok_or_street"                data-endpoint="PATCHapi-residents--id-"
               value="byickznkygloigmkwxphl"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>byickznkygloigmkwxphl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>contact_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contact_number"                data-endpoint="PATCHapi-residents--id-"
               value="09123456789"
               data-component="body">
    <br>
<p>The new contact number. Example: <code>09123456789</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_registered_voter</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PATCHapi-residents--id-" style="display: none">
            <input type="radio" name="is_registered_voter"
                   value="true"
                   data-endpoint="PATCHapi-residents--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PATCHapi-residents--id-" style="display: none">
            <input type="radio" name="is_registered_voter"
                   value="false"
                   data-endpoint="PATCHapi-residents--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>occupation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="occupation"                data-endpoint="PATCHapi-residents--id-"
               value="uxjubqouzswiwxtrkimfc"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>uxjubqouzswiwxtrkimfc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>residency_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="residency_status"                data-endpoint="PATCHapi-residents--id-"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Moved</code></li> <li><code>Deceased</code></li></ul>
        </div>
        </form>

                    <h2 id="resident-management-DELETEapi-residents--id-">Delete a resident</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Permanently removes a resident from the database.</p>

<span id="example-requests-DELETEapi-residents--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/residents/consequatur" \
    --header "Authorization: Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/residents/consequatur"
);

const headers = {
    "Authorization": "Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-residents--id-">
</span>
<span id="execution-results-DELETEapi-residents--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-residents--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-residents--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-residents--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-residents--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-residents--id-" data-method="DELETE"
      data-path="api/residents/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-residents--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-residents--id-"
                    onclick="tryItOut('DELETEapi-residents--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-residents--id-"
                    onclick="cancelTryOut('DELETEapi-residents--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-residents--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/residents/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-residents--id-"
               value="Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08"
               data-component="header">
    <br>
<p>Example: <code>Bearer 2|QPLZULRCAJn0AawU3fxv438vm9EjYeUribd335l44cbbca08</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-residents--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-residents--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-residents--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The UUID of the resident. Example: <code>consequatur</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
