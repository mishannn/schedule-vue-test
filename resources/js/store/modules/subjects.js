import SubjectsApi from "../../api/subjects";

const state = {
    all: []
};

const getters = {
    getById(state) {
        return id => {
            const o = state.all.find(o => o.id === id);
            if (o === undefined) {
                return null;
            }

            return o;
        };
    }
};

const actions = {
    loadAll({commit}) {
        SubjectsApi.getAll(function (err, data) {
            if (err !== null) {
                alert(err.error);
                return;
            }

            commit('setAll', data);
        });
    },
    delete({commit}, {id, cb}) {
        SubjectsApi.delete(id, function (err, data) {
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