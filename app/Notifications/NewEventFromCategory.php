<?php

namespace App\Notifications;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewEventFromCategory extends Notification implements ShouldQueue
{
    use Queueable;

    protected $category;
    protected $event;

    /**
     * Create a new notification instance.
     *
     * @param Category $category
     * @param Event $event
     */
    public function __construct(Category $category, Event $event)
    {
        $this->category = $category;
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
            'category_id'      => $this->category->id,
            'category_name'    => $this->category->name,
            'category_avatar'  => $this->category->img_path,
            'event_id'         => $this->event->id,
            'event_url'         => $this->event->getEventUrlAttribute()
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
                'category_id'      => $this->category->id,
                'category_name'    => $this->category->name,
                'category_avatar'  => $this->category->img_path,
                'event_id'         => $this->event->id,
                'event_url'         => $this->event->getEventUrlAttribute()
            ],
        ];
    }
}
