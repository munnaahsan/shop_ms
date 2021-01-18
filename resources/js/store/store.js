export default {
    state: {
        postData: [],
        categoryData: []
    },
    getters: {
        categories(state) {
            return state.categoryData
        },
        posts(state) {
            return state.postData
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
        getPosts(data) {
            // console.log("text")
            axios.get("get-posts")
                .then((response) => {
                    data.commit("posts", response.data.posts)
                }).catch((error) => {
            })
        }
    },
    mutations: {
        categories(state, data) {
            state.categoryData = data
        },
        posts(state, data) {
            state.postData = data
        }
    }
}
