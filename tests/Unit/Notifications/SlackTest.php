<?php

namespace Tests\Unit\Notifications;

use App\Notifications\Slack;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Messages\SlackMessage;
use Tests\Suites\NotificationTestSuite;

/**
 * Class SlackTest.
 *
 * @coversDefaultClass \App\Notifications\Slack
 */
class SlackTest extends NotificationTestSuite
{
    use WithFaker;

    /**
     * @test
     * @covers ::__construct
     * @covers ::via
     */
    public function it_should_return_config()
    {
        $channel = $this->faker->word;
        $message = $this->faker->word;
        $from = $this->faker->word;

        $this->assertEquals([config('slack.driver')], (new Slack($channel, $message, $from))->via());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::toSlack
     */
    public function it_should_return_slack_message()
    {
        $channel = $this->faker->word;
        $message = $this->faker->word;
        $from = config('slack.username');
        $slackMessage = (new SlackMessage)->from($from, config('slack.icon'))->to($channel)->content($message);

        $this->assertEquals($slackMessage, (new Slack($channel, $message, $from))->toSlack());
    }
}
