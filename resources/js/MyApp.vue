<template>
    <div id="app">
        <Header :remaining="remaining"></Header>
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
            eventBus.$on('createTodo',(newTodo)=> this.createTodo(newTodo))
            eventBus.$on('updateTodo',(data)=> this.updateTodo(data))
            eventBus.$on('removeTodo',(id)=> this.removeTodo(id))
            eventBus.$on('checkCompleted',(todo)=> this.checkCompleted(todo))
        },
        beforeDestroy(){
            eventBus.$off('createTodo');
            eventBus.$off('updateTodo');
            eventBus.$off('removeTodo');
            eventBus.$off('checkCompleted' );
        },
        mounted: function(){
            axios.get("/todos").then(res=>{
                this.todos = res.data.todos
            })
        },
        computed:{
            remaining: function(){
                return this.todos.filter(todo=>!todo.completed).length;
            }
        },
        methods: {
            notification_by_sound: function(){
                let created_todo_notification = new Audio("media/notification.mp3")
                created_todo_notification.play()
            },
            notification_by_msg: function(...args){
                let group = 'notifications'
                let type = 'info'
                let text = "Tache ajoutée avec succès :-) !!!"
                let title = "Notification"
                if(_.isString(args)) text = args
                else if(_.isArray(args)){
                    text = args[0]
                    if(_.isSet(args[1])) type = args[1]
                    if(_.isSet(args[2])) title = args[2]
                    if(_.isSet(args[3])) group = args[3]
                }
                console.log(args.indexOf(0))
                console.log(_.map(args,1))
                this.$notify({
                    group: group,
                    type: type,
                    title: title,
                    text: text,
                })
            },
            updateTodo: function(data){

                axios.put("/todos/"+data.todo.id,{
                    name: data.todo.name,
                    completed: data.todo.completed
                }).then(res=>{
                    this.notification_by_sound()
                    if(res.status == 200){
                        this.todos.splice(data.index, 1, data.todo)
                        this.notification_by_msg([
                            "La tache a été mise à jour avec succès !!!",
                            "success"
                        ])
                    } else {
                        this.notification_by_msg([
                            "Erreur lors de la mise à jour de la tache !!!",
                            "error"
                        ])
                    }

                })
            },
            createTodo:function(newTodo){
                axios.post('/todos',{
                    name: newTodo
                }).then(res=>{
                    this.notification_by_sound()
                    if(res.status == 200){
                        this.todos.push({
                            id:res.data.id,
                            name:res.data.name,
                            completed:res.data.completed
                        });
                        this.notification_by_msg([
                            "La tache a été ajouté avec succès !!!",
                            "success"
                        ])
                    } else {

                        this.notification_by_msg([
                            "Erreur au niveau d'ajout de la tache !!!",
                            "error"
                        ])
                    }
                })
            },
            removeTodo: function(id){
                const index  = this.todos.findIndex(item => item.id == id)
                axios.delete('/todos/'+id).then(res=>{
                    this.notification_by_sound()
                    if(res.status == 200){
                        this.todos.splice(index, 1)

                        this.notification_by_msg([
                            "La tache a été supprimé avec succès !!!",
                            "warn"
                        ])
                    } else {
                        this.notification_by_msg([
                            "Erreur lors de la suppression de la tache !!!",
                            "error"
                        ])
                    }
                })
            },
            checkCompleted: function(todo){
                const index  = this.todos.findIndex(item => item.id == todo.id)
                axios.put("/todos/"+todo.id,todo).then(res=>{
                    this.notification_by_sound()
                    if(res.status == 200){
                        this.todos.splice(index, 1, todo)
                        this.notification_by_msg([
                            "Toutes les taches sont completes !!!",
                            "success"
                        ])
                    } else {
                        this.notification_by_msg([
                            "Erreur, lors de l'execution !!!",
                            "warn"
                        ])
                    }
                })
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
