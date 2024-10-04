<?php
require_once 'app/models/country.model.php';
require_once 'app/models/attractions.model.php';
require_once 'app/views/country.view.php';
require_once 'app/views/layout.view.php';

class CountryController
{
    private $countryView;
    private $layoutView;
    private $countryModel;

    function __construct(){
        AuthHelper::init();
        $this->countryModel = new CountryModel();
        $this->countryView = new CountryView();
        $this->layoutView = new LayoutView();
    }

    function showCountries(){
        AuthHelper::verify();
        $countries = $this->countryModel->getCountries();
        $this->countryView->showCountries($countries);
    }

	function deleteCountry($id){
        $country = $this->countryModel->getCountryById($id);
        if (!empty($country)) {
            $attractionsByCountry = new AttractionModel();
			$attractions = $attractionsByCountry->getAttractionByCountry($country->name);
            if (!empty($attractions)) {
                $this->layoutView->showError('No es posible eliminar. El pais tiene atracciones.');
				header('Refresh: 5; URL=' . BASE_URL . 'paises');
            } else {
                $this->countryModel->deleteCountry($id);
				header('Location: ' . BASE_URL . 'paises');
            }
        } else 
            $this->layoutView->showError('No se pudo eliminar, el pais no existe');    
    }
  
    function addCountry(){
        AuthHelper::verify();
        $validation = $this->validateAndSanitizeFields(['name', 'language', 'currency']);
        if ($validation) {            
            if (!$this->isDuplicateName($_POST['name'],null)) {
                $id = $this->countryModel->addCountry($_POST['name'], $_POST['language'], $_POST['currency']);
                if ($id) {
                    header('Location: ' . BASE_URL . 'paises');
                } else {
                    $this->layoutView->showError('No se pudo agregar el país.');
                }
            } else {
                $this->layoutView->showError('El nombre del país ya existe.');
            }
        } else {
            $this->layoutView->showError('No se pudo agregar el país, faltan completar datos.');
        }
    }


    function updateCountry($id){
        AuthHelper::verify();
        $validation = $this->validateAndSanitizeFields(['name', 'language', 'currency']);
        if ($validation) {
            if (!$this->isDuplicateName($_POST['name'], $id)) {
                $this->countryModel->updateCountry($_POST['name'], $_POST['language'], $_POST['currency'], $id);
                header('Location: ' . BASE_URL . 'paises');
            } else {
                $this->layoutView->showError('El nombre del país ya existe.');
            }
        } else {
            $this->layoutView->showError('No se pudo modificar el país, faltan completar datos.');
        }
    }
    
    function validateAndSanitizeFields($fields){
        foreach ($fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field]))
                return false;
			$_POST[$field] = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
        }
        return true;
    }
		
    function showFormAddCountry(){
        AuthHelper::verify();
        return $this->countryView->showFormAddCountry();
	}
    	
	function showFormUpdateCountry($id){
        AuthHelper::verify();
        $country = $this->countryModel->getCountryById($id);
        return $this->countryView->showFormUpdateCountry($country);
    }
    
    private function isDuplicateName($name, $countryId = null){
        $existingCountry = $this->countryModel->getCountryByName($name);
        if ($existingCountry) {
            return $countryId ? $existingCountry->id != $countryId : true;
        }
        return false;
    }


}