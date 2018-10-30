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
        $this->info('GelbFramework Platform');
      }else{
        $this->error('GelbFramework Platform');
      }
    }

    public function generateGelbInfo(){
      $this->info('GelbFramework Platform');
      $this->info('This command will install GelbFramework Blueprint for Laravel.');
      $this->line('If you accept install this GelbFramework Blueprint, the follow files will be deleted and replaced for Gelb files.');

      $headers = ['Files', 'Address'];
      $files = ['teste' => 'teste'];

      $this->table($headers, $users);
    }
}
