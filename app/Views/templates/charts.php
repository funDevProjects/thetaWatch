		<script src="https://cdn.jsdelivr.net/npm/chart.js@3.1.0/dist/chart.min.js"></script>
		<script>
			function plotCoordinates(x, y) {
				this.x = x;
				this.y = y;
			}
			function plotWithdrawals(x, y) {
				if(x == null){x = "0"}
				if(y == null){y = "0"}
				
				this.x = x;
				this.y = y;
			}
			function buildMyChart(element, plotX, plotY, plotXY, plotWD)
			{
				var dsp_range_floor 	= element.bin_floor;
				var dsp_range_ceil 		= element.bin_ceil;
				var dsp_node_count		= element.nodes;
				var dsp_delist_count	= element.withdrawals;
				
				plotX.push(dsp_range_floor);
				plotY.push(dsp_node_count);
				plotXY.push(new plotCoordinates(dsp_range_floor,dsp_node_count));
				plotWD.push(new plotWithdrawals(dsp_range_floor,dsp_delist_count));
			}
			function buildMyTable(element, report_container, stake_withdrawals)
			{
				var dsp_range_floor 	= element.bin_floor;
				var dsp_range_ceil 		= element.bin_ceil;
				var dsp_node_count		= element.nodes;
				if(element.withdrawals == null){ var dspWithdrawals = 0;} else { var dspWithdrawals = element.withdrawals}
				var dsp_unlist_count	= dspWithdrawals;
				
				var tTable  = '<tr>';
					tTable += 	'<td class="js-body-col">';
					tTable += 		dsp_range_floor;
					tTable += 	'</td>';
					tTable += 	'<td class="js-body-col">';
					tTable += 		dsp_range_ceil;
					tTable += 	'</td>';
					tTable += 	'<td class="js-body-col js-unstake-col text-right">';
					tTable += 		dsp_unlist_count;
					tTable += 	'</td>';
					tTable += 	'<td class="js-body-col text-right">';
					tTable += 		dsp_node_count;
					tTable += 	'</td>';
					tTable += '</tr>';
				
				$(report_container).find('.jsT-table-rows').append(tTable);
			}
			
			function appChartery(fetchChart = false)
			{
				var tChart 		= "myChart-"+fetchChart;
				var tCaption	= "myCaption-"+fetchChart;
				var tTable 		= "myTable-"+fetchChart;
				var ajxURL		= "/explore-theta/"+fetchChart;
				var data 		= new FormData($("#triggerSearch form")[0]);			
								  data.append('data-return-json', 'ajax');
				
				var range_start 		= parseFloat(document.forms['triggerSearch'].elements['range_start'].value);
				var range_end 			= parseFloat(document.forms['triggerSearch'].elements['range_end'].value);
				var range_increment 	= parseFloat(document.forms['triggerSearch'].elements['range_increment'].value);
				var range_withdrawals 	= parseFloat(document.forms['triggerSearch'].elements['range_withdrawals'].value);
				
				//console.log(range_withdrawals);
				
				$.ajax({
					url: 			ajxURL,
					data: 			data,
					cache: 			false,
					contentType: 	false,
					processData: 	false,
					type: 			'POST',
					dataType: 		"json",
					success: 		function(data)
					{
					   JSONObject 		= data;
					   var valResultKey	= JSONObject.success;
					   
					   if( (valResultKey === '0') || (valResultKey === 0) )
					   {
							//error
							console.log('error fetching results');
					   }
					   
					   if( (valResultKey === '1') || (valResultKey === 1) )
					   {
							var payload_G		= JSON.parse(JSONObject.result.payload.response_data).result.guardians;
						    
							//IF DATA RETURNED, SET VARIABLES & INITIAL CONDITIONS
							var plotY 				= [];
							var plotX 				= [];
							var plotXY				= [];
							var plotWD				= [];
							var replaceChart 		= '<canvas id="myChart-guards" class="my-4 jsT-charts" data-chartpath="guards" width="900" height="380"></canvas>';
							var canvas 				= document.getElementById(tChart);
							var captionDiv			= document.getElementById(tCaption);
							var plotpoints			= document.getElementById(tTable);
							var plotRows			= plotpoints.querySelector('.jsT-table-rows');
							
							//RESET REPORT CANVAS AND TABLE
							canvas.parentNode.innerHTML = replaceChart;
							var reCanvas 				= document.getElementById(tChart);
							plotRows.innerHTML 			= '';
							captionDiv.innerHTML 		= 'Searching...';
							
							//EXTRACT PLOT POINTS FROM DATA
							payload_G.forEach(function(element) {
								buildMyChart(element, plotX, plotY, plotXY, plotWD);
								buildMyTable(element, plotpoints);
							});
							
							//UnLABEL THE CHART
							captionDiv.innerHTML 		= '&nbsp;';

							var thetaAnnotations = []
							
							var thetaTicks = {
								max: range_end,
								min: range_start,
								stepSize: range_increment,
								beginAtZero: true
							}
							
							var thetaData = {
								labels: plotX,
								datasets: [
									{
										data: 					plotXY,
										fill: 					false,
										backgroundColor: 		'transparent',
										borderColor: 			'#2abae4',
										borderWidth: 			4,
										pointBackgroundColor: 	'#2abae4',
										label: 					'Node Count',
									}
								]
							};
							
							//EXTRACT PLOT POINTS FROM DATA
							if(range_withdrawals == 1)
							{
								var thetaData = {
									labels: plotX,
									datasets: [
										{
											data: 					plotXY,
											fill: 					false,
											backgroundColor: 		'transparent',
											borderColor: 			'#2abae4',
											borderWidth: 			2,
											pointBackgroundColor: 	'#2abae4',
											label: 					'Staked Wallets',
										},
										{
											data: 					plotWD,
											fill: 					false,
											borderColor: 			'#e2b7b9',
											borderWidth: 			2,
											pointBackgroundColor: 	'#e2b7b9',
											label: 					'Withdrawing Wallets',
										}
									]
								};
							}

							new Chart(reCanvas, {
								type: "line",
								data: thetaData,
								options: {
								  legend: {
									display: false
								  },
								  scales: {
									yAxes:[{
										ticks: {
											beginAtZero: true
										}
									}],
									xAxes: [{
									  type: 'linear',
									  position: 'bottom',
									  ticks: thetaTicks
									}]
								  }
								}
							  });
					   }
					}
				})
			}					
			
			//DRAW CHARTS ON PAGE LOAD
			$('.jsT-loadChart').each(function(i){
				var urlChart = $(this).data('chartpath');
				
				appChartery(urlChart);
			});
			
			//REDRAW ON SELECT LIST CHANGE
			var source 	  	= document.getElementById('jsT-selectRange');
			$(document).on('change',source,function (e){
				var urlChart    = $(source).data('chartpath');
				appChartery(urlChart);
			})
		</script>