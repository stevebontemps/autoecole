<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 26/12/18
 * Time: 13:21
 */

class Formule
{
    private $_id;
    private $_nom;
    private $_prix;
    private $_image;

    /* fonction hydratation des donnees provenant de la BDD */
    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            // On récupère le nom de setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            // si le setter conrrespondant existe.
            if(method_exists($this,$method))
            {
                //on appelle le setter.
                $this->$method($value);
            }
        }
    }
    /* le constructeur de l'objet Option */
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    /* SETTER ou accesseurs */
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->_prix = $prix;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }

    // GETTERS ou mutateurs
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->_prix;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }

}