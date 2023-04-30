require('./bootstrap')

import { createApp } from 'vue'
import App from "./components/App.vue";
import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
    { path: '/',component: () => import('./components/Home.vue') },
    { path: '/login', name: 'Login',  component: () => import('./components/Admin/auth/Login.vue') },
    { path: '/dashboard', name: 'Dashboard',  component: () => import('./components/Admin/Dashboard.vue') },
    { path: '/dashboard/edit/:id', name: 'Edit',  component: () => import('./components/Admin/Edit.vue') },
    { path: '/dashboard/add/', name: 'Add',  component: () => import('./components/Admin/Add.vue') },
];

const router = createRouter({
    history: createWebHashHistory(),
    hash: false,
    routes,
})

const app = createApp({})
    .use(router)
    .component('app', App)
    .mount('#app')
