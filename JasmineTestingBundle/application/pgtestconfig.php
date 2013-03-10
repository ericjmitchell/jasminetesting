<?php
 $pgconfig = array(
   // All tests will be reachable from the application from this base route.
   "testRoute" => "jasmine",
   // Script Assets that should be included in all test files. For things like jQuery, or other libraries.
   "commonAssets" => array( 
   ),
   "testRunners" => array(
     // routeName => config array
     "models" => array( // Run this group at baseUrl/testRoute/models
       "scripts" => array(
         // Like commonAssets, but only for this test runner
           "jasmine/src/Player.js",
           "jasmine/src/Song.js"
       ),
       "suites" => array(
          // Path to each jasmine suite to include
          "jasmine/spec/SpecHelper.js",
           "jasmine/spec/PlayerSpec.js"
       )
     )
   )
 )
?>
