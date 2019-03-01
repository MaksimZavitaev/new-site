import Vue from 'vue'
import Notifications from 'vue-notification'

import Mask from './directives/mask'
import Focus from './directives/focus'

import VariableList from './components/variables/VariableList.vue'
import BreadcrumbsList from './components/breadcrumbs/BreadcrumbsList.vue'

Vue.config.productionTip = false;

window.Event = new Vue();

Vue.use(Notifications);

Vue.directive('mask', Mask);
Vue.directive('focus', Focus);

const app = new Vue({
    el: '#app',
    components: {
        VariableList,
        BreadcrumbsList
    }
});
