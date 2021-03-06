import { createRouter, createWebHistory } from "vue-router";
import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";
import Surveys from "../views/Surveys.vue";
import SurveyView from "../views/SurveyView.vue";
import Register from "../views/Register.vue";
import DefaultLayout from "../components/DefaultLayout.vue"
import AuthLayout from "../components/AuthLayout.vue"
import store from "../store";

const routes = [
    {
        path: '/',
        redirect: '/dashboard',        
        component: DefaultLayout,
        meta: { requiresAuth: true },
        children: [
            {
                path : '/dashboard',
                name: 'Dashboard',
                component: Dashboard
            },
            {
                path : '/surveys',
                name: 'Surveys',
                component: Surveys
            },
            {
                path : '/surveys/create',
                name: 'SurveyCreate',
                component: SurveyView
            },
            {
                path : '/surveys/:id',
                name: 'SurveyView',
                component: SurveyView
            }
        ]
    },
    {
        path: '/auth',
        redirect: '/Login',        
        component: AuthLayout,
        meta: {isGuest: true},
        children: [
            {
                path: '/login',
                name: 'Login',
                component: Login
            },
            {
                path: '/register',
                name: 'Register',
                component: Register
            },
        ]
    },
    
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    //store token no login
    if(to.meta.requiresAuth && !store.state.user.token){
        next({name: 'Login'})
    }
    //usuário logado e tentar ir para login ou registro
    else if(store.state.user.token && (to.meta.isGuest)){
        next({name: 'Dashboard'});
    }
    else{
        next();
    } 

})

export default router;