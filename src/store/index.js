import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const store = new Vuex.Store({

plugins: [createPersistedState()],

  state: {
   	carts: [],
   	total: 0,
  },

  getters: {
 
  getCart:state=> {
    return state.carts;
  	},

  getTotalCart:state=>{
     
     var total = 0;
        for(var i=0; i< state.carts.length; i++){
          var item = state.carts[i];
          total += item.quantity; 
        }
        return total;
  },

  	getTotal:state=> {
    	
    	var total = 0;
				for(var i=0; i< state.carts.length; i++){
					var item = state.carts[i];
					total += item.quantity * item.product.price; 
				}
				return total;
  	}

  },
  mutations: {

  	addToCart(state, payload){

  		state.carts.push(payload);

  	},

  	removeFromCart(state, payload){
  		state.carts.splice(payload, 1);
  	}
    
  },

  actions: {

  	addToCartByAction(context, payload){
  		context.commit('addToCart', payload);
  	}

  }
})

export default store;