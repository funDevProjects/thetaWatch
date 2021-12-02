<?php
	/**
	 * SERVE CONTENT
	 *	
	 * @param array 	$data 			self explanatory
	 * @param string 	$app_header 	header menu file
	 * @param string 	$app_page		page file
	 * @param string 	$app_scripts	page footer file
	 * @param bool 		$compression	minimize code or not
	 *
	 * @result: load page view(s)
	 */	
if (! function_exists('serve_content'))
{	
	function serve_content($data = false, $app_header = false, $app_page = false, $app_scripts = false, $compression = false)
	{
		if($compression === false){
			echo view('templates/'.$app_header, $data);
			echo view('theta/'.$app_page);
			echo view('templates/'.$app_scripts);
		}else{
			echo preg_replace('/\s\s+/S', ' ', view('templates/'.$app_header, $data));
			echo preg_replace('/\s\s+/S', ' ', view('theta/'.$app_page));
			echo preg_replace('/\s\s+/S', ' ', view('templates/'.$app_scripts));
		}
	}
}

	/**
	 * CONTENT BLOCK - CTA
	 *	
	 * @param string 	$block_id 			requested static block
	 * @param array 	$block_data 		(optional) additional block details
	 *
	 * @result: html string
	 */	
if (! function_exists('cta_block'))
{	
	function cta_block($block_id = false, $block_data = false)
	{
		$compression = true;
		
		switch($block_id){
			case('contact-banner'):
				$html = '<div class="container py-5">
							<div class="text-center">
								<h2 class="text-white fw-bold">
									Want to be notiﬁed when new <br> 
									features are released?
								</h2>
								<a href="/contact-thetawatch" class="btn btn-outline-info px-5 rounded-pill py-3 mt-4">
									SIGN UP FOR UPDATES
								</a>
							</div>
						</div>';
			break;
			case('featured-linkboxes'):
				$html = '<div class="css-tw-linkboxes col-md-4 m-auto p-3">
						  <div class="ps-5">';
							foreach($block_data as $key => $linkbox){
								$ObjLinkbox = fetch_linkbox_details($linkbox);
								
								$html .= '<div class="card h-33 border-info1 bg-transparent position-relative">
											<div class="overlay"></div>
											<div class="card-body">
												<a href="'.$ObjLinkbox->boxHref.'" class="text-white text-decoration-none">
													<strong class="d-block mb-2">'.$ObjLinkbox->boxCategory.'</strong>
													'.$ObjLinkbox->boxLabel.'
												</a>
											</div>
										</div>';
							};
				$html .= '</div>
						</div>';
			break;
			case('category-linkboxes'):
				$html = '<div class="'.$block_data[5].' p-3">
							<div class="card newCard h-100 border-info1 bg-transparent position-relative">
								<!-- <div class="overlay"></div> -->
								<div class="card-body">
									<a href="" class="text-info text-decoration-none">
										'.$block_data[0].'
									</a>

									<h4 class="text-white mt-2 mb-0">
										'.$block_data[1].'
									</h4>
									<p class="text-muted fs-13">
										'.$block_data[2].'
									</p>
									<p class="text-white">
										'.$block_data[3].'
									</p>
									<div class="text-end">
										<a href="'.$block_data[4].'" target="_blank" class="text-info text-decoration-none fs-14 js-speedbump" title="Visit Resource">Go To Resource <i class="fa fa-angle-right"></i></a>
									</div>
								</div>
							</div>
						</div>';
			break;
			case('footer-static'):
				$html = '<div class="text-center bg-dark py-4">
							<p class="text-white mb-0">Launched 2021, ThetaWatch is built on open-source software.</p>
						</div>';
				$html .= '<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <div class="modal-body">
									<div class="container"></div>
								  </div>
								  <div class="modal-footer">
									<small>Click outside of box to close</small>
								  </div>
								</div>
							  </div>
							</div>';
			break;
			default:
				$html = '<div>Error selecting content block</div>';
			break;
		}
		
		
		if($compression === false){
			echo $html;
		}else{
			echo preg_replace('/\s\s+/S', ' ', $html);
		}
	}
}
	/**
	 * CONTENT BLOCK - CTA
	 *	
	 * @param string 	$block_id 			requested static block
	 * @param array 	$block_data 		(optional) additional block details
	 *
	 * @result: html string
	 */	
if (! function_exists('hud_block'))
{	
	function hud_block($block_id = false, $block_data = false)
	{
		$compression = true;
		
		switch($block_id){
			case('hudbox'):
				$html = '<div class="'.$block_data[5].' p-3">
							<div class="card newCard h-100 border-info1 bg-transparent position-relative">
								<!-- <div class="overlay"></div> -->
								<div class="card-body">
									<a href="" class="text-info text-decoration-none">
										'.$block_data[0].'
									</a>

									<h4 class="text-white mt-2 mb-0">
										'.$block_data[1].'
									</h4>
									<p class="text-muted fs-13">
										'.$block_data[2].'
									</p>
									<p class="d-none text-white">
										'.$block_data[3].'
									</p>
									<div class="text-left">
										<span class="text-info" style="font-size:3rem;">'.$block_data[4].'</span>
									</div>
								</div>
							</div>
						</div>';
			break;
			case('hud-linkbox'):
				$html = '<div class="'.$block_data[5].' p-3">
							<div class="card newCard h-100 border-info1 bg-transparent position-relative">
								<!-- <div class="overlay"></div> -->
								<div class="card-body">
									<span class="text-info text-decoration-none">
										'.$block_data[0].'
									</span>

									<h4 class="text-white mt-2 mb-0">
										'.$block_data[1].'
									</h4>
									<p class="text-muted fs-13">
										'.$block_data[2].'
									</p>
									<div class="text-end">
										<a href="'.$block_data[4].'" target="_blank" class="text-info text-decoration-none fs-14 js-speedbump" title="Visit Resource">Go To Chart <i class="fa fa-angle-right"></i></a>
									</div>
								</div>
							</div>
						</div>';
			break;
			default:
				$html = '<div>Error selecting content block</div>';
			break;
		}
		
		return $html;
	}
}
	/**
	 * FETCH LINKBOX PROFILE
	 *	
	 * @param array 	$data 			self explanatory
	 * @param string 	$app_header 	header menu file
	 * @param string 	$app_page		page file
	 * @param string 	$app_scripts	page footer file
	 * @param bool 		$compression	minimize code or not
	 *
	 * @result: load page view(s)
	 */	
if (! function_exists('fetch_linkbox_details'))
{	
	function fetch_linkbox_details($linkbox_id = false)
	{
		$ObjLinkbox = new \stdClass;
		
		switch($linkbox_id){
			case('learn'):
				$ObjLinkbox->boxCategory = 'LEARN';
				$ObjLinkbox->boxLabel = 'Feature Guides & News';
				$ObjLinkbox->boxHref = '/browse-thetawatch-guides';
			break;
			case('explore'):
				$ObjLinkbox->boxCategory = 'EXPLORE';
				$ObjLinkbox->boxLabel = 'Custom Charts & Analysis';
				$ObjLinkbox->boxHref = '/explore-charts-on-thetawatch';
			break;
			case('feature-01'):
				$ObjLinkbox->boxCategory = 'First Time?';
				$ObjLinkbox->boxLabel = 'An Orientation to Everything Theta';
				$ObjLinkbox->boxHref = '/guides/orientation-to-theta-network';
			break;
			default:
				$ObjLinkbox->boxCategory = '';
				$ObjLinkbox->boxLabel = '';
				$ObjLinkbox->boxHref = '';
			break;
		}
		
		return $ObjLinkbox;
	}
}
	/**
	 * BUILD RESOURCE DIV
	 *
	 * @param string $id. $class, $extra
	 *
	 * @return string of html div
	 */
if (! function_exists('build_resource_container'))
{
	function build_resource_container($resource_id = false, $resource_class = false, $resource_extra = false):string {
		$base_logic['action']['destination_type'] 	  	  = 'resource';
		$base_logic['action']['destination_container_id'] = $resource_id;
		$base_logic['action']['destination_has_params']   = false;
		
		$action_logic 	= htmlspecialchars(json_encode($base_logic), ENT_QUOTES, 'UTF-8');
		$div_html 		= '<div id="'.$resource_id.'" class="'.$resource_class.' ax-resource-loader css-moon-saverbase css-moon-resource" data-action="/jaxReports/resource" data-actionlogic="'.$action_logic.'" data-querylogic="false"></div>';
		$output 		= (string)$div_html;

		return $output;
	}
}
?>