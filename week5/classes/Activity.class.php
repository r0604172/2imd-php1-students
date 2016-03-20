<?php

spl_autoload_register(function ($class_name) {
    include 'classes/' .$class_name . '.class.php';
});

class Activity
{
	private $m_sText;
	
	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Text":
				$this->m_sText = $p_vValue;
				break;
		}	   
	}
	
	public function __get($p_sProperty)
	{
		$vResult = null;
		switch($p_sProperty)
		{
		case "Text": 
			$vResult = $this->m_sText;
			break;
		}
		return $vResult;
	}
	
	public function Save()
	/*
	De methode Save dient om een nieuwe activity te bewaren in onze databank.
	*/
	{	
		$db = Db::getInstance();

		$stmt = $db->prepare("INSERT INTO tblactivities (activity_description) VALUES (:activity_description)");
		$stmt->bindValue(':activity_description', $this->m_sText, PDO::PARAM_STR);
		$stmt->execute();
	}
	
	public function GetRecentActivities()
	{
		$db = Db::getInstance();

		$stmt = $db->query("SELECT * FROM tblactivities LIMIT 5");
		$stmt->execute();

		$rResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rResult;			
	}
}
