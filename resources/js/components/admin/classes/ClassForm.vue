<template>
    <div class="form-group">
        <!--<label for="subject-name-input">Имя преподавателя</label>-->
        <!--<input v-model="model.name" id="subject-name-input" type="text" class="form-control" placeholder="Введите имя преподавателя">-->

        <b-form-group label="Предмет:" label-for="subject_id">
            <b-form-select id="subject_id" v-model="model.subject_id" :options="subjects | dataToOptions" required/>
        </b-form-group>

        <b-form-group label="Преподаватель:" label-for="teacher_id">
            <b-form-select id="teacher_id" v-model="model.teacher_id" :options="teachers | dataToOptions" required/>
        </b-form-group>

        <b-form-group label="Аудитория:" label-for="room_id">
            <b-form-select id="room_id" v-model="model.room_id" :options="rooms | dataToOptions" required/>
        </b-form-group>

        <b-form-group label="Тип:" label-for="type">
            <b-form-select id="type" v-model="model.type" :options="{1:'Лекция',2:'Практика',3:'Лабораторная'}" required/>
        </b-form-group>

        <b-form-group>
            <b-checkbox v-model="isRepeated">Повторяется</b-checkbox>
        </b-form-group>

        <b-form-group label="Неделя:" label-for="week_num">
            <b-form-select id="week_num" v-model="model.week_num" :options="weeks" required/>
        </b-form-group>

        <b-form-group label="День недели:" label-for="day_num">
            <b-form-select id="day_num" v-model="model.day_num" :options="dayNames" required/>
        </b-form-group>

        <b-form-group label="Пара:" label-for="class_num">
            <b-form-select id="class_num" v-model="model.class_num" :options="[1, 2, 3, 4, 5, 6]" required/>
        </b-form-group>
    </div>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        props: {
            model: Object,
        },
        data() {
            return {
                oldWeekNum: null,
                dayNames: {
                    1: "Понедельник",
                    2: "Вторник",
                    3: "Среда",
                    4: "Четверг",
                    5: "Пятница",
                    6: "Суббота",
                    7: "Воскресенье"
                }
            }
        },
        watch: {
            isRepeated(newVal, oldVal) {
                if (newVal) {
                    this.oldWeekNum = this.model.week_num;
                    this.model.week_num = 1;
                } else {
                    if (this.oldWeekNum !== null) {
                        this.model.week_num = this.oldWeekNum;
                    }
                }
            }
        },
        computed: {
            isRepeated: {
                get() {
                    return this.model.repeated !== 0;
                },
                set(newVal) {
                    this.model.repeated = newVal ? 1 : 0;
                }
            },
            weeks() {
                if (this.isRepeated) {
                    return {
                        0: "Чётная",
                        1: "Нечетная"
                    };
                } else {
                    let options = [];
                    for (let i = 1; i <= 20; i++) {
                        options.push(i);
                    }
                    return options;
                }
            },
            ...mapState({
                subjects: state => state.subjects.all,
                teachers: state => state.teachers.all,
                rooms: state => state.rooms.all
            })
        },
        filters: {
            dataToOptions(value) {
                let options = [
                    {
                        value: null,
                        text: "Выберите пункт из списка",
                        disabled: true
                    }
                ];

                value.forEach((item) => {
                    options.push({
                        value: item.id,
                        text: item.name,
                    });
                });

                return options;
            }
        },
        methods: {
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
            },
        },
        created() {
            this.$store.dispatch("teachers/loadAll");
            this.$store.dispatch("subjects/loadAll");
            this.$store.dispatch("rooms/loadAll");
        }
    }
</script>