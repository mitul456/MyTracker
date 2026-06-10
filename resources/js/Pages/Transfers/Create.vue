<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    accounts: Array,
});

const form = useForm({
    from_account_id: '',
    to_account_id: '',
    amount: '',
    transfer_date: '',
});

const submit = () => {
    form.post('/transfers');
};
</script>

<template>
    <AppLayout>

        <div class="max-w-4xl mx-auto space-y-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                        Create Transfer
                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Move money between your accounts.
                    </p>
                </div>

                <Link
                    href="/transfers"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 text-sm font-medium transition">

                    Back

                </Link>

            </div>

            <!-- Form Card -->
            <div
                class="relative bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                <div
                    class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent">
                </div>

                <form
                    @submit.prevent="submit"
                    class="space-y-6">

                    <!-- Accounts -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- From Account -->

                        <div>

                            <label
                                class="block text-sm font-medium text-slate-300 mb-2">

                                From Account

                            </label>

                            <select
                                v-model="form.from_account_id"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                                <option value="">
                                    Select Account
                                </option>

                                <option
                                    v-for="account in accounts"
                                    :key="account.id"
                                    :value="account.id">

                                    {{ account.name }}

                                </option>

                            </select>

                            <p
                                v-if="form.errors.from_account_id"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.from_account_id }}

                            </p>

                        </div>

                        <!-- To Account -->

                        <div>

                            <label
                                class="block text-sm font-medium text-slate-300 mb-2">

                                To Account

                            </label>

                            <select
                                v-model="form.to_account_id"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                                <option value="">
                                    Select Account
                                </option>

                                <option
                                    v-for="account in accounts"
                                    :key="account.id"
                                    :value="account.id">

                                    {{ account.name }}

                                </option>

                            </select>

                            <p
                                v-if="form.errors.to_account_id"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.to_account_id }}

                            </p>

                        </div>

                    </div>

                    <!-- Amount + Date -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Amount -->

                        <div>

                            <label
                                class="block text-sm font-medium text-slate-300 mb-2">

                                Transfer Amount

                            </label>

                            <input
                                v-model="form.amount"
                                type="number"
                                step="0.01"
                                placeholder="Enter Amount"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-cyan-500 focus:outline-none">

                            <p
                                v-if="form.errors.amount"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.amount }}

                            </p>

                        </div>

                        <!-- Date -->

                        <div>

                            <label
                                class="block text-sm font-medium text-slate-300 mb-2">

                                Transfer Date

                            </label>

                            <input
                                v-model="form.transfer_date"
                                type="date"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none" style="color-scheme: dark">

                            <p
                                v-if="form.errors.transfer_date"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.transfer_date }}

                            </p>

                        </div>

                    </div>

                    <!-- Transfer Preview -->

                    <div
                        v-if="form.from_account_id && form.to_account_id"
                        class="bg-slate-950/50 border border-slate-800 rounded-xl p-5">

                        <p class="text-slate-500 text-xs uppercase tracking-wider mb-3">
                            Transfer Preview
                        </p>

                        <div class="flex items-center justify-center gap-4 text-lg font-bold">

                            <span class="text-cyan-400">
                                {{
                                    accounts.find(a => a.id == form.from_account_id)?.name
                                }}
                            </span>

                            <span class="text-slate-500">
                                →
                            </span>

                            <span class="text-indigo-400">
                                {{
                                    accounts.find(a => a.id == form.to_account_id)?.name
                                }}
                            </span>

                        </div>

                    </div>

                    <!-- Buttons -->

                    <div class="flex items-center gap-3 pt-2">

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl transition-all duration-200 disabled:opacity-50">

                            <span v-if="form.processing">
                                Saving...
                            </span>

                            <span v-else>
                                Save Transfer
                            </span>

                        </button>

                        <Link
                            href="/transfers"
                            class="px-5 py-3 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 font-medium transition">

                            Cancel

                        </Link>

                    </div>

                </form>

            </div>

        </div>

    </AppLayout>
</template>