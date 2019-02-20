<template>
    <div class="form-group">
        <label for="subject-name-input">Имя преподавателя</label>
        <input v-model="model.name" id="subject-name-input" type="text" class="form-control" placeholder="Введите имя преподавателя">
    </div>
</template>

<script>
    export default {
        props: ["model"]
    }
</script>