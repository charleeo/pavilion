import {createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue";
import Profile from "../components/Profile.vue"
import OnboardClient from "../components/OnboardClient.vue"

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/profile/:id",
        name: "profile",
        component: Profile,
    },
    {
        path: "/onboard",
        name: "OnboardClient",
        component: OnboardClient,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;