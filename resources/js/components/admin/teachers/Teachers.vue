<template>
    <b-card header="Предметы">
        <p>
            <router-link class="btn btn-success" to="/teacher/add">Добавить</router-link>
        </p>
        <table class="table table-sm table-striped table-bordered">
            <thead>
            <tr>
                <th>Имя преподавателя</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="teachers.length > 0">
                <tr v-for="teacher in teachers" :key="teacher.id">
                    <td>{{ teacher.name }}</td>
                    <td>
                        <router-link class="btn btn-sm btn-primary" :to="'/teacher/edit/' + teacher.id">Изменить</router-link>
                        <button class="btn btn-sm btn-danger" @click="deleteTeacher(teacher.id, $event)">Удалить</button>
                    </td>
                </tr>
            </template>
            <template v-else>
                <tr>
                    <td colspan="2">
                        Нет преподавателей.
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
            teachers: state => state.teachers.all
        }),
        methods: {
            deleteTeacher(id, event) {
                event.target.disabled = true;
                this.$store.dispatch("teachers/delete", {
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
            this.$store.dispatch("teachers/loadAll");
        }
    }
</script>