<!DOCTYPE html>
<html>
<head>
	<title>Create project</title>
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<style type="text/css">
		.loader {
		    position: fixed;
		    left: 0px;
		    top: 0px;
		    width: 100%;
		    height: 100%;
		    z-index: 9999;
		    background: url('frontend/images/loader.gif') 50% 50% no-repeat rgb(249,249,249);
		    opacity: .8;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		});
	</script>
</head>
<body>
	<div class="loader"></div>
	<div class="row">
		<div class="container-fluid">
			<form method="post" action="#">
				@csrf
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Stage One</label>
			    	<input type="text" name="stage[]" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Stage two</label>
			    	<input type="text" name="stage[]" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  	</div>
			  	<div class="append-stage">
			  		
			  	</div>
			  	<h2>Breadcrumb Pagination</h2>
				<ul class="breadcrumb">
				  	<li><a href="{{url('first-page/#home')}}">Home</a></li>
				  	<li><a href="{{url('first-page/#pictures')}}">Pictures</a></li>
				  	<li><a href="{{url('first-page/#summer')}}">Summer 15</a></li>
				  	<li>Italy</li>
				</ul>
			  	<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
	
<script type="text/javascript">
	$(document).on('click','.add-stage',function(){
		$('.append-stage').append('<div class="form-group"><label for="exampleInputPassword1">Stage two</label><input type="text" name="stage[]" class="form-control" id="exampleInputPassword1" placeholder="Password"></div>');
	})
</script>
</html>