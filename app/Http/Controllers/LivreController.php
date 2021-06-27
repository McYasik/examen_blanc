<?php

namespace App\Http\Controllers;

use App\Models\Livres;
use App\Http\Validation\Validator;
use App\Http\Controllers\Controller;

    class LivreController extends Controller
    {
        public function index()
        {
            $livres = Livres::all();
            return $this->view("books/ma_liste", compact("livres"));
        }

        public function create()
        {
            return $this->view("books/create");
        }

        public function store()
        {
            if ($_SERVER['REQUEST_METHOD'] === "POST")
            {
                $validator = new Validator($_POST);

                $errors = $validator->validate([
                    "name" => ['required', 'string', 'min:2', 'uniqueOnCreate:livres'],
                    "auteur" => ['required', 'string', 'min:2'],
                    "note" => ['int', 'inTmin:1', 'inTmax:20'],
                    "avis" => ['required', "min:5"],
                ]);

                // var_dump($errors); die();
                
                if ($errors) // Gestion des erreurs
                {
                    $_SESSION['errors'] = $errors;

                    foreach ($_POST as $key => $value)
                    {
                        $_SESSION['previous_input'][$key] = $value;
                    }

                    return $this->redirect_back();
                }

                // stockage des données
                $name_clean = htmlspecialchars(addslashes(trim($_POST["name"])));
                $auteur_clean = htmlspecialchars(addslashes(trim($_POST["auteur"])));
                $avis_clean = htmlspecialchars(addslashes(trim($_POST["avis"])));
                $note_clean = htmlspecialchars(addslashes(trim($_POST["note"])));

                Livres::create($name_clean, $auteur_clean, $avis_clean, $note_clean);

                // redirection avec succès
                $_SESSION['success'] = "Votre livre a été ajouté avec succès.";

                return $this->redirect_to_url("add");
            }
        }

        public function delete($id)
        {
            $id = intval($id);

            Livres::delete($id);

            $_SESSION['success'] = "Ce livre a été retiré de la liste.";
            return $this->redirect_to_url("ma_liste");
        }

        public function edit($id)
        {
            $livre = Livres::find_By_Id($id);

            if (isset($livre) && !empty($livre)) 
            {
                return $this->view("books/edit", compact('livre'));
            }
            else
            {
                return $this->redirect_back();
            }
        }

        public function update($id)
        {
            if ($_SERVER['REQUEST_METHOD'] === "POST")
            {
                $validator = new Validator($_POST);

                $errors = $validator->validate([
                    "name" => ['required', 'string', 'min:2', "uniqueOnUpdate^$id:livres"],
                    "auteur" => ['required', 'string', 'min:2'],
                    "note" => ['int', 'interval:1-20'],
                    "avis" => ['required', 'min:5'],
                ]);
                
                if ($errors) // Gestion des erreurs
                {
                    $_SESSION['errors'] = $errors;

                    return $this->redirect_back();
                }

                // stockage des données
                $name_clean = htmlspecialchars(addslashes(trim($_POST["name"])));
                $auteur_clean = htmlspecialchars(addslashes(trim($_POST["auteur"])));
                $avis_clean = htmlspecialchars(addslashes(trim($_POST["avis"])));
                $note_clean = htmlspecialchars(addslashes(trim($_POST["note"])));

                Livres::update($name_clean, $auteur_clean, $avis_clean, $note_clean, $id);

                // redirection avec succès
                $_SESSION['success'] = "Votre livre a été modifié avec succès.";

                return $this->redirect_to_url("ma_liste");
            }
        }
    }