<?php

namespace App\Inspections;

class Spam
{
    protected $inspections = [
        KeyHeldDown::class,
        InvalidKeywords::class
    ];

    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }
}
