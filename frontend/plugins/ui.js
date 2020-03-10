import Vue from 'vue';

import uiInput from "../components/ui/uiInput";
import uiTextAria from "../components/ui/uiTextAria/uiTextAria";
import uiAlert from "../components/ui/uiAlert";
import uiPagination from "../components/ui/uiPagination";
import uiModal from "../components/ui/uiModal";
import uiSelect from "../components/ui/uiSelect";
import uiCheckbox from "../components/ui/uiCheckbox";
import uiDialog from "../components/ui/uiDialog";
import uiNotify from "../components/ui/uiNotify";
import uiHelp from "../components/ui/uiHelp/uiHelp";

import uiDatePicker from 'vue2-datepicker';


const components = {
    uiInput,
    uiTextAria,
    uiAlert,
    uiPagination,
    uiModal,
    uiSelect,
    uiCheckbox,
    uiDialog,
    uiNotify,
    uiHelp,
    uiDatePicker
};

for (let name in components) {
    Vue.component(name, components[name]);
}

Vue.prototype.$notify = uiNotify;
Vue.prototype.$dialog = uiDialog;
