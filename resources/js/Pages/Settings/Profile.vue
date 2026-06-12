<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const user = {
    name: 'Nizamuddin Quader',
    email: 'nizam@example.com',
    phone: '+8801712345678',
    address: 'Rajshahi, Bangladesh',
    currency: 'BDT',
    avatar: null,
};
</script>

<template>
    <AppLayout>

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

                <div
                    class="bg-slate-900 border border-slate-800 rounded-2xl p-8">

                    <div class="flex flex-col items-center">

                        <!-- Avatar -->

                        <div
                            class="w-32 h-32 rounded-full bg-slate-800 border-4 border-slate-700 flex items-center justify-center overflow-hidden">

                            <img
                                v-if="user.avatar"
                                :src="user.avatar"
                                class="w-full h-full object-cover">

                            <span
                                v-else
                                class="text-5xl text-slate-500">

                                👤

                            </span>

                        </div>

                        <button
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

                    <div
                        class="bg-slate-900 border border-slate-800 rounded-2xl p-8">

                        <h2 class="text-xl font-bold text-white mb-8">
                            Personal Information
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">

                            <!-- Name -->

                            <div>

                                <label
                                    class="block text-sm text-slate-400 mb-2">

                                    Full Name

                                </label>

                                <input
                                    type="text"
                                    :value="user.name"
                                    class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">

                            </div>

                            <!-- Email -->

                            <div>

                                <label
                                    class="block text-sm text-slate-400 mb-2">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    :value="user.email"
                                    class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">

                            </div>

                            <!-- Phone -->

                            <div>

                                <label
                                    class="block text-sm text-slate-400 mb-2">

                                    Phone Number

                                </label>

                                <input
                                    type="text"
                                    :value="user.phone"
                                    class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white">

                            </div>

                            <!-- Timezone -->

                            <!-- <div>

                                <label
                                    class="block text-sm text-slate-400 mb-2">

                                    Timezone

                                </label>

                                <select
                                    class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white">

                                    <option selected>
                                        Asia/Dhaka
                                    </option>

                                    <option>
                                        Asia/Kolkata
                                    </option>

                                    <option>
                                        UTC
                                    </option>

                                    <option>
                                        Europe/London
                                    </option>

                                </select>

                            </div> -->

                            <!-- Currency -->

                            <div>

                                <label
                                    class="block text-sm text-slate-400 mb-2">

                                    Currency

                                </label>

                                <select
                                    class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white">

                                    <option selected>
                                        BDT (৳)
                                    </option>

                                    <option>
                                        USD ($)
                                    </option>

                                    <option>
                                        EUR (€)
                                    </option>

                                    <option>
                                        INR (₹)
                                    </option>

                                </select>

                            </div>

                            <div class="col-span-2">

                                <label
                                    class="block text-sm text-slate-400 mb-2">

                                    Address

                                </label>

                                <textarea
                                    type="text"
                                    :value="user.address"
                                    class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white"
                                    rows="3"/>

                            </div>

                        </div>

                        <div
                            class="border-t border-slate-800 mt-10 pt-6 flex justify-end gap-4">

                            <button
                                class="px-6 py-3 rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 transition">

                                Cancel

                            </button>

                            <button
                                class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-500 text-slate-950 font-bold hover:opacity-90 transition">

                                Save Changes

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </AppLayout>
</template>