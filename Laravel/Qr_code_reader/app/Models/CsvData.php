<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{
    use HasFactory;
    protected $fillable = [
        'FIRSTNAME',
        'LASTNAME',
        'SSN',
        'TEST1',
        'TEST2',
        'TEST3',
        'TEST4',
        'TEST5',
        'TEST6',
        'TEST7',
        'FINAL',
        'GRADE',
        'user_id',
    ];
    // public static function boot(){
    //     parent::boot();
    //     static::created(function($csvData){
    //         $user = $csvData->user;
    //         $user->increment('rows_count');
    //     });
    // }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
