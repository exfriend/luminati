<?php

namespace Exfriend\Luminati\Models;

use Exfriend\Luminati\Proxy;
use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table = 'luminati_ips';
    protected $guarded = [];

    public function toProxy()
    {
        return new Proxy( $this->ip );
    }
}