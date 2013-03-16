<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
            
        <link rel="shortcut icon" type="image/png" href="jasmine/lib/jasmine-1.3.1/jasmine_favicon.png">
        <link rel="stylesheet" type="text/css" href="jasmine/lib/jasmine-1.3.1/jasmine.css">
        
        @yield('assets')
        <script type="text/javascript">
    (function() {
      var jasmineEnv = jasmine.getEnv();
      jasmineEnv.updateInterval = 1000;

      var htmlReporter = new jasmine.HtmlReporter();

      jasmineEnv.addReporter(htmlReporter);

      jasmineEnv.specFilter = function(spec) {
        return htmlReporter.specFilter(spec);
      };

      var currentWindowOnload = window.onload;

      window.onload = function() {
        if (currentWindowOnload) {
          currentWindowOnload();
        }
        execJasmine();
      };

      function execJasmine() {
        jasmineEnv.execute();
      }

    })();
  </script>
    </head>
    <body>
    </body>
</html>
