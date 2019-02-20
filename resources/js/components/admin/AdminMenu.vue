<template>
    <div class="button-items">
        <div class="button-item" v-for="(item, index) in items">
            <b-button :key="index" :to="item.link">{{ item.text }}</b-button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                items: [{
                    text: "Настройки",
                    link: "/settings",
                }, {
                    text: "Предметы",
                    link: "/subjects",
                }, {
                    text: "Аудитории",
                    link: "/rooms",
                }, {
                    text: "Преподаватели",
                    link: "/teachers",
                }, {
                    text: "Занятия",
                    link: "/classes",
                }]
            };
        }
    }
</script>

<style scoped>
    .button-item {
        display: inline-block;
        margin-right: .25rem;
        margin-bottom: .5rem;
    }

    .button-item:last-child {
        margin-right: unset;
    }
</style>