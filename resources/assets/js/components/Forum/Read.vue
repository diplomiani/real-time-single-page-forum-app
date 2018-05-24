<template>
	<div>
		<div v-if="editing">
			<edit-question
				v-if="question"
				:data="question">		
			</edit-question>
		</div>
		<div v-else>
			<show-question 
				:data="question"
				v-if="question">	
			</show-question>   
		</div>
        <v-container>
          <replies v-if="question" :question="question"></replies>
          <new-reply v-if="question" :questionSlug="question.slug"></new-reply>
        </v-container>
	</div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'
    import EditQuestion from './EditQuestion'
    import Replies from '../Reply/Replies'
    import NewReply from '../Reply/NewReply'
    export default {
    	components:{ ShowQuestion, EditQuestion, Replies, NewReply },
        data(){
        	return{
        		question:null,
        		editing:false,
        	}
        },

        created(){

        	this.listen()
        	this.getQuestion()
        	
        },

        methods:{
        	listen(){
        		EventBus.$on('startEditing', () => {
        			this.editing = true
        		});

        		EventBus.$on('editCancel', ()=> {
        			this.editing = false
        		});
        	},

        	getQuestion(){
        		axios.get(`/api/question/${this.$route.params.slug}`)
        			.then(res => this.question = res.data.data)
        			.catch(error => console.log(error.response.data))
        	}
        }
    }
</script>