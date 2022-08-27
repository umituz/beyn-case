<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

/**
 * Class Slack
 * @package App\Notifications
 */
class Slack extends Notification
{
    private string $channel;
    private string $message;
    private string $from;

    /**
     * Slack constructor.
     *
     * @param  string  $channel
     * @param  string  $message
     * @param  string  $from
     */
    public function __construct(string $channel, string $message, string $from)
    {
        $this->channel = $channel;
        $this->message = $message;
        $this->from = $from;
    }

    /**
     * @return array
     */
    public function via(): array
    {
        return [config('slack.driver')];
    }

    /**
     * @return SlackMessage
     */
    public function toSlack(): SlackMessage
    {
        return (new SlackMessage)
            ->from($this->from, config('slack.icon'))
            ->to($this->channel)
            ->content($this->message);
    }
}
