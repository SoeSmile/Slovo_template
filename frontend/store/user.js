import queryBuilder from "./utils/queryBuilder";


export const state = () => (
    {
        users   : {},
        paginate: {},
        query   : {count: 20},
        errors  : {}
    }
);

export const mutations = {
    /**
     * set users
     *
     * @param state
     * @param data
     * @constructor
     */
    SET_USERS(state, data = {}) {
        state.users = data.data;
    },

    /**
     * set paginate
     *
     * @param state
     * @param data
     * @constructor
     */
    SET_PAGINATE(state, data = {}) {
        state.paginate = data.meta || {};
    },

    /**
     * set query
     *
     * @param state
     * @param data
     * @constructor
     */
    SET_QUERY(state, data) {
        state.query = queryBuilder(state.query, data);
    },

    /**
     * push new user
     *
     * @param state
     * @param data
     * @constructor
     */
    STORE_USER(state, data) {
        state.user.push(data);
    },

    /**
     * set errors
     *
     * @param state
     * @param errors
     * @constructor
     */
    SET_ERRORS(state, errors = {}) {
        state.errors = errors;
    }
};

export const getters = {
    users   : s => s.users,
    paginate: s => s.paginate,
    errors  : s => s.errors
};

export const actions = {
    /**
     * get users
     *
     * @param commit
     * @param state
     * @param dispatch
     * @param request
     * @return {Promise<void>}
     */
    async getUsers({commit, state, dispatch}, request = {}) {
        commit('SET_QUERY', request);

        try {
            const response = await this.$axios.get('../api/users', {params: state.query});
            commit('SET_USERS', response.data);
            commit('SET_PAGINATE', response.data);
        }
        catch (e) {
            dispatch('notify/showNotify', {message: e.response.data.message, view: 'red', time: 5000}, {root: true})
        }
    }
};