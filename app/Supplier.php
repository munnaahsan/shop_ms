<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['s_name', 's_contact', 's_email', 's_email', 's_remarks', 'slug'];
}
