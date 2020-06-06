<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="James Cole">
    <title>Firefly III Telemetry</title>
    <base href="{{ route('index') }}" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- TODO Favicons -->

    <!-- Custom styles for this template -->
    <link href="css/footer.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Firefly III Telemetry endpoint</h1>
        <p class="lead">Welcome.</p>
        <p>
            This is a static page for people curious enough to want to find out more about the Firefly III telemetry. This is an opt-in feature of Firefly III
            only enabled <a href="https://en.wikipedia.org/wiki/If_and_only_if">IFF</a> the user configures it to be so.
        </p>
        <ul>
            <li><a href="https://www.firefly-iii.org/">The Firefly III website</a></li>
            <li><a href="https://github.com/firefly-iii/firefly-iii">The Firefly III source code</a></li>
            <li>
                <a href="https://docs.firefly-iii.org/">The Firefly III documentation</a>
                <ul>
                    <li><a href="https://docs.firefly-iii.org/support/telemetry">The pages about telemetry</a></li>
                </ul>
            </li>
            <li><a href="http://github.com/firefly-iii/telemetry">The Firefly III telemetry endpoint source code</a></li>
        </ul>
    </div>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">&copy; <a href="mailto:james@firefly-iii.org">James Cole</a>. <small>Licensed under the <a href="https://www.gnu.org/licenses/agpl-3.0.html">AGPL3.0 or later</a>.</small></span>
    </div>
</footer>



<!-- Matomo -->
<script type="text/javascript">
    var _paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//analytics.firefly-iii.org/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', '6']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->
</body>
</html>
