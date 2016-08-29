(function($){
   $(document).on('ready',function(){


      var alumno_id='';
      $frmEdit=$('#frmEdit');


       $.ajaxSetup({


           headers: {
               'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
           }
       });



      $(document).on('click','.btnEdit',function(){

          alumno_id=($(this).data('alumno_id'));

          $.ajax({
              url:'/escuela/alumnos/ajax/edicion/'+alumno_id,
              type:'GET',
              datatype: 'json',

              success:function(data){

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

          $.ajax({
              url:'/escuela/alumnos/ajax/edicion/'+alumno_id,
              type: 'PATCH',
              data: $frmEdit.serialize(),
              datatype: 'json',
              beforeSend:function(xhr){

              },
              success:function(data){
                //console.log(data);

                 if(data.status=='1') {

                     var ahref='';
                     if(data.padretutores.length>0) {
                         $.each(data.padretutores, function (key, obj) {
                             ahref+='<a href=/escuela/tutor/'+obj.id+'><i class="material-icons">face</i><span>'+obj.nombre+' '+obj.appaterno+' '+obj.apmaterno+'</span></a></br></br>';
                         });

                     }else{
                            ahref='<a href="/escuela/tutor/create"><i class="material-icons">add_circle</i><span> Sin registrar</span></a>';
                     }
                    // console.log(ahref);
                     tr = '<tr id="alumno' + data.id + '">' +
                         '   <td>' + data.id        + '</td>' +
                         '   <td>' + data.nombre    + ' '     + data.appaterno + ' ' + data.apmaterno + '</td>' +
                         '   <td>' + data.curp      + '</td>' +
                         '   <td>' + data.domicilio + '</td>' +
                         '   <td>' + data.localidad + '</td>' +
                         '   <td>' + ahref          + '</td>';
                      tr+='<td>' +
                          '<button type="button" class="btn btn-primary btn-xs btnEdit"   data-toggle="modal" data-target="#myModal"  data-alumno_id="' + data.id + '"><i class="material-icons">mode_edit</i></button>';
                      tr+='<button type="button" class="btn btn-danger btn-xs  btnDelete" data-toggle="modal" data-target="#myModal2" data-alumno_id="'+data.id +'" data-alumno_nombre="'+data.nombre+'" data-alumno_app="'+data.appaterno+'" data-alumno_apm="'+data.apmaterno+'"><i class="material-icons">delete_forever</i></button></td></tr>';


                     $('#alumno' + alumno_id).replaceWith(tr);
                     $frmEdit[0].reset();
                     $('#myModal').modal('hide');

                 }
                 toastr.success(data.mensaje,'Aviso');


              },
              error:function(xhr){

                  if(xhr.status==422) {
                      var errors = jQuery.parseJSON(xhr.responseText);
                      var errorsHtml = '';
                      console.log(errors);
                      $.each(errors, function (key, value) {
                          errorsHtml += '<li>' + value + '</li>';
                      });
                      toastr.error(errorsHtml, 'Error ');
                  }
              }
          });



      });

      $(document).on('click','.btnDelete',function(){
         alumno_id=($(this)).data('alumno_id');
         $lblPregunta=$('#lblPregunta');

         var pregunta='¿ Esta seguro que desea eliminar al alumno '
                      +($(this)).data('alumno_nombre')+' '
                      +($(this)).data('alumno_app')+' '
                      +($(this)).data('alumno_apm')+' ?'
         $lblPregunta.text(pregunta);
      });
      $('.btnDeleteSubmit').on('click',function(e){
           e.preventDefault();

          $.ajax({
               url: '/escuela/alumnos/'+alumno_id,
               type: 'DELETE',
               datatype: 'json',
               success:function(data){


                   $('#myModal2').modal('hide');
                   toastr.info('ID: '+data.id+' '+data.mensaje,'Aviso');
                   $('#alumno' + alumno_id).remove();

               },
               error:function(xhr){
                   var errors = jQuery.parseJSON(xhr.responseText);
                   var errorsHtml = '';
                   console.log(errors);
                   $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                   });
                   toastr.error(errorsHtml, 'Error');
               }
          });
      });

   });
})(jQuery);