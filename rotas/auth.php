<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::resource('/series', SeriesController::class)
    ->except(['show']);
Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/', function () {
        return redirect('/series');
    });
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])
        ->name('seasons.index');

    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
});
APP_NAME=R2-Cnpj
APP_ENV=local
APP_KEY=base64:0NUjWzqB1rYe3PfKgJ+bI4nU8Lx+Z4MAaBCwOu35C9Q=
APP_DEBUG=true
APP_URL=http://localhost
APP_LOCALE=pt
APP_TIMEZONE='America/Sao_Paulo'

PATH_PHP=/home/usuario07/r2-projetos
APP_PORT=8011

LOG_CHANNEL=stack
LOG_LEVEL=debug

R2CNPJ_HOST=https://cnpj-api.r2app.com.br
R2CNPJ_USER=r2soft@r2soft.com.br
R2CNPJ_PASSWORD=r2147258369

#DB_CONNECTION=mysql
#DB_HOST=192.168.88.64
#DB_PORT=3306
#DB_DATABASE=r2app_cnpj2
#DB_USERNAME=root
#DB_PASSWORD=r2147258369

#DB_CONNECTION=sqlite
#DB_HOST="192.168.88.64"
#DB_PORT=3306
#DB_DATABASE=/home/usuario10/r2-projetos/r2-cnpj-api/database/r2_cnpj_2023_01_16.db
#DB_USERNAME=r2soft
#DB_PASSWORD=r2147258369

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
DEFAULT_PAGINATE=15

#-------------------------- Email Service --------------------------------------------
BASE_LINK_SISTEMA_RASTREAR_EMAIL = "https://email-track.r2app.com.br"
TOKEN_AUTORIZACAO_REQUISICAO_EMAIL_CHECK = 701a240f-7991-4e23-8ee1-b80fab16f474

#-------------------------- Selecionando Driver de Queue - Markegin Process ----------
QUEUE_CONNECTION=database

R2ZAP_HOST=http://zap.r2app.com.br:3003
