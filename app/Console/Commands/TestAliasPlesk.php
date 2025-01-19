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
            'HTTP_AUTH_LOGIN' => 'admin', // Username
            'HTTP_AUTH_PASSWD' => 'Kh159753At@' // Password
        ])
        ->post('https://funny-sinoussi.104-248-37-88.plesk.page:443/enterprise/control/agent.php', [
            'packet' => '<?xml version="1.0" encoding="UTF-8"?>
                    <packet>
                        <site-alias>
                            <create>
                                <site-id>1</site-id>
                                <name>myalias.com</name>
                            </create>
                        </site-alias>
                    </packet>'
        ]);
    
        echo $response->body();
    }
}
