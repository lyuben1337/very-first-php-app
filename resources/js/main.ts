import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import pinia from "./store";
import "@kouts/vue-modal/dist/vue-modal.css";
import Toast, { PluginOptions, POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";
import Paginate from "vuejs-paginate-next";

const app = createApp(App);
app.use(router);
app.use(pinia);

const toastOptions: PluginOptions = {
    position: POSITION.BOTTOM_RIGHT,
    timeout: 3000,
};
app.use(Toast, toastOptions);

app.use(Paginate);
app.mount("#app");
