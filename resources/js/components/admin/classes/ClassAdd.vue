<template>
    <b-card header="Добавить занятие">
        <form @submit.prevent="submit">
            <class-form :model="model"/>
            <b-alert v-if="submitSuccessful" variant="success" show>Предмет добавлен успешно</b-alert>
            <b-form-group>
                <b-checkbox v-model="stayOnThisPage">Остаться на странице</b-checkbox>
            </b-form-group>
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
    </b-card>
</template>

<script>
    import ClassForm from "./ClassForm";
    import ClassesApi from "../../../api/classes";

    export default {
        data() {
            return {
                submitSuccessful: false,
                stayOnThisPage: true,
                model: {
                    subject_id: null,
                    room_id: null,
                    teacher_id: null,
                    type: 1,
                    repeated: true,
                    week_num: 1,
                    day_num: 1,
                    class_num: 1,
                }
            }
        },
        methods: {
            submit() {
                ClassesApi.add({model: this.model}, (err, data) => {
                    if (err !== null) {
                        this.submitSuccessful = false;
                        alert(err.error);
                        return;
                    }

                    this.submitSuccessful = true;

                    if (stayOnThisPage) {
                        this.$router.push("/classes");
                    }
                });
            }
        },
        components: {ClassForm}
    }
</script>