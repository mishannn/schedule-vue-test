<template>
    <b-card header="Добавить преподавателя">
        <form @submit.prevent="submit">
            <teacher-form :model="model"/>
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
    </b-card>
</template>

<script>
    import TeacherForm from "./TeacherForm";
    import TeachersApi from "../../../api/teachers";

    export default {
        data() {
            return {
                model: {
                    name: ""
                }
            }
        },
        methods: {
            submit() {
                TeachersApi.add({
                    name: this.model.name
                }, (err, data) => {
                    if (err !== null) {
                        alert(err.error);
                        return;
                    }

                    this.$router.push("/teachers");
                });
            }
        },
        components: {TeacherForm}
    }
</script>