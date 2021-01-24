export default {
    state: {
        supplierData: [],
        categoryData: [],
        customerData: []
    },
    getters: {
        categories(state) {
            return state.categoryData
        },
        suppliers(state) {
            return state.supplierData
        },
        customers(state) {
            return state.customerData
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
        },
        getCustomers(data) {
            // console.log("text")
            axios.get("get-customers")
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
        },
        customers(state, data) {
            state.customerData = data
        }
    }
}
