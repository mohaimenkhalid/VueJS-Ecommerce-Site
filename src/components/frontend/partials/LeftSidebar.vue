<template>
	<div>
		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categories</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first" v-for="category in categories"><a href=""> {{ category.cname }} </a> </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3>Best Sellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 01" /></a>
                        <h4><a href="#">Donec nunc nisl</a></h4>
                        <p class="price">$10</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 02" /></a>
                        <h4><a href="#">Aenean eu tellus</a></h4>
                        <p class="price">$12</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 03" /></a>
                        <h4><a href="#">Phasellus ut dui</a></h4>
                        <p class="price">$20</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 04" /></a>
                        <h4><a href="#">Vestibulum ante</a></h4>
                        <p class="price">$16</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
    
export default{
    name: 'sidebar',

    data(){
        return {
            categories: [],
        }
    },

    mounted(){
        this.init();
    },

    methods: {
        //Get all Category...
        init(){
                this.$axios.get("http://localhost/vue-ecom/src/assets/api/category_api.php?action=read")
                .then(res=>{
                    this.categories = res.data.category;
                });
            }
    }
}
</script>