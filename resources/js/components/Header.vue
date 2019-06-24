<template>
    <header>
        <TodoCheckAll></TodoCheckAll>
        <input ref="todoInput" v-model="todoInput" type="text" name="todoInput" id="todoInput" placeholder="Une nouvelle tache à ajouter ? ..."/>
        <button  class="submit" v-on:click="createTodo">+</button>
    </header>
</template>

<script>
    import TodoCheckAll from "./TodoCheckAll";

    export default {
        name: "Header",
        props: ["remaining"],
        components:{
          TodoCheckAll: TodoCheckAll
        },
        data() {
            return {
                todoInput: ''
            }
        },
        methods: {
            createTodo: function(){
                if(this.todoInput != ''){
                    window.eventBus.$emit('createTodo', this.todoInput)
                    this.todoInput = ''
                    this.$refs.todoInput.focus()
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    header{
        display: flex;

        input{
            flex: 1;
            height: 50px;
            box-sizing: border-box;
            font-size: 20px ;
            text-indent: 15px;
        }
        .submit{
            width: 50px;
            height: 50px;
            font-weight: bold;
            font-size: 22px;
            cursor: pointer;
            background-color: #FFCE00;
            color: #000;
            border: none;
            outline: none;
            line-height: 1;
            &:hover{
                background-color: lighten($color: #FFCE00, $amount: 10)
            }
            &:active{
                background-color: darken($color: #FFCE00, $amount: 5 )
            }
        }
    }
</style>