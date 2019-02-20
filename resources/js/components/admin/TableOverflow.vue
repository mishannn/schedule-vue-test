<template>
    <div class="table-overflow">
        <slot></slot>
    </div>
</template>

<script>
    export default {
    }
</script>

<style scoped>
    .table-overflow {
        overflow: auto;
    }
</style>