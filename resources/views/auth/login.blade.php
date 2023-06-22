<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <link rel="stylesheet" href="/login.css"/>
    
    
        <form method="POST" action="{{ route('login') }}">
            <div class="page">
                    <div class="register">
                        <div class="register-center">
                            <div class="register-container">
                                <form class="register-form">
                                    @csrf
                                    <!-- Email Address -->
                                    <div class="register-input">
                                        <x-input-label class="email-text" for="email" :value="__('E-pasts')" /><br>
                                        <x-text-input class="email-input" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="register-input">
                                        <x-input-label class="password-text" for="password" :value="__('Parole')" /><br>

                                        <x-text-input class="password-input" id="password" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="current-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="button">
                                            {{ __('Pieslēgties') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <footer></footer>
            </div>
        </form>
    
</x-guest-layout>
