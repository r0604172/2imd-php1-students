<?php

spl_autoload_register(function ($class_name) {
    include 'classes/' .$class_name . '.class.php';
});

class Activity
{
	private $m_sText;
    private $m_iId;
	
	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Text":
				$this->m_sText = $p_vValue;
				break;
            case "Id":
                $this->m_iId = $p_vValue;
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

            case "Id":
                $vResult = $this->m_iId;

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
		return $db->lastInsertId();
	}
	
	public function GetRecentActivities()
	{
		$db = Db::getInstance();

		$stmt = $db->query("SELECT * FROM tblactivities LIMIT 5");
		$stmt->execute();

		$rResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rResult;			
	}

    public function removeActivity() {
        $db = Db::getInstance();
        $stmt = $db->prepare("DELETE FROM tblactivities WHERE pk_activity_id = :id");
        $stmt->bindValue(':id', $this->m_iId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
