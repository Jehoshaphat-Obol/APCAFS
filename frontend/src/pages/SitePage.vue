
<script>
import Button from "../components/buttons/Button.vue"
 export default {
    name: "SitePage",
    components: {
        Button
    }
 }
</script>
<template>
    <h1 class="text-primary fs-1 fw-bold text-center">Welcome to APCAFS</h1>
    <p class="text-center">
        <router-link to="/login">
            <Button>Login</Button>
        </router-link>
        <router-link to="/app">
            <Button>Dashboard</Button>
        </router-link>
    </p>
</template>