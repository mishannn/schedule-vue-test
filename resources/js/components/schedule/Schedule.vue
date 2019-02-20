<template>
    <div id="schedule">
        <b-container>
            <template v-for="weekNum in 20">
                <template v-for="dayNum in 7">
                    <b-table striped :items="dayItems(weekNum, dayNum)" :fields="fields"/>
                </template>
            </template>
        </b-container>
    </div>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        data() {
            return {
                fields: {
                    subject_name: "Предмет",
                    teacher_name: "Преподаватель",
                    room_name: "Аудитория"
                }
            };
        },
        computed: mapState({
            classes: state => state.classes.all
        }),
        methods: {
            dayItems(weekNum, dayNum) {
                let items = [];

                for (let classNum = 1; classNum <= 6; classNum++) {
                    let item = null;

                    item = this.findItem(0, weekNum, dayNum, classNum);
                    if (item !== null) {
                        items.push({
                            subject_name: this.getSubjectName(item.subject_id),
                            teacher_name: this.getTeacherName(item.teacher_id),
                            room_name: this.getRoomName(item.room_id)
                        });
                        continue;
                    }

                    item = this.findItem(1, weekNum % 2, dayNum, classNum);
                    if (item !== null) {
                        items.push({
                            subject_name: this.getSubjectName(item.subject_id),
                            teacher_name: this.getTeacherName(item.teacher_id),
                            room_name: this.getRoomName(item.room_id)
                        });
                        continue;
                    }

                    items.push({
                        subject_name: "-",
                        teacher_name: "-",
                        room_name: "-"
                    });
                }

                return items;
            },
            findItem(repeated, weekNum, dayNum, classNum) {
                for (let i = 0; i < this.classes.length; i++) {
                    const classItem = this.classes[i];

                    if (classItem.repeated === repeated
                        && classItem.week_num === weekNum
                        && classItem.day_num === dayNum
                        && classItem.class_num === classNum) {
                        return classItem;
                    }
                }

                return null;
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
</style>