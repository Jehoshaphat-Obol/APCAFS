import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../pages/LoginPage.vue'
import PanelLayout from '../layouts/PanelLayout.vue'
import Dashboard from '../pages/dashboard/index.vue'
import ErrorLayout from "../layouts/ErrorLayout.vue"
import SitePage from "../pages/SitePage.vue"

const routes = [
  {
    path: '/',
    name: 'SitePage',
    component: SitePage
  },
  {
    path: '/app',
    component: PanelLayout,
    props: { title: 'Dashboard', breadcrumb: ['Home'] },
    children: [
      {
        path: "",
        name: "home",
        component: Dashboard,
      }
    ]
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginPage
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'Error',
    component: ErrorLayout,
    props: {
      code: '404',
      message: 'Page Not Found'
    }
  }
  
]

export default createRouter({
  history: createWebHistory(),
  routes
})
