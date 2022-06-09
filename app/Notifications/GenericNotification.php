<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
class GenericNotification extends Notification
{
    use Queueable;
    public $title, $body, $action;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $body, $action)
    {
        //
        $this->title = $title;
        $this->body = $body;
        $this->action = $action;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }
    public function toWebPush($notifiable, $notification)
    {
      //$time = \Carbon\Carbon::now();

        return WebPushMessage::create()
            ->id($notification->id)
            ->title($this->title)
            ->icon(url('/images/icons/icon-128x128.png'))
            ->body($this->body)
            ->action('action', $this->action);
    }
}
