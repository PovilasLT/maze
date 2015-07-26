<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

if (file_exists($compiledPath = __DIR__.'/cache/compiled.php'))
{
	require $compiledPath;
}
elseif (file_exists($compiledPath = __DIR__.'/cache/compiled.php'))
{
	require $compiledPath;
}


// $modules_dir = '../app/Modules';
// $modules_list = scandir($modules_dir);
// $modules = [];

// foreach ($modules_list as $module)
// {
// 	$loader = $modules_dir.'/'.$module.'/load.php';
// 	if(!str_contains('..', $module) && file_exists($loader))
// 	{
// 		require_once($loader);
// 		$modules[strtolower($module)] = call_user_func('module_'.strtolower($module));
// 	}
// }