<template>
    <div class="min-h-screen bg-[#0b0f19] text-slate-100 flex font-sans overflow-hidden">
        
        <!-- Background Radial Ambient Flares -->
        <div class="absolute top-0 right-0 md:w-125 w-full h-125 bg-cyan-500/5 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 md:w-[500px] w-full h-[500px] bg-indigo-500/5 rounded-full blur-[150px] pointer-events-none"></div>

        <!-- Sidebar Injector -->
        <Sidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

        <!-- Application Stage View -->
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden relative z-10">
            <!-- Global Nav Component -->
            <Navbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

            <!-- Core App Section Viewport -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8 custom-scrollbar">
                <div class="max-w-7xl mx-auto">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Sidebar from '@/Components/Sidebar.vue';
import Navbar from '@/Components/Navbar.vue';

const sidebarOpen = ref(false);
</script>

<style>
/* Smooth Dark Aesthetics Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #0b0f19;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #1e293b;
    border-radius: 9999px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #334155;
}
</style>
