<?php
class controllerHome extends GenericController{
    private ?ViewHome $viewHome;
    private ?ModelCategory $modelUser;

    //CONSTRUCTEUR
    public function __construct(?ViewHome $viewHome, ?ModelCategory $modelUser){
        $this->viewHome = $viewHome;
        $this->modelUser = $modelUser;
    }
    
    //GETTER ET SETTER
    public function getViewHome(): ?ViewHome { return $this->viewHome; }
    public function setViewHome(?ViewHome $viewHome): self { $this->viewHome = $viewHome; return $this; }

    public function getModelUser(): ?ModelCategory { return $this->modelUser; }
    public function setModelUser(?ModelCategory $modelUser): self { $this->modelUser = $modelUser; return $this; }

    //METHOD
    public function signIn():string{
        //1)Vérifier qu'on reçoit le formulaire
        if(isset($_POST['submit'])){
            //2) Vérifier les champs vides
            if(empty($_POST['nickname']) || empty($_POST['email']) || empty($_POST['password'])){
                return 'Remplissez tous les champs.';
            }

            //3) Vérifier le format des données
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                return "L'Email n'est pas au bon format";
            }

            //4) Nettoyer les données
            $nickname = sanitize($_POST['nickname']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);

            //5) Hasher le mot de passe
            $password = password_hash($password, PASSWORD_BCRYPT);

            //6) Vérifier que l'utilisateur n'existe pas déjà en BDD
            //6.1) Donner l'email au Model
            $this->getModelUser()->setEmail($email);

            //6.2) Demander au model d'utiliser getByEmail()
            $data = $this->getModelUser()->getByEmail();

            //6.3) Vérifier si les données sont vide ou pas
            if(!empty($data)){
                return "Cet email est déjà utilisé par un utilisateur.";
            }

            //7) Enregistrer l'utilisateur en BDD
            //7.1) Donner le pseudo et le mot de passe au Model
            $this->getModelUser()->setNickname($nickname)->setPassword($password);

            //7.2) Demander au model d'utiliser add()
            $data = $this->getModelUser()->add();

            //8) Retourne un message de confirmation
            return $data; 
        }
        return '';
        
    }

    public function readUsers():string{
        //1) Demander au Model d'utiliser getAll()
        $data = $this->getModelUser()->getAll();

        $usersList = '';
        //2) Boucler sur le tableau d'utilisateur
        foreach($data as $user){
            //3) Mettre en forme les données
            $usersList = $usersList."<li>{$user['nickname']} - {$user['email']}</li>";
        }
        
        //4) Retourne le formatage de mes données
        return $usersList;
    }

    public function render():void{
        //LANCEMENT DU TRAITEMENT DES DONNEES
        $message = $this->signIn();

        $usersList = $this->readUsers();

        //FAIRE LE RENDU
        echo $this->getViewHome()->setMessage($message)->setUsersList($usersList)->displayView();
    }
    public function signUp() {
        if (isset($_POST["submitConnexion"])) {
            if (!empty($_POST["emailConnexion"]) && !empty($_POST["passwordConnexion"])) {
    
                if (filter_var($_POST["emailConnexion"], FILTER_VALIDATE_EMAIL)) {
                    $emailConnexion = sanitize($_POST["emailConnexion"]);
                    $passwordConnexion = sanitize($_POST["passwordConnexion"]);
    
                    $bdd = connect();
                    
                    // Récupérer l'utilisateur en base de données
                    $user = $this->modelUser->getByEmail();
    
                    if (!empty($user)) {
                        // Vérifier le mot de passe hashé
                        if (password_verify($passwordConnexion, $user["password"])) {
                            // Démarrer la session et enregistrer l'utilisateur
                            session_start();
                            $_SESSION["user_id"] = $user["id"];
                            $_SESSION["user_email"] = $user["email"];
    
                            return "Connexion réussie";
                        } else {
                            return "Mot de passe incorrect";
                        }
                    } else {
                        return "Aucun compte trouvé avec cet email";
                    }
                }
                return "Email non valide";
            }
            return "Merci de remplir les champs obligatoires";
        }
        return "";
    }
}