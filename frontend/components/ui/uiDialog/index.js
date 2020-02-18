import uiDialog from './uiDialog';
import Vue from 'vue';

export default {
    show(params) {
        const dialog = Vue.extend(uiDialog);

        return new dialog(
            {
                el       : document.createElement('div'),
                propsData: params
            });
    }
}