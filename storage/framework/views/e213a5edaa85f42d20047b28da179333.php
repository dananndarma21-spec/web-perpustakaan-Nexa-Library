<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Nexa Library')); ?></title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <style>
            .login-logo {
                animation: float-logo 4s ease-in-out infinite;
            }
            @keyframes float-logo {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-8px); }
            }
            .login-glow {
                filter: drop-shadow(0 0 40px rgba(139, 92, 246, 0.25));
            }
        </style>
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100">
        <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top,_rgba(168,85,247,0.16),transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(79,70,229,0.12),transparent_30%)]">
            <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.05),transparent_22%)] pointer-events-none"></div>
            <div class="relative flex min-h-screen items-center justify-center px-4 py-10">
                
                <div class="hidden lg:flex lg:w-1/2 lg:flex-col lg:items-center lg:justify-center lg:gap-8 lg:rounded-[38px] lg:border lg:border-white/10 lg:bg-slate-950/70 lg:p-12 lg:shadow-[0_40px_120px_rgba(15,23,42,0.45)]">
                    
                    <div class="login-logo login-glow mb-4">
                        <img src="<?php echo e(asset('images/nexa-library-logo.png')); ?>" alt="Nexa Library" class="w-64 h-auto mx-auto">
                    </div>
                    <div class="text-center space-y-4">
                        <p class="text-sm uppercase tracking-[0.35em] text-violet-100/70">Sistem Perpustakaan Digital</p>
                        <p class="text-lg font-medium text-slate-300">Dark mode glassmorphism. Tampilan clean dan eksklusif untuk guru dan administrator.</p>
                        <ul class="space-y-3 text-sm text-slate-400">
                            <li class="flex items-center justify-center gap-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-violet-500/15 text-violet-400 text-xs">✦</span>
                                Panel dashboard pengguna
                            </li>
                            <li class="flex items-center justify-center gap-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-violet-500/15 text-violet-400 text-xs">✦</span>
                                Navigasi sidebar elegan
                            </li>
                            <li class="flex items-center justify-center gap-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-violet-500/15 text-violet-400 text-xs">✦</span>
                                Grafis dan data real-time
                            </li>
                        </ul>
                    </div>
                </div>

                
                <div class="w-full max-w-xl rounded-[38px] border border-white/10 bg-slate-950/85 backdrop-blur-2xl p-8 shadow-[0_30px_90px_rgba(15,23,42,0.45)]">
                    
                    <div class="lg:hidden flex justify-center mb-6">
                        <img src="<?php echo e(asset('images/nexa-library-logo.png')); ?>" alt="Nexa Library" class="w-40 h-auto login-glow">
                    </div>

                    <div class="mb-8">
                        <p class="text-sm uppercase tracking-[0.35em] text-violet-300/70">Masuk ke Sistem</p>
                        <h2 class="mt-3 text-3xl font-semibold text-white">Nexa Library</h2>
                        <p class="mt-2 text-slate-400">Gunakan akun Anda untuk mengelola buku, siswa, kategori, dan peminjaman.</p>
                    </div>
                    <?php echo e($slot); ?>

                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\Danan\Downloads\TUGAS-MIGRATION4\TUGAS-MIGRATION\resources\views/layouts/guest.blade.php ENDPATH**/ ?>