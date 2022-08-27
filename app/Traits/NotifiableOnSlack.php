<?php

namespace App\Traits;

use App\Notifications\Slack;
use Illuminate\Notifications\Notifiable;

/**
 * Trait NotifiableOnSlack
 * @package App\Traits
 */
trait NotifiableOnSlack
{
    use Notifiable;

    /**
     * @return string|null
     */
    public function routeNotificationForSlack(): ?string
    {
        return config('slack.endpoint');
    }

    /**
     * @param  string  $channel
     * @param  string  $message
     * @param  string|null  $from
     * @return void
     */
    public function toSlack(string $channel, string $message, ?string $from = null): void
    {
        $this->notify(new Slack($channel, $message, $from ?? config('slack.username')));
    }

    /**
     * @param string $channel
     * @param string $view
     * @param array $parameters
     */
    public function toSlackFromView(string $channel, string $view, array $parameters)
    {
        $this->notify(new Slack($channel, view($view, $parameters)->render(), config('slack.username')));
    }
}
