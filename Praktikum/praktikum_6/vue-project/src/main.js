import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-icons/font/bootstrap-icons.css'
import 'animate.css'
import 'aos/dist/aos.css'
import './assets/global.css'

import AOS from 'aos'

createApp(App).use(router).mount('#app')

AOS.init({ duration: 800, once: true })