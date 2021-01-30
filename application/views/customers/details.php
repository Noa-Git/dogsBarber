</head>
<body>
<main id="mainWrraper">
	<h2>Details</h2>

	<h3 id="db_error" class="error"></h3>
	<h3 id="success" class="success"></h3>

	<?php echo form_open('Customers/update_customer', array('id'=>'details_form')); ?>
	<label>First Name</label>
	<input type="text" name="fname" <?php echo 'value="'.$customer->first_name.'"' ?> /><br>
	<span id="fname_error" class="error"></span>
	<label>Last Name</label>
	<input type="text" name="lname" <?php echo 'value="'.$customer->last_name.'"' ?> /><br>
	<span id="lname_error" class="error"></span>
	<label>Phone Number</label>
	<input type="text" name="phone" <?php echo 'value="'.$customer->phone_number.'"' ?> /><br>
	<span id="phone_error" class="error"></span>
	<label>Street</label>
	<input type="input" name="street" <?php echo 'value="'.$address->street.'"' ?> /><br>
	<span id="street_error" class="error"></span>
	<label>House Number</label>
	<input type="input" name="house" <?php echo 'value="'.$address->house_number.'"' ?> /><br>
	<span id="house_error" class="error"></span>
	<label>City</label>
	<input type="input" name="city" <?php echo 'value="'.$address->city.'"' ?> /><br>
	<span id="city_error" class="error"></span>
	<label>Zip Code</label>
	<input type="input" name="zip" <?php echo 'value="'.$address->zip_code.'"' ?> /><br>
	<span id="zip_error" class="error"></span>

	<input class="createForm" type="button" id="edit" value="Edit Details"/>
	<input class="createForm" type="submit" id="save" name="submit" value="Save"/>
	<input id="cancel" class="createForm" type="button"  value="Cancel" />
	<?php echo form_close(); ?>

	<h3>Dogs:</h3>
	<table>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Gender</th>
			<th>Age</th>
			<th>Size</th>
			<th>Weight</th>
		</tr>
		<?php foreach ($dogs as $dog): ?>
			<tr>
				<td><input type="checkbox" <?php echo 'name="'.$dog->id.'"' ?> ></td>
				<td><?php echo $dog->dog_name;?></td>
				<td><?php echo $dog->gender?></td>
				<td><?php echo $dog->age?></td>
				<td><?php echo $dog->size?></td>
				<td><?php echo $dog->weight?></td>
			</tr>

		<?php endforeach; ?>
	</table>
	<button id="add_dog">Add Dog</button>
	<button id="delete_dog">Delete selected Dogs</button>


</main>






<script>
	$(document).ready(function () {

		lockFormToggle();
		$('#edit').attr('disabled', false);



		$('#details_form').on('submit', function (event) {
			event.preventDefault();

			$.ajax({
				url: "<?php echo base_url(); ?>Customers/update_customer",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function (data){
					if(data.error){
						$('#success').html('');
						if(data.fname_error != ''){
							$('#fname_error').html(data.fname_error);
						}
						else{
							$('#fname_error').html('');
						}
						if(data.lname_error != ''){
							$('#lname_error').html(data.lname_error);
						}
						else{
							$('#lname_error').html('');
						}
						if(data.phone_error != ''){
							$('#phone_error').html(data.phone_error);
						}
						else{
							$('#phone_error').html('');
						}
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
						$('#success').html('Data Saved Successfully');
						lockFormToggle();
						$('#edit').attr('disabled', false);
					}
				}
			})
		});

		function lockFormToggle() {
			var form =  document.forms[0];
			[].slice.call(form.elements).forEach(function (item) {
				item.disabled = !item.disabled;
			});
		}

		$('#edit').on('click', function (){
			lockFormToggle();
			this.attr('disabled', true);
			$('#save').attr('disabled', false);
			$('#cancel').attr('disabled', false);
		});

		$('#cancel').on('click', function (){
			location.reload();

		});

		$('#add_dog').on('click', function (){
			window.location.href = "<?php echo site_url('dogs/add'); ?>";

		});

		$('#delete_dog').on('click', function (){
			alert('Not Implemented yet');

		});


	});
</script>
