</head>
<body>
<main id="mainWrraper">
	<h2>Enter your address</h2>

	<h3 id="db_error" class="error"></h3>
	<h3 id="success" class="success"></h3>

	<h3>Hi, <?php echo $name ?></h3>
	<?php echo form_open('Customers/update_address', array('id'=>'details_form')); ?>
	<label>Street</label>
	<input type="input" name="street" /><br>
	<span id="street_error" class="error"></span>
	<label>House Number</label>
	<input type="input" name="house"/><br>
	<span id="house_error" class="error"></span>
	<label>City</label>
	<input type="input" name="city"/><br>
	<span id="city_error" class="error"></span>
	<label>Zip Code</label>
	<input type="input" name="zip"/><br>
	<span id="zip_error" class="error"></span>

	<input class="createForm" type="submit" id="save" name="submit" value="Save"/>
	<input id="cancel" class="createForm" type="button"  value="Cancel" />
	<?php echo form_close(); ?>
</main>
<script>
	$(document).ready(function () {

		$('#details_form').on('submit', function (event) {
			event.preventDefault();

			$.ajax({
				url: "<?php echo base_url(); ?>Customers/update_address",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function (data){
					if(data.error){
						$('#success').html('');
						if(data.street_error != ''){
							$('#street_error').html(data.street_error);
						}
						else{
							$('#street_error').html('');
						}
						if(data.house_error != ''){
							$('#house_error').html(data.house_error);
						}
						else{
							$('#house_error').html('');
						}
						if(data.city_error != ''){
							$('#city_error').html(data.city_error);
						}
						else{
							$('#city_error').html('');
						}
						if(data.zip_error != ''){
							$('#zip_error').html(data.zip_error);
						}
						else{
							$('#zip_error').html('');
						}
						if(data.db_error != ''){
							$('#db_error').html(data.db_error);
						}
						else{
							$('#db_error').html('');
						}
					}
					if (data.success){
						window.location.href = "<?php echo site_url($_SESSION['referrer']); ?>";
					}
				}
			})
		});

		$('#cancel').on('click', function (){
			window.location.href = "<?php echo site_url(); ?>";

		});
	});
</script>
