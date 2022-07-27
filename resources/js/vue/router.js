import { createRouter,createWebHistory } from 'vue-router';

import List from './components/device/List';
import Create from './components/device/Create';
import ListRoute from './components/route/List';
import CreateRoute from './components/route/Create';
import ListTravel from './components/travel/List';
import CreateTravel from './components/travel/Create';

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
    },
    {
        name: 'listRoute',
        path: '/vue',
        component: ListRoute
    },
    {
        name: 'createRoute',
        path: '/vue',
        component: CreateRoute
    },
    {
        name: 'listTravel',
        path: '/vue',
        component: ListTravel
    },
    {
        name: 'createTravel',
        path: '/vue',
        component: CreateTravel
    },
];

const router =  createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;