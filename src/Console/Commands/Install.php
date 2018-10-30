<?php

namespace Aidias\GelbBase\Console\Commands;

use Illuminate\Console\Command;

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
      $this->line('Installing dependencies...');

      $codeKeyGenerate = Artisan::call('key:generate');
      $this->info($codeKeyGenerate);

      // $codeKeyGenerate = Artisan::call('key:generate');
      // $this->info($codeKeyGenerate);

      // $exitCode = Artisan::call('email:send', [
      //   'user' => 1, '--queue' => 'default'
      // ]);
    }
}
