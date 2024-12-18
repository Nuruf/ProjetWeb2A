
<?php
include_once __DIR__ . '/../config/config.php'; 
class CoursController {
    
    
    public function addUser($user) {
      
        $sql = "INSERT INTO utilisateur(Email, MotDePasse, Telephone, Utilisateur, Role) 
                VALUES (:email, :motdepasse, :telephone, :utilisateur, :role)"; 

       
        $db = config::getConnexion();

        try {
           
            $query = $db->prepare($sql);

          
            $query->execute([
                'email' => $user->getEmail(),
                'motdepasse' => $user->getMotDePasse(),
                'telephone' => $user->getTelephone(),
                'utilisateur' => $user->getUtilisateur(),
                'role' => $user->getRole()
            ]);

        } catch (Exception $e) {
            // Gestion des erreurs en cas d'exception
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    public function listUser()
    {
        $sql = "SELECT * FROM  utilisateur";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function deleteUser($id)
    {
        $sql = "DELETE FROM Utilisateur WHERE id = :Id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':Id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



    function updateUser($user, $id)
    {
        var_dump($user); 
        
        try {
         
            $db = config::getConnexion();
    
           
            $query = $db->prepare(
                'UPDATE Utilisateur SET 
                    Utilisateur = :name,
                    Email = :email,
                    MotDePasse= :motdepasse,
                    Telephone = :phone,
                    Role = :role
                WHERE Id = :id'
            );
    
          
            $query->execute([
                'id' => $id,
                'name' => $user->getUtilisateur(),
                'email' => $user->getEmail(),
                'motdepasse'=>$user->getMotDePasse(),

                'phone' => $user->getTelephone(),
                'role' => $user->getRole()
            ]);
    
           
            echo $query->rowCount() . " records UPDATED successfully <br>";
    
        } catch (PDOException $e) {
        
            echo "Error: " . $e->getMessage();
        }
    }
    public function getUserById($userId) {
    
        $db = new PDO("mysql:host=localhost;dbname=user", 'root', '');
        $query = "SELECT * FROM utilisateur WHERE Id = :userId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    
    /**/ 
    public function checkUser($email, $password)
{
    $sql = "SELECT * FROM utilisateur WHERE Email = :email";

    $db = config::getConnexion();

    try {
 
        $query = $db->prepare($sql);

        // Exécuter avec l'email fourni
        $query->execute([
            'email' => $email
        ]);

        // Récupérer l'utilisateur
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe
        if ($user) {
            // Vérifier le mot de passe (ajouter `password_verify` si le mot de passe est haché)
            if ($password === $user['MotDePasse']) {
                return $user; // Retourner les informations de l'utilisateur
            } else {
                return "Mot de passe incorrect.";
            }
        } else {
            return "Aucun utilisateur trouvé avec cet email.";
        }
    } catch (Exception $e) {
        // Gestion des erreurs
        echo 'Erreur: ' . $e->getMessage();
    }
}

    /*page dashboard front */
    public function getUserByIdd($id)
{
    $sql = "SELECT * FROM utilisateur WHERE Id = :id"; 
    $db = config::getConnexion();
    try {
        $stmt = $db->prepare($sql); 
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); 
        $stmt->execute(); 
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

    

}
?>


