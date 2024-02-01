<?php

namespace App\Service;

class TeamNameGenerator
{
    const FIRST_WORD = ['Les aigles', 'les loutres', 'les lions', 'les bidules', 'les trucs', 'les éléphants',
        'les chamois', 'les fourmis', 'les fous furieux', 'les marmots'];
    const SECOND_WORD = ['de Boulogne', 'noirs', 'bordelais', 'de Paris', 'parisiens', 'de Bordeaux', 'rouges',
        'verts', 'girondins', 'de Toulouse', 'creusois', 'de la Creuse', 'perdus'];

    public function generate(): string
    {
        return self::FIRST_WORD[array_rand(self::FIRST_WORD)] .
            ' ' .
            self::SECOND_WORD[array_rand(self::SECOND_WORD)];
    }
}