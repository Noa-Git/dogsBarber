<?php
?>
</head>
<h1 dir="rtl">היי <?php echo $name ?></h1>
<h4 dir="rtl">בהתבסס על הנתונים שלך, חשבנו שיעניין אותך לדעת:</h4>
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

	google.charts.setOnLoadCallback(drawChart4);


	google.charts.setOnLoadCallback(drawTitleSubtitle);

	function drawTitleSubtitle() {
		var data5 = new google.visualization.arrayToDataTable();
		['Month', 'orders', 'customer_orders'],
		<?php
		$stack=array();
		foreach ($cust_orders['genreal'] as $gen) {
			$month = $gen->months_name;
			foreach ($cust_orders['cust'] as $customer) {
				if ($customer->months_name === $month) {
					array_push($stack, $month, $gen->number5, $customer->cust_ord);
					print_r($stack);
					echo "['" . $month . "', " . $gen->number5 . "', " . $customer->cust_ord . "],";
				}
			}
		}
		?>
	]);

	var options5 = {
		chart: {
			title: 'Motivation and Energy Level Throughout the Day',
			subtitle: 'Based on a scale of 1 to 10'
		},
		hAxis: {
			title: 'Time of Day',
			format: 'h:mm a',
			viewWindow: {
				min: [7, 30, 0],
				max: [17, 30, 0]
			}
		},
		vAxis: {
			title: 'Rating (scale of 1-10)'
		}
	};

	var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
	materialChart.draw(data5, options5);
	}

</script>
</head>

<body>
<div class="container">
	<div id="chart_div"></div>
	<!--	<div class="row"-->
	<div id="piechart"></div>
	<p>hello</p>
	<div id="piechart2"></div>
	<div id="columnchart_values"></div>
	<div id="columnchart"></div>
	<!--	</div>-->
</div>
</body>
</html>
