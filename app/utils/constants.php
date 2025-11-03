<?php
const PROTECTED_ROUTES = [
    //admin routes
    '/admin',
    '/admin/products',
    '/admin/add-product',
    '/admin/update-product',
    '/admin/delete-product',
    '/admin/categories',
    '/admin/add-cate',
    '/admin/update-cate',
    '/admin/delete-cate',
    '/admin/orders',
    '/admin/detail-order',
    '/admin/update-order-status',
    '/admin/users',
    '/admin/add-user',
    '/admin/update-user',
    '/admin/delete-user',
    //user routes
    '/me',
    '/update-profile',
    '/update-password',
    '/update-image',
    '/orders',
    '/order-detail',
    '/checkout',
    '/make-order',
    '/checkout-delivery',
    '/checkout-payment',
    '/carts',
    '/delete-cart',
    '/increase-cart',
    '/decrease-cart',

];

const API_PROTECTED_ROUTES = [
    '/api/carts/add',
    '/api/users/update-contact',

];
?>