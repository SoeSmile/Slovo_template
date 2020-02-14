import Vue from 'vue';

import uiInput from "../components/ui/uiInput";
import uiAlert from "../components/ui/uiAlert";


const components = {
    uiInput,
    uiAlert
};

for (let name in components) {
    Vue.component(name, components[name]);
}
