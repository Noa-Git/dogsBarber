</head>
<body>
<main class="mainWrraper" dir="rtl">
	<h2>רישום לקוח חדש</h2>

	<span id="db_error" class="error"></span>
	<?php echo form_open('Customers/save_customer', array('id' => 'register_form')); ?>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline text-right">
				<label>שם פרטי</label>
				<input type="text" name="fname" required/><br>
				<span id="fname_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<label>שם משפחה</label>
				<input type="text" name="lname" required/><br>
				<span id="lname_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<label>דוא״ל</label>
				<input type="text" name="email" required/><br>
				<span id="email_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<label>מספר טלפון</label>
				<input type="text" name="phone" required/><br>
				<span id="phone_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<label>סיסמה</label>
				<input type="password" name="password" required/><br>
				<span id="password_error" class="error"></span>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-2">
			<div class="form-outline">
				<label>אימות סיסמה</label>
				<input type="password" name="confirmPassword" required/><br>
				<span id="confirmPassword_error" class="error"></span>
			</div>
		</div>
	</div>
	<input class="createForm" type="submit" name="submit" value="רישום"/>
	<input id="Cancel" class="createForm" type="button" name="submit" value="ביטול"/>
	<?php echo form_close(); ?>
</main>
<script>
	$(document).ready(function () {
		document.getElementById("Cancel").onclick = function () {
			window.location.href = "<?php echo site_url('main'); ?>";
		};

		$('#register_form').on('submit', function (event) {
			event.preventDefault();

			$.ajax({
				url: "<?php echo base_url(); ?>Customers/save_customer",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function (data) {
					if (data.error) {
						if (data.fname_error != '') {
							$('#fname_error').html(data.fname_error);
						} else {
							$('#fname_error').html('');
						}
						if (data.lname_error != '') {
							$('#lname_error').html(data.lname_error);
						} else {
							$('#lname_error').html('');
						}
						if (data.email_error != '') {
							$('#email_error').html(data.email_error);
						} else {
							$('#email_error').html('');
						}
						if (data.phone_error != '') {
							$('#phone_error').html(data.phone_error);
						} else {
							$('#phone_error').html('');
						}
						if (data.password_error != '') {
							$('#password_error').html(data.password_error);
						} else {
							$('#password_error').html('');
						}
						if (data.confirmPassword_error != '') {
							$('#confirmPassword_error').html(data.confirmPassword_error);
						} else {
							$('#confirmPassword_error').html('');
						}
						if (data.db_error != '') {
							$('#db_error').html(data.db_error);
						} else {
							$('#db_error').html('');
						}
					}
					if (data.success) {
						window.location.href = "<?php echo site_url($_SESSION['referrer']); ?>";
					}
				}
			})
		});
	});

</script>

</body>
</html>
