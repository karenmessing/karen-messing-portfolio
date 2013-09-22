<?php
/******************************************************************************
 Mint
  
 Copyright 2004-2011 Shaun Inman. This code cannot be redistributed without
 permission from http://www.shauninman.com/
 
 More info at: http://www.haveamint.com/
 
 ******************************************************************************
 Configuration
 ******************************************************************************/
 if (!defined('MINT')) { header('Location:/'); } // Prevent viewing this file 

$Mint = new Mint (array
(
	'server'	=> 'karenmessingmint.db.3350505.hostedresource.com',
	'username'	=> 'karenmessingmint',
	'password'	=> 'sGGkh3FWCP',
	'database'	=> 'karenmessingmint',
	'tblPrefix'	=> 'mint_'
));