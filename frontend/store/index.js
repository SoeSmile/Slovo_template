export const state = () => (
    {
        trans: {}
    }
);

export const mutations = {
    /**
     * set lang
     * @param state
     * @param trans
     * @constructor
     */
    SET_LANG(state, trans) {
        state.trans = trans;
    }
};

export const getters = {
    trans: s => s.trans
};

export const actions = {
    /**
     * init data
     * @param commit
     * @param app
     * @param store
     * @param redirect
     * @return {Promise<void>}
     */
    async nuxtServerInit({commit}, {app, store, redirect}) {

        // translate
        const response = await this.$axios.get('http://nginx/api/lang');
        commit('SET_LANG', response.data.data);

        // user && token
        const token = app.$cookies.get('token');

        if (token) {
            commit('auth/SET_TOKEN', {token: token});

            try {
                const user = await this.$axios.post('http://nginx/api/me');
                commit('auth/SET_USER', {user: user.data.data});
            }
            catch (e) {
                commit('auth/SET_TOKEN');
                redirect('/login')
            }
        }
    },
};