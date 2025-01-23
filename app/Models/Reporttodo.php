<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporttodo extends Model
{
    use HasFactory;

    protected $table = 'report_todo';

    protected $primaryKey = 'reporttodo_uuid';

    protected $keyType = 'string';

    protected $fillable = [
        'reporttodo_uuid',
        'uuid',
        'reporttodo_title',
        'reporttodo_description',
        'reporttodo_status'
    ];
}
