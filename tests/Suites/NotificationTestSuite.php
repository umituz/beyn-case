<?php

namespace Tests\Suites;

use Illuminate\Notifications\Notification;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

/**
 * Class NotificationTestSuite.
 * @package Tests\Suites
 */
abstract class NotificationTestSuite extends TestCase
{
    protected Notification $notification;
    protected string $mailMessage;

    /**
     * @param Notification $notification
     * @param string $method
     * @param mixed $params
     */
    protected function assertNotification(Notification $notification, $method, $params)
    {
        $notification->expects($this->once())->method('getGSuiteMailMessageInstance')->willReturn($this->mailMessage);

        $this->assertInstanceOf(MockObject::class, $notification->$method($params));
    }
}
