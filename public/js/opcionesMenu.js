$(document).ready(function(){
    $.ajax({
        url:'http://cteles.local/existeDocente',
        type:'GET',
        dataType:'json',
        success:function(data){
            var lnkActualizar=$('#lnkActualizar');
            var lnkRegistrar=$('#lnkRegistrar');

            if(data['existe']){
                lnkRegistrar.hide();
            }else{
                lnkActualizar.hide();
            }

        },
        error:function(data){
            alert('error: '+ ' '+data);
        }
    });




});