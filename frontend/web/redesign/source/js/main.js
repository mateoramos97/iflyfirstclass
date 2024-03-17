
require('./scripts/custom');

import { createApp } from "vue";
import VuexStore from "./store";
import { createStore } from 'vuex';

const store = createStore(VuexStore);

// store.Store.prototype.$set = function(param, data) {
// 	this.commit("setData", { param, data });
// };
// store.Store.prototype.$unset = function(param) {
// 	this.commit("unsetData", param);
// };

createApp({
	setup() {

	}
}).use(store).mount("#app");
