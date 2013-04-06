<?php

use Laravel\CLI\Command as Command;
use Laravel\Bundle as Bundle;

class JasmineTesting_CreateTestRoutes_Task
{
    public function run($arguments)
    {
        $pgconfig = 0;
        require Bundle::path('jasminetesting').'config\config.php';
        $path = Bundle::path('jasminetesting').'routes.php';
        
        $data = "<?php";
        $data .= "\nRoute::get('/{$pgconfig["testRoute"]}', array('as' => 'testRoute', function() {\n\n\t";
            
        $data .= "return View::make('jasminetesting::tests.testhome')->with('runners', array(";
        foreach ($pgconfig["testRunners"] as $name => $value)
        {
            $data .= "'$name',"; 
        }
        $data .= "));\n}));\n\n";
        
        foreach ($pgconfig["testRunners"] as $key => $value)
        {
            $data .= "Route::get('/{$pgconfig["testRoute"]}/$key', function()\n{\n\t";
            $data .= "Asset::container('foo')->bundle('jasminetesting');";
            $data .= "Asset::container('foo')->add('jasmine.css', 'css/jasmine.css');\n\t";
            $data .= "Asset::container('foo')->add('jasmine.js', 'js/jasmine.js');\n\t";
            $data .= "Asset::container('foo')->add('jasmine-html.js', 'js/jasmine-html.js');\n\t";
            foreach ($pgconfig["commonAssets"] as $item)
            {
                $data .= "Asset::add('$item', '$item');\n\t";
            }
            foreach ($value["scripts"] as $item)
            {
                $data .= "Asset::add('$item', '$item');\n\t";
            }
            foreach ($value["suites"] as $item)
            {
                $data .= "Asset::add('$item', '$item');\n\t";
            }
            if( Bundle::exists('requirejs') && array_key_exists('module_suites', $value) ) 
            {
                $dependencies = array_map(function($module){return "'$module'";}, $value['module_suites']);
                $data .= "Section::inject('module_suites', \"".implode(',', $dependencies)."\");\n\t";
            }
            $data .= "Section::inject('title', '$key Tests');\n\n\treturn View::make('jasminetesting::tests.testsuite');\n});\n";
        }
        
        $data .= "?>";
        
        File::put($path, $data);
        echo "routes.php updated!";
    }
}
?>
