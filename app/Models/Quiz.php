<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Quiz extends Model
{
    protected $fillable = [
        'name','text','image_link','Quizdescription', // Add any other attributes you want to allow for mass assignment
        
    ];


    public function questions()
    {
        return $this->hasMany(Question::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
