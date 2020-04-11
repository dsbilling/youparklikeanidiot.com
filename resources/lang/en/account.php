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

];
