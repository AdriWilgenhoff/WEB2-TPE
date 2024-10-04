<?php
require_once 'db.model.php';

class CountryModel extends Model{
    
    //Recupera Paises
    public function getCountries(){
        //$query = $this->db->prepare("SELECT * FROM countries");
		$query = $this->db->prepare("SELECT c.* , COUNT(a.country_id) AS count_attractions FROM countries c LEFT JOIN attractions a ON a.country_id = c.id GROUP BY c.id");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);       
    }
    
    //Recupera Pais por el Id
    public function getCountryById($id){
        $query = $this->db->prepare("SELECT * FROM countries WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);       
    }
	
	//Recupera Pais por el nombre
	public function getCountryByName($name){
        $query = $this->db->prepare("SELECT * FROM countries WHERE name = ?");
        $query->execute([$name]);
        return $query->fetch(PDO::FETCH_OBJ);       
    }
    
    //Inserta Pais
    public function addCountry($name, $language, $currency){
        $query = $this->db->prepare("INSERT INTO countries (name, language, currency) VALUES(?,?,?)");
        $query->execute([$name, $language, $currency]);
        return $this->db->lastInsertId();
    }

    //Elimina Pais
	public function deleteCountry($id){
        $query = $this->db->prepare('DELETE FROM countries WHERE id = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }
	
    //Modifica Pais
    public function updateCountry($name, $language, $currency, $country_id){
        $query = $this->db->prepare("UPDATE countries SET name = ?, language = ?, currency = ? WHERE id = ?");
        $query->execute([$name, $language, $currency, $country_id]);
        return $query->rowCount();
    }

   
}
