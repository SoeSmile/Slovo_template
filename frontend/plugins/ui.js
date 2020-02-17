import Vue from 'vue';

import uiInput from "../components/ui/uiInput";
import uiAlert from "../components/ui/uiAlert";
import uiPagination from "../components/ui/uiPagination";
import uiModal from "../components/ui/uiModal";


const components = {
    uiInput,
    uiAlert,
    uiPagination,
    uiModal
};

for (let name in components) {
    Vue.component(name, components[name]);
}
