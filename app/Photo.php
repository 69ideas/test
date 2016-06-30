<?php

namespace App;

use App\Traits\ImageCast;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use ImageCast;
}
