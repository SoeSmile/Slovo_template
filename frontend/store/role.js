import queryBuilder from "./utils/queryBuilder";


export const state = () => (
    {
        roles   : [],
        paginate: {},
        query   : {count: 20},
        errors  : {}
    }
);

export const mutations = {
    /**
     * set roles
     *
     * @param state
     * @param data
     * @constructor
     */
    SET_ROLES(state, data = {}) {
        state.roles = data.data;
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
    }
};

export const getters = {
    roles   : s => s.roles,
    paginate: s => s.paginate,
};

export const actions = {
    /**
     * get roles
     *
     * @param commit
     * @param state
     * @param dispatch
     * @param request
     * @return {Promise<void>}
     */
    async getRoles({commit, state, dispatch}, request = {}) {

        commit('SET_QUERY', request);

        try {
            const response = await this.$axios.get('../api/roles', {params: state.query});
            commit('SET_ROLES', response.data);
            commit('SET_PAGINATE', response.data);
        }
        catch (e) {
            dispatch('notify/showNotify', {message: e.response.data.message, view: 'red', time: 5000}, {root: true})
        }
    }
};