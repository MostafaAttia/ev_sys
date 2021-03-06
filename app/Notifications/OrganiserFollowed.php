<?php

namespace App\Notifications;

use App\Models\Client;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrganiserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $follower;

    /**
     * Create a new notification instance.
     *
     * @param Client $follower
     */
    public function __construct(Client $follower)
    {
        $this->follower = $follower;
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

    /**
     * Get the database representation of the notification.
     *
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'follower_id' => $this->follower->id,
            'follower_name' => $this->follower->first_name. ' '. $this->follower->last_name,
            'follower_avatar' => $this->follower->getAvatar(),
            'follower_profile' => $this->follower->getPublicProfileURL()
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

//    public function broadcastOn()
//    {
//        return new PrivateChannel('Organiser.'.$this->update->order_id);
//    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'follower_id' => $this->follower->id,
            'follower_name' => $this->follower->first_name. ' '. $this->follower->last_name,
            'follower_avatar' => $this->follower->getAvatar(),
            'follower_profile' => $this->follower->getPublicProfileURL()
        ]);
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
                'follower_id' => $this->follower->id,
                'follower_name' => $this->follower->first_name. ' '. $this->follower->last_name,
                'follower_avatar' => $this->follower->getAvatar(),
                'follower_profile' => $this->follower->getPublicProfileURL()
            ],
        ];
    }
}
