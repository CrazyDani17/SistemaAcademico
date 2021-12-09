@if ($crud->hasAccess('update'))
<a href="{{ url('admin/associate-subject/create') }} "  class="btn btn-sm btn-link"><i class="la la-hand-o-right"></i> Asociar Asignaturas </a>	
@endif