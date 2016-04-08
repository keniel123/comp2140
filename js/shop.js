$(window).load(
	function(){
		/*products.each( 
			function(indx,val){
				$.get('shop.php', {func:'getImage',ID:index},function(data){ 
					alert(index);
					products.find('img').attr('src',data);
				})			
					//pull from database
				$.get('shop.php', {func:'getName',ID:index},function(data){ 
					products.find("h2").html(data);
				})			
					//pull from database
				$.get('shop.php', {func:'getPrice',ID:index},function(data){ 
					//products.find("ins").html(data);
				})	
				$(this).find('a').attr('href',"view.php?ID="+index);
			}
		)*/
		$(".single-shop-product").each(function(index,val){
			x=index+1;
			$.get('shop2.php', {func:'getImage',ID:x},function(data){ 
				$(val).find('img').attr('src',data);
			})
			$.get('shop2.php', {func:'getName',ID:x},function(data){ 
				$(val).find("h2").html(data);
			})
			$.get('shop2.php', {func:'getPrice',ID:x},function(data){ 
				$(val).find("ins").html(data);
			})
			$(val).find("a").attr('href',"view.php?ID="+x);					
		});
	}
);