<?php

namespace model;

use components\AppModel;

class User extends AppModel
{
    public static $rules = array(
        'name' => 'required',
        'pass' => 'required',
    );

    public static $table = 'user';
}
