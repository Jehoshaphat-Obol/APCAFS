<script>
import BlankFormLayout from "../layouts/BlankFormLayout.vue"
import LoginForm from "../components/forms/LoginForm.vue"

export default {
    name: "LoginPage",
    components: {
        BlankFormLayout,
        LoginForm
    }
}
</script>

<template>
    <BlankFormLayout>
        <LoginForm />
    </BlankFormLayout>
</template>