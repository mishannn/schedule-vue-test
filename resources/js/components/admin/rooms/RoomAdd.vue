<template>
    <b-card header="Добавить аудиторию">
        <form @submit.prevent="submit">
            <room-form :model="model"/>
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
    </b-card>
</template>

<script>
    import RoomForm from "./RoomForm";
    import RoomsApi from "../../../api/rooms";

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
                RoomsApi.add({
                    name: this.model.name
                }, (err, data) => {
                    if (err !== null) {
                        alert(err.error);
                        return;
                    }

                    this.$router.push("/rooms");
                });
            }
        },
        components: {RoomForm}
    }
</script>