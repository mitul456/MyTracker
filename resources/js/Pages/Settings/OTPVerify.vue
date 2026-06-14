<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    otp: '',
});

const submit = () => {
    form.post('/verify-otp');
};

const resendOtp = () => {
    form.post('/resend-otp');
};
</script>

<template>
    <AppLayout>
        <div class="min-h-[80vh] flex items-center justify-center px-4">

            <div
                class="w-full max-w-md bg-slate-900/40 border border-slate-800 rounded-2xl p-8 shadow-2xl">

                <!-- Icon -->

                <div class="flex justify-center mb-6">

                    <div
                        class="w-20 h-20 rounded-full bg-cyan-500/10 flex items-center justify-center">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-cyan-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />

                        </svg>

                    </div>

                </div>

                <!-- Heading -->

                <h2 class="text-3xl font-bold text-center text-white">

                    Verify OTP

                </h2>

                <p class="text-center text-slate-400 mt-3">

                    Enter the 6-digit OTP sent to your email.

                </p>

                <!-- Form -->

                <form
                    @submit.prevent="submit"
                    class="mt-8 space-y-6">

                    <div>

                        <label class="block text-slate-300 mb-2">

                            One Time Password

                        </label>

                        <input
                            type="text"
                            maxlength="6"
                            v-model="form.otp"
                            placeholder="Enter OTP"
                            class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-4 text-center tracking-[10px] text-2xl font-bold text-white focus:ring-2 focus:ring-cyan-500 outline-none" />

                        <p
                            v-if="form.errors.otp"
                            class="text-red-500 text-sm mt-2">

                            {{ form.errors.otp }}

                        </p>

                    </div>

                    <!-- Verify Button -->

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 text-slate-950 font-bold hover:opacity-90 disabled:opacity-50">

                        {{ form.processing ? 'Verifying...' : 'Verify OTP' }}

                    </button>

                </form>

                <!-- Resend -->

                <div class="mt-6 text-center">

                    <p class="text-slate-400 text-sm">

                        Didn't receive the code?

                    </p>

                    <button
                        @click="resendOtp"
                        class="mt-2 text-cyan-400 hover:text-cyan-300 font-semibold">

                        Resend OTP

                    </button>

                </div>

            </div>

        </div>
    </AppLayout>
</template>