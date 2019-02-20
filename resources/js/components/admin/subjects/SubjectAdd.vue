<template>
    <b-card header="Добавить предмет">
        <form @submit.prevent="submit">
            <subject-form :model="model"/>
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
    </b-card>
</template>

<script>
    import SubjectForm from "./SubjectForm";
    import SubjectsApi from "../../../api/subjects";

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
                SubjectsApi.add({
                    name: this.model.name
                }, (err, data) => {
                    if (err !== null) {
                        alert(err.error);
                        return;
                    }

                    this.$router.push("/subjects");
                });
            }
        },
        components: {SubjectForm}
    }
</script>