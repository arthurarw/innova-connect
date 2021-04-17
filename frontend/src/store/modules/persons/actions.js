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

    getCategoriesByCompany({commit}, tokenCompany) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Carregando Categorias...');

        return axios.get(`/${API_VERSION}/categories?token_company=${tokenCompany}`)
            .then(response => {
                commit('SET_CATEGORIES_COMPANY', response.data);
            })
            .finally(() => commit('SET_PRELOADER', false));
    },

    getProductsByCompany({commit}, params) {
        commit('SET_PRELOADER', true);
        commit('SET_TEXT_PRELOADER', 'Carregando Produtos...');
        commit('SET_PRODUCTS_COMPANY', {data: []});

        return axios.get(`/${API_VERSION}/products`, {params})
            .then(response => {
                commit('SET_PRODUCTS_COMPANY', response.data);
            })
            .finally(() => commit('SET_PRELOADER', false));
    }
};

export default actions;
