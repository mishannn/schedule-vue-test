<template>
    <div id="admin-panel">
        <main class="container">
            <admin-menu/>
            <admin-content/>
        </main>
    </div>
</template>

<script>
    import AdminMenu from "./AdminMenu";
    import AdminContent from "./AdminContent";

    export default {
        components: {AdminMenu, AdminContent},
    }
</script>