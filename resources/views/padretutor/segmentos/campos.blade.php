<div class="col-md-4">
    {!! Form::label('lblNombre','Nombre') !!}
    {!! Form::text('nombre',$tutor->nombre,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblPaterno','A. Paterno') !!}
    {!! Form::text('appaterno',$tutor->appaterno,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblMaterno','A. Materno') !!}
    {!! Form::text('apmaterno',$tutor->apmaterno,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblParentesco','Parentesco') !!}
    {!! Form::text('parentesco',$tutor->parentesco,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblTelefono','Telefono') !!}
    {!! Form::text('telefono',$tutor->telefono,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblCelular','Celular') !!}
    {!! Form::text('celular',$tutor->celular,array('class'=>'form-control',$campo_desactivado)) !!}
</div>

<div class="col-md-12">
    {!! Form::label('lblDomicilio','Domicilio') !!}
    {!! Form::text('domicilio',$tutor->domicilio,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblLocalidad','Localidad') !!}
    {!! Form::text('localidad',$tutor->localidad,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblOcupacion','Ocupacion') !!}
    {!! Form::text('ocupacion',$tutor->ocupacion,array('class'=>'form-control',$campo_desactivado)) !!}
</div>
<div class="col-md-4">
    {!! Form::label('lblEscolaridad','Escolaridad') !!}
    {!! Form::text('escolaridad',$tutor->escolaridad,array('class'=>'form-control',$campo_desactivado)) !!}
</div>