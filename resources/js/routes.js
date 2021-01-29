import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/layouts/Home';
import Register from '@/layouts/Register';
import Login from '@/layouts/Login';
import Dashboard from '@/layouts/Dashboard';
import Options from '@/components/dashboard/Options';
import AddProduct from '@/components/dashboard/AddProduct';
import Products from '@/components/dashboard/Products';
import Product from '@/components/dashboard/Product';
import Reservations from '@/components/dashboard/Reservations';
import ReservationConfirmation from '@/components/dashboard/ReservationConfirmation';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/dashboard',
            component: Dashboard,
            beforeEnter: (to, from, next) =>{
                Vue.axios.get('api/authenticated', {withCredentials: true}).then(()=>{
                    next()
                }).catch((error)=>{
                    console.log(error);
                    return next({name: 'home'})
                })
            },
            children: [
                {
                    name: 'options',
                    path: '',
                    component: Options
                },
                {
                    name: 'addproduct',
                    path: 'addproduct',
                    component: AddProduct,
                    beforeEnter: (to, from, next) =>{
                        Vue.axios.get('/api/user', {withCredentials: true}).then((res)=>{
                            if(res.data.account_type==='staff') next();
                            else next({name: 'options'})
                        }).catch((error)=>{
                            console.log(error);
                            return next({name: 'home'})
                        });
                    }
                },
                {
                    name: 'products',
                    path: 'products',
                    component: Products
                },
                {
                    name: 'product',
                    path: 'product/:id',
                    component: Product
                },
                {
                    name: 'reservations',
                    path: 'reservations',
                    component: Reservations
                },
                {   
                    name: 'reservationConfirmation',
                    path: 'reservationConfirmation',
                    component: ReservationConfirmation
                }
            ]
        }
    ]
});

export default router;