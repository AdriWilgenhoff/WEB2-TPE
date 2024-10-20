<?php
require_once 'app/models/attractions.model.php';
require_once 'app/models/country.model.php';
require_once 'app/views/layout.view.php';
require_once 'app/views/attractions.view.php';

class AttractionsController
{
    private $attractionModel;
    private $layoutView;
    private $attractionsView;
    private $countryModel;

    public function __construct(){
        AuthHelper::init();
        $this->attractionModel = new AttractionModel();
        $this->countryModel = new CountryModel();
        $this->layoutView = new LayoutView();
        $this->attractionsView = new AttractionsView();
    }

    public function showAttractions(){
        $attractions = $this->attractionModel->getAttractions();
        $countries = $this->countryModel->getCountries();
        $selectedCountry = $this->getSelectedCountry();
        $error = null;
		if (empty($attractions))
            $error = 'Oops, no hemos encontrado atracciones';
        $this->attractionsView->showAllAtractions($attractions, $countries, $selectedCountry, $error);
    }
	
	public function showAttraction($id){
        $attraction = $this->attractionModel->getAttractionById($id);
        return $this->attractionsView->showAttraction($attraction);
    }
	
	public function showFormAddAttraction(){
        AuthHelper::verify();
        $countries = $this->countryModel->getCountries();
        return $this->attractionsView->showFormAddAttraction($countries);
    }

    public function showFormUpdateAttraction($id){
        AuthHelper::verify();
        $attraction = $this->attractionModel->getAttractionById($id);
        if (!$attraction)
            return $this->layoutView->showError("No existe la atracción");
        $countries = $this->countryModel->getCountries();
        return $this->attractionsView->showFormUpdate($attraction, $countries);
    }

    public function addAttraction(){
        AuthHelper::verify();
        $validations = $this->validateAndSanitizeFields(['name', 'location', 'price', 'description', 'open_time', 'close_time', 'website']);
        if ($validations) {
            $image = $this->validateImage($_FILES['path_img']);
            $officialWebsite = $this->validateAndFormatWebsite($_POST['website']);
			if (!$this->isDuplicateName($_POST['name'], null)){
				$id = $this->attractionModel->addAttraction(
					$_POST['name'],
					$_POST['location'],
					$_POST['price'],
					$image,
					$_POST['description'],
					$_POST['open_time'],
					$_POST['close_time'],
					$officialWebsite,
					$_POST['country_id']);
				if ($id) 
					header('Location: ' . BASE_URL . 'atracciones');
				else
					$this->layoutView->showError('No se pudo agregar la atracción');
			} else
				$this->layoutView->showError('El nombre de la atracción ya existe.');
        } else
            $this->layoutView->showError('No se pudo agregar la atracción, faltan completar datos.');
    }

    public function deleteAttraction($id){
        AuthHelper::verify();
        $attraction = $this->attractionModel->getAttractionById($id);
        if (!$attraction)
            return $this->layoutView->showError("No se pudo eliminar, la atracción no existe");
        $this->attractionModel->deleteAttraction($id);
        header('Location: ' . BASE_URL);
    }

    public function updateAttraction($attractionId){
        AuthHelper::verify();
        $validations = $this->validateAndSanitizeFields(['name', 'location', 'price', 'description', 'open_time', 'close_time', 'website']);     
        if ($validations) {
            if (!$this->isDuplicateName($_POST['name'], $attractionId)) {       
            $image = $this->validateImage($_FILES['path_img']);
            $officialWebsite = $this->validateAndFormatWebsite($_POST['website']);
            $id = $this->attractionModel->updateAttraction(
                $_POST['name'],
                $_POST['location'],
                $_POST['price'],
                $image,
                $_POST['description'],
                $_POST['open_time'],
                $_POST['close_time'],
                $officialWebsite,
                $_POST['country_id'],
                $attractionId);
            if ($id)
                header('Location: ' . BASE_URL . "atraccion/" . $attractionId);
            else 
                $this->layoutView->showError('No se pudo editar la atracción');
            } else
				  $this->layoutView->showError('Este nombre ya está en uso');
        } else
              $this->layoutView->showError('No se pudo editar la atracción, faltan completar datos');
    }

    function validateAndSanitizeFields($fields){
        foreach ($fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field]))
                return false;
            $_POST[$field] = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
        }
        return true;
    }

    public function filterByCountry($country){
        $countries = $this->countryModel->getCountries();
        $attractions = $this->attractionModel->getAttractionByCountry($country);
        $selectedCountry = $this->getSelectedCountry();
        $error = null;
        if (empty($attractions))
            $error = 'Oops, no hemos encontrado atracciones';
        $this->attractionsView->showAllAtractions($attractions, $countries, $selectedCountry, $error);
    }

    public function getSelectedCountry(){
        if (isset($_GET['action'])) {
            $action = $_GET['action'];	
            if (empty($action)) {
                return 'Todos';
            }
            $params = explode('/', $action);
            if (isset($params[1])) {
                return htmlspecialchars($params[1]);
            }
            return 'Todos';
        } else {
            return 'Todos';
        }
    }

    private function validateImage($img){
        if (isset($img) && ($img['type'] == "image/jpg" || $img['type'] == "image/jpeg" || $img['type'] == "image/png")) {
            return $img;
        }
        return null;
    }

    private function validateAndFormatWebsite($website){
        $website = trim($website);
        if (!str_contains($website, 'http://') && !str_contains($website, 'https://')) {
            $website = 'https://' . $website;
        }
        return $website;
    }

	private function isDuplicateName($name, $attractionId) {
		$existingAttraction = $this->attractionModel->getAttractionByName($name);
		if ($existingAttraction) {
			if ($attractionId)
				return $existingAttraction->id != $attractionId;
		    else
				return true;
		}
		return false;
	}
}
