<?php

class FacebookController
{
    public $graphql;

    public $telegram;

    public $system;

    public function __construct(

    ) {
        $this->graphql = new Graphql();
        $this->telegram = new TelegramController();
        $this->system = new SystemController();
    }

    public function actionFetchLastPost()
    {
        $array = $this->graphql->query();
        $decoded = $this->graphql->decode($array);
        if ($this->graphql->containsMedia($decoded)) {
            $media = $this->graphql->parseMedia($decoded);
        }
        $imageNames = $this->system->actionSaveImages($media);
        $this->system->actionDeleteImages();
        print_r($imageNames);
        echo $this->telegram->actionCreatePost();
        $feedMessage = $decoded['feed']['data'][0]['message'];
        $feedTime = $decoded['feed']['data'][0]['created_time'];
        $feedImage = $decoded['feed']['data'][0];
        $feedAttachments = $decoded['feed']['data'][0]['attachments']['data'][0]['media']['image']['src'];
        //$this->telegram->actionCreatePost($postMessage);
//        echo '<br>';
//        echo '<br>';
//        echo '<br>';
//        print_r($feedMessage);
//        echo '<br>';
//        print_r($feedTime);
//        echo '<br>';
//        print_r($feedAttachments);
//        echo '<br>';
//        echo '<br>';
//        echo '<br>';
//        print_r($feedImage);

        return true;
    }
}
