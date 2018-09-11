$(document).ready(function(){
	$('.btn-remove').click(function(){
		var id = $(this).data('id');
		var url = $(this).data('url');
		if(confirm('Chắc chắn xóa?')){
             $.ajax({
                method: "get",
                url: url,
                success: function(response){
                	if(response.status == 200 && response.isExist === true){
                		$('.row-' + id).fadeOut();
                	}
                	if(response.status == 200 && response.isExist === false && response.message != ''){
                		alert(response.message);
                	}
                },
                error: function(jqXHR, exception){
                    console.log(errorHandle(jqXHR, exception));
                }
            });
        }
	})
})