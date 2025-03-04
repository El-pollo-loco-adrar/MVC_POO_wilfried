<?php
session_start();
    class ViewAccount{
        public function displayView():string{
            $message = "";
            if(isset($_SESSION['login']) && !empty($_SESSION['login']) && isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                $this->message = $_SESSION['login'];
            } else {
                $this->message = "Aucune session active.";
            }
    
    
            return "
            <section>
                <h1>Mon compte</h1>
                <p>Bienvenue, <strong>{$this->$message}</strong> !</p>
            </section>";
        
            
        }
    }