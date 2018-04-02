<?php

namespace App\Notifications;

use App\Models\Event;
use App\Models\Organiser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewEventFromOrganiser extends Notification implements ShouldQueue
{
    use Queueable;

    protected $following;
    protected $event;

    /**
     * Create a new notification instance.
     *
     * @param Organiser $following
     * @param Event $event
     */
    public function __construct(Organiser $following, Event $event)
    {
        $this->following = $following;
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'following_id'      => $this->following->id,
            'following_name'    => $this->following->name,
            'following_avatar'  => $this->following->getAvatar(),
            'event_id'          => $this->event->id,
            'event_url'          => $this->event->getEventUrlAttribute()
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'following_id'      => $this->following->id,
                'following_name'    => $this->following->name,
                'following_avatar'  => $this->following->getAvatar(),
                'event_id'          => $this->event->id,
                'event_url'          => $this->event->getEventUrlAttribute()
            ],
        ];
    }
}
