<?php
	require_once 'app/views/users.view.php';
	require_once 'app/models/user.model.php';
	require_once 'app/views/layout.view.php';
	require_once 'app/helpers/auth.helper.php';
    
    class AuthController {
        
		private $userView;
		private $userModel;
		private $layoutView;

		public function __construct(){
			AuthHelper::init();
			$this->userView = new UserView();
			$this->userModel = new UserModel();
			$this->layoutView = new LayoutView();		
		}
        
        public function showLogin($message = null){
			if (!isset($_SESSION['USER_ID']))
				$this->userView->showLogin($message);
			 else
				 header('Location: ' . BASE_URL);
		}
		
		public function auth() {
			if(!empty($_POST['username']) && !empty($_POST['password'])){
				$username = $_POST['username'];
				$password = $_POST['password'];    
				$user = $this->userModel->getUser($username);
				if($password && password_verify($password,$user->password)){
					AuthHelper::login($user);
					header('Location: '.BASE_URL);
				} else{
					$this->showLogin("Usuario y/o clave incorrecta");
					//$this->layoutView->showError("Usuario y/o clave incorrecta");
				}
			} else{
				$this->showLogin("Debe completar correctamente los campos");
				//$this->layoutView->showError("Debe completar correctamente los campos");
			}
		}

        public function logout() {
			AuthHelper::logout();
            header('Location: ' . BASE_URL);    
        }
    
    }