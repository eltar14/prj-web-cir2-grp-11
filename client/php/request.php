<?php

// GET    /tweet/
// GET    /tweet/?login=...
// POST   /tweet/?login=...&text=...
// PUT    /tweet/i?login=...&text=...
// DELETE /tweet/i?login=...

  require_once('../../DB.php');
  require_once('User.php');

  // Database connection.
  $db = DB::connexion();
  if (!$db)
  {
    header('HTTP/1.1 503 Service Unavailable');
    exit;
  }

$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);
//echo $requestRessource;

switch ($requestMethod){
    case "GET":
        get($db, $requestRessource);
    case "POST":
        //post($db);
    case "PUT":
        //put($db, $request);
    case "DELETE":
        //delete($db, $request);
}


function get($db, $requestRessource)
{
    if ($requestRessource == 'name_user') {
        $id_user =  $_GET["id_user"];
        $data = User::getName($id_user);
    }elseif ($requestRessource == 'surname_user'){
        $id_user =  $_GET["id_user"];
        $data = User::getSurname($id_user);
    }
    // Send data to the client.
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('HTTP/1.1 200 OK');
    echo json_encode($data);
    exit();
}

// brouillon en dessous =================================
function post($db){ //add tweet
    if(isset($_POST["login"]) and $_POST["text"]){
        dbAddTweet($db, $_POST["login"], $_POST["text"]);
        header('HTTP/1.1 201 Created');
        exit();
    }else{
        header('HTTP/1.1 xxx error');
        exit();
    }
}
function put($db, $request){ //modif tweet
    parse_str(file_get_contents('php://input'), $_PUT);
    //dbAddTweet($db, $_PUT["login"], $_PUT["text"]);
    dbModifyTweet($db, array_shift($request), $_PUT["login"], $_PUT["text"]);
    header('HTTP/1.1 200 OK');
    exit();
}
function delete($db, $request){ //delete tweet
    dbDeleteTweet($db, array_shift($request), $_GET["login"]);
    exit();
}

?>