<template>
    <ul class="nav flex-column">
      <li class="nav-item" v-for="item in menuItems" :key="item.name">
        <a href="#" class="nav-link text-dark d-flex align-items-center gap-2">
          <i :class="item.icon"></i>
          <span v-if="!collapsed">{{ item.name }}</span>
        </a>
      </li>
    </ul>
  </template>
  
  <script setup>
  defineProps(['collapsed'])
  
  const menuItems = [
    { name: 'Dashboard', icon: 'bi bi-speedometer2' },
    { name: 'Users', icon: 'bi bi-people' },
    { name: 'Reports', icon: 'bi bi-bar-chart' },
    { name: 'Settings', icon: 'bi bi-gear' },
  ]
  </script>
  