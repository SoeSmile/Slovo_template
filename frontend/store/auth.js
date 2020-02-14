export const state = () => (
    {
        token    : null,
        expiresIn: null,
        user     : {},
        errors   : {}
    }
);

export const mutations = {
    /**
     * set token
     * @param state
     * @param data
     */
    SET_TOKEN(state, data = {}) {
        state.token     = data.token;
        state.expiresIn = data.expiresIn;
        // set head
        this.$axios.setHeader('Authorization', 'Bearer ' + data.token);
        // set cookie
        this.$cookies.set('token', data.token, {maxAge: data.expiresIn});
    },
    /**
     * set user
     * @param state
     * @param data
     * @constructor
     */
    SET_USER(state, data = {}) {
        state.user = data.user;
    },
    /**
     * set errors
     * @param state
     * @param errors
     * @constructor
     */
    SET_ERRORS(state, errors = {}) {
        state.errors = errors;
    }
};

export const getters = {
    user    : s => s.user,
    errors  : s => s.errors,
    hasToken: s => !!s.token
};

export const actions = {
    /**
     * login
     * @param commit
     * @param user
     */
    async login({commit}, user) {
        commit('SET_ERRORS');

        try {
            const response = await this.$axios.post('api/login', user);
            commit('SET_USER', response.data);
            commit('SET_TOKEN', response.data);
            return this.$router.push('client')
        }
        catch (e) {
            commit('SET_ERRORS', e.response.data.errors);
        }
    },
    /**
     * set errors
     * @param commit
     * @param errors
     */
    setErrors({commit}, errors = {}) {
        commit('SET_ERRORS', errors)
    },
    /**
     * logout
     * @param commit
     * @param redirect
     */
    async logout({commit}) {
        try {
            await this.$axios.post('api/logout');
            commit('SET_USER');
            commit('SET_TOKEN');
            this.$cookies.remove('token');
            return this.$router.push('/')
        }
        catch (e) {
        }
    }
};
