<div><a href="<?= URL ?>" style="color:black;">Retour à l'accueil</a></div>

<h2>Ma liste de livres</h2>

    <div class="alert-div">
        <?php if(isset($_SESSION["success"]) && !empty($_SESSION["success"])) : ?>
            <div class="alert-success" role="alert">
                <?= $_SESSION["success"] ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif ?>
    </div>

    <?php if(isset($data['livres']) && !empty($data['livres'])) : ?>

        <div class="tableLivres">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Auteur</th>
                        <th>Note</th>
                        <th>Avis</th>
                        <th>Date de création</th>
                        <th>Date de modification</th>
                        <th>Paramètres</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data["livres"] as $livre) : ?>
                        <tr>
                            <td><strong><?= $livre->name ?></strong></td>
                            <td><?= $livre->auteur ?></td>
                            <td><?= $livre->note ?></td>
                            <td><i><?= $livre->avis ?></i></td>
                            <td><?= $livre->created_at ?></td>

                            <td>
                                <?php if ($livre->modified_at != $livre->created_at) :?>
                                    <?= $livre->modified_at ?>
                                <?php else : ?>
                                    <p>-</p>
                                <?php endif ?>
                            </td>

                            <td>
                                <button class="btn-edit"><a href="<?= URL ?>ma_liste/edit/<?=$livre->id?>">modifier</a></button>
                                <button class="btn-delete"><a href="<?= URL ?>ma_liste/delete/<?=$livre->id?>">supprimer</a></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    <?php else : ?>

        <h3>Pas de livre pour le moment.</h3>

    <?php endif ?>