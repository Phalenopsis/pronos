<?php

namespace App\Service;

class ColorGenerator
{
    public function generate(): string
    {
        //rgba(255, 0, 255)
        return 'rgba(' . rand(0, 255) . ' ,' . rand(0, 255) . ', ' . rand(0, 255) . ')';
    }
}