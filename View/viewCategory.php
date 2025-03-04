<?php

class ViewCategory{
    private ?string $message;
    private ?string $categoryList;

    public function __construct(string $newMessage, ?string $newCategoryList){
        $this->message = $newMessage;
        $this->categoryList = $newCategoryList;
    }


    public function getMessage(): ?string {
        return $this->message;
    }
    public function setMessage(?string $message): self {
        $this->message = $message;
        return $this;
    }


    public function getCategoryList(): ?string {
        return $this->categoryList;
    }
    public function setCategoryList(?string $categoryList): self {
        $this->categoryList = $categoryList;
        return $this;
    }

    public function displayView(): ?string{
        return 
        "<h2>Ajouter une catégorie</h2>
    <form action=''action=addCategory' method='post'>
        <label for='categoryName'>Nom de la catégorie :</label>
        <input type='text' id='categoryName' name='categoryName' required>
        <button type='submit'>Ajouter</button>
    </form>

    <?php if (!empty({$this->message}): ?>
        <p><?= htmlspecialchars($this->message) ?></p>
    <?php endif; ?>

    <h2>Liste des catégories</h2>
    <section>
        <?= $this->categoryList ?: '<p>Aucune catégorie enregistrée.</p>' ?>
    </section>
";
    }
}