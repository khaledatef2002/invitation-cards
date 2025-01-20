<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestAliasPlesk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-alias-plesk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Run Certbot command using exec or Process
        $command = "sudo certbot --apache -d inv-cards.com -d www.inv-cards.com";

        // Execute the command
        $output = shell_exec($command);
        $this->info($output);
        
        $output = shell_exec("sudo systemctl restart apache2");


        // Print the output to the console
        $this->info($output);
    }
}
