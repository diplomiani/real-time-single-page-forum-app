<template>
  	<v-container>
	  <v-form @submit.prevent="signup">
	    <v-text-field
	      v-model="form.name"
	      type="text"
	      label="Name"
	      required
	    ></v-text-field>
	    <span class="red--text" v-if="errors.name">{{ errors.name[0] }}</span>

	    <v-text-field
	      v-model="form.email"
	      type="email"
	      label="E-mail"
	      required
	    ></v-text-field>
	    <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>

	    <v-text-field
	      v-model="form.password"
	      label="password"
	      type="password"
	      required
	    ></v-text-field>
	    <span class="red--text" v-if="errors.password">{{ errors.password[0] }}</span>

	    <v-text-field
	      v-model="form.password_confirmation"
	      label="password_confirmation"
	      type="password"
	      required
	    ></v-text-field>

	    <v-btn
	    	color="green"
	    	type="submit"
	    >Sign Up</v-btn>
	    <router-link to="/login">
	    	<v-btn color="blue">Login</v-btn>
	    </router-link>
	  </v-form>
	</v-container>	  
</template>

<script>
	//import User from '../Helpers/User'
    export default {
        data(){
        	return {
        		form:{
        			name:null,
        			email:null,
        			password:null,
        			password_confirmation:null,
        		},

        		errors:{},
        	}
        },

        created(){
        	if (User.loggedin()) {
        		this.$router.push({name:'forum'});
        	}
        },

        methods:{
        	signup(){
        		axios.post('/api/auth/signup', this.form)
        			.then(res => 
        				{
        					User.responseAfterLogin(res)
        					this.$router.push({ name:'forum' })

        				})
        			.catch(error => this.errors = error.response.data.errors)
        	}
        }
    }
</script>