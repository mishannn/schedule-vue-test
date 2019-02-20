<template>
    <b-card header="Изменить преподавателя">
        <form @submit.prevent="submit">
            <teacher-form :model="model"/>
            <button class="btn btn-primary" type="submit">Изменить</button>
        </form>
    </b-card>
</template>

<script>
    import TeacherForm from "./TeacherForm";
    import TeachersApi from "../../../api/teachers";

    export default {
        props: {
            id: String,
        },
        data() {
            return {
                model: {
                    name: ""
                }
            }
        },
        methods: {
            submit() {
                TeachersApi.edit(this.id, {
                    name: this.model.name,
                }, (err, data) => {
                    if (err !== null) {
                        alert(err.error);
                        return;
                    }

                    this.$router.push("/teachers");
                });
            }
        },
        components: {
            TeacherForm
        },
        created() {
            TeachersApi.get(this.id, (err, data) => {
                if (err !== null) {
                    alert(err.error);
                    return;
                }

                this.model = data;
            });
        }
    }
</script>