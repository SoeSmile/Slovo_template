export const state = () => (
    {
        errors    : {},
        isRegister: false
    }
);

export const mutations = {
    /**
     * set errors
     *
     * @param state
     * @param errors
     * @constructor
     */
    SET_ERRORS(state, errors = {}) {
        state.errors = errors;
    },
    /**
     * set isRegister
     *
     * @param state
     * @param data
     * @constructor
     */
    SET_IS_REGISTER(state, data = false) {
        state.isRegister = data;
    }
};

export const getters = {
    errors    : s => s.errors,
    isRegister: s => s.isRegister
};

export const actions = {
    /**
     * register user
     *
     * @param commit
     * @param user
     * @return {Promise<void>}
     */
    async register({commit}, user) {
        commit('SET_ERRORS');

        try {
            const response = await this.$axios.post('api/register', user);

            commit('SET_IS_REGISTER', !!response);
        }
        catch (e) {
            commit('SET_ERRORS', e.response.data.errors);
        }
    }
};