<?php

namespace Exfriend\Luminati\Commands;

use Exfriend\Luminati\Models\IP;
use Illuminate\Console\Command;

class RefreshIps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'luminati:refresh-ips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get fresh IP range and store it in the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username = config( 'luminati.username' );
        $password = config( 'luminati.password' );

        $ch = curl_init( 'https://luminati.io/api/get_route_ips' );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'X-Hola-Auth: lum-customer-' . $username . '-key-' . $password, ] );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        $res = curl_exec( $ch );
        curl_close( $ch );

        IP::truncate();
        collect( explode( PHP_EOL, $res ) )->map( function ( $v )
        {
            IP::create( [ 'ip' => $v ] );
        } );

        $this->info( 'Refreshed IPs: ' . IP::count() );
    }

}
