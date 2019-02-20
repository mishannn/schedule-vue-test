<template>
    <b-card header="Изменить преподавателя">
        <form @submit.prevent="submit">
            <class-form :model="model"/>
            <button class="btn btn-primary" type="submit">Изменить</button>
        </form>
    </b-card>
</template>

<script>
    import ClassForm from "./ClassForm";
    import ClassesApi from "../../../api/classes";

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
                ClassesApi.edit(this.id, {model: this.model}, (err, data) => {
                    if (err !== null) {
                        alert(err.error);
                        return;
                    }

                    this.$router.push("/classes");
                });
            }
        },
        components: {
            ClassForm
        },
        created() {
            ClassesApi.get(this.id, (err, data) => {
                if (err !== null) {
                    alert(err.error);
                    return;
                }

                this.model = data;
            });
        }
    }
</script>