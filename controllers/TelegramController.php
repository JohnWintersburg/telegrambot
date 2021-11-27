<?php

class TelegramController
{
    public $botData;

    public $channelId;

    public $botApiKey;

    public function __construct(

    ) {
        $botDataFile = ROOT . '/config/telegramCredentials.php';
        $this->botData = include($botDataFile);
        $this->channelId = $this->botData['channelId'];
        $this->botApiKey = $this->botData['botApiKey'];
    }

    public function actionCreatePost()
    {
        //$url = "https://api.telegram.org/bot$this->botApiKey/sendMessage?chat_id=$this->channelId&text=test";
        $url = "https://api.telegram.org/bot$this->botApiKey/sendMessage?chat_id=$this->channelId&text=test";
        $response = file_get_contents($url);
        $result = $this->actionIsPostPosted($response);
        echo $result;

        return $result;
    }

    public function actionIsPostPosted($response)
    {
        $decoded_post = json_decode($response, true);

        return $decoded_post['ok'];
    }

    public function actionCreateMediaPost() {

    }
}
