<template>
    <b-card header="Изменить предмет">
        <form @submit.prevent="submit">
            <subject-form :model="model"/>
            <button class="btn btn-primary" type="submit">Изменить</button>
        </form>
    </b-card>
</template>

<script>
    import SubjectForm from "./SubjectForm";
    import SubjectsApi from "../../../api/subjects";

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
                SubjectsApi.edit(this.id, {
                    name: this.model.name,
                }, (err, data) => {
                    if (err !== null) {
                        alert(err.error);
                        return;
                    }

                    this.$router.push("/subjects");
                });
            }
        },
        components: {
            SubjectForm
        },
        created() {
            SubjectsApi.get(this.id, (err, data) => {
                if (err !== null) {
                    alert(err.error);
                    return;
                }

                this.model = data;
            });
        }
    }
</script>