import Vue from 'vue';
import Vuex from 'vuex';
import persons from './modules/persons';
import {state, mutations} from './default';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        persons
    },
    state,
    mutations
});

export default store;
