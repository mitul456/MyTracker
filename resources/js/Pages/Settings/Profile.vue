<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    user: Object,
    profile: Object
});



const form = useForm({
    name: props.user?.name || '',
    email: props.user?.email || '',
    phone: props.user?.phone || '',
    address: props.profile?.address || '',
    currency: props.profile?.currency || 'BDT',
    avatar: null,
});

const preview = ref(null);

const handleAvatar = (e) => {
    const file = e.target.files[0];

    if (!file) return;

    form.avatar = file;
    preview.value = URL.createObjectURL(file);
};

const submit = () => {
    form
        .transform(data => ({
            ...data,
            _method: 'PUT',
        }))
        .post('/profiles/update', {
            forceFormData: true,
            preserveScroll: true,
        });
};



const avatarInput = ref(null);

const openFilePicker = () => {
    avatarInput.value.click();
};

</script>

<template>
    <AppLayout>

        <form @submit.prevent="submit">
            <div class="max-w-6xl mx-auto">

                <!-- Header -->

                <div class="mb-8">

                    <h1 class="text-3xl font-bold text-white">
                        Profile Settings
                    </h1>

                    <p class="text-slate-400 mt-2">
                        Update your profile information and personal preferences.
                    </p>

                </div>

                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Left Card -->

                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8">

                        <div class="flex flex-col items-center">

                            <!-- Avatar -->

                            <div
                                class="w-32 h-32 rounded-full bg-slate-800 border-4 border-slate-700 flex items-center justify-center overflow-hidden">

                                <input type="file" ref="avatarInput" @change="handleAvatar" accept="image/*"
                                    class="hidden" />

                                <img v-if="preview" :src="preview" class="w-full h-full object-cover" />

                                <img v-else-if="profile?.avatar" :src="`/storage/${profile.avatar}`"
                                    class="w-full h-full object-cover" />

                                <span v-else class="text-5xl text-slate-500">
                                    👤
                                </span>

                            </div>

                            <button type="button" @click="openFilePicker"
                                class="mt-6 px-5 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-semibold transition">

                                Upload Photo

                            </button>

                            <p class="text-slate-500 text-sm mt-3 text-center">
                                JPG, PNG (Max: 2MB)
                            </p>

                        </div>

                        <div class="border-t border-slate-800 mt-8 pt-8">

                            <div class="space-y-5">

                                <div>

                                    <p class="text-xs uppercase text-slate-500">
                                        Account Status
                                    </p>

                                    <span
                                        class="inline-flex mt-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm">

                                        Active

                                    </span>

                                </div>

                                <div>

                                    <p class="text-xs uppercase text-slate-500">
                                        Member Since
                                    </p>

                                    <p class="text-white mt-2">
                                        January 2025
                                    </p>

                                </div>



                            </div>

                        </div>

                    </div>

                    <!-- Right Form -->

                    <div class="lg:col-span-2">

                        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8">

                            <h2 class="text-xl font-bold text-white mb-8">
                                Personal Information
                            </h2>

                            <div class="grid md:grid-cols-2 gap-6">

                                <!-- Name -->

                                <div>

                                    <label class="block text-sm text-slate-400 mb-2">

                                        Full Name

                                    </label>

                                    <input type="text" v-model="form.name"
                                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.name }}
                                    </p>

                                </div>

                                <!-- Email -->

                                <div>

                                    <label class="block text-sm text-slate-400 mb-2">

                                        Email

                                    </label>

                                    <input type="email" v-model="form.email"
                                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.email }}
                                    </p>

                                </div>

                                <!-- Phone -->

                                <div>

                                    <label class="block text-sm text-slate-400 mb-2">

                                        Phone Number

                                    </label>

                                    <input type="text" v-model="form.phone"
                                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white">
                                    <p v-if="form.errors.phone" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.phone }}
                                    </p>

                                </div>

                                

                                <!-- Currency -->

                                <div>

                                    <label class="block text-sm text-slate-400 mb-2">

                                        Currency

                                    </label>

                                    <select v-model="form.currency"
                                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white">
                                        <option value="BDT">BDT (৳)</option>
                                        <option value="USD">USD ($)</option>
                                        <option value="EUR">EUR (€)</option>
                                        <option value="INR">INR (₹)</option>
                                    </select>

                                </div>

                                <div class="col-span-2">

                                    <label class="block text-sm text-slate-400 mb-2">

                                        Address

                                    </label>

                                    <textarea type="text" v-model="form.address"
                                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white"
                                        rows="3" />
                                    <p v-if="form.errors.address" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.address }}
                                    </p>

                                </div>

                            </div>

                            <div class="border-t border-slate-800 mt-10 pt-6 flex justify-end gap-4">

                                <button type="button"
                                    class="px-6 py-3 rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 transition">
                                    Cancel
                                </button>

                                <button type="submit" :disabled="form.processing"
                                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 text-slate-950 font-bold hover:opacity-90 transition disabled:opacity-50">
                                    {{ form.processing ? 'Saving...' : 'Save Changes' }}
                                </button>

                            </div>

                        </div>

                    </div>

                </div>
                
            </div>
        </form>

    </AppLayout>
</template>

