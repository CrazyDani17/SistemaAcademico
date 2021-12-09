<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClassroomCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClassroomCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Classroom::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/classroom');
        CRUD::setEntityNameStrings('local', 'locales');
    }


    protected function defaultFields()
    {

        CRUD::field('name')->label('Nombre');
        CRUD::field('acronym')->label('Siglas');
        CRUD::addfield([   // select_from_array
            'name'        => 'type',
            'label'       => "Tipo",
            'type'        => 'select_from_array',
            'placeholder' => 'Selecciona un tipo',
            'options'     => ['standar' => 'Aula', 'laboratory' => 'Laboratorio'],
            'allows_null' => false,
            
        ]);

        CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Tipología de clase",
            'type'      => 'select2_multiple',
            'name'      => 'class_typologies', // the method that defines the relationship in your Model
       
            // optional
            'entity'    => 'class_typologies', // the method that defines the relationship in your Model
            'model'     => "App\Models\ClassTypology", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
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
        CRUD::column('name')->label('Nombre');
        CRUD::column('acronym')->label('Siglas');;
        CRUD::addColumn([
            // select_from_array
            'name'    => 'type',
            'label'   => 'Tipo',
            'type'    => 'select_from_array',
            'options' => ['standar' => 'Aula', 'laboratory' => 'Laboratorio'],
        ]);

        CRUD::addColumn([
            // n-n relationship (with pivot table)
            'label'     => 'Tipología de clase', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'class_typologies', // the method that defines the relationship in your Model
            'entity'    => 'class_typologies', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => 'App\Models\ClassTypology', // foreign key model
         ],);

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
        CRUD::setValidation(ClassroomRequest::class);

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
        CRUD::setValidation(UpdateClassroomRequest::class);
        $this->defaultFields();
    }


    protected function setupShowOperation()
    {
        //$this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
