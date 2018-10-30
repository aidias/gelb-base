<?php

namespace Aidias\GelbBase\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

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
        ['File', 'Address'],
        [
          ['file'=>'arquivo1.php', 'address'=>'./app/app/app']
        ]
      );
    }

    public function installDependencies(){
      $this->line('Gelb is generating a new key.');
      Artisan::call('key:generate');
      $this->info('Key has been generated: '.env('APP_KEY'));

      $this->line('')->line('Gelb is generating Laravel auth classes.');
      Artisan::call('make:auth');
      $this->info('Laravel Auth is set.');

      // $codeKeyGenerate = Artisan::call('key:generate');
      // $this->info($codeKeyGenerate);

      // $exitCode = Artisan::call('email:send', [
      //   'user' => 1, '--queue' => 'default'
      // ]);
    }
}
