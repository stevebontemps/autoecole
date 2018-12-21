<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 14/12/18
 * Time: 14:00
 */

class Humain
{
    private $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $ville;
    private $codepostal;

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
    /* le constructeur de l'objet Fruit */
    public function __construct(array $donnees){
        $this->hydrate($donnees);
    }

    /* SETTERS */
    public function setId($id)
    {
        # on pasre la valeur de l'id en INT
        $id = (int) $id;
        // On vérifie que l id superieur à zero
        if ($id > 0)
        {
            $this->id = $id;
        }
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setAdresse($adresse){
        $this->adresse = $adresse;
    }

    public function setVille($ville){
        $this->ville = $ville;
    }

    public function setCodepostal($codepostal){
        $this->codepostal = $codepostal;
    }


    /* GETTERS */
    public function getId()
    {
        return $this->id;
    }


    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getAdresse(){
        return $this->adresse;
    }

    public function getVille(){
        return $this->ville;
    }

    public function getCodepostal(){
        return $this->codepostal;
    }

}