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

    showContact({commit}, id) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Contact...');

        return axios.get(`/${API_VERSION}/contact/${id}`)
            .then(response => {
                return response.data.data;
            })
            .finally(() => commit('SET_PRELOADER', false));
    },

    storePerson({commit}, params) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Person...');

        return axios.post(`/${API_VERSION}/persons`, params)
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

    updateContact({commit}, params) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Person...');

        let id = params.id;
        return axios.put(`/${API_VERSION}/contact/${id}`, params)
            .then(response => {
                return response.data.data;
            })
            .finally(() => commit('SET_PRELOADER', false));
    },

    destroyPerson({commit}, id) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Person...');

        return axios.delete(`/${API_VERSION}/persons/${id}`)
            .then(response => {
                return response.message;
            })
            .finally(() => commit('SET_PRELOADER', false));
    },

    destroyContact({commit}, id) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Loading Person...');

        return axios.delete(`/${API_VERSION}/contact/${id}`)
            .then(response => {
                return response.message;
            })
            .finally(() => commit('SET_PRELOADER', false));
    },
};

export default actions;
