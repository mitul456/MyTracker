<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    transactions: Array,
});

const form = useForm({});

const deleteTransaction = (transaction) => {
    if (confirm(`Delete this transaction?`)) {
        form.delete(`/transactions/${transaction.id}`, {
            preserveScroll: true,
        });
    }
};

const formatAmount = (amount) => {
    return Number(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString();
};
</script>

<template>
    <AppLayout>

        <div class="space-y-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                        Transactions
                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Manage all income and expense transactions.
                    </p>
                </div>

                <Link
                    href="/transactions/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl text-sm transition-all duration-200 shadow-lg shadow-cyan-500/10">

                    <svg class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2.5"
                            d="M12 4v16m8-8H4" />
                    </svg>

                    Add Transaction

                </Link>

            </div>

            <!-- Table Card -->

            <div
                class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr
                                class="border-b border-slate-800 bg-slate-950/40">

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Account
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Category
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Type
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Amount
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Date
                                </th>

                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr
                                v-for="transaction in transactions"
                                :key="transaction.id"
                                class="border-b border-slate-800 hover:bg-slate-900/60 transition">

                                <!-- Account -->
                                <td class="px-6 py-4">

                                    <div
                                        class="font-medium text-white">

                                        {{ transaction.account?.name }}

                                    </div>

                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4">

                                    <span class="text-slate-300">

                                        {{ transaction.category?.name }}

                                    </span>

                                </td>

                                <!-- Type -->
                                <td class="px-6 py-4">

                                    <span
                                        v-if="transaction.type === 'income'"
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">

                                        Income

                                    </span>

                                    <span
                                        v-else
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/10 border border-rose-500/20 text-rose-400">

                                        Expense

                                    </span>

                                </td>

                                <!-- Amount -->

                                <td class="px-6 py-4">

                                    <span
                                        v-if="transaction.type === 'income'"
                                        class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">

                                        + ${{ formatAmount(transaction.amount) }}

                                    </span>

                                    <span
                                        v-else
                                        class="font-bold text-rose-400">

                                        - ${{ formatAmount(transaction.amount) }}

                                    </span>

                                </td>

                                <!-- Date -->

                                <td class="px-6 py-4 text-slate-400">

                                    {{ formatDate(transaction.transaction_date) }}

                                </td>

                                <!-- Actions -->

                                <td class="px-6 py-4">

                                    <div
                                        class="flex items-center justify-center gap-2">

                                        <!-- Show -->

                                        <Link
                                            :href="`/transactions/${transaction.id}`"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-cyan-400 transition-colors">

                                            Show

                                        </Link>

                                        <!-- Edit -->

                                        <Link
                                            :href="`/transactions/${transaction.id}/edit`"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-amber-400 transition-colors">

                                            Edit

                                        </Link>

                                        <!-- Delete -->

                                        <button
                                            @click="deleteTransaction(transaction)"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-rose-950/30 border border-slate-800 hover:border-rose-900/50 rounded-lg text-xs font-medium text-slate-400 hover:text-rose-400 transition-colors">

                                            Delete

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <!-- Empty State -->

                            <tr
                                v-if="transactions.length === 0">

                                <td
                                    colspan="6"
                                    class="text-center py-12">

                                    <p
                                        class="text-slate-400">

                                        No transactions found.

                                    </p>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </AppLayout>
</template>