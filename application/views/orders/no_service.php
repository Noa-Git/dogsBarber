<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/no_service.css'); ?>" >
<script>
	function send ()
	{
		alert('הפרטים נשלחו בהצלחה');
		window.location.href = "<?php echo site_url('main'); ?>";
	}
</script>
</head>
<body>
<main class="container" dir="rtl">
	<div class="intro-wrap">
		<div id="intro-bg-graphic">

			<div class="content-container">
				<div class="intro-text mid" style="position:relative">
					<h1 style="margin-top:80px;margin-right:400px;padding-bottom:50px;float:left;line-height: 60px">מצטערים, אבל כרגע אין שירות באיזור מגוריך.</h1>
					<p>&nbsp;</p>
					<img src="<?php echo base_url('assets/Pictures/noservice.png'); ?>" style="position:absolute;right:0;top:0"/>
					<br class="clear" />
					<br class="clear" />
				</div>
			</div>
		</div>
	</div>
	<div class="content-container">
		<h3>אל דאגה! הנה כמה אפשרויות עבורך:</h3>
		<ul style="list-style-type:none">
			<li><h4><a href="javascript:history.back()">חזור</a> לדף ממנו הגעת.</h4></li>
			<li><h4>אפשר גם ללחוץ <a href="javascript:send();">כאן</a>, כדי לשלוח לנו את פרטיך, ונחזור אליך כשהשירות יהיה זמין באיזורך.</h4></li>
		</ul>

	</div>



</main>

</body>
</html>
