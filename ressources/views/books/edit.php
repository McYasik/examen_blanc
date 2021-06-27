<div><a href="<?= URL ?>" style="color:black;">Retour à l'accueil</a></div>

<h2>Editer mon livre</h2>

<div class="addBook">
    <form action="<?= URL ?>ma_liste/update/<?= $data['livre']->id ?>" method="POST">
        <div>
            <label for="name"><strong>Nom</strong></label><br>
            <input type="text" name="name" id="name"  required value="<?= $data["livre"]->name ?>">

            <?php if(isset($_SESSION['errors']['name']) && !empty($_SESSION['errors']['name'])) : ?>
                <?php foreach($_SESSION['errors']['name'] as $error) : ?>
                    <div class="text-danger">
                        <?= $error ?>
                        <?php break; ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
            <?php unset($_SESSION['errors']['name']); ?>
        </div>

        <div>
            <label for="auteur"><strong>Auteur</strong></label><br>
            <input type="text" name="auteur" id="auteur"  required value="<?= $data["livre"]->auteur ?>">

            <?php if(isset($_SESSION['errors']['auteur']) && !empty($_SESSION['errors']['auteur'])) : ?>
                <?php foreach($_SESSION['errors']['auteur'] as $error) : ?>
                    <div class="text-danger">
                        <?= $error ?>
                        <?php break; ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
            <?php unset($_SESSION['errors']['auteur']); ?>
        </div>

        <div>
            <label for="note"><strong>Note sur 20</strong></label><br>
            <input type="number" id="note" name="note"
       min="1" max="20" value="<?= $data["livre"]->note ?>">

            <?php if(isset($_SESSION['errors']['note']) && !empty($_SESSION['errors']['note'])) : ?>
                <?php foreach($_SESSION['errors']['note'] as $error) : ?>
                    <div class="text-danger">
                        <?= $error ?>
                        <?php break; ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
            <?php unset($_SESSION['errors']['note']); ?>
        </div>

        <div>
            <label for="avis"><strong>Avis</strong></label><br>
            <textarea name="avis" id="avis" rows="6"><?= $data["livre"]->avis ?></textarea>

            <?php if(isset($_SESSION['errors']['avis']) && !empty($_SESSION['errors']['avis'])) : ?>
                <?php foreach($_SESSION['errors']['avis'] as $error) : ?>
                    <div class="text-danger">
                        <?= $error ?>
                        <?php break; ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
            <?php unset($_SESSION['errors']['avis']); ?>
        </div>

        <div class="submit">
            <button type="submit"><strong>Enregistrer</strong></button>
        </div>
    </form>
</div>