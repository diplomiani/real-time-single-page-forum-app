<template>
    <v-container fluid>
      <v-form @submit.prevent="update">
      	<v-card>
		  <v-text-field
		    v-model="form.title"
		    type="text"
		    label="Question Title"
		    required
		  ></v-text-field>
	      <markdown-editor v-model="form.body"></markdown-editor>
	      <v-card-actions>
	        <v-btn type="submit">
	        	<v-icon color="success">save</v-icon>
	        </v-btn>

	        <v-btn @click="cancel">
	        	<v-icon>cancel</v-icon>
	        </v-btn>
	      </v-card-actions>
	      </v-card>
	    </v-form>
    </v-container>
</template>

<script>
    export default {
    	props:['data'],
    	data(){
    		return{
    			form:{
    				title : null,
    				body : null,
    			}
    		}
    	},
    	created(){
    		this.form = this.data
    	},
    	methods:{
    		cancel(){
    			EventBus.$emit('editCancel');
    		},
    		update(){
    			axios.patch(`/api/question/${this.data.slug}`, this.form)
    				.then(res => this.cancel())
    		}
    	} 
    }
</script>