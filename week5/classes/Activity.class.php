<?php

spl_autoload_register(function ($class_name) {
    include 'classes/' .$class_name . '.class.php';
});

class Activity
{
	private $m_sText;
    private $m_iId;
    private $m_iLikes;
	
	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Text":
				$this->m_sText = $p_vValue;
				break;
            case "Id":
                $this->m_iId = $p_vValue;
                break;
            case "Likes":
                $this->m_iLikes = $p_vValue;
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

            case "Id":
                $vResult = $this->m_iId;
                break;
            case "Likes":
                $vResult = $this->m_iLikes;
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
		return $db->lastInsertId();
	}
	
	public function GetRecentActivities()
	{
		$db = Db::getInstance();

		$stmt = $db->query("SELECT * FROM tblactivities ORDER BY pk_activity_id DESC LIMIT 5");
		$stmt->execute();

		$rResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rResult;			
	}

	public function getLikes() {
		$db = Db::getInstance();

		$stmt = $db->prepare("SELECT likes FROM tblactivities WHERE pk_activity_id = :id");
		$stmt->bindValue(':id', $this->m_iId, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['likes'];
	}

	public function addLike() {
		$db = Db::getInstance();

		$stmt = $db->prepare("UPDATE tblactivities SET likes = likes +1 WHERE pk_activity_id = :id");
		$stmt->bindValue(':id', $this->m_iId, PDO::PARAM_INT);
		$stmt->execute();
	}

    public function removeActivity() {
        $db = Db::getInstance();
        $stmt = $db->prepare("DELETE FROM tblactivities WHERE pk_activity_id = :id");
        $stmt->bindValue(':id', $this->m_iId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
