<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    budgets: Array,
});

const form = useForm({});

const deleteBudget = (budget) => {
    if (confirm('Delete this budget?')) {
        form.delete(`/budgets/${budget.id}`);
    }
};

const formatAmount = (amount) => {
    return Number(amount)
        .toFixed(2)
        .replace(/\d(?=(\d{3})+\.)/g, '$&,');
};

const totalBudget = computed(() => {
    return props.budgets.reduce((sum, budget) => {
        return sum + Number(budget.amount);
    }, 0);
});
</script>

<template>
    <AppLayout>

        <div class="space-y-8">

            <!-- Header -->

            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">

                        Budget Management

                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Manage category-wise budgets and spending limits.
                    </p>

                </div>

                <Link
                    href="/budgets/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl text-sm transition-all duration-200">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2.5"
                            d="M12 4v16m8-8H4" />

                    </svg>

                    Add Budget

                </Link>

            </div>

            <!-- Stats Card -->

            <div
                class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                <div
                    class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/40 to-transparent">
                </div>

                <p
                    class="text-xs font-semibold text-slate-400 uppercase tracking-wider">

                    Total Budget

                </p>

                <h3
                    class="text-3xl font-bold text-cyan-400 mt-2">

                    {{ budgets[0].currency }}{{ formatAmount(totalBudget) }}

                </h3>

                <p
                    class="text-xs text-slate-500 mt-1">

                    Combined budget allocation

                </p>

            </div>

            <!-- Table -->

            <div
                class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr
                                class="border-b border-slate-800 bg-slate-950/40">

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    Category

                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    Budget Amount

                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    Start Date

                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    End Date

                                </th>

                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    Actions

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr
                                v-for="budget in budgets"
                                :key="budget.id"
                                class="border-b border-slate-800 hover:bg-slate-900/60 transition">

                                <!-- Category -->

                                <td class="px-6 py-4">

                                    <span
                                        class="font-medium text-white">

                                        {{ budget.category?.name }}

                                    </span>

                                </td>

                                <!-- Amount -->

                                <td class="px-6 py-4">

                                    <span
                                        class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">

                                        {{ budget.currency }}{{ formatAmount(budget.amount) }}

                                    </span>

                                </td>

                                <!-- Start Date -->

                                <td
                                    class="px-6 py-4 text-slate-400">

                                    {{ budget.start_date }}

                                </td>

                                <!-- End Date -->

                                <td
                                    class="px-6 py-4 text-slate-400">

                                    {{ budget.end_date }}

                                </td>

                                <!-- Actions -->

                                <td class="px-6 py-4">

                                    <div
                                        class="flex items-center justify-center gap-2">

                                        <Link
                                            :href="`/budgets/${budget.id}`"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-cyan-400 transition">

                                            Show

                                        </Link>

                                        <Link
                                            :href="`/budgets/${budget.id}/edit`"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-amber-400 transition">

                                            Edit

                                        </Link>

                                        <button
                                            @click="deleteBudget(budget)"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-slate-950 hover:bg-rose-950/30 border border-slate-800 hover:border-rose-900/50 rounded-lg text-xs font-medium text-slate-400 hover:text-rose-400 transition">

                                            Delete

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <!-- Empty State -->

                            <tr v-if="budgets.length === 0">

                                <td
                                    colspan="5"
                                    class="py-12 text-center">

                                    <p class="text-slate-400">
                                        No budgets found.
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