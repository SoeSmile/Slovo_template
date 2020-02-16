import Vue from 'vue';

import uiInput from "../components/ui/uiInput";
import uiAlert from "../components/ui/uiAlert";
import uiPagination from "../components/ui/uiPagination";


const components = {
    uiInput,
    uiAlert,
    uiPagination
};

for (let name in components) {
    Vue.component(name, components[name]);
}
