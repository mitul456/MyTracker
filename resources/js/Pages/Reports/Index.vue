<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import IncomeExpenseChart from './Components/IncomeExpenseChart.vue';
import CategoryBreakdownChart from './Components/CategoryBreakdownChart.vue';
import TransactionTrendChart from './Components/TransactionTrendChart.vue';
import { Link, router } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';


const generateReport = () => {
    router.get('/reports', filters, {
        preserveState: true,
        replace: true,
    });
};

const resetFilters = () => {
    router.get('/reports');
};

const props = defineProps({
    transactions: Object,
    accounts: Array,
    categories: Array,
    filters: Object,
    incomeExpenseChart: Array,
    categoryBreakdown: Array,
    transactionTrend: Array,
});

const exportCsvUrl = computed(() => {
    return '/reports/export-csv?' +
        new URLSearchParams(filters).toString();
});

const exportExcelUrl = computed(() => {
    return '/reports/export-excel?' +
        new URLSearchParams(filters).toString();
});

const printUrl = computed(() => {
    return '/reports/print?' +
        new URLSearchParams(filters).toString();
});



const filters = reactive({
    start_date: props.filters?.start_date ?? '',
    end_date: props.filters?.end_date ?? '',
    account_id: props.filters?.account_id ?? '',
    category_id: props.filters?.category_id ?? '',
    type: props.filters?.type ?? '',
    search: props.filters?.search ?? '',
});

const transactions = computed(() => {
    return props.transactions?.data ?? [];
});

const totalIncome = computed(() => {
    return transactions.value
        .filter(item => item.type === 'income')
        .reduce((sum, item) => sum + Number(item.amount), 0);
});

const totalExpense = computed(() => {
    return transactions.value
        .filter(item => item.type === 'expense')
        .reduce((sum, item) => sum + Number(item.amount), 0);
});

const netBalance = computed(() => {
    return totalIncome.value - totalExpense.value;
});

const totalTransactions = computed(() => {
    return transactions.value.length;
});

const formatAmount = (amount) => {
    return Number(amount)
        .toFixed(2)
        .replace(/\d(?=(\d{3})+\.)/g, '$&,');
};
</script>

<template>
    <AppLayout>

        <div class="space-y-8">

            <!-- Header -->

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                <div>

                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">

                        Transaction Reports

                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Analyze income, expenses and financial activities.
                    </p>

                </div>

                <div class="flex gap-3">

                    <button @click="generateReport"
                        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 text-slate-950 font-bold">
                        Generate Report
                    </button>

                    <button @click="resetFilters"
                        class="px-5 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-slate-300">
                        Reset
                    </button>

                </div>

            </div>

            <!-- Filters -->

            <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                <h3 class="text-lg font-bold text-white mb-6">

                    Report Filters

                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

                    <!-- Start Date -->

                    <div>

                        <label class="block text-sm text-slate-400 mb-2">

                            Start Date

                        </label>

                        <input type="date" v-model="filters.start_date"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white">

                    </div>

                    <!-- End Date -->

                    <div>

                        <label class="block text-sm text-slate-400 mb-2">

                            End Date

                        </label>

                        <input type="date" v-model="filters.end_date"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white">

                    </div>

                    <!-- Account -->

                    <div>

                        <label class="block text-sm text-slate-400 mb-2">

                            Account

                        </label>

                        <select v-model="filters.account_id"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white">

                            <option value="">
                                All Accounts
                            </option>

                            <option v-for="account in accounts" :key="account.id" :value="account.id">

                                {{ account.name }}

                            </option>

                        </select>

                        <!-- <p
                                v-if="form.errors.account_id"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.account_id }}

                            </p> -->



                    </div>

                    <!-- Category -->

                    <div>

                        <label class="block text-sm text-slate-400 mb-2">

                            Category

                        </label>

                        <select v-model="filters.category_id"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white">

                            <option value="">
                                All Categories
                            </option>

                            <option v-for="category in categories" :key="category.id" :value="category.id">

                                {{ category.name }}

                            </option>

                        </select>

                    </div>

                    <!-- Type -->

                    <div>

                        <label class="block text-sm text-slate-400 mb-2">

                            Transaction Type

                        </label>

                        <select v-model="filters.type"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white">

                            <option value="">
                                All
                            </option>
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>

                        </select>

                    </div>


                    <!-- Search -->

                    <div class="xl:col-span-2">

                        <label class="block text-sm text-slate-400 mb-2">

                            Search Note

                        </label>

                        <input type="text" v-model="filters.search" placeholder="Search transaction notes..."
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500">

                    </div>

                </div>

            </div>

            <!-- KPI Cards -->

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <!-- Income -->

                <div class="relative bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-emerald-500/40 to-transparent">
                    </div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">

                        Total Income

                    </p>

                    <h3 class="text-3xl font-black text-emerald-400 mt-3">

                        ৳{{ formatAmount(totalIncome) }}

                    </h3>

                </div>

                <!-- Expense -->

                <div class="relative bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-rose-500/40 to-transparent">
                    </div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">

                        Total Expense

                    </p>

                    <h3 class="text-3xl font-black text-rose-400 mt-3">

                        ৳{{ formatAmount(totalExpense) }}

                    </h3>

                </div>

                <!-- Net -->

                <div class="relative bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/40 to-transparent">
                    </div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">

                        Net Balance

                    </p>

                    <h3 class="text-3xl font-black text-cyan-400 mt-3">

                        ৳{{ formatAmount(netBalance) }}

                    </h3>

                </div>

                <!-- Count -->

                <div class="relative bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-indigo-500/40 to-transparent">
                    </div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">

                        Transactions

                    </p>

                    <h3 class="text-3xl font-black text-white mt-3">

                        {{ totalTransactions }}

                    </h3>

                </div>

            </div>

            <!-- Analytics Cards -->

            <div class="grid lg:grid-cols-2 gap-6">

                <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <h3 class="text-lg font-bold text-white mb-6">

                        Income vs Expense Chart

                    </h3>

                    <div class="h-80 rounded-xl border border-dashed border-slate-700 flex items-center justify-center">

                        <IncomeExpenseChart
                        :chart-data="incomeExpenseChart"
                        />

                    </div> 
                    

                </div>

                <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <h3 class="text-lg font-bold text-white mb-6">

                        Category Breakdown

                    </h3>

                    <div class="h-80 rounded-xl border border-dashed border-slate-700 flex items-center justify-center">

                        <CategoryBreakdownChart
                            :chart-data="categoryBreakdown"
                        />

                    </div>

                </div>

            </div>

            <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                <h3 class="text-lg font-bold text-white mb-6">

                    Transaction Trend

                </h3>

                <div class="h-80 rounded-xl border border-dashed border-slate-700 flex items-center justify-center">

                    <<TransactionTrendChart
                        :chart-data="transactionTrend"
                    />

                </div>

            </div>

            <!-- Transaction Report Table -->

            <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl overflow-hidden">

                <!-- Table Header -->

                <div
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 border-b border-slate-800">

                    <div>

                        <h3 class="text-lg font-bold text-white">

                            Transaction Report

                        </h3>

                        <p class="text-sm text-slate-400 mt-1">

                            Detailed financial transaction records

                        </p>

                    </div>

                    <!-- Export Buttons -->

                    <div class="flex flex-wrap gap-3">

                        <Link :href="exportCsvUrl">
                            Export CSV
                        </Link>

                        <Link :href="exportExcelUrl">
                            Export Excel
                        </Link>

                        <Link :href="printUrl" target="_blank">
                            Print
                        </Link>

                    </div>

                </div>

                <!-- Table -->

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="bg-slate-950/40 border-b border-slate-800">

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    ID

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    Date

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    User

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    Account

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    Category

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    Type

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    Amount

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    Note

                                </th>

                                <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-slate-400">

                                    Created

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr v-for="transaction in transactions" :key="transaction.id"
                                class="border-b border-slate-800 hover:bg-slate-900/50 transition">

                                <!-- ID -->

                                <td class="px-6 py-4 text-white font-medium">

                                    #{{ transaction.id }}

                                </td>

                                <!-- Date -->

                                <td class="px-6 py-4 text-slate-300">

                                    {{ transaction.transaction_date }}

                                </td>

                                <!-- User -->

                                <td class="px-6 py-4 text-slate-300">

                                    {{ transaction.user?.name }}

                                </td>

                                <!-- Account -->

                                <td class="px-6 py-4 text-slate-300">

                                    {{ transaction.account?.name }}

                                </td>

                                <!-- Category -->

                                <td class="px-6 py-4 text-slate-300">

                                    {{ transaction.category?.name }}

                                </td>

                                <!-- Type -->

                                <td class="px-6 py-4">

                                    <span v-if="transaction.type === 'income'"
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">

                                        Income

                                    </span>

                                    <span v-else
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/10 border border-rose-500/20 text-rose-400">

                                        Expense

                                    </span>

                                </td>

                                <!-- Amount -->

                                <td class="px-6 py-4">

                                    <span v-if="transaction.type === 'income'" class="font-bold text-emerald-400">

                                        + ৳{{ formatAmount(transaction.amount) }}

                                    </span>

                                    <span v-else class="font-bold text-rose-400">

                                        - ৳{{ formatAmount(transaction.amount) }}

                                    </span>

                                </td>

                                <!-- Note -->

                                <td class="px-6 py-4 text-slate-400 max-w-xs truncate">

                                    {{ transaction.note || '—' }}

                                </td>

                                <!-- Created -->

                                <td class="px-6 py-4 text-slate-400">

                                    {{ transaction.created_at }}

                                </td>

                            </tr>

                            <!-- Empty State -->

                            <tr v-if="transactions.length === 0">

                                <td colspan="9" class="py-16 text-center">

                                    <p class="text-slate-500">

                                        No transactions found.

                                    </p>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Pagination -->

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="text-sm text-slate-400">

                    Showing
                    {{ props.transactions.from }}
                    -
                    {{ props.transactions.to }}
                    of
                    {{ props.transactions.total }}
                    records

                </div>

                <div class="flex gap-2">

                    <button class="px-4 py-2 rounded-xl bg-slate-900 border border-slate-800 text-slate-300">

                        Previous

                    </button>

                    <button
                        class="px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 text-slate-950 font-bold">

                        1

                    </button>

                    <button class="px-4 py-2 rounded-xl bg-slate-900 border border-slate-800 text-slate-300">

                        Next

                    </button>

                </div>

            </div>

            <!-- Report Footer -->

            <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">

                    <div>

                        <p class="text-xs uppercase tracking-wider text-slate-500">

                            Date Range

                        </p>

                        <p class="text-white mt-2">

                            {{ filters.start_date || 'N/A' }}
                            →
                            {{ filters.end_date || 'N/A' }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider text-slate-500">

                            Generated By

                        </p>

                        <p class="text-white mt-2">

                            Current User

                        </p>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider text-slate-500">

                            Generated At

                        </p>

                        <p class="text-white mt-2">

                            {{ new Date().toLocaleString() }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider text-slate-500">

                            Total Records

                        </p>

                        <p class="text-cyan-400 font-bold text-xl mt-2">

                            {{ props.transactions.total }}

                        </p>

                    </div>

                </div>

            </div>

            <Link
                v-for="link in props.transactions.links"
                :key="link.label"
                :href="link.url || '#'"
                v-html="link.label"
                class="px-4 py-2 rounded-xl border border-slate-800"
                :class="{
                    'bg-cyan-500 text-slate-950': link.active,
                    'opacity-50 pointer-events-none': !link.url
                }"
            />

        </div>

    </AppLayout>
</template>