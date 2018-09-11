// Product management
window.onload = function(){
    var url = window.location.origin + '/mobile/';
    var url_admin = window.location.origin + '/mobile/admin/';
    // is_discount unchecked by default
    // so we need to disable 2 discount fields too
    // but enable in edit mode, and discount checkbox checked before
    if($('#is_discount').is(':checked')){
        $("#discount_percent").prop('disabled', false);
        $("#discount_price").prop('disabled', false);
    }else{
        $("#discount_percent").prop('disabled', true);
        $("#discount_price").prop('disabled', true);
    }

    // if($('#is_gift').is(':checked')){
    //     $("#gift").prop('disabled', false);
    // }else{
    //     $("#gift").prop('disabled', true);
    // }

    // enable 2 discount fields when is_discount checked, disable again when is_discount uncheck
    $('#is_discount').change(function(){
        if($(this).is(':checked')){
            $("#discount_percent").prop('disabled', false);

            $("#discount_price").prop('disabled', false);
        }else{
            $("#discount_percent").val('');
            $("#discount_percent").prop('disabled', true);

            $("#discount_price").val('');
            $("#discount_price").prop('disabled', true);
        }
    });

    $('.template_id').change(function(){
        var template_id = $(this).val();
        
        $.ajax({
            url: url_admin + 'product/fetchByTemplate/{template_id}',
            method: 'GET',
            data: {
                template_id : template_id
            },
            success: function(res){
                var template = res.template;
                console.log(template);
                $('.template-content').html('');
                var new_content = '';
                $.each(template.content, function(key, value){
                    var content =  '<div class="form-group col-md-12">'+
                                    '<label for="name" class="col-md-12 control-label">'+ value +'</label>'+
                                    '<div class="col-md-12">'+
                                        '<input type="text" class="form-control" name="template_content[]" value="">'+
                                    '</div>'+
                                '</div>';
                    new_content += content;
                });
                $('.template-content').html(new_content);
                
                
                // res.trademarks
            },
        })
    });

    $('.remove-image').click(function(){
        var check = $(this);
        var image = $(this).data('image');
        var id = $(this).data('id');
        var token = $('#token').val();
        $.ajax({
            url: url + '/hamruouthinh24/admin/product/deleteImage',
            method: 'POST',
            data: {
                image : image, id : id, _token : token
            },
            success: function(res){
                check.parent('div').fadeOut();
                console.log(res.image_json);
            },
        })
    });

}


$('.price_shared').on('input', function(e){        
        $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
    }).on('keypress',function(e){
        if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
    }).on('paste', function(e){    
        var cb = e.originalEvent.clipboardData || window.clipboardData;      
        if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
    });
    function formatCurrency(number){
        var n = number.split('').reverse().join("");
        var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
        return  n2.split('').reverse().join('');
    }
    
    $('.price_shared').each(function(e){        
        $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
    }).on('keypress',function(e){
        if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
    }).on('paste', function(e){    
        var cb = e.originalEvent.clipboardData || window.clipboardData;      
        if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
    });
    function formatCurrency(number){
        var n = number.split('').reverse().join("");
        var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
        return  n2.split('').reverse().join('');
    }
