import Vue from "vue";
import Vuex from "vuex";
import VueRouter from "vue-router";
import BootstrapVue from "bootstrap-vue";
import AdminPanel from "./components/admin/AdminPanel.vue";
import store from "./store";

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(BootstrapVue);

const routes = [
    {path: "/", redirect: "/settings"},

    {path: "/teacher/add", component: require("./components/admin/teachers/TeacherAdd").default},
    {path: "/teacher/edit/:id", component: require("./components/admin/teachers/TeacherEdit").default, props: true},
    {path: "/teachers", component: require("./components/admin/teachers/Teachers").default},

    {path: "/subject/add", component: require("./components/admin/subjects/SubjectAdd").default},
    {path: "/subject/edit/:id", component: require("./components/admin/subjects/SubjectEdit").default, props: true},
    {path: "/subjects", component: require("./components/admin/subjects/Subjects").default},

    {path: "/room/add", component: require("./components/admin/rooms/RoomAdd").default},
    {path: "/room/edit/:id", component: require("./components/admin/rooms/RoomEdit").default, props: true},
    {path: "/rooms", component: require("./components/admin/rooms/Rooms").default},

    {path: "/class/add", component: require("./components/admin/classes/ClassAdd").default},
    {path: "/class/edit/:id", component: require("./components/admin/classes/ClassEdit").default, props: true},
    {path: "/classes", component: require("./components/admin/classes/Classes").default},

    {path: "*", component: require("./components/admin/NotFound").default},
];

const router = new VueRouter({
    routes
});

Vue.component("table-overflow", require("./components/admin/TableOverflow").default);

const vm = new Vue({
    el: "#admin-panel",
    render: h => h(AdminPanel),
    router,
    store
});
