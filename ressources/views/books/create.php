<div><a href="<?= URL ?>" style="color:black;">Retour à l'accueil</a></div>

<h2>Ajouter un livre</h2>

<div class="addBook">

<?php if(isset($_SESSION["success"]) && !empty($_SESSION["success"])) : ?>
    <div class="alert-success" role="alert">
        <?= $_SESSION["success"] ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif ?>

    <form action="<?= URL ?>store" method="POST">
        <div>
            <label for="name"><strong>Nom</strong></label><br>
            <input type="text" name="name" id="name"  required value="<?php echo $_SESSION['previous_input']['name'] ?? ''; unset($_SESSION['previous_input']['name']); ?>">

            <?php if(isset($_SESSION['errors']['name']) && !empty($_SESSION['errors']['name'])) : ?>  <!-- afficher erreur -->
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
            <input type="text" name="auteur" id="auteur"  required value="<?php echo $_SESSION['previous_input']['auteur'] ?? ''; unset($_SESSION['previous_input']['auteur']); ?>">

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
       min="1" max="20" value="<?php echo $_SESSION['previous_input']['note'] ?? '1'; unset($_SESSION['previous_input']['avis']); ?>">

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
            <textarea name="avis" id="avis" rows="6"><?php echo $_SESSION['previous_input']['avis'] ?? ''; unset($_SESSION['previous_input']['avis']); ?></textarea>

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