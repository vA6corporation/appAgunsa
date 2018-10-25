export const routes = [
  {path: '/business', component: require('./components/business')},
  {path: '/business/create', component: require('./components/business/create.vue')},
  {path: '/business/:id/edit', component: require('./components/business/edit.vue')},
  {path: '/customer', component: require('./components/customer')},
  {path: '/customer/create', component: require('./components/customer/create.vue')},
  {path: '/customer/:id/edit', component: require('./components/customer/edit.vue')},
  {path: '/sale', component: require('./components/sale')},
  {path: '/sale/create', component: require('./components/sale/create.vue')},
]
