<template>
    <b-card header="Изменить аудиторию">
        <form @submit.prevent="submit">
            <room-form :model="model"/>
            <button class="btn btn-primary" type="submit">Изменить</button>
        </form>
    </b-card>
</template>

<script>
    import RoomForm from "./RoomForm";
    import RoomsApi from "../../../api/rooms";

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
                RoomsApi.edit(this.id, {
                    name: this.model.name,
                }, (err, data) => {
                    if (err !== null) {
                        alert(err.error);
                        return;
                    }

                    this.$router.push("/rooms");
                });
            }
        },
        components: {
            RoomForm
        },
        created() {
            RoomsApi.get(this.id, (err, data) => {
                if (err !== null) {
                    alert(err.error);
                    return;
                }

                this.model = data;
            });
        }
    }
</script>