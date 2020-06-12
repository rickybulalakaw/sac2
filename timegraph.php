<?php

session_start();
include "db.php";
include "header.php";

function timegraph($presentationtitle, $chartname, $labelposition, $valuecategories, $labelsarray, $valuesarray1, $valuesarray2) {
     



?>


 
    <div class="container-fluid">

    <div style="width:75%;">
		<canvas id="canvas"></canvas>
	</div>
	<br>
	<br>
	<button id="randomizeData">Randomize Data</button>
	<button id="addData">Add Data</button>
	<button id="removeData">Remove Data</button>
	<script>
		function newDate(days) {
			return moment().add(days, 'd').toDate();
		}

		function newDateString(days) {
			return moment().add(days, 'd').format();
		}

		var color = Chart.helpers.color;
		var config = {
			type: 'line',
			data: {
				datasets: [{
					label: 'Dataset with string point data',
					backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
					borderColor: window.chartColors.red,
					fill: false,
					data: [{
						x: newDateString(0),
						y: randomScalingFactor()
					}, {
						x: newDateString(2),
						y: randomScalingFactor()
					}, {
						x: newDateString(4),
						y: randomScalingFactor()
					}, {
						x: newDateString(5),
						y: randomScalingFactor()
					}],
				}, {
					label: 'Dataset with date object point data',
					backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
					borderColor: window.chartColors.blue,
					fill: false,
					data: [{
						x: newDate(0),
						y: randomScalingFactor()
					}, {
						x: newDate(2),
						y: randomScalingFactor()
					}, {
						x: newDate(4),
						y: randomScalingFactor()
					}, {
						x: newDate(5),
						y: randomScalingFactor()
					}]
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Time Point Data'
				},
				scales: {
					xAxes: [{
						type: 'time',
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Date'
						},
						ticks: {
							major: {
								fontStyle: 'bold',
								fontColor: '#FF0000'
							}
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data.forEach(function(dataObj) {
					dataObj.y = randomScalingFactor();
				});
			});

			window.myLine.update();
		});
		document.getElementById('addData').addEventListener('click', function() {
			if (config.data.datasets.length > 0) {
				config.data.datasets[0].data.push({
					x: newDateString(config.data.datasets[0].data.length + 2),
					y: randomScalingFactor()
				});
				config.data.datasets[1].data.push({
					x: newDate(config.data.datasets[1].data.length + 2),
					y: randomScalingFactor()
				});

				window.myLine.update();
			}
		});

		document.getElementById('removeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data.pop();
			});

			window.myLine.update();
		});
	</script>
          
        
<?php 

	}
	?>