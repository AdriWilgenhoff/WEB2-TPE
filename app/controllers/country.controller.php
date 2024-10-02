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

    function showCountries($message = null){
        AuthHelper::verify();
        $countries = $this->countryModel->getCountries();
        $this->countryView->showCountries($countries,$message);
    }

	function deleteCountry($id){
        //Valido que el pais exista
        $country = $this->countryModel->getCountryById($id);
        if (!empty($country)) {
            //Valido que el pais no tenga Atracciones
            $attractionsByCountry = new AttractionModel();
			$attractions = $attractionsByCountry->getAttractionByCountry($country->name);
            if (!empty($attractions)) {
                $this->layoutView->showError('No es posible eliminar. El pais tiene atracciones.');
				//$countries = $this->countryModel->getCountries();
				//$this->showCountries($countries,'No es posible eliminar. El pais tiene atracciones.');
            } else {
                $this->countryModel->deleteCountry($id);
				header('Location: ' . BASE_URL . 'paises');
            }
        } else 
            $this->layoutView->showError('No es posible eliminar. El pais no existe.');    
    }
  
  
    function addCountry(){
        AuthHelper::verify();
        $validation = $this->validateAndSanitizeFields(['name','language','currency']);
        if($validation){
			$countryExists = $this->countryModel->getCountryByName($_POST['name']); 
            if(!$countryExists){
				$id = $this->countryModel->addCountry($_POST['name'], $_POST['language'], $_POST['currency']);
				if ($id) {
					header('Location: ' . BASE_URL . 'paises');
				} else {
					$this->layoutView->showError('Error al insertar pais.');
				}
			} else {
				$this->layoutView->showError('Error al insertar pais. El nombre ya existe');
			}
        } else {
			$this->layoutView->showError('Error al insertar pais. Falta completar datos');
		  } 
    }


    function updateCountry($id){
        AuthHelper::verify();
        $validation = $this->validateAndSanitizeFields(['name','language','currency']);
		//Verificar el nombre FALTA
        if($validation){
            $this->countryModel->updateCountry($_POST['name'],$_POST['language'],$_POST['currency'], $id);
            header('Location: ' . BASE_URL . 'paises');
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
	
}

