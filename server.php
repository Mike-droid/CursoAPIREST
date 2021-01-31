<?php

if (!array_key_exists('HTTP_X_TOKEN',$_SERVER)) {
    die;
}

$url = 'http://localhost:8001';

$ch = curl_init($url);
curl_setopt(
    $ch,
    CURL_HTTPHEADER,
    [
        "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
    ]
    );
curl_setopt(
    $ch,
    CURL_RETURNTRANSFER,
    true
);

$ret = curl_exec($ch);

if ($ret !== 'true') {
    die;
}

//*Definimos los recursos disponibles
$allowedResourcesTypes = [
    'books',
    'authors',
    'genres',
];

//*Validmos que el recurso esté disponible
$resourceType = $_GET['resource_type'];

if (!in_array($resourceType, $allowedResourcesTypes)) {
    http_response_code(400);
    die;
}

//*Defino los recursos
$books = [
    1 => [
        'title' => 'Lo que el viento se llevó',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    2 => [
        'title' => 'La Iliada',
        'id_autor' => 1,
        'id_genero' => 1,
    ],
    3 => [
        'title' => 'La Odisea',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
];

header('Content-Type: application/json');

//*Levantamos el ID del recurso buscado
$resourceId = array_key_exists('resource_id',$_GET) ? $_GET['resource_id'] : '';

//*Generamos la respuesta asumiendo que el pedido es correcto
switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
    case 'GET':
        if (empty($resourceId)) {
            echo json_encode($books);
        }else{
            if (array_key_exists($resourceId, $books)) {
                echo json_encode($books[$resourceId]);
            }else{
                http_response_code(404);
            }
        }

        break;
    case 'POST':
        //*Tomamos la entrada "cruda"
        $json = file_get_contents('php://input');

        //*Transformamos el json recibido a un nuevo elemento del array
        $books[] = json_decode($json,true); //!El parámetro true es para que llegue en forma de array

        echo array_keys($books)[count($books) - 1]; //!El -1 es porque arrays empiezan en 0, la última posición es X-1
        //echo json_encode($books);
        break;
    case 'PUT':
        //*Validamos que el recurso buscado exista
        if (!empty($resourceId) && array_key_exists($resourceId,$books)) {
            //*Tomamos la entrada "cruda"
            $json = file_get_contents('php://input');

            //*Transformamos el json recibido a un nuevo elemento del array
            $books[$resourceId] = json_decode($json,true); //!El parámetro true es para que llegue en forma de array

            //*Retornoamos la colección modificada en formato JSON
            echo json_encode($books);
        }
        break;
    case 'DELETE':
        //*Validamos que el recurso exista
        if (!empty($resourceId) && array_key_exists($resourceId,$books)) {
            //*Eliminanos el recurso
            unset($books[$resourceId]);
        }

        echo json_encode($books);
        break;
    default:
    echo "Un método diferente jeje";
        break;
    }

?>