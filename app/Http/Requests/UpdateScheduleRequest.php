<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Shift;
use App\Models\Schedule;
use App\Models\Weekday;
use App\Models\Classroom;
use App\Models\AssociateProfessor;

class UpdateScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'associate_professor' => 'required',
            'associate_professor' => ['required',function ($attribute, $value, $fail) {
                $schedules = Schedule::all();
                $routeSegmentWithId = empty(config('backpack.base.route_prefix')) ? '2' : '3';
                $Id = $this->get('id') ?? \Request::instance()->segment($routeSegmentWithId);
                //$professorids = [];
                $bool1 = FALSE;
                $bool2 = FALSE;
                $shiftids = [];
                //$aux = [];
                foreach($schedules as $item){
                    if($item->id != $Id){
                        if($item->associate_professor->id == $value){
                            $bool1 = TRUE;
                            if($item->weekday->id == $this->weekday){
                                $bool2 = TRUE;
                            }
                        }
                        foreach($item->shifts as $shift){
                            $shiftids[$item->associate_professor->id][$item->weekday->id][] = $shift->id;
                            //$professorids[] = $professsor->id;
                        }
                    }
                    //$professorids[$item->weekday->id] = $aux;
                }

                if($bool1 && $bool2){
                    foreach($this->shifts as $item){
                        if (in_array($item, $shiftids[$value][$this->weekday])) {
                            $fail('Esta asignatura ya se est?? dando en uno de los turnos seleccionados en el d??a '. Weekday::find($this->weekday)->name );
                        }
                    }
                }
            },],
            'classroom' => ['required',function ($attribute, $value, $fail) {
                $schedules = Schedule::all();
                $routeSegmentWithId = empty(config('backpack.base.route_prefix')) ? '2' : '3';
                $Id = $this->get('id') ?? \Request::instance()->segment($routeSegmentWithId);
                $shiftids = [];
                //$aux = [];
                $bool1 = FALSE;
                $bool2 = FALSE;
                $bool3 = FALSE;
                foreach($schedules as $item){
                    if($item->id != $Id){

                        //$aux = [];
                        $bool1 = FALSE;
                        $bool2 = FALSE;
                        foreach($item->shifts as $shift){
                            $shiftids[$item->weekday->id][ $item->classroom->id][] = $shift->id;
                        }
                        if($item->weekday->id == $this->weekday){
                            $bool1 = TRUE;
                        }
                        if($item->classroom->id == $this->classroom){
                            $bool2 = TRUE;
                        }
                        if($bool1 && $bool2){
                            $bool3 = TRUE;
                        }
                    }
                    //$shiftids[$item->weekday->id][ $item->classroom->id] = $aux;
                }
                if($bool3){
                    foreach($this->shifts as $item){
                        if (in_array($item, $shiftids[$this->weekday][$this->classroom])) {
                            $fail('Esta clase ya est?? en uso en los turnos seleccinados.');
                        }
                    }
                }
            }],
                
            'shifts' => ['required',function ($attribute, $value, $fail) {
                $schedules = Schedule::all();
                $routeSegmentWithId = empty(config('backpack.base.route_prefix')) ? '2' : '3';
                $Id = $this->get('id') ?? \Request::instance()->segment($routeSegmentWithId);
                $associate_professor = AssociateProfessor::find($this->associate_professor);
                $professors = $associate_professor->professors;
                $professor_ids = [];
                $shiftids = [];
                $weekdayids = [];
                foreach($schedules as $item){
                    if($item->id != $Id){
                        foreach($item->associate_professor->professors as $professor){
                            $weekdayids[$professor->id][] = $item->weekday->id;
                            if(!in_array($professor->id, $professor_ids)){
                                $professor_ids[] = $professor->id;
                            }
                            foreach($item->shifts as $shift){
                                $shiftids[$professor->id][$item->weekday->id][] = $shift->id;
                            }
                        }
                    }
                }
                foreach ($professors as $professor){
                    if(in_array($professor->id, $professor_ids)){
                        foreach($value as $item){
                            if (in_array($this->weekday, $weekdayids[$professor->id])){
                                if (in_array($item, $shiftids[$professor->id][$this->weekday])) {
                                    $fail('Un profesor de la asignatura seleccionada ya imparte clases en estos horarios en el aula '. Classroom::find($this->classroom)->name . ' el d??a ' . Weekday::find($this->weekday)->name );
                                }
                            }
                        }
                    } 
                }

            },],
            
            'weekday' => 'required',
            'class_typology' => ['required',function ($attribute, $value, $fail) {
                $schedules = Schedule::where('associate_professor_id',$this->associate_professor)->get();
                $routeSegmentWithId = empty(config('backpack.base.route_prefix')) ? '2' : '3';
                $Id = $this->get('id') ?? \Request::instance()->segment($routeSegmentWithId);
                $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                $shift_numbers = [];
                $associate_professor = AssociateProfessor::find($this->associate_professor);
                foreach($associate_professor->associate_subject->class_typology_hour as $class_typology_hour){
                    $shift_numbers[$class_typology_hour->class_typology->id] = 0;
                }
                  
                foreach($schedules as $item){
                    if($item->id != $Id){
                        foreach($item->shifts as $shift){
                            $shift_numbers[$item->class_typology->id]++;
                        }
                    }
                }
                
                foreach($this->shifts as $shift){
                    $shift_numbers[$this->class_typology]++;
                }

                foreach($associate_professor->associate_subject->class_typology_hour as $class_typology_hour){
                    if($shift_numbers[$class_typology_hour->class_typology->id] >  $class_typology_hour->hours){
                        $fail('Super?? el n??mero establecido de horas acad??micas establecidos para la tipolog??a de clase de la asignatura');
                    }
                }   

            },],
            
            // 'name' => 'required|min:5|max:255'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
