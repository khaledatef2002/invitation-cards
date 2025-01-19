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
        $response = Http::withBasicAuth('admin', 'Kh159753At@') // Using Basic Authentication
        ->post('https://104.248.37.88/api/v2/domains', [
            'primaryDomain' => 'example.com', // Primary domain to which the alias will be linked
            'aliasDomain' => 'inv-cards.com' // The alias domain you want to create
        ]);
    
        if ($response->successful()) {
            echo 'Alias domain created successfully!';
        } else {
            echo 'Error: ' . $response->status() . ' - ' . $response->body();
        }
        }
}
