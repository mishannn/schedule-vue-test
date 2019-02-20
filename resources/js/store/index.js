import Vue from "vue";
import Vuex from "vuex";
import teachers from "./modules/teachers";
import subjects from "./modules/subjects";
import rooms from "./modules/rooms";
import classes from "./modules/classes";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        teachers,
        subjects,
        rooms,
        classes
    }
});