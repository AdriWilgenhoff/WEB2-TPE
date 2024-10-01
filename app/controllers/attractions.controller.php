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
        $this->attractionsView->showAllAtractions($attractions,$countries);
    }


    public function addAttraction(){
		AuthHelper::verify();
         $validations = $this->validateAndSanitizeFields(['name','location','price','description','open_time','close_time','website']);
        if ($validations) {
			if($_FILES['path_img']['type'] == "image/jpg" || $_FILES['path_img']['type'] == "image/jpeg" || $_FILES['path_img']['type'] == "image/png" ) {
                
				$id = $this->attractionModel->addAttraction($_POST['name'], $_POST['location'], $_POST['price'], $_FILES['path_img'], $_POST['description'], $_POST['open_time'], $_POST['close_time'], $_POST['website'], $_POST['country_id']);
            }else{
				$id = $this->attractionModel->addAttraction($_POST['name'], $_POST['location'], $_POST['price'], null, $_POST['description'], $_POST['open_time'], $_POST['close_time'], $_POST['website'], $_POST['country_id']);
            }         
            if ($id) {
                header('Location: ' . BASE_URL);
            } else {
                $this->layoutView->showError('Error al insertar atraccion');
            }
        }else{$this->layoutView->showError404();}
    }


    public function deleteAttraction($id){
		AuthHelper::verify();
        $attraction = $this->attractionModel->getAttractionById($id);
        if (!$attraction)
            return $this->layoutView->showError("No existe la atraccion con el id=$id");
        $this->attractionModel->deleteAttraction($id);
        header('Location: ' . BASE_URL);
    }


    public function showAttraction($id){     
        $attraction = $this->attractionModel->getAttractionById($id);
        return $this->attractionsView->showAttraction($attraction);
    }


    public function updateAttraction($attractionId){
		AuthHelper::verify();
        $validations = $this->validateAndSanitizeFields(['name','location','price','description','open_time','close_time','website']);
        if ($validations) {
			if($_FILES['path_img']['type'] == "image/jpg" || $_FILES['path_img']['type'] == "image/jpeg" || $_FILES['path_img']['type'] == "image/png" ) {          
				$id = $this->attractionModel->updateAttraction($_POST['name'], $_POST['location'], $_POST['price'], $_FILES['path_img'], $_POST['description'], $_POST['open_time'], $_POST['close_time'], $_POST['website'], $_POST['country_id'], $attractionId);
            }else{
				$id = $this->attractionModel->updateAttraction($_POST['name'], $_POST['location'], $_POST['price'], null, $_POST['description'], $_POST['open_time'], $_POST['close_time'], $_POST['website'], $_POST['country_id'], $attractionId);
            }
            if ($id) {        
                header('Location: ' . BASE_URL . "atraccion/" . $attractionId);
            } else {
                $this->layoutView->showError('algo no salio como esperabamos');
            }
        }
    }


    public function showFormAddAttraction(){
		AuthHelper::verify();
        $countries = $this->countryModel->getCountries();
        return $this->attractionsView->showFormAddAttraction($countries);
    }


    public function showFormUpdateAttraction($id){
		AuthHelper::verify();
        $attraction = $this->attractionModel->getAttractionById($id);

        if (!$attraction) {
            return $this->layoutView->showError("No existe la atraccion con el id=$id");
        }
        $countries = $this->countryModel->getCountries();
        return $this->attractionsView->showFormUpdate($attraction, $countries);
    }
	
	
	function validateAndSanitizeFields($fields){
        foreach ($fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field]))
                return false;
			$_POST[$field] = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
        }
        return true;
    }


    public function filterByCountry($countryID){
        $countries = $this->countryModel->getCountries();
        $attractions = $this->attractionModel->getAttractionByCountry($countryID);
        return $this->attractionsView->showAllAtractions($attractions,$countries);    
    }
   
	
}
