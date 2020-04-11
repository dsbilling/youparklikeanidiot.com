<?php

return [

    'title' => 'Konto',

    'password' => array(
        'change' => array(
            'title' => 'Bytt passord',
            'uri' => 'konto/byttpassord',
            'alert' => array(
                'notmatching' => 'Ditt nåværende passord samsvarer ikke med passordet du oppga. Vær så snill, prøv på nytt.',
                'samepassword' => 'Nytt passord kan ikke være det samme som ditt nåværende passord. Velg et annet passord.',
                'saved' => 'Passordet ble lagret!',
            ),
        ),
    ),

];
