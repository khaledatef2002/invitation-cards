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
        $response = Http::withBasicAuth('admin', 'Kh159753At@')
            ->post('https://inv-cards.com:8443/enterprise/control/agent.php', [
                'packet' => '<packet version="1.6.3">
                            <domains>
                                <add>
                                <name>inv-cards.com</name>
                                <hosting>
                                    <vrt_hst>
                                    <domain>
                                        <name>example.com</name>
                                    </domain>
                                    </vrt_hst>
                                </hosting>
                                </add>
                            </domains>
                            </packet>'
            ]);

        echo $response->body();
    }
}
