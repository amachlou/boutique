<?php
	include('common/head.php'); 
	include('common/connection.php');
	// session_start();
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/script.js" type="text/javascript"></script>
<body>

<?php include('common/header.php'); ?>

<section class="bg padding-y">
	<div class="container">
	<div class="row">
		<aside class="col-md-3">
			<nav class="card">
				<ul class="menu-category category_list">
					<li></li>
				</ul>
			</nav>
		</aside>
		<div class="col-md-9">
				<div class="container">
					<div class="image-carousel style2 flexslider" data-animation="slide" data-item-width="270" data-item-margin="30">
						<div class="flex-viewport" style="overflow: hidden; position: relative;">
							<div class="form-row">
								<div class="form-group col-md-2">
									<input type="number" class="form-control" name="min_price" placeholder="Min Price">
								</div>
								<div class="form-group col-md-2">
									<input type="number" class="form-control" name="max_price" placeholder="Max Price">
								</div>
								<div class="form-group col-md-4">
									<button class="btn btn-primary col-md-4" id="filter">Filter</button>
								</div>
							</div>
							<div class="row product_list">
							</div>
						</div>
					</div>
					<nav aria-label="Page navigation">
						<ul class="pagination justify-content-center product-pagination">
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<!--Modal-->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
	
</script>
<!-- <script src="js/jquery-ui.min.js"></script>
                    
	<script>
		$(".search-item").autocomplete({
			source: "product.php",
			minLength: 3,
			select: function( event, ui ) {
				setTimeout(function(){
					alert(' 00000 00000 00000');
					$(".search-item").val(ui.name);
				}, 100);
			}
		}).autocomplete( "instance" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			    .append( "<img src='"+item.image+"' width='25' height='25'><span style='color:blue;'> " + item.name + "</span>" )
			    .appendTo( ul );
		};
	</script> -->

</body>
</html>