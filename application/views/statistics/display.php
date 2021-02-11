<?php
?>
<html>

<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", {
			packages: ["corechart"]
		});
		google.charts.setOnLoadCallback(drawChart1);

		function drawChart1() {
			var data1 = new google.visualization.arrayToDataTable([
				['Service Name', 'Number'],
				<?php
				foreach ($services as $row) {
					echo "['" . $row->service_name . "', " . $row->number1 . "],";
				}
				?>
			]);

			var options1 = {
				title: 'Precentage of Each Type Of Service',
				is3D: true
			};

			var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
			chart1.draw(data1, options1);
		}

		google.charts.setOnLoadCallback(drawChart2);

		function drawChart2() {
			var data2 = new google.visualization.arrayToDataTable([
				['City', 'Amount of Orders'],
				<?php
				foreach ($orders_per_city as $row) {
					echo "['" . $row->city . "', " . $row->number2 . "],";
				}
				?>
			]);

			var options2 = {
				title: 'Distribution of Orders Per City',
				is3D: true
			};

			var chart2 = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
			chart2.draw(data2, options2);
		}

		google.charts.setOnLoadCallback(drawChart3);

		function drawChart3() {
			var data3 = new google.visualization.arrayToDataTable([
				['Month', 'Amount of Orders'],
				<?php
				foreach ($orders_per_date as $row) {
					echo "['" . $row->months_name . "', " . $row->number3 . "],";
				}
				?>
			]);

			var options3 = {
				title: 'Distribution of Orders Per Month (current year)',
				is3D: true
			};

			var chart3 = new google.visualization.ColumnChart(document.getElementById("columnchart"));
			chart3.draw(data3, options3);
		}


		//		$(document).on('click', '.view_precentage_of_services_btn', function() {
		//		$.ajax({
		//			type: "POST",
		//			url: "display.php",
		//			dataType: 'json',
		//			data: {
		//
		//			},
		//			success: function() {
		//				drawChart1(values);
		//			}
		//		});
		//	});
	</script>
</head>

<body>
<div class="container">
	<div id="piechart"></div>
	<div id="columnchart_values"></div>
	<div id="columnchart"></div>
</div>
</body>
</html>
