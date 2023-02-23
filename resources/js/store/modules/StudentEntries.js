import axios from "axios";
import { set } from "lodash";

axios.interceptors.request.use((config) => {
    config.headers.Authorization = `Bearer ${sessionStorage.getItem(
        "AUTH-TOKEN"
    )}`;
    config.headers.Accept = "application/json";
    return config;
});

import router from "../../router";

const state = {
    authToken: sessionStorage.getItem("AUTH-TOKEN"),
    currentUser: {
        id: sessionStorage.getItem("CURRENT-USER-ID"),
        email: sessionStorage.getItem("CURRENT-USER-EMAIL"),
        name: sessionStorage.getItem("CURRENT-USER-NAME"),
        role: sessionStorage.getItem("CURRENT-USER-ROLE"),
    },
    users: [],
    entries: [],
    courses: [],
    course: {},
    student: {},
    family: {},
    academics: {},
    histogram: [],
    cgpa: {},
    flashMessage: "",
    isLoading: false,
    errors: "",
    isEmpty: false,
    allowDelete: false,
    confirmationOverlayMessage: "Are you sure you want to delete this entry?",
    showConfirmationBox: false,
    deleteTarget: "",
    logoutMessage: "You will be logged out. Do you wish to proceed?",
    showLogoutBox: false,
    showNavText: true,
    navWidth: 120,
    gridClasses: "xl:grid-cols-[120px_minmax(120px,_1fr)]",
    showSlideMenu: false,
    refreshCounter: 0,
};

const getters = {
    allEntries: (state) => state.entries,
    allErrors: (state) => state.errors,
    singleStudent: (state) => state.student,
    singleFamily: (state) => state.family,
    singleAcademics: (state) => state.academics,
    loadingStatus: (state) => state.isLoading,
    histogramData: (state) => state.histogram,
    flashMessage: (state) => state.flashMessage,
    isEmptyRespone: (state) => state.isEmpty,
    getAuthToken: (state) => state.authToken,
    allCourses: (state) => state.courses,
    singleCourse: (state) => state.course,
    confirmationOverlayMessage: (state) => state.confirmationOverlayMessage,
    showConfirmationBox: (state) => state.showConfirmationBox,
    deleteTarget: (state) => state.deleteTarget,
    logoutMessage: (state) => state.logoutMessage,
    showLogoutBox: (state) => state.showLogoutBox,
    navWidth: (state) => state.navWidth,
    showNavText: (state) => state.showNavText,
    gridClasses: (state) => state.gridClasses,
    currentUser: (state) => state.currentUser,
    allUsers: (state) => state.users,
    showSlideMenu: (state) => state.showSlideMenu,
    getRefresh: (state) => state.refreshCounter,
};

const actions = {
    setLoadingStatus({ commit }, value) {
        commit("newLoadingStatus", value);
    },
    setFlashMessage({ commit }, value) {
        commit("setFlashMessage", value);
    },
    clearErrorMessages({ commit }) {
        commit("clearErrors");
    },
    deleteConfirmer({ commit }, value) {
        commit("setDelete", value);
        console.log(state.allowDelete);
    },
    showConfirmationBox({ commit }, deleteSetterObject) {
        commit("setConfirmationBox", deleteSetterObject.value);
        commit("setDeleteTarget", deleteSetterObject.target);
    },
    showLogout({ commit }, value) {
        commit("setLogoutConfirmer", value);
    },
    toggleNavWidth({ commit }, width) {
        commit("setNavText");
        if (state.showNavText) {
            commit("setNavWidth", 120);
            // commit('setGridClasses', `xl:grid-cols-[120px_minmax(120px,_1fr)]`)
        } else {
            commit("setNavWidth", width);
            // commit('setGridClasses', `xl:grid-cols-[${width}px_minmax(${width}px,_1fr)]`)
        }
        sessionStorage.setItem("SHOW-NAV-TEXT", state.showNavText);
    },
    toggleSlideMenu({ commit }, value) {
        commit("setSlideBar", value);
    },
    async getAfterLoginPath() {
        await axios.get("/login").then((response) => {
            console.log(response);
        });
    },
    async createUser({ commit }, formFields) {
        commit("newLoadingStatus", true);
        var errors = {};
        await axios
            .post("/api/register", formFields)
            .then((response) => {
                if (response.data.token) {
                    sessionStorage.setItem("AUTH-TOKEN", response.data.token);
                    sessionStorage.setItem(
                        "CURRENT-USER-ID",
                        response.data.user.id
                    );
                    sessionStorage.setItem(
                        "CURRENT-USER-EMAIL",
                        response.data.user.email
                    );
                    sessionStorage.setItem(
                        "CURRENT-USER-NAME",
                        response.data.user.name
                    );
                    sessionStorage.setItem(
                        "CURRENT-USER-ROLE",
                        response.data.user.role
                    );
                    commit("setAuthToken", response.data.token);
                    commit("setFlashMessage", response.data.message);
                    router.push({ name: "Home" });
                }
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async loginUser({ commit }, formFields) {
        commit("newLoadingStatus", true);
        var errors = {};
        await axios
            .post("/api/login", formFields)
            .then((response) => {
                if (response.data.token) {
                    sessionStorage.setItem("AUTH-TOKEN", response.data.token);
                    sessionStorage.setItem(
                        "CURRENT-USER-ID",
                        response.data.user.id
                    );
                    sessionStorage.setItem(
                        "CURRENT-USER-EMAIL",
                        response.data.user.email
                    );
                    sessionStorage.setItem(
                        "CURRENT-USER-NAME",
                        response.data.user.name
                    );
                    sessionStorage.setItem(
                        "CURRENT-USER-ROLE",
                        response.data.user.role
                    );
                    commit("setAuthToken", response.data.token);
                    commit("setFlashMessage", response.data.message);
                    router.push({ name: "Home" });
                }
            })
            .catch((error) => {
                if (error.response.status == 401) {
                    commit("newErrors", error.response.status);
                } else if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async handleLogout({ commit }) {
        commit("newLoadingStatus", true);
        console.log(sessionStorage.getItem("AUTH-TOKEN"));
        await axios
            .post("/api/logout")
            .then((response) => {
                if (response.data.loggedOut) {
                    sessionStorage.removeItem("AUTH-TOKEN");
                    commit("setAuthToken", response.data.token);
                    router.push({ name: "Login" });
                    commit("setFlashMessage", response.data.message);
                }
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
    },
    async getAllUsers({ commit }) {
        await axios
            .get("/api/users")
            .then((response) => {
                commit("setAllUsers", response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    async editCurrentUser({ commit }, formFields) {
        commit("newLoadingStatus", true);
        var errors = {};
        await axios
            .put(`/api/users/${formFields.id}`, formFields)
            .then((response) => {
                console.log(response);
                commit("setFlashMessage", response.data.message);
                sessionStorage.setItem(
                    "CURRENT-USER-ID",
                    response.data.user.id
                );
                sessionStorage.setItem(
                    "CURRENT-USER-EMAIL",
                    response.data.user.email
                );
                sessionStorage.setItem(
                    "CURRENT-USER-NAME",
                    response.data.user.name
                );
                sessionStorage.setItem(
                    "CURRENT-USER-ROLE",
                    response.data.user.role
                );
                commit("updateCurrentUser");
                console.log(state.currentUser);
            })
            .catch((error) => {
                console.log(error);
                if (error.response.status == 401) {
                    commit("setFlashMessage", "Incorrect password entered");
                } else if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async changePassword({ commit }, formFields) {
        commit("newLoadingStatus", true);
        var errors = {};
        await axios
            .put(`/api/users/${formFields.id}/change-password`, formFields)
            .then((response) => {
                console.log(response);
                commit("setFlashMessage", response.data.message);
            })
            .catch((error) => {
                if (error.response.status == 401) {
                    errors = error.response.data.error;
                    commit("newErrors", errors);
                } else if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async forgotPasswordForm({ commit }, formFields) {
        commit("newLoadingStatus", true);
        var errors = {};
        await axios
            .post("/api/forgot-password", formFields)
            .then((response) => {
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
    },
    async getFamilyCreatePage({ commit }, id) {
        commit("newLoadingStatus", true);
        await axios
            .get(`/api/students/${id}/family/create`)
            .then((response) => {
                if (response.data.canProceed) {
                    router.push({
                        name: "FamilyDataEntry",
                        params: { student_id: id },
                    });
                } else {
                    if (response.data.redirectTo === "dashboard") {
                        router.push({ name: "Dashboard" });
                        commit("setFlashMessage", response.data.message);
                    } else if (response.data.redirectTo === "academics") {
                        router.push({
                            name: "AcademicsDataEntry",
                            params: { student_id: id },
                        });
                        commit("setFlashMessage", response.data.message);
                    } else if (response.data.redirectTo === "base") {
                        router.push({ name: "CreateEntry" });
                        commit("setFlashMessage", response.data.message);
                    }
                }
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
    },
    async getAcademicsCreatePage({ commit }, id) {
        commit("newLoadingStatus", true);
        commit("setFlashMessage", "");
        await axios
            .get(`/api/students/${id}/academics/create`)
            .then((response) => {
                if (response.data.canProceed) {
                    router.push({
                        name: "AcademicsDataEntry",
                        params: { student_id: id },
                    });
                } else {
                    if (response.data.redirectToDashboard) {
                        router.push({ name: "Dashboard" });
                        commit("setFlashMessage", response.data.message);
                    } else {
                        if (response.data.redirectToMain) {
                            router.push({ name: "CreateEntry" });
                            commit("setFlashMessage", response.data.message);
                        } else {
                            router.push({
                                name: "FamilyDataEntry",
                                params: { student_id: id },
                            });
                            commit("setFlashMessage", response.data.message);
                        }
                    }
                }
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
    },
    async getAllEntries({ commit }) {
        var todayDate = new Date();
        commit("newLoadingStatus", true);
        commit("emptyResponse", false);
        await axios
            .get("/api")
            .then((response) => {
                response.data.forEach((entry) => {
                    var birthDate = new Date(entry.dob);
                    if (todayDate.getMonth() > birthDate.getMonth()) {
                        entry.age =
                            todayDate.getFullYear() - birthDate.getFullYear();
                    } else if (todayDate.getMonth() == birthDate.getMonth()) {
                        if (todayDate.getDate() >= birthDate.getDate()) {
                            entry.age =
                                todayDate.getFullYear() -
                                birthDate.getFullYear();
                        } else {
                            entry.age =
                                todayDate.getFullYear() -
                                birthDate.getFullYear() -
                                1;
                        }
                    } else {
                        entry.age =
                            todayDate.getFullYear() -
                            birthDate.getFullYear() -
                            1;
                    }
                });
                commit("newEntries", response.data);
                if (!response.data.length) {
                    commit("emptyResponse", true);
                }
                router.push({ name: "Dashboard" });
            })
            .catch((error) => {
                console.log(error);
            });
        commit("setRefreshCounter");
        commit("newLoadingStatus", false);
    },
    async getSingleEntry({ commit }, id) {
        var todayDate = new Date();
        commit("newLoadingStatus", true);
        await axios
            .get(`/api/students/${id}`)
            .then((response) => {
                if (response.data) {
                    var birthDate = new Date(response.data.student.dob);
                    if (todayDate.getMonth() > birthDate.getMonth()) {
                        response.data.student.age =
                            todayDate.getFullYear() - birthDate.getFullYear();
                    } else if (todayDate.getMonth() == birthDate.getMonth()) {
                        if (todayDate.getDate() >= birthDate.getDate()) {
                            response.data.student.age =
                                todayDate.getFullYear() -
                                birthDate.getFullYear();
                        } else {
                            response.data.student.age =
                                todayDate.getFullYear() -
                                birthDate.getFullYear() -
                                1;
                        }
                    } else {
                        response.data.student.age =
                            todayDate.getFullYear() -
                            birthDate.getFullYear() -
                            1;
                    }
                    response.data.academics.latest_cgpa =
                        response.data.academics[
                            `${response.data.student.current_sem - 1}`
                        ].cgpa;
                    commit("newGetStudent", response.data.student);
                    commit("newGetFamily", response.data.family);
                    commit("newGetAcademics", response.data.academics);
                } else {
                    router.push({
                        name: "FamilyDataEntry",
                        params: { student_id: id },
                    });
                }
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
    },
    async addEntryStudent({ commit }, formFields) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .post("/api/students", formFields)
            .then((response) => {
                commit("newEntries", response.data);
                commit("newErrors", errors);
                commit("emptyResponse", false);
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async addEntryFamily({ commit }, formFields) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .post("/api/students/family", formFields)
            .then((response) => {
                commit("newEntries", response.data);
                commit("newErrors", errors);
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async addEntryAcademics({ commit }, formFields) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .post("/api/students/academics", formFields)
            .then((response) => {
                commit("newEntries", response.data);
                commit("newErrors", errors);
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async editStudentEntry({ commit }, payload) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .put(`/api/students/${payload.id}`, payload.formFields)
            .then((response) => {
                if (response.status == 200) {
                    commit("setFlashMessage", response.data.message);
                }
            })
            .catch((error) => {
                console.log(error);
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
                commit("newLoadingStatus", false);
            });
    },
    async editStudentFamilyEntry({ commit }, formFields) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .put(`/api/students/${formFields.student_id}/family`, formFields)
            .then((response) => {
                if (response.status == 200) {
                    console.log(response);
                    commit("setFlashMessage", response.data.message);
                }
            })
            .catch((error) => {
                console.log(error);
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async editStudentAcademics({ commit }, formFields) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .put(
                `/api/students/academics/${formFields.academic_id}`,
                formFields
            )
            .then((response) => {
                if (response.status == 200) {
                    commit("setFlashMessage", response.data.message);
                }
            })
            .catch((error) => {
                for (const key in error.response.data.errors) {
                    errors[key] = error.response.data.errors[key][0];
                }
                commit("newErrors", errors);
            });
        commit("newLoadingStatus", false);
    },
    async deleteSigleStudent({ commit }, id) {
        await axios
            .delete(`/api/students/${id}`)
            .then((response) => {
                if (response.status == 200) {
                    commit("setFlashMessage", response.data.message);
                    router.push({ name: "Dashboard" });
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },
    async addEntryCourse({ commit }, formFields) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .post("/api/courses", formFields)
            .then((response) => {
                commit("newCourses", response.data);
                commit("newErrors", errors);
                commit("emptyResponse", false);
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async addCourseMarks({ commit }, formFields) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .post("/api/courses-marks", formFields)
            .then((response) => {
                commit("newCourses", response.data);
                commit("newErrors", errors);
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async getAllCourses({ commit }) {
        commit("newLoadingStatus", true);
        commit("emptyResponse", false);
        await axios
            .get("/api/courses")
            .then((response) => {
                commit("newCourses", response.data);
                if (!response.data.length) {
                    commit("emptyResponse", true);
                }
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
        commit("setRefreshCounter");
    },
    async getSingleCourse({ commit }, id) {
        commit("newLoadingStatus", true);
        await axios
            .get(`/api/courses/${id}`)
            .then((response) => {
                if (response.data.canProceed) {
                    commit("newSingleCourse", response.data.course);
                } else {
                    commit("setFlashMessage", response.data.message);
                    router.push({ name: "CreateCourse" });
                }
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
        commit("setRefreshCounter");
    },
    async editSingleCourse({ commit }, payload) {
        var errors = {};
        commit("newLoadingStatus", true);
        await axios
            .put(`/api/courses/${payload.id}`, payload.formFields)
            .then((response) => {
                console.log(response);
                commit("newSingleCourse", payload.formFields);
                commit(
                    "setFlashMessage",
                    "Course details updated successfully"
                );
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    for (const key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    commit("newErrors", errors);
                }
            });
        commit("newLoadingStatus", false);
    },
    async deleteSingleCourse({ commit }, id) {
        commit("newLoadingStatus", true);
        await axios
            .delete(`/api/courses/${id}`)
            .then((response) => {
                console.log(response);
                if (response.status == 204) {
                    commit("setConfirmationBox", false);
                    commit("setDeleteTarget", "");
                    commit(
                        "setFlashMessage",
                        "The course has been deleted from the database."
                    );
                    router.push({ name: "AllCourseEntries" });
                }
            })
            .catch((error) => {
                console.log(error);
            });
        commit("newLoadingStatus", false);
    },
};

const mutations = {
    setAllUsers: (state, users) => state.users.push(users),
    newEntries: (state, entry) => state.entries.push(entry),
    newErrors: (state, errors) => (state.errors = errors),
    newGetStudent: (state, student) => (state.student = student),
    newGetFamily: (state, family) => (state.family = family),
    newGetAcademics: (state, academics) => (state.academics = academics),
    newLoadingStatus: (state, value) => (state.isLoading = value),
    newGetHistogram: (state, data) => (state.histogram = data),
    familyViewAuth: (state, data) => (state.isAllowed = data),
    setFlashMessage: (state, message) => (state.flashMessage = message),
    emptyResponse: (state, value) => (state.isEmpty = value),
    setAuthToken: (state, value) => (state.authToken = value),
    clearErrors: (state) => (state.errors = ""),
    newCourses: (state, entry) => state.courses.push(entry),
    newSingleCourse: (state, course) => (state.course = course),
    setDelete: (state, value) => (state.allowDelete = value),
    setConfirmationBox: (state, value) => (state.showConfirmationBox = value),
    setDeleteTarget: (state, target) => (state.deleteTarget = target),
    setLogoutConfirmer: (state, value) => (state.showLogoutBox = value),
    setNavWidth: (state, width) => (state.navWidth = width),
    setNavText: (state) => (state.showNavText = !state.showNavText),
    setGridClasses: (state, value) => (state.gridClasses = value),
    updateCurrentUser: (state) => {
        state.currentUser.id = sessionStorage.getItem("CURRENT-USER-ID");
        state.currentUser.email = sessionStorage.getItem("CURRENT-USER-EMAIL");
        state.currentUser.name = sessionStorage.getItem("CURRENT-USER-NAME");
        state.currentUser.role = sessionStorage.getItem("CURRENT-USER-ROLE");
    },
    setSlideBar: (state, value) => (state.showSlideMenu = value),
    setRefreshCounter: (state) => state.refreshCounter++,
};

export default {
    state,
    getters,
    actions,
    mutations,
};
