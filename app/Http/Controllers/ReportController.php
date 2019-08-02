<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper as JasperPHP;

class ReportController extends Controller
{
	/**
     * Reporna um array com os parametros de conexão
     * @return Array
     */
	public function getDatabaseConfig()
	{
		return [
			'driver'   => env('DB_CONNECTION'),
			'host'     => env('DB_HOST'),
			'port'     => env('DB_PORT'),
			'username' => env('DB_USERNAME'),
			'password' => env('DB_PASSWORD'),
			'database' => env('DB_DATABASE'),
			'jdbc_dir' => base_path() . env('JDBC_DIR', '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc'),
		];
	}



	public function index(Request $request)
	{
	     // coloca na variavel o caminho do novo relatório que será gerado
		$output = public_path() . '/files/relatorios/' . time() . '_ControleDeSuporte';
		// o arquivo do relatório com seu caminho completo
		$input =public_path() . '/files/relatorios/ControleDeSuporte.jrxml';
	// instancia um novo objeto JasperPHP

		$report = new JasperPHP;

		$params = $request['params'];//Passa o parametro recebido via POST para a variavel

		$options = [
			'db_connection' =>[
				'driver'   => 'mysql',
				'host'     => env('DB_HOST', 'localhost'),
				'port'     => env('DB_PORT', '3306'),
				'username' => env('DB_USERNAME', 'root'),
				'password' => env('DB_PASSWORD', 'brval'),
				'database' => env('DB_DATABASE', 'controle_ti'),
				'jdbc_driver' => 'com.mysql.jdbc.Driver',
				'jdbc_url' => 'jdbc:mysql://127.0.0.1/controle_ti',
				'jdbc_dir' => base_path() . env('JDBC_DIR', '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc'),
			],
			'format' 	=> ['pdf'],
			'params'	=>	$params
		];

		$report->process(
			$input,
			$output,
			$options
		)->execute();


		$file = $output.'.pdf';
		$path = $file;

		if (!file_exists($file)) {
			abort(404);
		}
		$file = file_get_contents($file);
		unlink($path);

		return response($file, 200)
		->header('Content-Type', 'application/pdf')
		->header('Content-Disposition', 'inline; filename="relatorio.pdf"');
	}

}