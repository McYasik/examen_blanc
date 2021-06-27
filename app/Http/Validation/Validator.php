<?php

    namespace App\Http\Validation;

    use PDO;

    class Validator
    {
        private $_post;
        private $errors;

        public function __construct($_post)
        {
            $this->_post = $_post;
        }

        public function validate(array $validation_tab)
        {
            foreach ($validation_tab as $name => $rules)
            {
                if (array_key_exists($name, $this->_post))
                {
                    foreach ($rules as $rule)
                    {
                        if ($rule === "required")
                        {
                            $this->required($this->_post[$name], $name);
                        }

                        else if ($rule === "string")
                        {
                            $this->string(htmlspecialchars($this->_post[$name]), $name);
                        }

                        else if(substr($rule,0,3) === "min")
                        {
                            $this->min($name, $this->_post[$name], $rule);
                        }

                        else if(substr($rule, 0, 14) === "uniqueOnCreate")
                        {
                            $auteur_clean = htmlspecialchars(addslashes(trim($_POST["auteur"])));
                            $this->uniqueOnCreate($this->_post[$name], $auteur_clean, $name, $rule);
                        }

                        else if(substr($rule, 0, 14) === "uniqueOnUpdate")
                        {
                            $auteur_clean = htmlspecialchars(addslashes(trim($_POST["auteur"])));
                            $this->uniqueOnUpdate($this->_post[$name], $name, $rule, $auteur_clean);
                        }

                        else if($rule === "int")
                        {
                            $this->int($this->_post[$name], $name);
                        }

                        // else if(substr($rule, 0, 8) === "interval")
                        // {
                        //     var_dump($rule); die();
                        //     $this->interval($this->_post[$name], $name, $rule);
                        // }
                    }
                }
            }

            return $this->getErrors();
        }

        public function getErrors()
        {
            return $this->errors;
        }

        public function min($name, $value, $rule) 
        { 
            preg_match_all("/\d+/", $rule, $matches);
            $minimum = intval($matches[0][0]);

            if (mb_strlen($value) < $minimum) 
            {
                $this->errors[$name][] = "Veuillez entrer au minimum " . $minimum . " caractères.";
            }
        }
        
        // public function interval($value, $name, $rule)
        // {
        //     preg_match_all("/\d+/", $rule, $matches);
        //     var_dump($matches); die();

        //     $minimum = 1;
        //     $maximum = 2;
        //     $this->errors[$name][] = "Veuillez entrer un chiffre entre " . $minimum . " et " . $maximum;
        // }

        public function required($value, $name)
        {
            $value = trim($value);
            if (!isset($value) || empty($value))
            {
                $this->errors[$name][] = "Ceci est obligatoire.";
            }
        }

        public function string($value, $name)
        {
            if (!preg_match("/^[\A-Z\_\d\'\-\sàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$/i", $value))
            {
                $this->errors[$name][] = "Veuillez entrer une chaine de caractères valide.";
            }
        }

        public function int($value, $name)
        {
            if (!is_numeric($value))
            {
                $this->errors[$name][] = "Veuillez entrer un nombre ou un chiffre.";
            }
        }

        public function uniqueOnCreate($value, $auteur_clean, $name, $rule)
        {
            $table = strstr($rule, ":");
            $table = str_replace(":", "", $table);

            $dsn = 'mysql:dbname=examen;host=127.0.0.1;';
            $user = 'root';
            $password = '';

            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            $req = $db->prepare("SELECT * FROM {$table} WHERE name=:name AND auteur=:auteur");
            $req->bindValue(":name", $value, PDO::PARAM_STR);
            $req->bindValue(":auteur", $auteur_clean, PDO::PARAM_STR);
            $req->execute();
            $row = $req->rowCount();

            if($row == 1)
            {
                $data = $req->fetch();
                $req->closeCursor();
                $this->errors[$name][] = "Ce livre existe déjà.";
            }
            else
            {
                $req->closeCursor();
                return false;
            }

        }

        public function uniqueOnUpdate($value, $name, $rule, $auteur_clean)
        {

            $rule = strstr($rule, "^");
            preg_match_all("/\d+/", $rule, $matches);
            $id = intval($matches[0][0]);

            $table = strstr($rule, ":"); 
            $table = str_replace(":", "", $table);

            $dsn = 'mysql:dbname=examen;host=127.0.0.1;';
            $user = 'root';
            $password = '';

            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            $req = $db->prepare("SELECT * FROM {$table}");
            $req->execute();
            $livres = $req->fetchAll();
            $req->closeCursor();

            foreach ($livres as $livre) 
            {
                if ($livre->id != $id) 
                {
                    if ($livre->name == $value && $livre->auteur == $auteur_clean) 
                    {
                        $this->errors[$name][] = "Ce livre existe déjà.";
                    }
                }
            }
        }
    }