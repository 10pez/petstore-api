<?php

namespace App\Enums;

enum PetStatuses: string
{
    case Available = 'available';
    case Pending = 'pending';
    case Sold = 'sold';
}
