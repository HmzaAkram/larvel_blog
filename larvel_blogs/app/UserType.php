<?php

namespace App;

enum UserType: string
{
    case SuperAdmin = 'superadmin';
    case Admin = 'admin';
    case User = 'user';
}
