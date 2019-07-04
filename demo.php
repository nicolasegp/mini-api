<?php
require 'api.php';

Api::cors(); // Soporte para "Cross Origin Resource Sharing"

Api::cfg('mod_rewrite', true); // TRUE si usa .htaccess

// Ruta vacia indica el inicio
Api::ruta('', function() {
	echo json_encode(['status'=>'ok']);
});

Api::ruta('item/(\d+)', function($id) {
	$Datos = [
		'auth' => 'ok',
		'item' => $id
	];
	echo json_encode($Datos);
});

// Ejecutar
Api::exe();
