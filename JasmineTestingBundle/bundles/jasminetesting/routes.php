<?php
Route::get('/jasmine', array('as' => 'testRoute', function() {
    
    return View::make('jasminetesting::tests.testhome')->with('runners', array('models',));
}));

Route::get('/jasmine/models', function()
{
    Asset::add(Bundle::path('jasminetesting').'jasmine/lib/jasmine-1.3.1/jasmine.css', 'jasmine/lib/jasmine-1.3.1/jasmine.css');
    Asset::add(Bundle::path('jasminetesting').'jasmine/lib/jasmine-1.3.1/jasmine.js', 'jasmine/lib/jasmine-1.3.1/jasmine.js');
    Asset::add(Bundle::path('jasminetesting').'jasmine/lib/jasmine-1.3.1/jasmine-html.js', 'jasmine/lib/jasmine-1.3.1/jasmine-html.js');
    Asset::add('jasmine/src/Player.js', 'jasmine/src/Player.js');
    Asset::add('jasmine/src/Song.js', 'jasmine/src/Song.js');
    Asset::add('jasmine/spec/SpecHelper.js', 'jasmine/spec/SpecHelper.js');
    Asset::add('jasmine/spec/PlayerSpec.js', 'jasmine/spec/PlayerSpec.js');
    Section::inject('title', 'models Tests');

    return View::make('jasminetesting::tests.testsuite');
});
?>