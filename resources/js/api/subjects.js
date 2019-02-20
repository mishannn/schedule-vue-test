import axios from "axios";

export default {
    getAll(cb) {
        axios.get("/api/subjects").then(function (response) {
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
        axios.get("/api/subjects/" + id)
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
    add({name}, cb) {
        axios.post("/api/subjects", {
            name
        }).then(function (response) {
            cb(null, response.data);
        }).catch(function (error) {
            if (error.response !== null) {
                cb(error.response.data, null);
            } else {
                cb(error, null);
            }
        });
    },
    edit(id, {name}, cb) {
        axios.put("/api/subjects/" + id, {
            name
        }).then(function (response) {
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
        axios.delete("/api/subjects/" + id)
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