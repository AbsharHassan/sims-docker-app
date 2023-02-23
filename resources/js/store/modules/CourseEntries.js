import axios from "axios";

axios.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${sessionStorage.getItem('AUTH-TOKEN')}`
    config.headers.Accept = 'application/json'
    return config
})

import router from '../../router'

const state = {
    Courses: [],
    courseErrors: '',
};

const getters = {
    allCourseErrors: (state) => state.errors,
};

const actions = {
    setLoadingStatus({ commit }, value) {
        commit('newLoadingStatus', value)
    },
    setFlashMessage({ commit }, value) {
        commit('setFlashMessage', value)
    },
    clearErrorMessages({ commit }) {
        commit('clearErrors')
    },
    async addEntryCourse({ commit }, formFields) {
        var errors = {};
        commit('newLoadingStatus', true)
        await axios.post('/api/courses', formFields)
        .then(response => {
            commit('newCourses', response.data);
            commit('newErrors', errors);
        }).catch(error => {
            if(error.response.status == 422) {
                for (const key in error.response.data.errors) {
                    errors[key] = error.response.data.errors[key][0];        
                }
                commit('newErrors', errors);
            } 
        });
        commit('newLoadingStatus', false)
    },
};

const mutations = {
    newCourses: (state, entry) => state.Courses.push(entry),
    newErrors: (state, errors) => (state.errors = errors),
    newLoadingStatus: (state, value) => (state.isLoading = value),
    setFlashMessage: (state, message) => (state.flashMessage = message),
    emptyResponse: (state, value) => (state.isEmpty = value),
    clearErrors: (state) => (state.errors = '')
};

export default {
    state,
    getters,
    actions,
    mutations
}
