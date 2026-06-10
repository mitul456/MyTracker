<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    transfers: Array,
});

const form = useForm({});

const deleteTransfer = (transfer) => {
    if (confirm('Are you sure you want to delete this transfer?')) {
        form.delete(`/transfers/${transfer.id}`);
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

            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">

                        Transfers

                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Manage money transfers between your accounts.
                    </p>
                </div>

                <Link
                    href="/transfers/create"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl text-sm transition-all duration-200 shadow-lg shadow-cyan-500/10">

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

                    Add Transfer

                </Link>

            </div>

            <!-- Stats Card -->

            <div
                class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                <div
                    class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent">
                </div>

                <p
                    class="text-xs font-semibold text-slate-400 uppercase tracking-wider">

                    Total Transfers

                </p>

                <h3
                    class="text-3xl font-bold text-white mt-2">

                    {{ transfers.length }}

                </h3>

                <p
                    class="text-xs text-slate-500 mt-1">

                    Total transfer records

                </p>

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

                                    From Account

                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    To Account

                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    Amount

                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    Transfer Date

                                </th>

                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-400">

                                    Actions

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr
                                v-for="transfer in transfers"
                                :key="transfer.id"
                                class="border-b border-slate-800 hover:bg-slate-900/60 transition">

                                <!-- From Account -->

                                <td class="px-6 py-4">

                                    <div
                                        class="font-semibold text-white">

                                        {{ transfer.from_account?.name }}

                                    </div>

                                </td>

                                <!-- To Account -->

                                <td class="px-6 py-4">

                                    <div
                                        class="font-semibold text-white">

                                        {{ transfer.to_account?.name }}

                                    </div>

                                </td>

                                <!-- Amount -->

                                <td class="px-6 py-4">

                                    <span
                                        class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">

                                        ৳{{ formatAmount(transfer.amount) }}

                                    </span>

                                </td>

                                <!-- Date -->

                                <td
                                    class="px-6 py-4 text-slate-400">

                                    {{ formatDate(transfer.transfer_date) }}

                                </td>

                                <!-- Actions -->

                                <td class="px-6 py-4">

                                    <div
                                        class="flex items-center justify-center gap-2">

                                        <!-- Show -->

                                        <Link
                                            :href="`/transfers/${transfer.id}`"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-cyan-400 transition-colors">

                                            Show

                                        </Link>

                                        <!-- Edit -->

                                        <Link
                                            :href="`/transfers/${transfer.id}/edit`"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-amber-400 transition-colors">

                                            Edit

                                        </Link>

                                        <!-- Delete -->

                                        <button
                                            @click="deleteTransfer(transfer)"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-rose-950/30 border border-slate-800 hover:border-rose-900/50 rounded-lg text-xs font-medium text-slate-400 hover:text-rose-400 transition-colors">

                                            Delete

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <!-- Empty State -->

                            <tr
                                v-if="transfers.length === 0">

                                <td
                                    colspan="5"
                                    class="text-center py-16">

                                    <div
                                        class="flex flex-col items-center">

                                        <p
                                            class="text-slate-400 font-medium">

                                            No transfers found

                                        </p>

                                        <p
                                            class="text-slate-500 text-sm mt-1">

                                            Create your first transfer.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </AppLayout>
</template>