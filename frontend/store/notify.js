/**
 * @param errors
 * @param raw
 * @return {string}
 */
function errorSerializer(errors, raw = false) {
    if (typeof errors === 'string') return errors;

    let data = raw ? '' : '<ul>';

    for (let i in errors) {
        data += raw ? errors[i] + '\n' : '<li>' + errors[i] + '</li>';
    }

    data += raw ? '' : '</ul>';

    return data;
}


export const state = () => (
    {
        show: false,
        data: {
            view   : 'teal',
            message: '',
            time   : 3000
        },

    }
);

export const mutations = {
    /**
     * @param state
     * @param data
     * @constructor
     */
    SET_DATA(state, data) {
        state.show = true;
        for (let i in data) {
            state.data[i] = (
                i === 'message' ? errorSerializer(data[i]) : data[i]
            );
        }
    },
    /**
     *
     * @param state
     * @constructor
     */
    CLEAR_DATA(state) {
        state.show = false;
        state.data = {
            view   : 'teal',
            message: '',
            time   : 3000
        };
    }
};

export const getters = {
    show: s => s.show,
    data: s => s.data
};

export const actions = {
    /**
     * @param commit
     * @param dispatch
     * @param state
     * @param data
     */
    showNotify({commit, dispatch, state}, data) {
        commit('SET_DATA', data);

        setTimeout(function () {
            dispatch('closeNotify');
        }, state.data.time);
    },
    /**
     * @param commit
     */
    closeNotify({commit}) {
        commit('CLEAR_DATA');
    }
};