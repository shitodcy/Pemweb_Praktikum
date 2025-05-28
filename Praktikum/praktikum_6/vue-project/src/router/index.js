import { createRouter, createWebHistory } from 'vue-router'

import Home       from '@/views/Home.vue'
import Education  from '@/views/Education.vue'
import Experience from '@/views/Experience.vue'
import Portfolio  from '@/views/Portfolio.vue'
import Skills     from '@/views/Skills.vue'
import Contact    from '@/views/Contact.vue'

const routes = [
  { path: '/',          name: 'Tentang',    component: Home },
  { path: '/education', name: 'Pendidikan', component: Education },
  { path: '/experience',name: 'Pengalaman', component: Experience },
  { path: '/portfolio', name: 'Portofolio', component: Portfolio },
  { path: '/skills',    name: 'Keahlian',   component: Skills },
  { path: '/contact',   name: 'Kontak',     component: Contact }
]

export default createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior: () => ({ top: 0 })
})
