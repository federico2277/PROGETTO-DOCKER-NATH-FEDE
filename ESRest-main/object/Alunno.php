<?php

/**
 * Description of alunno
 *
 */
class Alunno
{

    // database connection and table name
    private $conn;
    private $table_name = "ALUNNO";

    // object properties
    public $id;
    public $nome;
    public $cognome;
    public $codice_fiscale;
    public $data_nascita;
    public $id_classe;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read students
    function read()
    {
        // select all query
        $query = "SELECT *
            FROM
                " . $this->table_name . "
            ORDER BY
                id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create student
    function create()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nome=:nome,
                cognome=:cognome,
                codice_fiscale=:codice_fiscale,
                data_nascita=:data_nascita,
                id_classe=:id_classe";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cognome = htmlspecialchars(strip_tags($this->cognome));
        $this->codice_fiscale = htmlspecialchars(strip_tags($this->codice_fiscale));
        $this->data_nascita = htmlspecialchars(strip_tags($this->data_nascita));
        $this->id_classe = htmlspecialchars(strip_tags($this->id_classe));

        // bind values
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cognome", $this->cognome);
        $stmt->bindParam(":codice_fiscale", $this->codice_fiscale);
        $stmt->bindParam(":data_nascita", $this->data_nascita);
        $stmt->bindParam(":id_classe", $this->id_classe);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // update the student ragazza nat deve continuare a lavorare


    function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                dept_name = :name
            WHERE
                dept_id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nickname = htmlspecialchars(strip_tags($this->nickname));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':nickname', $this->nickname);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // delete the students
    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_nickname . " WHERE dept_id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
