<?php
namespace App\Helpers;

use Ixudra\Curl\Facades\Curl;
use Mbarwick83\Shorty\Facades\Shorty;

class ShortestLink {

    /**
     * [get123LinkTop description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public static function get123LinkTop(string $url)
    {
        $long_url = urlencode($url);
        $api_token = config('shortlink.a123Link');
        $api_url = "http://123link.co/api?api={$api_token}&url={$long_url}";

        $result = @json_decode(file_get_contents($api_url),TRUE);

        if($result['status'] == 'error')
        {
            return $result['message'];
        }
        else{
            return $result['shortenedUrl'];
        }
    }

    /**
     * [getMegaUrlIn description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public function getMegaUrlIn(string $url)
    {
        $long_url = urlencode($url);
        $api_token = config('shortlink.megaurl');
        $api_url = "https://megaurl.in/api?api={$api_token}&url={$long_url}";
        $result = @json_decode(file_get_contents($api_url),TRUE);

        if($result['status'] == 'error')
        {
            return $result['message'];
        }
        else{
            return $result['shortenedUrl'];
        }
    }

    /**
     * [getShortest description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public function getShortest(string $url)
    {
        $long_url = urlencode($url);
        $api_token = config('shortlink.shortest');
        $curl_url = "https://api.shorte.st/s/".$api_token."/".$long_url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $array = @json_decode($result);

        $shortest = $array->shortenedUrl;

        return $shortest;
    }

    /**
     * [getBitly description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public function getBitly(string $url)
    {
        return \Bitly::getUrl($url);
    }

    /**
     * [getGoogl description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public function getGoogl(string $url)
    {
        return Shorty::shorten($url);
    }

    /**
     * [getAnotedpad description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public function getAnotedpad(string $url)
    {
        return null;
    }

    /**
     * [getTinyUrl description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public function getTinyUrl(string $url)
    {
        return file_get_contents('http://tinyurl.com/api-create.php?url='. $url);
    }
}