const state = {
    user: null
};
const actions = {
    setUser({commit}, user){
        commit('setUser', user);
    },
    logoutUser({commit}){
        commit('logoutUser');
    }
};
const mutations = {
    setUser: (state, user) => (state.user=user),
    logoutUser: (state) => (state.user=null)
};
const getters = {
    user: (state) => state.user,
};

export default {
    state,
    actions,
    mutations,
    getters
}