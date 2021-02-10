</head>
<body>

<div class="container open">
	<canvas id="mycanvas" height="90px" width="400px" border="1px dotted black">display if browser does not support html
		canvas
	</canvas>
	<br><br>
	אהבתם את השירותים שלנו? כאן תוכלו לבצע את הזמנתכם ולפנק את הכלב שלכם עם אחד ממגוון השירותים שלנו עד הבית
	<hr class="rounded">
</div>

<br><br><br><br><br>

<main class="container" dir="rtl">


	<h3 id="db_error" class="error"></h3>
	<h3 id="success" class="success"></h3>

	<?php echo form_open('Orders/place_order', array('id' => 'details_form')); ?>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<select name="select_dog" id="select_dog" class="custom-select" required>
					<option selected disabled hidden>בחר כלב</option>
					<?php
					foreach ($dogs as $dog) {
						echo '<option value="' . $dog->id . '">' . $dog->dog_name . '</option>';
					}
					?>
				</select>
				<span id="dog_error" class="error"></span>
				<div class="col-md-4">
					<div class="form-outline">
						<button id="add_dog">הוסף כלב</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-outline">
			<label></label>
			<select name="select_service" id="select_service" required>
				<option selected disabled hidden>בחר שירות מהרשימה</option>
				<?php
				foreach ($services as $service_id => $service) {
					echo '<option value="' . $service_id . '">' . $service['service_name'] . ' - ' . $service['price'] . '</option>';
				}
				?>
			</select><br>
			<span id="service_error" class="error"></span>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-outline">
			<label></label>
			<select name="select_employee" id="select_employee" required>
				<option disabled hidden selected>יש לבחור קודם שירות</option>
			</select>
			<span id="employee_error" class="error"></span>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">

				<label>תאריך</label>
				<input type="date" name="date" required/><br>
				<span id="date_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<label>שעה</label>
				<input type="time" name="time" required/><br>
				<span id="time_error" class="error"></span>
			</div>
		</div>
	</div>
	<h3>שירותים נוספים לבחירתך</h3>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">

				<?php
				foreach ($add_services as $add) {
					echo '<input type="checkbox" name="' . $add->id . '" id="' . $add->id . '">';
					echo '<label>'.$add->service_name .'<span class="price">('.$add->price.' שח )</span></label>';
					echo '<input id="cb_' . $add->id . '" type="hidden"  name = "cb_' . $add->id . '" value = "' . $add->price . '" />';
					echo '<br>';
				}
				?>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<label>סכום הזמנה כולל:</label>
				<input type="text" name="total" id="total" value="0" disabled>
				<input type="text" name="price" id="price" hidden>
			</div>
		</div>
	</div>
	<input class="createForm" type="submit" id="save" name="submit" value="בצע הזמנה"/>
	<input id="cancel" class="createForm" type="button" value="ביטול"/>
	<?php echo form_close(); ?>

	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">

				<label>שם פרטי</label>
				<input type="text" name="fname" disabled <?php echo 'value="' . $customer->first_name . '"' ?> /><br>

				<label>שם משפחה</label>
				<input type="text" name="lname" disabled <?php echo 'value="' . $customer->last_name . '"' ?> /><br>

				<label>מספר טלפון</label>
				<input type="text" name="phone" disabled <?php echo 'value="' . $customer->phone_number . '"' ?> /><br>
				<h3>כתובת:</h3>
				<label>רחוב</label>
				<input type="input" name="street" disabled <?php echo 'value="' . $address->street . '"' ?> /><br>

				<label>מספר בית</label>
				<input type="input" name="house" disabled <?php echo 'value="' . $address->house_number . '"' ?> /><br>

				<label>עיר</label>
				<input type="input" name="city" disabled <?php echo 'value="' . $address->city . '"' ?> /><br>

				<label>מיקוד</label>
				<input type="input" name="zip" disabled <?php echo 'value="' . $address->zip_code . '"' ?> /><br>
			</div>
		</div>
	</div>
</main>

<script>
	$(document).ready(function () {

		var total = 0;
		var services_array =<?php echo json_encode($services);?>;

		$("input[type=checkbox]").change(updatePrice);

		$('#details_form').on('submit', function (event) {
			event.preventDefault();

			$.ajax({
				url: "<?php echo base_url(); ?>Orders/place_order",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function (data) {
					if (data.error) {
						$('#success').html('');
						if (data.service_error != '') {
							$('#date_error').html(data.service_error);
						} else {
							$('#service_error').html('');
						}
						if (data.dog_error != '') {
							$('#dog_error').html(data.dog_error);
						} else {
							$('#dog_error').html('');
						}
						if (data.employee_error != '') {
							$('#employee_error').html(data.employee_error);
						} else {
							$('#employee_error').html('');
						}
						if (data.date_error != '') {
							$('#date_error').html(data.date_error);
						} else {
							$('#date_error').html('');
						}
						if (data.time_error != '') {
							$('#time_error').html(data.time_error);
						} else {
							$('#time_error').html('');
						}
						if (data.db_error != '') {
							$('#db_error').html(data.db_error);
						} else {
							$('#db_error').html('');
						}
					}
					if (data.success) {
						alert ('ההזמנה התקבלה בהצלחה!')
						window.location.href = "<?php echo site_url('main'); ?>";
					}
				}
			})
		});

		$('#cancel').on('click', function () {
			location.reload();

		});

		$('#add_dog').on('click', function () {
			window.location.href = "<?php echo site_url('dogs/add'); ?>";

		});

		$("#select_service").change(function () {

			var selected = $('option:selected', this).val();
			var selectedText = $('option:selected', this).text();

			var price = parseInt(selectedText.match(/(\d+)/));
			updatePrice();

			$("#select_employee").empty();
			$("#select_employee").append($('<option>', {
				selected: true,
				disabled: true,
				hidden: true,
				text: "בחר ספר"
			}));
			services_array[selected]['employees'].map(function (employee) {
				$("#select_employee").append($('<option>', {
					value: employee['employee_id'],
					text: employee['employee_name']
				}));
			});


		});

		function updatePrice() {
			var selectedText = $('option:selected', '#select_service').text();

			var price = parseInt(selectedText.match(/(\d+)/));
			total = price ? price : 0;

			$(':checkbox').each(function () {
				if (this.checked) {
					var text_id = "#cb_" + this.id;
					total += parseInt($(text_id).val());
				}

			});
			$('#total').val(total);
			$('#price').val(total);
		}
	});
</script>
