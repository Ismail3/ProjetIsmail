<?php
require_once(dirname(__FILE__) . '/../basesDeDonnées/BdConnexion.php');

class AbstractModel
{
    /*
     * Attributes
     */
    protected $db;

    /**
     * Cours constructor.
     */
    public function __construct()
    {
        $this->db = new BdConnexion();
    }

    /**
     * @return BdConnexion
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param BdConnexion $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }
}
