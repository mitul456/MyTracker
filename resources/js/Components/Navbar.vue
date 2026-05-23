<template>
    <nav class="h-16 border-b border-slate-800/80 bg-slate-900/40 backdrop-blur-xl px-6 flex items-center justify-between sticky top-0 z-40">
        <!-- Sidebar Toggle for Mobile -->
        <button @click="$emit('toggle-sidebar')" class="lg:hidden p-2 text-slate-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Search Bar or Brand Placeholder -->
        <div class="hidden sm:block max-w-xs w-full">
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" placeholder="Global search..." class="w-full pl-9 pr-4 py-1.5 bg-slate-950/40 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none focus:border-cyan-500/50 transition-all">
            </div>
        </div>

        <!-- User Profile Dropdown Profile -->
        <div class="flex items-center gap-4">
            <button class="p-2 text-slate-400 hover:text-cyan-400 transition-colors relative">
                <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-cyan-400 rounded-full"></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </button>
            <div class="flex items-center gap-3 pl-2 border-l border-slate-800">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-cyan-500 to-indigo-500 p-[1px]">
                    <div class="w-full h-full bg-slate-900 rounded-[11px] flex items-center justify-center text-xs font-bold text-cyan-400">MT</div>
                </div>
                <span class="text-xs font-medium text-slate-300 hidden md:block">Account Owner</span>
            </div>
        </div>
    </nav>
</template>

<script setup>
defineEmits(['toggle-sidebar']);
</script>
