<?php

class ControllerCategory extends GenericController{
    private ?viewCategory $viewCategory;
    private ?ModelCategory $modelCategory;

    public function __construct(?ViewCategory $newViewCategory, ?ModelCategory $newModelCategory) {
        $this->viewCategory = $newViewCategory;
        $this->modelCategory = $newModelCategory;
    }


    public function getViewCategory(): ?viewCategory {
        return $this->viewCategory;
    }
    public function setViewCategory(?viewCategory $newViewCategory): self {
        $this->viewCategory = $newViewCategory;
        return $this;
    }


    public function getModelCategory(): ?ModelCategory {
        return $this->modelCategory;
    }
    public function setModelCategory(?ModelCategory $newModelCategory): self {
        $this->modelCategory = $newModelCategory;
        return $this;
    }
}