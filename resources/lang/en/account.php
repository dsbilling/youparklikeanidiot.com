<?php

return [

    'title' => 'Account',

    'password' => array(
        'change' => array(
            'title' => 'Change Password',
            'uri' => 'account/changepassword',
            'alert' => array(
                'notmatching' => 'Your current password does not matches with the password you provided. Please try again.',
                'samepassword' => 'New Password cannot be same as your current password. Please choose a different password.',
                'saved' => 'Password was saved!',
            ),
        ),
    ),

    'profile' => array(
        'change' => array(
            'title' => 'Edit your profile',
            'uri' => 'account/editprofile',
            'alert' => array(
                'notmatching' => 'Your current password does not matches with the password you provided. Please try again.',
                'saved' => 'Profile was saved!',
            ),
            'confirmpassword' => 'Confirm changes with your password',
            'anon' => 'Anonymize my profile <small class="text-muted">(hides username and name)</small>',
        ),
        'hidden' => 'Hidden profile',
    ),

];
