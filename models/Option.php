<?php
/**
 * Created by PhpStorm.
 * User: bontemps
 * Date: 19/12/18
 * Time: 10:50
 */

class Option{

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

    public function setId($id)
    {
        # on parse la valeur de l'id en INT
        $id = intval($id);
        // On vérifie que l id superieur à zéro

        $this->_id = $id;

    }


    public function setNom($nom)
    {
        # on affecte le nom à l'objet si $nom est une chaine de caractères
        if(is_string($nom))
        {
            $this->_nom = $nom;
        }
    }


    public function setPrix($prix)
    {
        # on parse la valeur du prix en Float
        $prix = (float) $prix;
        // on vérifie que l id supérieur à zero
        if($prix > 0.0)
        {
            $this->_prix = $prix;
        }
    }


    public function setImage($image)
    {
        # on affecte le nom à l'objet si $nom est une chaine de caractères
        if(is_string($image))
        {
            $this->_image = $image;
        }
    }


    // GETTERS ou mutateurs


    /**
     * @return mixed
     */
    public function getId()
    {
        # retourne l'id de l'objet en question
        return $this->_id;
    }


    /**
     * @return mixed
     */
    public function getNom()
    {
        # retourne le nom de l'objet en question
        return $this->_nom;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        # retourne le prix de l'objet en question
        return $this->_prix;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        # retourne l'image de l'objet en question
        return $this->_image;
    }

    public function toString()
    {
        return  $this->getId() . '<br/>' .
                $this->getNom() . '<br/>' .
                $this->getPrix() . '<br/>' .
                $this->getImage() . '<br/>';
    }

}
