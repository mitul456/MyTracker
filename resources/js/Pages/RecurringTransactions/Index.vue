<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    recurringTransactions: Array
});

const formatAmount = (amount) => {
    return Number(amount)
        .toFixed(2)
        .replace(/\d(?=(\d{3})+\.)/g, '$&,');
};


const destroy = (item) => {
    if (confirm('Are you sure you want to delete this recurring transaction?')) {
        router.delete(`/recurring-transactions/${item.id}`);
    }
};


</script>

<template>
    <AppLayout>

        <div class="space-y-6">

            <!-- Header -->

            <div class="flex items-center justify-between">

                <div>
                    <h1 class="text-3xl font-bold text-white">
                        Recurring Transactions
                    </h1>

                    <p class="text-slate-400 mt-1">
                        Manage automatic recurring income and expenses
                    </p>
                </div>

                <Link href="/recurring-transactions/create"
                    class="px-5 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold transition">
                    + Add Recurring Transaction
                </Link>

            </div>

            <!-- Stats -->

            <div class="grid md:grid-cols-3 gap-5">

                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5">

                    <p class="text-slate-400 text-sm">
                        Total Records
                    </p>

                    <h3 class="text-3xl font-bold text-white mt-2">
                        {{ recurringTransactions.length }}
                    </h3>

                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5">

                    <p class="text-slate-400 text-sm">
                        Income Schedules
                    </p>

                    <h3 class="text-3xl font-bold text-emerald-400 mt-2">

                        {{
                            recurringTransactions.filter(
                                item => item.type === 'income'
                            ).length
                        }}

                    </h3>

                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5">

                    <p class="text-slate-400 text-sm">
                        Expense Schedules
                    </p>

                    <h3 class="text-3xl font-bold text-rose-400 mt-2">

                        {{
                            recurringTransactions.filter(
                                item => item.type === 'expense'
                            ).length
                        }}

                    </h3>

                </div>

            </div>

            <!-- Table -->

            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">

                <div class="p-6 border-b border-slate-800">

                    <h3 class="text-lg font-bold text-white">
                        Recurring Transaction List
                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="bg-slate-950 border-b border-slate-800">

                                <th class="px-6 py-4 text-left text-slate-400">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-left text-slate-400">
                                    Account
                                </th>

                                <th class="px-6 py-4 text-left text-slate-400">
                                    Category
                                </th>

                                <th class="px-6 py-4 text-left text-slate-400">
                                    Type
                                </th>

                                <th class="px-6 py-4 text-left text-slate-400">
                                    Amount
                                </th>

                                <th class="px-6 py-4 text-left text-slate-400">
                                    Frequency
                                </th>

                                <th class="px-6 py-4 text-left text-slate-400">
                                    Next Run
                                </th>

                                <th class="px-6 py-4 text-left text-slate-400">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr v-for="item in recurringTransactions" :key="item.id"
                                class="border-b border-slate-800 hover:bg-slate-800/50">

                                <td class="px-6 py-4 text-white">
                                    #{{ item.id }}
                                </td>

                                <td class="px-6 py-4 text-slate-300">
                                    {{ item.account?.name }}
                                </td>

                                <td class="px-6 py-4 text-slate-300">
                                    {{ item.category?.name }}
                                </td>

                                <td class="px-6 py-4">

                                    <span v-if="item.type === 'income'"
                                        class="px-3 py-1 rounded-full text-xs bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        Income
                                    </span>

                                    <span v-else
                                        class="px-3 py-1 rounded-full text-xs bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        Expense
                                    </span>

                                </td>

                                <td class="px-6 py-4 font-bold text-white">
                                    {{item?.currency || '$'}}{{ formatAmount(item.amount) }}
                                </td>

                                <td class="px-6 py-4 text-slate-300 capitalize">
                                    {{ item.frequency }}
                                </td>

                                <td class="px-6 py-4 text-slate-300">
                                    {{ item.next_run_date }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex gap-2">

                                        <Link :href="`/recurring-transactions/${item.id}`"
                                            class="px-3 py-1 rounded-lg bg-indigo-500 text-white text-sm">
                                            View
                                        </Link>

                                        <Link :href="`/recurring-transactions/${item.id}/edit`"
                                            class="px-3 py-1 rounded-lg bg-amber-500 text-white text-sm">
                                            Edit
                                        </Link>

                                        <button @click="destroy(item)"
                                            class="px-3 py-1 rounded-lg bg-rose-500 text-white text-sm">
                                            Delete
                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr v-if="recurringTransactions.length === 0">

                                <td colspan="8" class="text-center py-16 text-slate-500">
                                    No recurring transactions found.
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Pagination -->

            <div class="flex gap-2">

                <Link v-for="link in recurringTransactions.links" :key="link.label" :href="link.url" v-html="link.label"
                    class="px-4 py-2 rounded-xl border border-slate-800 text-slate-300" :class="{
                        'bg-cyan-500 text-slate-950 font-bold': link.active
                    }" />

            </div>

        </div>

    </AppLayout>
</template>