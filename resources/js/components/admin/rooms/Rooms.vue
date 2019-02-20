<template>
    <b-card header="Аудитории">
        <p>
            <router-link class="btn btn-success" to="/room/add">Добавить</router-link>
        </p>
        <table class="table table-sm table-striped table-bordered">
            <thead>
            <tr>
                <th>Название аудитории</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="rooms.length > 0">
                <tr v-for="room in rooms" :key="room.id">
                    <td>{{ room.name }}</td>
                    <td>
                        <router-link class="btn btn-sm btn-primary" :to="'/room/edit/' + room.id">Изменить</router-link>
                        <button class="btn btn-sm btn-danger" @click="deleteRoom(room.id, $event)">Удалить</button>
                    </td>
                </tr>
            </template>
            <template v-else>
                <tr>
                    <td colspan="2">
                        Нет аудиторий.
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </b-card>
</template>

<script>
    import {mapActions, mapState} from "vuex";

    export default {
        computed: mapState({
            rooms: state => state.rooms.all
        }),
        methods: {
            deleteRoom(id, event) {
                event.target.disabled = true;
                this.$store.dispatch("rooms/delete", {
                    id,
                    cb(err) {
                        if (err !== null) {
                            alert(err.error);
                        }

                        event.target.disabled = false;
                    }
                });
            }
        },
        created() {
            this.$store.dispatch("rooms/loadAll");
        }
    }
</script>