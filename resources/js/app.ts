import { createApp } from "vue";
import App from "./App.vue";
import { router } from './router';
import axios from "axios";

import '../css/grid_layout.css';
import '../css/main.css';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const app = createApp(App);
app.use(router);
app.mount("#app");