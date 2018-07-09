import VueRouter from 'vue-router';
import Home from './components/Home.vue';
import Profile from './components/Profile.vue';
import BrowseGigs from './components/BrowseGigs.vue';
import PostGig from './components/PostGig.vue';
import GigDetails from './components/GigDetails.vue';


let routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/gigs',
        component: BrowseGigs
    },
    {
        path: '/gigs/new',
        component: PostGig
    },
    {
        path: '/gig/',
        component: GigDetails
    }
];


export default new VueRouter({
    routes
});