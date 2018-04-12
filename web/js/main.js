/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};
	$('.accordion').dcAccordion({
		speed:300
	});
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
function showCart(cart){
	$("#cart .modal-body").html(cart);
	$("#cart").modal();
}

function getCart(){
	$.ajax({
		url: '/cart/show',
		type: 'GET',
		success: function(res){
			if(!res){
				alert('Ошибка, такого товара не существует');
			}
			//console.log(res);
			showCart(res);
		},
		error: function(){
			alert('Error');
		}
	});
	return false;
}
function del(x){
	var id = x;
	$.ajax({
		url: '/cart/del',
		data: {id: id},
		type: 'GET',
		success: function(res){
			if(!res){
				alert('Ошибка, такого товара не существует');
			}
			//console.log(res);
			showCart(res);
		},
		error: function(){
			alert('Error');
		}
	});
}


function clearCart(){
	$.ajax({
		url: '/cart/clear',
		type: 'GET',
		success: function(res){
			if(!res){
				alert('Ошибка, такого товара не существует');
			}
			//console.log(res);
			showCart(res);
		},
		error: function(){
			alert('Error');
		}
	});
	return false;
}
$('.add-to-cart').on('click', function(e){
	e.preventDefault();
	var id = $(this).attr('data-id');
	var qty = $(".qty").val();
	
	$.ajax({
		url: '/cart/add',
		data: {id: id, qty: qty},
		type: 'GET',
		success: function(res){
			console.log(qty);
			if(!res){
				alert('Ошибка, такого товара не существует');
			}
			//console.log(res);//
			showCart(res);
		},
		error: function(){
			alert('Error');
		}
	});
});

	/* $('.cart_quantity_up').on('click', function(e){
		e.preventDefault();		
		var id = $(this).attr('data-id');
		var $parent = $(this).parent().find('input');
		var plus = $parent.val(parseInt($parent.val()) +1);
		var qty = $parent.val();
		var tot = $(this).closest('.cart_prices').children('.cart_total').find('.cart_total_price');
		var $price = $(this).closest('.cart_prices').children('.cart_price').first().text();
		var pr = parseInt($price);
		console.log(pr);
		$.ajax({
			url: '/cart/plus',
			type: 'GET',
			data: {qty: qty, id: id, pr: pr},
			success: function(res){
				tot.html(res);
				//var obj = JSON.parse(res);
				//tot.html(res);
				console.log(tot);
			},
			
			error: function(){
				alert('Error');
			}
		}); 
	}); */

	$('.cart_quantity_down').on('click', function(e){
		e.preventDefault();		
		var id = $(this).attr('data-id');
		var $parent = $(this).parent().find('input');
		var count = parseInt($parent.val()) - 1;
		count = count < 1 ? 1 : count;
		$parent.val(count);
		$parent.change();
		return false;
	});	
			

