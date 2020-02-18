export const state = () => (
    {
        projects: {},
        paginate: {},
        query   : {count: 20},
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
        // если обект дополнить изменить запрос
        if (data instanceof Object) {
            for (let i in data) {
                state.query[i] = data[i];
            }
        }
        // сброс запроса
        if (data === 'reset') {
            state.query = {count: 20}
        }
    },
    /**
     * push new project
     *
     * @param state
     * @param data
     * @constructor
     */
    STORE_PROJECT(state, data) {
        state.projects.push(data);
    }
};

export const getters = {
    projects: s => s.projects,
    paginate: s => s.paginate
};

export const actions = {
    /**
     * get projects
     *
     * @param commit
     * @param state
     * @param request
     * @return {Promise<void>}
     */
    async getProjects({commit, state}, request = {}) {

        commit('SET_QUERY', request);

        try {
            const response = await this.$axios.get('../api/projects', {params: state.query});
            commit('SET_PROJECTS', response.data);
            commit('SET_PAGINATE', response.data);
        }
        catch (e) {
        }
    },
    /**
     * store new project
     *
     * @param commit
     * @param dispatch
     * @param rootState
     * @param data
     * @return {Promise<void>}
     */
    async storeProject({commit, dispatch, rootState}, data) {
        try {
            const response = await this.$axios.post('../api/projects', data);
            commit('STORE_PROJECT', response.data);

            dispatch('notify/showNotify', {message: rootState.trans.all.success}, {root: true})
        }

        catch (e) {
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
        }
    },
    /**
     * delete projects
     *
     * @param dispatch
     * @param rootState
     * @param data
     * @return {Promise<void>}
     */
    async deleteProject({dispatch, rootState}, data) {
        try {
            await this.$axios.post('../api/projects/delete', {ids: data});
            dispatch('getProjects');

            dispatch('notify/showNotify', {message: rootState.trans.all.success}, {root: true})
        }
        catch (e) {
        }
    },
};