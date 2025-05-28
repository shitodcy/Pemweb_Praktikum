<script setup>
import { RouterLink, RouterView } from 'vue-router'
const items = [
  { to: '/',          name: 'Tentang' },
  { to: '/education', name: 'Pendidikan' },
  { to: '/experience',name: 'Pengalaman' },
  { to: '/portfolio', name: 'Portofolio' },
  { to: '/skills',    name: 'Keahlian' },
  { to: '/contact',   name: 'Kontak' }
]
</script>

<template>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
      <RouterLink class="navbar-brand" to="/">Nama Anda</RouterLink>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li v-for="i in items" :key="i.to" class="nav-item">
            <RouterLink class="nav-link" :to="i.to">{{ i.name }}</RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Transisi halaman -->
  <transition name="fade-page" mode="out-in">
    <RouterView />
  </transition>

  <!-- Footer -->
  <footer class="bg-primary text-center text-white py-3">
    © 2025 Nama Anda
  </footer>
</template>

<style>
.fade-page-enter-active,
.fade-page-leave-active {
  transition: all 0.4s ease;
}
.fade-page-enter-from {
  opacity: 0; transform: translateY(20px);
}
.fade-page-leave-to {
  opacity: 0; transform: translateY(-20px);
}
</style>


