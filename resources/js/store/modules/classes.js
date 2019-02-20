import ClassesApi from "../../api/classes";

const state = {
    all: []
};

const getters = {};

const actions = {
    loadAll({commit}, {cb}) {
        ClassesApi.getAll(function (err, data) {
            if (err !== null) {
                cb(err.error)
                return;
            }

            commit('setAll', data);
            cb(null);
        });
    },
    delete({commit}, {id, cb}) {
        ClassesApi.delete(id, function (err, data) {
            if (err !== null) {
                cb(err);
                return;
            }

            commit("delete", id);
            cb(null);
        });
    }
};

const mutations = {
    setAll(state, data) {
        state.all = data;
    },
    delete(state, id) {
        state.all.splice(state.all.findIndex(o => o.id === id), 1);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};