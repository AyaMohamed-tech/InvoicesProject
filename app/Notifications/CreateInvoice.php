<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Invoice;

class CreateInvoice extends Notification
{
    use Queueable;
    private $invoices;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoices)
    {
        $this->Invoice = $invoices;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toDatabase($notifiable)
    {
        return [

            //'data' => $this->details['body']
            'id'=> $this->Invoice->id,
            'title'=>'تم اضافة فاتورة جديد بواسطة :',
            'user'=> Auth::user()->name,

        ];
    }
  
}
