import {helper} from './helpers';

export const mutations = {
    CREATE_REACTIVE_OBJECT(state, rawObject) {
        helper.createReactiveNestedObject(state.rootProperty, rawObject);
    },
}
