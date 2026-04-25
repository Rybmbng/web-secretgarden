<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class CustomLogin extends Login
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kita ganti field email bawaan jadi field login generic
                $this->getLoginFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label('Username or Email')
            ->required()
            ->autocomplete()
            ->autofocus();
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        $externalUser = DB::connection('hub') 
            ->table('user')
            ->join('employee', 'user.username', '=', 'employee.username')
            ->where(function($query) use ($data) {
                $query->where('user.username', $data['login'])
                    ->orWhere('user.email_address', $data['login']);
            })
            ->select('user.*', 'employee.employee_name')
            ->first();

        // Cek apakah user ada
        if (!$externalUser) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'data.login' => 'Username atau Email tidak terdaftar di HUB.',
            ]);
        }

        $isPasswordCorrect = false;

        if (!empty($externalUser->password_hash)) {
            $isPasswordCorrect = Hash::check($data['password'], $externalUser->password_hash);
        } 
        
        if (!$isPasswordCorrect) {
            $isPasswordCorrect = (md5($data['password']) === $externalUser->password);
        }

        if ($isPasswordCorrect) {
            $user = User::updateOrCreate(
                ['username' => $externalUser->username],
                [
                    'name' => $externalUser->employee_name ?? $externalUser->username,
                    'email' => $externalUser->email_address,
                    'password' => $externalUser->password_hash ?? Hash::make($data['password']),
                ]
            );

          
            if ($user->roles()->count() === 0) {
                $defaultRoleName = 'panel_user';                
                $roleObj = \Spatie\Permission\Models\Role::where('name', $defaultRoleName)->first();
                if ($roleObj) {
                    $user->assignRole($roleObj);
                }
            }

            auth()->login($user, $data['remember'] ?? false);
            session()->regenerate();

            return app(LoginResponse::class);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'data.login' => 'Password yang Anda masukkan salah.',
        ]);
    }
}