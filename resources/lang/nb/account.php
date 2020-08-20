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

    'profile' => array(
        'change' => array(
            'title' => 'Rediger profilen din',
            'uri' => 'konto/redigerprofil',
            'alert' => array(
                'notmatching' => 'Ditt nåværende passord samsvarer ikke med passordet du oppga. Vær så snill, prøv på nytt.',
                'saved' => 'Profilen ble lagret!',
            ),
            'confirmpassword' => 'Bekreft endringene med passordet ditt',
            'anon' => 'Anonymiser profilen min <small class="text-muted">(skjuler brukernavn og navn)</small>',
        ),
        'hidden' => 'Skjult profil',
    ),

    'members' => array(
        'title' => 'Medlemmer',
        'uri' => 'konto/medlemmer',
        'name' => 'Navn',
        'username' => 'Brukernavn',
        'submissions' => 'Innsendinger',
        'created_at' => 'Ble med',
    ),

];
