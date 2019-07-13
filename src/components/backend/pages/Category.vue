<template>
	<div>

		<!-- Add Model -->
		<modal :cond="showingAddModal" modalHeading="Add New Category" @modalClose="showingAddModal = false">

			 <table >
            <tr>
              <td>Category Name</td>
              <td><input type="text" id="newcatname" v-model="newcategory.name"  placeholder="Category Name">
                
              </td>
            </tr>

            <tr>
              <td>Description</td>
              <td>
                <textarea rows="4" type="text" id="newcatname" v-model="newcategory.description"  placeholder="Write a short Description">
                  
                </textarea>
              </td>
            </tr>

            <tr>
              <td></td>
              <td>
                <button class="btnSave" @click="addNewCategory()" >Save</button>
              </td>
            </tr>
        </table>
			
		</modal>

		<!-- Edit Model -->

		<modal :cond ="showingEditModal" modalHeading="Edit This Category" @modalClose="showingEditModal = false">
			<table >
            <tr>
              <td>Category Name</td>
              <td><input type="text" id="newcatname" v-model="clickedcategory.cname"  placeholder="Category Name">
                
              </td>
            </tr>

            <tr>
              <td>Description</td>
              <td>
                <textarea rows="4" type="text" id="newcatname" v-model="clickedcategory.description"  placeholder="Write a short Description">
                  
                </textarea>
              </td>
            </tr>

            <tr>
              <td></td>
              <td>
                <button class="btnSave" @click="updateCategory()" >Save</button>
              </td>
            </tr>
        </table>
		</modal>

		<!-- Delete Model -->

      <modal modalHeading="Delete This Category" :cond="showingDeleteModal" @modalClose="showingDeleteModal = false">
          <table >
        
          <tr>
              <td><h3>Are You sure to Delete this Category "{{ clickedcategory.cname }}" ?</h3></td>

              
            </tr>

            <tr>
              
              <td>
                <button class="btnSave" @click="deleteCategory()" >Yes</button>
                <button class="btnClose" @click="showingDeleteModal = false" >No</button>
              </td>
              
                
             
            </tr>
          </table>
      </modal>
		
       <h2 class="fleft ">Categories</h2>
       <button class="fright addBtn" @click="showingAddModal = true">Add New</button>
      <div class="clear"></div>
      <hr>

      
      <table class="nice-table" >
          <tr>
            <th>S/L</th>
            <th>Name</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          

          <tr v-for="(category, i)  in categories">
            <td> {{ i+1 }}</td>
            <td> {{ category.cname }} </td>
            <td> {{ category.description }} </td>
            <td><button class="edit" @click="showingEditModal = true; clickedCategory(category)" >Edit</button></td>
            <td><button class="delete"  @click="showingDeleteModal = true; clickedCategory(category)">Delete</button></td>
          </tr>
      </table>

	</div>
</template>

<script>
	export default{
		name: 'category',
		data(){
			return{
				showingAddModal: false,
				showingEditModal: false,
				showingDeleteModal: false,
				newcategory: { name: "", description: ""},
				categories: [],
				clickedcategory: {},
			}
		},

		mounted(){
				this.init();
		},

		methods:{
			addNewCategory(){

				console.log(this.newcategory);
				var formData = this.toFormData(this.newcategory);
				this.$axios.post("http://localhost/vue-ecom/src/assets/api/category_api.php?action=create", formData)
				.then(res=>{

					 if (res.data.error) {

			            this.$iziToast.error({
			              title: 'Warnning',
			              message: res.data.message
			            });
        			}else{

		         		this.newcategory = {}
		         		this.$iziToast.success({
		            		 title: 'Success',
		             		 message: res.data.message
		          		}); 
		          		this.init();  
		          		this.showingAddModal = false;  

        			}
				});
			},

			init(){
				this.$axios.get("http://localhost/vue-ecom/src/assets/api/category_api.php?action=read")
				.then(res=>{
					this.categories = res.data.category;
				});
			},

			clickedCategory(category){

				this.clickedcategory = category;
			},

			 updateCategory(){
			 	var formData = this.toFormData(this.clickedcategory);
			 	this.$axios.post("http://localhost/vue-ecom/src/assets/api/category_api.php?action=update", formData)
			 	.then(res=>{

			 		this.showingEditModal = false;
         			this.init();

			 		if (res.data.error) {

			            this.$iziToast.error({
			              title: 'Warnning',
			              message: res.data.message
			            });
        			}else{

		         		this.$iziToast.success({
		            		 title: 'Welcome',
		             		 message: res.data.message
		          		});   
        			}
        			this.clickedcategory = {}
			 	});
			 },

			
    deleteCategory(){


      var formData = this.toFormData(this.clickedcategory);

      this.$axios.post("http://localhost/vue-ecom/src/assets/api/category_api.php?action=delete", formData)
      .then(res=>{
         
         this.showingDeleteModal = false;
         this.init();
         if (res.data.error) {

            this.$iziToast.error({
               title: 'Error',
               message: res.data.message,
            });

         }else{

              this.$iziToast.success({
                title: 'Success',
                message: res.data.message,
              });
         }

          this.clickedcategory = {};
      });
    },

			toFormData: function(obj){
	        	var form_data = new FormData();
	            for ( var key in obj ) {
	               form_data.append(key, obj[key]);
	            } 
	            return form_data;
       		 }


		}
	}
</script>