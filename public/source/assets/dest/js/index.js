switch(window.location.origin){
    case 'http://mobile.vn':
        var HOSTNAME = 'http://mobile.vn/';
        break;
    default:
        var HOSTNAME = 'http://localhost/mobile/';
}

function formatNumber(nStr, decSeperate, groupSeperate) {
	nStr += '';
	x = nStr.split(decSeperate);
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
	}
	return x1 + x2;
}

jQuery(document).ready(function(){
	jQuery('.add-to-cart').click(function(){
		var id = jQuery(this).data('id');
		var name = jQuery(this).data('name');
		var price = jQuery(this).data('price');
		var url = jQuery(this).data('url');
		var image = jQuery(this).data('image');
		var slug = jQuery(this).data('slug');
		jQuery.ajax({
            method: "get",
            url: url,
            data: {
                id : id, name : name, price : price, image : image, slug : slug
            },
            success: function(response){
                jQuery('.total-cart').text(response.count);
                var newContent = response.content;
                var html = '';
                jQuery.each(newContent, function (index, value) {
                	html 	+= '<div class="cart-item">'
            				+ '<div class="media">'
            				+ '<a class="pull-left" href="#">'
            				+ '<img src="' +HOSTNAME+ 'storage/app/products/'+ value.options.slug +'/'+ value.options.image +'" alt="">'
            				+ '</a>'
            				+ '<div class="media-body">'
            				+ '<span class="cart-item-title">'+ value.name +'</span>'
            				+ '<span class="cart-item-amount">'+ value.qty +' * <span>'+ formatNumber(value.price, '.', ',') +'</span>VND</span>'
            				+ '</div>'
            				+ '</div>'
            				+ '</div>';
                });
                // console.log(html);
                jQuery('.show-cart-content').html(html);
                jQuery('.cart-total-value').text(response.total);
            },
            error: function(jqXHR, exception){
                console.log(errorHandle(jqXHR, exception));
            }
        });
	});
});
