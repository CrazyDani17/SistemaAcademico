@extends(backpack_view('blank'))

@section('content')

  <style>
body{
    margin-top:20px;
}
.bg-light-gray {
    background-color: #f7f7f7;
}
.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}


.bg-sky.box-shadow {
    box-shadow: 0px 5px 0px 0px #00a2a7
}

.bg-orange.box-shadow {
    box-shadow: 0px 5px 0px 0px #af4305
}

.bg-green.box-shadow {
    box-shadow: 0px 5px 0px 0px #4ca520
}

.bg-yellow.box-shadow {
    box-shadow: 0px 5px 0px 0px #dcbf02
}

.bg-pink.box-shadow {
    box-shadow: 0px 5px 0px 0px #e82d8b
}

.bg-purple.box-shadow {
    box-shadow: 0px 5px 0px 0px #8343e8
}

.bg-lightred.box-shadow {
    box-shadow: 0px 5px 0px 0px #d84213
}


.bg-sky {
    background-color: #02c2c7
}

.bg-orange {
    background-color: #e95601
}

.bg-green {
    background-color: #5bbd2a
}

.bg-yellow {
    background-color: #f0d001
}

.bg-pink {
    background-color: #ff48a4
}

.bg-purple {
    background-color: #9d60ff
}

.bg-lightred {
    background-color: #ff5722
}

.padding-15px-lr {
    padding-left: 15px;
    padding-right: 15px;
}
.padding-5px-tb {
    padding-top: 5px;
    padding-bottom: 5px;
}
.margin-10px-bottom {
    margin-bottom: 10px;
}
.border-radius-5 {
    border-radius: 5px;
}

.margin-10px-top {
    margin-top: 10px;
}
.font-size14 {
    font-size: 14px;
}

.text-light-gray {
    color: #d6d5d5;
}
.font-size13 {
    font-size: 13px;
}

.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
  </style>
  <!-- Default box -->

  

  <div class="container">
                <div class="timetable-img text-center">
                    <img src="img/content/timetable.png" alt="">
                </div>
                <form action="{{ route('view_schedules') }}" method="post">
                @csrf
                    <select name="curriculum" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach($curricula as $curriculum)
                        <option value="{{$curriculum->id}}"> {{$curriculum->name}}</option>
                        @endforeach
                    </select>

                    <select name="academic_year" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach($academic_years as $academic_year)
                        <option value="{{$academic_year->id}}"> {{$academic_year->name}}</option>
                        @endforeach
                    </select>

                    <select name="academic_semester" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach($academic_semesters as $academic_semester)
                        <option value="{{$academic_semester->id}}"> {{$academic_semester->name}}</option>
                        @endforeach
                    </select>

                    <button href="#" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="la la-eye"></i> Ver Horarios</span></button>
                    
                </form>
                @if(isset($curriculum_id) && isset($academic_year_id) && isset($academic_semester_id))
                    <a href="{{route('schedule.pdf', ['curriculum_id' => $curriculum_id , 'academic_year_id' => $academic_year_id, 'academic_semester_id' => $academic_semester_id])}}" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="la la-file-pdf-o"></i> Descargar PDF</span></a>
                    <a href="{{route('schedule.excel', ['curriculum_id' => $curriculum_id , 'academic_year_id' => $academic_year_id, 'academic_semester_id' => $academic_semester_id])}}" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="la la-file-excel-o"></i> Exportar a Excel</span></a>
                    @endif

                

                <br>
                <div class="table-responsive">
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
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                                    <br>
                                    <br>
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                                        <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                                        @foreach($schedule->associate_professor->professors as $profesor)
                                        <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
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
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                                    <br>
                                    <br>
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                                        <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                                        @foreach($schedule->associate_professor->professors as $profesor)
                                        <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
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
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                                    <br>
                                    <br>
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                                        <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                                        @foreach($schedule->associate_professor->professors as $profesor)
                                        <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
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
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                                    <br>
                                    <br>
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                                        <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                                        @foreach($schedule->associate_professor->professors as $profesor)
                                        <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
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
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                                    <br>
                                    <br>
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                                        <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                                        @foreach($schedule->associate_professor->professors as $profesor)
                                        <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
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
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedule->associate_professor->associate_subject->subject->name}} </span>
                                    <br>
                                    <br>
                                    <span class="{{$colors[array_rand($colors, 1)]}} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$schedule->associate_professor->academic_course->name}}</span>
                                        <div class="margin-10px-top font-size14">{{$schedule->classroom->name}}</div>
                                        @foreach($schedule->associate_professor->professors as $profesor)
                                        <div class="font-size13 text-light-gray">{{$profesor->complete_name}}</div>
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
            </div>

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css').'?v='.config('backpack.base.cachebusting_string') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css').'?v='.config('backpack.base.cachebusting_string') }}">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

