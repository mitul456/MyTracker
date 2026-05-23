<template>
    <AppLayout>
        <div class="space-y-8">
            <!-- Welcome Header Status -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                        Financial Overview
                    </h1>
                    <p class="text-slate-400 text-sm mt-1">Here's the summary of your accounts and transactions.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-4 py-2.5 bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-300 hover:text-white rounded-xl text-sm font-medium transition-all duration-200">+ Transfer Money</button>
                    <button class="px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl text-sm transition-all duration-200 shadow-lg shadow-cyan-500/10">+ New Transaction</button>
                </div>
            </div>

            <!-- Top Grid Widgets (Net, In, Out) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Net Balance -->
                <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-6 transition-all duration-300 hover:border-slate-700">
                    <div class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/40 to-transparent"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Net Balance</span>
                        <div class="p-2 bg-cyan-500/10 rounded-xl text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-3xl font-bold text-white">\$45,250.00</h3>
                        <p class="text-xs text-emerald-400 flex items-center gap-1 mt-1"><span>↑ 12%</span> <span class="text-slate-500">from last month</span></p>
                    </div>
                </div>

                <!-- Income Card -->
                <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-6 transition-all duration-300 hover:border-slate-700">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Income</span>
                        <div class="p-2 bg-emerald-500/10 rounded-xl text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-3xl font-bold text-white">\$12,480.00</h3>
                        <p class="text-xs text-slate-500 mt-1">This current month</p>
                    </div>
                </div>

                <!-- Expenses Card -->
                <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-6 transition-all duration-300 hover:border-slate-700">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Expenses</span>
                        <div class="p-2 bg-rose-500/10 rounded-xl text-rose-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-3xl font-bold text-white">\$3,820.00</h3>
                        <p class="text-xs text-rose-400 flex items-center gap-1 mt-1"><span>↓ 4%</span> <span class="text-slate-500">of active budgets spent</span></p>
                    </div>
                </div>
            </div>

            <!-- Lower Layout Workspace Splitting -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left/Middle Content Core Grid Table/Accounts data -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-6">
                        <h2 class="text-lg font-bold text-white mb-4">My Accounts</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div v-for="account in accounts" :key="account.id" class="p-4 bg-slate-950/50 border border-slate-800 rounded-xl flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ account.name }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Active Account</p>
                                </div>
                                <span class="text-base font-bold text-cyan-400">\${{ account.balance }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Transactions Matrix Table -->
                    <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-white">Recent Transactions</h2>
                            <a href="#" class="text-xs font-semibold text-cyan-400 hover:underline">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-800 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                        <th class="pb-3">Date</th>
                                        <th class="pb-3">Category/Note</th>
                                        <th class="pb-3">Account</th>
                                        <th class="pb-3 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/60 text-sm">
                                    <tr v-for="tx in transactions" :key="tx.id" class="group hover:bg-slate-800/20 transition-colors">
                                        <td class="py-3.5 text-slate-400 whitespace-nowrap">{{ tx.transaction_date }}</td>
                                        <td class="py-3.5">
                                            <span class="font-medium text-white block">Category #{{ tx.category_id }}</span>
                                            <span class="text-xs text-slate-500 block max-w-[180px] truncate">{{ tx.note || 'N/A' }}</span>
                                        </td>
                                        <td class="py-3.5 text-slate-400">Account #{{ tx.account_id }}</td>
                                        <td :class="['py-3.5 text-right font-bold', tx.type === 'income' ? 'text-emerald-400' : 'text-rose-400']">
                                            {{ tx.type === 'income' ? '+' : '-' }}\${{ tx.amount }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Side Widgets Section (Budgets & Recurring Alert lists) -->
                <div class="space-y-6">
                    <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-6">
                        <h2 class="text-lg font-bold text-white mb-4">Active Budgets</h2>
                        <div class="space-y-4">
                            <div v-for="budget in budgets" :key="budget.id" class="space-y-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-medium text-slate-300">Category #{{ budget.category_id }}</span>
                                    <span class="text-slate-400"><strong class="text-white">\${{ budget.amount }}</strong> Limit</span>
                                </div>
                                <div class="w-full h-2 bg-slate-950 rounded-full overflow-hidden">
                                    <div class="h-full bg-cyan-500 rounded-full" style="width: 65%"></div>
                                </div>
                                <p class="text-[11px] text-slate-500">Until {{ budget.end_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

// Dynamic Props binding from Laravel Interia Controller
defineProps({
accounts: Array,transactions: Array,budgets: Array});
</script>