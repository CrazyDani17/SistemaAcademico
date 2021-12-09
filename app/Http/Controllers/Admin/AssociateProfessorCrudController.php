<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AssociateProfessorRequest;
use App\Http\Requests\UpdateAssociateProfessorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\AssociateSubject;
use App\Models\AcademicCourse;

/**
 * Class CurriculumCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AssociateProfessorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as associate_professorStore; }
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
        CRUD::setModel(\App\Models\AssociateProfessor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/associate-professor');
        CRUD::setEntityNameStrings('asociación de profesores', 'asociar profesores');
    }

    protected function store()
    {
        $request = $this->crud->getRequest();

        $associate_subject_id = $request->request->get("associate_subject");

        $associate_subject = AssociateSubject::find($associate_subject_id);

        $academic_course_id = $request->request->get("academic_course");

        $academic_course = AcademicCourse::find($academic_course_id);

        $full_name = $academic_course->name . " - " .   $associate_subject->name;

        $this->crud->addField(['type' => 'hidden', 'name' => 'full_name']);

        $this->crud->getRequest()->request->add(['full_name'=> $full_name]);

        $response = $this->associate_professorStore();
        //Todo lo de aqui es after insert
        
        return $response;
    

    }


    protected function defaultFields()
    {
        //CRUD::field('id');
        //CRUD::field('name')->label('Nombre');
        /*CRUD::addField(['name' => 'name',
        'label' => 'Nombre',
        'attributes' => [
            'disabled'    => 'disabled',
        ],]);*/

        CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Asignatura',
            'name' => 'associate_subject', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         /*CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Curricula',
            'name' => 'curriculum', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         

         CRUD::addField([
            'name'                      => 'academic_year_id',
            'type'                      => 'select2_from_ajax',
            'label'                     => 'Año académico',
            'attribute'                 => 'name',
            'dependencies'              => ['curriculum_id'],
            'data_source'               => url("api/academic_year"),
            'placeholder'               => "Selecciona un año academico",
            'minimum_input_length'      => 0,
            'entity'                    => 'academic_year',
            'model'                     => "App\Models\AcademicYear",
            'include_all_form_fields'   => true,
        ]);*/

         CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Curso',
            'name' => 'academic_course', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Profesor",
            'type'      => 'select2_multiple',
            'name'      => 'professors', // the method that defines the relationship in your Model
       
            // optional
            'entity'    => 'professors', // the method that defines the relationship in your Model
            'model'     => "App\Models\Professor", // foreign key model
            'attribute' => 'complete_name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
       ]);

        /*CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Malla',
            'name' => 'curriculum', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);


        CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Año académico',
            'name' => 'academic_year', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Semestre',
            'name' => 'academic_semester', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Asignatura',
            'name' => 'subject', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         CRUD::field('credits')->label('Créditos');

         CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Tipología',
            'name' => 'class_typology', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         CRUD::field('number_of_hours')->label('Número de horas');
         */

        
        

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

        //CRUD::column('id');
        CRUD::column('associate_subject')->label('Asignatura')->attribute('name');
        CRUD::column('academic_course')->label('Curso');
        CRUD::addColumn([
            // n-n relationship (with pivot table)
            'label'     => 'Profesor', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'professors', // the method that defines the relationship in your Model
            'entity'    => 'professors', // the method that defines the relationship in your Model
            'attribute' => 'complete_name', // foreign key attribute that is shown to user
            'model'     => 'App\Models\Professor', // foreign key model
         ],);
        //CRUD::column('curriculum')->label('Malla');
        //CRUD::column('academic_year')->label('Año académico');
        //CRUD::column('academic_semester')->label('Semestre');
        //CRUD::column('subject')->label('Asignatura');
        //CRUD::column('credits')->label('Créditos');
        //CRUD::column('class_typology')->label('Tipología');
        //CRUD::column('number_of_hours')->label('Cantidad de horas');
        //$this->crud->addButton('line', 'associate_subjects', 'view', 'curriculum.buttons.associate_subjects', 'end');
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
        CRUD::setValidation(AssociateProfessorRequest::class);

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
        CRUD::setValidation(UpdateAssociateProfessorRequest::class);
        $this->defaultFields();
    }


    protected function setupShowOperation()
    {
        //$this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }

    /*public function associate_subjects() 
    {
        $this->defaultFields();
    }*/
}
