<?php

use Laravel\CLI\Command as Command;
use Laravel\Bundle as Bundle;

class JasmineTestingBundle_CreateTestRoutes_Task
{
    public function run($arguments)
    {
        $pgconfig = 0;
        require Bundle::path('jasminetestingbundle').'pgtestconfig.php';
        $path = Bundle::path('jasminetestingbundle').'routes.php';
        
        $data = '<?php';
        $data .= '
Route::get(\'/'.$pgconfig["testRoute"].'\', array(\'as\' => \'testRoute\', function() {
    
    ';
        foreach ($pgconfig["commonAssets"] as $item)
        {
            $data .= 'Asset::add(\''.$item.'\', \''.$item.'\');
    ';
        }
            
        $data .= 'return View::make(\'jasminetestingbundle::tests.testhome\')->with(\'runners\', array(';
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
            $data .= 'Asset::container(\'foo\')->bundle(\'jasminetestingbundle\');';
            $data .= 'Asset::container(\'foo\')->add(\'jasmine.css\', \'css/jasmine.css\');
    ';
            $data .= 'Asset::container(\'foo\')->add(\'jasmine.js\', \'js/jasmine.js\');
    ';
            $data .= 'Asset::container(\'foo\')->add(\'jasmine-html.js\', \'js/jasmine-html.js\');
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

    return View::make(\'jasminetestingbundle::tests.testsuite\');
});
';
        }
        
        $data .= '?>';
        
        File::put($path, $data);
        echo 'routes.php updated!';
    }
}
?>
