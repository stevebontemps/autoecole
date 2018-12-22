<?php

class OptionsManager{

    private $_db;

    /**
     * @param mixed $db
     */
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(Option $option)
    {
        // Préparation de la requête d'insertion.
        // Assignation des valeurs pour le plat.
        // Exécution de la requête.

        $requeste = $this->_db->prepare('INSERT INTO options (NOM,PRIX,IMAGE) VALUES (:nom,:prix;:image)');

        $requeste->bindValue(':nom', $option->getNom());
        $requeste->bindValue(':prix', $option->getPrix());
        $requeste->bindValue(':image',$option->getImage());

        // $requeste->bindValue(':nom',$option->getNom(),PDO::PARAM_STR);
        // $requeste->bindValue(':prix',0.0);
        // $requeste->bindValue(':image','hello.jpg');

        //Execution de la requête.
        $reponse =$requeste->execute();

        // $requeste = bindValue(':degats',$perso->_degats,PDO::PARAM_INT);
        //  $requeste = bindValue(':degats',0);


        // Hydratation du plat passé en paramètre avec assignation de identifiant et du prix initial.
        $option->hydrate(
            [   'id'    => $this->_db->lastInsertId(),
                'nom'   => $option->getNom(),
                'prix'  => $option->getPrix()]
        );

        return $reponse;

    }

    public function count()
    {
        // Execute une requête COUNT() et retourne le nombre de résultats retourné.
        //fetchColumn — Retourne une colonne depuis la ligne suivante d'un jeu de résultats.
        $requeste = $this->_db->query('SELECT count(*) FROM Options ')->fetchColumn();

        return $requeste;
    }

    public function delete(Option $option)
    {
        //Execute une requête de type DELETE d'abord sur la table de relation Composer Option_Formule
        $d = $this->_db->exec('DELETE FROM Composer WHERE IDOPTION = '. $option->getId());

        // Execute une requête de type DELETE sur la table Option
        $requeste = $this->_db->exec('DELETE FROM Options WHERE ID = '.$option->get());

        return $requeste;
    }

    public function exists($info)
    {
        //si le paramètre est un entier, c'est qu'on a fourni un identifiant.
        if(is_int($info)){
            // Execution alors alors une requête COUNT() avec une clause WHERE, et on retourne un boolean.
            return(bool) $this->_db->query('SELECT COUNT(*) FROM Options WHERE ID = '.$info)->fecthColumn();

            return(bool) $requeste->fecthColumn();
        }
    }

    public function update(Option $option)
    {
        // Prépare une requête de type UPDATE.
        $requeste = $this->_db->prepare('UPDATE Options SET NOM = :nom, PRIX = :prix, IMAGE = :image WHERE ID = :id');
        //Assignation des valeurs à la requête.
        $requeste->bindValue(':id',$option->getId());
        $requeste->bindValue(':nom',$option->getNom());
        $requeste->bindValue(':prix',$option->getPrix());
        $requeste->bindValue(':image',$option->getImage());

        // Execution de la requête.
        $requeste->execute();

        // Execution de la requête.
        $reponse = $requeste->execute();

        return $reponse;
    }


    public function updateSansImage(Option $option)
    {
        // Prépare une requête de type UPDATE.
        $requeste = $this->_db->prepare('UPDATE Options SET NOM = :nom, PRIX = :prix WHERE ID = :id');
        $requeste->bindValue(':id', $option->getId());
        $requeste->bindValue(':nom',$option->getNom());
        $requeste->bindValue(':prix',$option->getPrix());

        // Execution de la requête.
        $reponse = $requeste->execute();

        return $reponse;
    }

    public function getOption($id){

        $requeste = $this->_db->query('SELECT ID, PRIX, IMAGE FROM Options WHERE id ='.id);

        $donnees = $requeste->fetch(PDO::FETCH_ASSOC);

        return newOption($donnees);
    }

    public function selectAllOptions()
    {
        $options = [];

        $requeste = $this->_db->query('SELECT ID, NOM, PRIX, IMAGE FROM Options');

        while ($donnees = $requeste->fetch(PDO::FETCH_ASSOC))
        {
            // var_dump($donnees);
            $options[] = new Option($donnees);

        }
        return $options;

    }

}