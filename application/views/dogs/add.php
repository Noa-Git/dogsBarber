</head>
<body>
<main id="mainWrraper">
	<h2>Add A New Dog</h2>

	<span id="db_error" class="error"></span>

	<?php echo form_open('Dogs/save_dog', array('id'=>'add_dog_form')); ?>
	<label>Dog Name</label>
	<input type="text" name="dog_name" required /><br>
	<span id="dog_name_error" class="error"></span>
	<label>Gender</label>
	<select name="gender" required>
		<option value="m" selected>Male</option>
		<option value="f">Female</option>
	</select><br>
	<label>Age</label>
	<input type="text" name="age" required /><br>
	<span id="age_error" class="error"></span>
	<label>Size</label>
	<select name="size" required>
		<option value="extra small" >Extra Small</option>
		<option value="small">Small</option>
		<option value="medium" selected>Medium</option>
		<option value="large">Large</option>
		<option value="extra large">Extra Large</option>
	</select><br>
	<label>Weight</label>
	<input type="text" name="weight"  required/> <span> Kg</span><br>
	<span id="weight_error" class="error"></span>

	<input class="createForm" type="submit" name="submit" value="Add"/>
	<input id="Cancel" class="createForm" type="button" value="Cancel" />
	<?php echo form_close(); ?>

</main>
<script>
	$(document).ready(function (){
		document.getElementById("Cancel").onclick = function ()
		{
			window.history.back();
		};

		$('#add_dog_form').on('submit', function (event) {
			event.preventDefault();

			$.ajax({
				url: "<?php echo base_url(); ?>Dogs/save_dog",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function (data){
					if(data.error){
						if(data.dog_name_error != ''){
							$('#dog_name_error').html(data.dog_name_error);
						}
						else{
							$('#dog_name_error').html('');
						}
						if(data.age_error != ''){
							$('#age_error').html(data.age_error);
						}
						else{
							$('#age_error').html('');
						}
						if(data.weight_error != ''){
							$('#weight_error').html(data.weight_error);
						}
						else{
							$('#weight_error').html('');
						}

						if(data.db_error != ''){
							$('#db_error').html(data.db_error);
						}
						else{
							$('#db_error').html('');
						}
					}
					if (data.success){
						window.history.back();

					}
				}
			})
		});
	});

</script>

</body>
</html>
