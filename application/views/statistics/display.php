//<?php
//$mysqli = new mysqli("localhost", "root", "", "eyalet_backend_project_chen");
//
//if ($mysqli->connect_errno) {
//	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
//	exit();
//}
//
//$sql1 = "SELECT service_name, count(service_name) as number1 FROM service inner join orders on service.id=orders.service_id GROUP BY service_name";
//$result1 = $mysqli->query($sql1);
//
//$sql2 = "SELECT city, count(orders.id) as number2 from employee inner join orders on employee.id=orders.employee_id GROUP BY city";
//$result2 = $mysqli->query($sql2);
//
//$sql3 = "SELECT MONTHNAME(order_date) as months_name, count(orders.id) as number3 from orders where YEAR(order_date)=YEAR(CURRENT_DATE()) GROUP BY months_name DESC";
//$result3 = $mysqli->query($sql3);
//?>
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
				foreach ($services->result() as $row){
					echo $row->service_name;
					echo $row->number1;
				}
//				while ($row1= mysqli_fetch_array($result1)) {
//					echo "['".$row1["service_name"]."', ".$row1["number1"]. "],";
//				}
				?>
			]);

			var options1 = {
				title: 'Precentage of Each Type Of Service',
				is3D:true
			};

			var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
			chart1.draw(data1, options1);
		}

		google.charts.setOnLoadCallback(drawChart2);

//		function drawChart2() {
//			var data2 = new google.visualization.arrayToDataTable([
//				['City', 'Amount of Orders'],
//				<?php
//				foreach ($orders_per_city->result() as $row){
//					echo $row->city;
//					echo $row->number2;
//				}
////				while ($row2= mysqli_fetch_array($result2)) {
////					echo "['".$row2["city"]."', ".$row2["number2"]. "],";
////				}
//				?>
//			]);
//
//			var options2 = {
//				title: 'Distribution of Orders Per City',
//				is3D:true
//			};
//
//			var chart2 = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
//			chart2.draw(data2, options2);
//		}
//
//		google.charts.setOnLoadCallback(drawChart3);
//
//		function drawChart3() {
//			var data3 = new google.visualization.arrayToDataTable([
//				['Month', 'Amount of Orders'],
//				<?php
//				foreach ($orders_per_date->result() as $row){
//					echo $row->months_name;
//					echo $row->number3;
//				}
////				while ($row3= mysqli_fetch_array($result3)) {
////					echo "['".$row3["months_name"]."', ".$row3["number3"]. "],";
////				}
//				?>
//			]);
//
//			var options3 = {
//				title: 'Distribution of Orders Per Month (current year)',
//				is3D:true
//			};
//
//			var chart3 = new google.visualization.ColumnChart(document.getElementById("columnchart"));
//			chart3.draw(data3, options3);
//		}
//
//
//
//		//		$(document).on('click', '.view_precentage_of_services_btn', function() {
//		//		$.ajax({
//		//			type: "POST",
//		//			url: "display.php",
//		//			dataType: 'json',
//		//			data: {
//		//
//		//			},
//		//			success: function() {
//		//				drawChart1(values);
//		//			}
//		//		});
//		//	});
//		//
	</script>
</head>

<body>
<div id="piechart" style="width: 900px; height: 300px;"></div>
<div id="columnchart_values" style="width: 900px; height: 300px;"></div>
<div id="columnchart" style="width:900px; height:300px;"></div>
</body>

</html>
