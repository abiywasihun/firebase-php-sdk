<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
//name of the firebase json
$serviceaccount= ServiceAccount::fromJsonFile('./example-firebase-adminsdk-t5a2q-e36857cceb.json');
$factory = (new Factory)
    ->withServiceAccount($serviceaccount)->create();

$database = $factory->getDatabase();

$url='url'; //rss link for the twitter timeline
$result = file_get_contents($url);
// Will dump a beauty json :3
$data=array();
$data=json_decode($result, true);
foreach($data as $value){
    $database
    ->getReference('adf_b_post')->push([
        "ID" => $value['id'],
        "title" => $value['title'],
        "link" => $value['link'],
        
       
    ]);
}



   use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;

        $serviceaccount= ServiceAccount::fromJsonFile('./addis-fortune-ando-v5-10-firebase-adminsdk-t5a2q-ef1d0dbe2c.json');

    

    $factory = (new Factory)
        ->withServiceAccount($serviceaccount)->create();

    $rt_database = $factory->getDatabase();


    $url='url'; 


    $result = file_get_contents($url);

    $data=array();
    $data=json_decode($result, true);

    echo "<pre>";

    for ($i=0; $i < count($data); $i++) { 
        $rt_database->getReference('adf_b_post')->push([
            "ID" => $data[$i]['id'],
            "post_title" => $data[$i]['title'],
            "post_content" => $data[$i]['content'],
            'post_date' => $data[$i]['date'],
            'post_type' => $data[$i]['type'],
        ]);
        echo $i + 1 . " : " . $data[$i]['title']['rendered'] . "INSERTED <br>";
    }



?>
    
   
