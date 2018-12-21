<?php


class Admin
{

    private $_id;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_password;


    /* fonction hydratation des donnees provenant de la BDD */
    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            // Si le setter correspondant existe.
            if(method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    /* le constructeur de l'objet Personnage */
    public function __construct(array $donnees){
        $this->hydrate($donnees);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->_prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function toString()
    {
        return '<pre>' . $this->getId() . '</pre>' .
               '<pre>' . $this->getNom() . '</pre>' .
               '<pre>' . $this->getPrenom() . '</pre>' .
               '<pre>' . $this->getEmail() . '</pre>' .
               '<pre>' . $this->getPassword() . '</pre>';
    }



}