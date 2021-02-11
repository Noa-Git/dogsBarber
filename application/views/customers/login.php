</head>
<body>
    <main class="container" dir="rtl">
        <h1>כניסה לחשבון</h1>
        <div id="info"><?php if ($error != null) {
            echo "Can not login.  error: " . $error['error'];} ?></div>
<?php echo form_open('Customers/auth'); ?>
		<div class="row mb-4">
			<div class="col-md-2">
				<div class="form-outline">
					<label>דוא״ל</label>
					<input type="text" name="email" required /><br>
					<label>סיסמה</label>
					<input type="password" name="password"  required/><br>
				</div>
			</div>
		</div>
        <input class="createForm" type="submit" name="submit" value="כניסה"/>
        <input id="register" class="createForm" type="button" name="submit" value="רישום" />
<?php echo form_close(); ?>
    </main>
    <script>
        document.getElementById("register").onclick = function ()
        {
            window.location.href = "<?php echo site_url('customers/register'); ?>";
        };
    </script>
</body>
</html>
