<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 26/12/18
 * Time: 13:21
 */

class FormulesManager
{
    private $_db;

    /**
     * FormulesManager constructor.
     * @param $_db
     */
    public function __construct($_db)
    {
        $this->_db = $_db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

    public function add($formule){
        // Préparation de la requête d'insertion.
        // Assignation des valeurs pour l'option.
        $request = $this->_db->prepare('INSERT INTO Formules (NOM,PRIX,IMAGE) VALUES (:nom,:prix,:image)');

        $request->bindParam(':nom', $formule->getNom());
        $request->bindParam(':prix', $formule->getPrix());
        $request->bindParam(':image', $formule->getImage());

        //Execution de la requête.
        $res = $request->execute();

        // Hydratation du plat passé en paramètre avec assignation de identifiant et du prix initial.
        $formule->hydrate(
            [   'id'    => $this->_db->lastInsertId(),
                'nom'   => $formule->getNom(),
                'prix'  => $formule->getPrix(),
                'image' => $formule->getImage()]
        );
        return $res;
    }

    public function count(){
        // Execute une requête COUNT() et retourne le nombre de résultats retourné.
        //fetchColumn — Retourne une colonne depuis la ligne suivante d'un jeu de résultats.
        $request = $this->_db->query('SELECT count(*) FROM Formules ')->fetchColumn();

        return $request;
    }


    public function countOptionsAssociatedToFormuleId($formuleId)
    {
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        $request = $this->_db->prepare('SELECT count(*) FROM Composer WHERE IDFORMULE=:id_formule');

        $request->execute([':id_formule' => $formuleId]);

        $resultat = $request->fetchColumn();

        return $resultat;
    }

    public function delete(Formule $formule)
    {
        //Execute une requête de type DELETE d'abord sur la table de relation Composer Option_Formule
        $this->_db->exec('DELETE FROM Composer WHERE IDFORMULE = '. $formule->getId());

        // Execute une requête de type DELETE sur la table Option
        $request = $this->_db->exec('DELETE FROM Formules WHERE ID = '.$formule->getId());

        return $request;
    }

    public function getFormule($id){

        $request = $this->_db->query('SELECT ID, NOM, PRIX, IMAGE FROM Formules WHERE id = '. $id);

        $donnees = $request->fetch(PDO::FETCH_ASSOC);

        $obj = new Formule($donnees);

        return $obj;

    }


    public function exists($info){

        if(is_int($info)){

            return (bool) $this->_db->query('SELECT count(*) FROM Formules WHERE ID =' . $info)->fetchColumn();
        }
        else{
            $request = $this->_db->prepare('SELECT count(*) FROM Formules WHERE NOM = :nom');

            $request->bindParam(':nom', $info);

            $request->execute();

            return (bool) $request->fetchColumn();
        }

    }

    public function update(Formule $formule)
    {
        // Prépare une requête de type UPDATE.
        $request = $this->_db->prepare('UPDATE Formules SET NOM = :nom, PRIX = :prix, IMAGE = :image WHERE ID = :id');

        // Assignation des valeurs à la requête.
        $request->bindValue(':id',$formule->getId());
        $request->bindValue(':nom',$formule->getNom());
        $request->bindValue(':prix',$formule->getPrix());
        $request->bindValue(':image',$formule->getImage());

        // Exécution de la requête.
        $reponse = $request->execute();

        return $reponse;

    }

    public function updateSansImage(Formule $formule)
    {
        // Prépare une requête de type UPDATE.
        $request = $this->_db->prepare('UPDATE Formules SET NOM = :nom, PRIX = :prix WHERE ID = :id');

        // Assignation des valeurs à la requête.
        $request->bindValue(':id',$formule->getId());
        $request->bindValue(':nom',$formule->getNom());
        $request->bindValue(':prix',$formule->getPrix());

        // Exécution de la requête.
        $reponse = $request->execute();

        return $reponse;
    }


    public function associationOptionFormule($id_option, $id_formule){

        $request = $this->_db->prepare('INSERT INTO Composer(IDOPTION,IDFORMULE) VALUES(:idoption,:idformule)');

        $request->bindValue(':idoption',$id_option);
        $request->bindValue(':idformule',$id_formule);

        // Exécution de la requête.
        $reponse = $request->execute();

        return $reponse;

    }


    public function getFormuleFullPrice($id_formule){

        $request = $this->_db->query('SELECT SUM(PRIX) AS prix_total_formule FROM Options 
                                INNER JOIN Composer ON Options.ID = Composer.IDOPTION  
                                WHERE Composer.IDFORMULE = '. $id_formule);

        $reponse = $request->fetch(PDO::FETCH_ASSOC);

        $resultat = floatval($reponse["prix_total_formule"]);

        return $resultat;

    }

    public function updatePrixFormule($id){

        $full_price = $this->getFormuleFullPrice($id);

        //  $res = $q->fetch(PDO::FETCH_ASSOC);
        $request = $this->_db->prepare('UPDATE Formules SET PRIX = :prix WHERE ID = :id');

        // Assignation des valeurs à la requête.
        $request->bindValue(':id',$id);
        $request->bindValue(':prix',$full_price);

        // Exécution de la requête.
        $reponse = $request->execute();

        return $reponse;
    }


    public function selectAllFormules()
    {
        $formules = [];

        $request = $this->_db->query('SELECT ID, NOM, PRIX, IMAGE FROM Formules');

        while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
        {
            $formules[] = new Formule($donnees);
        }
        return $formules;
    }


    public function selectAllOptionsFromFormule($id_formule)
    {
        $options = [];
        $request = $this->_db->query('SELECT ID, NOM, PRIX, IMAGE 
                                      FROM Options INNER JOIN Composer 
                                      ON Options.ID = Composer.IDOPTION WHERE IDFORMULE=' . $id_formule);

        while($donnees = $request->fetch(PDO::FETCH_ASSOC))
        {
            $options[] = new Option($donnees);
        }
        return $options;
    }


    public function suppressionCorrespondanceOptionsFormule($id_formule)
    {
        // Exécute une requête de type DELETE  sur la table Composer.
        $request = $this->_db->exec('DELETE FROM Composer WHERE IDFORMULE =' . $id_formule);

        return $request;
    }


}