<script>
  import message from "../../services/MessageService.js"

  export default {
    name: "Message",
    data(){
      return {
        message
      }
    }
  }
</script>
<template>
  <div v-for="message in message.getMessages()" :key="message.id">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ message.message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
</template>