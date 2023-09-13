<?php
	session_start();
	
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control, Pragma, Authorization, Accept-Encoding");
	header("Access-Control-Allow-Credentials: false");
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Content-Type: application/json");

	// Allow from any origin
	if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
	header("Access-Control-Allow-Origin: http://localhost:80/crudusuarios/frontcrud/");
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	header("Content-Type: application/json");
	
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	print_r($request);
	

}


	date_default_timezone_set('America/Asuncion');

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require __DIR__.'/../vendor/autoload.php';
	$settings = require __DIR__.'/../src/settings.php';

	$app = new \Slim\App($settings);
	require __DIR__.'/../src/dependencies.php';

	$app->add(new Tuupola\Middleware\HttpBasicAuthentication([
		"secure"=> false,
		"users" => [
			//"user_sfzigo" => '$2y$10$Q6ah4Nu1W3QjLgQWx6Jxku7XbP1ExZAL2o7CfJpysY4QhPB6YpGzi'
			//"user_sfzigo" => 'b4N[5e;lDbC}sq@UqjmE'
			//"user_sfzigo" => '$2y$10$oBXo9CZtbvSj9dk23kYBquR3ud7jRpQfIByfMtp6mRO/9lpqfvVUK'
			"user_domains"  => '123456'
			//"user_sfzigo" => 'dXNlcl9zZnppZ286YjROWzVlO0lEYkN9c3FAVXFqbUU='
		],
		"error" => function($response, $args) {
			header("Content-Type: application/json; charset=utf-8");

			$data			= [];
			$data['code']	= 401;
			$data['status'] = 'failure';
			$data['message']= 'Errors NO AUTORIZADO';
	
			$body = $response->getBody();
			$body->write(json_encode($data, JSON_UNESCAPED_SLASHES));
	
			return $response->withBody($body);
		}
	]));

	//ROUTES
	require __DIR__.'/../src/routes.php';
	
	$app->run();