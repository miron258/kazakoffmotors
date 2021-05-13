export const actions = {
        async prepareReactiveObject({ commit }, rawObject) {
        commit('CREATE_REACTIVE_OBJECT', rawObject);
    },
};
