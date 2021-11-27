<?php


class Graphql
{
    private $credentials;

    private $groupId;

    private $accessToken;

    public function __construct()
    {
        $credentialsFile = ROOT . '/config/facebookCredentials.php';
        $this->credentials = include($credentialsFile);
        $this->groupId = $this->credentials['groupId'];
        $this->accessToken = $this->credentials['accessToken'];
    }

    public function query()
    {
        $requestUrl = "https://graph.facebook.com/v7.0/$this->groupId/?fields=feed.limit(1){message,created_time,attachments}&access_token=$this->accessToken";

        return file_get_contents($requestUrl);
    }

    public function decode($output) {

        return json_decode($output, true);
    }

    public function containsMedia($output)
    {
        if (isset($output['feed']['data'][0]['attachments']['data'][0])) {

            return true;
        }

        return false;
    }

    public function parseMedia($output)
    {
        $media = $output['feed']['data'][0]['attachments']['data'][0]['subattachments']['data'];
        $attachments = [];
        foreach ($media as $m) {
            if (isset($m['media']['image']['src'])) {
                $attachments[] = $m['media']['image']['src'];
            }
        }

        return $attachments;
    }

}
