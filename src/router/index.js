import Vue from 'vue'
import Router from 'vue-router'
import Master from '@/components/frontend/pages/Master'
import Index from '@/components/frontend/pages/Index'
import Products from '@/components/frontend/pages/Products'
import Cart from '@/components/frontend/pages/Cart'
import About from '@/components/frontend/pages/About'
import Contact from '@/components/frontend/pages/Contact'

/*Admin Panel*/
import AdminLogin from '@/components/backend/AdminLogin'
import Admin from '@/components/backend/pages/Admin'
import Dashboard from '@/components/backend/pages/Dashboard'
import Category from '@/components/backend/pages/Category'
import Brand from '@/components/backend/pages/Brand'
import Product from '@/components/backend/pages/Product'

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
			},

			{
				path: 'about',
				name: 'frontend.about',
				component: About
			}
		]

    },

    {
			path: '/admin/login',
			name: 'admin.login',
			component: AdminLogin
	},

	{
		path: '/admin',
		name: 'admin',
		component: Admin,
		redirect : { path: 'admin/dashboard' },

		children: [
			{
				path: 'dashboard',
				name: 'admin.dashboard',
				component: Dashboard

			},

			{
				path: 'category',
				name: 'admin.category',
				component: Category

			},

			{
				path: 'brand',
				name: 'admin.brand',
				component: Brand

			},

			{
				path: 'product',
				name: 'admin.product',
				component: Product

			}


		]
	}
  ],

  mode: 'history'
})
