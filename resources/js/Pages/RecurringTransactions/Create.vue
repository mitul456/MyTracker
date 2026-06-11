<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    accounts: Array,
    categories: Array
});

const form = useForm({
    account_id: '',
    category_id: '',
    amount: '',
    type: 'expense',
    frequency: 'monthly',
    next_run_date: ''
});

const submit = () => {
    form.post('/recurring-transactions');
};
</script>

<template>
    <AppLayout>

        <div class="max-w-4xl mx-auto">

            <!-- Header -->

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h1 class="text-3xl font-bold text-white">
                        Create Recurring Transaction
                    </h1>

                    <p class="text-slate-400 mt-1">
                        Schedule automatic income or expense transactions.
                    </p>

                </div>

                <Link
                    href="/recurring-transactions"
                    class="px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 text-slate-300"
                >
                    Back
                </Link>

            </div>

            <!-- Form Card -->

            <div
                class="bg-slate-900 border border-slate-800 rounded-2xl p-8"
            >

                <form @submit.prevent="submit">

                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- Account -->

                        <div>

                            <label
                                class="block text-sm text-slate-400 mb-2"
                            >
                                Account
                            </label>

                            <select
                                v-model="form.account_id"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white"
                            >

                                <option value="">
                                    Select Account
                                </option>

                                <option
                                    v-for="account in accounts"
                                    :key="account.id"
                                    :value="account.id"
                                >
                                    {{ account.name }}
                                </option>

                            </select>

                            <p
                                v-if="form.errors.account_id"
                                class="text-rose-400 text-sm mt-1"
                            >
                                {{ form.errors.account_id }}
                            </p>

                        </div>

                        <!-- Category -->

                        <div>

                            <label
                                class="block text-sm text-slate-400 mb-2"
                            >
                                Category
                            </label>

                            <select
                                v-model="form.category_id"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white"
                            >

                                <option value="">
                                    Select Category
                                </option>

                                <option
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.name }}
                                </option>

                            </select>

                            <p
                                v-if="form.errors.category_id"
                                class="text-rose-400 text-sm mt-1"
                            >
                                {{ form.errors.category_id }}
                            </p>

                        </div>

                        <!-- Amount -->

                        <div>

                            <label
                                class="block text-sm text-slate-400 mb-2"
                            >
                                Amount
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                v-model="form.amount"
                                placeholder="Enter amount"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white"
                            >

                            <p
                                v-if="form.errors.amount"
                                class="text-rose-400 text-sm mt-1"
                            >
                                {{ form.errors.amount }}
                            </p>

                        </div>

                        <!-- Type -->

                        <div>

                            <label
                                class="block text-sm text-slate-400 mb-2"
                            >
                                Transaction Type
                            </label>

                            <select
                                v-model="form.type"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white"
                            >
                                <option value="income">
                                    Income
                                </option>

                                <option value="expense">
                                    Expense
                                </option>

                            </select>

                            <p
                                v-if="form.errors.type"
                                class="text-rose-400 text-sm mt-1"
                            >
                                {{ form.errors.type }}
                            </p>

                        </div>

                        <!-- Frequency -->

                        <div>

                            <label
                                class="block text-sm text-slate-400 mb-2"
                            >
                                Frequency
                            </label>

                            <select
                                v-model="form.frequency"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white"
                            >

                                <option value="daily">
                                    Daily
                                </option>

                                <option value="weekly">
                                    Weekly
                                </option>

                                <option value="monthly">
                                    Monthly
                                </option>

                                <option value="yearly">
                                    Yearly
                                </option>

                            </select>

                            <p
                                v-if="form.errors.frequency"
                                class="text-rose-400 text-sm mt-1"
                            >
                                {{ form.errors.frequency }}
                            </p>

                        </div>

                        <!-- Next Run Date -->

                        <div>

                            <label
                                class="block text-sm text-slate-400 mb-2"
                            >
                                Next Run Date
                            </label>

                            <input
                                type="date"
                                v-model="form.next_run_date"
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white"
                            >

                            <p
                                v-if="form.errors.next_run_date"
                                class="text-rose-400 text-sm mt-1"
                            >
                                {{ form.errors.next_run_date }}
                            </p>

                        </div>

                    </div>

                    <!-- Buttons -->

                    <div class="flex justify-end gap-3 mt-8">

                        <Link
                            href="/recurring-transactions"
                            class="px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 text-slate-300"
                        >
                            Cancel
                        </Link>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-5 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold"
                        >
                            {{
                                form.processing
                                    ? 'Saving...'
                                    : 'Save Recurring Transaction'
                            }}
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </AppLayout>
</template>