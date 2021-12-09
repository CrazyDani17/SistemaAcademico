<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Schedule;
use App\Models\Curriculum;
use App\Models\AcademicYear;
use App\Models\AcademicSemester;
use App\Models\AssociateProfessor;
use App\Models\ClassSession;
use App\Models\Subject;
use App\Models\Shift;
use App\Models\AcademicCourse;
use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\ScheduleExport;


/**
 * Class ClassTypologyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ScheduleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as scheduleStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Schedule::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/schedule');
        CRUD::setEntityNameStrings('horario', 'horarios');
    }

    public function store()
    {
        $request = $this->crud->getRequest();
        //$dni = $request->request->get("dni");
        $associate_professor =  $request->request->get("associate_professor");
        $asignatura_curso = AssociateProfessor::find($associate_professor);
        $semestre = $asignatura_curso->associate_subject->academic_semester->id;
        $shifts =  $request->request->get("shifts");
        $counter = 0;
        $class_session_shifts = [];
        $class_sessions = ClassSession::all();
        foreach($class_sessions as $class_session){
            $class_session_shifts = [];
            if ($class_session->academic_semesters()->where('academic_semester_id', $semestre)->exists()) {
                foreach($class_session->shifts as $shift){
                    $class_session_shifts[] = $shift->id; 
                }
                //dd($class_session_shifts);
                foreach($shifts as $shift){
                    if(!in_array($shift, $class_session_shifts)){
                        \Alert::add('warning', 'Los turnos seleccionados no van de acuerdo a la sesión de clases del semestre al que pertenece la asignatura.');
                        break 2;
                    }
                }
            }
        }
        $response = $this->scheduleStore();
        return $response;
    }

    protected function addCustomCrudFilters(){

        $this->crud->addFilter([
            'name'  => 'curricum',
            'type'  => 'select2',
            'label' => 'Malla',
        ], function () {
            $keys = [];
            $array = [];
            $collection = Curriculum::all();
            for($i = 0; $i<count($collection); $i++){
                array_push($keys, $collection[$i]->id);
            }
            for($i = 0; $i<count($collection); $i++){
                array_push($array, $collection[$i]->name);
            }
            $diccionario = array_combine($keys,$array);
            //dd($diccionario);
            //dd($banks = Bank::all()->keyBy('id')->pluck('name'));
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($banks);
            return $diccionario;
        }, function ($value) { // if the filter is active
            //$this->crud->addClause('where', 'employee_id', $value);
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($value);
            $this->crud->addClause('whereHas', 'associate_professor' , function($query) use($value) {
                //$bank_id = DB::table('banks')->where('name',$value)->value('id');
                //$query = AssociateProfessor::all();
                //$query = $query->where('associate_subject->currilum', '=', $value);
                //$query->where('currilum', '=', $value);
                return $query->whereHas('associate_subject', function ($associate_subject) use ($value) {
                    return $associate_subject->where('curriculum_id', '=', $value);
                });
            });
        });

        $this->crud->addFilter([
            'name'  => 'academic_year',
            'type'  => 'select2',
            'label' => 'Año Académico',
        ], function () {
            $keys = [];
            $array = [];
            $collection = AcademicYear::all();
            for($i = 0; $i<count($collection); $i++){
                array_push($keys, $collection[$i]->id);
            }
            for($i = 0; $i<count($collection); $i++){
                array_push($array, $collection[$i]->name);
            }
            $diccionario = array_combine($keys,$array);
            //dd($diccionario);
            //dd($banks = Bank::all()->keyBy('id')->pluck('name'));
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($banks);
            return $diccionario;
        }, function ($value) { // if the filter is active
            //$this->crud->addClause('where', 'employee_id', $value);
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($value);
            $this->crud->addClause('whereHas', 'associate_professor' , function($query) use($value) {
                //$bank_id = DB::table('banks')->where('name',$value)->value('id');
                //$query = AssociateProfessor::all();
                //$query = $query->where('associate_subject->currilum', '=', $value);
                //$query->where('currilum', '=', $value);
                return $query->whereHas('associate_subject', function ($associate_subject) use ($value) {
                    return $associate_subject->where('academic_year_id', '=', $value);
                });
            });
        });

        $this->crud->addFilter([
            'name'  => 'academic_semester',
            'type'  => 'select2',
            'label' => 'Semestre Académico',
        ], function () {
            $keys = [];
            $array = [];
            $collection = AcademicSemester::all();
            for($i = 0; $i<count($collection); $i++){
                array_push($keys, $collection[$i]->id);
            }
            for($i = 0; $i<count($collection); $i++){
                array_push($array, $collection[$i]->name);
            }
            $diccionario = array_combine($keys,$array);
            //dd($diccionario);
            //dd($banks = Bank::all()->keyBy('id')->pluck('name'));
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($banks);
            return $diccionario;
        }, function ($value) { // if the filter is active
            //$this->crud->addClause('where', 'employee_id', $value);
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($value);
            $this->crud->addClause('whereHas', 'associate_professor' , function($query) use($value) {
                //$bank_id = DB::table('banks')->where('name',$value)->value('id');
                //$query = AssociateProfessor::all();
                //$query = $query->where('associate_subject->currilum', '=', $value);
                //$query->where('currilum', '=', $value);
                return $query->whereHas('associate_subject', function ($associate_subject) use ($value) {
                    return $associate_subject->where('academic_semester_id', '=', $value);
                });
            });
        });

        $this->crud->addFilter([
            'name'  => 'subject',
            'type'  => 'select2',
            'label' => 'Asignatura',
        ], function () {
            $keys = [];
            $array = [];
            $collection = Subject::all();
            for($i = 0; $i<count($collection); $i++){
                array_push($keys, $collection[$i]->id);
            }
            for($i = 0; $i<count($collection); $i++){
                array_push($array, $collection[$i]->name);
            }
            $diccionario = array_combine($keys,$array);
            //dd($diccionario);
            //dd($banks = Bank::all()->keyBy('id')->pluck('name'));
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($banks);
            return $diccionario;
        }, function ($value) { // if the filter is active
            //$this->crud->addClause('where', 'employee_id', $value);
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($value);
            $this->crud->addClause('whereHas', 'associate_professor' , function($query) use($value) {
                //$bank_id = DB::table('banks')->where('name',$value)->value('id');
                //$query = AssociateProfessor::all();
                //$query = $query->where('associate_subject->currilum', '=', $value);
                //$query->where('currilum', '=', $value);
                return $query->whereHas('associate_subject', function ($associate_subject) use ($value) {
                    return $associate_subject->where('subject_id', '=', $value);
                });
            });
        });

        $this->crud->addFilter([
            'name'  => 'academic_course',
            'type'  => 'select2',
            'label' => 'Curso Académico',
        ], function () {
            $keys = [];
            $array = [];
            $collection = AcademicCourse::all();
            for($i = 0; $i<count($collection); $i++){
                array_push($keys, $collection[$i]->id);
            }
            for($i = 0; $i<count($collection); $i++){
                array_push($array, $collection[$i]->name);
            }
            $diccionario = array_combine($keys,$array);
            //dd($diccionario);
            //dd($banks = Bank::all()->keyBy('id')->pluck('name'));
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($banks);
            return $diccionario;
        }, function ($value) { // if the filter is active
            //$this->crud->addClause('where', 'employee_id', $value);
            //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$out->writeln($value);
            $this->crud->addClause('whereHas', 'associate_professor' , function($query) use($value) {
                //$bank_id = DB::table('banks')->where('name',$value)->value('id');
                //$query = AssociateProfessor::all();
                //$query = $query->where('associate_subject->currilum', '=', $value);
                return $query->where('academic_course_id', '=', $value);
            });
        });
    }

    protected function defaultFields()
    {
        //CRUD::field('id');
        //CRUD::field('name')->label('Nombre');

        CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Curso',
            'name' => 'academic_course', // the method on your model that defines the relationship
            'attribute' => "name",
        ]);
        
        /*CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Asignatura - Curso',
            'name' => 'associate_professor', // the method on your model that defines the relationship
            'attribute' => "name",
        ]);*/
        
        CRUD::addField([
            'name'                      => 'associate_professor',
            'type'                      => 'select2_from_ajax',
            'label'                     => 'Asignatura - Curso',
            'attribute'                 => "full_name",
            'dependencies'              => ['academic_course'],
            'data_source'               => url("api/associate_professor"),
            'placeholder'               => "Selecciona un curso asignado a una asignatura",
            'minimum_input_length'      => 0,
            'entity'                    => 'associate_professor',
            'model'                     => "App\Models\AssociateProfessor",
            'include_all_form_fields'   => true,
        ]);

        CRUD::field('classroom')->label('Local');

        CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Tunos",
            'type'      => 'select2_multiple',
            'name'      => 'shifts', // the method that defines the relationship in your Model
       
            // optional
            'entity'    => 'shifts', // the method that defines the relationship in your Model
            'model'     => "App\Models\Shift", // foreign key model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
       ]);

        CRUD::field('weekday')->label('Día de la semana');
        //CRUD::field('class_typology')->label('Tipología');

        CRUD::addField([
            'name'                      => 'class_typology',
            'type'                      => 'select2_from_ajax',
            'label'                     => 'Tipología',
            'attribute'                 => "name",
            'dependencies'              => ['associate_professor'],
            'data_source'               => url("api/class_typology"),
            'placeholder'               => "Selecciona una Tipología",
            'minimum_input_length'      => 0,
            'entity'                    => 'class_typology',
            'model'                     => "App\Models\ClassTypology",
            'include_all_form_fields'   => true,
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->addCustomCrudFilters();
        $this->crud->disableResponsiveTable();
        //CRUD::column('id');
        CRUD::column('associate_professor')->label('Asigntura - Curso')->attribute('name');
        CRUD::column('classroom')->label('Local');
        CRUD::addColumn([
            // n-n relationship (with pivot table)
            'label'     => 'Turnos', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'shifts', // the method that defines the relationship in your Model
            'entity'    => 'shifts', // the method that defines the relationship in your Model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'model'     => 'App\Models\Shift', // foreign key model
         ],);
         CRUD::column('weekday')->label('Día de la semana');
         CRUD::column('class_typology')->label('Tipología');
        //CRUD::column('created_at');
        //CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ScheduleRequest::class);

        //CRUD::field('id');
        $this->defaultFields();

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(UpdateScheduleRequest::class);
        $this->defaultFields();
    }


    protected function setupShowOperation()
    {
        //$this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }

    public function list_schedules()
    {
        $curricula = Curriculum::all();
        $academic_years = AcademicYear::all();
        $academic_semesters = AcademicSemester::all();
        $shifts = Shift::all();

        return view('schedule.list',compact('curricula','academic_years','academic_semesters','shifts'));
    }


    public function view_schedules(Request $request)
    {
        $curricula = Curriculum::all();
        $academic_years = AcademicYear::all();
        $academic_semesters = AcademicSemester::all();
        $shifts = Shift::all();
        $curriculum_id = $request->curriculum;
        $academic_year_id = $request->academic_year;
        $academic_semester_id = $request->academic_semester;

        return view('schedule.list',compact('curricula','academic_years','academic_semesters','shifts','curriculum_id','academic_year_id','academic_semester_id'));
    }

    public function createPDF($curriculum_id,$academic_year_id,$academic_semester_id){
        $curriculum = Curriculum::find($curriculum_id);
        $academic_year = AcademicYear::find($academic_year_id);
        $academic_semester = AcademicSemester::find($academic_semester_id);
        $shifts = Shift::all();
        $pdf = PDF::loadView('schedule.pdf', compact('curriculum','academic_year','academic_semester','curriculum_id','academic_year_id','academic_semester_id','shifts'));
        return $pdf->download('horario-'. $curriculum->name . '-' .  $academic_year->name . '-' . $academic_semester->name . '.pdf');
    }

    public function exportExcel($curriculum_id,$academic_year_id,$academic_semester_id){
        $curriculum = Curriculum::find($curriculum_id);
        $academic_year = AcademicYear::find($academic_year_id);
        $academic_semester = AcademicSemester::find($academic_semester_id);
        $shifts = Shift::all();
        return Excel::download(new ScheduleExport($curriculum,$academic_year,$academic_semester,$shifts), 'horario-'. $curriculum->name . '-' .  $academic_year->name . '-' . $academic_semester->name . '.xlsx');
    }

}