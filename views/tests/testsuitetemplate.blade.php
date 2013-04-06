<?php $requirejs_bundle_exists = Bundle::exists('requirejs'); ?>
<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        @if( $requirejs_bundle_exists )
        {{ Requirejs::require_script_config() }} 
        @endif
        @yield('assets')
        <script type="text/javascript">            
            @if( $requirejs_bundle_exists )
            require([<?php echo Section::yield('module_suites') ?>], function(){
            @endif
                (function() {
                    var jasmineEnv = jasmine.getEnv();
                    jasmineEnv.updateInterval = 1000;

                    var htmlReporter = new jasmine.HtmlReporter();

                    jasmineEnv.addReporter(htmlReporter);

                    jasmineEnv.specFilter = function(spec) {
                        return htmlReporter.specFilter(spec);
                    };

                    @if( !$requirejs_bundle_exists )
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
                    @else
                    jasmineEnv.execute();    
                    @endif
                })();
            @if( $requirejs_bundle_exists )
            });
            @endif
        </script>
    </head>
    <body>
    </body>
</html>
