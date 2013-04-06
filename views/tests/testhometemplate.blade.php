<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Jasmine Test Suites Runner</title>
        
        {{ HTML::style(Bundle::assets("jasminetesting")."css/testhome.css") }}
    </head>
    <body>
        <div id="banner">
            <span id="title">Jasmine Testing Suites</span>
        </div>
        @yield('runners')
    </body>
</html>
