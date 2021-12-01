<?php

	class Layout {

		private $isRoot; // para comprobar si se llama desde el root de la aplicación o no.
		private $user; // objeto del tipo de usuario loggeado.
		private $logged; // Variable booleana, para comprobar la sesión del usuario.

		public function __construct ( $isRoot = false ) {
			
			$this->isRoot = $isRoot;
			$this->logged = false;
		}

		private function isLogger(){
			if(isset($_SESSION["user"]) && $_SESSION["user"] != null ){
				$this->logged = true;
			} else {
				$this->logged = false;
			}
		}

		public function printHeader () {

			$directory = ( $this->isRoot ) ? "" : "../";

			$login = "<a class='nav-link hover' href='{$directory}login/Login.php'></a>";
			$admin = "<a class='nav-link hover' href='{$directory}AdminPage/AdminLogin.php'>Iniciar Como Administrador</a>";

			$this->isLogger();
			
			if($this->logged){
				$this->user = $_SESSION["user"];
				$admin = "<a href=''></a>";
				$login = "<a class='nav-link hover' href='{$directory}login/Logout.php'>Salir</a>";
			}

			$header = <<<EOF
			<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<title>Sistema de Votaciones</title>
			<link rel="stylesheet" href="{$directory}assets/css/bootstrap/bootstrap.min.css">
			<link rel="stylesheet" href="{$directory}assets/css/style.css">
			<link rel="stylesheet" href="{$directory}assets/css/jquery/plugin/toastr/toastr.min.css">
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		</head>
		<body>
			<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
				<div class="container-fluid">
					<a class="navbar-brand" href="{$directory}index.php">Home</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<ul class="navbar-nav me-auto mb-2 mb-md-0">
							<li class="nav-item ms-5">{$admin}</li>
							<li class="nav-item ms-5">{$login}</li>
						</ul>
					</div>
				</div>
			</nav>

			<main class="container">
EOF;

			echo $header;

		}

		public function printFooter () {

			$directory = ( $this->isRoot ) ? "" : "../"; 
			$footer = <<<EOF
			</main>
			</div>
			<script src="{$directory}assets/js/bootstrap/bootstrap.min.js"></script>
			<script src="{$directory}assets/js/jquery/jquery-3.5.1.min.js"></script>
            <script src="{$directory}assets/js/jquery/plugin/toastr/toastr.min.js"></script>
            <script src="{$directory}assets/js/site/index/index.js"></script>
		</body>
	</html>
EOF;

			echo $footer;

		}

	}
?>