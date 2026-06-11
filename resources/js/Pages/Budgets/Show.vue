<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    budget: Object,
    spentAmount: Number,
});

const formatAmount = (amount) => {
    return Number(amount)
        .toFixed(2)
        .replace(/\d(?=(\d{3})+\.)/g, '$&,');
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString();
};



const remainingAmount = computed(() => {
    return props.budget.amount - props.spentAmount;
});

const usagePercentage = computed(() => {
    if (!props.budget?.amount) return 0;

    return Math.min(
        (props.spentAmount / props.budget.amount) * 100,
        100
    );
});
</script>

<template>
    <AppLayout>

        <div class="max-w-6xl mx-auto space-y-8">

            <!-- Header -->

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">

                        Budget Details

                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Review budget allocation and period information.
                    </p>

                </div>

                <div class="flex gap-3">

                    <Link :href="`/budgets/${budget.id}/edit`"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl">

                        Edit Budget

                    </Link>

                    <Link href="/budgets"
                        class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 font-medium">

                        Back

                    </Link>

                </div>

            </div>

            <!-- Hero Card -->

            <div
                class="relative overflow-hidden bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-3xl p-10">

                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(34,211,238,0.15),transparent_35%)]">
                </div>

                <div class="relative">

                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">

                        Budget Category

                    </p>

                    <h2 class="mt-3 text-4xl font-black text-white">

                        {{ budget.category?.name }}

                    </h2>

                    <div class="mt-8">

                        <p class="text-slate-500 text-xs uppercase tracking-wider">

                            Allocated Budget

                        </p>

                        <h3
                            class="mt-2 text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">

                            ${{ formatAmount(budget.amount) }}

                        </h3>

                    </div>

                </div>

            </div>




            <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-3xl p-8">

                <div class="flex justify-between mb-3">

                    <span class="text-slate-400">
                        Budget Usage
                    </span>

                    <span class="text-cyan-400 font-bold">
                        {{ Number(usagePercentage).toFixed(1) }}%
                    </span>

                </div>

                <div class="w-full h-4 bg-slate-800 rounded-full overflow-hidden">

                    <div class="h-full bg-gradient-to-r from-cyan-500 to-indigo-500 transition-all duration-500"
                        :style="{ width: `${usagePercentage}%` }">
                    </div>

                </div>

            </div>

            <!-- Info Grid -->

            <div class="grid md:grid-cols-3 gap-6">

                <!-- Budget Amount -->

                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                    <p class="text-slate-500 text-xs uppercase tracking-wider">

                        Budget Amount

                    </p>

                    <h4 class="mt-3 text-xl font-bold text-cyan-400">

                        ${{ formatAmount(budget.amount) }}

                    </h4>

                </div>

                <!-- Spent Amount -->

                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                    <p class="text-slate-500 text-xs uppercase tracking-wider">
                        Spent Amount
                    </p>

                    <h4 class="mt-3 text-xl font-bold text-rose-400">
                        ${{ formatAmount(spentAmount) }}
                    </h4>

                </div>

                <!-- Remaining Amount -->

                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                    <p class="text-slate-500 text-xs uppercase tracking-wider">
                        Remaining Budget
                    </p>

                    <h4 class="mt-3 text-xl font-bold"
                        :class="remainingAmount >= 0 ? 'text-emerald-400' : 'text-red-500'">
                        ${{ formatAmount(remainingAmount) }}
                    </h4>

                </div>

                <!-- Start Date -->

                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                    <p class="text-slate-500 text-xs uppercase tracking-wider">

                        Start Date

                    </p>

                    <h4 class="mt-3 text-xl font-bold text-white">

                        {{ formatDate(budget.start_date) }}

                    </h4>

                </div>

                <!-- End Date -->

                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                    <p class="text-slate-500 text-xs uppercase tracking-wider">

                        End Date

                    </p>

                    <h4 class="mt-3 text-xl font-bold text-white">

                        {{ formatDate(budget.end_date) }}

                    </h4>

                </div>

            </div>

            <!-- Details Card -->

            <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-3xl overflow-hidden">

                <div class="px-8 py-5 border-b border-slate-800 bg-slate-950/30">

                    <h2 class="text-xl font-bold text-white">

                        Budget Information

                    </h2>

                </div>


                <div class="p-8 space-y-6">

                    <div class="flex items-center justify-between">

                        <span class="text-slate-500">
                            Budget ID
                        </span>

                        <span class="text-white font-medium">
                            #{{ budget.id }}
                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-slate-500">
                            Category
                        </span>

                        <span class="text-cyan-400 font-semibold">
                            {{ budget.category?.name }}
                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-slate-500">
                            Allocated Amount
                        </span>

                        <span class="text-white font-bold">
                            ${{ formatAmount(budget.amount) }}
                        </span>

                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Total Expense</span>
                        <span class="text-rose-400 font-bold">
                            ${{ formatAmount(spentAmount) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Remaining Budget</span>
                        <span class="text-emerald-400 font-bold">
                            ${{ formatAmount(remainingAmount) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-slate-500">
                            Budget Period
                        </span>

                        <span class="text-white">
                            {{ formatDate(budget.start_date) }}
                            →
                            {{ formatDate(budget.end_date) }}
                        </span>

                    </div>

                </div>

            </div>

            <!-- Metadata -->

            <div class="grid md:grid-cols-2 gap-6">

                <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <p class="text-slate-500 text-xs uppercase tracking-wider">

                        Created At

                    </p>

                    <h4 class="text-white font-medium mt-2">

                        {{ formatDate(budget.created_at) }}

                    </h4>

                </div>

                <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <p class="text-slate-500 text-xs uppercase tracking-wider">

                        Last Updated

                    </p>

                    <h4 class="text-white font-medium mt-2">

                        {{ formatDate(budget.updated_at) }}

                    </h4>

                </div>

            </div>

        </div>

    </AppLayout>
</template>