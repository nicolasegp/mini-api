<?php
class Api {

	private static $Rutas = [], $Cfg = [];

	public static function cfg($K, $V) {
		self::$Cfg[strtolower($K)] = $V;
	}

	public static function ruta($Url, $Callback) {
		$Url = str_replace('/', '\/', $Url);
		self::$Rutas[$Url] = $Callback;
	}

	public static function exe() {
		header('Content-Type: application/json');
		$Uri = self::$Cfg['mod_rewrite']
			? substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME'])-9)
			: substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME'])+1);
		foreach(self::$Rutas as $Url => $Callback) {
			if(preg_match("/^{$Url}$/i", $Uri, $Args)) {
				array_shift($Args);
				return call_user_func_array($Callback, array_values($Args));
			}
		}
	}

	public static function cors() {
		if(isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
		if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
			if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			exit;
		}
	}

}
