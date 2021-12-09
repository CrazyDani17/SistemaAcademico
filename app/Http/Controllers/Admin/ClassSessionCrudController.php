<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClassSessionRequest;
use App\Http\Requests\UpdateClassSessionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClassSessionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClassSessionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation{ destroy as traitDestroy; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ClassSession::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/class-session');
        CRUD::setEntityNameStrings('sesión de clase', 'sesiones de clase');
    }

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');
        //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
        //$out->writeln(backpack_url($this->crud->route));
        return $this->crud->delete($id);

        //return  redirect(backpack_url('class-session')); 
        //return \Redirect::to($this->crud->route);
        /*$this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? mb_ucfirst($this->crud->entity_name_plural);

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getListView(), $this->data);
        */
        return \Redirect::to($this->crud->route);
        //return redirect(backpack_url('dashboard'));
    }


    protected function defaultFields()
    {
        //CRUD::field('id');
        CRUD::field('name')->label('Nombre');
        CRUD::field('acronym')->label('Siglas');
        CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Turnos",
            'type'      => 'select2_multiple',
            'name'      => 'shifts', // the method that defines the relationship in your Model
       
            // optional
            'entity'    => 'shifts', // the method that defines the relationship in your Model
            'model'     => "App\Models\Shift", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
       ]);

       CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Semestres Académicos",
            'type'      => 'select2_multiple',
            'name'      => 'academic_semesters', // the method that defines the relationship in your Model
    
            // optional
            'entity'    => 'academic_semesters', // the method that defines the relationship in your Model
            'model'     => "App\Models\AcademicSemester", // foreign key model
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
        //CRUD::column('id');
        $this->crud->disableResponsiveTable();
        CRUD::column('name')->label('Nombre');
        CRUD::column('acronym')->label('Siglas');
        CRUD::addColumn([
            // n-n relationship (with pivot table)
            'label'     => 'Turnos', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'shifts', // the method that defines the relationship in your Model
            'entity'    => 'shifts', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => 'App\Models\Shift', // foreign key model
         ]);

         CRUD::addColumn([
            // n-n relationship (with pivot table)
            'label'     => 'Semestres Académico', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'academic_semesters', // the method that defines the relationship in your Model
            'entity'    => 'academic_semesters', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => 'App\Models\AcademicSemester', // foreign key model
         ]);
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
        CRUD::setValidation(ClassSessionRequest::class);

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
        CRUD::setValidation(UpdateClassSessionRequest::class);
        $this->defaultFields();
    }


    protected function setupShowOperation()
    {
        //$this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
