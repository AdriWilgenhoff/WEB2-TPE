<?php

	require_once 'app/controllers/attractions.controller.php';
	require_once 'app/controllers/country.controller.php';
	require_once 'app/controllers/auth.controller.php';

	define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

	$action = 'atracciones';

	if (!empty($_GET['action'])) {
		$action = $_GET['action'];
	}

	$params = explode('/', $action);

	// ------------------------------- ATRACCIONES -------------------------------------
	// atracciones             		 -> AttractionsController -> getAttractions();
	// atraccion/:id   			     -> AttractionsController -> getAtractionById($id);
	// nueva-atraccion		   		 -> AttractionsController -> showFormAddAtraction();
	// crear-atraccion         		 -> AttractionsController -> create(); 
	// editar-atraccion/:id    		 -> AttractionsController -> showFormUpdateAttraction($id);
	// actualizar-atraccion/:id 	 -> AttractionsController -> update($id);
	// eliminar-atraccion/:id  		 -> AttractionsController -> delete($id); 
	// atracciones-por-pais/:pais    -> AttractionsController -> filterByCountry($country);
	
	// --------------------------------- PAISES --------------------------------------
	// paises                   	 -> CountryController -> showCountries();
	// nuevo-pais       			 -> CountryController -> showFormAddCountry();
	// agregar-pais         		 -> CountryController -> addPais(); 
	// editar-pais/:id        	     -> CountryController -> showFormEditar($id);
	// actualizar-pais/:id      	 -> CountryController -> editPais($id);
	// eliminar-pais/:id   			 -> CountryController -> removePais($id); 
	
	// ----------------------------- AUTENTICACION -----------------------------------
	// iniciar-sesion          		 -> AuthController -> login();
	// cerrar-sesion             	 -> AuthController -> logout();
	// autenticar                	 -> AuthController -> auth();

	switch ($params[0]) {
		//ATRACCIONES
		case 'atracciones':
			$controller = new AttractionsController();
			$controller->showAttractions();
			break;

		case 'atraccion':
			$controler = new AttractionsController();
			$controler->showAttraction($params[1]);
			break;

		case 'nueva-atraccion':
			$controler = new AttractionsController();
			$controler->showFormAddAttraction();
			break;

		case 'crear-atraccion':
			$controller = new AttractionsController();
			$controller->addAttraction();
			break;

		case 'editar-atraccion':
			$controler = new AttractionsController();
			$controler->showFormUpdateAttraction($params[1]);
			break;

		case 'actualizar-atraccion':
			$controler = new AttractionsController();
			$controler->updateAttraction($params[1]);
			break;

		case 'eliminar-atraccion':
			$controler = new AttractionsController();
			$controler->deleteAttraction($params[1]);
			break;
		case 'atracciones-por-pais':
			$controler = new AttractionsController();
			$controler->filterByCountry($params[1]);
			break;

		//PAISES
		case 'paises':
			$controler = new CountryController();
			$controler->showCountries();
			break;

		case 'nuevo-pais':
			$controler = new CountryController();
			$controler->showFormAddCountry();
			break;

		case 'crear-pais':
			$controler = new CountryController();
			$controler->addCountry();
			break;

		case 'editar-pais':
			$controler = new CountryController();
			$controler->showFormUpdateCountry($params[1]);
			break;

		case 'actualizar-pais':
			$controler = new CountryController();
			$controler->updateCountry($params[1]);
			break;
			
		case 'eliminar-pais':
			$controler = new CountryController();
			$controler->deleteCountry($params[1]);
			break;
		
		//AUTENTICACION	
		case 'iniciar-sesion':
			$controler = new AuthController();
			$controler->showLogin();
			break;
		case 'autenticar':
			$controler = new AuthController();
			$controler->auth();
			break;
		case 'cerrar-sesion':
			$controler = new AuthController();
			$controler->logout();
			break;
		
		default:
			$layoutView = new LayoutView();
			$layoutView->showError404();
			break;
	}
