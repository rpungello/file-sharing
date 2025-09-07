<?php

namespace App\Console\Commands;

use App\Models\User;
use CraigPaul\Mail\TemplatedMailable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailTestCommand extends Command
{
    protected $signature = 'mail:test {--u|user= : The ID of the user to send the test email to} {--e|email= : The email address to send the test email to}';

    protected $description = 'Sends a test email to either a specified user or email address';

    public function handle(): int
    {
        $mailable = tap(new TemplatedMailable)
            ->identifier(config('services.postmark.template.test'))
            ->include([
                'product_name' => config('app.name'),
            ]);

        if (! empty($userId = $this->option('user'))) {
            Mail::to(User::findOrFail($userId))->send($mailable);
        } elseif (! empty($email = $this->option('email'))) {
            Mail::to($email)->send($mailable);
        } else {
            $this->error('You must specify either a user ID or an email address.');

            return static::FAILURE;
        }

        return static::SUCCESS;
    }
}
