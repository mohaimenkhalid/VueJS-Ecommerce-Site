<template>
<div>
        <div id="content" class="float_r">
            

             <h4 style="margin-top: 50px;">User Login</h4>
            

            <table style="border:1px solid #CCCCCC;" width="100%">
                        
                        <tr>
                            <th>Email</th>
                            <td><input type="text" placeholder="Enter email" v-model="user.email"  style="width:300px; " required /></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="Password" placeholder="Enter Password" v-model="user.password" style="width:300px;" required /></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>Not Registered User?<a href=""> Click Here</a></td>
                        </tr>

                        <tr>
                            <th></th>
                            <td><button class="addBtn" @click="loginNow()">Login</button></td>
                        </tr>
                        
                    </table>
             
            <div class="cleaner h50"></div>
            <div class="cleaner h50"></div>
            <div class="cleaner h50"></div>
            <div class="cleaner h50"></div>
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

                 user: {email: "", password: ""},
                
            }
        },

        mounted(){
            var token = localStorage.getItem("user_token");

            if (token) {
              this.$router.push({ name: "frontend.index" });

               this.$iziToast.success({
                          title: 'Hey User',
                          message: 'You are already Logged in!!'
                        });
            }
        },

        methods: {
            showcart(){
                this.$eventBus.$emit("cartsidebar", true);
            },

            loginNow(){
                var formData = this.toFormData(this.user);
                this.$axios.post("http://localhost/vue-ecom/src/assets/api/userlogin_api.php?action=login", formData)
                .then(res=>{

                    if (res.data.error) {

                        this.$iziToast.error({
                          title: 'Warnning',
                          message: res.data.message
                        });
                    }else{

                          //this.user = {}
                          this.$iziToast.success({
                              title: 'Welcome',
                              message: res.data.message
                          });

                          localStorage.setItem("user_token", res.data.user_token);
                          this.$router.push({ name: "frontend.products" });
                    }
                }); 

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