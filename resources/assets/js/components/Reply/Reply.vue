<template>
	<div class="mt-4">
	  	<v-card>
	  	  <v-card-title primary-title>
	  	    <div class="headline">
	  	    	{{ data.user }}
	  	    </div>
	  	    <div class="ml-2">said {{ data.created_at }}</div>
	  	  </v-card-title>
	  	  <v-divider></v-divider>
	  	  <edit-reply 
	  	  	v-if="editing"
	  	  	:reply="data">
	  	  </edit-reply>
	  	  <div v-else>
		  	  <v-card-text v-html="reply"></v-card-text>
		  	  <v-divider></v-divider>
		  	  <v-card-actions v-if="own">
		  	    <v-btn icon @click="edit">
		  	    	<v-icon color="orange">edit</v-icon>
		  	    </v-btn>
		  	    <v-btn icon @click="destroy">
		  	    	<v-icon color="red">delete</v-icon>
		  	    </v-btn>
		  	  </v-card-actions>
		  </div>	  
	  	</v-card>
  	</div>
</template>

<script>
	import md from 'marked'
	import editReply from './editReply'
    export default {
    	components:{editReply},
       props:['data','index'],

       data(){
       	return{
       		editing:false
       	}
       },

       computed:{
       		own(){
       			return User.own(this.data.user_id)
       		},

       		reply(){
	            return md.parse(this.data.reply)
	        }	
       },
       created(){
       	this.listen();
       },
       
       methods:{
	       	destroy(){
	       		EventBus.$emit('deleteReply',this.index)
	       	},

	       	edit(){
	       		this.editing = true
	       	},

	       	listen(){
	       		EventBus.$on('cancelEdit', () => {
	       			this.editing = false;
	       		});
	       	}
       }

    }
</script>