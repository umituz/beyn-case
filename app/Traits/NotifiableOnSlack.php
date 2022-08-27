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
     * @param  string  $channel
     * @param  string  $message
     * @param  string|null  $from
     * @return void
     */
    public function toSlack(string $channel, string $message, ?string $from = null): void
    {
        $this->notify(new Slack($channel, $message, $from ?? config('slack.username')));
    }
}
