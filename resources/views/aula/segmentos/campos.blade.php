<div class="col-md-4">
    {!! Form::label('lblCiclo','Ciclo Escolar') !!}
    {!! Form::select('cicloescolar_id',$ciclos,null,['class'=>'form-control']) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblDocente','Docente') !!}
    {!! Form::select('docente_id',$docentes,null,['class'=>'form-control']) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblTurno','Turno') !!}
    {!! Form::select('turno_id',$turnos,null,['class'=>'form-control']) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblGrado','Grado') !!}
    {!! Form::select('grado_id',$grados,null,['class'=>'form-control']) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblGrupo','Grupo') !!}
    {!! Form::select('grupo_id',$grupos,null,['class'=>'form-control']) !!}
</div>