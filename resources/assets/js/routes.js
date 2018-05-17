import VueRouter from 'vue-router';
import Home from './components/Home.vue';
import Profile from './components/Profile.vue';


let routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/profile',
        component: Profile
    }
];


export default new VueRouter({
    routes
});