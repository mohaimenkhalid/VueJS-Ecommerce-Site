<template>
	
<div>
<transition name="bar">	
		<div style=" 
		  	width: 250px;
		  	float: left;
		  	position: fixed;
			z-index: 999999999;
			top: 0;
			bottom: 0;
			right: 0;
			background: rgba(0,255,255, 0.9);
			overflow: scroll;
			/*padding-top: calc(50vh - 158px);*/

		  	" v-if="cartsidebar">
		  	<div><button @click=" cartsidebar = false" class="leftcartbar" style="border:none;
			background: rgba(255,255,255,.1); font-size: 30px; cursor: pointer;"  title="Close">X</button></div>
			<h2 style="text-align: center; background-color: aqua; padding-top: 20px; padding-bottom: 20px">Your Cart</h2>
			<h3>Total Cart Item - {{ getTotalCart }}</h3>


					<table >
						<tr>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						<tr v-for="(cart, index) in carts">
							<td>{{ cart.product.pname }}</td>
							<td><input type="" style="width: 25px;" v-model="cart.quantity" ></td>
							<td>{{ cart.product.price * cart.quantity }}</td>
							<td><button @click="removeItem(index)">X</button></td>
						</tr>

						<tr>
							<td colspan="3">
								<hr>
							</td>
							
						</tr>
						<tr>
							<td></td>
							<td><strong>Total</strong></td>
							<td>{{ total }}</td>
						</tr>
						<tr>
							<td colspan="3">
								<center><button class="addBtn">Checkout</button></center>
							</td>
						</tr>
					</table>
			</div>

</transition>
</div>

</template>

<script>
	import { mapGetters } from 'vuex'

	export default{
		name: 'Cartsidebar',

		data(){
			return{
				cartsidebar : false,
				
			}
		},

		methods:{

			removeItem(index){
				this.$store.commit("removeFromCart", index);
			}
		},


		computed:{
			
			...mapGetters({
      			'carts' : 'getCart',
      			'total' : 'getTotal',
      			'getTotalCart' : 'getTotalCart'
      			
     		 })

			// carts(){
			// 	return this.$store.getters.getCart;
			// },
			// total(){
			// 	return this.$store.getters.getTotal;
			// }

		},

		created() {

			this.$eventBus.$on("cartsidebar",payload=>{
    		this.cartsidebar = payload;
  			});
		}

		
	}
</script>