<?php

class Ressource
{
    /**
     * Ressource constructor.
     * @param int $id
     * @param string $nom
     * @param string $description
     * @param string $image
     * @param string $type_ressource
     */
    public function __construct($id, $nom, $description, $image, $type_ressource)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
        $this->type_ressource = $type_ressource;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getTypeRessource()
    {
        return $this->type_ressource;
    }

    /**
     * @param string $type_ressource
     */
    public function setTypeRessource($type_ressource)
    {
        $this->type_ressource = $type_ressource;
    }
}

?>