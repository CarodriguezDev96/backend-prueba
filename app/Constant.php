<?php

namespace App;

class Constant
{
    public const PASSWORD_SECURITY_CUSTOMER = [
        'required',
        'string',
        'min:6',
        'regex:/[a-z]/',
        'regex:/[A-Z]/',
        'regex:/[0-9]/'
    ];

}
