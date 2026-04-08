# Bridge

Bridge is a Laravel-based web application built with a modular structure using `nwidart/laravel-modules` and Livewire. It includes payment processing, institute/course management, student enrollment workflows, and integrations for third-party APIs.

## Project Overview

- Framework: Laravel 9
- PHP: ^7.3 | ^8.0
- Architecture: modular with `Modules/Backend` and `Modules/Institute`
- Frontend: Blade + Livewire + Bootstrap + Laravel Mix
- Database: MySQL
- Authentication: Laravel UI + Sanctum for API token management

## Key Packages Used

### Backend / PHP packages

- `laravel/framework` – core framework
- `livewire/livewire` – reactive component rendering
- `nwidart/laravel-modules` – module-based app structure
- `mhmiton/laravel-modules-livewire` – Livewire support for modules
- `laravel/ui` – authentication scaffolding
- `laravel-appkit/blameable` – user audit fields
- `guzzlehttp/guzzle` – HTTP client for external APIs
- `anhskohbo/no-captcha` – Google reCAPTCHA support
- `skagarwal/google-places-api` – Google Places API helper
- `yajra/laravel-datatables` – server-side datatables support
- `tucker-eric/eloquentfilter` – query filters
- `spatie/laravel-sluggable` – slug creation support
- `jenssegers/agent` – browser/mobile device detection
- `doctrine/dbal` – schema and migration support

### Frontend / build tools

- `bootstrap` – UI styling
- `axios` – asynchronous HTTP requests
- `lodash` – utility functions
- `laravel-mix` – asset compilation
- `sass` and `sass-loader`

## Main Features

- Modular backend and institute management
- Course listing, enrollment, and payment flow
- Instamojo payment gateway integration
- Google Maps / Places autocomplete in institute location forms
- NoCaptcha support for secure forms
- Observers and custom events for payment enrollment updates
- Console command to reconcile payment status for pending requests

## Third-Party Services and Implementation

### 1. Instamojo Payment Gateway

This app uses Instamojo for payment creation, payment status checking, and refunds.

Implementation details:

- Payment flow is handled in `App\Http\Controllers\PaymentInstamojoRequestController` and Livewire components under `app/Http/Livewire/Institute/Microsite/Courses.php`.
- `app/Helpers/InstaMojoHelper.php` performs:
  1. OAuth2 token generation using `INSTAMOJO_ACCESS_TOKEN_URL`, `INSTAMOJO_CLIENT_ID`, and `INSTAMOJO_CLIENT_SECRET`.
  2. Payment request creation via `INSTAMOJO_PAYMENT_REQUEST_URL`.
  3. Payment details retrieval via `INSTAMOJO_PAYMENT_DETAILS_URL`.
  4. Storing raw API responses in `PaymentInstamojoResponseRaw` and payment requests in `PaymentInstamojoRequest`.
- `App\Console\Commands\RetrievePaymentStatus.php` runs periodic reconciliation for pending payments.
- `App\Observers\PaymentInstamojoRequestObserver.php` updates enrollment status when payment records change.

Required environment variables:

- `INSTAMOJO_ACCESS_TOKEN_URL`
- `INSTAMOJO_PAYMENT_REQUEST_URL`
- `INSTAMOJO_PAYMENT_DETAILS_URL`
- `INSTAMOJO_CLIENT_ID`
- `INSTAMOJO_CLIENT_SECRET`
- `INSTAMOJO_PRIVATE_API_KEY`
- `INSTAMOJO_PRIVATE_AUTH_TOKEN`
- `INSTAMOJO_PRIVATE_SALT`

### 2. Google Maps / Google Places

The project uses Google Maps/Places for institute location selection and address autocomplete:

- `skagarwal/google-places-api` is installed and registered as a service provider.
- Frontend views load Google Maps JavaScript and Places libraries.
- Location fields in the Institute module use this integration.

Required setup:

- Google API key with Maps JavaScript API and Places API enabled
- Place the API key in frontend script includes or `.env` if configured manually

### 3. NoCaptcha / Google reCAPTCHA

- Uses `anhskohbo/no-captcha` package.
- Environment variables:
  - `NOCAPTCHA_SITEKEY`
  - `NOCAPTCHA_SECRET`
- Apply the captcha in forms where `NoCaptcha` is configured.

### 4. AWS / S3 / Optional Services

The project includes AWS-compatible configuration for:

- File storage (`FILESYSTEM_DISK=s3`)
- Queue support via AWS SQS
- Cache support via DynamoDB when configured

Environment variables:

- `AWS_ACCESS_KEY_ID`
- `AWS_SECRET_ACCESS_KEY`
- `AWS_DEFAULT_REGION`
- `AWS_BUCKET`
- `AWS_URL`
- `AWS_ENDPOINT`
- `AWS_USE_PATH_STYLE_ENDPOINT`

### 5. Cache System

The app supports Laravel cache stores with `config/cache.php`.
Default cache store is controlled by `CACHE_DRIVER`.

Supported cache stores in this project include:

- `file` (default)
- `database`
- `memcached`
- `redis`
- `dynamodb`
- `apc`
- `array`
- `octane`
- `null`

If you use cache-backed sessions or queue locking, configure the matching store in `.env`.

Required cache environment variables:

- `CACHE_DRIVER`
- `CACHE_PREFIX`
- `MEMCACHED_HOST`
- `MEMCACHED_PORT`
- `MEMCACHED_USERNAME`
- `MEMCACHED_PASSWORD`
- `DYNAMODB_CACHE_TABLE`
- `DYNAMODB_ENDPOINT`

### 6. Queue System

Laravel queue support is enabled in the app and defaults to `sync` in `.env`.
The queue config (`config/queue.php`) includes these drivers:

- `sync` for immediate execution
- `database` for DB-backed jobs
- `redis` for Redis queues
- `sqs` for AWS SQS
- `beanstalkd` for Beanstalkd

Required environment variables when using queued drivers:

- `QUEUE_CONNECTION`
- `SQS_PREFIX`
- `SQS_QUEUE`
- `SQS_SUFFIX`
- `REDIS_QUEUE`

Use `php artisan queue:work` or `php artisan queue:listen` in production when using asynchronous queues.

### 7. Broadcasting / Pusher / Real-time

The app has broadcasting configuration available in `config/broadcasting.php`.
Optional supported drivers include:

- `pusher`
- `ably`
- `redis`
- `log`
- `null`

Pusher configuration is available through environment variables.

- `PUSHER_APP_ID`
- `PUSHER_APP_KEY`
- `PUSHER_APP_SECRET`
- `PUSHER_HOST`
- `PUSHER_PORT`
- `PUSHER_SCHEME`
- `PUSHER_APP_CLUSTER`
- `VITE_PUSHER_APP_KEY`
- `VITE_PUSHER_HOST`
- `VITE_PUSHER_PORT`
- `VITE_PUSHER_SCHEME`
- `VITE_PUSHER_APP_CLUSTER`

### 8. Mail / Mailgun / SMTP

Laravel mail is configured in `config/mail.php`.

- Default mailer is controlled by `MAIL_MAILER`
- SMTP host/port/credentials are set in `.env`
- Mailgun and Postmark are available through `config/services.php`
- AWS SES is also available through `config/services.php`

Additional mail environment variables:

- `MAILGUN_DOMAIN`
- `MAILGUN_SECRET`
- `MAILGUN_ENDPOINT`
- `POSTMARK_TOKEN`
- `AWS_ACCESS_KEY_ID`
- `AWS_SECRET_ACCESS_KEY`
- `AWS_DEFAULT_REGION`

## Setup Instructions

1. Clone the repository:
   ```powershell
   git clone <repository-url> bridge
   cd bridge
   ```
2. Install PHP dependencies:
   ```powershell
   composer install
   ```
3. Install NPM dependencies:
   ```powershell
   npm install
   ```
4. Copy environment file:
   ```powershell
   copy .env.example .env
   ```
5. Configure `.env`:
   - `APP_URL`
   - `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
   - `CACHE_DRIVER`, `CACHE_PREFIX`
   - `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`, `MAIL_FROM_ADDRESS`
   - `QUEUE_CONNECTION`
   - `NOCAPTCHA_SITEKEY`, `NOCAPTCHA_SECRET`
   - `INSTAMOJO_*` values
   - Optional AWS, Pusher, and other service settings
6. Generate application key:
   ```powershell
   php artisan key:generate
   ```
7. Run migrations and seeders:
   ```powershell
   php artisan migrate
   php artisan db:seed
   ```
8. Build front-end assets:
   ```powershell
   npm run dev
   ```
9. Serve the application:
   ```powershell
   php artisan serve
   ```

## Useful Artisan Commands

- `php artisan migrate`
- `php artisan db:seed`
- `php artisan route:list`
- `php artisan config:cache`
- `php artisan view:clear`
- `php artisan cache:clear`
- `php artisan optimize`
- `php artisan schedule:run`

## Notes

- This README reflects the Bridge project, not the Laravel default README.
- Do not commit sensitive credentials to version control.
- If WhatsApp or other Graph API integrations are needed, inspect `.env` values around `WHATSAPP_URL` and `WHATSAPP_FROM_PHONE_NUMBER_ID`.

## License

This repository uses the MIT License.
