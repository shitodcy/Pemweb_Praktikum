<script setup>
import { onMounted } from 'vue'
import lottie from 'lottie-web'

onMounted(() => {
  lottie.loadAnimation({
    container: document.getElementById('lottie'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: 'https://assets7.lottiefiles.com/packages/lf20_jcikwtux.json'
  })
})
</script>

<template>
  <header class="bg-light text-center py-5" data-aos="zoom-in">
    <div class="container">
      <div class="row align-items-center g-4">
        <!-- kolom teks -->
        <div class="col-md-6">
          <h1 class="display-5 fw-bold" data-aos="fade-down">
            Selamat Datang!
          </h1>
          <p class="lead text-secondary" data-aos="fade-up">
            Saya <b>Lazybear</b>, profesional di bidang <em>karbit waifu baru</em>.
          </p>
        </div>
        <!-- kolom animasi -->
        <div class="col-md-5 text-center">
          <div id="lottie" style="max-width:300px;margin:auto"></div>
        </div>
      </div>
    </div>
  </header>
</template>
