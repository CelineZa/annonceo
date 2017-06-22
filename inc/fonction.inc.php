<?php 
function debug($var, $mode = 1)
{
	$trace = debug_backtrace();
	$trace = array_shift($trace); 

	if($mode == 1)
	{
		echo '<pre>'; print_r($var); echo '</pre>';		
	}
	else
	{
		echo '<pre>'; var_dump($var); echo '</pre>';
	}
}

//-------------------------------------------------------------------------------------

function internauteEstConnecte() // Cette fonction m'indique si le membre est connecté.
{
	if(!isset($_SESSION['membre'])) // Si la session "membre" est non définie. Elle ne peut être que définie si nous sommes passés par la page connexion avec le bon mot de passe.
	{
		return false;
	}
	else
	{
		return true;
	}
}

//-------------------------------------------------------------------------------------

function internauteEstConnecteEtEstAdmin() // Cette fonction m'indique si le membre est admin.
{
	if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // Si la session du membre est définie, nous regardons s'il est admin. Si c'est le cas, nous retournons true.
	{
		return true;
	}
	else
	{
		return false;
	}
}
