<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                return redirect('/dashboard');
            }
        });
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login')->with('success', 'Logout success!');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);



        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('pages.auth.login.index');
        });

        Fortify::registerView(function () {
            return view('pages.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('pages.auth.forgot-password.index');
        });
        Fortify::resetPasswordView(function (Request $request) {
            if ($request->token) {
                return view('pages.auth.reset-password.index', ['request' => $request]);
            } else {
                return to_route('login')->with('error', 'Invalid token');
            }
        });

        Fortify::authenticateUsing(function (Request $request) {

            $filterInputType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'LOWER(email) = ?' : 'LOWER(username) = ?';
            $user = User::whereRaw($filterInputType, $request->email)->first();
            Log::info('Authenticating user with ' . $filterInputType . ': ' . $request->email);
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }
}
