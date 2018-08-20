<?php

namespace App\Inspections;

use Exception;

class KeyHeldDown
{
    protected $keywords = [
        'yahoo customer support'
    ];

    public function detect($body)
    {
        if(preg_match('/(.)\\1{4,}/', $body)) {
            throw new Exception('Your reply contains spam.');
        }
    }
}