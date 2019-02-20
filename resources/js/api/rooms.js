import axios from "axios";

export default {
    getAll(cb) {
        axios.get("/api/rooms").then(function (response) {
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
        axios.get("/api/rooms/" + id)
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
        axios.post("/api/rooms", {
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
        axios.put("/api/rooms/" + id, {
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
        axios.delete("/api/rooms/" + id)
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