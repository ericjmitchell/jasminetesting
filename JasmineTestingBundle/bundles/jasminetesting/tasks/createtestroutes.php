<?php

use Laravel\CLI\Command as Command;
use Laravel\Bundle as Bundle;

class JasmineTesting_CreateTestRoutes_Task
{
    public function run($arguments)
    {
        $pgconfig = 0;
        require Bundle::path('jasminetesting').'pgtestconfig.php';
        $path = Bundle::path('jasminetesting').'routes.php';
        
        $data = '<?php';
        $data .= '
Route::get(\'/'.$pgconfig["testRoute"].'\', array(\'as\' => \'testRoute\', function() {
    
    ';
        foreach ($pgconfig["commonAssets"] as $item)
        {
            $data .= 'Asset::add(\''.$item.'\', \''.$item.'\');
    ';
        }
            
        $data .= 'return View::make(\'jasminetesting::tests.testhome\')->with(\'runners\', array(';
        foreach ($pgconfig["testRunners"] as $name => $value)
        {
            $data .= '\''.$name.'\','; 
        }
        $data .= '));
}));

';
        
        foreach ($pgconfig["testRunners"] as $key => $value)
        {
            $data .= 'Route::get(\'/'.$pgconfig["testRoute"].'/'.$key.'\', function()
{
    ';
            $data .= 'Asset::add(Bundle::path(\'jasminetesting\').\'jasmine/lib/jasmine-1.3.1/jasmine.css\', \'jasmine/lib/jasmine-1.3.1/jasmine.css\');
    ';
            $data .= 'Asset::add(Bundle::path(\'jasminetesting\').\'jasmine/lib/jasmine-1.3.1/jasmine.js\', \'jasmine/lib/jasmine-1.3.1/jasmine.js\');
    ';
            $data .= 'Asset::add(Bundle::path(\'jasminetesting\').\'jasmine/lib/jasmine-1.3.1/jasmine-html.js\', \'jasmine/lib/jasmine-1.3.1/jasmine-html.js\');
    ';
            foreach ($value["scripts"] as $item)
            {
                $data .= 'Asset::add(\'' . $item . '\', \'' . $item . '\');
    ';
            }
            foreach ($value["suites"] as $item)
            {
                $data .= 'Asset::add(\'' . $item . '\', \'' . $item . '\');
    ';
            }
            $data .= 'Section::inject(\'title\', \''.$key.' Tests\');

    return View::make(\'jasminetesting::tests.testsuite\');
});
';
        }
        
        $data .= '?>';
        
        File::put($path, $data);
        echo 'routes.php updated!';
    }
}
?>
