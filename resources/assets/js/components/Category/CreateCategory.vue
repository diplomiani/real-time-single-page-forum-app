<template>
      	<v-container>
    	  <v-form @submit.prevent="submit">
    	    <v-text-field
    	      v-model="form.name"
    	      type="text"
    	      label="Category Name"
    	      required
    	    ></v-text-field>
    	    <span class="red--text" v-if="errors.name">დდდდ</span>
    	    <v-btn
    	    	v-if="editingSlug"
    	    	color="orange darken-1"
    	    	type="submit"
    	    >Update Category</v-btn>

    	    <v-btn
    	    	v-else
    	    	color="green"
    	    	type="submit"
    	    >Add Category</v-btn>


    	    <router-link to="/forum">
    	    	<v-btn color="blue">Back</v-btn>
    	    </router-link>
    	  </v-form>
    	  <v-card>
    	    <v-toolbar color="deep-purple darken-2" dark dense>
              <v-toolbar-title>All Categories</v-toolbar-title>
            </v-toolbar>
            <v-list>
	            <div v-for="(category,index) in categories" :key="category.id">		
	              <v-list-tile>
	              	<v-list-tile-action>
	              	  <v-btn smoll icon @click="edit(index)">
	              	  	<v-icon color="orange darken-1">edit</v-icon>
	              	  </v-btn>
	              	</v-list-tile-action>
	                <v-list-tile-content>
	                  <v-list-tile-title>{{ category.name }}</v-list-tile-title>
	                </v-list-tile-content>
	                <v-btn smoll icon @click="destroy(category.slug)">
	                	<v-icon color="red">delete</v-icon>
	                </v-btn>
	              </v-list-tile>
	            <v-divider></v-divider> 
	            </div>
            </v-list>
    	  </v-card>
    	</v-container>
</template>

<script>
    export default {
    	data(){
    		return{
    			form:{
    				name:null
    			},
    			categories:{},
    			errors:'',
    			editingSlug: null
    		}
    	},

    	created(){
    		this.getCategories();
    	},

    	methods:{
    		// call add or update methods
    		submit(){
    			this.editingSlug ? this.update() : this.add()
    		},

    		// add a new Category
    		add(){
    			axios.post('/api/category', this.form)
    				.then(res => {
    					this.getCategories();
    					this.form.name = ''
    				})
    		},
    		//update this category
    		update(){
    			axios.patch(`/api/category/${this.editingSlug}`, this.form)
    				.then(res => {
    					this.getCategories();
    					this.form.name = ''
    				})
    		},

    		// fetch all categories
    		getCategories(){
    			axios.get('/api/category')
    				.then(res => this.categories = res.data.data)
    				.catch(error => this.errors = error.response.data.errors.name[0])
    		},

    		//call edit methods 
    		edit(index){
    			this.form.name = this.categories[index].name;
    			this.editingSlug = this.categories[index].slug
    			this.categories.splice(index,1)
    		},

    		//delete a category
    		destroy(slug){
    			axios.delete(`/api/category/${slug}`)
    				.then(res => this.getCategories())
    		}
    	}
    }
</script>