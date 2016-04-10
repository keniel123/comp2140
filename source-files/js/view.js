/*$(window).load(
	function(){
		var id = [];
		var products = $('.single-shop-product');
		var index = 1
		products.each( function(indx,val){
			id[index - 1] = index;
			//pull from database
			$.get('shop.php', {func:'getImage',ID:index},function(data){ 
				products.find('img').attr('src',data);
			})			
			//pull from database
			$.get('shop.php', {func:'getName',ID:index},function(data){ 
				products.find("h2").html(data);
			})			
			//pull from database
			$.get('shop.php', {func:'getPrice',ID:index},function(data){ 
				products.find("ins").html(data);
			})
			$(this).find('a').attr('href',"view.php?ID="+index);					
		} )
	}
);*/

$(window).load(
	function(){
		$.get('shop1.php', {func:'getName'},function(data){ 
				$('.product-name').html(data);
		})	
		$.get('shop1.php', {func:'getPrice'},function(data){ 
				$('.product-inner-price').find('ins').html(data);
		})
		$.get('shop1.php', {func:'getDesc'},function(data){ 
				$('#home').find('p').html(data);
		})
		$.get('shop1.php', {func:'getImage'},function(data){ 
				$('.product-main-img').find('img').attr('src', data);
		})	
	}
);