
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import Vue from 'vue'; // Importing Vue Library
import VueRouter from 'vue-router'; // importing Vue router library
import router from './routes';
import fontawesome from '@fortawesome/fontawesome';
import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
import fas from '@fortawesome/fontawesome-free-solid';
import fab from '@fortawesome/fontawesome-free-brands';

Vue.component('font-awesome-icon', FontAwesomeIcon);
fontawesome.library.add(fas, fab);

window.Vue = Vue;
Vue.use(VueRouter);

var user = {
    data(){
    	return {
    		user: {
	    		first_name: '',
	    		last_name: '',
	    		picture: '',
	    		id: '',
	    		notifications: []
	    	}
	    }
    },
    computed: {
    	userFullName(){
    		return this.user.first_name + ' ' + this.user.last_name
    	}
    },
    mounted(){
        this.getAndSetUserData()
    },
    methods: {
    	getAndSetUserData(){
    		var self = this;
			return new Promise(async function(resolve, reject){
	        	axios.get('/api/v1/user').then(response => {
	        		self.user.first_name = response.data.data.attributes.first_name;
	        		self.user.last_name = response.data.data.attributes.last_name;
	        		self.user.picture = response.data.data.attributes.picture;
	        		self.user.id = response.data.data.id;
	                resolve(response.data.data);
	            });
            });
    	}
    }
}

const app = new Vue({
    el: '#app',
    mixins: [user],
    mounted(){
        $(document).on('click', '.dropdown .dropdown-menu', function (e) {
            e.stopPropagation();
        });
    },
    router
});