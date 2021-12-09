<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests\ClassTypologyHourRequest;
//use App\Http\Requests\UpdateClassTypologyHourRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\ClassTypology;

/**
 * Class ClassTypologyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClassTypologyHourCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as class_typology_hourStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ClassTypologyHour::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/class_typology_hour');
        CRUD::setEntityNameStrings('tipología de clase', 'tipologías de clase');
    }

    public function store()
    {
        $request = $this->crud->getRequest();
        //dd($request);
        
        $class_typology_id = $request->request->get("class_typology");
        $hours = $request->request->get("hours");
        $class_typology = ClassTypology::find($class_typology_id);
        $full_name = $class_typology->name . ": " . $hours . " horas";

        $this->crud->addField(['name' => 'full_name']);

        $this->crud->getRequest()->request->add(['full_name'=> $full_name]);

        //dd($request);
        //Poner el id de la guía de remision del transportista
        /*$affected = DB::table('manifest_processes')->where('id', $this->manifest_id)->update(['haulier_referral_guide_id' => $haulier_referral_guide_id]);
        //$affected = DB::table('manifest_processes')->where('id', 4)->update(['code' => $this->manifest_id]);
        
        //Con este obtines el atributo fase
        $fase = DB::table('manifest_processes')->select('phase')->where('id', $this->manifest_id)->get();
        if ($fase[0]->phase == 3){
            $affected = DB::table('manifest_processes')->where('id', $this->manifest_id)->update(['phase' => '4']);
        }*/

        $response = $this->class_typology_hourStore();
        //Todo lo de aqui es after insert
        
        return $response;
    }

    protected function defaultFields()
    {
        //CRUD::field('id');
        CRUD::addField([
            'name' => 'class_typology', 
            'label' => 'Tipología',
            'type'      =>  'relationship',
            'attribute' => 'name',
        ]); 
        CRUD::field('hours')->label('Horas');

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
        CRUD::column('class_typology')->label('Tipología');
        CRUD::column('hours')->label('Horas');
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
        //CRUD::setValidation(ClassTypologyHourRequest::class);

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
        CRUD::setValidation(UpdateClassTypologyRequest::class);
        $this->defaultFields();
    }


    protected function setupShowOperation()
    {
        //$this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
