<script>
	function printData()
	{
		var divToPrint			= document.getElementById("print-div");
		var dspTitle			= document.getElementById('print-title').innerHTML;
		var headerPrint 		= '<h2 style="margin-bottom:10px;">Range From '+document.getElementById('jsT-beginRange').value;
		    headerPrint 		+= ' To '+document.getElementById('jsT-endRange').value;
		    headerPrint 		+= ', Increments of '+document.getElementById('jsT-selectRange').options[source.selectedIndex].value+' Theta</h2>';
			
		var chartToPrint		= document.getElementById("myChart-guards");
		var chartUrl 			= chartToPrint.toDataURL();
		var chartImage			= '<img style="margin-top:20px;" src="' + chartUrl + '">';
		
		var breakerToPrint  	= "<div style='display:block !important;margin-bottom:1rem !important;position:relative !important;'>";
		var enderToPrint		= "</div>";
		var stylesToPrint  		= "body {font-size:12px;font-family:sans-serif;}table{font-size:10px;width: 100% !important;border-collapse:collapse;border:1px solid;text-align: left;}th{border-bottom:1px solid #333333 !important;}.text-right { text-align: right !important; } .float-right { float: right !important; } .float-left { float: left !important; }";
		var introToPrint		= "<!DOCTYPEhtml><head><metacharset='utf-8'><title>ThetaWatch Reports: "+dspTitle+"</title><style>"+stylesToPrint+"</style></thead><body>";
		var outroToPrint		= "</body></html>";
			
		newWin	= window.open("");
		newWin.document.write(introToPrint);
			newWin.document.write(breakerToPrint);
				newWin.document.write(headerPrint);
				newWin.document.write(chartImage);
			newWin.document.write(enderToPrint);
			newWin.document.write(breakerToPrint);
				newWin.document.write(divToPrint.outerHTML);
			newWin.document.write(enderToPrint);
		newWin.document.write(outroToPrint);
		newWin.print();
		newWin.close();
	}
		$(document).on('click','a#js-print-trigger',function(e){
			e.preventDefault();
			printData();
		});
</script>