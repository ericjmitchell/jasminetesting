<?php
class CreateTestRoutes_Task
{
    public function run($arguments)
    {
        $pgconfig = 0;
        require path('app').'pgtestconfig.php';
        $path = path('app').'routes.php';
        
        $data = '
Route::get(\'/'.$pgconfig["testRoute"].'\', array(\'as\' => \'testRoute\', function() {
    
    ';
        foreach ($pgconfig["commonAssets"] as $item)
        {
            $data .= 'Asset::add(\''.$item.'\', \''.$item.'\');
    ';
        }
            
        $data .= 'return View::make(\'tests.testhome\')->with(\'runners\', array(';
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
            $data .= 'Asset::add(path(\'app\').\'jasmine/lib/jasmine-1.3.1/jasmine.css\', \'jasmine/lib/jasmine-1.3.1/jasmine.css\');
    ';
            $data .= 'Asset::add(path(\'app\').\'jasmine/lib/jasmine-1.3.1/jasmine.js\', \'jasmine/lib/jasmine-1.3.1/jasmine.js\');
    ';
            $data .= 'Asset::add(path(\'app\').\'jasmine/lib/jasmine-1.3.1/jasmine-html.js\', \'jasmine/lib/jasmine-1.3.1/jasmine-html.js\');
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

    return View::make(\'tests.testsuite\');
});
';
        }
        
        File::append($path, $data);
        echo 'routes.php updated!';
    }
}
?>
