$(document).on("ready",function(){

    /**
     * Add new row from ajax
     */
     var i = 1;
    $("#add-new").on("click", function(e){
        e.preventDefault();
        $(".no-available").hide();

        $.ajax({
            url: location.pathname,
            method: 'GET',
            dataType: 'json'
        }).error(function(error) {
            console.log(error);
        }).done(function(data) {
            $(".table--dynamic tbody").append("<tr><td>"+ (i++) +"</td><td>"+data.random_alpha+"</td><td>"+data.random_numeric+"</td><td>"+data.random_alnum+"</td><td><button class='btn btn-danger btn-xs remove'><i class='fa fa-trash-o'></i> Remove</button></td></tr>");
        });
    });

    /**
     * Remove current row
     */
    $(document).on("click", ".remove", function(e){
        e.preventDefault();
        $(this).parent().parent().remove();

        if($(".table--dynamic > tbody > tr").length == 1){
            $(".no-available").show();
        }
    });

});
