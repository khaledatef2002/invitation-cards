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
        $response = Http::withHeaders([
            'HTTP_AUTH_LOGIN' => 'admin',
            'HTTP_AUTH_PASSWD' => 'Kh159753At@'
        ])
        ->withBody('<?xml version="1.0" encoding="UTF-8"?>
            <packet version="1.6.7.0">
                <site-alias>
                    <delete>
                        <filter>
                            <name>khaled.inv-cards.com</name>
                        </filter>
                    </delete>
                </site-alias>
            </packet>', 'text/xml')
        ->post('https://funny-sinoussi.104-248-37-88.plesk.page:443/enterprise/control/agent.php');

        $response = simplexml_load_string($response->body());
        print_r($response);
        
    }
}
