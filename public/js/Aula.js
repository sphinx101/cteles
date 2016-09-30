(function($){
    $(document).on('ready',function(){
        var aula_id;
        var nombre_docente='';
        $modalDelete=$('#modalDelete');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });
        $(document).on('click','.btnDelete',function(){
           aula_id=($(this)).data('aula_id');
           nombre_docente=($(this)).data('nombre_docente');
           grado=($(this)).data('grado');
           grupo=($(this)).data('grupo');
           turno=($(this)).data('turno');
           ciclo=($(this)).data('ciclo');
           $lblPregunta=$('#lblPregunta');

           var pregunta='¿ Esta seguro que desea eliminar al DOCENTE '+nombre_docente+
                        ' de GRADO '+grado+
                        ' GRUPO '+grupo+
                        ' del TURNO '+turno+
                        ' correspondiente al CICLO ESCOLAR ?'+ciclo;
           $lblPregunta.text(pregunta);
        });
        $(document).on('click','.btnDeleteSubmit',function(e){
            e.preventDefault();
            $.ajax({
                url:'/escuela/aulas/ajax/'+aula_id,
                type:'DELETE',
                datatype:'json',
                success:function(data){
                    $modalDelete.modal('hide');
                    toastr.info(data.mensaje);
                    $('#aula'+aula_id).remove();
                },
                error:function(xhr){
                    $modalDelete.modal('hide');
                    var errors = jQuery.parseJSON(xhr.responseText);
                    var errorsHtml = '';
                    console.log(errors);
                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    toastr.error(errorsHtml, 'Error');
                }
            })
        });
    });
})(jQuery);
