<?php
/******************************************************************************
Expose - API Interface

Developer      : Christopher O'Connell
Plug-in Name   : microAPI

[Compu.terlicio.us](http://compu.terlicio.us/)
Based on code from [84degrees.com](http://www.84degrees.com/)

******************************************************************************/

if (!defined('MINT_ROOT')) { define('MINT_ROOT', '../../../'); }
if (isset($_GET['errors'])) { error_reporting(E_ALL); } else { error_reporting(0); }

define('MINT', true);

include_once('classes/serialiser.php');

include(MINT_ROOT.'app/lib/mint.php');
include(MINT_ROOT.'app/lib/pepper.php');
include(MINT_ROOT.'config/db.php');

include_once('class.php');

class CO_Expose_API
{
	var $mint;
	var $pepper;
	var $serialiser;
	var $error = array(
					"Error" => "Class Not Specified",
					"Error Code" => "1",
					"Error Message" => "No controller was specified",
					);

	function CO_Expose_API()
	{
		global $Mint;
		
		if (!isset($Mint))
		{
			$this->serialise(array("Error" => "Mint Not Installed", "Error Code" => "6", "Error Message" => "No valid mint installation was found",));
			return;
		}
		
		$this->serialiser = new AL_Expose_Serialiser();
		
		$this->mint = $Mint;
		$this->mint->loadPepper();
		
		if ($this->is_pepper_okay())
		{
			$this->fetch_api_prefs();
			
			if ($this->has_authentication())
			{
				if (!$this->run_exposure()) {
					$this->serialise($this->error);
				}
			}
		}
		else
		{
			// dead ....
			$this->serialise(array("Error" => "API Not Installed", "Error Code" => "2", "Error Message" => "The microMint API is not installed in Mint",));
		}
	}
	
	function get_var($key)
	{
		return (isset($_REQUEST[$key]) ? $_REQUEST[$key] : false);
	}
	
	function is_pepper_okay()
	{
		foreach($this->mint->cfg['pepperShaker'] as $pepper)
		{
			if ($pepper['class'] == 'CO_microAPI')
			{
				return true;
			}
		}

		return false;
	}

	function run_exposure()
	{
		if ($this->get_var('method'))
		{
			$method = $this->get_var('method');
			$method = split(':', $method);
			
			$exposure_name = 'Exposure_' . ucwords($method[0]);
			try {
				include('classes/exposure.php');
				include('exposures/' . $method[0] . '.php');
			} catch (Exception $e) {
				$this->serialise(array("Error" => "No Such Class","Error Code" => "5", "Error Message" => "$exposure_name: The exposure specified was not found",));
				return false;
			}

			$exposure = new $exposure_name();
			
			if (isset($method[1]))
			{
				$method_name = $method[1];
				$exposure->$method_name();
			} else {
				$this->serialise(array("Error" => "No Such Method","Error Code" => "4", "Error Message" => "$method[1]: The method specified was not found in exposure '$exposure_name'",));
				return false;
			}
			
			$this->serialise($exposure->data);
			
			return true;
		}
		return false;
	}
	
	function has_authentication()
	{
		// does this exposure want authentication? 
		if ($this->get_var('api') && $this->get_var('api') == $this->pepper->prefs['apiKey'])
		{
			return true;
		}
		else
		{
			$this->serialise(array("Error" => "Invalid Credentials", "Error Code" => "3","Error Message" => "The API key supplied is invalid",));
		}
		
		return false;
	}
	
	function fetch_api_prefs()
	{
		foreach ($this->mint->pepper as $pepper)
		{
			if ($pepper->info['pepperName'] == "&micro;API")
			{
				$this->pepper = $pepper;
				return true;
			}
		}
		
		return false;
	}
	
	function load_api()
	{
		
	}
	
	function serialise($data)
	{
		header('Content-Type: text/xml');
		
		echo $this->serialiser->serialise($data);
	}
	
	function serialise_error($code, $message)
	{
		$error->code = $code;
		$error->message = $message;
		
		$this->serialise($error);
	}
}

new CO_Expose_API();

?>