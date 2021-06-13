<?php

namespace Messenger\tests\Unit;

use Messenger\Wrapper;
use PHPUnit\Framework\TestCase;


class SendSmsTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->messenger = new Wrapper();

    }

    public function test_can_echo_msg(): void
    {
        self::assertEquals('Hi, Aadil', $this->messenger->echoMsg('Aadil'));
    }
}
