<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post('/login/store')
}

</script>
<template>
    <div class="relative min-h-screen bg-[#0b0f19] flex items-center justify-center p-4 overflow-hidden font-sans">
        
        <!-- Ambient Background Glows -->
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-cyan-500/15 rounded-full blur-[100px] pointer-events-none animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none delay-700"></div>

        <!-- Main Card Container -->
        <div class="relative w-full max-w-md bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl shadow-[0_0_50px_rgba(0,0,0,0.3)] p-8 md:p-10 transition-all duration-300 hover:border-slate-700/80">
            
            <!-- Glow Accent Line at Top -->
            <div class="absolute top-0 left-10 right-10 h-[2px] bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-70"></div>

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-500 to-indigo-500 p-[1px] mb-4 shadow-lg shadow-indigo-500/20">
                    <div class="w-full h-full bg-slate-900 rounded-[15px] flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                    Welcome Back
                </h1>
                <p class="text-slate-400 text-sm mt-2 font-medium">
                    Log in to continue your tracking
                </p>
            </div>

            <!-- Form -->
            <form class="space-y-5" @submit.prevent="submit">

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Email Address
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input v-model="form.email" type="email" placeholder="you@example.com"
                            class="w-full pl-11 pr-4 py-3 bg-slate-950/40 border border-slate-800/80 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-cyan-500/80 focus:ring-1 focus:ring-cyan-500/30 transition-all duration-200 hover:border-slate-700">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Password
                        </label>
                        <a href="#" class="text-xs font-medium text-cyan-400 hover:text-cyan-300 transition-colors">
                            Forgot?
                        </a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input v-model="form.password" type="password" placeholder="••••••••"
                            class="w-full pl-11 pr-4 py-3 bg-slate-950/40 border border-slate-800/80 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-cyan-500/80 focus:ring-1 focus:ring-cyan-500/30 transition-all duration-200 hover:border-slate-700">
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center cursor-pointer select-none">
                        <div class="relative">
                            <input v-model="form.remember" type="checkbox" class="sr-only peer">
                            <div class="w-4 h-4 bg-slate-950/60 border border-slate-800 rounded flex items-center justify-center peer-checked:bg-cyan-500 peer-checked:border-cyan-500 transition-all">
                                <svg class="w-3 h-3 text-slate-950 font-bold hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-medium text-slate-400 ml-2">Remember this device</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button :disabled="form.processing" type="submit"
                    class="w-full relative group mt-2 overflow-hidden rounded-xl p-[1px] focus:outline-none">
                    <span class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-indigo-500 rounded-xl"></span>
                    <div class="relative px-8 py-3.5 bg-gradient-to-r from-cyan-500 to-indigo-500 rounded-[11px] text-slate-950 font-bold text-sm tracking-wide transition-all duration-200 group-hover:bg-transparent group-hover:text-white text-center">
                        {{ form.processing ? 'Signing in...' : 'Sign In' }}
                    </div>
                </button>

            </form>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-slate-500 text-sm">
                    Don't have an account?
                    <Link href="/register" class="text-cyan-400 hover:text-cyan-300 font-medium ml-1 underline underline-offset-4 decoration-cyan-500/30 hover:decoration-cyan-400 transition-colors">
                        Create one
                    </Link>
                </p>
            </div>

        </div>
    </div>
</template>
