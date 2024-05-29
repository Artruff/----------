function addToCart(id){
    console.log("add "+id);
    $.ajax({
		type: 'POST',
		async: false,
		url: "/php/cart.php",
		dataType: 'text',
		data: 'action=add&id='+id,
		success: function(responce){
				console.log("success add "+id);
			},
		error: function(){
				console.log("error add "+id);
			}
	});   
}

function delFromCart(id){
    console.log("delete "+id);
    $.ajax({
		type: 'POST',
		async: false,
		url: "/php/cart.php",
		dataType: 'text',
		data: 'action=del&id='+id,
		success: function(responce){
				showCart();
				console.log(responce);
			},
		error: function(){
				console.log("error delete "+id);
			}
	});  
}

function showCart(){
	console.log("load cart");
    $.ajax({
		type: 'POST',
		async: false,
		url: "/php/cart.php",
		dataType: 'text',
		data: 'action=show',
		success: function(responce){
				console.log("success load cart");
				$('#cartPanel').html(responce);
			},
		error: function(){
				console.log("error load cart");
			}
	});  
}

function conversionPrice(itemId){
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;
    var stringPrice = new Intl.NumberFormat("en-US",
                        { style: "decimal",
                          minimumFractionDigits: 2 });

    $('#total_price_' + itemId).html("Итого:<br>"+stringPrice.format(itemRealPrice)+" р.");
}

function makeOrder(ids){
	var Cnt = new Array();
	ids.forEach(element => 
		{
			Cnt.push([element, $('#itemCnt_' + element).val()]);
			console.log(element);
			console.log($('#itemCnt_' + element).val());
		});

	$.ajax({
    type: "POST",
    url: "/php/order.php",
    data: {Cnt: Cnt},
    dataType: "json",
    success: function(data) {
      console.log('success order');
      $('#cartPanel').html(data);
    },
    error: function(data) {
      console.log('error order');
    }
  });
}