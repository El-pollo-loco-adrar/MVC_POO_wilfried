<?php
    class ControllerAccount extends GenericController {
        private ?ViewAccount $viewAccount;

        public function __construct(?ViewAccount $newViewAccount){
            $this->viewAccount = $newViewAccount;
        }
    
        public function getViewAccount(): ?ViewAccount {
                return $this->viewAccount;
        }
        public function setViewAccount(?ViewAccount $viewAccount): self {
                $this->viewAccount = $viewAccount;
                return $this;
        }
        
    }
