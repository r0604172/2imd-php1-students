<?php
class User
{
	private $m_sUserName;	
	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Username":
				$this->m_sUserName = $p_vValue;
				break;
		}	   
	}
	
	public function __get($p_sProperty)
	{
		$vResult = null;
		switch($p_sProperty)
		{
		case "Username": 
			$vResult = $this->m_sUserName;
			break;
		}
		return $vResult;
	}
	
	public function UsernameAvailable()
	{
		$PDO = Db::getInstance();
        $stm = $PDO->prepare('SELECT * FROM tblusers WHERE user_login = :user_login');
        $stm->bindValue(':user_login', $this->m_sUserName, $PDO::PARAM_STR);
        $stm->execute();

        if($stm->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
	}
	
	public function Create()
	{
		$PDO = Db::getInstance();
		$stmt = $PDO->prepare("INSERT INTO tblusers (user_login) VALUES (:user_login);");
		$stmt->bindValue(':user_login', $this->m_sUserName, PDO::PARAM_STR);

		if ($stmt->execute())
		{
			//query went OK
		}
		else
		{
			// er zijn geen query resultaten, dus query is gefaald
			throw new Exception('Could not create your account!');
		}
	}
}
