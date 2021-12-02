<?php namespace App\Models;

use CodeIgniter\Model;

class ThetawatchModel extends Model
{
	protected $thetaAmountRequest			= 'https://explorer.thetatoken.org:8443/api/supply/theta/';
	protected $tFuelAmountRequest			= 'https://explorer.thetatoken.org:8443/api/supply/tfuel/';
	
		/**
		 * LOCAL EXCEPTIONS - v2021-12-01
		 *
		 * @result: standardized app-specific response handling
		 */		
	private function local_exceptions($api_result = false)
	{
		$called_result 	= false;
		
		if( isset($api_result['result']) && !empty($api_result['result']) )
		{
			$called_result 	= $api_result['result'];
		}
		if($called_result !== true){
			$attempt_response 							= $api_result['code'];
			
			switch($attempt_response)
			{
				case 0: $text = 'Code 0'; break;
				case 1: $text = $api_result['message']; break;
				default:
					$text 		= 'Error Code:'.$attempt_response;
				break;
			}
		}
			
		if($called_result !== true)
		{
			$api_request['_state']['flag']				= 0;
			$api_request['_state']['flag_message']		= $text;
		}else{
			$api_request['result']						= $api_result;
			$api_request['_state']['flag']				= 1;
			$api_request['_state']['flag_message']		= 'success';
		}
		
		$output = $api_request;
		
		RETURN $output;
	}
		/**
		 * LOCAL DB EXCEPTIONS - v2021-12-01
		 *
		 * @result: standardized app-specific response handling
		 */		
	private function local_db_exceptions($dbq_result = false)
	{
		$called_result 	= false;
		
		if( isset($dbq_result['result']) && !empty($dbq_result['result']) )
		{
			$called_result 	= $dbq_result['result'];
		}
		if($called_result !== true){
			$attempt_response 							= $dbq_result['code'];
			
			switch($attempt_response)
			{
				case 0: $text = 'Code 0'; break;
				case 1: $text = $dbq_result['message']; break;
				default:
					$text 		= 'Error Code:'.$attempt_response;
				break;
			}
		}
			
		if($called_result !== true)
		{
			$dbq_request['result']						= null;
			$dbq_request['_state']['flag']				= 0;
			$dbq_request['_state']['flag_message']		= $text;
		}else{
			$dbq_request['result']						= $dbq_result;
			$dbq_request['_state']['flag']				= 1;
			$dbq_request['_state']['flag_message']		= 'success';
		}
		
		$output = $dbq_request;
		
		RETURN $output;
	}
		/**
		 * API CALL - Example - v2021-12-01
		 *
		 * This executes an api call, then
		 * passes the result through local_exceptions
		 *
		 * @result: array of data and/or exceptions
		 */
	function example_api_call($param='') {

		$api_result = $this->api_query('url/path',
						array(
								'postid' => $param
							));
		//RESPONSE CODES -- For protocol error messages
		$api_local_exceptions 		= $this->local_exceptions($api_result);
		
		$output = $api_local_exceptions;
		
		return $output;
	}
		/**
		 * CRUD - Example - v2021-12-01
		 *
		 * This executes a db query, then
		 * passes the result through local_exceptions
		 *
		 * @result: array of data and/or exceptions
		 */
	function QDB_example_call($param = false)
	{
		$db      		= \Config\Database::connect();
		$activeTable 	= $db->table('example_table');
		
		/* INSERT
			$data 	= [
						'example_1' 	=> $param,
						'example_2'		=> date('Y'),
					  ];
			$dbq = $activeTable->insert($data);
		*/
		/* DELETE
			$activeTable->where('example_1', $param);
			$dbq = $activeTable->delete();
		*/
		/* UPDATE
			$activeTable->where('example_1', $param);
			$dbq = $activeTable->update($data);
		*/
		/* REPLACE
			$activeTable->replace([
						'example_1' 	=> (string)$param,
						'example_2'		=> (string)$param,
					]);
		*/
		/* SELECT
			$search_condition = '( field_name =\''.date('Y-m-d').'\')';
			$query 	= $activeTable
						->select('*')
						->where($search_condition)
						->orderBy($sort_condition)
						->get();
			$dbq 	= $query->getResult();
		*/
		
		$dbq_result['result'] 	= true;
		$dbq_result['code'] 	= 0;
		$dbq_result['data'] 	= json_encode(array('data'=>$dbq));
		$dbq_result['message'] 	= 'DB Query Executed Successfully';
		
		//RESPONSE CODES -- For protocol error messages
		$qdb_local_exceptions 	= $this->local_db_exceptions($dbq_result);
		
		$output = $qdb_local_exceptions;
		
		return $output;
	}
		/**
		 * API CALL - THETA - v2021-12-01
		 *
		 * This executes a theta api call, then
		 * passes the result through local_exceptions
		 *
		 * @result: array of data and/or exceptions
		 */
	function vendor_curl_call($api_endpoint)
	{
		$curl = curl_init();
			
		curl_setopt_array($curl, array(
			CURLOPT_URL 			=> $api_endpoint,
			CURLOPT_RETURNTRANSFER 	=> true,
			CURLOPT_ENCODING 		=> "",
			CURLOPT_MAXREDIRS 		=> 10,
			CURLOPT_TIMEOUT 		=> 25,
			CURLOPT_FOLLOWLOCATION 	=> true,
			CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST 	=> "GET",
			CURLOPT_HTTPHEADER 		=> array(
				"Content-Type: application/json"
			),
		));

		$theta_result 	= curl_exec($curl);
		$info 			= curl_getinfo($curl);
		$app_curl_flag 	= curl_errno($curl);
		$error_msg_curl = curl_error($curl);
		
		if($info['http_code'] == 200){
			$api_result['result'] 	= true;
			$api_result['code'] 	= 0;
			$api_result['data'] 	= $theta_result;
			$api_result['message'] 	= 'API Request Executed Successfully';
		}else{
			$api_result['result'] 	= false;
			$api_result['code'] 	= $info['http_code'];
			$api_result['data'] 	= $api_result;
			$api_result['message'] 	= 'API Request Encountered an Error';
		}
		
		//RESPONSE CODES -- For protocol error messages
		$api_local_exceptions 		= $this->local_exceptions($api_result);
		
		$output = $api_local_exceptions;
		
		return $output;
	}
	
	
	private function theta_endpoints($endpoint = false)
	{
		SWITCH($endpoint)
		{
			CASE('blockHeight'):
				$block_height = 1; //move to posted input or function param
				$url_target = $this->blockRequest.$block_height;
			BREAK;
			CASE('GetBlocksByRange'):
				/*
				allow/validate get params
				$pageNumber = '?pageNumber=1';
				$limit		= '&limit=10';
				*/
				
				$getParams  = '?pageNumber=1&limit=10';
				
				$url_target = $this->blocksByRangeRequest.$getParams;
			BREAK;
			CASE('GetTransaction'):
				$requestedHash = '0x06e720ede4fc61981127a9a0c10df7802b92f32ac8e5f4154ef35c14b90ee94d'; //move to posted input or function param
				
				$url_target = $this->transactionRequest.$requestedHash;
			BREAK;
			CASE('GetTransactionsByRange'):
				/*
				allow/validate get params
				$pageNumber = '?pageNumber=1';
				$limit		= '&limit=10';
				*/
				
				$getParams  = '?pageNumber=1&limit=10';
				
				$url_target = $this->transactionsByRangeRequest.$getParams;
			BREAK;
			CASE('GetAccount'):
				$url_target = $this->accountRequest.'/'.$this->myWallet;
			BREAK;
			CASE('GetAccountTxHistory'):
				$url_target = $this->accountTxHistoryRequest.$this->myWallet;
			BREAK;
			CASE('GetTopTokenHolders'):
				$token_type 	= 'theta';
				$limit 			= 5;
				$conditions 	= $token_type.'/'.$limit;
				
				$url_target = $this->topTokenHolderRequest.$conditions;
			BREAK;
			CASE('GetAllStakes'):
				$url_target = $this->allStakesRequest;
			BREAK;
			CASE('GetTotalStakedAmount'):
				$url_target = $this->totalStakedAmountRequest;
			BREAK;
			CASE('GetStakeByAddress'):
				$url_target = $this->stakeByAddressRequest.$this->myWallet;
			BREAK;
			CASE('GetThetaAmount'):
				$url_target = $this->thetaAmountRequest;
			BREAK;
			CASE('GetTFuelAmount'):
				$url_target = $this->tFuelAmountRequest;
			BREAK;
			CASE('fetchGuardianDistributions'):
				$url_target = $this->guardianDistributions;
			BREAK;
			
			DEFAULT:
				$url_target = $this->thetaAmountRequest;
			BREAK;
		}
		
		$output = $url_target;
		
		RETURN $output;
	}
	
	
	
	function QDB_contactform($param = false)
	{
		$db      		= \Config\Database::connect();
		$activeTable 	= $db->table('tw_comms');
		$request 		= \Config\Services::request();
		
		$json = $request->getJSON();
		
		$data 	= [
						'comms_email' 		=> $json->data->cf_email,
						'comms_name'		=> $json->data->cf_name,
						'comms_message'		=> $json->data->cf_body,
						'comms_meta'		=> date('Y-m-d'),
					  ];
			$dbq = $activeTable->insert($data);
		//print_r($dbq->connID->affected_rows); die();
		
		if($dbq->connID->affected_rows == 1){
			$dbq_result['result'] 	= true;
			$dbq_result['code'] 	= 0;
			$dbq_result['data'] 	= ['rows_affected'=>$dbq->connID->affected_rows];
			$dbq_result['message'] 	= 'DB Query Executed Successfully';
		}else{
			$dbq_result['result'] 	= false;
			$dbq_result['code'] 	= 1;
			$dbq_result['data'] 	= ['rows_affected'=>$dbq->connID->affected_rows];
			$dbq_result['message'] 	= 'DB Query Encountered an Error';
		}
		//RESPONSE CODES -- For protocol error messages
		$qdb_local_exceptions 	= $this->local_db_exceptions($dbq_result);
		
		$output = $qdb_local_exceptions;
		
		return $output;
	}
	
		/**
		 * API CALL - HUD - v2021-12-01
		 *
		 * This executes an api call, then
		 * passes the result through local_exceptions
		 *
		 * @result: array of data and/or exceptions
		 */
	function API_hud()
	{
		$theta_supply_call 		= $this->vendor_curl_call($this->thetaAmountRequest);
		$tfuel_supply_call 		= $this->vendor_curl_call($this->tFuelAmountRequest);
		
		if( ($theta_supply_call['_state']['flag'] == 1) && ($tfuel_supply_call['_state']['flag'] == 1) ){
			$dbq_result['result'] 	= true;
			$dbq_result['code'] 	= 0;
			$dbq_result['data'] 	= ['theta_supply' => $theta_supply_call['result']['data'], 'tfuel_supply' => $tfuel_supply_call['result']['data']];
			$dbq_result['message'] 	= 'API call executed successfully';
		}else{
			$dbq_result['result'] 	= false;
			$dbq_result['code'] 	= 1;
			$dbq_result['data'] 	= ['results_found'=>0];
			$dbq_result['message'] 	= 'API call encountered an error';
		}
		
		$output = $this->local_db_exceptions($dbq_result);
		
		return $output;
	}
		/**
		 * CRUD - Example - v2021-12-01
		 *
		 * This executes a db query, then
		 * passes the result through local_exceptions
		 *
		 * @result: array of data and/or exceptions
		 */
	function QDB_guardian_distributions($query_selector = false)
	{
		$db      		= \Config\Database::connect();
		$activeTable 	= $db->table('tw_guardians');
		
		switch($query_selector)
		{
			CASE('guardian-groups'):
				$request 				= \Config\Services::request();
				
				if ($request->getMethod() === 'post')
				{
					$json = $request->getJSON()->params;
					
					$range_increment 		= $json->range_increment;
					$range_mincrement		= (int)$range_increment - 1;
					$range_start 			= $json->range_start;
					$range_end 				= $json->range_end;
				}else
				 {
					$range_increment 		= 1000;
					$range_mincrement		= 999;
					$range_start 			= 1000;
					$range_end 				= 50000;
				 }
				
				$builderView = $db->table('guards');
				$query = $builderView
							->select('
								floor(cast(`range` as signed)/'.(int)$range_increment.')*'.(int)$range_increment.' as bin_floor, 
								floor(cast(`range` as signed)/'.(int)$range_increment.')*'.(int)$range_increment.' + '.(int)$range_mincrement.' as bin_ceil, 
								sum(`guards`.`guardians`) as nodes,
								sum(`unlisting`.`guardians`) as withdrawals,
								floor(cast(`stake` as signed)/'.(int)$range_increment.')*'.(int)$range_increment.' as bin_floor2, 
								floor(cast(`stake` as signed)/'.(int)$range_increment.')*'.(int)$range_increment.' + '.(int)$range_mincrement.' as bin_ceil2, 
								')
							->join('unlisting', 'unlisting.stake = guards.range', 'left')
							->where(['`range` >=' => (int)$range_start])
							->where(['`range` <=' => (int)$range_end])
							->groupBy('bin_floor', 'ASC')
							->orderBy('bin_floor', 'ASC')
							->get();
				
				$dbq = $query->getResultArray();
			BREAK;
			DEFAULT:
				$query = $activeTable
					->select('grd_id,grd_withdrawn,grd_source, CAST(grd_amount AS FLOAT) AS grd_staked')
					->where([
						'grd_id !=' => 0,
						'grd_withdrawn !=' => 1
					])
					->orderBy('grd_staked', 'DESC')
					->get();
				
				$dbq = $query->getResultArray();
			BREAK;
		}
		
		if($activeTable->countAllResults() > 0){
			$dbq_result['result'] 	= true;
			$dbq_result['code'] 	= 0;
			$dbq_result['data'] 	= $dbq;
			$dbq_result['message'] 	= 'DB Query Executed Successfully';
		}else{
			$dbq_result['result'] 	= false;
			$dbq_result['code'] 	= 1;
			$dbq_result['data'] 	= ['rows_affected'=>0];
			$dbq_result['message'] 	= 'DB Query Encountered an Error';
		}
		//RESPONSE CODES -- For protocol error messages
		$qdb_local_exceptions 	= $this->local_db_exceptions($dbq_result);
		
		$output = $qdb_local_exceptions;
		
		return $output;
	}
}
//EOF