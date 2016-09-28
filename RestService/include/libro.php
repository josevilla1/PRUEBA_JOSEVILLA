<?php
//c:\UniServerZ\www\RestService\include\libro.php


function insertLibro() {
	$request = \Slim\Slim::getInstance()->request();
	$datos = json_decode($request->getBody());
	$sql="INSERT INTO libro (ISBN, titulo, autores, anyoPublicacion, editorial, numeroPaginas)" . 
	"VALUES (:isbn, :titulo, :autores, :anyoPublicacion, :editorial, :numeroPaginas)";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);



		$stmt->bindParam("isbn", $datos->isbn);
		$stmt->bindparam("titulo", $datos->titulo);
		$stmt->bindParam("autores", $datos->autores);
		$stmt->bindParam("anyoPublicacion", $datos->anyoPublicacion);
		$stmt->bindParam("editorial", $datos->editorial);
		$stmt->bindParam("numeroPaginas", $datos->numeroPaginas);

		$stmt->execute();

		$db = null;
		echo true;
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .',"datos":' . json_encode($datos) . '}}';
	}
}


function getLibros() {
	$sql = "SELECT ISBN, titulo, anyoPublicacion FROM libro ORDER BY ISBN";
	try {
		$db = getDB();
		$stmt = $db->query($sql);
		$libros = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db=null;
		echo '{"libros": ' . json_decode($libros) . '}';
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log')
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getLibro($isbn) {
	$sql = "SELECT " .
	"ISBN, titulo, autores, anyoPublicacion, editorial, numeroPaginas " .
	"FROM libro " .
	"WHERE ISBN = :isbn " .
	"ORDER BY ISBN";

	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("isbn", $isbn);
		$stmt->execute();
		$libro = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db=null;

		if (count($libro) > 0) 
		{
			$libro = $libro[0];
		}

		echo json_encode($libro);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}




function deleteLibro($isbn) {

	$sql = "DELETE FROM libro WHERE ISBN = :isbn";
	try{
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("isbn", $isbn);
		$stmt->execute();
		$db=null;
		echo true;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
	
}
