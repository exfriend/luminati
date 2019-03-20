<?php

namespace Exfriend\Luminati\Models;


class Proxy
{
    public $host;
    public $ip;
    public $port;
    public $username;
    public $password;

    public function __construct( $ip )
    {
        $this->ip = $ip;
        $this->host = 'zproxy.lum-superproxy.io';
        $this->port = 22225;
        $this->username = config( 'luminati.username' ) . '-ip-' . $this->ip;
        $this->password = config( 'luminati.password' );

        return $this;
    }

}