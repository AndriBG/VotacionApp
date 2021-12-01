<?php

	class Layout {

		private $isRoot;

		public function __construct($isRoot = false) {
			
			$this->isRoot = $isRoot;

		}

		public function printHeader () {

			$directory = ( $this->isRoot ) ? "" : "../";

			$login = "<li class='nav-item'>
			<a href='{$directory}AdminPage/logoutAdmin.php' class='nav-link hover'>Cerrar Sesión</a>
		</li>";

			$header = <<<EOF
			<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<title>Sistema de Votaciones - Administrador</title>
    
			<link rel="stylesheet" href="{$directory}assets/css/bootstrap/bootstrap.min.css">
			<link rel="stylesheet" href="{$directory}assets/css/style.css">
			<link rel="stylesheet" href="{$directory}assets/css/jquery/plugin/toastr/toastr.min.css">
		</head>
		<body>
			<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
				<div class="container-fluid">
				<a class="navbar-brand" href="{$directory}AdminPage/adminIndex.php" class="nav-link hover">Home</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<ul class="navbar-nav me-auto mb-2 mb-md-0">
							<li class="nav-item">
								<a href="{$directory}AdminPage/candidatos.php" class="nav-link hover">Candidatos</a>
							</li>
							<li class="nav-item">
								<a href="{$directory}AdminPage/puestosElectivos.php" class="nav-link">Puestos Electivos</a>
							</li>
							<li class="nav-item">
								<a href="{$directory}AdminPage/partidos.php" class="nav-link hover">Partidos</a>
							</li>
							<li class="nav-item">
								<a href="{$directory}AdminPage/votantes.php" class="nav-link hover">Ciudadanos</a>
							</li>
							<li class="nav-item">
							<a href="{$directory}AdminPage/elecciones.php" class="nav-link hover">Elecciones</a>
						</li>
							{$login}
						</ul>
					</div>
				</div>
			</nav>

			<main class="container p-3">
EOF;

			echo $header;

		}

		public function printFooter () {

			$directory = ( $this->isRoot ) ? "" : "../"; 
			$footer = <<<EOF
			</main>
			<script src="{$directory}assets/js/bootstrap/bootstrap.min.js"></script>
			<script src="{$directory}assets/js/jquery/jquery-3.5.1.min.js"></script>
            <script src="{$directory}assets/js/jquery/plugin/toastr/toastr.min.js"></script>
            <script src="{$directory}assets/js/site/index/index.js"></script>

			</div>
		</body>
	</html>
EOF;

			print $footer;

		}

	}
?>