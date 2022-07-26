import { createRouter,createWebHistory } from 'vue-router';

import List from './components/List';
import Create from './components/Create';

const routes = [
    {
        name: 'list',
        path: '/vue',
        component: List
    },
    {
        name: 'create',
        path: '/vue/create/:slug?',
        component: Create
    }
];

const router =  createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;