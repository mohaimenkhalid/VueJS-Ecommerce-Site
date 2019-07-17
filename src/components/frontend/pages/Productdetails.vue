<template>
	<div>
		
		<div id="content" class="float_r">
        	
            <h1>{{ product.pname }}</h1>
            <div class="content_half float_l">
        	<img :src="'http://localhost/vue-ecom/src/assets'+ product.image" alt="Image 01" width="300" />
            </div>
            <div class="content_half float_r">
				<table>
                    <tr>
                        <td height="30" width="160">Price:</td>
                        <td>৳ {{ product.price }}</td>
                    </tr>
                    <tr>
                        <td height="30">Availability:</td>
                        <td>
                        	<span v-if="product.available == 1">In stock</span>
               				<span v-if="product.available == 0">Sold Out</span>
                        </td>
                    </tr>
                    <tr>
                        <td height="30">Brand:</td>
                        <td>{{ product.bname }}</td>
                    </tr>
                    <tr>
                        <td height="30">Manufacturer:</td>
                        <td>{{ product.bname }}</td>
                    </tr>
                    <tr><td height="30">Quantity</td><td><input type="number" v-model="qty" style="width: 20px; text-align: right" /></td></tr>
                </table>
                <div class="cleaner h20"></div>
                <button class="add_to_card" @click="AddToCart()">Add to Cart</button>
			</div>
            <div class="cleaner h30"></div>
            
            <h5>Product Description</h5>
            <p>{{ product.description }}</p>	
            
            <div class="cleaner h50"></div>
            
            <h4>Etiam In Tellus</h4>
        	<div class="product_box">
            	<a href="productdetail.html"><img src="images/product/01.jpg" alt="Image 01" /></a>
                <h3>Ut eu feugiat</h3>
                <p class="product_price">$ 100</p>
                <a href="shoppingcart.html" class="add_to_card">Add to Cart</a>
                <a href="productdetail.html" class="detail">Detail</a>
            </div>        	
            <div class="product_box">
            	<a href="productdetail.html"><img src="images/product/02.jpg" alt="Image 02" /></a>
                <h3>Curabitur et turpis</h3>
                <p class="product_price">$ 200</p>
                <a href="shoppingcart.html" class="add_to_card">Add to Cart</a>
                <a href="productdetail.html" class="detail">Detail</a>
            </div>        	
            <div class="product_box no_margin_right">
            	<a href="productdetail.html"><img src="images/product/03.jpg" alt="Image 03" /></a>
                <h3>Mauris consectetur</h3>
                <p class="product_price">$ 120</p>
                <a href="shoppingcart.html" class="add_to_card">Add to Cart</a>
                <a href="productdetail.html" class="detail">Detail</a>
            </div>     
            
        </div> 
	</div>
</template>


<script>
	
	export default{

		name: 'productdetails',
		data(){
			return{
				productid : 0,
				product : {},
				qty: 1
			}
		},
		mounted(){

			
			this.productid = this.$route.params.id;
			this.init();
			//console.log(this.productid);
		},

		methods: {
			init(){
				this.$axios.get("http://localhost/vue-ecom/src/assets/api/single-product_api.php?id=" + this.productid)
				.then(res=>{
					this.product = res.data.product;
				});
			},

			AddToCart(){

				this.$eventBus.$emit("cartsidebar", true);

				/*this.$store.commit("addToCart", { product: this.product, quantity: this.qty });*/

                //Check Product ..
                var carts = this.$store.getters.getCart;

                var found = false;
                for(var i = 0; i < carts.length; i++){
                    if (carts[i].product.id === this.product.id) {

                        var newproduct = carts[i];
                        newproduct.quantity = newproduct.quantity + 1 ;
                        found = true;
                        break; 
                    }
                }

                if(!found) {
                    this.$store.dispatch("addToCartByAction", { product: this.product, quantity: this.qty });
                }

			},

           

		},

         computed:{

                
            }

	}
</script>