import queryBuilder from "./utils/queryBuilder";


export const state = () => (
    {
        projects: {},
        paginate: {},
        query   : {count: 20},
        errors  : {}
    }
);

export const mutations = {
    /**
     * set projects
     *
     * @param state
     * @param data
     * @constructor
     */
    SET_PROJECTS(state, data = {}) {
        state.projects = data.data;
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
    projects: s => s.projects,
    paginate: s => s.paginate,
    errors  : s => s.errors
};

export const actions = {
    /**
     * get projects
     *
     * @param commit
     * @param state
     * @param dispatch
     * @param request
     * @return {Promise<void>}
     */
    async getProjects({commit, state, dispatch}, request = {}) {

        commit('SET_QUERY', request);

        try {
            const response = await this.$axios.get('../api/projects', {params: state.query});
            commit('SET_PROJECTS', response.data);
            commit('SET_PAGINATE', response.data);
        }
        catch (e) {
            dispatch('notify/showNotify', {message: e.response.data.message, view: 'red', time: 5000}, {root: true})
        }
    },

    /**
     * store new project
     *
     * @param dispatch
     * @param rootState
     * @param data
     * @return {Promise<void>}
     */
    async storeProject({dispatch, rootState}, data) {
        try {
            const response = await this.$axios.post('../api/projects', data);
            dispatch('getProjects');

            dispatch('notify/showNotify', {message: rootState.trans.all.success}, {root: true})
        }

        catch (e) {
            dispatch('notify/showNotify', {message: e.response.data.errors, view: 'red', time: 5000}, {root: true})
        }
    },

    /**
     * update project
     *
     * @param dispatch
     * @param rootState
     * @param data
     * @return {Promise<void>}
     */
    async updateProject({dispatch, rootState}, data) {
        try {
            await this.$axios.put('../api/projects/' + data.id, data);
            dispatch('getProjects');

            dispatch('notify/showNotify', {message: rootState.trans.all.success}, {root: true})
        }
        catch (e) {
            dispatch('notify/showNotify', {message: e.response.data.errors, view: 'red', time: 5000}, {root: true})
        }
    },

    /**
     * set errors
     *
     * @param commit
     * @param errors
     */
    setErrors({commit}, errors) {
        commit('SET_ERRORS', errors);
    }
};