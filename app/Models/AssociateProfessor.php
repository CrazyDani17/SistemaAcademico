<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class AssociateProfessor extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'associate_professors';
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

    /*

    public function academic_semester()
    {
        return $this->belongsTo(AcademicSemester::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class_typology()
    {
        return $this->belongsTo(ClassTypology::class);
    }*/

    public function associate_subject()
    {
        return $this->belongsTo(AssociateSubject::class);
    }

    public function academic_course()
    {
        return $this->belongsTo(AcademicCourse::class);
    }

    public function professors()
    {
        return $this->belongsToMany(Professor::class);
    }

    public function getNameAttribute($value) {
        return  $this->academic_course->name . " - " . $this->associate_subject->subject->name   . " - " . $this->associate_subject->academic_semester->name . " - " . $this->associate_subject->academic_year->name . " - " . $this->associate_subject->curriculum->name ;
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
