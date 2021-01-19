import home from "../components/backend/home";
import categories from "../components/backend/category/manage";
import editCategory from "../components/backend/category/edit-category";
import suppliers from "../components/backend/suppliers/manage";
import editSupplier from "../components/backend/suppliers/edit-supplier";
// import editPost from "../components/backend/posts/edit-post";

export const routes = [
    {path: '/', component: home},
    {path: '/categories', component: categories},
    {path: '/edit-category/:slug', component: editCategory},
    {path: '/suppliers', component: suppliers},
    {path: '/edit-supplier/:slug', component: editSupplier},
    // {path: '/edit-post/:slug', component: editPost},
    // {path:'/show-category/:slug', component: editCategory}
];
