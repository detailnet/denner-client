<?php
/**
 * Created by PhpStorm.
 * User: Mirko
 * Date: 20.10.2015
 * Time: 12:28
 */
use Denner\Client\Article;
class ArticleService{
    public function getAllArticle(){
        $config = require 'bootstrap.php';
        $params = array();
        $client = WebServiceClient::factory($config);
        $response = $client->listArticle($params);



       // $articles = json_decode($response)[0]->articles;
       // $articleList = array();

/*        "id": "010905",
      "name": "Astra Speisefett 10% Butter 450",
      "incomplete": false,
      "title": [
            ArticleGroup $articleGroup,
        DTO\ArticleContent $articleContent = null,
        ContentUnit $contentUnit = null,
        OnlineGroup $onlineGroup = null,
        $cooling = null,
        $packshotUrl = null

        foreach($articleList as $artjson)
        {
            $articleList.add(getArticleFromJson($artjson));
            //$article = new ServiceArticle($artjson->id,$artjson->name,null,null,null,null);
        }
*/
        return response;
    }
    public function getOneArticle(){
        $config = require 'bootstrap.php';
        $params = array();
        $client = WebServiceClient::factory($config);
        $response = $client->oneArticle($params);

        var_dump($response);
    }
    public function oneArticleTextBlocks(){
        $config = require 'bootstrap.php';
        $params = array();
        $client = WebServiceClient::factory($config);
        $response = $client->listArticle($params);

        var_dump($response);
    }

    private function getArticleFromJson($artjson){
        $name = $artjson->name;
        $id = $artjson->id;
        $incomplete = $artjson->incomplete;
        $title = $artjson->id;
        $id = $artjson->id;
        $id = $artjson->id;


        $article = new ServiceArticle();
        return $article;
    }
}