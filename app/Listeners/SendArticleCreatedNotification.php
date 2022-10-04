<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Models\User;
use App\Notifications\NewArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArticleCreatedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        foreach (User::whereNot('id', $event->article->user_id)->cursor() as $user) {
            $user->notify(new NewArticle($event->chirp));
        }
    }
}
