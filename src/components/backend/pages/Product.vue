<template>
	<div>
    <!-- Add Product Modal -->

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
              		<option value="">--- Select Brand ---</option>
              		<option v-for="brand in allbrands" :value="brand.id">{{ brand.bname }}</option>
              	</select>
                
              </td>
            </tr>

            <tr>
              <td>Category</td>
              <td>
              	<select style="width: 190px;" v-model="newproduct.category">
              		<option value="">--- Select Category ---</option>
              		<option v-for="category in allcategories" :value="category.id">{{ category.cname }}</option>
              	</select>
                
              </td>
            </tr>

            <tr>
              <td>Featured</td>
              <td>
              	<select style="width: 190px;" v-model="newproduct.featured">
                  <option value="">--- Select ---</option>
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
            		<progress v-if="percent != 0 && percent != 100 " :value="percent" max="100" ></progress>
            		<span v-if="percent != 0 && percent != 100 ">{{ percent }} %</span>
            		<br />
            		
            		<img :src="'http://localhost/vue-ecom/src/assets' + newproduct.image" alt="No image selected" width="150"  />
            	</td>
            </tr>

            <tr>
              <td></td>
              <td>
                <button class="btnSave" @click="addNewProduct()" >Add Product</button>
              </td>
            </tr>
        </table>
		</modal>


    <!-- Edit Product Modal -->
    
    <modal :cond="showingEditModal" modalHeading="Update This Product" @modalClose="showingEditModal = false">
      <table >
            <tr>
              <td>Product Name</td>
              <td><input type="text" id="clickedproductname" v-model="clickedproduct.pname"   placeholder="Product Name">
                
              </td>
            </tr>

           

            <tr>
              <td> Price</td>
              <td><input type="number" id=""  v-model="clickedproduct.price"  placeholder="Product price">
                
              </td>
            </tr>

            <tr>
              <td>Brand</td>
              <td>
                <select style="width: 190px;" v-model="clickedproduct.brand">
                  <option>--- Select Brand ---</option>
                  <option v-for="brand in allbrands" :value="brand.id">{{ brand.bname }}</option>
                </select>
                
              </td>
            </tr>

            <tr>
              <td>Category</td>
              <td>
                <select style="width: 190px;" v-model="clickedproduct.category">
                  <option>--- Select Category ---</option>
                  <option v-for="category in allcategories" :value="category.id">{{ category.cname }}</option>
                </select>
                
              </td>
            </tr>

            <tr>
              <td>Featured</td>
              <td>
                <select style="width: 190px;" v-model="clickedproduct.featured">
                  <option value="0">non-featured</option>
                  <option value="1">featured</option>
                </select>
              </td>
            </tr>

             <tr>
              <td>Status</td>
              <td>
                <select style="width: 190px;" v-model="clickedproduct.available">
                  <option value="0">Sold out</option>
                  <option value="1">Avaibale</option>
                </select>

                <strong>* Product avilable or Sold out</strong>
              </td>
            </tr>

            <tr>
              <td>Description</td>
              <td>
                <textarea rows="4" type="text" v-model="clickedproduct.description"   placeholder="Write a short Description">
                  
                </textarea>
              </td>
            </tr>

             <tr>
              <td>Image</td>
              <td>
                <img :src="'http://localhost/vue-ecom/src/assets' + clickedproduct.image" alt="No image selected" width="150"   />
              </td>
            </tr>

           
            <tr>
              <td></td>
              <td>
                <button class="btnSave" @click="updateProduct()" >Update </button>
              </td>
            </tr>
        </table>
    </modal>


    <!-- Delete Model -->

    <modal
      modalHeading="Delete This Product" :cond="showingDeleteModal" @modalClose="showingDeleteModal = false" >
      <table>
        <tr>
          <td>

            <h3>Are You sure to Delete this product <strong>{{ clickedproduct.pname }} </strong> ?</h3>
          </td>
        </tr>

        <tr>
          <td>
            <button class="btnSave" @click="deleteProduct()">Yes</button>
            <button class="btnClose" @click="showingDeleteModal = false">No</button>
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
          
          <tr v-for="(product, i) in products ">
            <td>{{ i+1 }}</td>
            <td><img :src="'http://localhost/vue-ecom/src/assets' + product.image" width="80" height="100"></td>
            <td>{{ product.pname }}</td>
            <td>{{ product.description }}</td>
            <td>{{ product.price }} </td>
            <td>
              <span v-if="product.available == 1">Available</span>
               <span v-if="product.available == 0">Sold out</span>
             </td>
            <td>
              <button class="edit" @click = "clickedProduct(product); showingEditModal = true">Edit</button> 
              <button class="delete"  @click = "clickedProduct(product); showingDeleteModal = true">Delete</button>
            </td>
            
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
        showingEditModal : false,
        showingDeleteModal : false,
				allbrands : [],
				allcategories: [],
        products: [],
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
        clickedproduct: {},


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

          //Get All Product..

          this.$axios.get("http://localhost/vue-ecom/src/assets/api/product_api.php?action=read")
          .then(res=>{
              this.products = res.data.product;
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

              this.newproduct = {

                  name : "",
                  description: "",
                  brand: "",
                  category: "",
                  price: 0,
                  featured: "",
                  image: "/img/uploads/default.png"
             };

      			 	this.showingAddModal = false;
              this.init();

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

          clickedProduct(product){
              this.clickedproduct = product;
          },

          updateProduct(){


            var formData = this.toFormData(this.clickedproduct);

            this.$axios.post("http://localhost/vue-ecom/src/assets/api/product_api.php?action=update",formData )
            .then(res => {

              this.showingEditModal = false;
              this.init();

                if (res.data.error) {
                  this.$iziToast.error({
                    title: "Error",
                    message: res.data.message
                  });
                } 
                else {
                  this.$iziToast.success({
                    title: "Success",
                    message: res.data.message
                  });
                }

                this.clickedproduct = {};
            });
          },

          deleteProduct(){

             var formData = this.toFormData(this.clickedproduct);

            this.$axios.post("http://localhost/vue-ecom/src/assets/api/product_api.php?action=delete",formData )
            .then(res => {

              this.showingDeleteModal = false;
              this.init();

          if (res.data.error) {
            this.$iziToast.error({
              title: "Error",
              message: res.data.message
            });
          } else {
            this.$iziToast.success({
              title: "Success",
              message: res.data.message
            });
          }

          this.clickedproduct = {};
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