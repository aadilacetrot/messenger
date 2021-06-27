<?php

namespace Messenger\tests\Unit;

use PHPUnit\Framework\TestCase;

class OverRideDefaultTest extends TestCase
{
    private string $baseUrl = 'http://google.com';
    private string $authKey = 'RandomKey';
    private string $sender = 'TESTSENDER';
    private int $country = 91;
    private int $route = 4;

    public function testCanOerrideDefaultParams()
    {
        $defaults = [
            'baseUrl' => 'https://google.com',
            'authKey' => 'OverridenAuthKey',
            'sender' => 'NEWSENDER',
            'country' => 32,
            'route' => 12,
        ];

		$this->overrideDefaults( $defaults );

        $this->assertEquals('https://google.com', $this->baseUrl);
        $this->assertEquals('OverridenAuthKey', $this->authKey);
        $this->assertEquals('NEWSENDER', $this->sender);
        $this->assertEquals(32, $this->country);
        $this->assertEquals(12, $this->route);
    }

    private function overrideDefaults(array $params): void
    {
        if ( array_key_exists('baseUrl', $params) ) {
            $this->baseUrl = $params['baseUrl'];
            unset($params['baseUrl']);
        }

        foreach ( $params as $param ) {
            if ( in_array($param, $this->defaults )) {
                $this->{$param} = $param;
                unset($param);
            }
        }
    }
}
