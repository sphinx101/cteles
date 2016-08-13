(function($){
   $(document).on('ready',function(){
      var url_edit='';
      var alumnoJSON='';
      var alumno_id='';
      $frmEdit=$('#frmEdit');





      $('.btnEdit').on('click',function(e){
          e.preventDefault();
          alumno_id=($(this).data('alumno_id'));

          $.ajax({
              url:'/escuela/alumnos/ajax/edicion/'+alumno_id,
              type:'GET',
              datatype: 'json',

              success:function(data){
                 //console.log(data);
                 /*var alumno=[
                     {'id':'data.id',
                     'centrotrabajo_id':data.centrotrabajo_id,
                     'nombre':data.nombre,
                     'curp':data.curp,
                     'appaterno':data.appaterno,
                     'apmaterno':data.apmaterno,
                     'localidad':data.localidad,
                     'domicilio':data.domicilio}
                 ];
                 alumnoJSON=JSON.stringify(alumno);*/
                 $('.lblcurp').val(data.curp);
                 $('.lblnombre').val(data.nombre);
                 $('.lblpaterno').val(data.appaterno);
                 $('.lblmaterno').val(data.apmaterno);
                 $('.lbllocalidad').val(data.localidad);
                 $('.lbldomicilio').val(data.domicilio);
              }
          });


      });

      $('.btnEditSubmit').on('click',function(e){
          e.preventDefault();

          /*$.ajaxSetup({


             headers: {
                  'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
              }
          });*/

          $.ajax({
              url:'/escuela/alumnos/ajax/edicion/100',
              type: 'PATCH',
              data: $frmEdit.serialize(),
              datatype: 'json',
              beforeSend:function(xhr){

              },
              success:function(data){
                    alert(data.mensaje);
              }
          });



      });

   });
})(jQuery);