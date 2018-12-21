<?php

class FormulesManager {

    private $_db;

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function __construct ($db)
    {
        $this->setDb($db);
    }

    public function add(Formule $formule)
    {
        // Préparation de la requête d'insertion.
        // Assignation des valeurs pour le Menu.
        // Exécution de la requête.

        $requeste = $this->_db->prepare('INSERT INTO Formules(NOM,PRIX,IMAGE) VALUES (:nom,:prix,:image)');

        $requeste = $this->_db->prepare('INSERT INTO Formules(NOM,PRIX,IMAGE) VALUES (:nom,:prix,:image)');

        $requeste->bindValue(':nom',$formule->getNom());
        $requeste->bindValue(':prix',$formule->getPrix());
        $requeste->bindValue(':image',$formule->getImage());

        $reponse = $requeste->execute();

        // Hydratation de Formule passé en paramètre avec assignation de son identifiant et du prix initial.
        $formule->hydrate(
            [   'id'   => $this->_db->lastInsertId(),
                'nom'  => $this->getNom(),
                'prix' => $this->getPrix()]
        );

        return $reponse;

    }

    public function count()
    {
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        $requeste = $this->_db->query('SELECT count(*) FROM Formules')->fetchColumn();

        return $requeste;

    }

    public function countOption($idDeFormule)
    {
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        $requeste = $this->_db->prepare('SELECT count(*) FROM Composer WHERE IDFORMULE=:id_formule');
        $requeste->execute(['id_formule' => $idDeFormule]);

        $requeste = $requeste->fecthColumn();

        return $requeste;
    }

    public function delete(Formule $formule)
    {
        // Exécute une requête de type DELETE  d'abord sur la table de relation Composer Option_Formule
        $reqDeSupp =$this->_db->exec('DELETE FROM Composer WHERE IDFORMULE = '.$formule->getId());

        // Exécute une requête de type DELETE sur la table Formule.
        $requeste = $this->_db->exec('DELETE FROM Formule WHERE ID = '.$formule->getId());

        return $requeste;
    }

    public function exists($info)
    {
        // Si le paramètre est un entier, c'est qu'on a fourni un identifiant.
        if(is_int($info)){
            // On exécute alors une requête COUNT() avec une clause WHERE, et on retourne un boolean.
            return (bool) $this->_db->query('SELECT COUNT(*) FROM Formules WHERE ID =' . $info)->fetchColumn();
        }
        // Sinon c'est qu'on a passé un nom.
        else {
            // Exécution d'une requête COUNT() avec une clause WHERE, et retourne un boolean.
            $requeste = $this->_db->prepare('SELECT COUNT(*) FROM Formules WHERE NOM = :nom');
            $requeste->execute([':nom' => $info]);

            return (bool) $requeste->fetchColumn();
        }
    }

    public function update(Formule $formule)
    {
        // Prépare une requête de type UPDATE.
        $requeste = $this->_db->prepare('UPDATE Formules SET NOM = :nom, PRIX = :prix, IMAGE = :image WHERE ID = :id');
        // Assignation des valeurs à la requête.
        $requeste->bindValue(':nom',$formule->getNom());
        $requeste->bindValue(':prix',$formule->getPrix());
        $requeste->bindValue(':image',$formule->getImage());
        $requeste->bindValue(':id',$formule->getId());

        // Exécution de la requête.
        $reponse = $requeste->execute();

        return $reponse;
    }

    public function updateSansImage(Formule $formule)
    {
        // Prépare une requête de type UPDATE.
        $requeste = $this->_db->prepare('UPDATE Formule SET NOM = :nom, PRIX = :prix WHERE ID = :id');
        // Assignation des valeurs à la requête.
        $requeste->bindValue(':id',$formule->getId());
        $requeste->bindValue(':nom',$formule->getNom());
        $requeste->bindValue(':prix',$formule->getPrix());

        // Exécution de la requête.
        $reponse = $requeste->execute();

        return $reponse;
    }


    public function getFormule($info)
    {
        // Si le paramètre est un entier, on veut récupérer la formule avec son identifiant.
        // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Formule.
        if(is_int($info)){
            $requeste = $this->_db->query('SELECT ID, NOM, PRIX, IMAGE FROM Formule WHERE ID = '.$info);

            $donnees = $requeste->fetch(PDO::FETCH_ASSOC);

            return new Formule($donnees);
        }
        // Sinon, on veut récupérer le personnage avec son nom.
        // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
        else {
            $requeste = $this->_db->prepare('SELECT ID, NOM, PRIX, IMAGE FROM Menus WHERE NOM = :nom');
            $requeste->execute([':nom' => $info]);

            $donnees = $requeste->fetch(PDO::FETCH_ASSOC);

            return new Formule($donnees);
        }
    }


    public function associationOptionFormule(int $idoption, int $idformule) {

        $requeste = $this->_db->prepare('INSERT INTO COMPOSER(IDOPTION,IDFORMULE) VALUES (:idoption,:idformule)');

        $requeste->bindValue(':idoption',$idoption);
        $requeste->bindValue('idformule',$idformule);

        $requeste->execute();

    }

    public function getPrixFormule(int $idformule)
    {

        $requeste = $this->_db->query('SELECT SUM(PRIX) AS prix_total_formule FROM Options INNER JOIN COMPOSER ON Options.id = COMPOSER.IDOPTION WHERE IDFORMULE = ' . $idformule);

        //test debug
        //  $request->debugDumpParams();
        //  $res = $request->fetch(PDO::FETCH_ASSOC);
        //  $res = $request->fetchColumn();

        // $res = $requeste->fetch(PDO::FETCH_NUM);
        $res = $requeste->fetch();

        // $res = $requeste;

        //  var_dump($res);

        return $res;
    }

    public function updatePrixFormule(int $id) {

        $newprix = $this->getPrixFormule($id);

        // var_dump($newprix['prix_total_formule']);

        $p = $newprix['prix_total_formule'];
        $p = (float) $p;

        // $prix = $newprix['prix_total_formule'];
        // $prix = (float) $prix;

        //  $requeste = $this->_db->query('SELECT SUM(PRIX) FROM Optiond INNER JOIN COMPOSER ON Options.ID = COMPOSER.IDOPTION  WHERE IDOPTION = '.$id);
        //
        //  $res = $q->fetch(PDO::FETCH_ASSOC);

        $r = $this->_db->prepare('UPDATE Formules SET PRIX = :prix WHERE ID = :id');
        // Assignation des valeurs à la requête.
        $r->bindValue(':id',$id);
        //  $r->bindValue(':prix',$newprix);
        $r->bindValue(':prix',$p);

        // Exécution de la requête.
        $r->execute();

    }


    public function selectAllFormules()
    {
        $formules = [];

        $requeste = $this->_db->query('SELECT ID, NOM, PRIX, IMAGE FROM Formules');

        while ($donnees = $requeste->fetch(PDO::FETCH_ASSOC))
        {
            // var_dump($donnees);
            $formules[] = new Menu($donnees);

            // $options[] = getOption($donnees['IDOPTION']);
        }

        return $formules;
    }

    public function faireCorrespondreOptionsFormule($idformule,$tabOptions)
    {
        foreach($tabOptions as $options)
        {
            $requeste = $this->_db->prepare('INSERT INTO Composer(IDOPTION,IDFORMULE) VALUES(:id_option,:id_formule)');

            $requeste->bindValue(':id_option',$tabOptions->getId());
            $requeste->bindValue(':id_formule',$idformule);

            $requeste->execute();
        }
    }

    public function selectAllOptionsFormules($idDeFormule)
    {
        $options = [];

        $requeste = $this->_db->query('SELECT ID, NOM, PRIX, IMAGE FROM Plats INNER JOIN Composer ON Options.ID = Composer.IDOPTION WHERE IDFORMULE='.$idDeFormule);

        while($donnees = $requeste->fetch(PDO::FETCH_ASSOC))
        {
            $options[] = new Option($donnees);
        }

        return $options;
    }

    public function suppressionCorrespondanceOptionsFormule($idformule)
    {
        // Exécute une requête de type DELETE  sur la table Plat.
        $requeste = $this->_db->exec('DELETE FROM Composer WHERE IDFORMULE ='.$idformule);

        return $requeste;
    }

}