<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    transaction: Object,
});

const formatAmount = (amount) => {
    return Number(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString();
};
</script>

<template>
    <AppLayout>

        <div class="max-w-5xl mx-auto space-y-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                        Transaction Details
                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        View complete transaction information.
                    </p>
                </div>

                <div class="flex items-center gap-3">

                    <Link
                        :href="`/transactions/${transaction.id}/edit`"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl text-sm transition-all duration-200">

                        Edit Transaction

                    </Link>

                    <Link
                        href="/transactions"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 text-sm font-medium transition">

                        Back

                    </Link>

                </div>

            </div>

            <!-- Details Card -->

            <div
                class="relative bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-8">

                <!-- Top Accent Line -->

                <div
                    class="absolute top-0 left-8 right-8 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent">
                </div>

                <!-- Amount Section -->

                <div class="mb-8">

                    <p class="text-slate-500 text-sm uppercase tracking-wider">
                        Transaction Amount
                    </p>

                    <h2
                        v-if="transaction.type === 'income'"
                        class="mt-2 text-4xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">

                        + {{transaction.currency}}{{ formatAmount(transaction.amount) }}

                    </h2>
  
                    <h2
                        v-else
                        class="mt-2 text-4xl font-black tracking-tight text-rose-400">

                        - {{transaction.currency}}{{ formatAmount(transaction.amount) }}

                    </h2>

                </div>

                <!-- Information Grid -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Account -->

                    <div
                        class="bg-slate-950/50 border border-slate-800 rounded-xl p-5">

                        <p class="text-slate-500 text-sm">
                            Account
                        </p>

                        <h3 class="text-white font-semibold mt-2">
                            {{ transaction.account?.name }}
                        </h3>

                    </div>

                    <!-- Category -->

                    <div
                        class="bg-slate-950/50 border border-slate-800 rounded-xl p-5">

                        <p class="text-slate-500 text-sm">
                            Category
                        </p>

                        <h3 class="text-white font-semibold mt-2">
                            {{ transaction.category?.name }}
                        </h3>

                    </div>

                    <!-- Type -->

                    <div
                        class="bg-slate-950/50 border border-slate-800 rounded-xl p-5">

                        <p class="text-slate-500 text-sm">
                            Transaction Type
                        </p>

                        <div class="mt-2">

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

                        </div>

                    </div>

                    <!-- Date -->

                    <div
                        class="bg-slate-950/50 border border-slate-800 rounded-xl p-5">

                        <p class="text-slate-500 text-sm">
                            Transaction Date
                        </p>

                        <h3 class="text-white font-semibold mt-2">
                            {{ formatDate(transaction.transaction_date) }}
                        </h3>

                    </div>

                </div>

                <!-- Note Section -->

                <div
                    class="mt-8 bg-slate-950/50 border border-slate-800 rounded-xl p-5">

                    <p class="text-slate-500 text-sm mb-3">
                        Note
                    </p>

                    <p
                        v-if="transaction.note"
                        class="text-slate-300 leading-relaxed">

                        {{ transaction.note }}

                    </p>

                    <p
                        v-else
                        class="text-slate-500 italic">

                        No note provided.

                    </p>

                </div>

                <!-- Footer Info -->

                <div
                    class="mt-8 pt-6 border-t border-slate-800 flex flex-col sm:flex-row sm:justify-between gap-3">

                    <div>

                        <p class="text-slate-500 text-xs">
                            Created At
                        </p>

                        <p class="text-slate-300 text-sm mt-1">
                            {{ formatDate(transaction.created_at) }}
                        </p>

                    </div>

                    <div>

                        <p class="text-slate-500 text-xs">
                            Last Updated
                        </p>

                        <p class="text-slate-300 text-sm mt-1">
                            {{ formatDate(transaction.updated_at) }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </AppLayout>
</template>