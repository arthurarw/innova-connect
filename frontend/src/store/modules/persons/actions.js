import axios from 'axios';
import {API_VERSION} from '../../../configs';

const actions = {
    getPersons({commit}) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading...');

        return axios
            .get(`/${API_VERSION}/persons`)
            .then(response => {
                commit('SET_PERSONS', response.data.data);
            })
            .finally(() => commit('SET_PRELOADER', false));
    },

    showPerson({commit}, id) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Person...');

        return axios.get(`/${API_VERSION}/persons/${id}`)
            .then(response => {
                commit('SET_PERSONS', response.data.data);
            })
            .finally(() => commit('SET_PRELOADER', false));
    },

    updatePerson({commit}, params) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Person...');

        let id = params.person_id;
        return axios.put(`/${API_VERSION}/persons/${id}`, params)
            .then(response => {
                return response.data.data;
            })
            .finally(() => commit('SET_PRELOADER', false));
    },

    storeContacts({commit}, params) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Person...');

        return axios.post(`/${API_VERSION}/contact`, params)
            .then(response => {
                return response.data.message;
            })
            .finally(() => commit('SET_PRELOADER', false));
    }
};

export default actions;
