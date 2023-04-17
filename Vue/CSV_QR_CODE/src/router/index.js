import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/reader',
      name: 'QrReader',
      component: () => import('../views/QrReaderView.vue'),
      meta: {requiresAuth: true}
    },
    {
      path: '/viewData',
      name: 'viewData',
      component: () => import('../views/ViewData.vue'),
      meta: {requiresAuth: true}
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/registerView.vue')
    },
  ]
})
router.beforeEach((to,from,next)=>{
  if(to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated()){
    // if the route requires authentication and the user is not authenticated , redirect to the login page
    next('/login')
  }
  else{
    //otherwise allow the user to access the requested route
    next()
  }
})
function isAuthenticated(){
  return localStorage.getItem('userToken')!== null
}

export default router
