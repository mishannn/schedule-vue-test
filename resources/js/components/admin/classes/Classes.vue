<template>
    <b-card header="Занятия">
        <p>
            <router-link class="btn btn-success" to="/class/add">Добавить</router-link>
        </p>
        <table-overflow>
            <table id="table-classes" class="table table-sm table-striped table-bordered">
                <thead>
                <tr>
                    <th class="cell-subject-name">Предмет</th>
                    <th>Преподаватель</th>
                    <th>Ауд.</th>
                    <th>Тип</th>
                    <th>Недели</th>
                    <th>День</th>
                    <th>Пара</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <template v-if="classes.length > 0">
                    <tr v-for="classItem in classes" :key="classItem.id">
                        <td class="cell-subject-name">{{ getSubjectName(classItem.subject_id) }}</td>
                        <td>{{ getTeacherName(classItem.teacher_id) }}</td>
                        <td>{{ getRoomName(classItem.room_id) }}</td>
                        <td>{{ classItem.type | typeName }}</td>
                        <td>{{ classItem | weekName }}</td>
                        <td>{{ classItem.day_num | dayName }}</td>
                        <td>{{ classItem.class_num }}</td>
                        <td>
                            <router-link class="btn btn-sm btn-primary" :to="'/class/edit/' + classItem.id">Изменить</router-link>
                            <button class="btn btn-sm btn-danger" @click="deleteClass(classItem.id, $event)">Удалить</button>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td colspan="8">
                            Нет занятий.
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </table-overflow>
    </b-card>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        computed: mapState({
            classes: state => state.classes.all
        }),
        methods: {
            deleteClass(id, event) {
                event.target.disabled = true;
                this.$store.dispatch("classes/delete", {
                    id,
                    cb(err) {
                        if (err !== null) {
                            alert(err.error);
                        }

                        event.target.disabled = false;
                    }
                });
            },
            getTeacherName(id) {
                const teacher = this.$store.getters["teachers/getById"](id);
                if (teacher === null) {
                    return "Загрузка...";
                }

                return teacher.name;
            },
            getRoomName(id) {
                const room = this.$store.getters["rooms/getById"](id);
                if (room === null) {
                    return "Загрузка...";
                }

                return room.name;
            },
            getSubjectName(id) {
                const subject = this.$store.getters["subjects/getById"](id);
                if (subject === null) {
                    return "Загрузка...";
                }

                return subject.name;
            }
        },
        filters: {
            typeName(type) {
                const typeNames = {
                    1: "лек",
                    2: "пр",
                    3: "лаб"
                };

                return typeNames[type];
            },
            weekName(classItem) {
                if (classItem.repeated) {
                    return (classItem.week_num === 0) ? "чёт" : "нечёт";
                } else {
                    return classItem.week_num;
                }
            },
            dayName(dayName) {
                const dayNames = {
                    1: "пн",
                    2: "вт",
                    3: "ср",
                    4: "чт",
                    5: "пт",
                    6: "сб",
                    7: "вс",
                };

                return dayNames[dayName];
            }
        },
        created() {
            this.$store.dispatch("teachers/loadAll");
            this.$store.dispatch("subjects/loadAll");
            this.$store.dispatch("rooms/loadAll");

            this.$store.dispatch("classes/loadAll", {
                cb(err) {
                    if (err !== null) {
                        alert(err.error);
                    }
                }
            });
        }
    }
</script>

<style scoped>
    .cell-subject-name {
        max-width: 320px;
        white-space: normal;
    }
</style>