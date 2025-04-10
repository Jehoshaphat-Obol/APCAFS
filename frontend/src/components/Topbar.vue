<template>
    <header class="topbar">
      <div class="logo">
        <h1>APCAFS</h1>
      </div>
      <div class="user-info">
        <span>Welcome, User</span>
        <button @click="logout">Logout</button>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'Topbar',
    methods: {
      logout() {
        console.log("Logging out...");
      }
    }
  }
  </script>
  
  <style scoped>
  .topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #333;
    color: white;
  }
  
  .logo h1 {
    margin: 0;
  }
  
  .user-info {
    display: flex;
    align-items: center;
  }
  
  .user-info span {
    margin-right: 15px;
  }
  
  .user-info button {
    padding: 5px 10px;
    background-color: #f39c12;
    color: white;
    border: none;
    cursor: pointer;
  }
  </style>
  