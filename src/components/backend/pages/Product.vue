<template>
	<div>

		<modal :cond="showingAddModal" modalHeading="Add New Product" @modalClose="showingAddModal = false">
			<table >
            <tr>
              <td>Product Name</td>
              <td><input type="text" id="newproductname" v-model="newproduct.name"   placeholder="Product Name">
                
              </td>
            </tr>

           

            <tr>
              <td> Price</td>
              <td><input type="number" id=""  v-model="newproduct.price"  placeholder="Product price">
                
              </td>
            </tr>

            <tr>
              <td>Brand</td>
              <td>
              	<select style="width: 190px;" v-model="newproduct.brand">
              		<option>--- Select Brand ---</option>
              		<option v-for="brand in allbrands" :value="brand.id">{{ brand.bname }}</option>
              	</select>
                
              </td>
            </tr>

            <tr>
              <td>Category</td>
              <td>
              	<select style="width: 190px;" v-model="newproduct.category">
              		<option>--- Select Category ---</option>
              		<option v-for="category in allcategories" :value="category.id">{{ category.cname }}</option>
              	</select>
                
              </td>
            </tr>

            <tr>
              <td>Featured</td>
              <td>
              	<select style="width: 190px;" v-model="newproduct.featured">
              		<option value="0">non-featured</option>
              		<option value="1">featured</option>
              	</select>
                
              </td>
            </tr>

            <tr>
              <td>Description</td>
              <td>
                <textarea rows="4" type="text" v-model="newproduct.description"   placeholder="Write a short Description">
                  
                </textarea>
              </td>
            </tr>

             <tr>
              <td>Image</td>
              <td><input type="file" @change="onfilechange" >
                
              </td>
            </tr>

            <tr>
            	<td></td>
            	<td>
            		<progress :value="percent" max="100" ></progress>
            		<span v-if="percent != 0 && percent != 100 ">{{ percent }} %</span>
            		<br />
            		<br />
            		<img :src="'http://localhost/vue-ecom/src/assets' + newproduct.image" alt="No image selected" width="150"  />
            	</td>
            </tr>

            <tr>
              <td></td>
              <td>
                <button class="btnSave" @click="addNewProduct()" >Save</button>
              </td>
            </tr>
        </table>
		</modal>

		 <h2 class="fleft ">Product</h2>
       <button class="fright addBtn" @click= "showingAddModal = true">Add New</button>
      <div class="clear"></div>
      <hr>

      
      <table class="nice-table" >
          
          <tr >
            <th>S/L</th> 
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          
          <tr >
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td>  </td>
            <td><button class="edit" >Edit</button> <button class="delete"  >Delete</button></td>
            
          </tr>
      </table>
	</div>
</template>

<script>
	export default{
		name: 'product',
		data(){
			return{

				showingAddModal : false,
				allbrands : [],
				allcategories: [],
				newproduct : {

					name : "",
					description: "",
					brand: "",
					category: "",
        			price: 0,
        			featured: "",
        			image: "/img/uploads/default.png"
				},

				percent: 0,

			}
		},

		mounted(){
			this.init();
		},

		methods: {
			init(){

					//Get all Brand...

          			this.$axios.get("http://localhost/vue-ecom/src/assets/api/brand_api.php?action=read")
         			 .then(res=>{
             		 this.allbrands = res.data.brand;
         			 });

         			 //Get all Category...

         			 this.$axios.get("http://localhost/vue-ecom/src/assets/api/category_api.php?action=read")
						.then(res=>{
						this.allcategories = res.data.category;
					});
      			},

      	onfilechange(e){

      			var _this = this;
      			var files = e.target.files || e.dataTransfers.files;
      			var file = files[0];

      			var fd = new FormData();
      			fd.append("fileToUpload", file, file.name);

      			this.$axios.post("http://localhost/vue-ecom/src/assets/api/upload.php", fd, {
      					 onUploadProgress: function(uploadEvent) {
      					 	this.percent = Math.round((uploadEvent.loaded / uploadEvent.total) * 100);
      					 }
      			})
      			.then(res=>{
      				_this.newproduct.image = res.data.uploaderUrl;
      			});
      		},

      		addNewProduct(){
      			 var formData = this.toFormData(this.newproduct);
      			 this.$axios.post("http://localhost/vue-ecom/src/assets/api/product_api.php?action=create", formData )
      			 .then(res=>{

      
      			 	this.showingAddModal = false;
      			 	if (res.data.error) {
            			this.$iziToast.error({
              			title: "Error!",
              			message: res.data.message
            			});		
          			} else {
            			this.$iziToast.success({
             			title: "Success!",
             			message: res.data.message
            			});
          			}
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