$(function(){
    console.log('chujokurwachuj');
    $('.delete').click(function() {
      Swal.fire({
        title:confirmDelete,
        icon:'warning',
        showCancelButton:'true',
        confirmButtonText:'Tak',
        cancelButtonText:'Nie'
      }).then((result)=>{
          if(result.value){
            
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                method: "DELETE",
                url: deleteURL + $(this).data("id"),
                data: { id: $(this).data("id") }
              })
              .done(function( data) {
                window.location.reload();
              })
              .fail(function(data) {
                Swal.fire('Oops...', data.responseJSON.message, data.responseJSON.status);
              }); 
     
            
          }
      })
    })
  });