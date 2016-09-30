@include('partials.modalOpenDelete')
{!! Form::open(['role'=>'form','method'=>'DELETE','id'=>'frmBorrar']) !!}
{!! Form::label('',null,['id'=>'lblPregunta']) !!}
@include('partials.modalCloseDelete')