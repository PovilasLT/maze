<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use maze\User;

class ConvertAvatarUploads extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'convert:avatars';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Konvertuoja avatarus iš maze 1 į maze 2.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$path = 'public/images/avatars/';
		$dirs = scandir($path);
		foreach($dirs as $dir)
		{
			if($dir != '.' && $dir != '..')
			{
				$user = User::where('username', $dir)->first();
				if($user)
				{
					rename($path.$dir, $path.$user->id);
				}
				else {
					$this->rrmdir($path.$dir);
				}
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		];
	}

	public function rrmdir($dir) { 
	   if (is_dir($dir)) { 
	     $objects = scandir($dir); 
	     foreach ($objects as $object) { 
	       if ($object != "." && $object != "..") { 
	         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
	       } 
	     } 
	     reset($objects); 
	     rmdir($dir); 
	   } 
	} 

}