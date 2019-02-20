import axios from "axios";

export default {
    getAll(cb) {
        axios.get("/api/classes").then(function (response) {
            cb(null, response.data);
        }).catch(function (error) {
            if (error.response !== null) {
                cb(error.response.data, null);
            } else {
                cb(error, null);
            }
        });
    },
    get(id, cb) {
        axios.get("/api/classes/" + id)
            .then(function (response) {
                cb(null, response.data);
            })
            .catch(function (error) {
                if (error.response !== null) {
                    cb(error.response.data, null);
                } else {
                    cb(error, null);
                }
            });
    },
    add({model}, cb) {
        axios.post("/api/classes", model)
            .then(function (response) {
                cb(null, response.data);
            })
            .catch(function (error) {
                if (error.response !== null) {
                    cb(error.response.data, null);
                } else {
                    cb(error, null);
                }
            });
    },
    edit(id, {model}, cb) {
        axios.put("/api/classes/" + id, model).then(function (response) {
            cb(null, response.data);
        }).catch(function (error) {
            if (error.response !== null) {
                cb(error.response.data, null);
            } else {
                cb(error, null);
            }
        });
    },
    delete(id, cb) {
        axios.delete("/api/classes/" + id)
            .then(function (response) {
                cb(null, true);
            })
            .catch(function (error) {
                if (error.response !== null) {
                    cb(error.response.data, null);
                } else {
                    cb(error, null);
                }
            });
    }
};