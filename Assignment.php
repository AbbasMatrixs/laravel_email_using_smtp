//.env content 
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="sender email"
MAIL_PASSWORD="sender gmail google app password"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="sendergmail.com"
MAIL_FROM_NAME="${APP_NAME}"

//WelcomeEmail.php content
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    // Set the email Subject line
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Our Platform!',
        );
    }

    // Point to the Blade template for the email body
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }
}

//welcome.blade.php content
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>

<body>

    <h1>Hello, {{ $userName }}! 🎉</h1>

    <p>Thank you for registering with us. Your account is ready to use!</p>
    <p>Assignment  12 Done sir !</p>

</body>
</html>

// web.php content
<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

Route::get('/send-welcome', function () {

    $recipientEmail = 'receiver email';
    $name = 'receiver name or anything else';

    // Sends a real email via Gmail SMTP
    Mail::to($recipientEmail)->send(new WelcomeEmail($name));

    return 'Email successfully sent via Gmail SMTP!';
});
