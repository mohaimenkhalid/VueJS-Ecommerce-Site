<template>
<div>
        <div id="content" class="float_r">
            <h2>Checkout</h2>

             <h4>Shopping Cart</h4>
            

            <table v-if="getTotalCart !== 0" style="border:1px solid #CCCCCC;" width="100%">
                        <tr>
                            <th>S/L</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        <tr v-for="(cart, index) in carts" style="text-align: center;">
                            <td>{{ index+1 }}</td>
                            <td>{{ cart.product.id }}</td>
                            <td>Image</td>
                            <td>{{ cart.product.pname }}</td>
                            <td>{{ cart.quantity }}</td>
                            <td>{{ cart.product.price * cart.quantity }} ৳</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" >
                                <hr style="border: 1px solid #CCC">
                            </td>
                        </tr>
                        
                        <tr style="text-align: center;">
                            <td colspan="3"></td>
                            <td><h4>Total</h4></td>
                            <td><h4>{{ total }} ৳</h4></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <center>
                                   
                                    <button class="addBtn" @click="showcart()">Update Cart</button>
                                </center>
                            </td>
                        </tr>
                    </table>

                    <span v-else style="text-align: center; ">
                    <h3> Your Cart is Empty!</h3>
                    <center><router-link to="/products"><button class="addBtn" @click="cartsidebar = false;">Continue Shoping</button></router-link></center>
                    </span>
             <div class="cleaner h50"></div>



            <h5><strong>YOUR DETAILS</strong></h5>
            <div class="content_half float_l checkout">
                Enter your full name as it is on the credit card:                               
                <input type="text"  style="width:300px;" required />
                Address:
                <input type="text"  style="width:300px;" required />
                City:
                <input type="text"  style="width:300px;" required />
               
            </div>
            
            <div class="content_half float_r checkout">
                Email:
                <input type="text"  style="width:300px;" required />
                Phone:<br />
                <input type="text"  style="width:300px;"  required />
                 <span style="font-size:10px">Please, specify your reachable phone number. YOU MAY BE GIVEN A CALL TO VERIFY AND COMPLETE THE ORDER.</span>
            </div>

            <br>
            <div class="cleaner h30"></div>
            <button class="addBtn" @click="confirmOrder()">Confirm Order</button>
           
        </div>
        <div class="cleaner"></div>
</div>
</template>


<script>
    import { mapGetters } from 'vuex'

    export default{
        name: 'Cartsidebar',

        data(){
            return{
                
            }
        },

        mounted(){
            var token = localStorage.getItem("user_token");

            if (!token) {
              this.$router.push({ name: "frontend.login" });

               this.$iziToast.success({
                          title: 'Message',
                          message: 'Before Checkout you have to must Login!!'
                        });
            }

            console.log(this.carts[0].product);
            console.log(this.carts[0]);
            //console.log(this.carts);


        },

        methods: {
            showcart(){
                this.$eventBus.$emit("cartsidebar", true);
            },

            confirmOrder(){

                for(var i = 0; i < this.carts.length; i++){

                var formData1 = this.toFormData(this.carts[i]);
                var formData = this.toFormData(this.carts[i].product);

                this.$axios.post("http://localhost/vue-ecom/src/assets/api/order_api.php?action=create", formData )
                .then(res=>{
                    
                });
                }

            },

            toFormData: function(obj) {

                  var form_data = new FormData();
                  for (var key in obj) {
                    form_data.append(key, obj[key]);
                  }
                  return form_data;
                }


        },


        computed:{
            
            ...mapGetters({
                'carts' : 'getCart',
                'total' : 'getTotal',
                'getTotalCart' : 'getTotalCart'
                
             })

            // carts(){
            //  return this.$store.getters.getCart;
            // },
            // total(){
            //  return this.$store.getters.getTotal;
            // }
        }

        
    }
</script>