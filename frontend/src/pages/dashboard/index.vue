<script>
import HRDashboard from "./HRDashboard.vue"
import SuperAdminDashboard from "./SuperAdminDashboard.vue"
import CompanyAdminDashboard from "./CompanyAdminDashboard.vue"
import getUserRole from "../../services/AuthorizationService.js"
import sessionManager from "../../services/AuthenticationService.js"

export default {
    name: "Dashboard",
    data() {
        return {
            role: getUserRole(),
            authenticated: sessionManager.isAuthenticated(this.$router),
            authInterval: null
        }
    },
    mounted() {
        this.authInterval = setInterval(() => {
            const isStillAuth = sessionManager.isAuthenticated(this.$router)
            this.authenticated = isStillAuth
        }, 300)
    },
    beforeUnmount() {
        if (this.authInterval) {
            clearInterval(this.authInterval)
        }
    },
    components: {
        HRDashboard,
        SuperAdminDashboard,
        CompanyAdminDashboard
    }
}
</script>


<template>
    <div v-if="authenticated">
        <HRDashboard v-if="role=='HR'"/>
        <SuperAdminDashboard v-if="role=='SuperAdmin'" />
        <CompanyAdminDashboard v-if="role=='CompanyAdmin'"/>
    </div>
</template>