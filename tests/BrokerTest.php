<?php
namespace Tests;

use Metamorphosis\Authentication\NoAuthentication;
use Metamorphosis\Broker;
use RdKafka\Conf;

class BrokerTest extends LaravelTestCase
{
    /** @test */
    public function it_should_construct_broker_without_authentication()
    {
        $broker = new Broker('some-connection');

        $this->assertSame('some-connection', $broker->getConnections());
        $this->assertInstanceOf(NoAuthentication::class, $broker->getAuthentication());
    }

    /** @test */
    public function it_should_prepare_authentication()
    {
        $broker = new Broker('some-connection');

        $this->assertNull($broker->prepareAuthentication(new Conf()));
    }
}
