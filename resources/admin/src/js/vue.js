import Vue from 'vue'
import Notifications from 'vue-notification'

import Mask from './directives/mask'
import Focus from './directives/focus'
import Timepicker from './directives/timepicker'
import Datepicker from './directives/datepicker'

import VariableList from './components/variables/VariableList.vue'
import BreadcrumbsList from './components/breadcrumbs/BreadcrumbsList.vue'
import Schedule from './components/schedule/Schedule.vue'
import Offices from './components/offices/Offices.vue'

Vue.config.productionTip = false;

window.Event = new Vue();

Vue.use(Notifications);

Vue.directive('mask', Mask);
Vue.directive('focus', Focus);
Vue.directive('timepicker', Timepicker);
Vue.directive('datepicker', Datepicker);

const app = new Vue({
    el: '#app',
    components: {
        VariableList,
        BreadcrumbsList,
        Schedule,
        Offices,
    }
});

window.app = app;
