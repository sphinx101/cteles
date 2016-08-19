(function($){
   $(document).on('ready',function(){


      var alumno_id='';
      $frmEdit=$('#frmEdit');





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

          $.ajaxSetup({


             headers: {
                  'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
              }
          });

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

                     var tutor = 'Sin registrar';
                     if (data.nombretutor != null)
                         tutor = data.nombretutor + ' ' + data.aptutor + ' ' + data.amtutor;


                     tr = '<tr id="alumno' + data.id + '">' +
                         '   <td>' + data.id + '</td>' +
                         '   <td>' + data.nombre + ' ' + data.appaterno + ' ' + data.apmaterno + '</td>' +
                         '   <td>' + data.curp + '</td>' +
                         '   <td>' + data.domicilio + '</td>' +
                         '   <td>' + data.localidad + '</td>' +
                         '   <td><a href="#"><span>' + tutor + '</span></a></td>';
                      tr+='<td>' +
                             '<button type="button" class="btn btn-primary btn-xs btnEdit" data-toggle="modal" data-target="#myModal" data-alumno_id="' + data.id + '"><i class="material-icons">mode_edit</i></button>';
                      tr+='<button class="btn btn-danger btn-xs btnDeleteSubmit btnDelete" data-alumno_id="'+data.id +'" type="button"><i class="material-icons">delete_forever</i></button></td></tr>';


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

      $(document).on('click','.btnDeleteSubmit',function(e){
          e.preventDefault();
          alumno_id=$((this)).data('alumno_id');

          alert('clave alumno: '+alumno_id);
      });

   });
})(jQuery);