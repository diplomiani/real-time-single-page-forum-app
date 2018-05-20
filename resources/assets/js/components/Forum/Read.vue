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
	</div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'
    import EditQuestion from './EditQuestion'
    export default {
    	components:{ ShowQuestion, EditQuestion },
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