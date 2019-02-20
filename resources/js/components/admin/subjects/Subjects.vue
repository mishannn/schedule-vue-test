<template>
    <b-card header="Предметы">
        <p>
            <router-link class="btn btn-success" to="/subject/add">Добавить</router-link>
        </p>
        <table class="table table-sm table-striped table-bordered">
            <thead>
            <tr>
                <th>Название предмета</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="subjects.length > 0">
                <tr v-for="subject in subjects" :key="subject.id">
                    <td>{{ subject.name }}</td>
                    <td>
                        <router-link class="btn btn-sm btn-primary" :to="'/subject/edit/' + subject.id">Изменить</router-link>
                        <button class="btn btn-sm btn-danger" @click="deleteSubject(subject.id, $event)">Удалить</button>
                    </td>
                </tr>
            </template>
            <template v-else>
                <tr>
                    <td colspan="2">
                        Нет предметов.
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
            subjects: state => state.subjects.all
        }),
        methods: {
            deleteSubject(id, event) {
                event.target.disabled = true;
                this.$store.dispatch("subjects/delete", {
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
            this.$store.dispatch("subjects/loadAll");
        }
    }
</script>