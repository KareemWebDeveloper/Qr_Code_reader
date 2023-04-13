import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'bootstrap/dist/css/bootstrap.min.css'
import './assets/main.css'
import 'font-awesome/css/font-awesome.css'
import 'font-awesome/css/all.min.css'

const app = createApp(App)

app.use(router)

app.mount('#app')
