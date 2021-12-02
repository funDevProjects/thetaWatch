<script>
		function sanitizeCell(cellData){
			var sanitized = cellData.replace(/[,.]/g, function (m) {
				return m === ',' ? '.' : '';
			});
			
			sanitized = sanitized.replace(/(\r\n\t|\n|\r\t)/gm," ");
			sanitized = sanitized.replace(/(;)/,"");
			
			return sanitized;
		}
		function sanitizeCommas(cellData){
			var sanitized = cellData.replace(/[;]/g, function (m) {
				return m === ',' ? ';' : ' / ';
			});
			sanitized = sanitized.replace(/(\/ \/)/,"");
			return sanitized;
		}
		function sanitizeCurrency(cellData){
			var sanitized = cellData.replace(/[,]/g, function (m) {
				return m === ',' ? '' : '';
			});
			
			sanitized = sanitized.replace(/(\r\n\t|\n|\r\t)/gm," ");
			sanitized = sanitized.replace(/(;)/,"");
			
			return sanitized;
		}

		function prepCSVRow(arr, columnCount, initial) {
			var row 		= '';
			var delimeter 	= ';';
			var newLine 	= '\r\n';

			function splitArray(_arr, _count) {
				var splitted 	= [];
				var result 		= [];
				
				_arr.forEach(function(item, idx) {
					if ((idx + 1) % _count === 0) {
						splitted.push(item);
						result.push(splitted);
						splitted = [];
					} else {
						splitted.push(item);
					}
				});
				
				return result;
			}
			
			var plainArr = splitArray(arr, columnCount);
			 plainArr.forEach(function(arrItem) {
				arrItem.forEach(function(item, idx) {
					row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
				});
				row += newLine;
			 });
			return initial + row;
		}
		
		function csv_export(){
			var titles 				= [];
			var data 				= [];
			var myFilename			= document.getElementById('print-title').innerHTML;

			$('th.js-header-col').each(function() {
				titles.push($(this).text());
			});

			$('td.js-body-col').each(function() {
				var defaultCell 	= $(this).text();
				var fieldValExport 	= sanitizeCurrency(defaultCell);
				
				data.push(fieldValExport);
			});
			
			var CSVString 			= prepCSVRow(titles, titles.length, '');
			 CSVString 				= prepCSVRow(data, titles.length, CSVString);

			var downloadLink 		= document.createElement("a");
			var blob 				= new Blob(["\ufeff", CSVString]);
			var url 				= URL.createObjectURL(blob);
			 downloadLink.href 		= url;
			 downloadLink.download 	= myFilename+".csv";

			document.body.appendChild(downloadLink);
			downloadLink.click();
			document.body.removeChild(downloadLink);
		};
		
		$(document).on('click','a#js-export-trigger',function(e){
			e.preventDefault();
			csv_export();
		});
</script>