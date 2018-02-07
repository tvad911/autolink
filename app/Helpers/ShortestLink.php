<?php
namespace App\Helpers;

use Ixudra\Curl\Facades\Curl;
use Mbarwick83\Shorty\Facades\Shorty;

class ShortestLink {

    protected $user;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->user = \Auth::guard('api')->user() ? \Auth::guard('api')->user() : null;
    }

    /**
     * [get123LinkTop description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public static function get123LinkTop(string $url)
    {
        $long_url = urlencode($url);
        $api_token = $this->user->api_123link;
        $api_url = "http://123link.co/api?api={$api_token}&url={$long_url}&alias=CustomAlias";

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
        $api_token = $this->user->api_megaurl;
        $api_url = "https://megaurl.in/api?api={$api_token}&url={$long_url}&alias=CustomAlias";
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
        $this->user = \Auth::guard('api')->user() ? \Auth::guard('api')->user() : null;

        $long_url = urlencode($url);
        $api_token = $this->user->api_shortes;
        $curl_url = "https://api.shorte.st/s/".$api_token."/".$long_url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $array = @json_decode($result, TRUE);

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
        $data =  @json_decode(Bitly::shorten($url));

        if($data->status_code !== '200') {
            return $data->data->expand->short_url;
        } else {
            return $data->data->expand->short_url;
        }
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