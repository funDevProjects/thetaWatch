<?php namespace App\Controllers;

use App\Models\ThetawatchModel;

class ThetaExplorer extends BaseController
{
	protected $sys_updated 		= 'Nov. 23, 2021';
	protected $tokenLife		= 2500;
	protected $compressionKey 	= true;

		/**
		 * INDEX - BASE VIEW - v2021-12-01
		 *
		 * @result: load page view(s) via serve content helper
		 */		
    public function index($fetch_page = false)
	{
        $data			 		= [];
		$apiResult 		 		= array('No curl requests sent');
		$validation_pass_script = 'footer-static';
		$validation_pass_page 	= $fetch_page;
		switch($fetch_page){
			case('homepage'): $pagetitle = 'Theta Q3 Hackathon'; $pageStyleSheet = ''; break;
			case('guides'): 
				$pagetitle = 'ThetaWatch Guides'; 
				$pageStyleSheet = 'guide-styles.css';
			break;
			case('reports'): 
				$pagetitle = 'ThetaWatch Reports'; 
				$pageStyleSheet = 'report-styles.css';
				$validation_pass_script = 'footer-reports';
			break;
			case('contact'): 
				$pagetitle = 'Contact ThetaWatch'; 
				$pageStyleSheet = 'guide-styles.css';
			break;
			default: $pagetitle = 'ThetaWatch'; $pageStyleSheet = ''; break;
		}
		$data 					= [
									'pageTitle' 		=> $pagetitle,
									'pageMeta' 			=> 'ThetaWatch Hackathon Entry',
									'pageClass' 		=> 'jsTheta-Auth',
									'pageStyleSheet' 	=> $pageStyleSheet,
									'curler'			=> $apiResult
								  ];

		$this->session->setTempdata('validation_result', 'pass', $this->tokenLife);
		
		serve_content($data, 'header', $validation_pass_page, $validation_pass_script, $this->compressionKey);
	}
		/**
		 * CONTENT - FEATURES & GUIDES - v2021-12-01
		 *
		 * @result: load page view(s) via serve content helper
		 */		
    public function content($fetch_page = false)
	{
        $data			 		= [];
		$apiResult 		 		= array('No curl requests sent');
		$validation_pass_script = 'footer';
		$validation_pass_page 	= 'feature-template';
		switch($fetch_page){
			default: $pagetitle = 'ThetaWatch Feature'; $pageStyleSheet = 'feature-styles.css'; break;
		}
		$data 					= [
									'pageTitle' 		=> $pagetitle,
									'pageMeta' 			=> 'ThetaWatch Hackathon Entry',
									'pageClass' 		=> 'jsTheta-Auth',
									'pageStyleSheet' 	=> $pageStyleSheet,
									'curler'			=> $apiResult
								  ];

		$this->session->setTempdata('validation_result', 'pass', $this->tokenLife);
		
		serve_content($data, 'header', $validation_pass_page, $validation_pass_script, $this->compressionKey);
	}
		/**
		 * REPORTS - Analysis - v2021-12-01
		 *
		 * @result: load page view(s) via serve content helper
		 */		
    public function reports($fetch_report = false)
	{
        $data			 		= [];
		$apiResult 		 		= array('No curl requests sent');
		$validation_pass_script = 'footer-charts';
		$validation_pass_page 	= 'report-template';
		switch($fetch_report){
			default: $pagetitle = 'ThetaWatch Report'; $pageStyleSheet = 'report-styles.css'; break;
		}
		$data 					= [
									'pageTitle' 		=> $pagetitle,
									'pageMeta' 			=> 'ThetaWatch Hackathon Entry',
									'pageClass' 		=> 'jsTheta-Auth',
									'pageStyleSheet' 	=> $pageStyleSheet,
									'curler'			=> $apiResult
								  ];

		$this->session->setTempdata('validation_result', 'pass', $this->tokenLife);
		
		serve_content($data, 'header', $validation_pass_page, $validation_pass_script, $this->compressionKey);
	}
		/**
		 * AJAX FORM HANDLER - v2021-12-01
		 *	
		 * CALL/RESPONSE FOR AJAX REQUESTS FROM CONTACT FORM
		 * 
		 * @return json: string json_encode($ajx_callback);
		 */	
	public function app_formish($param = false)
    {
		//SET VARS
			$ajx_view = [];
			$ajx_result = [];
			$destination_type = null;
			$apiResult = ['No curl requests sent'];
			
			SWITCH($param){
				CASE('contact'):
					$resource_validation_set = 'contactform';
					$destination_type = 'formish-contact';
				BREAK;
				DEFAULT:
					$resource_validation_set = 'passvalidationtest';
				BREAK;
			}

		//RUN THE VALIDATION RULES
			$this->validation->setRuleGroup($resource_validation_set);
			if ($this->request->getMethod() === 'post' && $this->validation->withRequest($this->request)->run())
			{
				//PASS VALIDATION
				try{
					//RUN CURLER-QUERY REQUEST TO PULL RAW RESULTS
					$thetaWatch 	= new ThetawatchModel();
					$apiResult 		= $thetaWatch->QDB_contactform();
				}catch (Exception $e)
				{
					$apiResult = "Error:".$e->getMessage();
				}
				
				//VERIFY THE RESPONSE FROM THE DB OR API CALL IS VALID AND FORMATABLE
				if (!isset($apiResult['result']['data']) && empty($apiResult['result']['data'])) 
				{
					//ERROR IN DB OR API CALL - PASS MESSAGE TO VIEW
					$validation_results['_state'] 				= $apiResult['_state']['flag'];
					$validation_results['validation_message'] 	= $apiResult['_state']['flag_message'];
				}else
				 {
					//NO ERRORS ON DB OR API CALL - MOVE ON TO FORMAT RESPONSE DATA
					$validation_results['_state'] 	= 1;
					$ajx_view						= $this->collect_injectables($destination_type, $apiResult);
				}
			}else{
				//FAIL VALIDATION
				$validation_results['_state'] 				= 0;
				$validation_results['validation_message'] 	= $this->validation->listErrors();
				$apiResult		 							= $validation_results;
			}

		$ajx_result = [
						'success'	=>	$validation_results['_state'],
						'validation'=>	$validation_results,
						'result'	=>	$apiResult,
					  ];

		$ajx_payload = array_merge($ajx_view, $ajx_result);
		
		$output = json_encode($ajx_payload);

		echo $output;
    }
		/**
		 * AJAX RESOURCE HANDLER - v2021-12-01
		 *	
		 * CALL/RESPONSE FOR AJAX REQUESTS FROM DYNAMIC RESOURCES
		 * 
		 * @return json: string json_encode($ajx_callback);
		 */	
	public function app_reports($param = false)
    {
		//SET VARS
			$ajx_view = [];
			$ajx_result = [];
			$destination_type = null;
			$apiResult = ['No curl requests sent'];
			
			$request 	= \Config\Services::request();
			$json 		= $request->getJSON();
			$report		= $json->action->destination_container_id;
			
			SWITCH($report){
				CASE('resource_destination_hud'):
					$resource_validation_set = 'passvalidationtest';
					$destination_type = $report;
				BREAK;
				CASE('guards'):
					$resource_validation_set = 'passvalidationtest';
					$explorer_connection 	= 'local';
					$explorer_request 		= 'fetchGuardianDistributions';
				BREAK;
				DEFAULT:
					$resource_validation_set = 'failvalidationtest';
				BREAK;
			}

		//RUN THE VALIDATION RULES
			$this->validation->setRuleGroup($resource_validation_set);
			if ($this->request->getMethod() === 'post' && $this->validation->withRequest($this->request)->run())
			{
				//PASS VALIDATION
				try{
					//RUN CURLER-QUERY REQUEST TO PULL RAW RESULTS
					$thetaWatch 	= new ThetawatchModel();
					SWITCH($report){
						CASE('resource_destination_hud'):
							$apiResult 	= $thetaWatch->API_hud();
						BREAK;
						CASE('guards'):
							$apiResult 	= $thetaWatch->QDB_guardian_distributions('guardian-groups');
						BREAK;
						DEFAULT:
							$resource_validation_set = 'failvalidationtest';
						BREAK;
					}
				}catch (Exception $e)
				{
					$apiResult = "Error:".$e->getMessage();
				}
				
				//VERIFY THE RESPONSE FROM THE DB OR API CALL IS VALID AND FORMATABLE
				if (!isset($apiResult['result']['data']) && empty($apiResult['result']['data'])) 
				{
					//ERROR IN DB OR API CALL - PASS MESSAGE TO VIEW
					$validation_results['_state'] 				= $apiResult['_state']['flag'];
					$validation_results['validation_message'] 	= $apiResult['_state']['flag_message'];
				}else
				 {
					//NO ERRORS ON DB OR API CALL - MOVE ON TO FORMAT RESPONSE DATA
					$validation_results['_state'] 	= 1;
					$ajx_view						= $this->collect_injectables($destination_type, $apiResult['result']['data']);
				}
			}else{
				//FAIL VALIDATION
				$validation_results['_state'] 				= 0;
				$validation_results['validation_message'] 	= $this->validation->listErrors();
				$apiResult		 							= $validation_results;
			}

		$ajx_result = [
						'success'	=>	$validation_results['_state'],
						'validation'=>	$validation_results,
						'result'	=>	$apiResult,
					  ];

		$ajx_payload = array_merge($ajx_view, $ajx_result);
		
		$output = json_encode($ajx_payload);

		echo $output;
    }
		/**
		 * INJECTABLE ARRAY BUILDER - v2021-12-01
		 *	
		 * PROCESS DATA AND HTML FORMATTING FOR PASSAGE TO LOADED VIEW
		 * 
		 * @return json: string json_encode($ajx_view);
		 */	
	public function collect_injectables($destination_type = false, $apiResult = false): array
	{
		$posted					= $this->request->getJSON();
		$ajx_view 				= [];
			
		if($destination_type == 'formish-contact')
		{
			$html  		= '<label for="cf_complete" class="d-block text-white text-center fs-20 mb-2">Thanks for your interest in ThetaWatch</label>
							<input type="" class="text-center form-control" disabled id="cf_complete" name="cf_complete" value="Your submission has been delivered." />';
			$ajx_view 	= array(
							'view_config'	=>	'resource',
							'view_id'		=>  $destination_type,
							'view_html'		=>  $html,
						); 
		}
		if($destination_type == 'resource_destination_hud')
		{
			$tfuel = json_decode($apiResult['tfuel_supply'])->total_supply;
			$theta = json_decode($apiResult['theta_supply'])->total_supply;
			
			$html = '<div class="row">';
			$html .= hud_block('hudbox', [
					'Explorer Api',
					'Theta Circulating Supply',
					'Updated '.date('Y-m-d h:i A T'),
					'Represents the total circulating supply of Theta.',
					$theta,
					'col-md-6'
				]);
			$html .= hud_block('hudbox', [
					'Explorer Api',
					'Tfuel Circulating Supply',
					'Updated '.date('Y-m-d h:i A T'),
					'Represents the total circulating supply of tFuel.',
					$tfuel,
					'col-md-6'
				]);
			$html  		.= '</div>';
			
			$ajx_view 	= array(
							'view_config'	=>	'resource',
							'view_id'		=>  $destination_type,
							'view_html'		=>  $html,
						); 
		}
		$output = (array)$ajx_view;
		
		return $output;
	}
}
/* End of file ThetaExplorer.php */