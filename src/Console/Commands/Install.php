<?php

namespace Aidias\GelbBase\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
use File;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gelb:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install GelbBase Platform';

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
    public function handle()
    {
      $this->generateGelbInfo();

      if ($this->confirm('Do you wish to continue?')) {

        $this->installDependencies();

      }else{
        $this->error('GelbFramework Platform were not installed.');
        $this->line('If you wish to install it, type: php artisan gelb:install');
      }
    }

    public function generateGelbInfo(){
      $this->line('');
      $this->comment('GelbFramework Platform');
      $this->info('This command will install GelbFramework Blueprint for Laravel.');
      $this->line('If you accept install this GelbFramework Blueprint, the follow files will be deleted and replaced for Gelb files.');

      $this->table(
        ['File', 'Address', 'Details'],
        [
          ['file' => '.env', 'address' => './', 'details' => 'Generate a new key'],
          ['file' => 'ExampleComponent.vue', 'address' => './resources/js/components', 'details' => 'Delete file and components folder'],
          ['file' => 'app.js', 'address' => './resources/js', 'details' => 'Change file dependencies'],
          ['file' => 'bootstrap.js', 'address' => './resources/js', 'details' => 'Change file dependencies'],
          ['file' => '_variables.scss', 'address' => './resources/sass', 'details' => 'Change file code'],
          ['file' => 'app.scss', 'address' => './resources/sass', 'details' => 'Change file code'],
          ['file' => 'email.blade.php', 'address' => './resources/views/auth/passwords', 'details' => 'Change file code: adapt to visual design'],
          ['file' => 'reset.blade.php', 'address' => './resources/views/auth/passwords', 'details' => 'Change file code: adapt to visual design'],
          ['file' => 'login.blade.php', 'address' => './resources/views/auth', 'details' => 'Change file code: adapt to visual design'],
          ['file' => 'register.blade.php', 'address' => './resources/views/auth', 'details' => 'Change file code: adapt to visual design'],
          ['file' => 'verify.blade.php', 'address' => './resources/views/auth', 'details' => 'Change file code: adapt to visual design'],
          ['file' => 'app.blade.php', 'address' => './resources/views/layouts', 'details' => 'Change file code: adapt to visual design'],
          ['file' => 'home.blade.php', 'address' => './resources/views', 'details' => 'Change file code: adapt to visual design'],
          ['file' => 'welcome.blade.php', 'address' => './resources/views', 'details' => 'Delete file'],
        ]
      );
    }

    public function installDependencies(){
      $this->line('Gelb is generating a new key.');
      Artisan::call('key:generate');
      $this->info('Key has been generated: '.env('APP_KEY'));

      $this->line('');
      $this->line('Gelb is generating Laravel auth classes.');
      Artisan::call('make:auth', ['--force' => true]);
      $this->info('Laravel Auth is set.');

      $this->line('');
      $this->line('Gelb is deleting old version of auth blade templates.');
      $this->deleteFiles('resources/js/componentes/ExampleComponent.vue');
      $this->deleteFiles('resources/js/app.js');
      $this->deleteFiles('resources/js/bootstrap.js');
      $this->deleteFiles('resources/sass/_variables.scss');
      $this->deleteFiles('resources/sass/app.scss');
      $this->deleteFiles('resources/views/auth/passwords/email.blade.php');
      $this->deleteFiles('resources/views/auth/passwords/reset.blade.php');
      $this->deleteFiles('resources/views/auth/login.blade.php');
      $this->deleteFiles('resources/views/auth/register.blade.php');
      $this->deleteFiles('resources/views/auth/verify.blade.php');
      $this->deleteFiles('resources/views/layouts/app.blade.php');
      $this->deleteFiles('resources/views/home.blade.php');
      $this->deleteFiles('resources/views/welcome.blade.php');
      $this->info('Old files deleted.');


    }

    private function deleteFiles($file_path){
      if(File::exists(base_path($file_path))) File::delete(base_path($file_path));
    }
}
