<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Http;
// use Messenger\tests\TestCase;
use PHPUnit\Framework\TestCase;

class CheckResponseTest extends TestCase
{

    private string $baseUrl = 'https://api.msg91.com/api/v5/';
    private string $authkey = 'RandomKey';
    private string $sender = 'TESTSENDER';
    private int $country = 91;
    private int $route = 4;

    public function testCanReturnResponse()
    {
        $defaults = [
            'authkey' => $this->authkey,
            'sender' => $this->sender,
            'country' => $this->country,
            'route' => $this->route
        ];

        $params = ['flow_id' => 'ReakjdjfEFEka123'];

        Http::fake([
            $this->baseUrl .'*' => Http::response(['message' => 'Authentication failure', 'type' => 'error'], 200),
        ]);

        $url = $this->baseUrl . 'otp?';

        $response = Http::post($url, $defaults + $params);
        $res = $this->checkResponse($response->json());

        $this->assertEquals(['success' => false, 'message' => 'Authentication failure'], $res);

    }

    public function checkResponse($response)
    {
        if(isset($response['type'])){

            try {
                if(gettype((object) $response) != 'object' && gettype($response) != 'array'){
                    return (object)(["success" => true , "message" => ($response?? 'success')]);
                }elseif (strtolower($response->type) == "success"){
                    return (object)(["success" => true , "message" => ($response->message?? 'success')]);
                }else if(strtolower($response->message) == "success"){
                    return (object) (["success" => true , "message" => $response->type]);
                } else if (strtolower($response->type) == "error"){
                    return (object)(["success" => false , "message" => ($response->message?? 'Failed')]);
                }else if(strtolower($response->message) == "error"){
                    return (object) (["success" => false , "message" => $response->type]);
                }else{
                    return (object)(["success" => false , "message" => ($response->message?? 'success')]);
                }
            } catch (\Throwable $th) {
                return (object)(["success" => false , "message" => ('Failed')]);

            }

        }else{
            return ["success" => false , "message" => 'Failed'];
        }

    }
}