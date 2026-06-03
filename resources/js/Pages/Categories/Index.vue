<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: {
        type: Array,
        default: () => []

    },
    category: {
        type: Object,
        default: () => ({})
    }
});

const showViewModal = ref(false);
const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);

const selectedCategory = ref({});

const form = useForm({
    name: props.category.name || '',
    type: props.category.type || 'income'
});

const saveCategory = () => {
    form.post('/categories', {
        onSuccess: () => {
            form.reset();
            showCreateModal.value = false;
        }
    });
};


const updateCategory = () => {
    form.put(`/categories/${selectedCategory.value.id}`, {
        onSuccess: () => {
            showEditModal.value = false;
            form.reset();
        }
    });
};

const deleteCategory = () => {
    form.delete(`/categories/${selectedCategory.value.id}`, {
        onSuccess: () => {
            showDeleteModal.value = false;
        }
    });
};

const incomeCount = computed(() => {
    return props.categories.filter(item => item.type === 'income').length;
});

const expenseCount = computed(() => {
    return props.categories.filter(item => item.type === 'expense').length;
});

const openViewModal = (category) => {
    selectedCategory.value = category;
    showViewModal.value = true;
};

const openEditModal = (category) => {
    selectedCategory.value = category;

    form.name = category.name;
    form.type = category.type;

    showEditModal.value = true;
};


const openDeleteModal = (category) => {
    selectedCategory.value = category;
    showDeleteModal.value = true;
};

const openCreateModal = () => {
    showCreateModal.value = true;

    form.value = {
        name: '',
        type: 'income'
    };
};

const closeModal = () => {
    showViewModal.value = false;
    showCreateModal.value = false;
    showDeleteModal.value = false;
    showEditModal.value = false;
};
</script>

<template>
    <AppLayout>
        <div class="space-y-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1
                        class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                        Manage Categories
                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        Organize your income and expense categories professionally.
                    </p>
                </div>

                <!-- Add Button -->
                <button @click="openCreateModal"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 text-slate-950 font-bold rounded-xl text-sm transition-all duration-200 shadow-lg shadow-cyan-500/10">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>

                    Add New Category
                </button>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Total -->
                <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">
                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent">
                    </div>

                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Total Categories
                    </p>

                    <h3 class="text-3xl font-bold text-white mt-2">
                        {{ categories.length }}
                    </h3>

                    <p class="text-xs text-slate-500 mt-1">
                        Income & expense classification
                    </p>
                </div>

                <!-- Income -->
                <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">
                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-emerald-500/30 to-transparent">
                    </div>

                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Income Categories
                    </p>

                    <h3 class="text-3xl font-bold text-emerald-400 mt-2">
                        {{ incomeCount }}
                    </h3>

                    <p class="text-xs text-slate-500 mt-1">
                        Active income sources
                    </p>
                </div>

                <!-- Expense -->
                <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-2xl p-6">
                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-rose-500/30 to-transparent">
                    </div>

                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Expense Categories
                    </p>

                    <h3 class="text-3xl font-bold text-rose-400 mt-2">
                        {{ expenseCount }}
                    </h3>

                    <p class="text-xs text-slate-500 mt-1">
                        Expense tracking groups
                    </p>
                </div>
            </div>

            <!-- Category Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div v-for="category in categories" :key="category.id"
                    class="group relative bg-slate-900/40 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-6 transition-all duration-300 hover:border-slate-700/80 hover:bg-slate-900/60">

                    <!-- Hover Top Line -->
                    <div
                        class="absolute top-0 left-6 right-6 h-[1px] bg-gradient-to-r from-transparent via-cyan-500/0 group-hover:via-cyan-400/40 to-transparent transition-all duration-300">
                    </div>

                    <!-- Top -->
                    <div class="flex items-start justify-between gap-4">

                        <div class="space-y-1">
                            <h3 class="font-bold text-lg text-white group-hover:text-cyan-400 transition-colors">
                                {{ category.name }}
                            </h3>

                            <p class="text-xs text-slate-500">
                                Category ID: #{{ category.id }}
                            </p>
                        </div>

                        <!-- Icon -->
                        <div :class="[
                            'p-2.5 border rounded-xl transition-all duration-300',
                            category.type === 'income'
                                ? 'bg-emerald-950/20 border-emerald-800/40 text-emerald-400'
                                : 'bg-rose-950/20 border-rose-800/40 text-rose-400'
                        ]">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0-6v2m0 16v2m8-10h2M2 12H4m12.95 6.95l1.414 1.414M5.636 5.636l1.414 1.414m0 11.314l-1.414 1.414m11.314-11.314l1.414-1.414" />
                            </svg>
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="mt-6 pt-4 border-t border-slate-800/60 flex items-center justify-between">

                        <span class="text-xs font-medium text-slate-500">
                            Category Type
                        </span>

                        <span :class="[
                            'px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide',
                            category.type === 'income'
                                ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20'
                                : 'bg-rose-500/10 text-rose-400 border border-rose-500/20'
                        ]">

                            {{ category.type }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div
                        class="mt-5 flex items-center justify-end gap-2 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-200">

                        <!-- View -->
                        <button @click="openViewModal(category)"
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-cyan-400 transition-colors">

                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            View
                        </button>

                        <!-- Edit -->
                        <button @click="openEditModal(category)"
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 rounded-lg text-xs font-medium text-slate-400 hover:text-amber-400 transition-colors">

                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>

                            Edit
                        </button>

                        <!-- Delete -->
                        <button @click="openDeleteModal(category)"
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-950 hover:bg-rose-950/30 border border-slate-800 hover:border-rose-900/50 rounded-lg text-xs font-medium text-slate-400 hover:text-rose-400 transition-colors">

                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-1v-6m1-4h.01M4 7h16M10 4h4" />
                            </svg>

                            Delete
                        </button>
                    </div>
                </div>

                <!-- Empty -->
                <div v-if="categories.length === 0"
                    class="col-span-full bg-slate-900/20 border border-dashed border-slate-800 rounded-2xl p-12 text-center">

                    <p class="text-slate-400 text-sm">
                        No categories found. Create your first category above.
                    </p>
                </div>
            </div>
        </div>


        <!-- ========================= -->
        <!-- Create Modal -->
        <!-- ========================= -->

        <div v-if="showCreateModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">

            <div class="w-full max-w-lg bg-slate-900 border border-slate-800 rounded-2xl p-6">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">
                        Create Category
                    </h2>

                    <button @click="closeModal" class="text-slate-500 hover:text-white">
                        ✕
                    </button>
                </div>

                <form @submit.prevent="saveCategory" class="space-y-5">

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Category Name
                        </label>

                        <input type="text" v-model="form.name"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/40" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Category Type
                        </label>

                        <select v-model="form.type"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500/40">

                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">

                        <button type="button" @click="closeModal"
                            class="px-4 py-2 rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-5 py-2 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 text-slate-950 font-bold hover:from-cyan-400 hover:to-indigo-400 transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <!-- ========================= -->
        <!-- Edit Modal -->
        <!-- ========================= -->
        <div v-if="showEditModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">


            <div class="w-full max-w-lg bg-slate-900 border border-slate-800 rounded-2xl p-6">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">
                        Edit Category
                    </h2>

                    <button @click="closeModal" class="text-slate-500 hover:text-white">
                        ✕
                    </button>
                </div>

                <form @submit.prevent="updateCategory" class="space-y-5">

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Category Name
                        </label>

                        <input type="text" v-model="form.name"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/40" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Category Type
                        </label>

                        <select v-model="form.type"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500/40">

                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">

                        <button type="button" @click="closeModal"
                            class="px-4 py-2 rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-5 py-2 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 text-slate-950 font-bold hover:from-cyan-400 hover:to-indigo-400 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <!-- ========================= -->
        <!-- View Modal -->
        <!-- ========================= -->

        <div v-if="showViewModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
            <div class="max-w-xl md:w-1/3 mx-auto pt-6">

                <!-- Main Form Card Container -->
                <div
                    class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl shadow-[0_0_50px_rgba(0,0,0,0.3)] p-8 md:p-10 transition-all duration-300 hover:border-slate-700/80">

                    <!-- Glow Accent Line at Top -->
                    <div
                        class="absolute top-0 left-10 right-10 h-[2px] bg-gradient-to-r from-transparent via-amber-500 to-transparent opacity-70">
                    </div>

                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-500 p-[1px] mb-4 shadow-lg shadow-amber-500/20">
                            <div class="w-full h-full bg-slate-900 rounded-[15px] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                        <h1
                            class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                            Show Category
                        </h1>
                        <p class="text-slate-400 text-sm mt-2 font-medium">
                            Show details for Category #{{ selectedCategory.id }}
                        </p>
                    </div>

                    <!-- Form -->
                    <form class="space-y-6">

                        <!-- Category Name Input -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                Category Name
                            </label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0V9a2 2 0 012-2h2a2 2 0 012 2v12m-6 0h6" />
                                    </svg>
                                </div>
                                <input :value="selectedCategory.name" type="text" placeholder="e.g. City Bank Savings" required
                                    class="w-full pl-11 pr-4 py-3 bg-slate-950/40 border border-slate-800/80 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-amber-500/80 focus:ring-1 focus:ring-amber-500/30 transition-all duration-200 hover:border-slate-700">
                            </div>
                        </div>

                        <!-- Balance Input -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                Category Type
                            </label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input :value="selectedCategory.type" type="text" step="0.01" placeholder="0.00" min="0"
                                    required
                                    class="w-full pl-11 pr-4 py-3 bg-slate-950/40 border border-slate-800/80 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-amber-500/80 focus:ring-1 focus:ring-amber-500/30 transition-all duration-200 hover:border-slate-700">
                            </div>
                        </div>

                        <!-- Action Buttons Layout -->
                        <div class="grid grid-cols-1 gap-4 pt-2">
                            <!-- Cancel Button -->
                            <button type="button" @click="closeModal"
                                class="w-full py-3.5 bg-slate-950 hover:bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-400 hover:text-white font-semibold text-sm rounded-xl transition-all duration-200 text-center block flex items-center justify-center">
                                Close
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>

        <!-- ========================= -->
        <!-- Delete Modal -->
        <!-- ========================= -->

        <div v-if="showDeleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">

            <div class="w-full max-w-md bg-slate-900 border border-rose-900/40 rounded-2xl p-6">

                <div class="text-center">

                    <div
                        class="mx-auto w-14 h-14 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 mb-5">

                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-1v-6m1-4h.01M4 7h16M10 4h4" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-white">
                        Delete Category?
                    </h2>

                    <p class="text-sm text-slate-400 mt-2">
                        Are you sure you want to delete
                        <span class="text-white font-semibold">
                            {{ selectedCategory.name }}
                        </span>
                        ?
                    </p>

                    <div class="flex justify-center gap-3 mt-8">

                        <button @click="closeModal"
                            class="px-4 py-2 rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 transition">
                            Cancel
                        </button>

                        <button @click="deleteCategory"
                            class="px-5 py-2 rounded-xl bg-rose-500 hover:bg-rose-400 text-white font-bold transition">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
