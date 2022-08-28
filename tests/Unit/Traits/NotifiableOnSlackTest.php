<?php

namespace Tests\Unit\Traits;

use App\Notifications\Slack;
use App\Traits\NotifiableOnSlack;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

/**
 * Class NotifiableOnSlackTest.
 *
 * @coversDefaultClass \App\Traits\NotifiableOnSlack
 */
class NotifiableOnSlackTest extends TestCase
{
    use WithFaker;

    /**
     * @param array $methods
     * @return MockObject
     */
    private function getNotifiableOnSlackTrait(array $methods): MockObject
    {
        return $this->getIsolatedTraitMock(NotifiableOnSlack::class, $methods);
    }

    /**
     * @test
     * @covers ::toSlack
     */
    public function it_should_sent_notification_to_slack_with_default_from()
    {
        $channel = $this->faker->word;
        $message = $this->faker->sentence;
        $trait = $this->getNotifiableOnSlackTrait(['toSlack']);

        $trait
            ->expects($this->once())
            ->method('notify')
            ->with(new Slack($channel, $message, config('slack.username')));

        $trait->toSlack($channel, $message);
    }

    /**
     * @test
     * @covers ::toSlack
     */
    public function it_should_sent_notification_to_slack_with_custom_from()
    {
        $channel = $this->faker->word;
        $message = $this->faker->sentence;
        $from = $this->faker->word;
        $trait = $this->getNotifiableOnSlackTrait(['toSlack']);

        $trait
            ->expects($this->once())
            ->method('notify')
            ->with(new Slack($channel, $message, $from));

        $trait->toSlack($channel, $message, $from);
    }
}
