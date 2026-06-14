<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    transfer: Object,
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

                        Transfer Details

                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        View transfer information and account movement.
                    </p>

                </div>

                <div class="flex gap-3">

                    <Link
                        :href="`/transfers/${transfer.id}/edit`"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl">

                        Edit Transfer

                    </Link>

                    <Link
                        href="/transfers"
                        class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 font-medium">

                        Back

                    </Link>

                </div>

            </div>

            <!-- Hero Transfer Flow -->

            <div
                class="relative overflow-hidden bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-3xl p-10">

                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(34,211,238,0.15),transparent_35%)]">
                </div>

                <div class="relative text-center">

                    <!-- From Account -->

                    <div
                        class="inline-flex items-center justify-center px-6 py-4 rounded-2xl bg-slate-950/70 border border-slate-800">

                        <span
                            class="text-xl font-bold text-cyan-400">

                            {{ transfer.from_account?.name }}

                        </span>

                    </div>

                    <!-- Arrow -->

                    <div class="py-6">

                        <svg
                            class="w-10 h-10 mx-auto text-slate-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 5v14m0 0l-6-6m6 6l6-6"/>

                        </svg>

                    </div>

                    <!-- To Account -->

                    <div
                        class="inline-flex items-center justify-center px-6 py-4 rounded-2xl bg-slate-950/70 border border-slate-800">

                        <span
                            class="text-xl font-bold text-indigo-400">

                            {{ transfer.to_account?.name }}

                        </span>

                    </div>

                    <!-- Amount -->

                    <div class="mt-8">

                        <p
                            class="text-slate-500 uppercase tracking-wider text-xs">

                            Transfer Amount

                        </p>

                        <h2
                            class="mt-3 text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">

                            {{transfer?.currency || '$'}}{{ formatAmount(transfer.amount) }}

                        </h2>

                    </div>

                </div>

            </div>

            <!-- Information Card -->

            <div
                class="bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-3xl overflow-hidden">

                <div
                    class="px-8 py-5 border-b border-slate-800 bg-slate-950/30">

                    <h2
                        class="text-xl font-bold text-white">

                        Transfer Information

                    </h2>

                </div>

                <div class="p-8">

                    <div class="space-y-6">

                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">
                                Transfer ID
                            </span>

                            <span class="text-white font-medium">
                                #{{ transfer.id }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">
                                From Account
                            </span>

                            <span class="text-cyan-400 font-semibold">
                                {{ transfer.from_account?.name }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">
                                To Account
                            </span>

                            <span class="text-indigo-400 font-semibold">
                                {{ transfer.to_account?.name }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">
                                Amount
                            </span>

                            <span class="text-white font-bold">
                                {{transfer?.currency || '$'}}{{ formatAmount(transfer.amount) }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">
                                Transfer Date
                            </span>

                            <span class="text-white">
                                {{ formatDate(transfer.transfer_date) }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Meta Information -->

            <div class="grid md:grid-cols-2 gap-6">

                <div
                    class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <p
                        class="text-slate-500 text-xs uppercase tracking-wider">

                        Created At

                    </p>

                    <h4
                        class="text-white font-medium mt-2">

                        {{ formatDate(transfer.created_at) }}

                    </h4>

                </div>

                <div
                    class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6">

                    <p
                        class="text-slate-500 text-xs uppercase tracking-wider">

                        Last Updated

                    </p>

                    <h4
                        class="text-white font-medium mt-2">

                        {{ formatDate(transfer.updated_at) }}

                    </h4>

                </div>

            </div>

        </div>

    </AppLayout>
</template>