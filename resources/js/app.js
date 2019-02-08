
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        pets: pets,
        newPetsToggle: false,
        deadPets: false
    },
    methods: {
        care (id) {
            this.update(id, 'care');
        },
        feed (id) {
            this.update(id, 'hunger');
        },
        sleep (id) {
            this.update(id, 'sleeping');
        },
        update (id, property) {
            axios.post('/api/' + property + '/' + id)
                .then(function (response) {
                    if (response.statusText == 'OK') {
                        let i;
                        app.pets.map(function (pet, index) {
                            if (pet.id == id) {
                                i = index;
                            }
                        });
                        let petProperty = 'pet_' + property;
                        app.pets[i][petProperty].value = 100;
                    }
                })
        },
        makeClass (value) {
            if (value > 50) {
                return 'green';
            }
            if (value > 25) {
                return 'yellow';
            }
            return 'red';
        },
        deadFrame (value) {
            if (value <= 0) {
               this.deadPets = true;
               return 'dead-frame';
            }
        },
        restart () {
            axios.post('/api/restart')
                .then(function (response) {
                    if (response.statusText == 'OK') {
                        location.reload();
                    }
            });
        }
    }
});

Echo.channel("pet")
    .listen('.property', (e) => {
        app.pets.map(function (pet, index) {
            if (typeof e.pets[pet.id] !== 'undefined') {
                app.pets[index].pet_care.value = e.pets[pet.id].pet_care;
                app.pets[index].pet_hunger.value = e.pets[pet.id].pet_hunger;
                app.pets[index].pet_sleeping.value = e.pets[pet.id].pet_sleeping;
            }
        });
    });