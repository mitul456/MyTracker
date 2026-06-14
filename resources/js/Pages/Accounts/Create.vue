<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link, usePage } from '@inertiajs/vue3';

const form = useForm({
    user_id: '',
    name: '',
    balance: 0,
})

const submit = () => {
    form.post('/accounts', {
        onSuccess: () => {
            
        },
         
    });
}

</script>

<template>
    <AppLayout>
        <div class="max-w-xl mx-auto pt-6">

            <!-- Main Form Card Container -->
            <div
                class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl shadow-[0_0_50px_rgba(0,0,0,0.3)] p-8 md:p-10 transition-all duration-300 hover:border-slate-700/80">

                <!-- Glow Accent Line at Top -->
                <div
                    class="absolute top-0 left-10 right-10 h-[2px] bg-gradient-to-r from-transparent via-cyan-400 to-transparent opacity-70">
                </div>

                <!-- Header -->
                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-500 to-indigo-500 p-[1px] mb-4 shadow-lg shadow-cyan-500/20">
                        <div class="w-full h-full bg-slate-900 rounded-[15px] flex items-center justify-center">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                        Add New Account
                    </h1>
                    <p class="text-slate-400 text-sm mt-2 font-medium">
                        Setup a new wallet or bank account asset
                    </p>
                </div>

                <!-- Form -->
                <form class="space-y-6" @submit.prevent="submit">
                    <input type="text" v-model="form.user_id" hidden readonly>

                    <!-- Account Name Input -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Account Name
                        </label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0V9a2 2 0 012-2h2a2 2 0 012 2v12m-6 0h6" />
                                </svg>
                            </div>
                            <input v-model="form.name" type="text" placeholder="e.g. City Bank Savings, Cash Wallet"
                                required
                                class="w-full pl-11 pr-4 py-3 bg-slate-950/40 border border-slate-800/80 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-cyan-500/80 focus:ring-1 focus:ring-cyan-500/30 transition-all duration-200 hover:border-slate-700">
                        </div>
                        <p v-if="form.errors.name" class="text-red-400 text-sm">
                            {{ form.errors.name }}
                        </p>
                    </div>

                    <!-- Initial Balance Input -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Initial Balance
                        </label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input v-model="form.balance" type="number" step="0.01" placeholder="0.00" min="0" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-950/40 border border-slate-800/80 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-cyan-500/80 focus:ring-1 focus:ring-cyan-500/30 transition-all duration-200 hover:border-slate-700">
                        </div>
                        <p v-if="form.errors.balance" class="text-red-400 text-sm">
                            {{ form.errors.balance }}
                        </p>
                    </div>

                    <!-- Action Buttons Layout -->
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <!-- Cancel Button -->
                        <Link href="/accounts"
                            class="w-full py-3.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-400 hover:text-white font-semibold text-sm rounded-xl transition-all duration-200 text-center block flex items-center justify-center">
                            Cancel
                        </Link>

                        <!-- Submit Button -->
                        <button :disabled="form.processing" type="submit"
                            class="relative group overflow-hidden rounded-xl p-[1px] focus:outline-none">
                            <span
                                class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-indigo-500 rounded-xl"></span>
                            <div
                                class="relative py-3.5 bg-gradient-to-r from-cyan-500 to-indigo-500 rounded-[11px] text-slate-950 font-bold text-sm tracking-wide transition-all duration-200 group-hover:bg-transparent group-hover:text-white text-center">
                                {{ form.processing ? 'Saving...' : 'Save Account' }}
                            </div>
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </AppLayout>
</template>




