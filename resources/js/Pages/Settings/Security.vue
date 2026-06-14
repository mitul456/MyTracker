<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

defineProps({
    user: Object
});

const passwordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    passwordForm.put('/settings/password', {
        preserveScroll: true,
        onSuccess: () => passwordForm.reset(),
    });
};

const logoutOtherDevices = () => {
    const password = prompt(
        'Please enter your password'
    );

    if (!password) return;

    logoutForm.password = password;

    logoutForm.post('/settings/logout-other-devices', {
        preserveScroll: true,
        onSuccess: () => {
            logoutForm.reset();
        },
    });
};


const logoutForm = useForm({
    password: '',
});


const deleteForm = useForm({
    password: '',
});

const deleteAccount = () => {
    const password = prompt(
        'Please enter your password to delete account'
    );

    if (!password) return;

    deleteForm.password = password;

    deleteForm.delete('/settings/account');
};
</script>

<template>
    <AppLayout>

        <div class="max-w-5xl mx-auto py-8 space-y-8">

            <!-- Header -->

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Security Settings
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage your password, email verification and account security.
                </p>

            </div>

            <!-- Change Password -->

            <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-8">

                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h2 class="text-xl font-bold text-white">
                            Change Password
                        </h2>

                        <p class="text-slate-400 text-sm mt-1">
                            Choose a strong password to keep your account secure.
                        </p>

                    </div>

                </div>

                <form @submit.prevent="updatePassword" class="space-y-6">

                    <div>

                        <label class="block text-slate-300 mb-2">
                            Current Password
                        </label>

                        <input type="password" placeholder="Enter your current password"
                            v-model="passwordForm.current_password"
                            class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-500">
                        <p v-if="passwordForm.errors.current_password" class="text-red-400 text-sm mt-2">
                            {{ passwordForm.errors.current_password }}
                        </p>

                    </div>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>

                            <label class="block text-slate-300 mb-2">
                                New Password
                            </label>

                            <input type="password" placeholder="Enter your new password" v-model="passwordForm.password"
                                class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-500">
                            <p v-if="passwordForm.errors.password" class="text-red-400 text-sm mt-2">
                                {{ passwordForm.errors.password }}
                            </p>

                        </div>

                        <div>

                            <label class="block text-slate-300 mb-2">
                                Confirm Password
                            </label>

                            <input type="password" placeholder="Confirm your new password"
                                v-model="passwordForm.password_confirmation"
                                class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-500">
                            <p v-if="passwordForm.errors.password_confirmation" class="text-red-400 text-sm mt-2">
                                {{ passwordForm.errors.password_confirmation }}
                            </p>

                        </div>

                    </div>

                    <div class="flex justify-end">

                        <button type="submit" :disabled="passwordForm.processing"
                            class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 font-semibold text-slate-950">
                            Update Password
                        </button>

                    </div>

                </form>

            </div>

            <!-- Email Verification -->

            <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>

                        <h2 class="text-xl font-bold text-white">
                            Email Verification
                        </h2>

                        <p class="text-slate-400 mt-2">
                            Your email address helps keep your account secure.
                        </p>

                    </div>

                    <div class="flex items-center gap-3">

                        <span v-if="user.status === 1"
                            class="px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-semibold">
                            Verified
                        </span>

                        <span v-else="user.status === 0"
                            class="px-4 py-2 rounded-full bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 font-semibold">
                            Not Verified
                        </span>

                        <Link href="/send-otp"
                            class="px-5 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white hover:bg-slate-700">
                            Send Verification
                        </Link>

                    </div>

                </div>

            </div>

            <!-- Login Sessions -->

            <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-8">

                <div class="flex flex-col lg:flex-row lg:justify-between gap-6">

                    <div>

                        <h2 class="text-xl font-bold text-white">
                            Active Sessions
                        </h2>

                        <p class="text-slate-400 mt-2">
                            Manage devices currently logged into your account.
                        </p>

                    </div>

                    <button @click="logoutOtherDevices"
                        class="px-6 py-3 rounded-xl bg-orange-500 hover:bg-orange-400 text-slate-950 font-semibold">
                        Logout Other Devices
                    </button>

                </div>

            </div>

            <!-- Delete Account -->

            <div class="bg-red-950/20 border border-red-700 rounded-2xl p-8">

                <div class="flex flex-col lg:flex-row lg:justify-between gap-6">

                    <div>

                        <h2 class="text-xl font-bold text-red-400">
                            Delete Account
                        </h2>

                        <p class="text-slate-300 mt-3 max-w-2xl">

                            Once your account is deleted, all of your data,
                            transactions, budgets, reports and settings will be
                            permanently removed. This action cannot be undone.

                        </p>

                    </div>

                    <button @click="deleteAccount"
                        class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-semibold">
                        Delete My Account
                    </button>

                </div>

            </div>

        </div>

    </AppLayout>
</template>