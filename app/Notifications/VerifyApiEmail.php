<?php

namespace App\Notifications;

use App\Mail\EmailVerification;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;

class VerifyApiEmail extends VerifyEmail
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return EmailVerification
     */
    public function toMail($notifiable): EmailVerification
    {
        $url = self::verificationUrl($notifiable);

        return (new EmailVerification(
            $url,
            $notifiable->name
        ))->to($notifiable->email);
    }

    protected function verificationUrl($notifiable): string
    {
        $prefix = config('FRONTEND_URL') . '/account/verify';

        $temporarySignedURL = URL::temporarySignedRoute(
            'emailVerification.verify',
            Carbon::now()->addRealMinutes(60),
            ['id' => $notifiable->getKey()]
        );

        return $prefix . '?verify_url=' . urlencode($temporarySignedURL);
    }
}
