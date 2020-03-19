<?php

namespace App\Inspections;


use Exception;

class InvalidKeywords {

    protected $keywords = [
        'yahoo customer support',
    ];


    public function detect($body)
    {
        foreach ($this->keywords as $keyword)
        {

            if (Stripos($body, $keyword) !== FALSE)
            {
                throw new Exception('Your reply contains spam.');
            }
        }
    }
}
