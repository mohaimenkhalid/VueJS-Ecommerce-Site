<template>
	
<div>
	
		
	<div id="templatemo_wrapper">
		<Nav></Nav>
	     	<!-- slider -->
	 
	    <div id="templatemo_main">
	   		
	   		<LeftSideBar></LeftSideBar>

	   	 	<router-view />
	        
	    </div> 
	    <!-- END of templatemo_main -->
	    
	   	<Footer></Footer>
    
</div>
	</div>
</template>

<script>
	import Nav from "../partials/Nav.vue";
	import LeftSideBar from "../partials/LeftSideBar.vue";
	import Footer from "../partials/Footer.vue";
	
	export default{
		name: 'Index',
		data(){
			return{

			}
		},
		methods: {

		},

		components:{
			Nav,
			LeftSideBar,
			Footer
		}
	}

</script>
