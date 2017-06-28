<?php

namespace cambiomidinero\Model;

use Illuminate\Database\Eloquent\Model;

class ErrorSistema extends Model
{
    protected $table = 'errorsistema';
    protected $primaryKey = 'errorsistema_id';
    public $timestamps = false;
}
