<?php
/**
 * Created by PhpStorm.
 * User: Mirko
 * Date: 20.10.2015
 * Time: 14:14
 */

use Denner\Client\Article\WebServiceClient;

$config = require 'bootstrap.php';
$params = array();
$client = WebServiceClient::factory($config);
echo 1;
$response = $client->listArticle($params);
echo 2;
var_dump($response);