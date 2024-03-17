import {pathToArr, set} from "../utils/object";

const state = {
    errors: [],
};
const getters = {
    getErrors(state) {
        return state.errors;
    },
};
const mutations = {
    addError(state, value) {
        state.errors.push(value);
    },
    clearErrors(state) {
        state.errors.splice(0, state.errors.length);
    },
    setErrors(state, errors) {
        mutations.clearErrors(state);
        errors.forEach(error => mutations.addError(state, error));
    },
    setData(state, { param, data }) {
        if (!param || typeof param !== "string") {
            console.error("Store: param must be a string, ", param, " given");
            return;
        }
        let path = pathToArr(param);
        let key = path.shift();
        let obj;

        let previosData = state[param];

        if (!previosData) {
            previosData = {};
        }

        let newData = Object.assign(previosData, data);

        if (path.length) {
            obj = Object.assign(previosData, state[key]);
            set(previosData, path.join("."), newData);
        } else {
            obj = newData;
        }

        state[key] = obj;
    },
    unsetData(state, param) {
        delete state[param];
    },
    setSettings(state, settings) {
        state.settings = settings;
    },
};

const actions = {
};

export default {
    state,
    getters,
    mutations,
    actions,
};
