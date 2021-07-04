<?php

namespace Messenger;

use Illuminate\Support\Facades\Http;

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

    /**
     * Default param values
     * @var array $defaults
     */
    protected $defaults = ['authkey', 'sender', 'country', 'route'];


    public function __construct()
    {
        $this->baseUrl = config('msg91.base_url');
        $this->authkey = config('msg91.auth_key');
        $this->sender = config('msg91.sender_id');
        $this->country = config('msg91.country');
        $this->route = config('msg91.route');
    }


	/**
	 *  Send OTP
	 *
	 * @param $param
	 * @return array
	 */
	public static function sendOTP($param): array
    {
        return (new self)->setup('sendotp', $param);
    }

	/**
	 * Resend OTP
	 *
	 * @param $param
	 * @return array
	 */
	public static function resendOTP($param): array
    {
        $param['otp_expiry'] = $param['otp_expiry'] ?? config('msg91.otp_expiry');
        return (new self)->setup('resendotp', $param);
    }

	/**
	 * Verify OTP
	 *
	 * @param $param
	 * @return array
	 */
	public static function verifyOTP($param): array
    {
        $param['otp_expiry'] = $param['otp_expiry'] ?? config('msg91.otp_expiry');
        return (new self)->setup('verify', $param);
    }

	/**
	 * Send SMS
	 *
	 * @param $param
	 * @return array
	 */
	public static function sms($param): array
    {
        $url = 'https://api.msg91.com/api/';
        $param['url'] = $param['url'] ?? $url;
        return (new self)->setup('sms', $param);
    }


	/**
	 * Send's Request To MSG91 API
	 *
	 * @param $action
	 * @param $params
	 * @return array
	 */
	private function setup($action, $params): array
    {
        $params = $this->overrideDefaults( $params );

        if (!array_key_exists($action, $this->api)) { return (["success" => false, "message" => "invalid request"]); }

        $url = $this->baseUrl . $this->api[$action];

        return Http::post($url, $params)->json();
    }

	/**
	 *  Override default API params
	 *
	 * @param array $params
	 * @return array
	 */
    private function overrideDefaults(array $params): array
    {
        if ( array_key_exists('baseUrl', $params) ) {
            $this->baseUrl = $params['baseUrl'];
            unset($params['baseUrl']);
        }

        foreach ( $params as $key =>  $param ) {
            if ( in_array($key, $this->defaults, true) ) {
                $this->{$key} = $param;
                unset($params[$key]);
            }
        }

        $defaults = [
            'authkey' => $this->authkey,
            'sender' => $this->sender,
            'country' => $this->country,
            'route' => $this->route,
        ];

        return $defaults + $params;
    }
}
