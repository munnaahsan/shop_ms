import home from "../components/backend/home";
import categories from "../components/backend/category/manage";
import editCategory from "../components/backend/category/edit-category";
// import posts from "../components/backend/posts/posts";
// import editPost from "../components/backend/posts/edit-post";

export const routes = [
    {path: '/', component: home},
    {path: '/categories', component: categories},
    {path: '/edit-category/:slug', component: editCategory},
    // {path: '/posts', component: posts},
    // {path: '/edit-post/:slug', component: editPost},
    // {path:'/show-category/:slug', component: editCategory}
];
