<?php
/*
	Class: Exposure_Micro
	Purpose: Super Small formatted return for the Expose API
	Author: Christopher O'Connell
	URL: http://compu.terlicio.us/
	Compatible with microMint: 0.3
*/

class Exposure_Micro extends AL_Expose_Exposure
{
	function basic()
	{
		global $Mint;
		$visit_data_log = print_r($Mint,true);
		$visit_data = $Mint->data[0]['visits'];
		$error_data = array(
						"error" => array(
								"type" => "Not Implemented",
								"controller" => "Visits",
								"method" => "Basic",
								"extended_info" => $visit_data_log,
								),
		);
		$i = 0;
		foreach($visit_data as $key => $value) {
			$dates[$i] = $value;//print_r($visit_data[$i],true);
			$i++;
		}
		$j = 0;
		foreach($dates[2] as $key => $value) {
			$days[$j]['dtime'] = date("r",$key);
			$days[$j]['total'] = $value['total'];
			$days[$j]['unique'] = $value['unique'];
			$j++;
		}
		$j--;
		$k = 0;
		foreach($dates[3] as $key => $value) {
			$weeks[$k]['dtime'] = date("r",$key);
			$weeks[$k]['total'] = $value['total'];
			$weeks[$k]['unique'] = $value['unique'];
			$k++;
		}
		$k--;
		$data = array(
				"visits" => array(
					"all_time" => $dates[0][0],
					"today" => $days[$j],
					"this_week" => $weeks[$k],
				),
		);
		$this->data = $data;
	}
	function debug()
	{
		global $Mint;
		$this->basic();
		$this->data = array("basic" => $this->data,"debug" => $Mint->data[0]['visits'],);
	}
}