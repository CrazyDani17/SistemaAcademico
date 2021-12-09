<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AssociateSubjectRequest;
use App\Http\Requests\UpdateAssociateSubjectRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CurriculumCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AssociateSubjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation; //{ store as associate_subjtectStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\AssociateSubject::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/associate-subject');
        CRUD::setEntityNameStrings('asociación de asignatura', 'asociar asignaturas');
    }

    /*public function store()
    {
        $request = $this->crud->getRequest();




        $response = $this->associate_subjectStore();
        //Todo lo de aqui es after insert
        
        return $response;
    }*/


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

         CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Tipología",
            'type' => "relationship",
            //'ajax' => true,
            'name'      => 'class_typology_hour', // the method that defines the relationship in your Model
            //'entity'    => 'container_with_quantity', // the method that defines the relationship in your Model
            'model'     => "App\Models\ClassTypologyHour",
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            //'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
            //'inline_create' => [ 'entity' => 'container_with_quantity' ],
            'inline_create' => true,
       ]);

         /*CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Tipología',
            'name' => 'class_typology', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);

         CRUD::field('number_of_hours')->label('Número de horas');*/

         /*CRUD::addField([   // relationship
            'type'      => 'relationship',
            'label' => 'Año académico',
            'name' => 'academic_year', // the method on your model that defines the relationship
            'attribute' => "name",
         ]);*/

        
        

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
        CRUD::column('curriculum')->label('Malla');
        CRUD::column('academic_year')->label('Año académico');
        CRUD::column('academic_semester')->label('Semestre');
        CRUD::column('subject')->label('Asignatura');
        CRUD::column('credits')->label('Créditos');
        CRUD::addColumn([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Tipología - Horas",
            'type' => "relationship",
            //'ajax' => true,
            'name'      => 'class_typology_hour', // the method that defines the relationship in your Model
            //'entity'    => 'container_with_quantity', // the method that defines the relationship in your Model
            'model'     => "App\Models\ClassTypologyHour",
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            //'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
            //'inline_create' => [ 'entity' => 'container_with_quantity' ],
       ]);
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
        CRUD::setValidation(AssociateSubjectRequest::class);

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
        CRUD::setValidation(UpdateAssociateSubjectRequest::class);
        $this->defaultFields();
    }


    protected function setupShowOperation()
    {
        //$this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }

    /*protected function fetchClassTypologyHour()
    {
        return $this->fetch(\App\Models\ClassTypologyHour::class);
    }*/

    /*public function associate_subjects() 
    {
        $this->defaultFields();
    }*/
}
