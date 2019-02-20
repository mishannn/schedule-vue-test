<template>
    <div class="form-group">
        <label for="subject-name-input">Название аудитории</label>
        <input v-model="model.name" id="subject-name-input" type="text" class="form-control" placeholder="Введите название аудитории">
    </div>
</template>

<script>
    export default {
        props: ["model"]
    }
</script>