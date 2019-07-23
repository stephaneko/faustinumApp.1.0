<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apotre extends Model
{
     protected $fillable = [
    'apotre_name',
    'apotre_surname',
    'apotre_dateNais',
    'apotre_paroisse',
    'apotre_zone',
    'apotre_status'
  ];
}
