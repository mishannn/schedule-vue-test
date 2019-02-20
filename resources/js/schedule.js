import Vue from "vue";
import Vuex from "vuex";
import BootstrapVue from "bootstrap-vue";
import store from "./store";
import Schedule from "./components/schedule/Schedule";

Vue.use(Vuex);
Vue.use(BootstrapVue);

const vm = new Vue({
    el: "#schedule",
    render: h => h(Schedule),
    store
});
