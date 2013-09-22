<?php
/******************************************************************************
Expose

Developer      : Christopher O'Connell
Plug-in Name   : &micro;API

[Compu.terlicio.us](http://compu.terlicio.us/)

******************************************************************************/

$installPepper = "CO_microAPI";
define('CO_API_VERSION', '0.3');

class CO_microAPI extends Pepper
{
	var $version = CO_API_VERSION;
	var $info = array
	(
		'pepperName'	=>	'&micro;API',
		'pepperUrl'		=>	'http://compu.terlicio.us/code/',
		'pepperDesc'	=>	'Provides an API for accessing mint data.',
		'developerName'	=>	'Christopher OConnell',
		'developerUrl'	=> 	'http://compu.terlicio.us/'
	);
	
	var $prefs = array
	(
		'apiKey' => "{md5(rand() * 388382)}"
	);
	
	/**************************************************************************
	 onDisplayPreferences()
	 **************************************************************************/
	function onDisplayPreferences() 
	{
		$preferences = array();

		$preferences['API Key']	= <<<HERE
		<table>
			<tr>
				<td><input type="text" name="apiKey" id="apiKey" value="{$this->prefs['apiKey']}" style="width: 98%" /></td>
			</tr>
			<tr>
				<td><label for"apiKey">Use the API key to authenticate clients and allow them to connect to expose.</label></td>
			</tr>
			<tr>
				<td>If the API key field is empty, you can save the settings to automatically generate an API key.</td>
			</tr>
		</table>
HERE;
		
		return $preferences;
	}
	
	/**************************************************************************
	 onSavePreferences()
	 **************************************************************************/
	function onSavePreferences() 
	{
		if ($this->prefs['apiKey'] == null || $_POST['apiKey'] == '' || $_POST['apiKey'] == ' ')
		{
			$this->prefs['apiKey'] = md5(rand() * 388382);
		}
		else
		{
			$this->prefs['apiKey'] = $_POST['apiKey'];
		}
	}
	
	/**************************************************************************
	 isCompatible()
	 **************************************************************************/
	function isCompatible()
	{
	    if ($this->Mint->version >= 120)
	    {
	        return array
	        (
	            'isCompatible'  => true
	        );
	    }
	    else
	    {
	        return array
	        (
	            'isCompatible'  => false,
	            'explanation'   => '<p>This Pepper is only compatible with Mint 1.2 and higher.</p>'
	    );
	    }
	}
}

?>