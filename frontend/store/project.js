export const state = () => (
    {
        projects: {},
        paginate: {}
    }
);

export const mutations = {
    /**
     * set projects
     * @param state
     * @param data
     * @constructor
     */
    SET_PROJECTS(state, data = {}) {
        state.projects = data.data;
    },
    /**
     * set paginate
     * @param state
     * @param data
     * @constructor
     */
    SET_PAGINATE(state, data = {}) {
        state.paginate = data.meta;
    }
};

export const getters = {
    projects: s => s.projects,
    paginate: s => s.paginate
};

export const actions = {
    /**
     * get projects
     * @param commit
     * @param request
     * @return {Promise<void>}
     */
    async getProjects({commit}, request = {}) {
        try {
            const response = await this.$axios.get('../api/projects', {params: request});
            commit('SET_PROJECTS', response.data);
            commit('SET_PAGINATE', response.data);
        }
        catch (e) {
            // todo make error handler
            console.log(e.response.data);
        }
    }
};