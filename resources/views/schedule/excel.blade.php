<h1> {{$curriculum->name}} - {{ $academic_year->name}} - {{$academic_semester->name}} </h1>
<div class="container">
<table class="table table-bordered text-center">
    <thead>
        <tr class="bg-light-gray">
            <th class="text-uppercase">Hora</th>
            <th class="text-uppercase">Lunes</th>
            <th class="text-uppercase">Martes</th>
            <th class="text-uppercase">Miércoles</th>
            <th class="text-uppercase">Jueves</th>
            <th class="text-uppercase">Viernes</th>
            <th class="text-uppercase">Sábado</th>
        </tr>
    </thead>
    @php($colors = array("bg-sky", "bg-green", "bg-yellow", "bg-purple", "bg-pink","bg-lightred"))
    <tbody>
        @foreach($shifts as $shift)
        <tr>
            <td class="align-middle">{{$shift->full_name}}</td>
            <td>
            @if(isset($curriculum_id) && isset($academic_year_id) && isset($academic_semester_id))
            @foreach($shift->schedules as $schedule)
                @if($schedule->associate_professor->associate_subject->curriculum->id == $curriculum_id && $schedule->associate_professor->associate_subject->academic_year->id == $academic_year_id  && $schedule->associate_professor->associate_subject->academic_semester->id == $academic_semester_id )
                @if($schedule->weekday->name == "Lunes")
                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                    <br>
                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                    <br>
                    <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                    <br>
                    @foreach($schedule->associate_professor->professors as $profesor)
                    <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
                    <br>
                    @endforeach   
                @endif
                @endif
            @endforeach
            @endif
            </td>
            <td>
            @if(isset($curriculum_id) && isset($academic_year_id) && isset($academic_semester_id))
            @foreach($shift->schedules as $schedule)
                @if($schedule->associate_professor->associate_subject->curriculum->id == $curriculum_id && $schedule->associate_professor->associate_subject->academic_year->id == $academic_year_id  && $schedule->associate_professor->associate_subject->academic_semester->id == $academic_semester_id )
                @if($schedule->weekday->name == "Martes")
                <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                    <br>
                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                    <br>
                    <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                    <br>
                    @foreach($schedule->associate_professor->professors as $profesor)
                    <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
                    <br>
                    @endforeach    
                @endif
                @endif
            @endforeach
            @endif
            </td>
            <td>
            @if(isset($curriculum_id) && isset($academic_year_id) && isset($academic_semester_id))
            @foreach($shift->schedules as $schedule)
                @if($schedule->associate_professor->associate_subject->curriculum->id == $curriculum_id && $schedule->associate_professor->associate_subject->academic_year->id == $academic_year_id  && $schedule->associate_professor->associate_subject->academic_semester->id == $academic_semester_id )
                @if($schedule->weekday->name == "Miércoles")
                <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                    <br>
                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                    <br>
                    <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                    <br>
                    @foreach($schedule->associate_professor->professors as $profesor)
                    <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
                    <br>
                    @endforeach 
                @endif
                @endif
            @endforeach
            @endif
            </td>
            <td>
            @if(isset($curriculum_id) && isset($academic_year_id) && isset($academic_semester_id))
            @foreach($shift->schedules as $schedule)
                @if($schedule->associate_professor->associate_subject->curriculum->id == $curriculum_id && $schedule->associate_professor->associate_subject->academic_year->id == $academic_year_id  && $schedule->associate_professor->associate_subject->academic_semester->id == $academic_semester_id )
                @if($schedule->weekday->name == "Jueves")
                <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                    <br>
                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                    <br>
                    <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                    <br>
                    @foreach($schedule->associate_professor->professors as $profesor)
                    <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
                    <br>
                    @endforeach    
                @endif
                @endif
            @endforeach
            @endif
            </td>
            <td>
            @if(isset($curriculum_id) && isset($academic_year_id) && isset($academic_semester_id))
            @foreach($shift->schedules as $schedule)
                @if($schedule->associate_professor->associate_subject->curriculum->id == $curriculum_id && $schedule->associate_professor->associate_subject->academic_year->id == $academic_year_id  && $schedule->associate_professor->associate_subject->academic_semester->id == $academic_semester_id )
                @if($schedule->weekday->name == "Viernes")
                <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                    <br>
                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                    <br>
                    <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                    <br>
                    @foreach($schedule->associate_professor->professors as $profesor)
                    <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
                    <br>
                    @endforeach  
                @endif
                @endif
            @endforeach
            @endif
            </td>
            <td>
            @if(isset($curriculum_id) && isset($academic_year_id) && isset($academic_semester_id))
            @foreach($shift->schedules as $schedule)
                @if($schedule->associate_professor->associate_subject->curriculum->id == $curriculum_id && $schedule->associate_professor->associate_subject->academic_year->id == $academic_year_id  && $schedule->associate_professor->associate_subject->academic_semester->id == $academic_semester_id )
                @if($schedule->weekday->name == "Sábado")
                <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                    <br>
                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                    <br>
                    <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                    <br>
                    @foreach($schedule->associate_professor->professors as $profesor)
                    <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
                    <br>
                    @endforeach 
                @endif
                @endif
            @endforeach
            @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>


