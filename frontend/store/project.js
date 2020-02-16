export const state = () => (
    {
        projects: {}
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
        state.projects = data;
    },
};

export const getters = {
    projects: s => s.projects
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
            console.log(request);
            const response = await this.$axios.get('../api/projects', {params: request});
            commit('SET_PROJECTS', response.data.data);
        }
        catch (e) {
            // todo make error handler
            console.log(e.response.data);
        }
    }
};