<?php

class BdConnexion
{
    /*
     * Attributs
     */
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    /**
     * Cours constructor.
     */
    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "password";
        $this->dbname = "db_apprendreAcomprendre";
    }

    /**
     * @return string
     */
    public function getServername()
    {
        return $this->servername;
    }


    /**
     * @param string $servername
     */
    public function setServername($servername)
    {
        $this->servername = $servername;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * @param string $dbname
     */
    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
    }

    /**
     * @return mysqli
     */
    public function openConn()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if (isset($this->conn)) {
            return $this->conn;
        }
    }

    /**
     * @param mixed $conn
     */
    public function closeConn()
    {
        $this->conn->close();
    }

}

?>
