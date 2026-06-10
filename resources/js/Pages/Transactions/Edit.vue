<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    transaction: Object,
    accounts: Array,
    categories: Array,
});

const form = useForm({
    account_id: props.transaction.account_id,
    category_id: props.transaction.category_id,
    amount: props.transaction.amount,
    type: props.transaction.type,
    note: props.transaction.note ?? '',
    transaction_date: props.transaction.transaction_date,
});

const submit = () => {
    form.put(`/transactions/${props.transaction.id}`);
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
                        Edit Transaction
                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Update your transaction information.
                    </p>
                </div>

                <Link
                    href="/transactions"
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

                    <!-- Account + Category -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Account
                            </label>

                            <select
                                v-model="form.account_id"
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
                                v-if="form.errors.account_id"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.account_id }}

                            </p>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Category
                            </label>

                            <select
                                v-model="form.category_id"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                                <option value="">
                                    Select Category
                                </option>

                                <option
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.id">

                                    {{ category.name }}

                                </option>

                            </select>

                            <p
                                v-if="form.errors.category_id"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.category_id }}

                            </p>

                        </div>

                    </div>

                    <!-- Amount + Type -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Amount
                            </label>

                            <input
                                v-model="form.amount"
                                type="number"
                                step="0.01"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                            <p
                                v-if="form.errors.amount"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.amount }}

                            </p>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                Transaction Type
                            </label>

                            <select
                                v-model="form.type"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                                <option value="income">
                                    Income
                                </option>

                                <option value="expense">
                                    Expense
                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- Date -->

                    <div>

                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Transaction Date
                        </label>

                        <input
                            v-model="form.transaction_date"
                            type="date"
                            class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                        <p
                            v-if="form.errors.transaction_date"
                            class="text-rose-400 text-sm mt-1">

                            {{ form.errors.transaction_date }}

                        </p>

                    </div>

                    <!-- Note -->

                    <div>

                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Note
                        </label>

                        <textarea
                            v-model="form.note"
                            rows="5"
                            class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-cyan-500 focus:outline-none">
                        </textarea>

                    </div>

                    <!-- Buttons -->

                    <div class="flex items-center gap-3 pt-2">

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl transition-all duration-200 disabled:opacity-50">

                            <span v-if="form.processing">
                                Updating...
                            </span>

                            <span v-else>
                                Update Transaction
                            </span>

                        </button>

                        <Link
                            href="/transactions"
                            class="px-5 py-3 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 font-medium transition">

                            Cancel

                        </Link>

                    </div>

                </form>

            </div>

        </div>

    </AppLayout>
</template>