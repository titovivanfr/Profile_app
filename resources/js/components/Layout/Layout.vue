<template>
    <nav id="nav" class="w-full z-30 top-10 py-1 bg-white shadow-lg border-b border-blue-400 mb-10">
        <div class="order-2 md:order-3 flex flex-wrap items-center mr-0 md:mr-4" id="nav-content">
            <div class="auth flex items-center w-full md:w-full justify-end">
                <router-link to="/login" class="bg-transparent text-gray-800 p-2 rounded border border-gray-300 mr-4
                hover:bg-gray-100 hover:text-gray-700">
                    Sign in
                </router-link>
                <router-link to="/" class="bg-transparent text-gray-800 p-2 rounded border border-gray-300 mr-4
                hover:bg-gray-100 hover:text-gray-700">
                    Home
                </router-link>
            </div>
        </div>
    </nav>
</template>
