<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
//name of the firebase json
$serviceaccount= ServiceAccount::fromJsonFile('./example-firebase-adminsdk-t5a2q-e36857cceb.json');
$factory = (new Factory)
    ->withServiceAccount($serviceaccount)->create();

$database = $factory->getDatabase();

$url='https://addisfortune.news/wp-json/wp/v2/breaking-news?categories=9&access_token=9la5nyk52vom0xjplgmdmwyezq49a5pvqhise2w0'; //rss link for the twitter timeline
$result = file_get_contents($url);
// Will dump a beauty json :3
$data=array();
$data=json_decode($result, true);
foreach($data as $value){
    $database
    ->getReference('adf_b_post')->push([
        "ID" => $value['id'],
        "title" => $value['title']['rendered'],
        "link" => $value['link'],
        "excrept" => $value['excerpt']['rendered'],
        "content" => $value['content']['rendered'],
        "image" => $value['img_url'],
        "author" => $value['Author'],
        "publishddate" => $value['published_date'],
       
    ]);
}



   use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;

        $serviceaccount= ServiceAccount::fromJsonFile('./addis-fortune-ando-v5-10-firebase-adminsdk-t5a2q-ef1d0dbe2c.json');

    

    $factory = (new Factory)
        ->withServiceAccount($serviceaccount)->create();

    $rt_database = $factory->getDatabase();


    $url='https://addisfortune.news/wp-json/wp/v2/news-alert?categories=9&access_token=9la5nyk52vom0xjplgmdmwyezq49a5pvqhise2w0&per_page=100&page=2'; 


    $result = file_get_contents($url);

    $data=array();
    $data=json_decode($result, true);

    echo "<pre>";

    for ($i=0; $i < count($data); $i++) { 
        $rt_database->getReference('adf_b_post')->push([
            "ID" => $data[$i]['id'],
            "post_title" => $data[$i]['title']['rendered'],
            "post_content" => $data[$i]['content']['rendered'],
            'post_date' => $data[$i]['date'],
            'post_type' => $data[$i]['type'],
        ]);
        echo $i + 1 . " : " . $data[$i]['title']['rendered'] . "INSERTED <br>";
    }



?>
    
   