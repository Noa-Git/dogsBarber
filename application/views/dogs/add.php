</head>
<body>
<main class="mainWrraper" dir="rtl">
	<h2>הוספת כלב חדש</h2>

	<span id="db_error" class="error"></span>

	<?php echo form_open('Dogs/save_dog', array('id'=>'add_dog_form')); ?>
	<div class="row mb-4">
		<div class="col-md-1">
			<div class="form-outline">
				<label>שם הכלב</label>
				<input type="text" name="dog_name" required />
				<span id="dog_name_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-1">
			<div class="form-outline">
				<label>מין</label>
				<select name="gender" required>
					<option value="זכר" selected>זכר</option>
					<option value="נקבה">נקבה</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-1">
			<div class="form-outline">
				<label>גיל</label>
				<input type="text" name="age" required />
				<span id="age_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-1">
			<div class="form-outline">
				<label>גודל</label>
				<select name="size" required>
					<option value="טוי" >טוי</option>
					<option value="קטן">קטן</option>
					<option value="בינוני" selected>בינוני</option>
					<option value="גדול">גדול</option>
					<option value="גדול מאד">גדול מאד</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-1">
			<div class="form-outline">
				<label>משקל (ק״ג)</label>
				<input type="text" name="weight"  required/>
				<span id="weight_error" class="error"></span>
			</div>
		</div>
	</div>
	<input class="createForm" type="submit" name="submit" value="אישור"/>
	<input id="Cancel" class="createForm" type="button" value="ביטול" />
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
