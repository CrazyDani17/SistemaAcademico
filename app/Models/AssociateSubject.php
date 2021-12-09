<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class AssociateSubject extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'associate_subjects';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
    
    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academic_semester()
    {
        return $this->belongsTo(AcademicSemester::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /*public function class_typology()
    {
        return $this->belongsTo(ClassTypology::class);
    }*/

    public function getNameAttribute($value) {
        //return $this->curriculum->name . " - " . $this->academic_year->name . " - " . $this->academic_semester->name . " - " . $this->subject->name;
        return $this->subject->name . " - " . $this->academic_semester->name . " - " . $this->academic_year->name . " - " .$this->curriculum->name;
    }

    public function class_typology_hour()
    {
        return $this->belongsToMany(ClassTypologyHour::class);
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
