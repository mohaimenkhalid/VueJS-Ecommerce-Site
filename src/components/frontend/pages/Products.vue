<template>
	

		<div id="content" class="float_r">
           <h1>All Products</h1>
           <div class="product_box" v-for="product in products" style="    margin: 0 6px 30px 0;">
                <router-link :to="'/productdetails/' + product.id"><img :src="'http://localhost/vue-ecom/src/assets'+ product.image" alt="No image" width="150" height="150" /></router-link>
                <router-link :to="'/productdetails/' + product.id"><h3>{{ product.pname }}</h3></router-link>
                <p class="product_price">৳ {{ product.price }}</p>
                <button class="add_to_card">Add to Cart</button>
                <router-link :to="'/productdetails/' + product.id"> <button class="detail" title="View Details">Details</button></router-link>
            </div>        	 	
            <div class="cleaner"></div>

        </div> 
	</div>
</template>

<script>
    export default{
        name: 'products',
        data(){
            return{
                products: [],
            }
        },

        mounted(){
            this.init();
        },

        methods: {
            init(){

                //Get All Product..

                  this.$axios.get("http://localhost/vue-ecom/src/assets/api/product_api.php?action=read")
                  .then(res=>{
                      this.products = res.data.product;
                  });

            }
        }
    }
</script>