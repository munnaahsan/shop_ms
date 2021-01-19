export default {
    state: {
        supplierData: [],
        categoryData: []
    },
    getters: {
        categories(state) {
            return state.categoryData
        },
        suppliers(state) {
            return state.supplierData
        }
    },
    actions: {
        getCategories(data) {
            // console.log("text")
            axios.get("get-categories")
                .then((response) => {
                    data.commit("categories", response.data.categories)
                }).catch((error) => {

            })
        },
        getSuppliers(data) {
            // console.log("text")
            axios.get("get-suppliers")
                .then((response) => {
                    // console.log(response)
                    data.commit("suppliers", response.data.suppliers)
                }).catch((error) => {
            })
        }
    },
    mutations: {
        categories(state, data) {
            state.categoryData = data
        },
        suppliers(state, data) {
            state.supplierData = data
        }
    }
}
