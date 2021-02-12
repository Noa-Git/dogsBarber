<?php
?>
<h1 dir="rtl">היי <?php echo $name ?></h1>
<h4 dir="rtl">בהתבסס על הנתונים שלך, חשבנו שיעניין אותך לדעת:</h4>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<main>
	<div class="charts">
		<div class="uni">
			<div id="chart_div" class="insight-pie"></div>
		</div>
		<div class="chart-wrapper">
			<div id="piechart4" class="insight-pie"></div>
			<div id="piechart3" class="insight-pie"></div>
		</div>
		<div class="chart-wrapper">
			<div id="piechart2" class="insight-pie"></div>
			<div id="piechart" class="insight-pie"></div>
		</div>
	</div>
</main>
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
			title: 'Precentage of Each Type Of Service Used By All Of Our Customers',
			colors: ['#4D8FAC', '#59ABE3', '#22A7F0'],
			is3D: true
		};

		var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
		chart1.draw(data1, options1);
	}

	google.charts.setOnLoadCallback(drawChart4);

	function drawChart4() {
		var data4 = new google.visualization.arrayToDataTable([
			['Service Name', 'Number'],
			<?php
			//       print_r($cust_services);
			foreach ($cust_services as $row) {
				echo "['" . $row->service_name . "', " . $row->number4 . "],";
			}
			?>
		]);

		var options4 = {
			title: 'Precentage of Each Type Of Service Used By You',
			colors: ['#4D8FAC', '#59ABE3', '#22A7F0'],
			is3D: true
		};

		var chart4 = new google.visualization.PieChart(document.getElementById('piechart2'));
		chart4.draw(data4, options4);
	}

	google.charts.setOnLoadCallback(drawChart3);

	function drawChart3() {
		var data3 = new google.visualization.arrayToDataTable([
			['Add_Service Name', 'Number'],
			<?php
			foreach ($add_services as $row) {
				echo "['" . $row->add_service_name . "', " . $row->number2 . "],";
			}
			?>
		]);

		var options3 = {
			title: 'Precentage of Each Type Of Additional Service Used By All Of Our Customers',
			pieHole: 0.4,
			colors: ['#4D8FAC', '#59ABE3', '#22A7F0']
		};

		var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));
		chart3.draw(data3, options3);
	}

	google.charts.setOnLoadCallback(drawChart6);

	function drawChart6() {
		var data6 = new google.visualization.arrayToDataTable([
			['Cust_add_Service Name', 'Number'],
			<?php
			//       print_r($cust_services);
			foreach ($cust_add_services as $row) {
				echo "['" . $row->add_service_name . "', " . $row->count_add_services . "],";
			}
			?>
		]);

		var options6 = {
			title: 'Precentage of Each Type Of Additional Service Used By You',
			pieHole: 0.4,
			colors: ['#4D8FAC', '#59ABE3', '#22A7F0']
		};

		var chart6 = new google.visualization.PieChart(document.getElementById('piechart4'));
		chart6.draw(data6, options6);
	}


	google.charts.load("current", {
		packages: ["bar"]
	});
	google.charts.setOnLoadCallback(drawchart5);

	function drawchart5() {
		var data5 = new google.visualization.arrayToDataTable([
			['Month', 'All orders', 'Your orders'],
			<?php
			$stack = array();
			$fstack = array();
			foreach ($orders['genreal'] as $gen) {
				$stack['months_name'] = $gen->months_name;
				$stack['number5'] = $gen->number5;
				$stack['cust_ord'] = 0;
				foreach ($orders['cust'] as $customer) {
					if ($customer->months_name === $gen->months_name) {
						$stack['cust_ord'] = $customer->cust_ord;
						break;
					}
				}
				array_push($fstack, $stack);
			}
			foreach ($fstack as $row) {
				echo "['" . $row['months_name'] . "', " . $row['number5'] . ", " . $row['cust_ord'] . "],";
			}
			?>
		]);

		var options5 = {
			chart: {
				title: 'Orders taken by you and all of our customers',
				subtitle: '*months of current year',
			},
			axes: {
				y: {
					0: {label: 'Number of Orders'}
				}
			},
			colors: ['#4D8FAC', '#59ABE3']
		};

		var chart5 = new google.charts.Bar(document.getElementById('chart_div'));
		chart5.draw(data5, options5);
	}
</script>
