import { createRouter, createWebHistory } from "vue-router";
import Entrar from "../views/Entrar.vue";
import Painel from "../views/Painel.vue";
import Pesquisas from "../views/Pesquisas.vue";
import Registrar from "../views/Registrar.vue";
import DefaultLayout from "../components/DefaultLayout.vue"
import AuthLayout from "../components/AuthLayout.vue"
import store from "../store";

const routes = [
    {
        path: '/',
        redirect: '/painel',        
        component: DefaultLayout,
        meta: { requiresAuth: true },
        children: [
            {
                path : '/painel',
                name: 'Painel',
                component: Painel
            },
            {
                path : '/pesquisas',
                name: 'Pesquisas',
                component: Pesquisas
            }
        ]
    },
    {
        path: '/auth',
        redirect: '/Entrar',        
        component: AuthLayout,
        meta: {isGuest: true},
        children: [
            {
                path: '/entrar',
                name: 'Entrar',
                component: Entrar
            },
            {
                path: '/registrar',
                name: 'Registrar',
                component: Registrar
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
        next({name: 'Entrar'})
    }
    //usuário logado e tentar ir para login ou registro
    else if(store.state.user.token && (to.meta.isGuest)){
        next({name: 'Painel'});
    }
    else{
        next();
    } 

})

export default router;