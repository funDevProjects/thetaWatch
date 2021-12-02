		<!-- copyright -->
		<?php cta_block('footer-static'); ?>
		<!-- copyright -->
		

		<!-- SCRIPTS -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

		<!-- Icons -->
		<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-3PESKLL8X0"></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());

			  gtag('config', 'G-3PESKLL8X0');
			</script>
		
		
		<!-- Contact Form -->
		<script>
			function cmsgSaverscreen(toggleDef = false, parentDiv = false){
				if(toggleDef === "on"){
					if(parentDiv){
						var parentId = $(parentDiv).attr("id");
						$("#"+parentId+".css-moon-saverbase").append("<div class=\'alert-warning css-moon-saverscreen\'><span class=\'css-moon-savershim\'></span><span class=\'css-moon-savernote\'>Processing...</span></div>");
					}else{
						$(".css-moon-saverbase").append("<div class=\'alert-warning css-moon-saverscreen\'><span class=\'css-moon-savershim\'></span><span class=\'css-moon-savernote\'>Processing...</span></div>");
					}
				}else{
					if(parentDiv){
						var parentId = $(parentDiv).attr("id");
						$("#"+parentId+".css-moon-saverscreen").remove();
					}else{
						$(".css-moon-saverscreen").remove();
					}
				}
			}
			function validationModal(valResultMsg)
			{
				$("#exampleModal .modal-header").html("<h5 class=\'modal-title\' id=\'exampleModalLabel\'>Whoops! Validation Error</h5>");
				$("#exampleModal .modal-body .container").html(valResultMsg);
				$("#exampleModal").modal("show");
				
				$(".css-moon-saverscreen").remove();
			}
			function processJax(dynFormId = false)
			{
				var dynForm				= $("form#"+dynFormId);
				var data 				= $("#"+dynFormId).serializeArray().map(function(x){this[x.name] = x.value; return this;}.bind({}))[0];
				var ajxURL 				= $(dynForm).attr('action');
				
				data = JSON.stringify({data});
				
				<?php /* SAVERSCREEN */ ?>
				cmsgSaverscreen('on');
				
				$.ajax({
					url: 			ajxURL,
					data: 			data,
					cache: 			false,
					async:			true,
					type: 			'POST',
					contentType: 	'application/json',
					dataType: 		'json',
					success: 		function(data){
					   
					   JSONObject 		= data;
					   var valResultKey	= JSONObject.validation._state;
					   var valResultMsg	= JSONObject.validation.validation_message;
					   
					   if( (valResultKey === '0') || (valResultKey === 0) )
					   {
							<?php /* error */ ?>
							console.log('Validation failed.');
							validationModal(valResultMsg, valResultKey);
					   }
					   
					   if( (valResultKey === '1') || (valResultKey === 1) )
					   {
							<?php /* success */ ?>
							console.log('Validation passed.');
							var viewConfig = JSONObject.view_config;
							
							if(typeof viewConfig !== 'undefined'){
								switch(viewConfig){
									case('string'):
										$('#'+JSONObject.view_id).html(JSONObject.view_html);
									break;
									default:
										$('#'+JSONObject.view_id).html(JSONObject.view_html);
									break;
								}
							}else{
								$('#'+JSONObject.view_id).html('Error, please check back later.');
							}
							cmsgSaverscreen('off');
					   }
					},
					error:function (xhr, ajaxOptions, thrownError){
						console.log('query failed.');
						validationModal('This request returned an error: '+thrownError+'. Please check your answers and try again.');
						
						cmsgSaverscreen('off');
					}
				});
			}
			$(document).on('submit','form[id^=formish-contact]',function(e){
				e.preventDefault();
				var dynamicFormId = $(this).attr('id');
				processJax(dynamicFormId);
			});
		</script>
		
	</body>
</html>