
<style type="text/css">
    
body{
    margin-top:20px;
}
table {
  width: 100%;
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


h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; }
            table { border-collapse: separate; border-spacing: 2px; }
            th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: center; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }

            body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 7.5in; }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #e40101; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 95%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            article address.norm h4 {
                font-size: 125%;
                font-weight: bold;
            }
            article address.norm { float: left; font-size: 95%; font-style: normal; font-weight: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            header span { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 80%; max-width: 80%; left: 40px;}
            header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            /* table meta & balance */

            table.meta, table.balance { float: right; width: 36%; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 40%; }
            table.meta td { width: 60%; }

            /* table items */

            table.inventory { clear: both; width: 100%; }
            table.inventory th:first-child {
                width:50px;
            }
            table.inventory th:nth-child(2) {
                width:300px;
            }
            table.inventory th { font-weight: bold; text-align: center; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* Discounts table */

            table.discount { clear: both; width: 100%; }
            table.discount th:first-child {
                width:50px;
            }
            table.discount th:nth-child(2) {
                width:300px;
            }
            table.discount th { font-weight: bold; text-align: center; }

            table.discount td:nth-child(1) { width: 26%; }
            table.discount td:nth-child(2) { width: 38%; }
            table.discount td:nth-child(3) { text-align: right; width: 23%; }

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            table.sign {
                float: left;
                width: 220px;
            }
            table.sign img {
                width: 100%;
            }
            table.sign tr td {
                border-color: transparent;
            }
            @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { box-shadow: none; margin: 0; }
                span:empty { display: none; }
                .add, .cut { display: none; }
            }

            @page { margin: 0; }
</style>
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


