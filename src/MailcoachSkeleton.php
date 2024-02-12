<?php

namespace Combindma\MailcoachSkeleton;

use Combindma\MailcoachSkeleton\Http\Controllers\Auth\ForgotPasswordController;
use Combindma\MailcoachSkeleton\Http\Controllers\Auth\LoginController;
use Combindma\MailcoachSkeleton\Http\Controllers\Auth\LogoutController;
use Combindma\MailcoachSkeleton\Http\Controllers\Auth\ResetPasswordController;
use Combindma\MailcoachSkeleton\Http\Controllers\Auth\WelcomeController;
use Combindma\MailcoachSkeleton\Http\Middleware\WelcomesNewUsers;
use Combindma\MailcoachSkeleton\Livewire\AccountComponent;
use Combindma\MailcoachSkeleton\Livewire\EditUserComponent;
use Combindma\MailcoachSkeleton\Livewire\UsersComponent;
use Illuminate\Support\Facades\Route;
use Spatie\Mailcoach\Http\App\Middleware\BootstrapSettingsNavigation;

class MailcoachSkeleton
{
    public function routes(string $prefix = 'app'): void
    {
        Route::group(['middleware' => ['guest']], function () {
            Route::redirect('/', '/login');
        });

        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);

        Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot-password');
        Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

        Route::get('reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

        Route::group(['middleware' => ['web', WelcomesNewUsers::class]], function () {
            Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
            Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
        });

        Route::group(['middleware' => 'auth'], function () use ($prefix) {
            Route::post('logout', LogoutController::class)->name('logout');

            Route::middleware(array_merge(config('mailcoach.middleware.web'), [
                BootstrapSettingsNavigation::class,
            ]))->group(function () use ($prefix) {
                Route::get($prefix.'/account', AccountComponent::class)->name('account');

                Route::prefix($prefix.'/users')->group(function () {
                    Route::get('/', UsersComponent::class)->name('users');
                    Route::get('{user}', EditUserComponent::class)->name('users.edit');
                });
            });
        });
    }
}
