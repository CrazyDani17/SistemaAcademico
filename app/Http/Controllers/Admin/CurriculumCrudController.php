<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CurriculumRequest;
use App\Http\Requests\UpdateCurriculumRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CurriculumCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CurriculumCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Curriculum::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/curriculum');
        CRUD::setEntityNameStrings('malla académica', 'mallas académicas');
    }


    protected function defaultFields()
    {
        //CRUD::field('id');
        CRUD::field('name')->label('Nombre');
        CRUD::field('year_of_creation')->label('Año de creación');
        CRUD::field('number_of_years')->label('Cantidad de años');
        CRUD::field('number_of_semesters')->label('Cantidad de semestres');

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
        CRUD::column('name')->label('Nombre');
        CRUD::column('year_of_creation')->label('Año de creación');
        CRUD::column('number_of_years')->label('Cantidad de años');
        CRUD::column('number_of_semesters')->label('Cantidad de semestres');
        $this->crud->addButton('line', 'associate_subjects', 'view', 'curriculum.buttons.associate_subjects', 'end');
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
        CRUD::setValidation(CurriculumRequest::class);

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
        CRUD::setValidation(UpdateCurriculumRequest::class);
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
