import home from "../components/backend/home";
import categories from "../components/backend/b-category/manage";
import editCategory from "../components/backend/category/edit-category";
import suppliers from "../components/backend/suppliers/manage";
import editSupplier from "../components/backend/suppliers/edit-supplier";
import customers from "../components/backend/b-customers/manage";
import editCustomer from "../components/backend/b-customers/edit-customer";
import products from '../components/backend/products/manage';
import editProduct from '../components/backend/products/edit-product';

export const routes = [
    {path: '/', component: home},
    {path: '/categories', component: categories},
    {path: '/edit-category/:slug', component: editCategory},
    {path: '/suppliers', component: suppliers},
    {path: '/edit-supplier/:slug', component: editSupplier},
    {path: '/edit-customer/:slug', component: editCustomer},
    {path: '/customers', component: customers},
    {path: '/products', component: products},
    {path: '/edit-product', component: editProduct}

    // {path: '/edit-post/:slug', component: editPost},
    // {path:'/show-category/:slug', component: editCategory}
];
