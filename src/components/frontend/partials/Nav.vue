<template>
	<div>
		<div id="templatemo_header">
    
	    	<div id="site_title">
	        	<h1><a href="#">Station Shop</a></h1>
	        </div>
	        
	        <div id="header_right">
		        <a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | 
                 <a  @click="logoutnow()"  >Log out</a> | <router-link to="/user/login" >Log in</router-link>
			</div>
	        
	        <div class="cleaner"></div>
    	</div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menu">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><router-link to="/" exact>Home</router-link></li>
                <li><router-link to="/products">Products</router-link></li>
                <li><router-link to="/cart">Cart</router-link></li>
                <li><router-link to="/about">About</router-link></li>
                <li><router-link to="/contact">Contact</router-link></li>
            </ul>

    

            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="menu_second_bar">
        	<div id="top_shopping_cart">
            	Shopping Cart: <strong>3 Products</strong> ( <button style="cursor: pointer; background: aqua;" @click="showcart()">Show Cart </button> )
            </div>
        	<div id="templatemo_search">
                <form action="#" method="get">
                  <input type="text" value="Search" name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
                  <input type="submit" name="Search" value=" Search " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
                </form>
            </div>
            <div class="cleaner"></div>
    	</div>
    </div> <!-- END of templatemo_menu -->


	</div>
</template>

<script>
    export default{
        name: 'Nav',
        data(){
            return{
                 
                
            }
        },

        mounted(){
             
              
        },

        methods: {
            showcart(){
                this.$eventBus.$emit("cartsidebar", true);
            },

            logoutnow(){
                localStorage.setItem("user_token", "");

                this.check_login = false;
                this.$iziToast.success({
                          title: 'Success',
                          message: 'Logout Successfully'
                    });
            },
   
            
        },

        
    }
</script>