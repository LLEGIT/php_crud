<?php
class MyDataBase {
    private $user;
    private $password;
    private $dbh;

    public function __construct()
    {
        $this->user = 'root';
        $this->password = 'mysqlisagreattool';

        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=php_crud_db', $this->user, $this->password);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
    }

    public function add_infos($name, $comment) {
        $name = $this->dbh->quote($name);
        $comment = $this->dbh->quote($comment);

        $sql = "INSERT INTO infos (name, comment) VALUES ($name, $comment)";
        try {
            $this->dbh->query($sql);
        }
        catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die(); 
        }
    }

    public function get_all_infos() {
        $sql = 'SELECT * FROM infos';
        $infos_arr = [];
        try {
            foreach ($this->dbh->query($sql) as $key => $value) {
                array_push($infos_arr, $value);
            }
            echo (json_encode($infos_arr));
        }
        catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function update_infos($id, $name, $comment) {
        $id = $this->dbh->quote($id);
        $name = $this->dbh->quote($name);
        $comment = $this->dbh->quote($comment);
        
        $sql = "UPDATE infos SET name = $name, comment = $comment WHERE id=$id";
        try {
            $this->dbh->query($sql);
        }
        catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die(); 
        }
    }

    public function delete_infos($id) {
        $sql = "DELETE FROM infos WHERE id = $id";
        try {
            $this->dbh->query($sql);
        }
        catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die(); 
        }
    }
}