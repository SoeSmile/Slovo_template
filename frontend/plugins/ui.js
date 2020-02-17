import Vue from 'vue';

import uiInput from "../components/ui/uiInput";
import uiAlert from "../components/ui/uiAlert";
import uiPagination from "../components/ui/uiPagination";
import uiModal from "../components/ui/uiModal";
import uiSelect from "../components/ui/uiSelect";
import uiCheckbox from "../components/ui/uiCheckbox";


const components = {
    uiInput,
    uiAlert,
    uiPagination,
    uiModal,
    uiSelect,
    uiCheckbox
};

for (let name in components) {
    Vue.component(name, components[name]);
}
