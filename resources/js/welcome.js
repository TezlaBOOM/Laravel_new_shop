$(function() {
    $('a#filter_button').click(function() {
        const form = $('form.sidebar-filter').serialize();
        $.ajax({
            method:"GET",
            url:"/",
            data:form
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
    });
    function getImage (product){

        if (!!product.image_path){
        return storagePath + product.image_path;
        }
        return defaultImage;
    }
});