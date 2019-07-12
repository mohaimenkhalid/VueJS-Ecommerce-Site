import Vue from 'vue'
import Router from 'vue-router'
import Master from '@/components/frontend/pages/Master'
import Index from '@/components/frontend/pages/Index'
import Products from '@/components/frontend/pages/Products'
import Cart from '@/components/frontend/pages/Cart'
import Contact from '@/components/frontend/pages/Contact'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Master',
      component: Master,
      redirect: { path: '/shop' },

      children:
       [
			{
				path: 'shop',
				name: 'frontend.index',
				component: Index
			},

			{
				path: 'products',
				name: 'frontend.products',
				component: Products
			},

			{
				path: 'contact',
				name: 'frontend.contact',
				component: Contact
			},

			{
				path: 'cart',
				name: 'frontend.cart',
				component: Cart
			}
		]

    }
  ],

  mode: 'history'
})
