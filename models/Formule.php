<?php

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
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // si le setter correspondant existe.
            if(method_exists($this,$method))
            {
                // on appelle le setter.
                $this->$method($value);
            }
        }
    }

    /* le constructeur de l'objet Personnage */
    public function __construct(array $donnees) {

        $this->hydrate($donnees);
    }

    /* SETTER */
    public function setId($id)
    {
        # on parse la valeur de l'id supérieur à zéro
        $id = (int) $id;

        // On vérifie que l'id supérieur à zéro
        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setNom($nom)
    {
        # On affecte le nom à l'objet si $nom est une chaine de caractères
        if(is_string($nom))
        {
            $this->_nom = $nom;
        }
    }

    // Set prix du menu
    public function setPrix($prix)
    {
        #on met la valeur du prix à zéro
        $prix = (float) $prix;

        // On vérifie que le l'id supérieur à zéro
        $this->_prix = $prix;
    }

    //Set image de la formule
    public function setImage($image)
    {
        # On affecte le nom à l'objet si $nom est une chaine de caractères
        if(is_string($image))
        {
            $this->_image = $image;
        }
    }

    /* GETTERS */

    public function getId()
    {
        # Retourne l'id de l'objet en question
        return $this->_id;
    }

    public function getNom()
    {
        # Retourne le nom de l'objet en question
        return $this->_nom;
    }

    public function getPrix()
    {
        # Retourne le prix de l'objet en question
        return $this->_prix;
    }

    public function getImage()
    {
        # Retourne l'image de l'image en question
        return $this->_image;
    }

}