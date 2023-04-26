$(function() {
    $('div.product-count a').click(function(event) {
        event.preventDefault();
        $('a.product-actual-count').text($(this).text());
        getProducts($(this).text());
    });


    $('a#filter_button').click(function(event) {
        event.preventDefault();
        getProducts($('a.product-actual-count').first().text());
    });

    $('button.add-cart-button').click(function(event) {
        event.preventDefault();
        $.ajax({
            metod:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, 
            url: "cart/" + $(this).data('id'),
        })
        .done(function(response) {
            Swal.fire({
                title:'Sukces',
                text:'Produkt dodany do koszyka!',
                icon:'success',
                showCancelButton:'true',
                confirmButtonText:'<i class ="fas fa-cart-plus"></i> Przejdź do koszyka',
                cancelButtonText:'<i class="fas fa-shopping-bag"></i> Kontynuj zakupy'
              }).then((result)=>{
                  if(result.isConfirmed){
                    
                    
                   window.location = "cart";
                  }
              })
        })
        .fail(function(data) {
            Swal.fire('Oops...', 'Wystąpił błąd', 'error');
          }); 
    });

    function getProducts(paginate){
        const form = $('form.sidebar-filter').serialize();
        $.ajax({
            method:"GET",
            url:"/",
            data:form + "&" + $.param({paginate: paginate})
        })
        .done(function(response){
           $('div#products-wrapper').empty();
           $.each(response.data, function (index, product){
            const html = '<div class="col-6 col-md-6 col-lg-4 mb-3">' +
                          ' <div class="card h-100 border-0">' +
                          '  <div class="card-img-top">' +
                          '     <img src="'+ getImage(product) +'" class="img-fluid mx-auto d-block" alt="Card image cap">   ' + 
                          '  </div>' +
                          '  <div class="card-body text-center">' +
                          '         <h4 class="card-title">' +
                                       product.name  +   
                          '         </h4>' +
                          '     <h5 class="card-price small">' +
                          '     <i>PLN' + product.price + '</i>' +
                          '     </h5>' +
                          ' </div>' +
                          ' </div>' +
                        '</div>';
                $('div#products-wrapper').append(html);
           });
        })
        .fail(function(date){
            alert("ERROR");
        });
    }


    function getImage (product){

        if (!!product.image_path){
        return WELCOME_DATA.storagePath + product.image_path;
        }
        return WELCOME_DATA.defaultImage;
    }
});