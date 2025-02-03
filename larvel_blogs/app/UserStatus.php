<?php

namespace App;

enum UserStatus: string
{
    case Pending = 'Pending';
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Rejected = 'Rejected';
}
