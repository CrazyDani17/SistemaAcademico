<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;
use App\Models\Professor;

/**
 * Class ProfessorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProfessorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as professorStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation; // { destroy as professorDestroy; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Professor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/professor');
        CRUD::setEntityNameStrings('profesor', 'profesores');
    }

    public function store()
    {
        $request = $this->crud->getRequest();
        //Obtenemos el requeste mediante una función, porque es protected.
        //Creamos la contraseña. Para esto el request que hemos obtenido nos da lo que llenamos en el formulario mediante llamados a get("nombre del atributo"), all() devuelve todo, set("nombre del atributo", "lo que quieras setear").
        $password = $request->request->get("dni");
        $password = Hash::make($password);
        //Aqui se guarda, todo lo que ocurre antes de aqui es antes de que se guarde el formulario(before insert)


        $response = $this->professorStore();

        if(!DB::table('users')->where('email',$request->request->get("email"))->exists()){
    
            //Inserta a la tabla usuario y se obtiene el id.
            $var = DB::table('users')->insertGetId(
                ['name' => $request->request->get("names"),'email' => $request->request->get("email"), 'password' => $password ]
            );

            $professor_id = Professor::latest('id')->first();

            $professor = Professor::find($professor_id)->first();

            $professor->user_id = $var;

            $professor->save();
    
            //utilizamos el set para asignarle el usuario al cliente.
            //$request->request->set("user_id", $var);
        }

        //Todo lo de aqui es after insert
        //return $response;

        return \Redirect::to($this->crud->route);
    }

    /*public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        $response = $this->crud->delete($id);
        
        $used_id = Professor::find($id)->user_id;

        DB::table('users')->where('id', $used_id)->delete();

        return $response;

        /*$professor = Professor::findOrFail($id);
        $professor->delete();
        return redirect()->route($this->crud->route)->with('success', 'Profesor eliminado');
    }*/


    protected function defaultFields()
    {
        CRUD::field('names')->label('Nombres');
        CRUD::field('last_name')->label('Apellido paterno');
        CRUD::field('second_last_name')->label('Apellido materno');
        CRUD::field('email');
        CRUD::field('dni')->label('DNI');
        /*CRUD::addField([
            'name' => 'user_id',
            'type'  => 'hidden',
            'default' => '1'
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
        CRUD::column('names')->label('Nombres');
        CRUD::column('last_name')->label('Apellido paterno');
        CRUD::column('second_last_name')->label('Apellido materno');
        CRUD::column('email');
        CRUD::column('dni')->label('DNI');

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
        CRUD::setValidation(ProfessorRequest::class);

        $this->defaultFields();
        /*CRUD::addField([
            'name' => 'user_id',
            'type'  => 'hidden',
            'default' => '1'
        ]);*/

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
        CRUD::setValidation(UpdateProfessorRequest::class);
        $this->defaultFields();
    }


    protected function setupShowOperation()
    {
        //$this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
