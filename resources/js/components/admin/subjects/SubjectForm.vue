<template>
    <div class="form-group">
        <label for="subject-name-input">Название предмета</label>
        <input v-model="model.name" id="subject-name-input" type="text" class="form-control" placeholder="Введите название предмета">
    </div>
</template>

<script>
    export default {
        props: ["model"]
    }
</script>