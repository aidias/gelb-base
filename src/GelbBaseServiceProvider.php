<?php

namespace Aidias\GelbBase;

use Illuminate\Support\ServiceProvider;
use Aidias\GelbBase\Console\Commands\Install as InstallCommand;

class GelbBaseServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadCommands();
	}

	public function register()
	{

	}


	public function loadCommands()
	{
		if ($this->app->runningInConsole()) {
			$this->commands([
				InstallCommand::class
			]);
		}
	}
}
