	function loadProducts(){
		var data = {};
		$.ajax({
			type: 'POST',
			url: 'product.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchProducts(data);
			}
		});
	}

	function loadProductsPage(page){
		var data = {product_page:page};
		$.ajax({
			type: 'POST',
			url: 'product.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchProducts(data);
			}
		});
	}

	$(document).on('click', '.search', function(){
		var data = {name:$('.search-item').val()};
		$.ajax({
			type: 'POST',
			url: 'product.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchProducts(data);
			}
		});
	});

	$(document).on('keyup', '.search-item', function(){
		$('.search').trigger('click');
	});

	$(document).on('click', '.reset', function(){
		$('.search-item').val('');
		loadProducts();
	});

	function fetchProducts(data){
		$('.product_list').html('');
		data.products.forEach(p => {
			$('.product_list').append(`<div class="col-md-3">
				<div href="#" class="card card-product-grid">
					<a href="#" class="img-wrap"> <img alt="${p.name}" id="image_${p.ref_product}" src="${p.image}"> </a>
					<figcaption class="info-wrap">
						<span class="title" id="name_${p.ref_product}">${p.name}</span>
						<div class="btn btn-sm btn-block btn-outline-warning buy text-center" style="margin-top: 6px;" onclick="addToCart(${p.ref_product})">
							<span class="price text-left" style="color:#d2b44ce3; " id="price_${p.ref_product}">$${p.price}</span>
							Buy Now
						</div>
					</figcaption>
				</div>
			</div>`);
		});
		$('.product-pagination').html('');
		for(var j=0;j<Number(data.count)/8;j++){
			$('.product-pagination').append(`<li class="page-item"><a class="page-link" onclick="loadProductsPage(${j})">${j+1}</a></li>`);
		}
	}
	
	$(document).on('click', '#filter', function(){
		var data = { 
						min_price:$('[name="min_price"]').val(),
						max_price:$('[name="max_price"]').val()
					};

		console.log(data);
		$.ajax({
			type: 'POST',
			url: 'product.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchProducts(data);
			}
		});
	});

	$(document).on('click', '.category', function(e){
		var data = { idCat:$('input', this).val()};
		$.ajax({
			type: 'POST',
			url: 'product.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchProducts(data);
			}
		});
	});

    function addToCart(ref){
        var rawPrice = $('#price_'+ref).html();
        var data = { 
            ref:ref,
            name:$('#name_'+ref).html(),
            price:rawPrice.slice(1,rawPrice.length),
            image:$('#image_'+ref).attr('src')
        };
		showCartBadge(data);
    }

	function showCartBadge(data){
		$.ajax({
			type: 'POST',
			url: 'cart.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				$('#cart_badge').html(data);
			}
		});
	}

	function loadCategories(){
		var data = {};
		$.ajax({
			type: 'POST',
			url: 'category.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchCategories(data);
			}
		});
	}

	function loadCategoriesPage(page){
		var data = {category_page:page};
		$.ajax({
			type: 'POST',
			url: 'category.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchCategories(data);
			}
		});
	}

	function fetchCategories(data){
		$('.category_list').html('');
		data.categories.forEach(c => {
			$('.category_list').append(`<li class="category">
					<input type="hidden" value="${c.cat_id}">
					<a href="#">${c.name} <span class="badge badge-light">${c.count}</span></a>
				</li>`);
		});
		$('.category_list').append(`
			<ul style="padding: 9px;font-weight: bold;font-size: 12px;" class="pagination pagination-lg d-flex justify-content-between category-pagination">
			</ul>`);

		$('.category-pagination').html('');
		for(var i=0;i<data.count/16;i++){
			$('.category-pagination').append(`
				<li><a onclick="loadCategoriesPage(${i})">${i+1}</a></li>
			`);
		}
	}

	$(document).on('click', '#showCart', function(){
		var data = {action:'showCart'};
		$.ajax({
			type: 'POST',
			url: 'cart.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchCartItems(data);
			}
		});
	});

	function fetchCartItems(data){
		$('#modal1').html('');
		$('#modal1').append(`
			<div class="modal-dialog" role="document" style="max-width:720px !important;">
				<div class="modal-content">	
					<div class="modal-header">
						<h2 class="title-page">Shopping cart</h2>
					</div>
					<div class="modal-body">
						<section class="section-content padding-y">
							<div class="container">
								<div class="row">
									<main class="col-md-9">
										<div class="card">
											<table class="table table-borderless table-shopping-cart">
												<thead class="text-muted">
													<tr class="small text-uppercase">
														<th scope="col">Product</th>
														<th scope="col" width="120">Quantity</th>
														<th scope="col" width="120">Price</th>
														<th scope="col" class="text-right" width="200"> </th>
													</tr>
												</thead>
												<tbody class="card-tbody">
												</tbody>
											</table>
											<div class="card-body border-top">
												<div class="init-purchase">
													
												</div>
												<a href="#" class="btn btn-success" data-dismiss="modal">
													<i class="fa fa-chevron-left"></i> Continue shopping 
												</a>
											</div>
										</div>
									</main>
									<aside class="col-md-3">
										<div class="card">
											<div class="card-body">
												<dl class="dlist-align">
													<dt>Total:</dt>
													<dd class="text-right h5"><strong class="total-price"></strong></dd>
												</dl>
												<hr>
												<p class="text-center mb-3">
													<img src="images/payement_methods.png" width="116px" height="85px">
												</p>
											</div>
										</div>
									</aside>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>`);	

		data.forEach((order) => {
			Object.entries(order).forEach(([ref, details]) => {
			$('.card-tbody').append(`
				<tr class="tr_${ref}">
					<td>
						<figure class="itemside">
							<div class="aside"><img src="${details['image']}" class="img-xs"></div>
						</figure>
					</td>
					<td>
						<input class="form-control form-control-sm" type="number" min="1" value="${Number(details['quantity'])}" name="quantity">
					</td>
					<td>
						<div class="price-wrap">
							<input type="hidden" name="price" value="${Number(details['price'])}"/>
							<var class="price">$${Number(details['price'])}</var>
						</div>
					</td>
					<td class="text-right">
						<span class="btn btn-sm btn-outline-danger btn-round" onclick="deleteCartItem(this, ${ref})"> Remove</span>
					</td>
				</tr>`);
			});
		});
		calculeTotalPrice();
		checkLoggedClient();
	}

	function calculeTotalPrice(){
		var totalPrice = 0;
		$('.card-tbody tr').each(function(){
			var price = $("[name='price']", this).val();
			var quantity = $("[name='quantity']", this).val();
			totalPrice += price*quantity;
		});
		$('.total-price').html('$'+totalPrice.toFixed(2));
	}

	function checkLoggedClient(){
		var data = {action:'getClientSession'};
		$.ajax({
			type: 'POST',
			url: 'client.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				$('.init-purchase').html('');
				if(data == 'KO'){
					$('.init-purchase').append(`
					<a href="#" class="btn btn-warning float-md-right" id="signin" style="color:white;"> Signin to Make Purchase 
						<i class="fa fa-chevron-right"></i> 
					</a>`);
				}else{
					$('.init-purchase').append(`
					<a href="#" class="btn btn-warning float-md-right" id="purchase"> Make Purchase 
						<i class="fa fa-chevron-right"></i> 
					</a>
					<input type="hidden" name="id_client" value="${data.id_client}">
					`);
				}
			}
		});
	}
	
	$(document).on('click', "#purchase", function(){
		var data = {action:'makePurchase'};
		$.ajax({
			type: 'POST',
			url: 'cart.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				showCartBadge();
			}
		});
	});

	$(document).on('change', "[name='quantity']", function(){
		calculeTotalPrice();
	});

	function deleteCartItem(e, ref){
		var data = {action:'deleteItem', ref:ref};
		$('.tr_'+ref).remove();
		$.ajax({
			type: 'POST',
			url: 'cart.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				fetchCartItems(data);
			}
		});
	}

	$(document).on('click', "#purchase", function(){
		var data = {};
		$.ajax({
			type: 'POST',
			url: 'cart.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				$('#modal1').html('');
				$('#modal1').append(`
				<div class="modal-dialog" role="document" style="width:720px !important;">
					<div class="modal-content">	
						<div class="container" style="width: 501px;">
							<div class="card mx-auto" style="margin-top:40px;margin: 10px;"">
								<div class="card text-center">
									<div class="card-header">
										Abderrahim Machlou
									</div>
									<div class="card-body">
										<h5 class="card-title">Thank you!</h5>
										<p class="card-text"></p>
										<a href="#" class="btn btn-primary" data-dismiss="modal">
											<i class="fa fa-home" style="color:white;"></i> Continue shopping 
										</a>
									</div>
									<div class="card-footer text-muted">
										abderrahim@machlou.dwm
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>`);
			}
		});
	});
	
	
	function init_signin(){
		$('#modal1').html('');
		$('#modal1').append(`
				<div class="modal-dialog" role="document" style="width:720px !important;">
					<div class="modal-content">	
						<div class="container" style="width: 469px;">
					<div class="card mx-auto" style="margin-top:40px;margin: 10px;"">
						<article class="card-body">
							<header class="mb-4">
								<h4 class="card-title text-center">Sign up</h4>
							</header>
							<form id="signin-form" method="POST">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" required name="signin_email" maxlength="50" placeholder="name@exemple.com">
								</div>
								<div class="form-group">
									<label>password</label>
									<input class="form-control" type="password" required name="signin_password" placeholder="*********">
								</div>
								<div class="form-group">
									<a href="#" class="btn btn-success btn-block signin" style="text-decoration: none;"> Sign in </a>
								</div>
							</form>
							<p class="text-center mt-4">
								Don't have account? 
								<a href="#" style="color:blue;" id="register">Register</a>
							</p>
							<div class="signin-status">
								
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>`);
	}

	$(document).on('click', '#signin', function(){
		init_signin();
	});

	function init_register(){
		$('#modal1').html(''); 
		$('#modal1').append(`
		<div class="modal-dialog" role="document" style="width:469 !important;">
			<div class="modal-content">	
				<div class="container">
			<div class="card mx-auto" style="width: inherit;margin: 10px;">
				<article class="card-body">
					<header class="mb-4">
						<h4 class="card-title text-center">Register</h4>
					</header>
					<form id="register-form" method="POST" action="client.php">
					<input type="hidden" name="action" value="register">
						<div class="form-row">
							<div class="col form-group">
								<label>First name</label>
								<input type="text" class="form-control" required name="first_name" maxlength="25" placeholder="First name">
							</div>
							<div class="col form-group">
								<label>Last name</label>
								<input type="text" class="form-control" required name="last_name" maxlength="25" placeholder="Last name">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Email</label>
								<input type="email" class="form-control" required name="email" maxlength="50" placeholder="name@exemple.com">
							</div>
							<div class="form-group col-md-6">
								<label>Birth day</label>
								<input class="form-control" type="date" required name="birth_day">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Phone</label>
								<input type="text" name="phone" required class="form-control" placeholder="Phone">
							</div>
							<div class="form-group col-md-8">
								<label>Address</label>
								<input type="text" name="address" required class="form-control" placeholder="Your shipping address here">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Create password</label>
								<input class="form-control" type="password" required name="password" placeholder="*********">
							</div>
							<div class="form-group col-md-6">
								<label>Repeat password</label>
								<input class="form-control" type="password" required name="comfirm_password" placeholder="*********">
							</div>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-success btn-block" value="Register"/b>
						</div>
					</form>
					<p class="text-center mt-4">
						I have an account!
						<a href="#" style="color:blue;" id="signin">Sign In</a>
					</p>
				</article>
			</div>
		</div>`);
	}

	$(document).on('click', '#register', function(){
		init_register();
	});

	function refreshUserSession(){
		var data = {action:'getClientSession'};
		$.ajax({
			type: 'POST',
			url: 'client.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				$('.user-div').html('');
				if(data == 'KO'){
					$('.user-div').append(`
					<div class="text">
						<div>
							<a href="#" id="signin" type="button" data-toggle="modal" data-target="#modal1">Sign in</a> |
							<a href="#" id="register" type="button" data-toggle="modal" data-target="#modal1">Register</a> 
						</div>
					</div>`);
				}else{
					$('.user-div').append(`
					<div class="text">
						<span class="text-muted">${data.first_name}</span>
						<div>
							<a href="#"></a>
							<a href="#" id="signout">Sign out</a>
						</div>
					</div>`);
				}
			}
		});
	}

	$(document).on('click', '#signout', function(){
		var data = {action:'signout'};
		$.ajax({
			type: 'POST',
			url: 'client.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				refreshUserSession();
			}
		});
	});

	$(document).on('click', '.signin', function(){
		var data = {
						action:'signin',
						email:$('[name="signin_email"]').val(),
						password:$('[name="signin_password"]').val()
					};

		$.ajax({
			type: 'POST',
			url: 'client.php',
			data: data,
			dataType: 'json',
			async: true,
			success: function (data) {
				$('.signin-status').html('');
				console.log(data.status);
				if(data.status == 'OK'){
					$('#modal1').hide();
					$(".modal-backdrop").remove();
					refreshUserSession();
				}else{
					$('.signin-status').append(`
					<div class="alert alert-danger" role="alert">
						${data.message}
					</div>`);
				}
			}
		});
	});

	$(document).ready(function(){
		loadCategories();
		loadProducts();
		showCartBadge();
		refreshUserSession();
	});
