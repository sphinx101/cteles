

        <div class="form-group">
            {!! Form::label('lblrfc','RFC',array('class'=>'sr-only')) !!}
            {!! Form::text('rfc',null,array('class'=>'form-control','id'=>'lblrfc','placeholder'=>'Introduce tu RFC')) !!}
        </div>



        <div class="form-group">
            {!! Form::label('lblcurp','CURP',array('class'=>'sr-only')) !!}
            {!! Form::text('curp',null,array('class'=>'form-control','id'=>'lblcurp','placeholder'=>'Introduce tu CURP')) !!}
        </div>



        <div class="form-group">
            {!! Form::label('lblNombre','Nombre',array('class'=>'sr-only')) !!}
            {!! Form::text('nombre',null,array('class'=>'form-control','id'=>'lblNombre','placeholder'=>'Introduce tu Nombre')) !!}
        </div>



        <div class="form-group">
            {!! Form::label('lblPaterno','Paterno',array('class'=>'sr-only')) !!}
            {!! Form::text('appaterno',null,array('class'=>'form-control','id'=>'lblPaterno','placeholder'=>'Introduce tu Apellido Paterno')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('lblMaterno','Materno',array('class'=>'sr-only')) !!}
            {!! Form::text('apmaterno',null,array('class'=>'form-control','id'=>'lblMaterno','placeholder'=>'Introduce tu Apellido Materno')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('lblCelular','Celular',array('class'=>'sr-only')) !!}
            {!! Form::text('celular',null,array('class'=>'form-control','id'=>'lblCelular','placeholder'=>'Introduce tu Numero Celular')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('lblTelefono','Telefono',array('class'=>'sr-only')) !!}
            {!! Form::text('telefono',null,array('class'=>'form-control','id'=>'lblTelefono','placeholder'=>'Introduce tu No. Tel. Particular')) !!}
        </div>

        <input type="hidden" name="actualizado" value="1">



