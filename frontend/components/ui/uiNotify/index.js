import uiNotify from './uiNotify';
import Vue from 'vue';

export default {
    show(params) {
        const notify = Vue.extend(uiNotify);

        return new notify(
            {
                el       : document.createElement('div'),
                propsData: params
            });
    }
}