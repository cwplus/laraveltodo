<template>
    <div id="app">
        <Header></Header>
        <div class="wrapper">
            <Todos :todos="todos"></Todos>
            <Footer></Footer>
        </div>
        <notifications group="notifications" position= "bottom right" />
    </div>
</template>

<script>

    import Header from "./components/Header"
    import Todos from "./components/Todos"
    import Footer from "./components/Footer"

    let todos = [
        {
            id:1,
            name: "Record video",
            editing:false,
            completed: false,
        },
        {
            id:2,
            name: "Upload video",
            editing:false,
            completed: false,
        },
        {
            id:3,
            name: "Send video",
            editing:false,
            completed: false,
        },
        {
            id:4,
            name: "Remove video",
            editing:false,
            completed: false,
        },
        {
            id:5,
            name: "Debug",
            editing:false,
            completed: false,
        },
    ]
    export default {
        name: 'my-app',
        components: {
            Header: Header,
            Todos: Todos,
            Footer: Footer,
        },
        data: function () {
            return {
                todos: []
            }
        },
        created(){
            window.eventBus.$on('createTodo',(newTodo)=> this.createTodo(newTodo))
            /*      eventBus.$on('finishedEdit',(data)=> this.finishedEdit(data));
                  eventBus.$on('removedTodo',(index)=> this.removeTodo(index));
                  eventBus.$on('checkAllChanged',() => this.checkAllTodos());
                  eventBus.$on('filterChanged',(filter) => this.filter = filter );
                  eventBus.$on('clearedCompleteTodos',() => this.clearCompleted() );*/
        },
        beforeDestroy(){
            /*      eventBus.$off('finishedEdit');
                  eventBus.$off('removedTodo');
                  eventBus.$off('checkAllChanged');
                  eventBus.$off('filterChanged' );
                  eventBus.$off('clearedCompleteTodos' );*/
        },
        mounted: function(){
            axios.get("http://127.0.0.1:8000/todos").then(res=>{
                this.todos = res.data.todos
            })
        },
        methods: {
            createTodo:function(newTodo){
                let todo =  {
                    id:10,
                    name:newTodo,
                    completed:false,
                    edit:false,
                }
                this.todos.push(todo)
                let created_todo_notification = new Audio("media/notification.mp3")
                created_todo_notification.play()
                this.$notify({
                    group: 'notifications',
                    type: 'success',
                    title: 'Todolist',
                    text: "Tache ajoutée avec succès :-) !!!",
                })
            },
            saveTodo: function(todo){

            }
        }
    }
</script>

<style lang="scss">
    body{
        margin: 0;
        padding: 0;
        background-color: #F3F3F3;
        font-family: "Avenir", Arial, "Helvetica Neue", Helvetica, sans-serif;
        height: 100%;
        color: #2c3e50;
        /*    .notification{
              position: absolute;
              bottom: 10px;
            }*/
        #app{
            width:100%;
            min-height: 100%;
            .wrapper{
                /*        width: 1024px;
                        margin: 0 auto;*/
            }
        }

        /*#app {
          font-family: 'Avenir', Helvetica, Arial, sans-serif;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          text-align: center;
          color: #2c3e50;
          margin-top: 60px;
        }*/
    }
</style>
