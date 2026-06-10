<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    categories: Array,
});

const form = useForm({
    category_id: '',
    amount: '',
    start_date: '',
    end_date: '',
});

const submit = () => {
    form.post('/budgets');
};
</script>

<template>
    <AppLayout>

        <div class="max-w-4xl mx-auto space-y-8">

            <!-- Header -->

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">

                        Create Budget

                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Set a spending limit for a category.
                    </p>

                </div>

                <Link
                    href="/budgets"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 text-sm font-medium transition">

                    Back

                </Link>

            </div>

            <!-- Form Card -->

            <div
                class="relative bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">

                <div
                    class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent">
                </div>

                <form
                    @submit.prevent="submit"
                    class="space-y-6">

                    <!-- Category -->

                    <div>

                        <label
                            class="block text-sm font-medium text-slate-300 mb-2">

                            Category

                        </label>

                        <select
                            v-model="form.category_id"
                            class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                            <option value="">
                                Select Category
                            </option>

                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id">

                                {{ category.name }}

                            </option>

                        </select>

                        <p
                            v-if="form.errors.category_id"
                            class="text-rose-400 text-sm mt-1">

                            {{ form.errors.category_id }}

                        </p>

                    </div>

                    <!-- Amount -->

                    <div>

                        <label
                            class="block text-sm font-medium text-slate-300 mb-2">

                            Budget Amount

                        </label>

                        <input
                            v-model="form.amount"
                            type="number"
                            step="0.01"
                            placeholder="Enter Budget Amount"
                            class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-cyan-500 focus:outline-none">

                        <p
                            v-if="form.errors.amount"
                            class="text-rose-400 text-sm mt-1">

                            {{ form.errors.amount }}

                        </p>

                    </div>

                    <!-- Dates -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Start Date -->

                        <div>

                            <label
                                class="block text-sm font-medium text-slate-300 mb-2">

                                Start Date

                            </label>

                            <input
                                v-model="form.start_date"
                                type="date"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                            <p
                                v-if="form.errors.start_date"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.start_date }}

                            </p>

                        </div>

                        <!-- End Date -->

                        <div>

                            <label
                                class="block text-sm font-medium text-slate-300 mb-2">

                                End Date

                            </label>

                            <input
                                v-model="form.end_date"
                                type="date"
                                class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:outline-none">

                            <p
                                v-if="form.errors.end_date"
                                class="text-rose-400 text-sm mt-1">

                                {{ form.errors.end_date }}

                            </p>

                        </div>

                    </div>

                    <!-- Budget Preview -->

                    <div
                        v-if="form.amount"
                        class="bg-slate-950/50 border border-slate-800 rounded-xl p-5">

                        <p
                            class="text-slate-500 text-xs uppercase tracking-wider mb-3">

                            Budget Preview

                        </p>

                        <div
                            class="flex items-center justify-between">

                            <span class="text-slate-400">
                                Allocated Budget
                            </span>

                            <span
                                class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">

                                ${{ Number(form.amount || 0).toLocaleString() }}

                            </span>

                        </div>

                    </div>

                    <!-- Buttons -->

                    <div class="flex items-center gap-3 pt-2">

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl transition-all duration-200 disabled:opacity-50">

                            <span v-if="form.processing">
                                Saving...
                            </span>

                            <span v-else>
                                Save Budget
                            </span>

                        </button>

                        <Link
                            href="/budgets"
                            class="px-5 py-3 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-slate-300 font-medium transition">

                            Cancel

                        </Link>

                    </div>

                </form>

            </div>

        </div>

    </AppLayout>
</template>