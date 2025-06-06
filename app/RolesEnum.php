<?php

namespace App;

enum RolesEnum:string
{
    case Administrator = 'Admin';
    case User = 'User';
    case Vendor = 'Vendor';
}
