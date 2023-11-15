import { createRouter, createWebHistory } from 'vue-router';

import tree from '@/pages/tree';

const routes = [
	{
		path: '/',
		name: 'tree',
		component: tree,
	},
	{
		path: '/tree',
		name: 'tree',
		component: tree,
	},
];

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes,
});

export default router;
