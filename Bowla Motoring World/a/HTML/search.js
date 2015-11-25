<script>

$(document).ready(function(){
    $('#Search_Product').keyup(function(){
        $.post("single-product.php",
        {
                name: $("#Search_Product").val()
                ///alert( $("#Search_Product").val())
        },
        function(data,status){
            alert(data);
            $("#Search_Product").append('<li>'+name+'</li>');
        });
    });
});
</script>