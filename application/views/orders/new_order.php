</head>
<body>
<main id="mainWrraper">
	<h2>Place your order</h2>

	<h3 id="db_error" class="error"></h3>
	<h3 id="success" class="success"></h3>

	<?php echo form_open('Orders/place_order', array('id'=>'details_form')); ?>
	<select name="select_dog" id="select_dog">
		<option selected disabled hidden>Please select a dog</option>
		<?php
			foreach ($dogs as $dog){
				echo '<option value="'.$dog->id.'">'.$dog->dog_name.'</option>';
			}
		?>
	</select>
	<button id="add_dog">Add Dog</button><br>
	<select name="select_service" id="select_service">
		<option selected disabled hidden>Please select a service</option>
		<?php
		foreach ($services as $service){
			echo '<option value="'.$service->service_id.'">'.$service->service_name.' - '.$service->price.'</option>';
		}
		?>
	</select><br>
	<select name="select_employee" id="select_employee">
		<option selected disabled hidden>Choose your barber</option>
		<?php
		foreach ($services as $service){
			echo '<option value="'.$service->employee_id.'">'.$service->employee_name.'</option>';
		}
		?>
	</select>
	<br>
	<label>Date</label>
	<input type="text" name="date"/><br>
	<span id="date_error" class="error"></span>
	<br>
	<label>Time</label>
	<input type="text" name="time"/><br>
	<span id="time_error" class="error"></span>
	<h3>Please choose additional services</h3>
	<?php
		foreach ($add_services as $add){
			echo '<label>'.$add->service_name.'</label>';
			echo '<input type="checkbox" name="'.$add->service_name.'" id="'.$add->service_name.'">';
			echo '<br>';
		}
	?>
	<label>Total price: </label>
	<input type="text" name="total" id="total" value="100" disabled>
	<br>
	<input class="createForm" type="submit" id="save" name="submit" value="place order"/>
	<input id="cancel" class="createForm" type="button"  value="Cancel" />
	<?php echo form_close(); ?>




	<label>First Name</label>
	<input type="text" name="fname" disabled <?php echo 'value="'.$customer->first_name.'"' ?> /><br>

	<label>Last Name</label>
	<input type="text" name="lname" disabled <?php echo 'value="'.$customer->last_name.'"' ?> /><br>

	<label>Phone Number</label>
	<input type="text" name="phone" disabled <?php echo 'value="'.$customer->phone_number.'"' ?> /><br>

	<label>Street</label>
	<input type="input" name="street" disabled <?php echo 'value="'.$address->street.'"' ?> /><br>

	<label>House Number</label>
	<input type="input" name="house" disabled <?php echo 'value="'.$address->house_number.'"' ?> /><br>

	<label>City</label>
	<input type="input" name="city" disabled <?php echo 'value="'.$address->city.'"' ?> /><br>

	<label>Zip Code</label>
	<input type="input" name="zip" disabled <?php echo 'value="'.$address->zip_code.'"' ?> /><br>

</main>

<script>
	$(document).ready(function () {

		$('#details_form').on('submit', function (event) {
			event.preventDefault();

			$.ajax({
				url: "<?php echo base_url(); ?>Orders/place_order",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function (data){
					if(data.error){
						$('#success').html('');
						if(data.date_error != ''){
							$('#date_error').html(data.date_error);
						}
						else{
							$('#date_error').html('');
						}
						if(data.time_error != ''){
							$('#time_error').html(data.time_error);
						}
						else{
							$('#time_error').html('');
						}
						if(data.db_error != ''){
							$('#db_error').html(data.db_error);
						}
						else{
							$('#db_error').html('');
						}
					}
					if (data.success){
						window.location.href = "<?php echo site_url('Orders/complete'); ?>";
					}
				}
			})
		});

		$('#cancel').on('click', function (){
			location.reload();

		});

		$('#add_dog').on('click', function (){
			window.location.href = "<?php echo site_url('dogs/add'); ?>";

		});
	});
</script>
