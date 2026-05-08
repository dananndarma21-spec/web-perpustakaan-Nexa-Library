<x-guest-layout>
    <x-auth-session-status class="mb-6 rounded-2xl bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="input-label">Email</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">📧</span>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="input-field pl-12" placeholder="nama@domain.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="input-error" />
        </div>

        <div>
            <label for="password" class="input-label">Password</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">🔒</span>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="input-field pl-12" placeholder="Masukkan kata sandi" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="input-error" />
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-white/20 bg-slate-900 text-violet-500 focus:ring-violet-400">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-violet-300 transition hover:text-violet-100">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full">Masuk Sekarang</button>
    </form>
</x-guest-layout>
