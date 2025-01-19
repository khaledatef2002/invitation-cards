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
        ->post('https://funny-sinoussi.104-248-37-88.plesk.page:443/api/v2/domains', [
            'name' => 'example.com',
            'primaryDomain' => 'inv-cards.com', // Primary domain to which the alias will be linked
            'hosting_type' => 'alias',
            'hosting_settings' => [
            'vrt_hst' => [
                    'domain' => [
                        'name' => 'inv-cards.com'  // Linking the alias to the main domain
                    ]
                ]
            ]
        ]);
    
        if ($response->successful()) {
            echo 'Alias domain created successfully!';
        } else {
            echo 'Error: ' . $response->status() . ' - ' . $response->body();
        }
        }
}
