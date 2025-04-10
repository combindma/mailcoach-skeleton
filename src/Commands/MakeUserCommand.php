<?php

namespace Combindma\MailcoachSkeleton\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class MakeUserCommand extends Command
{
    protected $signature = 'mailcoach:make-user {--username=} {--email=} {--password=}';

    protected $description = 'Create a user with credentials.';

    public function handle(): int
    {
        app(config('auth.providers.users.model'))->create($this->requestData());

        return self::SUCCESS;
    }

    /** @return array{'name': string, 'email': string, 'password': string} */
    protected function requestData(): array
    {
        return [
            'name' => $this->option('username') ?? text(
                label: 'Name',
                required: true,
            ),

            'email' => $this->option('email') ?? text(
                label: 'Email address',
                required: true,
                validate: fn (string $value) => match (true) {
                    ! filter_var($value, FILTER_VALIDATE_EMAIL) => 'The email address must be valid.',
                    app(config('auth.providers.users.model'))->where('email', $value)->exists() => 'A user with this email address already exists.',
                    ! is_null($error = $this->verifyDns($value)) => $error,
                    default => null,
                },
            ),

            'password' => Hash::make($this->option('password') ?? password(
                label: 'Password',
                required: true,
            )),
        ];
    }

    protected function verifyDns($email): ?string
    {
        $validator = Validator::make([
            'email' => $email,
        ], [
            'email' => ['email:rfc,dns'],
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        return null;
    }
}
