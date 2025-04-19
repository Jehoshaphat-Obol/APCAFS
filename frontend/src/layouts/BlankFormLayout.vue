<script>
import Message from "../components/messages/Message.vue" 
  export default {
    name: "BlankFormLayout",
    components: {
      Message
    }
  }
</script>

<template>
    <main>
    <div class="container">

      <div class="message-container">
        <Message />
      </div>
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <slot />
        </div>
      </section>
    </div>
  </main>
</template>

<style>
  .message-container{
    position: fixed;
    max-width: 20rem;
    top: 1rem;
    right: 1rem;
  }
</style>
