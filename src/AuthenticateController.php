<?php
class AuthenticateController
{
	private $auth_header;
	private PDO $conn;
	public function __construct(string $header,Database $conn)
	{
		$this->auth_header = $header;
		$this->conn = $conn->getConnection();
	}
	public function validateToken() 
	{
		if(substr($this->auth_header,0,5) !== "Tarek")
		{
			header('HTTP/1.1 401 Unauthorized');
			echo "Invalid authorization header format";
			exit;
		}
		if ($this->isTokenExist($this->auth_header) !== true)
		{
			header('HTTP/1.1 401 Unauthorized');
			echo "There's no such token";
			exit;
		}
	}
	private function isTokenExist(string $token) :bool
	{
		$stmt = "SELECT access_token FROM tokens";
		$result = $this->conn->query($stmt);
		$result = $result->fetch(PDO::FETCH_ASSOC);
		if (in_array($token,$result))
		{
			return true;
		}
		return false;
	}
}
