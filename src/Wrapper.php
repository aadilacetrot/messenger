<?php

namespace Messenger;

class Wrapper
{
    /**
     * Base API URL
     * @var string $baseUrl
     */
    protected string $baseUrl;

    /**
     * API Auth Key
     * @var string $authkey
     */
    private string $authkey;

    /**
     * Sender ID
     * @var string $sender
     */
    private string $sender;

    /**
     * Country code
     * @var string $country
     */
    private string $country;

    /**
     * Route Channel
     * @var string $route
     */
    private string $route;

    /**
     * API Actions
     * @var array $api
     */
    protected $api = ["sendotp" => "otp?", "resendotp" => "otp/resend?", "verify" => "otp/verify?", "sms" => "sendhttp.php"];


    public function __construct()
    {
        $this->baseUrl = config('msg91.base_url');
        $this->authkey = config('msg91.auth_key');
        $this->sender = config('msg91.sender_id');
        $this->country = config('msg91.country');
        $this->route = config('msg91.route');
    }


    private static function setup($action, $param)
    {

        $param = self::setOptions($param);

        // $sms = ["sendotp" => "otp?", "resendotp" => "otp/resend?", "verify" => "otp/verify?", "sms" => "sendhttp.php"];

        if (!array_key_exists($action, static::$api)) {
            return (["success" => false, "message" => "invalid request"]);
        }

        $url = static::$baseUrl . static::$api[$action];

        // try {
        //     $client = new Client(); //GuzzleHttp\Client
        //     $response = $client->post($url, [
        //         'form_params' => $param
        //     ]);
        // } catch (\Throwable $th) {
        //     return (["success" => false, "message" => $th->getMessage()]);
        // }
        // if ($response->getStatusCode() == 200) {

        //     $data = json_decode($response->getBody());
        //     // return $data;
        //     if ($data) {
        //         return static::checkResponse($data);
        //     } else {
        //         return (["success" => true, "message" => 'success']);
        //     }
        // } else {
        //     return (["success" => false, "message" => $response->message]);

        //     // return ['type' => "error", "message" => "fail to send!"];
        // }
    }

    /**
     *  Override default api params
     *
     * @param array $params
     * @return void
     */
    private static function setOptions(array $params): void
    {
        foreach ($params as $key => $value) {
            static::${$key} = $value;
        }
    }

    public function echoMsg(string $name = ''): string
    {
        return 'Hi, ' . ucfirst($name);
    }
}
