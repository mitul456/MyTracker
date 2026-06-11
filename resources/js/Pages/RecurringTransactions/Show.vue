<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    recurringTransaction: Object
});

const formatAmount = (amount) => {
    return Number(amount)
        .toFixed(2)
        .replace(/\d(?=(\d{3})+\.)/g, '$&,');
};
</script>

<template>
    <AppLayout>

        <div class="max-w-4xl mx-auto space-y-6">

            <!-- Header -->

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-3xl font-bold text-white">
                        Recurring Transaction Details
                    </h1>

                    <p class="text-slate-400 mt-1">
                        View recurring transaction information
                    </p>

                </div>

                <div class="flex gap-3">

                    <Link
                        :href="`/recurring-transactions/${recurringTransaction.id}/edit`"
                        class="px-5 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-semibold"
                    >
                        Edit
                    </Link>

                    <Link
                        href="/recurring-transactions"
                        class="px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 text-slate-300"
                    >
                        Back
                    </Link>

                </div>

            </div>

            <!-- Main Card -->

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8">

                <div class="grid md:grid-cols-2 gap-8">

                    <!-- ID -->

                    <div>
                        <p class="text-sm text-slate-500">
                            Transaction ID
                        </p>

                        <h3 class="text-xl font-bold text-white mt-2">
                            #{{ recurringTransaction.id }}
                        </h3>
                    </div>

                    <!-- Account -->

                    <div>
                        <p class="text-sm text-slate-500">
                            Account
                        </p>

                        <h3 class="text-xl font-bold text-white mt-2">
                            {{ recurringTransaction.account?.name }}
                        </h3>
                    </div>

                    <!-- Category -->

                    <div>
                        <p class="text-sm text-slate-500">
                            Category
                        </p>

                        <h3 class="text-xl font-bold text-white mt-2">
                            {{ recurringTransaction.category?.name }}
                        </h3>
                    </div>

                    <!-- Amount -->

                    <div>
                        <p class="text-sm text-slate-500">
                            Amount
                        </p>

                        <h3 class="text-xl font-bold text-cyan-400 mt-2">
                            ৳{{ formatAmount(recurringTransaction.amount) }}
                        </h3>
                    </div>

                    <!-- Type -->

                    <div>

                        <p class="text-sm text-slate-500">
                            Transaction Type
                        </p>

                        <div class="mt-3">

                            <span
                                v-if="recurringTransaction.type === 'income'"
                                class="px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-semibold"
                            >
                                Income
                            </span>

                            <span
                                v-else
                                class="px-4 py-2 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm font-semibold"
                            >
                                Expense
                            </span>

                        </div>

                    </div>

                    <!-- Frequency -->

                    <div>

                        <p class="text-sm text-slate-500">
                            Frequency
                        </p>

                        <h3
                            class="text-xl font-bold text-indigo-400 mt-2 capitalize"
                        >
                            {{ recurringTransaction.frequency }}
                        </h3>

                    </div>

                    <!-- Next Run Date -->

                    <div>

                        <p class="text-sm text-slate-500">
                            Next Run Date
                        </p>

                        <h3 class="text-xl font-bold text-white mt-2">
                            {{ recurringTransaction.next_run_date }}
                        </h3>

                    </div>

                    <!-- Created At -->

                    <div>

                        <p class="text-sm text-slate-500">
                            Created At
                        </p>

                        <h3 class="text-xl font-bold text-white mt-2">
                            {{ recurringTransaction.created_at }}
                        </h3>

                    </div>

                </div>

            </div>

            <!-- Summary Card -->

            <div
                class="bg-slate-900 border border-slate-800 rounded-2xl p-6"
            >

                <h3 class="text-lg font-bold text-white mb-4">
                    Schedule Summary
                </h3>

                <div class="grid md:grid-cols-3 gap-4">

                    <div
                        class="bg-slate-950 border border-slate-800 rounded-xl p-4"
                    >
                        <p class="text-slate-500 text-sm">
                            Amount
                        </p>

                        <p class="text-cyan-400 text-2xl font-bold mt-2">
                            ৳{{ formatAmount(recurringTransaction.amount) }}
                        </p>
                    </div>

                    <div
                        class="bg-slate-950 border border-slate-800 rounded-xl p-4"
                    >
                        <p class="text-slate-500 text-sm">
                            Frequency
                        </p>

                        <p
                            class="text-indigo-400 text-2xl font-bold mt-2 capitalize"
                        >
                            {{ recurringTransaction.frequency }}
                        </p>
                    </div>

                    <div
                        class="bg-slate-950 border border-slate-800 rounded-xl p-4"
                    >
                        <p class="text-slate-500 text-sm">
                            Next Run
                        </p>

                        <p class="text-white text-2xl font-bold mt-2">
                            {{ recurringTransaction.next_run_date }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </AppLayout>
</template>